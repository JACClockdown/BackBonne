<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EndPoints\ZipCodes;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});


Route::group([
    'middleware' => 'api',
], function () {
    Route::get('zip-codes', [ZipCodes::class, 'index']);
    Route::post('zip-code/code', [ZipCodes::class, 'store']);
    Route::get('zip-codes/{zip_code}', [ZipCodes::class,'show']);
    Route::get('import/data', [ZipCodes::class,'dropzoneFile']);
});