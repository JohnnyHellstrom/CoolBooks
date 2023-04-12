<section
            class="relative h-72 bg-emerald-700 flex flex-col justify-center align-center space-y-4 mb-4">

            <div class="grid gap-8 grid-cols-2 grid-rows-1 self-center justify-items-center">
                <div class="grid justify-items-center align-content-center">
                <a href="/books/{{$one_book->id}}"><img
                    class="w-48"
                    src="{{$one_book->image ? asset('storage/' . $one_book->image) : asset('images/no-image2.png')}}"
                    alt=""/></a>
                </div>
                <div>
                    <h2 class="text-2 font-bold uppercase ">Title:</h2> <a href="/books/{{$one_book->id}}">{{$one_book->title}}</a>
                    
                    @unless($rand_rating->rating == null)
                    <p><x-rating :rating="$rand_rating->rating" /></p>
                        @else
                        {{Rating: 0/5}}
                        @endunless
                        
                        
                    <p class="text-2 font-bold uppercase mt-2">Review:</p>
                    <p>{{$one_book->description}}</p>
                </div>
            </div>
        </section>