<x-layout>
   <h1 class="text-4xl mb-4"> Moderator page </h1>

   <h3 class="text-2xl">Flagged Reviews</h3>
   @foreach ($reviews as $review)
   <section class="min-w-200 border-solid border-2 border-grey-600 p-6">
      <div class="flex place-content-between">
         <h4 class="text-2xl inline:block"> {{$review->headline}} <h4>
         
         <div>

            <a href="/reviews/flag/{{$review->id}}"><i class="fa-sharp fa-solid fa-flag text-red-700 px-4"></i></a>
            <a href="/reviews/{{$review->id}}/hide"><x-button-hide>Hide</x-button-hide></a>
            
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
      <div class="flex my-4 place-content-between">
         <div>
            @include('reviews.like-buttons')
         </div>
         <p><i> {{"Posted by: " . $review->users->user_name}} </i></p>
      </div>
   </section>
   @endforeach
   
   {{-- Show flagged comments --}}
   <h3 class="text-2xl mt-6">Flagged Comments</h3>
   @foreach($comments as $comment)        
      <div class="px-4 mt-2">
         <div class="flex">
               <form method="POST" action="/comments/flag/{{$comment->id}}">
                  @csrf
                  <button><i class="fa-sharp fa-regular fa-flag fa-2xs pl-1"></i></button>
               </form>
               <span class="px-2"><b> {{$comment->users->user_name}}: </b></span>
               <span class="text-xs pt-1"><i> {{$comment->timeSincePost()}} </i></span>
         </div>
         <p> {{$comment->comment}} </p>
      </div>                      
   @endforeach

   {{-- Show flagged Subcomments/replys --}}
   <h3 class="text-2xl mt-6">Flagged Replys</h3>
   @foreach($Subcomments as $subcomment)
   <div class="flex flex-col">
      <div class="flex">
         <form method="POST" action="/subcomments/flag/{{$subcomment->id}}">
            @csrf
            <button><i class="fa-sharp fa-regular fa-flag fa-2xs p-1"></i></button>
         </form>
         <span class="pr-2"><i> {{$subcomment->timeSinceReply()}} </i></span>
         <p class="pr-1"><b> {{$subcomment->users->user_name . ":"}} </b></p>
      </div>
      <p class="pl-4"> {{$subcomment->subcomment}} </p>
   </div>
   @endforeach

</x-layout> 