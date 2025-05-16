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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/',[ContactController::class,'index']);
Route::post('/thanks/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);
Route::get('/thanks', function () {
    return view('thanks');
});


Route::get('/register',[AuthController::class,'show'])->name('register');;
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


Route::get('/admin',[AdminController::class,'admin'])->name('admin');
Route::delete('/admin/contacts/{id}', [AdminController::class, 'destroy'])->name('admin.contacts.destroy');
Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');