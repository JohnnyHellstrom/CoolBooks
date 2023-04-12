<x-layout>
   
   <section
            class="relative h-72 bg-emerald-400 flex flex-col justify-center align-center text-center space-y-4 mb-4"
        >
            <div
                class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
                style="background-image: url('images/logo.png')"
            ></div>

            <div class="z-10">
                <h1 class="text-6xl font-bold uppercase text-white">
                    Cool<span class="text-black">Books</span>
                </h1>
                <p class="text-2xl text-gray-200 font-bold my-4">
                    Find your favorit read                    
                </p>
            </div>
        </section>

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