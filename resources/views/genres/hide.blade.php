<x-layout> 

    <header class="text-center">
        <h2 class="text-3xl font-bold mb-1">Are you sure that you want to hide the {{$genre->name}} genre?</h2>     
        <h2 class="text-2xl font-bold mb-1">All books with this genre will be left without a genre!</h2>
        <h2 class="text-2xl font-bold mb-1">Access can be restored by a person with Admin credentials!</h2>
    </header>

    <div class="mx-4 flex flex-col items-center justify-center text-center">
        <form method="POST" action="/genres/{{$genre->id}}/hide">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <x-button-create>Confirm Hide for {{$genre->name}}</x-button-create>
                <a href="/genres" class="text-black m-10 ml-4"><i class="fa-solid fa-arrow-left"></i> Back to Genres</a>
            </div>
        </form>
    </div>

</x-layout>