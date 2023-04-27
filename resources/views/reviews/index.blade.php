<x-layout>
   <h1 class="text-4xl text-center mb-4"> Moderator page </h1>

   <h3 class="text-2xl mb-2"> Flagged Reviews</h3>

   {{-- Calender input --}}
   <form action="/reviews">
      <div date-rangepicker class="mb-6 flex items-center">
         <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
               <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
            </div>
            <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
         </div>
         <span class="mx-4 text-gray-500">to</span>
         <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
               <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
            </div>
            <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
         </div>
         <button type="submit" class="ml-8 h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600">Filter</button>
      </div>

   </form>


   @foreach ($reviews as $review)
   <section class="min-w-200 border-solid border-2 border-grey-600 p-6">
      <div class="flex place-content-between">
         <h4 class="text-2xl inline:block"> {{$review->headline}} <h4>
         
         <div>
            <a href="/reviews/flag/{{$review->id}}"><i class="fa-sharp fa-solid fa-flag text-red-700 px-4"></i></a>
            <a href="/reviews/{{$review->id}}/hide"><x-button-hide>Hide</x-button-hide></a>           
            <form class="inline-block" method="" action="/reviews/delete/{{$review->id}}">
               @csrf
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
   <h3 class="text-2xl mt-6"> Flagged Comments </h3>
   @foreach($comments as $comment)        
      <section class="px-4 mt-2">
         <div class="flex">
            <a href="/comments/flag/{{$comment->id}}"><i class="fa-sharp fa-solid fa-flag text-red-700"></i></a>
            <a class="mx-4" href="/comments/hide/{{$comment->id}}"><x-button-hide>Hide</x-button-hide></a>
            <form class="inline-block" method="" action="/comments/delete/{{$comment->id}}">
               @csrf
               <x-button-delete>Delete</x-button-delete>
            </form>
         </div>
         <div class="flex">
            <a href="/reviews/user/{{$comment->users->id}}" class="mr-2"><b> {{$comment->users->user_name}}: </b></a>
            <p class="text-xs pt-1"><i> {{$comment->timeSincePost()}} </i></p>
         </div>
         <p> {{$comment->comment}} </p>
      </section>                      
   @endforeach

   {{-- Show flagged Subcomments/replies --}}
   <h3 class="text-2xl mt-6">Flagged Replys </h3>
   @foreach($subcomments as $subcomment)
   <section class="flex flex-col my-2 ml-6">
      <div class="flex flex-col">
         <div class="flex">
            <a href="/subcomments/flag/{{$subcomment->id}}"><i class="fa-sharp fa-solid fa-flag text-red-700"></i></a>
            <a class="mx-4" href="/subcomments/hide/{{$subcomment->id}}"><x-button-hide>Hide</x-button-hide></a>
            <form class="inline-block" method="" action="/subcomments/delete/{{$subcomment->id}}">
               @csrf
               <x-button-delete>Delete</x-button-delete>
            </form>
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