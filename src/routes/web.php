<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

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

//お問い合わせフォーム
Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');
Route::post('/', [ContactController::class, 'back'])->name('contact.index');;

//登録・ログイン機能
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::middleware('auth')->group(function(){
    Route::get('/admin', [AuthController::class, 'admin']);
    Route::get('/search',[AdminController::class, 'search']);
    Route::get('/export',[AdminController::class, 'export']);
    Route::delete('/delete', [AdminController::class, 'destroy']);
});