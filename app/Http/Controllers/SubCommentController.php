<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\SubComment;
use Illuminate\Http\Request;

class SubCommentController extends Controller
{
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'comment_id' => 'required',
            'subcomment' => 'required',
        ]);
        $formFields['user_id'] = auth()->id();
        $formFields['is_deleted'] = 0;

        SubComment::create($formFields);

        return redirect()->back()->with('message', 'New reply created');
    }

    // Store flag on the review.
    public function flag(string $id)
    {
        SubComment::where('id', $id)->update(['is_flagged' => "1"]);
        return redirect()->back();
    }
    // Confirm flagg removal
    public function confirm_flag(SubComment $subcomment)
    {
        abort_if(
            (auth()->user()->role_id != Role::IS_MODERATOR) &&
            (auth()->user()->role_id != Role::IS_ADMIN), 403, 'Page doesnt exist' );
            
       return view('subcomments.remove-flag', ['subcomment' => $subcomment]);
    }
    // Remove flagg
    public function remove_flag(Subcomment $subcomment)
    {

        abort_if(
            (auth()->user()->role_id != Role::IS_MODERATOR) &&
            (auth()->user()->role_id != Role::IS_ADMIN), 403, 'Page doesnt exist' );
        $subcomment->where('id', $subcomment->id)->update(['is_flagged' => false]);
        return redirect('reviews')->with('message', 'Flagg removed from subcomment');
    }


    // Get confirm-hide view
    public function confirm_hide(Subcomment $subcomment){
        abort_if(
            (auth()->user()->role_id != Role::IS_MODERATOR) &&
            (auth()->user()->role_id != Role::IS_ADMIN), 403, 'Page doesnt exist' );

        return view('subcomments.hide', ['subcomment' => $subcomment]);
    }
        //Hide subcomment.
    public function hide(Subcomment $subcomment)
    {
        abort_if(
            (auth()->user()->role_id != Role::IS_MODERATOR) &&
            (auth()->user()->role_id != Role::IS_ADMIN), 403, 'Page doesnt exist' );

        $subcomment->where('id', $subcomment->id)->update(['is_deleted' => true]);
        return redirect('/reviews');
    }
    
    // Show confirm-delete view
    public function confirm_delete(SubComment $subcomment)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');

        return view('/subcomments/delete', ['subcomment' => $subcomment]);
    }
    //Remove the specified comment from storage.
    public function destroy(SubComment $subcomment)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        
        $subcomment->delete();
        return redirect('/reviews')->with('message', 'Reply succesfully removed');
    }
}
