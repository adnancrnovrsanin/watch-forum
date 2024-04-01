<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\TopicController;
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

Route::get('', fn () => to_route('topics.index'));

Route::resource('topics', TopicController::class)
    ->only(['index', 'show']);

Route::resource('conversations', ConversationController::class)
    ->only(['show']);

Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'login_form'])->name('auth.login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'register_form'])->name('auth.create');
    Route::post('register', [AuthController::class, 'register']);
    Route::delete('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('login', fn () => to_route('auth.login'))->name('login');
Route::get('register', fn () => to_route('auth.create'))->name('register');
