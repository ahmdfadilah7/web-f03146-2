<?php

use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StoryController;
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

Route::group(['middleware' => ['xsssanitizer']], function() {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('logout/{slug}', [AuthController::class, 'logout'])->name('logout');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::get('forgotpassword', [AuthController::class, 'forgot'])->name('forgotpassword');
    Route::get('changepassword/{emai}', [AuthController::class, 'change_password'])->name('changepassword');
    Route::post('prosesLogin', [AuthController::class, 'proses_login'])->name('prosesLogin');
    Route::post('prosesRegister', [AuthController::class, 'proses_register'])->name('prosesRegister');
    Route::post('prosesCheck', [AuthController::class, 'proses_check'])->name('prosesCheck');
    Route::post('prosesChangepassword', [AuthController::class, 'proses_change_password'])->name('prosesChangepassword');

});


Route::group(['middleware' => ['xsssanitizer', 'auth:pengguna', 'role:pengguna']], function(){ 

    Route::get('notif', [NotificationController::class, 'index'])->name('notif');

    Route::get('story', [StoryController::class, 'index'])->name('story');
    Route::get('story/mystory', [StoryController::class, 'my_story'])->name('story.mystory');
    Route::get('story/mystory/add', [StoryController::class, 'create'])->name('story.mystory.add');
    Route::post('story/store', [StoryController::class, 'store'])->name('story.store');
    Route::get('story/like/{id}', [StoryController::class, 'like'])->name('story.like');
    Route::post('story/comment', [StoryController::class, 'comment'])->name('story.comment');
    Route::post('story/comment/delete', [StoryController::class, 'delete_comment'])->name('story.comment.delete');

});

Route::group(['middleware' => ['xsssanitizer', 'auth:admin', 'role:admin']], function(){

    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('admin/pengguna', [PenggunaController::class, 'index'])->name('admin.pengguna');
    Route::get('admin/pengguna/getListData', [PenggunaController::class, 'listData'])->name('admin.pengguna.list');
    Route::get('admin/pengguna/delete/{id}', [PenggunaController::class, 'destroy'])->name('admin.pengguna.delete');

    Route::get('admin/administrator', [AdministratorController::class, 'index'])->name('admin.administrator');
    Route::get('admin/administrator/getListData', [AdministratorController::class, 'listData'])->name('admin.administrator.list');
    Route::get('admin/administrator/add', [AdministratorController::class, 'create'])->name('admin.administrator.add');
    Route::post('admin/administrator/store', [AdministratorController::class, 'store'])->name('admin.administrator.store');
    Route::get('admin/administrator/edit/{id}', [AdministratorController::class, 'edit'])->name('admin.administrator.edit');
    Route::put('admin/administrator/update/{id}', [AdministratorController::class, 'update'])->name('admin.administrator.update');
    Route::get('admin/administrator/delete/{id}', [AdministratorController::class, 'destroy'])->name('admin.administrator.delete');

    Route::get('admin/setting', [SettingController::class, 'index'])->name('admin.setting');
    Route::get('admin/setting/getListData', [SettingController::class, 'listData'])->name('admin.setting.list');
    Route::get('admin/setting/edit/{id}', [SettingController::class, 'edit'])->name('admin.setting.edit');
    Route::put('admin/setting/update/{id}', [SettingController::class, 'update'])->name('admin.setting.update');

});
