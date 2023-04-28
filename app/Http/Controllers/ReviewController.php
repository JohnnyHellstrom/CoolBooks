<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Role;
use App\Models\User;
use App\Models\Review;
use App\Models\Comment;
use App\Models\SubComment;
use App\Models\LikedReview;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReviewController extends Controller
{
    // Lists all flagged, non-hidden reviews, comments and replies
    public function index(Request $request)
    {      
        abort_if(
            (auth()->user()->role_id != Role::IS_MODERATOR) &&
            (auth()->user()->role_id != Role::IS_ADMIN), 403, 'Page doesnt exist' );

        //Set date range to be included (1900-01-01 - now+1 (~all) as default)               
        $start = Carbon::createFromFormat('Y-m-d', '1900-01-01')->format('Y-m-d');
        if ($request->start != null) {
            $start = Carbon::createFromFormat('m/d/Y', $request->start)->format('Y-m-d');
        }

        $end = Carbon::now()->addDay(1)->format('Y-m-d');
        if ($request->end != null) {
            $end = Carbon::createFromFormat('m/d/Y', $request->end)->format('Y-m-d 23:59:59');
        }

        $flaggedReviews = Review::where('is_flagged', true)->where('is_deleted', false)
                                ->whereBetween('reviews.created_at', [$start, $end])
                                ->orderBy('created_at', 'desc')->get();
        $flaggedComments = Comment::where('is_flagged', true)->where('is_deleted', false)
                                ->whereBetween('comments.created_at', [$start, $end])
                                ->orderBy('created_at', 'desc')->get();
        $flaggedSubcomments = SubComment::where('is_flagged', true)->where('is_deleted', false)
                                ->whereBetween('subcomments.created_at', [$start, $end])
                                ->orderBy('created_at', 'desc')->get();
        return view('reviews.index', [
        'reviews' => $flaggedReviews,
        'comments' => $flaggedComments,
        'subcomments' => $flaggedSubcomments,
    ]);
    }

    // Diplay all review, comments and replys for a User
    public function user_posts(string $id)
    {
        abort_if(
            (auth()->user()->role_id != Role::IS_MODERATOR) &&
            (auth()->user()->role_id != Role::IS_ADMIN), 403, 'Page doesnt exist' );

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

    // Store a newly created review in storage.
    public function store(Request $request)
    {
        abort_if(auth()->id() === null, 403, 'Page doesnt exist');

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

    // Show the form for editing the specified resource.
    public function edit(Review $review)
    {
        abort_if(auth()->id() === null, 403, 'Page doesnt exist');

        return view('reviews.edit', ['review' => $review]);
    }

    // Get confirm-hide view
    public function confirm_hide(Review $review){
        abort_if(
            (auth()->user()->role_id != Role::IS_MODERATOR) &&
            (auth()->user()->role_id != Role::IS_ADMIN), 403, 'Page doesnt exist' );

        return view('reviews.hide', ['review' => $review]);
    }
    // Hide flagged review
    public function hide(Review $review){
        abort_if(
            (auth()->user()->role_id != Role::IS_MODERATOR) &&
            (auth()->user()->role_id != Role::IS_ADMIN), 403, 'Page doesnt exist' );

        $review->update(['is_deleted' => 1]);
        return redirect('reviews');
    }

      //Set flag on the review.
    public function flag(string $id)
    {
        abort_if(auth()->id() === null, 403, 'Page doesnt exist');

        Review::where('id', $id)->update(['is_flagged' => "1"]);
        return redirect()->back();
    }
    // Show confirm-view for flagg removal
    public function confirm_flag(Review $review)
    {
        abort_if(
            (auth()->user()->role_id != Role::IS_MODERATOR) &&
            (auth()->user()->role_id != Role::IS_ADMIN), 403, 'Page doesnt exist' );

        return view('reviews.remove-flag', ['review' => $review]);
    }
    //Remove flag from the review.
    public function remove_flag(string $id)
    {
        abort_if(
            (auth()->user()->role_id != Role::IS_MODERATOR) &&
            (auth()->user()->role_id != Role::IS_ADMIN), 403, 'Page doesnt exist' );

        Review::where('id', $id)->update(['is_flagged' => "0"]);
        return redirect('/reviews');
    }

    //Store like info.
    public function like(Request $request)
    {
        abort_if(auth()->id() === null, 403, 'Page doesnt exist');
        
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
    
    //Update the specified review in storage.
    public function update(Request $request, Review $review)
    {
        abort_if(auth()->id() === null, 403, 'Page doesnt exist');
        
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

    // Show delete confirm
    public function confirm_delete(Review $review)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesn`t exist');
        return view('/reviews/delete', ['review' => $review]);
    }
    // Remove the specified review from storage.
    public function destroy(Review $review)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesn`t exist');
        $review->delete();
        return redirect("/reviews")->with('message', 'Review deleted successfully');
    }
}
