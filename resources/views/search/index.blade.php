<x-layout>
    <table class="w-full table-auto rounded-sm">
        <tbody>
            @if (!$books->isEmpty())
                @foreach ($books as $book)
                    <tr class="border-gray-300">
                        <td class="px-2 py-4 border-t border-b border-gray-300">
                            <a href="/books/{{ $book->id }}"><img
                                    src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/no-image.jpg') }}"
                                    class="w-36"></a>
                        </td>
                        <td class="px-2 py-4 border-t border-b border-gray-300 text-lg truncate max-w-xs">
                            <p class="truncate">{{ $book->description }}</p>
                        </td>
                        @foreach ($book->authors as $author)
                            <td class="py-4 border-t border-b border-gray-300 text-lg">
                                <a href="/authors/{{ $author->id }}">{{ $author->first_name . ' ' . $author->last_name }}</a>
                            </td>
                        @endforeach
                        <td class="px-0 py-4 border-t border-b border-gray-300 text-lg">
                            <p>{{ $book->genres['name'] }}<p>
                        </td>

                        <td class="px-2 py-4 border-t border-b border-gray-300 text-lg text-right">
                            @can('view-button-for-admin')
                                <a a href="/books/{{ $book->id }}/edit">
                                    <x-button-edit>Edit</x-button-edit>
                                </a> |
                                <form method="POST" action="/books/{{ $book->id }}">
                                    @csrf
                                    @method('delete')
                                    <x-button-delete>Delete</x-button-delete>
                                </form> |
                            @endcan
                            <a href="/books/{{ $book->id }}">
                                <x-button-view>View</x-button-view>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <p class="text-center">No Books found</p>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="mt-6 p-4">
        {{ $books->links() }}
    </div>
</x-layout>