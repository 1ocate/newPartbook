<?php

use Illuminate\Support\Facades\Route;

// For email verification
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


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

require __DIR__.'/auth.php';

// For email verification Start.
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('alert', 'test!');
})->middleware(['auth', 'throttle:3,1'])->name('verification.send');

Route::get('/profile', function () {
})->middleware('verified');

// For email verification End.

// For Normal page.
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/test', function () {
    return view('test');
})->middleware(['auth'])->name('test');

Route::get('/require', function () {
    return view('require');
});