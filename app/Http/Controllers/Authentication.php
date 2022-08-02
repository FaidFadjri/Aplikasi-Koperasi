<?php

namespace App\Http\Controllers;

use App\Models\UserModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\returnSelf;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class Authentication extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserModels();
    }

    public function login()
    {
        return view('login/index');
    }

    //----- Handle Login
    public function login_auth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',   // required and email format validation
            'password' => 'required',
        ]);

        if ($validator->fails()) return response()->json($validator->errors(), 401);

        $email = $_POST['email'];
        $pass  = $_POST['password'];
        $user  = $this->user->_getUserByEmail($email);

        //------ Cek apakah user dengan email tersebut ada atau tidak
        if (!$user) { # jika user tidak ada
            return response()->json("Email tidak terdaftar", 403);
        } else {
            //---- Cek password apakah match atau tidak
            if ($pass != $user->password) { # jika password tidak sama dengan akun
                return response()->json("Password salah", 403);
            } else {

                $user     = [
                    'email'     => $user->email,
                    'name'      => $user->username,
                    'phone'     => $user->phone,
                    'role'      => $user->position,
                    'address'   => $user->address
                ];

                //----- Simpan data login sebagai cookies
                Cookie::queue("user", json_encode($user), 60);
                return response()->json($user, 200);
            }
        }
    }
}
