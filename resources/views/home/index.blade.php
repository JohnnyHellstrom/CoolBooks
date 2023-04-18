<x-layout>
   
   @include('partials._search')
   @include('partials._hero')

@if(!$books->isEmpty())
   <div class="grid gap-2 grid-cols-3 grid-rows-3 justify-items-center mt-10 ">
      {{--have a check if det database if empty--}}
   @foreach($books as $book)
   @if($book->is_deleted == 0)
   <div class="w-48 tooltip pb-2">
      <div class="">
      <a class="self-center" href="/books/{{$book->id}}"><img
         class="w-36"
         src="{{$book->image ? asset('storage/' . $book->image) : asset('images/no-image.png')}}"
         alt=""/></a>
         <span class="tooltiptext">Title:<br><b>{{$book->title}}</b> <br> Author:<br><b>{{$book->authors[0]['first_name']}} {{$book->authors[0]['last_name']}}</b> </span>
         {{-- {{dd($book->authors)}} --}}
      </div>
      <div class="w-36">

         {{--check to se if there is a rating for the book--}}
         @unless($rating == null)
         <span>
            <p class=" flex"><x-rating :rating="$rating->rating" /></p>
         </span>
               @else
            <p>Rating: 0/5</p>
         @endunless
         {{-- <p>{{$book->author}}</p> --}}
      </div>
   </div>
   @endif
   @endforeach
@else
   <p class="text-center">No Books found</p>
   </div>
@endif  
</x-layout>