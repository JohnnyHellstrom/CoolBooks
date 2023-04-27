<div id="comment-review-{{$review->id}}" class="py-2 hidden">
   <form action="/comments" method="POST">
      @csrf 
      <input type="hidden" name="review_id" value="{{$review->id}}">
      <div class="mb-2">
         <textarea class=" border border-gray-200 rounded" 
            name="comment" id="input-text" maxlength="250"
            rows="5"
            cols="50"
            placeholder="Here..."></textarea>
            <p id="charcounter">250 chars remaining</p>
            @error('comment') <!-- another directive, this is an error directive -->
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror  
      </div>
      <x-button-create>Post Comment</x-button-create>
   </form>
</div>
<script>
   const inputText = document.getElementById('input-text');
   const charCount = document.getElementById('charcounter');

   inputText.addEventListener('input', function() {
   const remainingChars = 250 - inputText.value.length;
   charCount.textContent = remainingChars + ' chars remaining';
   });

   // Calculate initial remaining characters on page load
   const initialChars = 250 - inputText.value.length;
   charCount.textContent = initialChars + ' chars remaining';
</script>