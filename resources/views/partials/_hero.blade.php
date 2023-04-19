<section class="relative h-64 bg-hero flex flex-col align-center space-y-4 mb-4">
    @php
        $rand_book = random_int(1, (count($books)-1));
    @endphp
    @if($books[$rand_book]->is_deleted == 0)
    <div class="text-2 font-bold uppercase self-center">
        <h2>Inspirerande text!</h2>
    </div>
        <div class="grid grid-cols-3 grid-rows-1 self-center justify-items-center mt-0">
        <div class="grid justify-items-center align-content-center">
            <a class="self-center"href="/books/{{$books[$rand_book]->id}}"><img
                class="h-48"
                src="{{$books[$rand_book]->image ? asset('storage/' . $books[$rand_book]->image) : asset('images/no-image.png')}}"
                alt=""/></a>
        </div>
        <div class="h-48">
            <h2 class="text-2 font-bold uppercase ">Title:</h2> <a href="/books/{{$books[$rand_book]->id}}">{{$books[$rand_book]->title}}</a>
            {{-- <h2 class="text-2 font-bold uppercase ">Author:</h2> <a href="/books/{{$one_book->id}}">{{$book->authors}}</a> --}}
            {{--For loop with a random generator inside, an if-statement to check if the book is deleted--}}
            {{--have a check if det database if empty--}}

            {{--check to se if there is a rating for the book --}}
            @if(!empty($rating[$rand_book]))
            @unless($rating[$rand_book]->rating == null)
                <span>
                    <p class=" flex"><x-rating :rating="$rating[$rand_book]->rating" /></p>
                </span>
                        @else
                    <p>Rating: 0/5</p>
            @endunless
          @else
            <p>Not rated yet.</p>
          @endif
        </div>
            <div class="h-48">
            <p class="text-2 font-bold uppercase ">Description:</p>
            <textarea class="bg-slate-500" name="comment" rows="5" cols="40"><?php echo $books[$rand_book]->description;?></textarea>
            {{-- <p>{{$books[$rand_book]->description}}</p> --}}
            </div>
    </div>
    @else
     {{-- {{header("Refresh:0")}} --}}
     <p>Cool picture with inspiering text about books</p>
    @endif
</section>