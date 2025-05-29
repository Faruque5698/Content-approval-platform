<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('users', UserController::class)->middleware('isAdmin');

    });

    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
        Route::get('trash', [PostController::class, 'trash'])->name('trash');
        Route::put('restore/{id}', [PostController::class, 'restore'])->name('restore');
        Route::delete('force-delete/{id}', [PostController::class, 'forceDelete'])->name('forceDelete');
        Route::get('archive', [PostController::class, 'archiveList'])->name('archive')->middleware('isAdmin');
        Route::put('archive/{post}', [PostController::class, 'archive'])->name('archiveCreate')->middleware('isAdmin');
        Route::put('restore-archive/{id}', [PostController::class, 'restoreArchive'])->name('restoreArchive')->middleware('isAdmin');
        Route::put('update-status/{post}', [PostController::class, 'updateStatus'])->name('updateStatus')->middleware('isAdmin');
    });

    Route::resource('posts', PostController::class);

    Route::resource('categories', CategoryController::class)->except(['show']);

    Route::resource('tags', TagController::class)->except(['show']);


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
Route::get('/test-mail', function() {
    \Illuminate\Support\Facades\Mail::raw('Test email content', function($message) {
        $message->to('your-email@example.com')->subject('Test Email');
    });
    return 'Mail sent (or failed)';
});
