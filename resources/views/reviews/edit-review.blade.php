@php
   // SHOULD BE SOMEKIND OF IF USER HAS POSTED A REVIEW
   $review = $reviews[0];
@endphp
<h3 class="text-2xl text-center" > Edit my review </h3>
<form method="POST" action="/reviews/{{$review->id}}">
   @csrf
   @method('put')
   
      {{-- CHANGE VALUE TO BOOK_ID --}}
   <input type="hidden" name="book_id" value="1">

   <div class="flex flex-col p-6 border-solid border-2 border-grey-600">
      
      {{-- Input headline --}}
      <div class="mb-6">
         <label for="headline" class="inline-block">Headline:</label>
         <input type="text" class="border border-gray-200 rounded" name="headline" value="{{$review->headline}}">
      </div>

      {{-- Add/input rating --}}
      <div class="mb-6">
         <x-rating-input />     
      </div>

      {{-- Input review text --}}
      <div class="mb-6">
         <label for="review_text" class="block">Review</label>
         <textarea class="w-full border border-gray-200 rounded" 
            name="review_text" 
            rows="5"
            placeholder="Type your review">{{$review->review_text}}</textarea>
      </div>

      {{-- Create - Button component --}}
      <x-button-create>
      Edit Review
      </x-button-create>
   </div>
</form>