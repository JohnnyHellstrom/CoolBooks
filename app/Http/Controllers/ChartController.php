<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Review;
use App\Models\Comment;
use App\Models\SubComment;
use Illuminate\Http\Request;
use App\Charts\StatisticsChart;

class ChartController extends Controller    //RENAME TO STATISTICS
{
    public function index(Request $request)
    {
        //Set date range to be included (1900-01-01-now (~all) as default)               
        $start = Carbon::createFromFormat('Y-m-d', '1900-01-01')->format('Y-m-d');
        if ($request->start != null) {
            $start = Carbon::createFromFormat('m/d/Y', $request->start)->format('Y-m-d');
        }

        $end = Carbon::now()->format('Y-m-d');
        if ($request->end != null) {
            $end = Carbon::createFromFormat('m/d/Y', $request->end)->format('Y-m-d 23:59:59');
        }

        //Set chart precission as per day or per week (per day as default)               
        $chartPrecision ='date';
        if ($request->chartPrecision == 'week') {
            $chartPrecision = 'week';
        }


        //Default query for first index page load
        $query = Review::selectRaw($chartPrecision . '(created_at) as ' . $chartPrecision . ', COUNT(*) as total')
        ->whereBetween('created_at', [$start, $end])
            ->groupBy($chartPrecision)
            ->pluck('total', $chartPrecision);

        if ($request->categoryPrecision == 'per genre') {
            $query = Review::join('books', 'reviews.book_id', '=', 'books.id')
                            ->join('genres', 'books.genre_id', '=', 'genres.id')
                            ->selectRaw('genres.name, COUNT(*) as total')
                            ->whereBetween('reviews.created_at', [$start, $end])
                            ->groupBy('genres.name')
                            ->pluck('total', 'genres.name');
        } elseif ($request->categoryPrecision == 'per author') {
            $query = Review::join('books', 'reviews.book_id', '=', 'books.id')
                            ->join('author_books', 'books.id', '=', 'author_books.book_id')
                            ->join('authors', 'author_books.author_id', '=', 'authors.id')
                            ->selectRaw('authors.first_name, authors.id, COUNT(*) as total')
                            ->whereBetween('reviews.created_at', [$start, $end])
                            ->groupBy('authors.first_name', 'authors.id')
                            ->pluck('total', 'authors.first_name', 'authors.last_name');
        } else {

            switch ($request->category) {
                case 'Reviews':
                    $query = Review::selectRaw($chartPrecision . '(created_at) as ' . $chartPrecision . ', COUNT(*) as total')
                                    ->whereBetween('created_at', [$start, $end])
                                    ->groupBy($chartPrecision)
                                    ->pluck('total', $chartPrecision);
                    break;
                case 'Comments':
                    $query = Comment::selectRaw($chartPrecision . '(created_at) as ' . $chartPrecision . ', COUNT(*) as total')
                                    ->whereBetween('created_at', [$start, $end])
                                    ->groupBy($chartPrecision)
                                    ->pluck('total', $chartPrecision);
                    break;
                case 'Replies':
                    $query = SubComment::selectRaw($chartPrecision . '(created_at) as ' . $chartPrecision . ', COUNT(*) as total')
                                    ->whereBetween('created_at', [$start, $end])
                                    ->groupBy($chartPrecision)
                                    ->pluck('total', $chartPrecision);
                    break;
            }
        }
       

        $chart = new StatisticsChart;
        $chart->labels($query->keys());
        $chart->dataset('set 1', 'bar', $query->values())
            ->backgroundColor('#64748b');

        return view('charts.index', compact('chart'));
    }
}