<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModels extends Model
{
    protected $table = 'users';

    public function _getUserByEmail($email)
    {
        $user = DB::table($this->table)
            ->join('user_role', 'users.roleId', '=', 'user_role.roleId')
            ->select('*')
            ->where('email', $email)->get()->first();
        return $user;
    }

    public function _getAllMember()
    {
        return $this->select('*')->get()->toArray();
    }
}
