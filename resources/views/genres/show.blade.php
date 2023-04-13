<x-layout>

    <header class="text-center">
        <h3 class="text-3xl font-bold mb-2 capitalize">{{$genre->name}}</h3>
    </header>
        
    <div class="mx-4 flex flex-col items-center justify-center text-center">      
        <p class="font-bold mt-5">Include any more information?</p>

        <a href="/genres" class="text-black text-2xl m-10 ml-4"><i class="fa-solid fa-arrow-left"></i> Back to Genres</a>
    </div>

</x-layout>