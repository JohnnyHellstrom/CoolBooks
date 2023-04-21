<x-layout>

    <form action="/authors">
    <div class="relative border-2 border-gray-100 m-4 rounded-lg">
        <div class="absolute top-4 left-3">
            <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
        </div>
        <input type="text" name="search" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none" placeholder="Search Author Information..."/>
        <div class="absolute top-2 right-2">
            <button type="submit" class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600">Search</button>
        </div>
    </div>
    </form>

    <header>
        <h2 class="text-3xl text-center font-bold my-6 uppercase">Authors</h2>
        <div class="flex justify-center md:justify-center mt-1 mb-5">
            <x-button-create><a href="/authors/create">Create New Author</a></x-button-create>
        </div>
    </header>

    <table class="w-full table-auto rounded-sm">
        <tbody>
            @if(!$authors->isEmpty())
                @foreach($authors as $author)
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <img src="{{$author->author_image ? asset('storage/' . $author->author_image) : asset('images/no-author_image.svg')}}" class="w-36">
                        </td>
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg capitalize">
                            <a href="/authors/{{$author->id}}">{{$author->first_name . ' ' . $author->last_name}}</a>
                        </td>
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg max-w-xs">
                            <div class="tooltip2">
                                <p class="truncate">{{$author->biography}}</p>
                                <p class="tooltip_author-bio">{{$author->biography}}</p>
                            </div>
                        </td>
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg text-right">
                            <a href="/authors/{{$author->id}}"><x-button-view>View</x-button-view></a> |
                            <a href="/authors/{{$author->id}}/edit"><x-button-edit>Edit</x-button-edit></a> |
                            <br>
                            <a href="/authors/{{$author->id}}/hide"><x-button-hide>Hide</x-button-hide></a> |
                            <a href="/authors/{{$author->id}}/delete"><x-button-delete>Delete</x-button-delete></a> |
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="border-gray-300">
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <p class="text-center">No authors found</p>
                </td>
                </tr>
            @endif
        </tbody>
   </table>

   <div class="mt-6 p-4">
        {{$authors->onEachSide(0)->links()}}
    </div>

</x-layout>