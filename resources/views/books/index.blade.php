<x-layout>
    
    @php
        $sortOrders = ['Title, A to Ö', 'Title, Ö to A', 'Last updated'];
    @endphp

    {{-- OrderBy bar --}}
    <form action="/books" method="get">
        <div class="relative border-2 border-gray-100 m-4 rounded-lg flex items-center">
            <select name="sortOrder" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none text-center">
                @foreach ($sortOrders as $sortOrder)
                    <option value="{{$sortOrder}}" {{$selected == $sortOrder ? 'selected' : '' }}>{{$sortOrder}}</option>
                @endforeach    
            </select>
            <div class="absolute top-2 left-2">
                <button type="submit" class="w-48 text-white font-bold py-2 px-4 rounded-full bg-gray-500 hover:bg-emerald-700">Sort</button>
            </div>
        </div>
    </form>

    <header>
        <h2 class="text-3xl text-center font-bold my-2 uppercase">Books</h2>
        <div class="flex justify-center md:justify-center mt-1 mb-2">
            @can('view-button-for-admin')
                <x-button-create><a href="/books/create">Create Book</a></x-button-create>
            @endcan
            @can('view-button-for-user')
            <a href="/livesearch">
                <button class="w-48 py-2 px-4 rounded-full text-white-400 bg-gradient-to-r from-purple-500 to-pink-500 ml-2">
                    <i class="fa-solid fa-magnifying-glass fa-spin"></i> Search
                </button>
            </a>
            @endcan
        </div>
    </header>

    <table class="w-full table-auto rounded-sm">
        <tbody>
            @if (!$books->isEmpty())
                @foreach ($books as $book)
                    <tr class="border-gray-300">
                        <td class="px-2 py-4 border-t border-b border-gray-300">
                            <a href="/books/{{ $book->id }}"><img
                                    src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/no-image.jpg') }}"
                                    class="h-40"></a>
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

                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg text-right">
                            <a href="/books/{{$book->id}}"><x-button-view>View</x-button-view></a> 
                            @can('view-button-for-admin')|
                            <a href="/books/{{$book->id}}/edit"><x-button-edit>Edit</x-button-edit></a> |
                            <br>
                            <a href="/books/{{$book->id}}/hide"><x-button-hide>Hide</x-button-hide></a> |
                            <a href="/books/{{$book->id}}/delete"><x-button-delete>Delete</x-button-delete></a> |
                            @endcan
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
        {{ $books->appends(['sortOrder' => $selected])->links() }}
    </div>
</x-layout>
