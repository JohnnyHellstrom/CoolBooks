<x-layout> 

    <header class="text-center">
        <h2 class="text-3xl font-bold mb-1">Are you sure that you want to delete the {{$genre->name}} genre ?</h2>     
        <h2 class="text-2xl font-bold mb-1">All book with this genre will be left without a genre!</h2>
    </header>

    <div class="mx-4 flex flex-col items-center justify-center text-center">
        <form method="POST" action="/genres/{{$genre->id}}" enctype="multipart/form-data">
            @csrf
            @method('delete')
            
            <p>Do we want to add any other genre information?</p>

            <div class="mb-6">
                <x-button-create>Confirm Delete of {{$genre->name}}</x-button-create>
                <a href="/genres" class="text-black m-10 ml-4"><i class="fa-solid fa-arrow-left"></i> Back to Genres</a>
            </div>
        </form>
    </div>

</x-layout>