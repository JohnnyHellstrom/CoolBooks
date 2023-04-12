<x-layout>
   @include('partials._hero')

@if(!$books->isEmpty())
   <div class="grid gap-4 grid-cols-3 grid-rows-3 mt-10">
   @foreach($books as $book)
   <div class="grid gap-4 grid-cols-3 grid-rows-1">
      <a href="/books/{{$book->id}}"><img
         class="w-48 mr-6 mb-6"
         src="{{$book->image ? asset('storage/' . $book->image) : asset('images/no-image2.png')}}"
         alt=""/></a>
      <div>
         <h2><a href="/books/{{$book->id}}">{{$book->title}}</a></h2>
         {{-- Rating component
         <x-rating :rating="$review->rating" /> --}}
         <p>{{$book->author}}</p>
      </div>
      <div>
      </div>
   </div>
   @endforeach
@else
   <p class="text-center">No Books found</p>
   </div>
@endif  
</x-layout>