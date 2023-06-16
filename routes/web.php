<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;

use App\Http\Middleware\CheckAdminRole;


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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin routes
Route::middleware(['auth' ,'admin'])->group(function () {
    Route::get('/admin/kokpit', [AdminController::class, 'kokpit'])->name('admin.kokpit');
    Route::get('/admin/kokpit/wyloguj', [AdminController::class, 'logout'])->name('admin.logout');


    Route::get('/admin/harmonogram', [AdminController::class, 'harmonogram'])->name('admin.harmonogram');

    Route::get('/admin/harmonogram/insert', [AdminController::class, 'insert'])->name('harmonogram.save');

    Route::get('/admin/harmonogram/delete', [AdminController::class, 'delete'])->name('harmonogram.delete');

});


// Logged in user
Route::middleware(['auth'])->group(function () { 
    Route::get('/moje-konto', [UserController::class, 'index'])->name('user.my_account');
    Route::post('utworz-rezerwacje' , [ReservationController::class , 'create'] )->name('reservation.create');
});


// Pages
Route::get('dostepne-terminy' , [PagesController::class , 'schedulerList'])->name('scheduler.list');


