<h3 class="text-2xl text-center pt-6" > Show all reviews for this book </h3>

@foreach ($books->reviews as $review)
   <div class="min-w-200 border-solid border-2 border-grey-600 p-6">
      <div class="flex place-content-between">
         <h4 class="text-2xl inline:block"> {{$review->headline}} <h4>
         
         <div>
            <form class="inline-block" method="POST" action="/reviews/flag/{{$review->id}}">
               @csrf
               <button><i class="fas fa-flag text-red-700 px-4"></i></button>
            </form>

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
      <p><?php echo $review->review_text ?></p>
      
      
         {{-- Like/Dislike buttons --}}
      <div class="my-4">
         @include('reviews.like-buttons')
      </div>
      <p><i> {{"Posted by: " . $review->users->user_name}} </i></p>
      <hr>

      {{-- Post a comment --}}
      <button class="mt-2 p-1 text-xs" onclick="hideShow('comment-review-{{$review->id}}')">Comment the Review</button>
      @include('reviews.post-comment')

      {{-- Show Comments for the review --}}
      <button class="mt-2 p-1 text-xs" onclick="hideShow('comments-review-{{$review->id}}')">See/Hide Comments </button>
      <div id="comments-review-{{$review->id}}"class="mt-1 text-s hidden">
         @foreach($review->comments as $comment)
       
            <div class=" min-w-200 border-solid border-2 border-grey-600">
               <div class="flex place-content-between">
                  <div>
                     <span><b> {{$comment->users->user_name}}: </b></span>
                     <span class="text-xs"><i> {{$comment->timeSincePost()}} </i></span>
                  </div>
                  <form method="POST" action="/comments/flag/{{$comment->id}}">
                     @csrf
                     <button><i class="fas fa-flag text-red-700 p-1"></i></button>
                  </form>

                  <form class="inline-block" method="POST" action="/comments/{{$comment->id}}">
                     @csrf
                     @method('DELETE')                    
                     <x-button-delete>Delete</x-button-delete>
                  </form>
               </div>
               <p> {{$comment->comment}} </p>
            </div>

            <div class="mb-2 pl-8">

              {{-- Post a reply --}}
               <button class="p-1 text-xs" onclick="hideShow('subcomment-comment-{{$comment->id}}')">Reply</button>
               @include('reviews.post-subcomment')

               {{-- Show subcomments/replys for comment --}}
               @if(!$comment->subcomments->isEmpty())
                  <button 
                  class=" p-1 text-xs" 
                  onclick="hideShow('subcomments-comment-{{$comment->id}}')">
                  Show replys</button>

                  <div id="subcomments-comment-{{$comment->id}}" class=" hidden">
                     @foreach($comment->subcomments as $subcomment)
                     <div class="flex flex-col">
                        <div class="flex">
                           <form method="POST" action="/subcomments/flag/{{$subcomment->id}}">
                              @csrf
                              <button><i class="fa-sharp fa-regular fa-flag text-red-700 p-1"></i></button>
                           </form>
                           <span class="pr-2"><i> {{$subcomment->timeSinceReply()}} </i></span>
                           <p class="pr-1"><b> {{$subcomment->users->user_name . ":"}} </b></p>
                        </div>
                        <p class="pl-4"> {{$subcomment->subcomment}} </p>
                     </div>
                     @endforeach
                  </div>
               @endif
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