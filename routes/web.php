<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('test');
});
Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [\App\Http\Controllers\User\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'admin'], function () {
    Route::view('login', 'admin.login');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('admin-view', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.view');
        Route::post('save-games', [\App\Http\Controllers\Admin\AdminController::class, 'saveGames'])->name('admin.save-games');
        Route::post('save-external-links', [\App\Http\Controllers\Admin\AdminController::class, 'saveExternalLinks'])->name('admin.save-external-links');
        Route::post('save-banner', [\App\Http\Controllers\Admin\AdminController::class, 'saveBanner'])->name('admin.save-banner');
        Route::post('update-company', [\App\Http\Controllers\Admin\AdminController::class, 'updateCompany'])->name('admin.update-company');
        Route::post('add-user', [\App\Http\Controllers\Admin\AdminController::class, 'addUser'])->name('admin.add-user');
        Route::post('search-user', [\App\Http\Controllers\Admin\AdminController::class, 'searchUser'])->name('admin.search-user');
    });
});
Route::group(['prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::view('login', 'superadmin.login')->name('login');
    Route::group(['middleware' => 'super-admin'], function () {
        Route::get('view', [\App\Http\Controllers\SuperAdmin\SuperAdminController::class, 'index'])->name('view');
        Route::resource('users', App\Http\Controllers\SuperAdmin\UserController::class);
        Route::resource('companies', App\Http\Controllers\SuperAdmin\CompanyController::class);
        Route::resource('plans', App\Http\Controllers\SuperAdmin\PlanController::class);
        Route::resource('games', App\Http\Controllers\SuperAdmin\GameController::class);
        Route::resource('subscriptions', App\Http\Controllers\SuperAdmin\SubscriptionController::class);
    });
});
Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('user-view', [\App\Http\Controllers\User\UserController::class, 'index'])->name('user.view');
        Route::get('game/{id}', [\App\Http\Controllers\User\HomeController::class, 'viewGame'])->name('user.view-game');
        Route::get('game/{id}/get-signal', [\App\Http\Controllers\User\HomeController::class, 'getGameSignal'])->name('user.get-game-signal');
    });
});

Route::get('/offline', function () {
    return view('modules/laravelpwa/offline');
});
Auth::routes();
