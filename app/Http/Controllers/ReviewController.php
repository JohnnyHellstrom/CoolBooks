<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\LikedReview;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $allReviews = Review::orderByDesc('created_at')->get();

        // CommentRecusrive is a function in commentmodell that retrievs a collection of subcomments
        $allReviews = Review::with('commentRecursive')->get();
        //dd($allReviews);
        return view('reviews.index', [
        'reviews' => $allReviews]);
    }


    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'book_id' => 'required',
            'headline' => 'required',
            'rating' => 'required',
            'review_text' => 'required',
        ]);
        // $formFields['user_id'] = auth()->id();
        $formFields['user_id'] = 1;

        $formFields['is_deleted'] = 0;

        Review::create($formFields);

        return redirect("/books/{$formFields['book_id']}")->with('message', 'New Review created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

        /**
     * Store like info.
     */
    public function like(Request $request)
    {
       $formFields = $request->validate([
            'review_id' => 'required',
            'liked' => 'required'
        ]);
  
        // $formFields['user_id'] = auth()->id();
        $formFields['user_id'] = 1;

        $likedReview = LikedReview::where(['user_id' => $formFields['user_id'], 'review_id' => $formFields['review_id']])->first();
        
        // Add/Remove/Update liked-value
        if(!$likedReview){
            $likedReview = new LikedReview();
            $likedReview->create($formFields);
        } else if ($likedReview['liked'] == $formFields['liked']){
            $likedReview->delete();
        } else {
            $likedReview->update($formFields);
        }

        return redirect("/books/1")->with('message', 'FIX REDIRECT');
    }
    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, Review $review)
    {
        $formFields = $request->validate([
            'book_id' => 'required',
            'headline' => 'required',
            'rating' => 'required',
            'review_text' => 'required',
        ]);
        
        // $formFields['user_id'] = auth()->id();
        $formFields['user_id'] = 1;

        $formFields['is_deleted'] = 0;

        $review->update($formFields);
        
        return redirect("/books/{$review->book_id}")->with('message', "The review has been updated successfully");
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(Review $review)
    {
        $book_id = $review->book_id;
        $review->delete();
        return redirect("/books/{$book_id}")->with('message', 'Review deleted successfully');
    }
}
