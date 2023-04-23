<h3 class="text-2xl text-center"> Post a review </h3>
   <form method="POST" action="/reviews">
      @csrf 
      <input type="hidden" name="book_id" value="{{$books->id}}">

      <div class="flex flex-col p-6 border-solid border-2 border-grey-600">
         
         {{-- Input headline --}}
         <div class="mb-6">
            <label for="headline" class="inline-block">Headline:</label>
            <input type="text" class="border border-gray-200 rounded" name="headline" value="{{old('headline')}}">
         </div>

         {{-- Add/input rating --}}
         <div class="mb-6">
             <x-rating-input />
         </div>

         {{-- Input review text --}}
         <div class="mb-6">
            <label for="review_text" class="block">Review</label>
            <textarea id="review_text" class="w-full border border-gray-200 rounded" 
               name="review_text" 
               rows="5"
               placeholder="Type your review">{{old('review_text')}}</textarea>
         </div>

         {{-- Create - Button component --}}
         <x-button-create>Submit Review</x-button-create>
      </div>
   </form>
   <script> 
      tinymce.init({
         selector:'#review_text'
      });
   </script>
