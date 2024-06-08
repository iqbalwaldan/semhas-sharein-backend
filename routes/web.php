<?php

use App\Http\Controllers\Client\AuthController as UserAuthController;
use App\Http\Controllers\Client\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Client\DashboardController as UserDashboardController;
use App\Http\Controllers\Client\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Client\AutoPostController;
use App\Http\Controllers\Client\GroupPostController;
use App\Http\Controllers\Client\LoginMultiAccountController;
use App\Http\Controllers\Client\ManageScheduleController;
use App\Http\Controllers\Client\ReminderController;
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
});

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        // Admin routes
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [UserAuthController::class, 'logout'])->name('admin.logout');
    });
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/group-post', [GroupPostController::class, 'index'])->name('user.group-post');
    Route::get('/auto-post', [AutoPostController::class, 'index'])->name('user.auto-post');
    Route::post('/post', [AutoPostController::class, 'post'])->name('user.auto-post.post');


    Route::get('/reminder', [ReminderController::class, 'index'])->name('user.reminder');
    Route::get('/manage-schedule', [ManageScheduleController::class, 'index'])->name('user.manage-schedule');
    Route::get('/login-multi-account', [LoginMultiAccountController::class, 'index'])->name('user.login-multi-account');
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
});


Route::get('/get-facebook-data', [AutoPostController::class, 'getFacebookData'])->name('get.facebook.data');
