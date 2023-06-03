<?php

use App\Http\Controllers\About\AboutController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CP\User\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Document\ElectricityDocumentController;
use App\Http\Controllers\Document\WaterDocumentController;
use App\Http\Controllers\Profile\ProfileController;
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
Route::post('login' , [AuthController::class , 'auth'])->name('login.auth');
Route::get('logout', [AuthController::class , 'logout'])->name('logout');
Route::get('documentations', fn()=>redirect('/docs/index.html'))->name('documentaions'); 

Route::middleware('auth')->group(function (){
    //dashboard
    Route::get('dashboard' , [DashboardController::class , 'dashboard'])->name('dashboard.all');

    //cp [control panel]
    Route::group(['prefix'=>'cp' ] , function (){
        //users
        Route::group(['prefix'=>'user'] , function (){
            Route::get('' , [UserController::class , 'index'])->name('user.index');
            Route::get('create' , [UserController::class , 'create'])->name('user.create');
            Route::post('store', [UserController::class , 'store'])->name('user.store'); 
            Route::get('destroy/{id}', [UserController::class , 'destroy'])->name('user.destroy'); 
            Route::get('edit/{id}', [UserController::class , 'edit'])->name('user.edit'); 
            Route::post('update', [UserController::class , 'update'])->name('user.update'); 
        }); 
        //about
        Route::get('about' , [AboutController::class , 'about'])->name('about');
   }); 
   //profile 
   Route::group(['prefix'=>'profile'], function (){
        Route::get('', [ProfileController::class , 'profile'])->name('profile'); 
        Route::get('update-email', [ProfileController::class , 'updateEmail'])->name('profile.updateEmail'); 
        Route::post('update-password', [ProfileController::class , 'updatePassword'])->name('profile.updatePassword'); 
        Route::post('delete-account', [ProfileController::class , 'deleteAccount'])->name('profile.deleteAccount'); 
        Route::get('clear-user-logs', [ProfileController::class , 'clearUserLogs'])->name('profile.clearUserLogs'); 
        Route::get('destroy-user-log/{id}', [ProfileController::class , 'destroyUserLog'])->name('profile.destroyUserLog'); 
   }); 
   //documents
   Route::group(['prefix'=>'documents'] , function (){
    //electricity
     Route::group(['prefix'=>'electricity'],function (){
        Route::get('electricity-documents/' , [ElectricityDocumentController::class , 'index'])->name('document.electricity.index'); 
        Route::get('electricity-documents/create' , [ElectricityDocumentController::class , 'create'])->name('document.electricity.create'); 
        Route::post('electricity-documents/store' , [ElectricityDocumentController::class , 'store'])->name('document.electricity.store'); 
        Route::get('electricity-documents/destroy/{id}' , [ElectricityDocumentController::class , 'destroy'])->name('document.electricity.destroy'); 
        Route::get('electricity-documents/edit/{id}' , [ElectricityDocumentController::class , 'edit'])->name('document.electricity.edit'); 
        Route::post('electricity-documents/update' , [ElectricityDocumentController::class , 'update'])->name('document.electricity.update'); 
     }) ;
     //water
     Route::group(['prefix'=>'water'], function (){
        Route::get('water-document' , [WaterDocumentController::class , 'index'])->name('document.water.index'); 
        Route::get('water-document/create' , [WaterDocumentController::class , 'create'])->name('document.water.create'); 
        Route::post('water-document/store' , [WaterDocumentController::class , 'store'])->name('document.water.store'); 
     }) ; 
   });
}); 


Route::get('test', function (){
});