<?php

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

use App\Http\Controllers\API\ActionLogController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('user/login', [AuthController::class, 'login']);
Route::post('user/register', [AuthController::class, 'register']);

Route::get('category', [AuthController::class, 'categoryList'])->middleware('auth:sanctum');

// Post
Route::get('allPost', [PostController::class, 'allPost']);
// Post Search
Route::post('post/search', [PostController::class, 'postSearch']);
Route::post('details', [PostController::class, 'postDetails']);

// Category
Route::get('allCategory', [CategoryController::class, 'getAllCategory']);
// Category Search
Route::post('category/search', [CategoryController::class, 'categorySearch']);

// Action Log
Route::post('post/actionLog', [ActionLogController::class, 'setActionLog']);