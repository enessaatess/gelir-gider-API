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

Route::get('/', function(){
    return view("app");
}); 
Route::get('dashboard', [UserController::class, 'dashboard']); 
Route::post('login', [UserController::class, 'customLogin']); 
Route::post('register', [UserController::class, 'customRegistration']); 
Route::post('user', [UserController::class, 'userInfo']); 
Route::post('signout', [UserController::class, 'signOut']);

Route::post('categories', [UserController::class, 'viewCategory']);
Route::post('createCategory', [UserController::class, 'createCategory']); 


Route::post('transaction', [UserController::class, 'viewTransaction']);
Route::post('deleteTransaction', [UserController::class, 'destroy']);
Route::post('createTransaction', [UserController::class, 'createTransaction']); 
Route::post('updateTransaction', [UserController::class, 'updateTransaction']); 
Route::post('report', [UserController::class, 'viewPriceDetails']); 




Route::get('apicurrency', [currencyApiController::class, 'currencyApi']));

Route::post('currency', [UserController::class, 'currency']));

