<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Reminder;
use App\User;
use App\Tag;
use Carbon\Carbon;
use Auth;
use App\Note;
class RemindersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $reminders;
    function __construct(Reminder $reminders)
    {
        $this->reminders = $reminders;
    }
    public function index()
    {
        if(!Auth::check()){
            return view('index');
        }
        $user_id = Auth::user()->id;
        $today = array();
        $upcoming = array();
        $overdue = array();
        $allReminders = $this->reminders->where('user_id',$user_id)->with('tag')->get();
        foreach ($allReminders as $reminder) {
            $now =  Carbon::now();
            $duedate = Carbon::createFromFormat('F d, Y', $reminder->due_date);
            $diff = $now->diffInHours($duedate,false);
            if($diff <= 24 && $diff>=0) {
                $today[] = $reminder;
            } elseif($diff>24) {
                $upcoming[] = $reminder;
            } elseif($diff<0) {
                $overdue[] = $reminder;
            }
        }
        $public = $this->reminders
        ->where('user_id', "!=", $user_id)
        ->where('privacy','public')->with('tag')->get();
        return view('reminder.index', compact('today','upcoming','overdue','public'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $now = Carbon::now();
        $now = $now->format('F d, Y');
        return view('reminder.create',['now' => $now]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag_id = Tag::where('name',$request->tag)->get()->pluck('id')[0];
        $this->reminders->insert([
            'title' => strip_tags($request->title),
            'body'  => strip_tags($request->body),
            'due_date' => $request->due_date,
            'privacy'   => $request->privacy,
            'user_id'   => Auth::user()->id,
            'tag_id'    => $tag_id
        ]);
        flash()->success('Reminder Added');
        return redirect('reminders');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = $this->reminders->where('id', $id)->get();
        if(count($user_id)){
            $uid = $user_id->pluck('user_id')[0];
            $privacy = $user_id->pluck('privacy')[0];
            if($uid!=Auth::user()->id && $privacy == "Private"){
            flash()->error('This is not your reminder');
            return redirect('reminders');
            }
        }

        
        $reminders = $this->reminders->where('id', $id)->with('tag')->get();
        $notes = Note::where('reminder_id', $id)->with('user')->get();
        return view('reminder.show', compact('reminders','notes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reminders = $this->reminders->where('id',$id)->with('tag')->get();
        return view('reminder.edit', compact('reminders'));
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
        $this->reminders
        ->where('id',$id)
        ->update([
            'title'     =>  strip_tags($request->title),
            'body'      =>  strip_tags($request->body),
            'privacy'   =>  $request->privacy,
            'due_date'  =>  $request->due_date
        ]);
        flash()->warning('Reminder Updated');
        return redirect('/reminders/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->reminders->where('id',$id)->delete();
        flash()->error('Reminder Deleted');
        return redirect('/reminders');
    }
}
