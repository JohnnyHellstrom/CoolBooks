<x-layout>     

    <header>
        <h2 class="text-3xl text-center font-bold my-6 uppercase">Genres</h2>
        <div class="flex justify-center md:justify-center mt-1 mb-5">        
            <x-button-create><a href="/genres/create">Create New Genre</a></x-button-create>
        </div>      
    </header>

   <table class="w-full table-auto rounded-sm">
        <tbody>
            @if(!$genres->isEmpty())
                @foreach($genres as $genre)
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg capitalize">
                            <a href="/genres/{{$genre->id}}">{{$genre->name}}</a>
                        </td>
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg max-w-lg">
                            <a href="/genres/{{$genre->id}}">{{$genre->description}}</a>
                        </td>
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg capitalize text-right">
                            <a href="/genres/{{$genre->id}}"><x-button-view>View</x-button-view></a> |
                            <a href="/genres/{{$genre->id}}/edit"><x-button-edit>Edit</x-button-edit></a> |
                            <br>
                            <a href="/genres/{{$genre->id}}/hide"><x-button-hide>Hide</x-button-hide></a> |
                            <a href="/genres/{{$genre->id}}/delete"><x-button-delete>Delete</x-button-delete></a> |
                        </td>
                    </tr>  
                @endforeach
            @else
                <tr class="border-gray-300">
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <p class="text-center">No genres found</p>
                </td>
                </tr>
            @endif  
        </tbody>
   </table>

    {{-- Pagination --}}
    <div class="mt-6 p-4">
        {{$genres->onEachSide(0)->links()}}
    </div>

</x-layout>