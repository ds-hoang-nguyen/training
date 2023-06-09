<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TimeSheetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(LoginController::class)->name('auth.')->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'checkLogin')->name('login.post');
    Route::get('logout', 'logOut')->name('logout')->middleware('auth');
});

Route::group(['middleware' => 'auth'], function () {
    Route::controller(UserController::class)->name('user.')->group(function () {
        Route::get('user', 'index')->name('index');
        Route::get('user-edit/{id}', 'edit')->name('edit');
        Route::post('user-update', 'update')->name('update');
    });

    Route::controller(TimeSheetController::class)->name('time_sheet.')->group(function () {
        Route::get('time-sheet', 'index')->name('index');
        Route::get('time-sheet-create', 'create')->name('create');
        Route::post('time-sheet-create', 'store')->name('store');
        Route::get('time-sheet-calendar', 'calendar')->name('calendar');
        Route::get('time-sheet-update/{id}', 'edit')->name('edit');
        Route::post('time-sheet-update', 'update')->name('update');
        Route::get('time-sheet-export', 'export')->name('export');
    });
});
