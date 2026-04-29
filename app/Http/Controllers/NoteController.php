<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::orderBy('updated_at', 'desc')->paginate(10);
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(StoreNoteRequest $request)
    {
        $note = new Note();
        $note->title = $request->title;
        $note->body = $request->body;
        $note->save();

        return redirect()->route('notes.index')
            ->with('toast', [
                'message' => 'Created successfully',
                'type' => 'success',
            ]);
    }

    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    public function update(UpdateNoteRequest $request, Note $note)
    {
        $note->title = $request->title;
        $note->body = $request->body;
        $note->update();

        return response()->json([
            'status' => true,
            'toast' => [
                'message' => 'Note updated successfully',
                'type' => 'success',
            ],
        ]);
    }

    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->back()
            ->with('toast', [
                'message' => 'Deleted successfully',
                'type' => 'success',
            ]);
    }
}

