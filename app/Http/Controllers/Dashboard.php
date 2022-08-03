<?php

namespace App\Http\Controllers;

use App\Models\BisnisModel;
use App\Models\UserModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    protected $bisnis;
    protected $user;

    public function __construct()
    {
        $this->bisnis = new BisnisModel;
        $this->user   = new UserModels();
    }

    public function index()
    {
        $components             = array();
        $components['business'] = sizeof($this->bisnis->_getAllBusiness());
        $components['member']   = sizeof($this->user->_getAllMember());

        return view('dashboard/index', $components);
    }
}
