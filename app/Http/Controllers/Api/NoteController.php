<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    //index
    public function index(Request $request)
    {
        //note by user
        $notes = Note::where('user_id', $request->user()->id)->orderBy('id', 'desc')->get();
        return response([
            'message' => 'Data retrieved successfully.',
            'status' => 'success',
            'notes' => $notes
        ], 200);
    }

    //create
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'note' => 'required',
        ]);

        $note = new Note();
        $note->user_id = $request->user()->id;
        $note->title = $request->title;
        $note->note = $request->note;
        $note->save();

        return response([
            'note' => $note,
            'message' => 'Data created successfully.',
            'status' => 'success'
        ], 201);
    }
}
