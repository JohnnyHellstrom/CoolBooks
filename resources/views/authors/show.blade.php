<x-layout>

    <header class="text-center">
        <h3 class="text-3xl font-bold mb-2">{{$author->first_name . ' ' . $author->last_name}}</h3>
    </header>

    <div class="flex items-stretch">
        <div class="flex w-full items-center justify-center">
            <img src="{{$author->author_image ? asset('storage/' . $author->author_image) : asset('images/no-author_image.svg')}}" style="width: 50%;">            
        </div>         
        <div class="flex flex-col w-full">
            <h3 class="text-2xl font-bold mb-4 mt-10">Biography</h3>
            <div class="text-lg space-y-6 items-center">
                <p>{{$author->biography}}  </p>                                             
            </div>             
        </div>
    </div>         

    <div class="mx-4 flex flex-col items-center justify-center text-center">
            <h3 class="text-2xl font-bold mb-4 mt-10">Books at CoolBooks by {{$author->first_name . ' ' . $author->last_name}}</h3>
        @if(!$author->books->isEmpty())
            <div class="grid gap-2 grid-cols-3 grid-rows-3 justify-item-center mt-10">
                    @foreach($author->books as $book)
                        @if($book->is_deleted == 0)
                            <div class="w-48 tooltip pb-2">
                                <div class="grid gap-2 grid-cols-2 grid-rows-1 self-center justify-item-center">
                                    <a class="self-center" href="/books/{{$book->id}}">
                                        <img class="w-36" src="{{$book->image ? asset('storage/' . $book->image) : asset('images/no-image.png')}}" alt=""/>
                                    </a>
                                    <span class="tooltiptext tooltip_author">
                                        <b>{{$book->title}}</b>
                                    </span>
                                </div>
                            </div>   
                        @endif
                    @endforeach
                </div>
            @else
                <p class="text-center text-2xl m-10">No Books For This Author</p>
            @endif 
        <a href="/authors" class="text-black text-2xl m-10 ml-4"><i class="fa-solid fa-arrow-left"></i> Back to Authors</a>
    </div>

</x-layout>