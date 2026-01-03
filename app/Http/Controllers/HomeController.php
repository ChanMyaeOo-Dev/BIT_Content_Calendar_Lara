<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function  index()
    {
        $content = Content::orderBy('id', 'desc')->first();
        return view('home', compact('content'));
    }

    public function prompt_generator()
    {
        return view('prompt_generator');
    }
    public function time_table()
    {
        return view('time_table');
    }
}
