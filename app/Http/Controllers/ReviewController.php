<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Review;
use App\Models\Comment;
use App\Models\SubComment;
use App\Models\LikedReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flaggedReviews = Review::where('is_flagged', true)->where('is_deleted', false)->orderBy('created_at', 'desc')->get();
        $flaggedComments = Comment::where('is_flagged', true)->where('is_deleted', false)->orderBy('created_at', 'desc')->get();
        $flaggedSubcomments = SubComment::where('is_flagged', true)->where('is_deleted', false)->orderBy('created_at', 'desc')->get();
        return view('reviews.index', [
        'reviews' => $flaggedReviews,
        'comments' => $flaggedComments,
        'subcomments' => $flaggedSubcomments,
    ]);
    }

    public function user_posts(string $id)
    {
        $flaggedReviews = Review::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        $flaggedComments = Comment::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        $flaggedSubcomments = SubComment::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        $user = User::where('id', $id)->first();
        return view('reviews.user-reviews', [
            'reviews' => $flaggedReviews,
            'comments' => $flaggedComments,
            'subcomments' => $flaggedSubcomments,
        ]);
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
        $formFields['user_id'] = auth()->id();
        $formFields['is_deleted'] = 0;

        Review::create($formFields);

        return redirect()->back()->with('message', 'New Review created');
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
    public function edit(Review $review)
    {
        return view('reviews.edit', ['review' => $review]);
    }

    // Get confirm-hide view
    public function confirm_hide(Review $review){
        return view('reviews.hide', ['review' => $review]);
    }
    // Hide flagged review
    public function hide(Review $review){
        $review->update(['is_deleted' => 1]);
        return redirect('reviews');
    }

      /**
     * Set flag on the review.
     */
    public function flag(string $id)
    {
        Review::where('id', $id)->update(['is_flagged' => "1"]);
        return redirect()->back();
    }
    /**
     * Show confirm-view for flagg removal
     */
    public function confirm_flag(Review $review)
    {
        return view('reviews.remove-flag', ['review' => $review]);
    }
    /**
     * Remove flag from the review.
     */
    public function remove_flag(string $id)
    {
        Review::where('id', $id)->update(['is_flagged' => "0"]);
        return redirect('/reviews');
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
  
        $formFields['user_id'] = auth()->id();

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

        return redirect()->back();
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
        
        $formFields['user_id'] = auth()->id();
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
