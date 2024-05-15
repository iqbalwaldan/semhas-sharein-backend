<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Telegram\Bot\Laravel\Facades\Telegram;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function(){
    // Login Route
    Route::controller(LoginController::class)->group(function(){
        Route::post('/login', 'login');
        Route::post('/logout', 'logout');
    });
});

Route::middleware('auth')->group(function(){
    Route::controller(LoginController::class)->group(function(){
        Route::post('/logout', 'logout');
    });
    
});

Route::namespace('App\Http\Controllers')->group(function () {
    //Auth Routes
    // Route::post('/login', 'Auth\LoginController@login')
    //     ->middleware('guest')
    //     ->name('login');
    Route::post('/register', 'Auth\RegisterController@register')
        ->middleware('guest')
        ->name('register');
    // Route::post('/logout', 'Auth\LoginController@logout')
    //     ->middleware('auth')
    //     ->name('logout');

    //Verify Email Routes
    Route::group(['prefix' => 'email-verification'], function () {
        Route::get('/{id}/{hash}', 'Auth\EmailVerificationController@sendVerification')
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');
        Route::post('/resend', 'Auth\EmailVerificationController@resendVerification')
            ->middleware(['throttle:6,1'])
            ->name('verification.resend');
    });

    //Forgot Password Routes
    Route::post('/forgotPassword', 'Auth\ResetPasswordController@sendingResetPassword')
        ->middleware('guest')
        ->name('password.sending');
    Route::get('/resetPassword/{token}', 'Auth\ResetPasswordController@getResetToken')
        ->middleware('guest')
        ->name('password.reset_token');
    Route::post('/resetPassword', 'Auth\ResetPasswordController@resetPassword')
        ->middleware('guest')
        ->name('password.reset');

    //Google oAuth Routes
    Route::group(['middleware' => ['web'], 'prefix' => 'auth'], function () {
        Route::group(['prefix' => 'google'], function () {
            Route::get('/redirect', 'Auth\GoogleAuthController@googleRedirect')
                ->name('google-auth');
            Route::get('/call-back', 'Auth\GoogleAuthController@googleCallback')
                ->name('google-auth-callback');
        });
    });

    //Newsletter Routes
    Route::post('/newsletter', 'API\NewsletterController@store')
        ->name('newsletter.store');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::namespace('App\Http\Controllers')->group(function () {
        Route::get('/users', function (Request $request) {
            return $request->user();
        });

        Route::get('/user', 'Auth\LoginController@index')
            ->middleware('auth')
            ->name('user');

        //Dashboard Needs Routes
        Route::get('/list-accounts', 'API\DashboardController@listAccounts')
            ->name('dashboard.list-accounts');

        //Newsletter Routes
        Route::get('/newsletter', 'API\NewsletterController@index')
            ->name('newsletter.index');
        Route::post('/send-newsletter', 'API\NewsletterController@sendNewsletter')
            ->name('newsletter.sendNewsletter');

        //Reminder Routes
        Route::post('reminder', 'API\ReminderController@createReminder')
            ->name('reminder.create');
        Route::get('/check-reminder', 'API\ReminderController@checkReminder')
            ->name('reminder.check');

        //OpenAI Routes
        Route::group(['prefix' => 'open-ai'], function () {
            Route::get('generate', 'API\OpenAIController@openAIGenerate')
                ->name('open-api_generate');
        });

        //Facebook Auth Routes
        Route::group(['middleware' => ['web'], 'prefix' => 'auth/facebook'], function () {
            Route::get('/redirect', 'Auth\FacebookAuthController@facebookRedirect')
                ->name('facebook-auth');
            Route::get('/call-back', 'Auth\FacebookAuthController@facebookCallback')
                ->name('facebook-auth-callback');
        });

        //Manage Schedule Routes
        Route::group(['prefix' => 'manage-schedule'], function () {
            Route::get('/schedule', 'API\ManageScheduleController@getAllSchedule')
                ->name('post.index');
            Route::post('/schedule', 'API\ManageScheduleController@storeSchedule')
                ->name('post.create');
            Route::post('/scheduled-post', 'API\ManageScheduleController@postToGroup')
                ->name('post.group-post');
            Route::get('/edit-schedule', 'API\ManageScheduleController@editSchedule')
                ->name('post.edit');
            Route::post('/update-schedule', 'API\ManageScheduleController@updateSchedule')
                ->name('post.update');
            Route::delete('/schedule/{id}', 'API\ManageScheduleController@deleteSchedule')
                ->name('post.delete');
        });

        //Group Post Routes
        Route::group(['prefix' => 'group-post'], function () {
            Route::get('/groups', 'API\GroupPostController@getGroups')
                ->name('group-post_groups');
            Route::post('/direct-post', 'API\GroupPostController@postToGroup')
                ->name('group-post_direct-post');
        });

        //Subscription Routes
        Route::group(['prefix' => 'subscription'], function () {
            Route::post('subscribe', 'API\SubscriptionController@subscribe')
                ->name('subscription_subscribe');
            Route::post('subscribe-callback', 'API\SubscriptionController@subscribe_callback')
                ->name('subscription_subscribe-callback');
        });
    });
});