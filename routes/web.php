<?php

use App\Http\Controllers\About\AboutController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CP\User\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Profile\ProfileController;
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
            Route::get('' , [UserController::class , 'indexUser'])->name('users');
            Route::get('create' , [UserController::class , 'createUser'])->name('createUser');
            Route::post('store', [UserController::class , 'storeUser'])->name('storeUser'); 
            Route::get('destroy/{id}', [UserController::class , 'destroyUser'])->name('destroyUser'); 
            Route::get('edit/{id}', [UserController::class , 'editUser'])->name('editUser'); 
            Route::post('update', [UserController::class , 'updateUser'])->name('updateUser'); 
        }); 
        //about
        Route::get('about' , [AboutController::class , 'about'])->name('about');
   }); 
   //profile 
   Route::group(['prefix'=>'profile'], function (){
        Route::get('', [ProfileController::class , 'profile'])->name('profile'); 
        Route::get('update-email', [ProfileController::class , 'updateEmail'])->name('updateEmail'); 
        Route::post('update-password', [ProfileController::class , 'updatePassword'])->name('updatePassword'); 
        Route::post('delete-account', [ProfileController::class , 'deleteAccount'])->name('deleteAccount'); 
   }); 
}); 

Route::get('test', function (){
    return "experimintal";
});