<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->slide_json_data = json_decode($request->slide_json_data, true);
        $post->save();
        return redirect()->route('posts.index')
            ->with('toast', [
                'message' => 'Created successfully',
                'type' => 'success'
            ]);
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->body = $request->body;
        $post->slide_json_data = json_decode($request->slide_json_data, true);
        $post->update();

        return response()->json([
            'status' => true,
            'toast' => [
                'message' => 'Post updated successfully',
                'type' => 'success',
            ],
        ]);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()
            ->with('toast', [
                'message' => 'Deleted successfully',
                'type' => 'success'
            ]);
    }
}
