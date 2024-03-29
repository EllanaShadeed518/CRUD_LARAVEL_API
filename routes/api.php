<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//crud
Route::get('/posts',[ PostController::class,'index']);
Route::get('/posts/show/{id}',[ PostController::class,'show'])->middleware('auth:sanctum');
Route::post('/posts/store',[ PostController::class,'store'])->middleware('auth:sanctum');
Route::put('/posts/update/{id}',[ PostController::class,'update'])->middleware('auth:sanctum');
Route::delete('/posts/delete/{id}',[ PostController::class,'delete'])->middleware('auth:sanctum');
//Auth
Route::post('/user/register',[ AuthController::class,'register']);
Route::post('/user/login',[ AuthController::class,'login']);
Route::post('/user/logout',[ AuthController::class,'logout'])->middleware('auth:sanctum');//you should add middleware auth:sanctum beacuse logout work  when user login ,if user have token
