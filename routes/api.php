<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\AdminController;

Route::apiResource('posts', PostsController::class);
Route::apiResource('admin', AdminController::class);