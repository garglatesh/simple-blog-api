<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/**
 * Group of routes related to the Post resource.
 */

Route::group(['prefix' => 'posts'], function () {
    /**
     * Get a list of all posts.
     */
    Route::get('/', [PostController::class, 'index']);
    /**
     * Get a specific post by ID.
     */
    Route::get('/{id}', [PostController::class, 'show']);
});
