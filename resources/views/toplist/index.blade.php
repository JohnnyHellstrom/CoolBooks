<x-layout>

    <h4><b>Highest rated books</b></h4>
    <hr>
        <div class="grid grid-cols-5 grid-rows-1 justify-items-center">
        @foreach ($booksHighest as $book)
            <div>
                <div class="grid justify-items-center font-bold">{{ $book->title}}</div>
                <div class="grid justify-items-center">
                <a href="/books/{{ $book->id }}"><img
                    src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/no-image.jpg') }}"
                    class="h-40">
                </a>
            </div>
            <div class="grid justify-items-center">({{ number_format($book->avg_rating, 1) }})</div>
            </div>
        @endforeach
    </div>
    <hr>
        <h4><b>Lowest rated books</b></h4>
        <hr>
            <div class="grid grid-cols-5 grid-rows-1 justify-items-center">
            @foreach ($booksLowest as $book)
                <div>
                    <div class="grid justify-items-center font-bold">{{ $book->title}}</div>
                    <div class="grid justify-items-center">
                    <a href="/books/{{ $book->id }}"><img
                        src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/no-image.jpg') }}"
                        class="h-40">
                    </a>
                </div>
                <div class="grid justify-items-center">({{ number_format($book->avg_rating, 1) }})</div>
                </div>
            @endforeach
        </div>
<hr>
        <h4><b>Got people talking</b></h4>
        <hr>
    <div class="grid grid-cols-5 grid-rows-1 justify-items-center">
            @foreach ($booksmostReviewed as $book)
            <div> 
            <div class="grid justify-items-center font-bold">{{ $book->title}}</div>
                    <div class="grid justify-items-center">
                        <a href="/books/{{ $book->id }}"><img
                        src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/no-image.jpg') }}"
                        class="h-40">
                    </a></div>
            <div class="grid justify-items-center">({{ $book->review_count}} reviews)</div>
            </div>
            @endforeach
    </div>
</x-layout>
