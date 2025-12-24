<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ContentViewer extends Model
{
    public function index()
    {
        return view('content_viewer.index');
    }
    public function detail(Request $request)
    {
        $rawText = $request->raw_text;
        $sections = ['၅။', '၆။'];
        $result = [];
        foreach ($sections as $index => $current) {
            $next = $sections[$index + 1] ?? null;
            if ($next) {
                $pattern = "/###\s*{$current}[\s\S]*?(?=###\s*{$next})/u";
            } else {
                $pattern = "/###\s*{$current}[\s\S]*/u";
            }
            if (preg_match($pattern, $rawText, $match)) {
                $result[] = cleanMarkdown(trim($match[0]));
            }
        }
        return view('content_viewer.detail', compact('result'));
    }
}
