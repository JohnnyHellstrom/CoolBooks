<?php

namespace App\Http\Controllers;

use App\Models\SubComment;
use Illuminate\Http\Request;

class SubCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created subcomment in storage.
     */
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

    /**
     * Store flag on the review.
     */
    public function flag(string $id)
    {
        SubComment::where('id', $id)->update(['is_flagged' => "1"]);
        return redirect()->back();
    }
    // Confirm flagg removal
    public function confirm_flag(SubComment $subcomment)
    {
       return view('subcomments.remove-flag', ['subcomment' => $subcomment]);
    }
    // Remove flagg
    public function remove_flag(Subcomment $subcomment)
    {
        $subcomment->where('id', $subcomment->id)->update(['is_flagged' => false]);
        return redirect('reviews')->with('message', 'Flagg removed from subcomment');
    }


    // Get confirm-hide view
    public function confirm_hide(Subcomment $subcomment){
        return view('subcomments.hide', ['subcomment' => $subcomment]);
    }
        /**
     * Hide subcomment.
     */
    public function hide(Subcomment $subcomment)
    {
        $subcomment->where('id', $subcomment->id)->update(['is_deleted' => true]);
        return redirect('/reviews');
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
