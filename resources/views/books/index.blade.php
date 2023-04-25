<x-layout>     
  @include('partials._search')

   <header>
      <h2 class="text-3xl text-center font-bold my-2 uppercase">Books</h2>
      <div class="flex justify-center md:justify-center mt-1 mb-1"> 
        @if(auth()->user() && auth()->user()->is_admin)        
        <x-button-create><a href="/books/create">Create Book</a></x-button-create>
        @endif
      </div>      
   </header>   

   <table class="w-full table-auto rounded-sm"> 
      <tbody>
        @if(!$books->isEmpty())
          @foreach($books as $book)
            <tr class="border-gray-300">
                <td class="px-2 py-4 border-t border-b border-gray-300">
                    <a href="/books/{{$book->id}}"><img src="{{$book->image ? asset('storage/' . $book->image) : asset('images/no-image.png')}}" class="w-36"></a>
                </td>
                <td class="px-2 py-4 border-t border-b border-gray-300 text-lg truncate max-w-xs">
                    <p class="truncate">{{$book->description}}</p>
                </td>
                @foreach($book->authors as $author)
                  <td class="py-4 border-t border-b border-gray-300 text-lg">
                    <a href="/authors/{{$author->id}}">{{$author->first_name . " " . $author->last_name}}</a>
                  </td>
                @endforeach
                <td class="px-0 py-4 border-t border-b border-gray-300 text-lg">
                  <a href="/books/{{$book->id}}">{{$book->genres['name']}}</a>
                </td>
                
                <td class="px-2 py-4 border-t border-b border-gray-300 text-lg text-right">
                  @if(auth()->user() && auth()->user()->is_admin)
                  <a a href="/books/{{$book->id}}/edit"><x-button-edit>Edit</x-button-edit></a> |
                  <form method="POST" action="/books/{{$book->id}}">
                    @csrf
                    @method('delete')
                    <x-button-delete>Delete</x-button-delete>
                  </form> |
                  @endif
                  <a href="/books/{{$book->id}}"><x-button-view>View</x-button-view></a>
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

</x-layout>

<div class="mt-6 p-4">
  {{$books->links()}}
</div>