<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index() 
    {
        return response()->json(['posts' => Post::all()]);
    }

    public function show(string $id) 
    {
        return response()->json(['post' => Post::find($id)]);
    }
}
