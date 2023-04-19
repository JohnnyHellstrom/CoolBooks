<section class="relative h-64 bg-slate-500 flex flex-col align-center space-y-4 p-4 mb-4">
    @if($one_book->is_deleted == 0)
    <div class="text-2 font-bold uppercase self-center">
        <h2>Inspirerande text!</h2>    
    </div>
        <div class="grid gap-6 grid-cols-3 grid-rows-1 self-center justify-items-center mt-0">
        <div class="grid justify-items-center align-content-center">
            <a class="self-center"href="/books/{{$one_book->id}}"><img
                class="w-60"
                src="{{$one_book->image ? asset('storage/' . $one_book->image) : asset('images/no-image.png')}}"
                alt=""/></a>
        </div>
        <div class="w-60">
            <h2 class="text-2 font-bold uppercase ">Title:</h2> <a href="/books/{{$one_book->id}}">{{$one_book->title}}</a>
            {{-- <h2 class="text-2 font-bold uppercase ">Author:</h2> <a href="/books/{{$one_book->id}}">{{$book->authors}}</a> --}}
            {{--For loop with a random generator inside, an if-statement to check if the book is deleted--}}
            {{--have a check if det database if empty--}}

            {{--check to se if there is a rating for the book --}}
            @unless($rand_rating == null)
                <p><x-rating :rating="$rand_rating->rating" /></p>
                    @else
                    <p>Rating: 0/5</p>
            @endunless
        </div>
            <div class="w-60">
            <p class="text-2 font-bold uppercase ">Review:</p>
            <p>{{$one_book->description}}</p>
            </div>
    </div>
    @else 
     {{header("Refresh:0")}}
    @endif
</section>