<x-layout> 

    <header class="text-center">
        <h2 class="text-3xl font-bold mb-1">Are you sure that you want to hide this book: {{$book->title}}?</h2>     
    </header>

    <div class="mx-4 flex flex-col items-center justify-center text-center">
        <form method="POST" action="/books/{{$book->id}}/hide">
            @csrf
            @method('put')
            
            <div class="mb-6">
                <x-button-create>Confirm Hide of {{$book->title}}</x-button-create>
                <a href="/books" class="text-black m-10 ml-4"><i class="fa-solid fa-arrow-left"></i> Back to Books</a>
            </div>
        </form>
    </div>

</x-layout>