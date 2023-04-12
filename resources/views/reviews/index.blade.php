<x-layout>
   <h1 class="text-4xl"> review page / book view </h1>
   <h3 class="text-3xl" style="margin-bottom:10rem"> Display hero partial here? </h3>
   

   <div class="flex flex-wrap">

      {{-- Column with Create new review and/or Edit review --}}
      <div class="w-1/2 flex flex-col">
         <form method="POST" action="/reviews">
            @csrf 
               {{-- CHANGE VALUE TO BOOK_ID --}}
            <input type="hidden" name="book_id" value="1">

            <h3 class="text-2xl text-center"> Post a review </h3>
            <div class="flex flex-col p-10 border-solid border-2 border-grey-600">
               
               {{-- Input headline --}}
               <div class="mb-6">
                  <label for="headline" class="inline-block">Headline:</label>
                  <input type="text" class="border border-gray-200 rounded" name="headline" value="{{old('headline')}}">
               </div>

               {{-- Add/input rating --}}
               <div class="mb-6">
                  @for ($i = 1; $i < 6; $i++)
                  <label>
                     <input class="" type="radio" name="rating" value="{{$i}}"/>
                     <img class="w-12 inline-block" 
                           src="{{asset('images/elephpant-running-78x48.gif')}}" alt="star">
                  </label>
                  
                  @endfor               
               </div>

               {{-- Input review text --}}
               <div class="mb-6">
                  <label for="review_text" class="block">Review</label>
                  <textarea class="w-full border border-gray-200 rounded" 
                     name="review_text" 
                     rows="5"
                     placeholder="Type your review">{{old('review_text')}}</textarea>
               </div>

               {{-- Create - Button component --}}
               <x-create-button>
               Submit Review
               </x-create-button>
            </div>
         </form>

         <h3 class="text-2xl text-center" > Edit my review </h3>
         <div class="p-10 border-solid border-2 border-grey-600">           
         </div>
      </div>

      {{-- Column with all reviews for a book --}}
      <div class="w-1/2 flex flex-col">
         <h3 class="text-2xl text-center" > Show all reviews for this book </h3>
         @foreach ($reviews as $review)
            <div class="min-w-200 border-solid border-2 border-grey-600 p-5">
               <h4 class="text-2xl"> {{$review->headline}} <h4>
               
               {{-- Rating component --}}
               <x-rating :rating="$review->rating" />
 
               <p> {{$review->review_text}} </p>
            </div>    
         @endforeach
      </div>

   </div>

</x-layout> 