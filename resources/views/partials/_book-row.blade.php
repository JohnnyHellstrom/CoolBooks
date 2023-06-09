    @foreach ($three_book as $book)
        <div class="w-48 tooltip pb-2">
            <div class="">
                <a class="self-center" href="/books/{{ $book->id }}"><img class="h-36"
                        src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/no-image.jpg') }}"
                        alt="" /></a>
                {{-- Text for the tooltips thing --}}
                <span class="tooltiptext tooltip_main">Title:<br><b>{{ $book->title }}</b> <br>
                    Author:<br><b>{{ $book->authors[0]['first_name'] }} {{ $book->authors[0]['last_name'] }}</b>
                </span>
            </div>
            <div class="w-36">
                {{-- check to se if there is a rating for the book --}}
                @if (!empty($book->reviews[0]))
                    <span>
                        <p class=" flex"><br>
                            <x-rating :rating="round($book->getAverageRating())" />
                        </p>
                    </span>
                @else
                    <br>
                    <p>Not rated yet.</p>
                @endif
            </div>
        </div>
    @endforeach