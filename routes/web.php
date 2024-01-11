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

Route::prefix('dashboard')->middleware(['auth'])->group(function () {    
    // CRUD
    Route::post('insert.activity', [ActivityController::class, 'insertActivity'])->name('insert.activity');
    Route::get('report', [ActivityController::class, 'showdata'])->name('report');
    Route::post('update-activity', [ActivityController::class, 'editdata'])->name('update.activity');
    Route::get('report/delete/{id}', [ActivityController::class, 'delete'])->name('report.delete');
    Route::get('profile', [ActivityController::class, 'profile'])->name('profile');
    Route::post('update-profile', [LoginController::class, 'editprofile'])->name('update.profile');
    Route::get('print', [ActivityController::class, 'print'])->name('print');

    Route::prefix('galeri-dashboard')->group(function () {
        Route::get('galeri-dashboard', [App\Http\Controllers\GaleriController::class, 'index'])->name('galeri-dashboard');
        Route::post('data-galeri-register', [App\Http\Controllers\GaleriController::class, 'store'])->name('galeri.data-galeri-register');
        Route::get('data-galeri-delete/{id}', [App\Http\Controllers\GaleriController::class, 'destroy'])->name('galeri.data-galeri-delete');
      });
      Route::prefix('profile-keputrian')->group(function () {
        Route::get('profile-keputrian', [App\Http\Controllers\KeputrianController::class, 'index'])->name('profile-keputrian');
        Route::post('data-keputrian-update', [App\Http\Controllers\KeputrianController::class, 'update'])->name('keputrian.data-keputrian-update');
      });
});

Route::get('/', function () {
    return view('home');
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

//Forgot pass
Route::get('/password/reset',  [LoginController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email',  [LoginController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}',  [LoginController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password',  [LoginController::class, 'resetpass'])->name('password.update');;

Route::post('/search.activity', [ActivityController::class, 'searchActivity'])->name('search.activity');
Route::post('/sort.activity', [ActivityController::class, 'sortActivity'])->name('sort.activity');

