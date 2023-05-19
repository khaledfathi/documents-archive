<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
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

Route::get('/' , fn()=>redirect(route('login')))->name('root'); 
Route::get('login' , [AuthController::class , 'login'])->name('login')->middleware('guest');
Route::get('register' , [AuthController::class , 'register'])->name('register')->middleware('guest');
Route::post('login' , [AuthController::class , 'auth'])->name('login.auth');
Route::get('logout', [AuthController::class , 'logout'])->name('logout'); 
Route::post('store-user', [AuthController::class , 'storeUser'])->name('storeUser'); 


Route::middleware('auth')->group(function (){
    Route::get('dashboard' , [DashboardController::class , 'dashboard'])->name('dashboard');
}); 

Route::get('test', function (){
    return view('test');
});