<x-layout>
   <h1 class="text-4xl text-center mb-4"> Moderator page </h1>

   <h3 class="text-2xl mb-2"> All Flagged Reviews</h3>
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
         <a href="/reviews/user/{{$review->users->id}}"><i> {{"Posted by: " . $review->users->user_name}} </i></a>
      </div>
   </section>
   @endforeach
   
   {{-- Show flagged comments --}}
   <h3 class="text-2xl mt-6"> All Flagged Comments </h3>
   @foreach($comments as $comment)        
      <section class="px-4 mt-2">
         <div class="flex">
            <a href="/comments/flag/{{$comment->id}}"><i class="fa-sharp fa-solid fa-flag text-red-700 mr-4"></i></a>
            <a href="/comments/hide/{{$comment->id}}"><x-button-hide>Hide</x-button-hide></a>
         </div>
         <div class="flex">
            <a href="/reviews/user/{{$comment->users->id}}" class="mr-2"><b> {{$comment->users->user_name}}: </b></a>
            <p class="text-xs pt-1"><i> {{$comment->timeSincePost()}} </i></p>
         </div>
         <p> {{$comment->comment}} </p>
      </section>                      
   @endforeach

   {{-- Show flagged Subcomments/replies --}}
   <h3 class="text-2xl mt-6">All Flagged Replys </h3>
   @foreach($subcomments as $subcomment)
   <section class="flex flex-col my-2 ml-6">
      <div class="flex flex-col">
         <div class="flex">
            <a href="/subcomments/flag/{{$subcomment->id}}"><i class="fa-sharp fa-solid fa-flag text-red-700 mr-4"></i></a>
            <a href="/subcomments/hide/{{$subcomment->id}}"><x-button-hide>Hide</x-button-hide></a>
         </div>
         <div class="flex">
            <span><i> {{$subcomment->timeSinceReply()}} </i></span>
            <a href="/reviews/user/{{$subcomment->users->id}}" class="px-1"><b> {{$subcomment->users->user_name . ":"}} </b></a>
         </div>

      </div>
      <p> {{$subcomment->subcomment}} </p>
   </section>
   @endforeach

</x-layout> 