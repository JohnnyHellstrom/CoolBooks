<x-layout>

    <header class="text-center">
        <h3 class="text-3xl font-bold mb-2">{{$author->first_name . ' ' . $author->last_name}}</h3>
    </header>
        
    <div class="mx-4 flex flex-col items-center justify-center text-center">      
        <p class="font-bold mt-5">Include more information, e.g.</p>
        <p>Photo/image</p>
        <p>Biography</p>
        <p>Partial with books by author, list/grid</p>
        <p># of books by author</p>
        <p>Genre(s)</p>

        <a href="/authors" class="text-black text-2xl m-10 ml-4"><i class="fa-solid fa-arrow-left"></i> Back to Authors</a>
    </div>

</x-layout>