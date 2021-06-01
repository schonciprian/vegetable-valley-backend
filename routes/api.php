<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\City\CityController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Garden\FilledCellsController;
use App\Http\Controllers\Garden\AvailableGardensController;
use App\Http\Controllers\TagController;
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

Route::get('/get-user-gardens', [AvailableGardensController::class, 'getUserGardens'])->middleware('auth:sanctum');
Route::get('/get-garden-name', [AvailableGardensController::class, 'getGardenName'])->middleware('auth:sanctum');
Route::get('/get-garden-size', [AvailableGardensController::class, 'getGardenSize'])->middleware('auth:sanctum');
Route::put('/update-garden-size', [AvailableGardensController::class, 'updateGardenSize'])->middleware('auth:sanctum');
Route::post('/add-new-garden', [AvailableGardensController::class, 'addNewGarden'])->middleware('auth:sanctum');
Route::put('/update-garden-name', [AvailableGardensController::class, 'updateGardenName'])->middleware('auth:sanctum');
Route::delete('/remove-garden', [AvailableGardensController::class, 'removeGarden'])->middleware('auth:sanctum');

Route::put('/remove-column', [AvailableGardensController::class, 'removeColumn'])->middleware('auth:sanctum');
Route::put('/add-column', [AvailableGardensController::class, 'addColumn'])->middleware('auth:sanctum');
Route::put('/remove-row', [AvailableGardensController::class, 'removeRow'])->middleware('auth:sanctum');
Route::put('/add-row', [AvailableGardensController::class, 'addRow'])->middleware('auth:sanctum');

Route::get('/get-searched-city', [CityController::class, 'getSearchedCities'])->middleware('auth:sanctum');
Route::post('/save-searched-city', [CityController::class, 'saveSearchedCity'])->middleware('auth:sanctum');
Route::delete('/remove-searched-city', [CityController::class, 'removeSearchedCity'])->middleware('auth:sanctum');

Route::get('/get-images', [GalleryController::class, 'getUserImages'])->middleware('auth:sanctum');
Route::post('/save-image', [GalleryController::class, 'saveUserImage'])->middleware('auth:sanctum');
Route::delete('/remove-image', [GalleryController::class, 'removeUserImage'])->middleware('auth:sanctum');

Route::get('/get-tags', [TagController::class, 'getTags'])->middleware('auth:sanctum');
Route::post('/save-tag', [TagController::class, 'saveTag'])->middleware('auth:sanctum');
Route::post('/save-tag-to-image', [TagController::class, 'saveTagToImage'])->middleware('auth:sanctum');
