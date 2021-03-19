<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'store']);
Route::delete('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/get-user-data', [UserController::class, 'getUser'])->middleware('auth:sanctum');
Route::put('/update-user-data', [UserController::class, 'updateUser'])->middleware('auth:sanctum');
Route::delete('/delete-user', [UserController::class, 'deleteUser'])->middleware('auth:sanctum');
