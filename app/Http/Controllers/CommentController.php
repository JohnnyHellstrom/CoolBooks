<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Flag a comment.
    public function flag(string $id)
    {
        abort_if(auth()->id() === null, 403, 'Page doesnt exist');

        Comment::where('id', $id)->update(['is_flagged' => "1"]);
        return redirect()->back();
    }
    // Confirm flagg removal
    public function confirm_flag(Comment $comment)
    {
        abort_if(
            (auth()->user()->role_id != Role::IS_MODERATOR) &&
            (auth()->user()->role_id != Role::IS_ADMIN), 403, 'Page doesnt exist' );

       return view('comments.remove-flag', ['comment' => $comment]);
    }
    // Remove flagg
    public function remove_flag(Comment $comment)
    {
        abort_if(
            (auth()->user()->role_id != Role::IS_MODERATOR) &&
            (auth()->user()->role_id != Role::IS_ADMIN), 403, 'Page doesnt exist' );

        $comment->where('id', $comment->id)->update(['is_flagged' => false]);
        return redirect('reviews')->with('message', 'Flagg removed from comment');
    }
    


    // Get confirm-hide view
    public function confirm_hide(Comment $comment){
        abort_if(
            (auth()->user()->role_id != Role::IS_MODERATOR) &&
            (auth()->user()->role_id != Role::IS_ADMIN), 403, 'Page doesnt exist' );

        return view('comments.hide', ['comment' => $comment]);
    }
    // Hide comment.
    public function hide(Comment $comment)
    {
        abort_if(
            (auth()->user()->role_id != Role::IS_MODERATOR) &&
            (auth()->user()->role_id != Role::IS_ADMIN), 403, 'Page doesnt exist' );

        $comment->where('id', $comment->id)->update(['is_deleted' => true]);
        return redirect('/reviews');
    }

    // Store a newly created comment in storage.
    public function store(Request $request)
    {
        abort_if(auth()->id() === null, 403, 'Page doesnt exist');
        
        $formFields = $request->validate([
            'review_id' => 'required',
            'comment' => 'required',
        ]);
        $formFields['user_id'] = auth()->id();
        $formFields['is_deleted'] = 0;

        Comment::create($formFields);

        return redirect()->back()->with('message', 'New comment created');
    }

    // Show confirm-delete view
    public function confirm_delete(Comment $comment)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');

        return view('/comments/delete', ['comment' => $comment]);
    }
    //Remove the specified comment from storage.
    public function destroy(Comment $comment)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        
        $comment->delete();
        return redirect('/reviews')->with('message', 'Comment succesfully removed');
    }
}
