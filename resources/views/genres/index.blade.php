<x-layout>     

   <header>
      <h2 class="text-3xl text-center font-bold my-6 uppercase">Genres</h2>
   </header>

   <table class="w-full table-auto rounded-sm">
      <tbody>
        @if(!$genres->isEmpty())
            <tr>
              <th>Genre</th>
              <th>Description</th>
            </tr>

          @foreach($genres as $genre)
            <tr class="border-gray-300">
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg capitalize">
                    <a href="/genres/{{$genre->id}}">{{$genre->name}}</a>
                </td>
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg capitalize">
                    <a href="/genres/{{$genre->id}}">{{$genre->description}}</a>
                </td>
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <a href="/" class="text-blue-400 px-6 py-2 rounded-xl"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                </td>
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                  <form method="POST" action="/">
                    <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
                  </form>
                </td>
                <td>
                  <button class="text-yellow-500"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
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
      <a href="/genres/create" class=" mt-4 bg-blue-500 text-white rounded-full px-6 py-2"><i class="fa fa-plus" aria-hidden="true"></i>Create genre</a>

</x-layout>