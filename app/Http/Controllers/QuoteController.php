<?php

namespace App\Http\Controllers;

use App\Models\GenreQuote;
use App\Models\Role;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotes = Quote::where('is_moderated', 1)->where('is_deleted', 0)->get();
        return view('quotes.index', ['quotes' => $quotes]);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $genrequotes = GenreQuote::all();
        return view('quotes.create', ['genres' => $genrequotes]);
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'quote' => 'required',
            'quotee' => 'required',
            'genre_quote_id' => 'required',
        ]);

        $formFields['is_deleted'] = 0;
        $formFields['is_moderated'] = 0;
        $formFields['user_id'] = auth()->id();

        Quote::create($formFields);

        return redirect('/quotes')->with('message', 'Quote added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quote $quote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quote $quote)
    {
        abort_if(auth()->user()->role_id !=  Role::IS_ADMIN, 403, 'Page doesnt exist');
        $genrequotes = GenreQuote::all();
        return view('/quotes.edit', ['quote' => $quote, 'genres' => $genrequotes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quote $quote)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        $formFields = $request->validate([
            'quote' => 'required',
            'quotee' => 'required',
            'genre_quote_id' => 'required',
        ]);
        $formFields['is_deleted'] = 0;
        $formFields['is_moderated'] = 0;
        $formFields['user_id'] = auth()->id();
        $quote->update($formFields);
        return redirect('/quotes')->with('message', 'Quote edited');
    }
    public function qoutesToMod()
    {
        $quotes = Quote::where('is_moderated', 0)->where('is_deleted', 0)->get();
        return view('quotes.moderate', ['quotes' => $quotes]);
    }
    public function approve(Quote $quote){
        //dd($quote);
        $quote->update(['is_moderated' => 1]);
        return redirect('/quotes/moderate')->with('message', 'Approved');
    }
    public function hide(Quote $quote)
    {
        $quote->update(['is_deleted' => 1, 'is_moderated' => 1]);
        return redirect('/quotes/moderate')->with('message', 'Quote soft deleted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quote $quote)
    {
        abort_if(auth()->user()->role_id != Role::IS_ADMIN, 403, 'Page doesnt exist');
        $quote->delete();
        return redirect('/quotes/moderate')->with('message', 'Quote hard deleted');
    }
}
