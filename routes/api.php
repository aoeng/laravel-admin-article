<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware('api')->group(function () {
    Route::get('articles', [Aoeng\Laravel\Admin\Article\Http\Controllers\ArticleController::class, 'index']);
    Route::get('articles/show', [Aoeng\Laravel\Admin\Article\Http\Controllers\ArticleController::class, 'show']);
});

Route::post('editor/upload', [Aoeng\Laravel\Admin\Article\Http\Controllers\ArticleController::class, 'upload']);
