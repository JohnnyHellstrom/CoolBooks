<x-layout>

        <h1>Highest rated books</h1>
        <ul>
        <table class="w-full table-auto rounded-sm">
            @foreach ($booksHighest as $book)
                <td class="px-2 py-4 border-t border-b border-gray-300"
                    <li>
                        {{ $book->title}}
                        <a href="/books/{{ $book->id }}"><img
                            src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/no-image.jpg') }}"
                            class="w-30 h-40">
                        </a>
                        ({{ number_format($book->avg_rating, 1) }})
                    </li>
            @endforeach
                </td>
        </ul>
    </table>
        <h1>Lowest rated books</h1>
        <ul>
            <table class="w-full table-auto rounded-sm">
            @foreach ($booksLowest as $book)
            <td class="px-2 py-4 border-t border-b border-gray-300">
                <li>
                    {{ $book->title}}
                    <a href="/books/{{ $book->id }}"><img
                        src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/no-image.jpg') }}"
                        class="w-30 h-40">
                    </a>
                    ({{ number_format($book->avg_rating, 1) }})
                </li>
            @endforeach
        </ul>
    </table>
</x-layout>
