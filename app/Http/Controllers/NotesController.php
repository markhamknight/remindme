<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\User;
use Auth;
use App\Http\Requests;
use App\Reminder;
class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $notes;
    function __construct(Note $notes)
    {
        $this->notes = $notes;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        flash()->success('Note Added');
        $this->validate($request,[
            'title' => 'required',
            'body'  => 'required'
        ]);
       $id = $this->notes->insertGetId([
            'title' =>  strip_tags($request->title),
            'body'  =>  strip_tags($request->body),
            'reminder_id' => $request->reminder_id,
            'user_id'  => Auth::user()->id
        ]);
        $title = strip_tags($request->title);
        $body = strip_tags($request->body);
        $user_id = $this->notes->where('id',$id)->pluck('user_id')[0];
        $username = User::where('id',$user_id)->pluck('username')[0];
        $new =  "<div class='panel panel-default' id='note_".$id."'>".
                "<div class='panel-heading'><h4 class='panel-title'>".
                "<a data-toggle='collapse' data-parent='#accordion' href='#".$id."'>".$title."</a>".
                "<span class='pull-right'><small>by </small><span><a href='/users/".$user_id."' >".$username."</a></span></span></h4></div>".
                "<div class='panel-collapse collapse' id='".$id."'><div class='panel-body'>".$body."</div>".
                "<div class=panel-footer><a href='/notes/".$id."/edit' class='btn btn-warning btn-xs'>Edit</a>
                <button type='button' class='btn btn-danger btn-xs delete-button' value='".$id."'>Delete</button>
                </div></div></div>";
        return $new;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = $this->notes->where('id',$id)->pluck('user_id')[0];
        if(Auth::user()->id!=$id){
            flash()->error('This is not your note');
            return redirect('reminders');
        }
        $notes = $this->notes->where('id',$id)->get();
        return view('note.edit', compact('notes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reminder_id = $this->notes->where('id',$id)->with('reminder')->pluck('reminder_id')[0];
        $this->notes
        ->where('id',$id)
        ->update([
            'title'     =>  $request->title,
            'body'      =>  $request->body,
        ]);
        flash()->warning('Note Updated');
        return redirect('/reminders/'.$reminder_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Note $note)
    {

        $id = $this->notes->where('id',$id)->pluck('user_id')[0];
        if(Auth::user()->id!=$id){
            flash()->error('This is not your note');
            return redirect('reminders');
        }
        $reminder_id = $this->notes->where('id',$id)->with('reminder')->pluck('reminder_id')[0];
        $this->notes->where('id',$id)->delete();
        flash()->error('Note Deleted');
        return redirect('/reminders/'.$reminder_id);
    }
}
