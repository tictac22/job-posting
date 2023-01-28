<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::view('/', 'index');
Route::view("/register", 'auth.register');
Route::view("/login", 'auth.login')->name('login');
Route::view("/manage", 'manage')->name('manage');

Route::get('/test',function (Request $request){
	dd(Auth::user());
});
Route::prefix('auth')->controller(AuthController::class)->group(function () {

	Route::post('/register','register');
});