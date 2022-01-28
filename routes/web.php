<?php

use App\Http\Controllers\AskPricesController;
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

Route::get('/', function () {
    return redirect()->route('askprices.main');
    
}); 

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/test', function () {
    return view('test');
})->middleware(['auth'])->name('test');

Route::prefix('askprices')->name('askprices.')->middleware(['auth'])->group(function () {
    //Route::middleware('auth')->group(function () {
        Route::post('/', [AskPricesController::class, 'store'])->name('store');

        Route::get('/', function () {
            return view('require');
        })->name('main');
        Route::get('/result', [AskPricesController::class, 'result'])->name('result');
        Route::get('/{askPrice}', [AskPricesController::class, 'show'])->name('show');
        Route::get('/result/export/', [AskPricesController::class, 'export'])->name('excel');

    //});
    /*Route::get('', function () {
        return view('require');
        Route::post('/', [PostsController::class, 'store'])->name('store');

    });*/
    
});