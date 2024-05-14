<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    
    /**
     * index
     *
     * @return void
     */
    public function index() 
    {
        return response()->json(['categories' => Category::all()]);
    }
}
