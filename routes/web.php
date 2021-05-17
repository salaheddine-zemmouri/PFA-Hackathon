<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CompetitionController;
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
Route::get('/homepage',function(){
  dd(Auth::guard('administrator')->user()->id);
  // guard('contestant')->
})->name('homepage');

// Route::get('/dashboard/{user}', function ($user) {
//
// })->name('home');


Route::get('/', function () {
    return view('landing');
})->name('home');


Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'loginUser']);

Route::get('/register',[RegisterController::class,'create'])->name('register');
Route::post('/register',[RegisterController::class,'store']);

Route::get('/logout',[LogoutController::class,'logoutUser'])->name('logout');

Route::resource('/admin/competitions',Competitioncontroller::class);