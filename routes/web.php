<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::get('/{path}', function () {
    return view('template');
})->where('path', '.*');