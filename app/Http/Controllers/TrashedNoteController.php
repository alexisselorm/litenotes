<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class TrashedNoteController extends Controller
{
    //
    public function index(){
        $userId = auth()->user();
        $notes = Note::whereBelongsTo($userId)->onlyTrashed()->latest('updated_at')->paginate(5);
        return view('notes.index',
    ['notes'=>$notes]);
    }

    public function show(Note $note){
        if(!$note->user->is(auth()->user())){
            return abort(403);
        }
        return view('notes.show',
    ['note'=>$note]);
    }
    public function update(Note $note){
        if(!$note->user->is(auth()->user())){
            return abort(403);
        }
        $note->restore();
        return redirect()->route('notes.show')->with('success', 'Note restored successfully!');
    }
    public function destroy(Note $note){
        if(!$note->user->is(auth()->user())){
            return abort(403);
        }
        $note->forceDelete();

        return redirect()->route('trashed.index')->with('success', 'Note deleted forever!');

    }
}
