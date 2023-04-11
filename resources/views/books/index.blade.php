<x-layout>     

   <header>
      <h2 class="text-3xl text-center font-bold my-6 uppercase">Books</h2>
      <a href="/books/create" class="absolute top-10 right-10 mt-4 bg-blue-500 text-white rounded-full px-6 py-2"><i class="fa fa-plus" aria-hidden="true"></i>Create Book</a>
   </header>

   <table class="w-full table-auto rounded-sm">
      <tbody>
        @if(!$books->isEmpty())
          @foreach($books as $book)
            <tr class="border-gray-300">
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <a href="/books/{{$book->id}}">{{$book->title}}</a>
                </td>
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <a href="/" class="text-blue-400 px-6 py-2 rounded-xl"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                </td>
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                  <form method="POST" action="/">
                    <button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
                  </form>
                </td>
                <td>
                  <button class="text-yellow-500"><i class="fa fa-eye" aria-hidden="true"></i>View</button>
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