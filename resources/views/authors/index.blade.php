<x-layout>     

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
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg capitalize">
                            <a href="/authors/{{$author->id}}">{{$author->first_name . ' ' . $author->last_name}}</a>
                        </td>
                        <td>
                            <x-button-edit><a href="/authors/{{$author->id}}/edit">Edit</a></x-button-edit> |
                            <x-button-delete><a href="/authors/{{$author->id}}/delete">Delete</a></x-button-delete> |
                            <x-button-view><a href="/authors/{{$author->id}}">View</a></x-button-view>
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

</x-layout>