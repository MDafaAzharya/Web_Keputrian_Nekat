<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', function () {
    return view('auth.register');
});

Route::get('/nav', function () {
    return view('nav');
});

//regist
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/actionregister', [LoginController::class, 'actionregister'])->name('actionregister');
//login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

//CRUD
Route::post('/insert.activity', [ActivityController::class, 'insertActivity'])->name('insert.activity');

Route::get('/report', [ActivityController::class, 'showdata'])->name('report');

Route::post('update-activity', [ActivityController::class, 'editdata'])->name('update.activity');
Route::get('/report/delete/{id}', [ActivityController::class, 'delete'])->name('report.delete');

Route::get('/profile', [ActivityController::class, 'profile'])->name('profile');
Route::post('update-profile', [LoginController::class, 'editprofile'])->name('update.profile');

