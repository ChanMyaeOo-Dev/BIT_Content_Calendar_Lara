<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function  index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->paginate(10);
        return view('posts.index', compact('posts'));
        // $content = Content::orderBy('id', 'desc')->first();
        // return view('home', compact('content'));
    }

    public function prompt_generator()
    {
        return view('prompt_generator');
    }

    public function image_prompt_knowledge()
    {
        return view('image_prompt_knowledge');
    }

    public function image_prompt_ads()
    {
        return view('image_prompt_ads');
    }

    public function image_styles()
    {
        return view('image_styles');
    }
    public function time_table()
    {
        return view('time_table');
    }
}
