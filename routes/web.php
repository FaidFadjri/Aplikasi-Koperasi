<?php

use App\Http\Controllers\Authentication;
use App\Http\Controllers\Bisnis;
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

//----- Intro Routes
Route::get('intro', function () {
    return view('intro.index');
});

//----- Authentication Routes
Route::group(['prefix' => 'login'], function () {
    Route::get('/', [Authentication::class, 'login']);
    Route::post('auth', [Authentication::class, 'login_auth']);
});

//----- Business Routes
Route::group(['prefix' => 'bisnis'], function () {

    //-------- Pages function
    Route::get('/', [Bisnis::class, 'index']);
    Route::get('sampah', [Bisnis::class, 'sampah']);

    //-------- Non pages function
    Route::post('get_pic', [Bisnis::class, '_getPic']);
    Route::post('add_bisnis', [Bisnis::class, '_addBisnis']);
    Route::post('delete_bisnis', [Bisnis::class, '_deleteBisnis']);
    Route::post('force_delete', [Bisnis::class, '_forceDelete']);
    Route::post('restore_bisnis', [Bisnis::class, '_restoreBisnis']);
    Route::post('restore_all', [Bisnis::class, '_restoreAll']);
});
