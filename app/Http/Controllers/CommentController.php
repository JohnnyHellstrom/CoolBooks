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
     * Edit a newly flagged comment.
     */
    public function flag(string $id)
    {
        dd($id);
        Comment::where('id', $id)->update(['flag' => "1"]);
    }

    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request)
    {
        $book_id = $request->validate([
            'book_id' => 'required'
        ]);
        $formFields = $request->validate([
            'review_id' => 'required',
            'comment' => 'required',
        ]);
        // $formFields['user_id'] = auth()->id();
        $formFields['user_id'] = 1;
        $formFields['is_deleted'] = 0;

        Comment::create($formFields);

        return redirect("/books/{$book_id['book_id']}")->with('message', 'New comment created');
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
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect('/books/1')->with('message', 'Comment succesfully removed');
    }
}
