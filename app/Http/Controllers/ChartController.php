<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Review;
use App\Models\Comment;
use App\Models\SubComment;
use Illuminate\Http\Request;
use App\Charts\StatisticsChart;

class ChartController extends Controller
{
    public function index(Request $request)
    {
        //Save request to keep selected dropdown when reloading chart page
        $selected = array(
            'old_categoryPrecision' => $request->categoryPrecision,
            'old_category' => $request->category,
            'old_chartPrecision' => $request->chartPrecision,
            //start and end dates are always reset to include all
        );

        //Set date range to be included (1900-01-01-now (~all) as default)               
        $start = Carbon::createFromFormat('Y-m-d', '1900-01-01')->format('Y-m-d');
        if ($request->start != null) {
            $start = Carbon::createFromFormat('m/d/Y', $request->start)->format('Y-m-d');
        }

        $end = Carbon::now()->format('Y-m-d');
        if ($request->end != null) {
            $end = Carbon::createFromFormat('m/d/Y', $request->end)->format('Y-m-d 23:59:59');
        }

        //Set chart precission as per day or per week (per day as default) (initial x-axis label as well)               
        $chartPrecision ='date';
        $xLegend = 'Date';
        if ($request->chartPrecision == 'per week') {
            $chartPrecision = 'week';
            $xLegend = 'Week';
        }

        //Default values for first index page load
        $yLegend = "reviews";

        $query = Review::selectRaw($chartPrecision . '(created_at) as ' . $chartPrecision . ', COUNT(*) as total')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy($chartPrecision)
            ->pluck('total', $chartPrecision);


        //Select query (and x-axis label)    
        if ($request->categoryPrecision == 'Per book') {
            $xLegend = 'Book title';
            $query = Review::join('books', 'reviews.book_id', '=', 'books.id')
                            ->selectRaw('books.title, COUNT(*) as total')
                            ->whereBetween('reviews.created_at', [$start, $end])
                            ->groupBy('books.title')
                            ->pluck('total', 'books.title');
        } elseif ($request->categoryPrecision == 'Per genre') {
            $xLegend = 'Genre';
            $query = Review::join('books', 'reviews.book_id', '=', 'books.id')
                            ->join('genres', 'books.genre_id', '=', 'genres.id')
                            ->selectRaw('genres.name, COUNT(*) as total')
                            ->whereBetween('reviews.created_at', [$start, $end])
                            ->groupBy('genres.name')
                            ->pluck('total', 'genres.name');
        } elseif ($request->categoryPrecision == 'Per author') {
            $xLegend = 'Author';
            $query = Review::join('books', 'reviews.book_id', '=', 'books.id')
                            ->join('author_books', 'books.id', '=', 'author_books.book_id')
                            ->join('authors', 'author_books.author_id', '=', 'authors.id')
                            ->selectRaw('CONCAT(authors.first_name, " ", authors.last_name) as full_name, authors.id, COUNT(*) as total')
                            ->whereBetween('reviews.created_at', [$start, $end])
                            ->groupBy('authors.last_name', 'authors.first_name', 'authors.id')
                            ->pluck('total', 'full_name');
        } else {

            switch ($request->category) {
                case 'reviews':
                    $query = Review::selectRaw($chartPrecision . '(created_at) as ' . $chartPrecision . ', COUNT(*) as total')
                                    ->whereBetween('created_at', [$start, $end])
                                    ->groupBy($chartPrecision)
                                    ->pluck('total', $chartPrecision);
                    break;
                case 'comments':
                    $query = Comment::selectRaw($chartPrecision . '(created_at) as ' . $chartPrecision . ', COUNT(*) as total')
                                    ->whereBetween('created_at', [$start, $end])
                                    ->groupBy($chartPrecision)
                                    ->pluck('total', $chartPrecision);
                    break;
                case 'replies':
                    $query = SubComment::selectRaw($chartPrecision . '(created_at) as ' . $chartPrecision . ', COUNT(*) as total')
                                    ->whereBetween('created_at', [$start, $end])
                                    ->groupBy($chartPrecision)
                                    ->pluck('total', $chartPrecision);
                    break;
            }
        }
        //Setting y-axis legend (x-axis legend is set in the if-else above)
        if ($request->categoryPrecision === 'All') {
            $yLegend = $request->category;
        }   //else $yLegend = "reviews" set as default above
        
        //Prepare chart
        $chart = new StatisticsChart;
        $chart->labels($query->keys());
        $chart->dataset('', 'bar', $query->values())
        ->backgroundColor('#64748b');

        // Chart display settings
        $chart->options([
            'scales' => [
                'yAxes' => [[
                    'ticks' => [
                        'fontSize' => 16,
                        'fontColor' => '#000000',
                    ],
                    'scaleLabel' => [
                        'display' => true,
                        'labelString' => '# of ' . $yLegend,
                        'fontSize' => 20,
                        'fontColor' => '#000000'
                    ]
                ]],
                'xAxes' => [[
                    'ticks' => [
                        'fontSize' => 16,
                        'fontColor' => '#000000'
                    ],
                    'scaleLabel' => [
                        'display' => true,
                        'labelString' => $xLegend,
                        'fontSize' => 20,
                        'fontColor' => '#000000'
                    ]
                ]]
            ],
            'legend' => [
                'display' => false
            ]
        ]);

        return view('charts.index', ['chart' => $chart, 'selected' => $selected]);
        // return view('charts.index', compact('chart', 'selected')); //Same as above written in "new" format
    }
}