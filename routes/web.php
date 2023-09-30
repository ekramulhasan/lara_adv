<?php

use App\Http\Controllers\Backend\BackupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Frontend\FrontendContorller;

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

Route::get('page/{page_slug}',[FrontendContorller::class,'index']);

Route::get('/view',function(){

    return view('welcome');

});

Route::get('/',[loginController::class,'login'])->name('login.page');



//for admin
Route::prefix('/admin')->group(function(){


    Route::post('index', [loginController::class,'index'])->name('index.page');
    Route::get('logout',[loginController::class,'logout'])->name('logout');

    // Route::get('/dashboard', function () {
    //     return view('admin.layout.inc.home');
    // })->name('home');

    Route::get('/home',[HomeController::class,'index'])->name('home');


    //Resource Define here
    Route::resource('/backup', BackupController::class)->only('index','store','destroy');
    Route::get('backup/download/{file_name}',[BackupController::class,'download'])->name('backup.download');
    Route::resource('/module',ModuleController::class);
    Route::resource('/permission',PermissionController::class);
    Route::resource('/role',RoleController::class);
    Route::resource('/user',UserController::class);
    Route::get('/user_isactive/{user_id}',[UserController::class,'userActive'])->name('user.isactive');

    //page management
    Route::resource('/page',PageController::class);
    Route::get('/page_isactive/{page_id}',[PageController::class,'pageActive'])->name('page.isactive');

    // Profile Management
    Route::get('/edit-profile',[ProfileController::class,'getProfileUpdate'])->name('update.profile');
    Route::post('/update-profile',[ProfileController::class,'updateProfile'])->name('post.update.profile');


    //password update
    Route::get('/edit-password',[ProfileController::class,'getPasswordUpdate'])->name('update.password');
    Route::post('/update-password',[ProfileController::class,'updatePassword'])->name('post.update.password');


    //Setting Management
    Route::group(['as'=>'settings.', 'prefix'=>'settings'],function(){

        //general setting
        Route::get('general',[SettingController::class,'general'])->name('general');
        Route::post('general_update',[SettingController::class,'general_update'])->name('general.update');

        //apperance setting
        Route::get('apperance',[SettingController::class,'apperance'])->name('apperance');
        Route::post('apperance_update',[SettingController::class,'apperance_update'])->name('apperance.update');

        //mail setting
        Route::get('mail',[SettingController::class,'mail'])->name('mail');
        Route::post('mail_update',[SettingController::class,'mail_update'])->name('mail.update');


    });
});


// Route::get('/restore/{id}',[RoleController::class,'restoreData']);
