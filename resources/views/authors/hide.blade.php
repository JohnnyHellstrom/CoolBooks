<x-layout> 

    <header class="text-center">
        <h2 class="text-3xl font-bold mb-1">Are you sure that you want to hide the author {{$author->first_name . ' ' . $author->last_name}}?</h2>     
        <h2 class="text-2xl font-bold mb-1">All books, reviews etc. related to this author will also be hidden!</h2>
        <h2 class="text-2xl font-bold mb-1">Access can be restored by a person with Admin credentials!</h2>
    </header>

    <div class="mx-4 flex flex-col items-center justify-center text-center">
        <form method="POST" action="/authors/{{$author->id}}/hide">
            @csrf
            @method('put')
            
            <div class="mb-6">
                <x-button-create>Confirm Hide for {{$author->first_name . ' ' . $author->last_name}}</x-button-create>
                <a href="/authors" class="text-black m-10 ml-4"><i class="fa-solid fa-arrow-left"></i> Back to Authors</a>
            </div>
        </form>
    </div>

</x-layout>