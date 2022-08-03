<?php

namespace App\Http\Controllers;

use App\Models\BisnisModel;
use App\Models\UserModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Bisnis extends Controller
{
    protected $bisnis;

    public function __construct()
    {
        $this->bisnis = new BisnisModel();
    }

    public function index()
    {
        $components = array();
        $business = $this->bisnis->_getAllBusiness();
        $components['business'] = $business;
        return view('bisnis.index', $components);
    }

    public function sampah()
    {
        $components = array();
        $business = BisnisModel::onlyTrashed()->get()->toArray();
        $components['business'] = $business;
        return view('bisnis.sampah', $components);
    }



    //------------- Not view pages function

    public function _getPic()
    {
        if (request()->ajax()) {
            $listOfUsers = DB::table('users')
                ->join('user_role', 'users.roleId', '=', 'user_role.roleId')
                ->select('*');

            //--- Cek apakah keyword itu di set atau tidak
            if (isset($_POST['keyword'])) { # Jika ada POST keyword

                $keyword = $_POST['keyword']; # simpan dalam variable
                if ($keyword) {
                    $listOfUsers->where('username', 'like', '%' . $keyword . '%')->orWhere('email', 'like', '%' . $keyword . '%')->limit(4);
                }
            }

            return response()->json($listOfUsers->get()->toArray(), 200);
        }
    }

    public function _addBisnis()
    {
        $bisnisName = '';
        $bisnisDesc = '';
        $bisnisPIC  = '';
        $userId     = '';

        if (isset($_POST['bisnisName'])) {
            $bisnisName = $_POST['bisnisName'];
        };
        if (isset($_POST['bisnisDesc'])) {
            $bisnisDesc = $_POST['bisnisDesc'];
        };
        if (isset($_POST['bisnisPIC'])) {
            $bisnisPIC = $_POST['bisnisPIC'];
        };
        if (isset($_POST['userId'])) {
            $userId = $_POST['userId'];
        }


        //---- Cek apakah ID USER VALID
        $user    = UserModels::select('*')->where('userId', $userId)->get()->first();
        if (!$user) {
            echo "user pic is invalid";
        }

        //----- Buat businessId
        $allBusinessExist  = sizeof($this->bisnis->all()->toArray());
        $businessId        = "BISNIS" . str_pad(strval(intval($allBusinessExist) + 1), 3, '0', STR_PAD_LEFT);

        //----- Insert ke database
        $insert = BisnisModel::create([
            'businessId'     => $businessId,
            'nameOfBusiness' => $bisnisName,
            'descOfBusiness' => $bisnisDesc,
            'pic'            => $userId
        ]);

        if (!$insert) {
            //---- Buat flash data
            session()->flash('error', 'Terjadi kesalahan pada sistem');
            return redirect()->to('/bisnis')->withInput(request()->input());
        } else {
            return redirect()->to('/bisnis');
        }
    }

    public function _deleteBisnis()
    {
        if (request()->ajax()) {
            $businessId = '';
            if (isset($_POST['id'])) {
                $businessId = $_POST['id'];
            }

            //----- SoftDelete
            $delete = BisnisModel::find($businessId)->delete();

            if ($delete) {
                return response()->json($businessId, 200);
            }
        }
    }

    public function _restoreBisnis()
    {
        if (request()->ajax()) {
            $businessId = '';
            if (isset($_POST['id'])) {
                $businessId = $_POST['id'];
            }

            //----- Restore
            $restore = BisnisModel::onlyTrashed()->where('businessId', $businessId)->restore();

            if ($restore) {
                return response()->json($businessId, 200);
            }
        }
    }

    public function _restoreAll()
    {
        if (request()->ajax()) {
            //----- Restore All
            $restore = BisnisModel::onlyTrashed()->restore();

            if ($restore) {
                return response()->json('succeed', 200);
            }
        }
    }

    public function _forceDelete()
    {
        if (request()->ajax()) {
            $businessId = '';
            if (isset($_POST['id'])) {
                $businessId = $_POST['id'];
            }

            //----- Force Delete
            $delete = BisnisModel::onlyTrashed()->find($businessId)->forceDelete();

            if ($delete) {
                return response()->json($businessId, 200);
            }
        }
    }
}
