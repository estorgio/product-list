<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{product}/edit', [ProductController::class, 'edit']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
});

Route::post('/logout', [UserController::class, 'logout'])
    ->middleware('auth');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [UserController::class, 'login'])
        ->name('login');
    Route::post('/login', [UserController::class, 'authenticate']);
    Route::get('/signup', [UserController::class, 'signup']);
    Route::post('/signup', [UserController::class, 'store']);
});

Route::get('/', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

Route::get('/verify-account', [UserController::class, 'require_verification'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/verify-account/{id}/{hash}', [UserController::class, 'verify_account'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::get('/forgot-password', [UserController::class, 'forgot_password_form'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [UserController::class, 'email_password_reset_link'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [UserController::class, 'password_reset_form'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [UserController::class, 'reset_password'])
    ->middleware('guest')
    ->name('password.update');
