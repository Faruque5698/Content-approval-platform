<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth','isAdmin']], function () {
    Route::get('/dashboard',[DashboardController::class, 'index'] )->name('dashboard');

    Route::group(['prefix' => 'admin','as' => 'admin.'], function () {
        Route::resource('users',UserController::class);

        Route::resource('categories', CategoryController::class)->except(['show']);

        Route::resource('tags', TagController::class)->except(['show']);
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
