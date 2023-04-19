<div id="subcomment-comment-{{$comment->id}}" class="py-2 hidden">
   <form action="/subcomments" method="POST">
      @csrf 
      <div class="mb-2">
         <input type="hidden" name="comment_id" value="{{$comment->id}}">
            <textarea class="border border-gray-200 rounded" 
               name="subcomment" 
               rows="5"
               cols="50"
               placeholder="Here..."></textarea>
      </div>
      <x-button-create>Post Reply</x-button-create>
   </form>
</div>