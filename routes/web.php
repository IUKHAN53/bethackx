<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/run-config-commands', function () {
    Artisan::call('storage:link');
    Artisan::call('view:cache');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    return redirect('/');
});

Route::get('/test', function () {
    return view('test');
});

Route::group(['prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
    Route::view('login', 'superadmin.login');
    Route::post('login', [SuperAdminController::class, 'login'])->name('login');
    Route::group(['middleware' => 'super-admin'], function () {
        Route::get('view', [SuperAdminController::class, 'index'])->name('view');
        Route::resource('users', App\Http\Controllers\SuperAdmin\UserController::class);
        Route::resource('companies', App\Http\Controllers\SuperAdmin\CompanyController::class);
        Route::resource('plans', App\Http\Controllers\SuperAdmin\PlanController::class);
        Route::resource('games', App\Http\Controllers\SuperAdmin\GameController::class);
        Route::resource('subscriptions', App\Http\Controllers\SuperAdmin\SubscriptionController::class);
        Route::post('logout', [SuperAdminController::class, 'logout'])->name('logout');
    });
});


Route::get('/offline', function () {
    return view('modules/laravelpwa/offline');
});
Route::group(['prefix' => '{company}'], function () {
    Route::group(['middleware' => 'verifyCompanySlug'], function () {
        Route::get('/create-user/{email}', [HomeController::class, 'createFreeUser'])->name('create-free-user');
        Route::view('/', 'welcome')->name('welcome');
        Route::group(['prefix' => 'admin'], function () {
            Route::view('login', 'admin.login');
            Route::post('login', [AdminController::class, 'login'])->name('admin.login');
            Route::group(['middleware' => ['admin']], function () {
                Route::get('admin-view', [AdminController::class, 'index'])->name('admin.view');
                Route::post('save-games', [AdminController::class, 'saveGames'])->name('admin.save-games');
                Route::post('save-external-links', [AdminController::class, 'saveExternalLinks'])->name('admin.save-external-links');
                Route::post('save-banner', [AdminController::class, 'saveBanner'])->name('admin.save-banner');
                Route::post('update-company', [AdminController::class, 'updateCompany'])->name('admin.update-company');
                Route::post('add-user', [AdminController::class, 'addUser'])->name('admin.add-user');
                Route::post('delete-user', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
                Route::post('search-user', [AdminController::class, 'searchUser'])->name('admin.search-user');
                Route::post('add-plan', [AdminController::class, 'addPlan'])->name('admin.add-plan');
                Route::post('delete-plan', [AdminController::class, 'deletePlan'])->name('admin.delete-plan');
                Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
                Route::post('fetch-games', [AdminController::class, 'getPlanGames'])->name('admin.fetch-games');
                Route::post('add-games-to-plan', [AdminController::class, 'addPlanGames'])->name('admin.add-games-to-plan');
                Route::post('fetch-plans', [AdminController::class, 'getUserPlans'])->name('admin.fetch-plans');
                Route::post('add-plan-to-users', [AdminController::class, 'addUserPlans'])->name('admin.add-plan-to-user');
            });
        });
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::group(['prefix' => 'user'], function () {
            Route::view('login', 'user.login');
            Route::post('login', [UserController::class, 'login'])->name('user.login');
            Route::group(['middleware' => ['auth']], function () {
                Route::get('user-view', [HomeController::class, 'index'])->name('user.view');
                Route::get('game/{id}', [HomeController::class, 'viewGame'])->name('user.view-game');
                Route::get('game/{id}/get-signal', [HomeController::class, 'getGameSignal'])->name('user.get-game-signal');
                Route::post('logout', [UserController::class, 'logout'])->name('user.logout');
            });
        });
    });
});
