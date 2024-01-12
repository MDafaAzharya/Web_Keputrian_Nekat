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
    Route::prefix('agenda-dashboard')->group(function () {
      Route::get('agenda-dashboard', [App\Http\Controllers\AgendaController::class, 'index'])->name('agenda-dashboard');
      Route::get('data-agenda-show', [App\Http\Controllers\AgendaController::class, 'show'])->name('agenda.data-agenda-show');
      Route::post('data-agenda-register', [App\Http\Controllers\AgendaController::class, 'store'])->name('agenda.data-agenda-register');
      Route::get('data-agenda-delete/{id}', [App\Http\Controllers\AgendaController::class, 'destroy'])->name('agenda.data-agenda-delete');
      Route::get('data-agenda-edit/{id}', [App\Http\Controllers\AgendaController::class, 'edit'])->name('agenda.data-agenda-edit');
      Route::post('data-agenda-update', [App\Http\Controllers\AgendaController::class, 'update'])->name('agenda.data-agenda-update');
    });
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/galeri', [App\Http\Controllers\HomeController::class, 'galeri'])->name('galeri');
Route::get('/agenda', [App\Http\Controllers\HomeController::class, 'agenda'])->name('agenda');
Route::get('/agenda-show', [App\Http\Controllers\HomeController::class, 'showagenda'])->name('agenda-show');

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

