
<x-layout>
<h3 class="text-2xl text-center" > Edit my review </h3>
<form method="POST" action="/reviews/{{$review->id}}">
   @csrf
   @method('put')
   
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
         <label  for="review_text" class="block">Review</label>
         <textarea id="review_text" class="w-full border border-gray-200 rounded" 
            name="review_text" 
            rows="5"
            ><?php echo $review->review_text ?></textarea>
      </div>

      {{-- Create - Button component --}}
      <x-button-create>
      Edit Review
      </x-button-create>
      <a href="/books/{{$review->book_id}}" class="text-black m-10 ml-4"><i class="fa-solid fa-arrow-left"></i> Back to the reviews</a>
   </div>
</form>
<script> 
   tinymce.init({
      selector:'#review_text'
   });
</script>
</x-layout>