<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Participant;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    #Personal Details routes
    Route::get('participant/register', [Participant::class, 'retrieve'])
        ->name('register');
    Route::post('participant/register', [Participant::class, 'proceed']);

    #Confirm ID routes
    Route::get('participant/register/page2', [Participant::class, 'confirmpage']);
    Route::post('participant/register/page2', [Participant::class, 'confirm'])->name('confirm');

    #Participant login routes
    Route::get('participant/login', [Participant::class, 'loginpage'])->name('login');
    Route::post('participant/login', [Participant::class, 'login']);

    #Admin Login routes
    Route::get('admin/Login', [Admin::class, 'loginpage'])->name('adm');
    Route::post('admin/Login', [Admin::class, 'login']);
});

Route::middleware('participant')->group(function () {

    #Course Details routes
    Route::get('participant/register/page3', [Participant::class, 'course']);
    Route::post('participant/register/page3', [Participant::class, 'submit_c'])->name('course');

    #Work_Profile routes
    Route::get('participant/register/page4', [Participant::class, 'work_profile'])->name('work');
    Route::post('participant/register/page4', [Participant::class, 'submit_wp']);

    #Hospital Details routes
    Route::get('participant/register/page5', [Participant::class, 'med_details'])->name('med');
    Route::post('participant/register/page5', [Participant::class, 'submit_md']);

    #NOK routes
    Route::get('participant/register/page6', [Participant::class, 'kin'])->name('kin');
    Route::post('participant/register/page6', [Participant::class, 'submit_kin']);

    #Dashboard routes
    Route::get('participant/dashboard', [Participant::class, 'viewDashboard'])->name('check_in');
    Route::post('participant/dashboard', [Participant::class, 'check_in']);

    #Waitarea routes
    Route::get('participant/dashboard/wait', [Participant::class, 'waitarea']);

    #Checkout routes
    Route::put('participant/dashboard/Checkout/{id}', [Participant::class, 'checkout']);

    #Participant Logout route
    Route::post('participant/logout', [Participant::class, 'destroy'])
        ->name('partlogout');
});

Route::middleware('admin')->group(function () {

    #Admin Dashboard routes
    Route::get('admin/dashboard', [Admin::class, 'AdmDashboard']);

    #Admin Checkin routes
    Route::get('admin/Checkins', [Admin::class, 'Checkins']);

    #Admin Allocate routes
    Route::get('admin/Checkins/allocate/{id}', [Admin::class, 'Checkinpart']);
    Route::put('allocate/{id}', [Admin::class, 'allocate']);

    #Admin Checkout routes
    Route::get('admin/Checkouts', [Admin::class, 'Checkouts']);

    #Admin Checkout allocation routes
    Route::put('admin/confirmCheckout/{id}', [Admin::class, 'checkoutby']);

    #Admin Logout route
    Route::post('admin/logout', [Admin::class, 'destroy'])
        ->name('adminlogout');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
