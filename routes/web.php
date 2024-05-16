<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/{path}', function () {
    return view('template');
})->where('path', '.*');