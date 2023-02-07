<?php

use App\Http\Controllers\{
    SubscriptionController,
    PostController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('websites/{website}')->group(function () {
    Route::post('subscribe', [SubscriptionController::class, 'store']);

    Route::post('posts', [PostController::class, 'store']);
});
