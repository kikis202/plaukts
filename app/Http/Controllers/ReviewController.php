<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Book;

class ReviewController extends Controller
{
    public function create($book_id){
        $book = Book::findOrFail($book_id);
        return view('review-create', compact('book'));
    }

    public function store(Request $request){
        $rules = array(
            'title' => 'required|string|max:191',
            'review' => 'string|max:1000|nullable',
            'grade' => 'required|integer',
            'book_id' => 'required|integer|exists:books,id',
        );
        $this->validate($request, $rules);

        $review = new Review();
        $review->user_id = auth()->user()->id;
        $review->book_id = $request->book_id;
        $review->title = $request->title;
        $review->review = $request->review;
        $review->grade = $request->grade;

        $review->save();

        return redirect('/b/'.$request->book_id);
    }
}
