<div class="grid gap-2 grid-cols-4 grid-rows-1 justify-items-center mt-10 ">
    @if(!$books->isEmpty())
<h2>Horror</h2>
        @foreach ($horror as $book)
        
        <div class="w-48 tooltip pb-2">
            <div class="">
                <a class="self-center" href="/books/{{$book->id}}"><img class="h-36" src="{{$book->image ? asset('storage/' . $book->image) : asset('images/no-image.png')}}" alt=""/></a>
                {{--Text for the tooltips thing--}}
                    <span class="tooltiptext tooltip_main">Title:<br><b>{{$book->title}}</b> <br> Author:<br><b>{{$book->authors[0]['first_name']}} {{$book->authors[0]['last_name']}}</b> </span>
            </div>
            <div class="w-36">                
                {{--check to se if there is a rating for the book--}}
                @if(!empty($rating[$book->id]))
                    @unless($rating[$book->id]->rating == null)
                        <span>
                            <p class=" flex"><x-rating :rating="$rating[$book->id]->rating" /></p>
                        </span>
                                @else
                            <p>Rating: 0/5</p>
                    @endunless
                @else
                    <p>Not rated yet.</p>
                @endif
            </div>
        </div>
            
        @endforeach
        
    @else
        <p class="text-center">No Books found</p>
        @endif  
</div>

