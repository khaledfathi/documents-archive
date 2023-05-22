<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CP\User\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
Route::post('login' , [AuthController::class , 'auth'])->name('login.auth');
Route::get('logout', [AuthController::class , 'logout'])->name('logout');

Route::middleware('auth')->group(function (){
    //dashboard
    Route::get('dashboard' , [DashboardController::class , 'dashboard'])->name('dashboard');

    //cp [control panel]
    Route::group(['prefix'=>'cp' ] , function (){
        //users
        Route::group(['prefix'=>'user'] , function (){
            Route::get('index' , [UserController::class , 'indexUser'])->name('users');
            Route::get('create' , [UserController::class , 'createUser'])->name('createUser');
            Route::post('store', [UserController::class , 'storeUser'])->name('storeUser'); 
            Route::get('destroy/{id}', [UserController::class , 'destroyUser'])->name('destroyUser'); 
            Route::get('edit/{id}', [UserController::class , 'editUser'])->name('editUser'); 
        }); 
   }); 
}); 

Route::get('test', function (){
    return view('test');
});