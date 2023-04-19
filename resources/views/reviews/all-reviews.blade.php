<h3 class="text-2xl text-center pt-6" > Show all reviews for this book </h3>

{{-- FIX AUTH THING --}}
@php $user_id = 1 @endphp

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
      <p> {{$review->review_text}} </p>
      
         {{-- Like/Dislike buttons --}}
      <div class="my-4">
         @include('reviews.like-buttons');
      </div>

      <hr>

      {{-- Post a comment --}}
      <button class="mt-2 p-1 rounded-full bg-gray-500 text-xs" onclick="hideShow('comment-review-{{$review->id}}')">Comment the Review</button>
      <div id="comment-review-{{$review->id}}" class="py-2 hidden">
         <form action="/comments" method="POST">
            @csrf 
            <input type="hidden" name="review_id" value="{{$review->id}}">
            <input type="hidden" name="book_id" value="{{$books->id}}">
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

      {{-- Show Comments for the review --}}
      <button class="mt-2 p-1 text-xs rounded-full bg-gray-500" onclick="hideShow('comments-review-{{$review->id}}')">See/Hide Comments </button>
      <div id="comments-review-{{$review->id}}"class="mt-1 text-s hidden">
         @foreach($review->comments as $comment)
       
            <div class=" min-w-200 border-solid border-2 border-grey-600">
               <div class="flex place-content-between">
                  <p><b> {{$comment->users->user_name}}: </b></p>
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

            <div class="mb-2 pl-4">

              {{-- Post a reply --}}
               <button class="p-1 rounded-full bg-gray-500 " onclick="hideShow('subcomment-comment-{{$comment->id}}')">Reply</button>
               <div id="subcomment-comment-{{$comment->id}}" class="py-2 hidden">
                  <form action="/subcomments" method="POST">
                     @csrf 
                     <div class="mb-2">
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                        <input type="hidden" name="book_id" value="{{$books->id}}">
                           <textarea class="border border-gray-200 rounded" 
                              name="subcomment" 
                              rows="5"
                              cols="50"
                              placeholder="Here..."></textarea>
                     </div>
                     <x-button-create>Post Reply</x-button-create>
                  </form>
               </div>

               {{-- Show subcomments/replys for comment --}}
               @if(!$comment->subcomments->isEmpty())
                        <button 
                        class=" p-1 text-s rounded-full bg-gray-500" 
                        onclick="hideShow('subcomments-comment-{{$comment->id}}')">
                        Show replys
                     </button>
                     <div id="subcomments-comment-{{$comment->id}}" class=" hidden">

                        @foreach($comment->subcomments as $subcomment)
                        <div class="flex">
                           <p><b> {{$subcomment->users->user_name . ": "}} </b></p>
                           <p> {{$subcomment->subcomment}} </p>
                           <form method="POST" action="/subcomments/flag/{{$subcomment->id}}">
                              @csrf
                              <button><i class="fas fa-flag text-red-700 p-1"></i></button>
                           </form>
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