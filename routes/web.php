<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\loginController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Frontend\FrontendContorller;
use App\Http\Controllers\Backend\PermissionController;

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

// Route::get('/view',function(){

//     return view('welcome');

// });

Route::get('/login',[loginController::class,'login'])->name('login.page');

 //socialtie login
 Route::group(['as' => 'login.','prefix' => 'login'],function(){

    Route::get('/{provider}',[loginController::class,'redirectToProvider'])->name('provider');
    Route::get('/{provider}/callback',[loginController::class,'providerCallback'])->name('provider.callback');

});


// Route::get('/auth/redirect', function () {
//     return Socialite::driver('github')->redirect();
// });

// Route::get('/auth/callback', function () {
//     $user = Socialite::driver('github')->user();

//     dd($user);
// });

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

        //social login setting
        Route::get('socialite',[SettingController::class,'socialiteView'])->name('socialite');
        Route::post('socialite_update',[SettingController::class,'socialiteUpdate'])->name('socialite.update');

    });
});



// Route::get('/restore/{id}',[RoleController::class,'restoreData']);
