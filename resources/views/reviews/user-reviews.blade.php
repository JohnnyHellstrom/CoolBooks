<x-layout>
   <div class="flex items-center justify-center my-8">
      <h1 class="text-4xl"> Moderator page </h1>
      <a href="/reviews" class="text-black ml-12"><i class="fa-solid fa-arrow-left" ></i> Back to the flagged reviews</a>   
   </div>

   @if(!$reviews->isEmpty())
   <h3 class="text-2xl"> All Reviews by: {{$reviews[0]->users->user_name}}</h3>
      @foreach ($reviews as $review)
      <section class="min-w-200 border-solid border-2 border-grey-600 p-6">

         <h4 class="text-2xl inline:block"> {{$review->headline}} <h4>                                           
         <p class="text-xs"> {{$review->created_at}} </p>
         <x-rating :rating="$review->rating" />   {{-- Rating component --}}
         <p><?php echo $review->review_text ?></p>
              
         <div class="flex my-4 place-content-between">
            <div>
               @include('reviews.like-buttons')   {{-- Like/Dislike buttons --}}
            </div>
            <a href="/reviews/user/{{$review->users->id}}"><i> {{"Posted by: " . $review->users->user_name}} </i></a>
         </div>
      </section>
      @endforeach
   @endif
   
   {{-- Show flagged comments --}}
   @if(!$comments->isEmpty())
      <h3 class="text-2xl mt-6"> All Comments by: {{$comments[0]->users->user_name}} </h3>
      @foreach($comments as $comment)        
         <section class="px-4 mt-2">
            <div class="flex">
               <a href="/reviews/user/{{$comment->users->id}}" class="mr-2"><b> {{$comment->users->user_name}}: </b></a>
               <p class="text-xs pt-1"><i> {{$comment->timeSincePost()}} </i></p>
            </div>
            <p> {{$comment->comment}} </p>
         </section>                      
      @endforeach
   @endif   
   {{-- Show flagged Subcomments/replies --}}
   @if(!$subcomments->isEmpty())
      <h3 class="text-2xl mt-6">All Replies by: {{$subcomments[0]->users->user_name}} </h3>
      @foreach($subcomments as $subcomment)
      <section class="flex flex-col my-2 ml-6">
         <div class="flex">
            <span><i> {{$subcomment->timeSinceReply()}} </i></span>
            <a href="/reviews/user/{{$subcomment->users->id}}" class="px-1"><b> {{$subcomment->users->user_name . ":"}} </b></a>
         </div>
         <p> {{$subcomment->subcomment}} </p>
      </section>
      @endforeach
   @endif
</x-layout> 