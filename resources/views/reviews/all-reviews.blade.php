<h3 class="text-2xl text-center pt-6" > Show all reviews for this book </h3>
@foreach ($books->reviews as $review)
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
      <p class="text-xs"> {{$review->created_at}} </p>
      <x-rating :rating="$review->rating" />   {{-- Rating component --}}
      <p> {{$review->review_text}} </p>
      <div class="my-4">
         <i class="text-green-700 fa-solid fa-thumbs-up"></i>
         <i class="text-red-700  fa-regular fa-thumbs-up rotate-180"></i>
      </div>
      <hr>

      {{-- Post a comment --}}
      <button class="mt-2 p-2 rounded-full bg-gray-500" onclick="hideShow('comment-input')">Comment the Review</button>
      <div id="comment-input" class="py-2 hidden">
         <form action="/comments" method="POST">
            @csrf 
            <input type="hidden" name="review_id" value="{{$review->id}}">

            <div class="mb-2">

               <textarea class="w-full border border-gray-200 rounded" 
                  name="comment" 
                  rows="5"
                  placeholder="Here..."></textarea>
            </div>
            <x-button-create>Post Comment</x-button-create>
         </form>
      </div>

      {{-- Show Comments for the review --}}
      <button class="mt-2 p-2 rounded-full bg-gray-500" onclick="hideShow('comments-review-{{$review->id}}')">Read Comments <i class="fa-solid fa-plus"></i></button>
      <div id="comments-review-{{$review->id}}"class="p-1 text-xs hidden">
         @foreach($review->commentRecursive as $comment)
         
            <div class=" min-w-200 border-solid border-2 border-grey-600">
               <div class="flex place-content-between">
                  <span> User_id: {{$comment->user_id}} </span>
                  <form class="inline-block" method="POST" action="/comments/{{$comment->id}}">
                     @csrf
                     @method('DELETE')
                     <x-button-delete>Delete</x-button-delete>
                  </form>
               </div>


               <p> {{$comment->comment}} </p>
            </div>

            {{-- Subcomments for comment --}}
            <div class="pl-6">
               <h5>Replys <i class="fa-solid fa-plus"></i></h5>
               @foreach($comment->subcomments as $subcomment)
               <p> {{$subcomment->subcomment}} </p>
               @endforeach
            </div>

                        
         @endforeach
      </div>   

   </div> 
@endforeach
<script>
   function hideShow(div) {
     var x = document.getElementById(div);
     if (x.style.display === "none") {
       x.style.display = "block";
     } else {
       x.style.display = "none";
     }
   }
</script>