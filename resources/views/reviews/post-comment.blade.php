<div id="comment-review-{{$review->id}}" class="py-2 hidden">
   <form action="/comments" method="POST">
      @csrf 
      <input type="hidden" name="review_id" value="{{$review->id}}">
      <div class="mb-2">
         <textarea class=" border border-gray-200 rounded" 
            name="comment" 
            rows="5"
            cols="50"
            placeholder="Here..."></textarea>
      </div>
      <x-button-create>Post Comment</x-button-create>
   </form>
</div>