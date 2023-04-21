<section class="relative h-64 bg-hero flex flex-col align-center space-y-4 mb-4">
    @if(!$books->isEmpty())

        <div class="text-2 font-bold uppercase self-center">
            <h2>Inspirerande text!</h2>
        </div>
        <div class="grid grid-cols-3 grid-rows-1 self-center justify-items-center mt-0">
            <div class="grid justify-items-center align-content-center">
                <a class="self-center"href="/books/{{$one_book->id}}"><img
                    class="h-48"
                    src="{{$one_book->image ? asset('storage/' . $one_book->image) : asset('images/no-image.png')}}"
                    alt=""/></a>
                </div>
                <div class="h-48">
                    <h2 class="text-2 font-bold uppercase ">Title:</h2> <a class="text-2 font-bold uppercase " href="/books/{{$one_book->id}}">{{$one_book->title}}</a>
                <h2 class="text-2 font-bold uppercase "><br>Author:</h2> <a href="/authors/{{$one_book->authors[0]['id']}}">{{$one_book->authors[0]['first_name']}} {{$one_book->authors[0]['last_name']}}<br></a>
                
                    @if(!empty($one_book->reviews[0]))

                        <span>
                            <p class=" flex"><br><x-rating :rating="$one_book->reviews[0]['rating']" /></p>
                        </span>
                    @else
                        <br>
                        <p>Not rated yet.</p>
                    @endif
            </div>
            <div class="h-48">
                <p class="text-2 font-bold uppercase ">Description:</p>
                <p class="bg-slate-500 truncate" name="comment" rows="5" cols="40"><?php echo $one_book->description;?></p>
            </div>
        </div>
    @else
        <p>Cool picture with inspiering text about books</p>
    @endif
</section>