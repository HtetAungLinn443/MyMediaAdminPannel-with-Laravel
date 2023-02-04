<?php

use App\Http\Controllers\AdminListController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendPostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    // admin
    Route::get('dashboard', [ProfileController::class, 'index'])->name('dashboard');
    Route::post('admin/update/{id}', [ProfileController::class, 'updateAdminAccount'])->name('admin#update');
    Route::get('admin/changePasswordPage', [ProfileController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('admin/changePassword', [ProfileController::class, 'changePassword'])->name('admin#changePassword');

    // admin list
    Route::get('admin/list', [AdminListController::class, 'index'])->name('admin#list');
    Route::get('admin/delete/{id}', [AdminListController::class, 'accountDelete'])->name('admin#accountDelete');
    Route::post('admin/listSearch', [AdminListController::class, 'adminListSearch'])->name('admin#listSearch');

    //category
    Route::get('category', [CategoryController::class, 'index'])->name('admin#category');
    Route::post('category/create', [CategoryController::class, 'categoryCreate'])->name('admin#categoryCreate');
    Route::get('caetgory/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('admin#categoryDelete');
    Route::post('category/search', [CategoryController::class, 'categorySearch'])->name('admin#categorySearch');
    Route::get('category/editPage/{id}', [CategoryController::class, 'categoryEditPage'])->name('category#editPage');
    Route::post('category/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category#edit');

    //Post
    Route::get('post', [PostController::class, 'index'])->name('admin#post');
    Route::post('post/create', [PostController::class, 'postCreate'])->name('admin#postCreate');
    Route::get('post/delete/{id}', [PostController::class, 'postDelete'])->name('admin#postDelete');
    Route::get('post/editPage/{id}', [PostController::class, 'postEditPage'])->name('admin#postEditPage');
    Route::post('post/edit/{id}', [PostController::class, 'editPost'])->name('admin#editPost');

    //trend post
    Route::get('trendPost', [TrendPostController::class, 'index'])->name('admin#trendPost');
    Route::get('trendPost/details/{id}', [TrendPostController::class, 'trendPostDetails'])->name('admin#trendPostDetails');

});