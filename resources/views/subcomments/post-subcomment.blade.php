<div id="subcomment-comment-{{$comment->id}}" class="py-2 hidden">
   <form action="/subcomments" method="POST">
      @csrf 
      <div class="mb-2">
         <input type="hidden" name="comment_id" value="{{$comment->id}}">
            <textarea class="border border-gray-200 rounded" 
               name="subcomment" id="input-text"
               rows="5"
               cols="50"
               maxlength="250"
               placeholder="Here..."></textarea>
               <p id="charcounter">250 chars remaining</p>
               @error('subcomment') <!-- another directive, this is an error directive -->
               <p class="text-red-500 text-xs mt-1">{{$message}}</p>
               @enderror  
      </div>
      <x-button-create>Post Reply</x-button-create>
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