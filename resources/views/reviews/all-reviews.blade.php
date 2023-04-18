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
      <button class="mt-2 p-1 rounded-full bg-gray-500 text-xs" onclick="hideShow('comment-review-{{$review->id}}')">Comment the Review</button>
      <div id="comment-review-{{$review->id}}" class="py-2 hidden">
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
      <button class="mt-2 p-1 text-xs rounded-full bg-gray-500" onclick="hideShow('comments-review-{{$review->id}}')">Read Comments <i class="fa-solid fa-plus"></i></button>
      <div id="comments-review-{{$review->id}}"class="p-1 text-xs hidden">
         @foreach($review->comments as $comment)
       
            <div class=" min-w-200 border-solid border-2 border-grey-600">
               <div class="flex place-content-between">
                  <span> {{$comment->users->email}}: </span>
                  {{-- @php
                     dd($comment->users);
                  @endphp --}}
                  <form class="inline-block" method="POST" action="/comments/{{$comment->id}}">
                     @csrf
                     {{-- <button><i class="fas fa-flag text-red-700 p-1"></i></button> --}}
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
   let divArray = [];
   function hideShow(div){
      if(divArray.includes(div)){
         document.getElementById(div).style.display="none";
         divArray = removeDiv(divArray, div);
         return divArray;  
      } else {
         document.getElementById(div).style.display="block";
         divArray.push(div);
         return divArray;
      }
   }

   // Helpfunction to remove an item from an array
   function removeDiv(array, div) {
   let index = array.indexOf(div);
   if (index > -1) {
      array.splice(index, 1);
   }
   return array;
}
</script>