<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Database\Seeders\AdminSeeder;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AdminController::class, 'listBlogs'])->middleware(['auth', 'admin'])->name('admin.dashboard');

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name("dashboard");

    Route::get('/profile', function () {
        return view('profile');
    })->name("profile");

    Route::get('/blogs/user/{user}', [BlogController::class, 'userBlogs'])->name('blogs.user');

    Route::put('/pending_blogs/{id}', [AdminController::class, 'updateBlogStatus'])->name('admin.updateBlogStatus');

    Route::resource('/blogs', BlogController::class);

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['guest'])->group(function (){
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('auth.register');

    Route::get('/login', function () {
        return view('auth.login');
    })->name('auth.login')->middleware('throttle:api');

});

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect(route('dashboard'));
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
