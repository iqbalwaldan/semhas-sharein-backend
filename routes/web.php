<?php

use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\Client\AuthController as UserAuthController;
use App\Http\Controllers\Client\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Client\DashboardController as UserDashboardController;
use App\Http\Controllers\Client\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Client\AutoPostController;
use App\Http\Controllers\Client\GroupPostController;
use App\Http\Controllers\Client\FacebookAccountController;
use App\Http\Controllers\Client\ManageScheduleController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\ReminderController;
use App\Http\Controllers\Client\SocialAuthController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/newsletter', function () {
    return view('newsletter');
});

Route::namespace('App\Http\Controllers')->group(function () {
    Route::group(['prefix' => 'telegram'], function () {
        Route::get('messages', 'API\ReminderController@messages')
            ->name('messages');
        Route::get('messages/{id}', 'API\ReminderController@sendMessage')
            ->name('sendMessage');

        Route::get('/getMe', 'API\ReminderController@getMe')
            ->name('getMe');

        Route::get('set-webhook', 'API\ReminderController@setWebhook');
        // Route::get('webhook/{token}', 'API\ReminderController@webhook');
        // Route::post('webhook/{token}', 'API\ReminderController@webhook');
        Route::match(['get', 'post'], 'webhook/{token}', 'API\ReminderController@webhook');
    });
});

// Route::get('redirect', [LoginController::class,'redirect'])->name('redirect');



Route::middleware('guest')->group(function () {
    Route::get('/login', [UserAuthController::class, 'indexLogin'])->name('user.login');
    // Route::get('/admin/login', [AdminAuthController::class, 'indexLogin'])->name('admin.login');

    Route::get('/register', [UserAuthController::class, 'indexRegister'])->name('user.register');

    Route::post('/login', [UserAuthController::class, 'login'])->name('user.loginPost');
    // Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.loginPost');

    Route::post('/register', [UserAuthController::class, 'register'])->name('user.registerPost');
    Route::get('/forgot-password', [UserAuthController::class, 'indexForgotPassword'])->name('user.forgot-password');
    Route::post('/forgot-password', [UserAuthController::class, 'sendResetLink'])->name('user.reset-link-password');

    Route::get('/reset-password/{token}', [UserAuthController::class, 'indexResetPassword'])->name('user.reset-password');
    Route::post('/reset-password', [UserAuthController::class, 'resetPassword'])->name('user.update-password');
});

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        // Admin routes
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [UserAuthController::class, 'logout'])->name('admin.logout');
    });
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/dashboard/getFacebookData', [UserDashboardController::class, 'getFacebookData'])->name('user.dashboard.getFacebookData');
    Route::get('/dashboard/schedules', [UserDashboardController::class, 'schedule'])->name('user.dashboard.shcedule');
    Route::get('/dashboard/reminders', [UserDashboardController::class, 'reminder'])->name('user.dashboard.reminder');
    Route::get('/group-post', [GroupPostController::class, 'index'])->name('user.group-post');
    Route::resource('/auto-post', AutoPostController::class)->names('user.auto-post');
    // Route::post('/post', [AutoPostController::class, 'post'])->name('user.auto-post.post');


    Route::resource('/reminder', ReminderController::class)->names('user.reminder');
    Route::resource('/profile', ProfileController::class)->names('user.profile');
    Route::resource('/manage-schedule', ManageScheduleController::class)->names('user.manage-schedule');
    Route::resource('/facebook-account', FacebookAccountController::class)->names('user.facebook-account');
    Route::get('/update-cookies', [FacebookAccountController::class, 'updateCookies'])->name('user.facebook-account.updateCookies');
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
});

// Daftar route cronjob
Route::get('/post-schedule', [AutoPostController::class, 'schedulePost'])->name('schedule.post');
Route::get('/send-reminder', [ReminderController::class, 'sendReminder'])->name('reminder.send');

Route::get('/get-facebook-data', [AutoPostController::class, 'getFacebookData'])->name('get.facebook.data');
Route::get('/email-verification/success', [UserAuthController::class, 'emailVerificationSuccess'])->name('email-verification.success');
Route::get('/email-verification/already-success', [UserAuthController::class, 'emailVerificationAlreadySuccess'])->name('email-verification.Alreadysuccess');
Route::get('/email-verification/process', [UserAuthController::class, 'emailVerificationProcess'])->name('email-verification.process');
Route::get('/email-verification/resend', [UserAuthController::class, 'resendEmailVerification'])->name('email-verification.resend');
Route::get('/token', [UserDashboardController::class, 'fetchFacebookData']);

Route::get('/auth/facebook', [SocialAuthController::class, 'redirectToProvider'])->name('auth.facebook');
Route::get('/auth/facebook/call-back', [SocialAuthController::class, 'handleProviderCallback'])->name('auth.facebook.callback');
