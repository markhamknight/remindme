<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\User;
use App\Photo;
use Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $users;
    function __construct(User $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        return 'WEW';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'username'  => 'required|unique:users,username',
            'password'  => 'required'
        ]);

        $this->users->insert([
            'username' => $request->username,
            'password' => bcrypt($request->password)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $users = $this->users->where('id',$id)->with('photo')->get();
       $file = "/images/pp/".$users->first()->photo->filename.$users->first()->photo->extension;
       return view('user.profile', compact('users','file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        flash()->error('Not a valid image');
        $this->validate($request,[
            'username'  => 'required:unique:users,username'.Auth::user()->id,
            'profile_photo' =>'mimes:jpeg,jpg,png,gif'
        ]);
        $this->users->where('id',$id)->update([
            'username'      =>  strip_tags($request->username),
            'first_name'    =>  strip_tags($request->first_name),
            'last_name'     =>  strip_tags($request->last_name)
        ]);
        if($request->hasFile('profile_photo')){
            $img = Input::file('profile_photo');
            $extension =  $img->getClientOriginalExtension();
            $fileName = rand(11111,99999).'.';
            $img->move(public_path().'\images\pp',$fileName.$extension);
            Photo::where('user_id',$id)->update([
                'filename'  =>  $fileName,
                'extension' =>  $extension
            ]);
        }
        flash()->info('Profile Updated');
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function checkUsername()
    {
        $username = $_GET['username'];
        if($this->users->where('username',$username)->count() > 0){
            return 'true';
        }else{
            return 'false';
        }
    }
}
