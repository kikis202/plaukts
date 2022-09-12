<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
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
    
    public function index()
    {
        
    }

    public function create()
    {
        return view('create-book');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required|string|max:191',
            'author' => 'required|string|max:191',
            'description' => 'string|max:1000|nullable',
            'cover' => 'required|image',
        );

        $this->validate($request, $rules);

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description - $request->description;
        $img_path = $request->cover->store('book-covers', 'public');
        $book->image = $img_path;

        $book->save();
        return redirect('b/create');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('book-show', compact('book'));
    }

    public function show_filter(){
        return view('search-books');
    }

    public function filter(Request $request){

        $rules = array(
            'title' => 'nullable|string|max:191',
            'author' => 'nullable|string|max:191',
        );

        $this->validate($request, $rules);
        

        $query = new Book();
        if($request->title != null)$query = $query->where('books.title', 'LIKE', '%'.$request->title.'%');
        if($request->author != null)$query = $query->where('books.author', 'LIKE', '%'.$request->author.'%');

        return view('search-books', array('books' => $query->orderBy('id')->get()));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer',
        ]);
        $book = Book::findOrFail($request->id);
        foreach($book->user_books as $user_book){
            $user_book->delete();
        }
        $book->delete();
        return redirect('/books');
    }
}
