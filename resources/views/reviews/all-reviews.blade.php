<h3 class="text-2xl text-center" > Show all reviews for this book </h3>
@foreach ($reviews as $review)
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
      <div class="mt-4">
         <i class="text-green-700 fa-solid fa-thumbs-up"></i>
         <i class="text-red-700  fa-regular fa-thumbs-up rotate-180"></i>
      </div>

      {{-- Comments for the review --}}
      <div class="p-1 ">
         <h5 class="mt-4 font-bold">Comments <i class="fa-solid fa-plus"></i></h5>
         @foreach($review->commentRecursive as $comment)
         
            <div class="min-w-200 border-solid border-2 border-grey-600">
               <p> User_id: {{$comment->user_id}} </p>
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