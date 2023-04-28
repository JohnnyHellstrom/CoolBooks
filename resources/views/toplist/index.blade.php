<x-layout>
        <h1>Highest rated books</h1>
        <ul>
            @foreach ($books as $book)
                <li>{{ $book->title}}<img class="h-36"
                    src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/no-image.jpg') }}"
                    alt="" /> ({{ number_format($book->avg_rating, 1) }})</li>
            @endforeach
        </ul>
</x-layout>
    