<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/test', function () {
    return view('test');
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'admin'], function () {
    Route::view('login', 'admin.login');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('admin-view', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.view');
        Route::post('save-games', [\App\Http\Controllers\Admin\AdminController::class, 'saveGames'])->name('admin.save-games');
        Route::post('save-external-links', [\App\Http\Controllers\Admin\AdminController::class, 'saveExternalLinks'])->name('admin.save-external-links');
        Route::post('save-banner', [\App\Http\Controllers\Admin\AdminController::class, 'saveBanner'])->name('admin.save-banner');
    });
});
Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::group(['middleware' => ['user']], function () {
        Route::get('user-view', [\App\Http\Controllers\User\UserController::class, 'index'])->name('view');
    });
});

Route::get('/offline', function () {
    return view('modules/laravelpwa/offline');
});
Auth::routes();
