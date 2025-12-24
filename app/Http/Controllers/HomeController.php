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
}
