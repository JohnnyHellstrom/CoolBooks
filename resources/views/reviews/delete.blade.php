<x-layout> 

   <header class="text-center">
       <h2 class="text-3xl font-bold mb-1">
         Are you sure that you want to delete the review created by {{$review->users->user_name}} and ALL associated comments and replies?? </h2>     
   </header>

   <div class="mx-4 flex flex-col items-center justify-center text-center">
       <form method="POST" action="/reviews/{{$review->id}}">
           @csrf
           @method('DELETE')
           
           <div class="m-6">
               <x-button-create>Confirm delete for the Review</x-button-create>
               <a href="/reviews" class="text-black m-10 ml-12"><i class="fa-solid fa-arrow-left" ></i> Back to the flagged reviews</a>
           </div>
       </form>
   </div>

</x-layout>