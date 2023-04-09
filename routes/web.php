<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\EventController;


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

Route::get('/admin/kokpit', [AdminController::class, 'kokpit'])->name('admin.kokpit');

Route::get('/admin/harmonogram', [AdminController::class, 'harmonogram'])->name('admin.harmonogram');

Route::get('/admin/harmonogram/insert', [AdminController::class, 'insert'])->name('harmonogram.save');

Route::get('/rezerwacja', [EventController::class, 'index'])->name('event.index');


