<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Garden\FilledCellsController;
use App\Http\Controllers\Garden\AvailableGardensController;
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
Route::get('/get-user-data', [UserController::class, 'getUserBasic'])->middleware('auth:sanctum');
Route::put('/update-user-data', [UserController::class, 'updateUser'])->middleware('auth:sanctum');
Route::put('/update-user-password', [UserController::class, 'updatePassword'])->middleware('auth:sanctum');
Route::delete('/delete-user', [UserController::class, 'deleteUser'])->middleware('auth:sanctum');

Route::get('/garden', [FilledCellsController::class, 'index'])->middleware('auth:sanctum');
Route::post('/garden', [FilledCellsController::class, 'store'])->middleware('auth:sanctum');
Route::delete('/garden', [FilledCellsController::class, 'delete'])->middleware('auth:sanctum');

Route::get('/get-garden-size', [AvailableGardensController::class, 'getGardenSize'])->middleware('auth:sanctum');
Route::put('/update-garden-size', [AvailableGardensController::class, 'updateGardenSize'])->middleware('auth:sanctum');
