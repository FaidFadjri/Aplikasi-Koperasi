<?php

use App\Http\Controllers\Authentication;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [Dashboard::class, 'index']);


//----- Authentication Routes
Route::group(['prefix' => 'login'], function () {
    Route::get('/', [Authentication::class, 'login']);
    Route::post('auth', [Authentication::class, 'login_auth']);
});

Route::get('intro', function () {
    return view('intro.index');
});
