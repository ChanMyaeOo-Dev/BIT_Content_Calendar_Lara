<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function  index()
    {
        $content = Content::latest()->first();
        return view('home', compact('content'));
    }
}
