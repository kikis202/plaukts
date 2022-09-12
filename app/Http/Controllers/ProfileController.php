<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($username)
    {
        $user = User::where('username',$username)->firstOrFail();
        return view('profile', [
            'user' => $user,
        ]);
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
        //
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

    public function filter(Request $request){
        $rules = array(
            'username' => 'required|string|max:191',
        );
        $this->validate($request, $rules);
        $query = new User();
        $query = $query->where('users.username', 'LIKE', '%'.$request->username.'%');
        return view('search-profile', array('profiles' => $query->orderBy('id')->get()));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $user = User::where('username',$username)->firstOrFail();
        return view('edit-profile', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
        $rules = array(
            'name' => 'string|max:191|nullable',
            'description' => 'string|max:1000|nullable',
            'photo' => 'image|sometimes|size:5000',
        );

        $this->validate($request,$rules);

        $user = User::where('username',$username)->firstOrFail();
        if($request->name != null) {$user->name = $request->name;}
        else {$user->name = '';}
        if($request->description != null) {$user->profile->description = $request->description;}
        else {$user->profile->description = '';}
        if($request->photo != null) {
            $img_path = $request->photo->store('profile-picture', 'public');
            $user->profile->image = $img_path;
        }

        $user->push();
        return redirect('profile/'.$username);
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
}
