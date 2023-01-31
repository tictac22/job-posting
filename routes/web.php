<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsContoller;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
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

Route::get('/', [PostsContoller::class,'index'])->name('index');
Route::view("/register", 'auth.register')->name('register');
Route::view("/login", 'auth.login')->name('login');

Route::middleware('auth')->group(function() {

	Route::view("/create", 'create')->name('create');	
});

Route::controller(PostsContoller::class)->group(function () {

	Route::get('/manage','getUsersPost')->middleware('auth')->name('manage');
	Route::get('/job/{id}','getOne')->where('id', '[0-9]+')->name('job');
	
	Route::get('/edit/{id}','getPostForm')->where('id', '[0-9]+')->name('job');
	Route::post('/create','create')->middleware('auth');
	Route::post('/edit','edit')->middleware('auth');
	Route::post('/delete','delete')->middleware('auth');
});

Route::prefix('auth')->controller(AuthController::class)->group(function () {

	Route::post('/register','register');
	Route::post('/login','login');
	Route::post('/logout','logout');
});