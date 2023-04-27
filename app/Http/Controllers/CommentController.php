<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Flag a comment.
     */
    public function flag(string $id)
    {
        Comment::where('id', $id)->update(['is_flagged' => "1"]);
        return redirect()->back();
    }
    // Confirm flagg removal
    public function confirm_flag(Comment $comment)
    {
       return view('comments.remove-flag', ['comment' => $comment]);
    }
    // Remove flagg
    public function remove_flag(Comment $comment)
    {
        $comment->where('id', $comment->id)->update(['is_flagged' => false]);
        return redirect('reviews')->with('message', 'Flagg removed from comment');
    }



    // Get confirm-hide view
    public function confirm_hide(Comment $comment){
        return view('comments.hide', ['comment' => $comment]);
    }
        /**
     * Hide comment.
     */
    public function hide(Comment $comment)
    {
        $comment->where('id', $comment->id)->update(['is_deleted' => true]);
        return redirect('/reviews');
    }

    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'review_id' => 'required',
            'comment' => 'required',
        ]);
        $formFields['user_id'] = auth()->id();
        $formFields['is_deleted'] = 0;

        Comment::create($formFields);

        return redirect()->back()->with('message', 'New comment created');
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    // Show confirm-delete view
    public function confirm_delete(Comment $comment)
    {
        return view('/comments/delete', ['comment' => $comment]);
    }
    //Remove the specified comment from storage.
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect('/reviews')->with('message', 'Comment succesfully removed');
    }
}
