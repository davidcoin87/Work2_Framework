<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

Route::get('category/all', [CategoryController::class, 'getAll']);
Route::get('category/{id}/getById', [CategoryController::class, 'getById']);
Route::post('category/store', [CategoryController::class, 'store']);
Route::put('category/{id}/update', [CategoryController::class, 'update']);
Route::delete('category/{id}/destroy', [CategoryController::class, 'destroy']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
