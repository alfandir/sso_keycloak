<?php

use App\Http\Controllers\SSOController;
use App\Http\Controllers\TestController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/sso', [SSOController::class, 'index'])->name('sso');
Route::post('/sso/login', [SSOController::class, 'login'])->name('sso/login');
Route::get('/test', [TestController::class, 'index'])->name('test');
