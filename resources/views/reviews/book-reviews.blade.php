<h3 class="text-2xl text-center pt-6" > Show all reviews for this book </h3>

@foreach ($books->reviews as $review)
@if($review->is_deleted == 0)
   <section class="min-w-200 border-solid border-2 border-grey-600 p-6">
      <div class="flex place-content-between">
         <h4 class="text-2xl inline:block"> {{$review->headline}} <h4>
         
         <div>
            @if($review->user_id == auth()->id())
            <x-button-edit><a href="/reviews/{{$review->id}}/edit">Edit</a></x-button-edit>
            @else
            <form class="inline-block tooltip" method="POST" action="/reviews/flag/{{$review->id}}">
               @csrf
               <button><i class="fa-sharp fa-regular fa-flag px-4"></i></button>
               <span class="tooltiptext tooltip_main">Flagg comment</span>
            </form>
            @endif
            @if (auth()->user() && auth()->user()->roles->name == 'admin')
               <form class="inline-block" method="POST" action="/reviews/{{$review->id}}">
                  @csrf
                  @method('DELETE')
                  <x-button-delete>Delete</x-button-delete>
               </form>
            @endif
         </div>   
      </div>                                 
      <p class="text-xs"> {{$review->created_at}} </p>
      <x-rating :rating="$review->rating" />   {{-- Rating component --}}
      <p><?php echo $review->review_text ?></p>
           
      <div class="flex my-4 place-content-between">
         <div>
            @include('reviews.like-buttons')  {{-- Like/Dislike buttons --}}
         </div>
         <p><i> {{"Posted by: " . $review->users->user_name}} </i></p>
      </div>

      <hr>

      {{-- Post a comment --}}
      <button class="mt-2 p-1 text-xs" onclick="hideShow('comment-review-{{$review->id}}')">Comment the Review</button>
      @include('comments.post-comment')

      {{-- Show Comments for the review --}}
      @if(!$review->comments->isEmpty())
         <button class="mt-2 p-1 text-xs" onclick="hideShow('comments-review-{{$review->id}}')">View/Hide Comments </button>
         <div id="comments-review-{{$review->id}}"class="mt-1 text-s hidden">
            @foreach($review->comments as $comment)
         
               <div class="px-4 mt-2">
                  <div class="flex">
                        @if($comment->user_id != auth()->id())
                        <form class="tooltip" method="POST" action="/comments/flag/{{$comment->id}}">
                           @csrf
                           <button><i class="fa-sharp fa-regular fa-flag fa-2xs pl-1"></i></button>
                           <span class="tooltiptext tooltip_main">Flagg comment</span>
                        </form>
                        @endif
                        <span class="px-2"><b> {{$comment->users->user_name}}: </b></span>
                        <span class="text-xs pt-1"><i> {{$comment->timeSincePost()}} </i></span>
                  </div>
                  <p> {{$comment->comment}} </p>
               </div>

               <div class="mb-2 pl-12">

                  {{-- Post a subcomment/reply --}}
                  <button class="p-1 text-xs" onclick="hideShow('subcomment-comment-{{$comment->id}}')">Reply</button>
                  @include('subcomments.post-subcomment')

                  {{-- Show subcomments/replies for comment --}}
                  @if(!$comment->subcomments->isEmpty())
                  <button class=" p-1 text-xs" onclick="hideShow('subcomments-comment-{{$comment->id}}')">Show replys</button>
                  @include('subcomments.comment-replies')
                  @endif
               </div>
                                    
            @endforeach
         </div>   
      @endif
   </section> 
@endif
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