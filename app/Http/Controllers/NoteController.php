<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userId = auth()->user();
        $notes = Note::whereBelongsTo($userId)->latest('updated_at')->paginate(5);
        return view('notes.index',
    ['notes'=>$notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $attributes = $request->validate([
            'title'=> 'required|max:255',
            'text'=> 'required',
        ]);
        $attributes['uuid']=Str::uuid();
        auth()->user()->notes()->create($attributes);
        return redirect('notes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
        if(!$note->user->is(auth()->user())){
            return abort(403);
        }
        return view('notes.show', [
            'note'=>$note
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
        if($note->user_id != auth()->user()->id){
            return abort(403);
        }
        return view('notes.edit', [
            'note'=>$note
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
        if($note->user_id != auth()->user()->id){
            return abort(403);
        }
        $attributes = $request->validate([
            'title'=> 'required|max:255',
            'text'=> 'required',
        ]);
        $note->update($attributes);
        return redirect()->route('notes.show',$note)->with('success', 'Note updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
        if($note->user_id != auth()->user()->id){
            return abort(403);
        }
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Note moved to trash.');;

    }
}
