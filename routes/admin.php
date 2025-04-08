<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Auth')->group(function () {
    Route::controller('LoginController')->group(function () {
        Route::get('/', 'showLoginForm')->name('login');
        Route::post('/', 'login')->name('login');
        Route::get('logout', 'logout')->name('logout');
    });

    // Admin Password Reset
    Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function () {
        Route::get('reset', 'index')->name('reset');
        Route::post('reset', 'sendResetEmail')->name('sendResetEmail');
        Route::get('code-verify', 'codeVerify')->name('code.verify');
        Route::post('verify-code', 'verifyCode')->name('verify.code');
    });

    Route::controller('PasswordResetController')->prefix('password')->name('password.')->group(function () {
        Route::get('reset/{token}', 'showResetForm')->name('reset.form');
        Route::post('reset/change', 'reset')->name('change');
    });
});

Route::middleware('admin')->group(function () {
    // Admin Controller
    Route::controller('AdminController')->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('profile', 'profile')->name('profile');
        Route::put('profile', 'profileUpdate')->name('profile.update');
        Route::get('password', 'password')->name('password');
        Route::post('password', 'passwordUpdate')->name('password.update');
    });

    // App Password
    Route::controller('PasswordManagerController')->name('app.')->group(function () {
        Route::get('appPass', 'index')->name('index');
        Route::get('appPass/create', 'create')->name('create');
        Route::post('appPass/store', 'store')->name('store');
        Route::get('appPass/{id}/show', 'show')->name('show');
        Route::get('appPass/{id}/edit', 'edit')->name('edit');
        Route::put('appPass/{id}/update', 'update')->name('update');
        Route::delete('appPass/{id}/delete', 'destroy')->name('destroy');
        Route::post('appPass/verify', 'verifyAppPassword')->name('verifyAppPassword');
        Route::get('appPass/search', 'search')->name('search');
    });

    // General Setting
    Route::controller('GeneralSettingController')->name('setting.')->group(function () {
        Route::get('general-setting', 'index')->name('index');
        Route::post('general-setting', 'update')->name('update');
        Route::get('setting/logo-icon', 'logoIcon')->name('logo.icon');
        Route::post('setting/logo-icon', 'logoIconUpdate')->name('logo.icon.update');
    });
});