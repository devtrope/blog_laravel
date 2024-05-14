<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostEditRequest;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    
    /**
     * index
     *
     * @return void
     */
    public function index() 
    {
        return response()->json(['posts' => Post::with('category')->orderBy('id', 'DESC')->get()]);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(PostRequest $request) 
    {
        $datas = $request->validated();

        $content = $request->validated('content');
        $datas['content'] = nl2br($content);

        $image = $request->validated('picture');
        $datas['picture'] = $image->store('posts', 'public');

        Post::create($datas);

        return response()->json(['success' => true]);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show(string $id) 
    {
        $post = Post::with('category')->find($id);

        return response()->json([
            'post' => $post,
            'similars' => Post::where('category_id', $post->category->id)->where('id', '!=', $post->id)->limit(3)->get()
        ]);
    }
    
    /**
     * update
     *
     * @param  mixed $id
     * @param  mixed $request
     * @return void
     */
    public function update(string $id, PostEditRequest $request) 
    {
        $post = Post::find($id);
        $datas = $request->validated();

        $content = $request->validated('content');
        $datas['content'] = nl2br($content);

        $image = $request->validated('picture');
        $datas['picture'] = ($image !== null) ? $image->store('posts', 'public') : $post->picture;

        //Suppression de l'ancienne image
        if ($image !== null)
            Storage::disk('public')->delete($post->picture);

        $post->update($datas);

        return response()->json(['success' => true]);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        Storage::disk('public')->delete($post->picture);
        $post->delete();
    }
}
