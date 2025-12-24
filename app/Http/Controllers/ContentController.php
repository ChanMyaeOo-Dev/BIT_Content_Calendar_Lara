<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Models\Content;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::paginate(10);
        // dd($contents[0]->json_data);
        return view('contents.index', compact('contents'));
    }

    public function create()
    {
        return view('contents.create');
    }

    public function store(StoreContentRequest $request)
    {
        $content = new Content();
        $content->title = $request->title;
        $content->json_data = json_decode($request->json_data, true);
        $content->save();
        return redirect()->route('contents.index')
            ->with('toast', [
                'message' => 'Created successfully',
                'type' => 'success'
            ]);
    }

    public function show(Content $content)
    {
        //
    }

    public function edit(Content $content)
    {
        // dd($content->json_data);
        return view('contents.edit', compact('content'));
    }

    public function update(UpdateContentRequest $request, Content $content)
    {
        $content->title = $request->title;
        $content->json_data = json_decode($request->json_data, true);
        $content->update();
        return redirect()->route('contents.index')
            ->with('toast', [
                'message' => 'Updated successfully',
                'type' => 'success'
            ]);
    }

    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->back()
            ->with('toast', [
                'message' => 'Deleted successfully',
                'type' => 'success'
            ]);
    }

    public function viewer() {}
}
