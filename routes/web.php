<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\currencyApiController;

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

Route::get('dashboard', [UserController::class, 'dashboard']); 
Route::get('login', [UserController::class, 'index'])->name('login');
Route::post('custom-login', [UserController::class, 'customLogin'])->name('login.custom'); 
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('custom-registration', [UserController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [UserController::class, 'signOut'])->name('signout');

Route::get('categories', [UserController::class, 'viewCategory'])->name('viewCategory');
Route::post('createCategory', [UserController::class, 'createCategory'])->name('category.create'); 


Route::get('transaction', [UserController::class, 'viewTransaction'])->name('viewTransaction');
Route::post('createTransaction', [UserController::class, 'createTransaction'])->name('transaction.create'); 

Route::get('apicurreny', [currencyApiController::class, 'currencyApi'])->name('currencyApi');

Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
