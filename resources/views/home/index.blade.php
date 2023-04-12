<x-layout>
   @include('partials._hero')

@if(!$books->isEmpty())
   <div class="grid gap-2 grid-cols-3 grid-rows-3 justify-item-center mt-10">
   @foreach($books as $book)
   <div class="grid gap-2 grid-cols-2 grid-rows-1 ">
      <a href="/books/{{$book->id}}"><img
         class="w-48 mr-6 "
         src="{{$book->image ? asset('storage/' . $book->image) : asset('images/no-image2.png')}}"
         alt=""/></a>
      <div>
         <h2 class="text-2 font-bold uppercase">Title:</h2> 
         <a href="/books/{{$book->id}}">{{$book->title}}</a>
         {{--Rating component--}}
         <p><x-rating :rating="$rating->rating" /></p>
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