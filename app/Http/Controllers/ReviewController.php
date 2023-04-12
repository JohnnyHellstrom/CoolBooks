<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allReviews = Review::orderByDesc('created_at')->get();
        return view('reviews.index', [
            'reviews' => $allReviews]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Is now shown on index. So Probobly delete this method
    }

    /**
     * Store a newly created resource in storage.
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

        return redirect('/reviews')->with('message', 'New Review created');
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
