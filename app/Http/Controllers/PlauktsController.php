<?php

namespace App\Http\Controllers;

use App\Models\Plaukts;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\User_book;

class PlauktsController extends Controller
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
        
        return view('plaukti', [
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $plaukts = new Plaukts();
        $plaukts->name = 'Jauns plaukts';
        $plaukts->user_id = auth()->user()->id;
        $plaukts->public = true;

        $plaukts->save();
        return redirect('u/'.auth()->user()->username.'/plaukti');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plaukts = Plaukts::findOrFail($id);
        return view('plaukts-show', compact('plaukts'));
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
    public function edit($id)
    {
        $plaukts = Plaukts::findOrFail($id);
        return view('plaukts-edit', compact('plaukts'));
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
        $rules = array(
            'name' => 'required|string|max:191',
        );

        $this->validate($request, $rules);

        $plaukts = Plaukts::findOrFail($id);
        $plaukts->name = $request->name;

        $plaukts->save();

        return redirect('u/'.$plaukts->user->username.'/plaukti');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plaukts = Plaukts::findOrFail($id);
        $user = $plaukts->user;
        foreach($plaukts->user_books as $user_book){
            $user_book->delete();
        }
        $plaukts->delete();

        return redirect('u/'.$user->username.'/plaukti');
    }

    public function store_book(Request $request){
        $rules = array(
            'book_id' => 'required|integer',
            'plaukts_id' => 'required|integer',
        );
        $this->validate($request, $rules);

        $book = Book::findOrFail($request->book_id);
        $plaukts = Plaukts::findOrFail($request->plaukts_id);
        if($plaukts->user->id == auth()->user()->id){
            $user_book = new User_book();
            $user_book->plaukts_id = $plaukts->id;
            $user_book->book_id = $book->id;
            $user_book->push();
        }
        return redirect('/u/'.auth()->user()->username.'/plaukti');
    }

    public function destroy_user_book(Request $request)
    {
        $this->validate($request, [
            'user_book_id' => 'required|integer',
        ]);
        User_book::findOrFail($request->user_book_id)->delete();
        return redirect('/u/'.auth()->user()->username.'/plaukti');
    }
}
