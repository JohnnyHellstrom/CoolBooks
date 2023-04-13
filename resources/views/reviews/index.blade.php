<x-layout>
   <h1 class="text-4xl"> review page / book view </h1>
   <h3 class="text-3xl" style="margin-bottom:10rem"> Display hero partial here? </h3>
   

   <div class="flex flex-wrap">

      {{-- Column with Create new review and/or Edit review --}}
      <div class="w-1/2 flex flex-col">
         <div class="p-6">
            @include('partials._create-review')
         </div>

         <div class="p-6">   
            @include('partials._edit-review')        
         </div>
      </div>

      {{-- Column with all reviews for a book --}}
      <div class="w-1/2 flex flex-col">
         <div class="p-6">
            <h3 class="text-2xl text-center" > Show all reviews for this book </h3>

            @foreach ($reviews as $review)
               <div class="min-w-200 border-solid border-2 border-grey-600 p-6">
                  <div class="flex place-content-between">
                     <h4 class="text-2xl inline:block"> {{$review->headline}} <h4>
                     
                     <div>
                        <x-button-edit><a href="/">Edit</a></x-button-edit>
                        
                        <form class="inline-block" method="POST" action="/reviews/{{$review->id}}">
                           @csrf
                           @method('DELETE')
                           <x-button-delete>Delete</x-button-delete>
                        </form>
                     </div>
                  </div>
                                  
                  {{-- Rating component --}}
                  <p class="text-xs"> {{$review->created_at}} </p>
                  <x-rating :rating="$review->rating" />
                  <p> {{$review->review_text}} </p>
               </div>    
            @endforeach
         </div>

      </div>

   </div>

</x-layout> 