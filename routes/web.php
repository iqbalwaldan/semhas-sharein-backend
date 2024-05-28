<?php

use App\Http\Controllers\Client\AuthController;
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
});

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

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register']);
Route::get('/forgot-password', [AuthController::class, 'forgotPassword']);
