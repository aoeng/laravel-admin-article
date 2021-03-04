<?php

Route::resource('articles', \Aoeng\Laravel\Admin\Article\Admin\Controllers\ArticleController::class);
Route::resource('article-types', \Aoeng\Laravel\Admin\Article\Admin\Controllers\ArticleTypeController::class);

