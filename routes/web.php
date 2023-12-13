<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChatController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gotologin', function () {
    return redirect()->to('/login');
});

Route::middleware('guest')->group(function (){
    Route::get('/register', [RegisterController::class, 'index'])->name('register_get');
    Route::get('/login', [LoginController::class, 'index'])->name('login_get');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function (){
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/home', [ChatController::class, 'index'])->name('home');
    Route::post('/chats', [ChatController::class, 'createChat'])->name('chats');
    Route::get('/chats/{id}', [ChatController::class, 'show'])->name('chats_show');
    Route::post('/chats/{chatId}/message', [ChatController::class, 'sendMessage'])->name('send_message');
});
