<?php

use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\loginController;
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



Route::get('/',[loginController::class,'login'])->name('login.page');

Route::prefix('/admin')->group(function(){


    Route::post('index', [loginController::class,'index'])->name('index.page');
    Route::get('logout',[loginController::class,'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('admin.layout.inc.home');
    })->name('home');


    //Resource Define here
    Route::resource('/module',ModuleController::class);

});
