<x-layout> 

   <header class="text-center">
       <h2 class="text-3xl font-bold mb-1">Are you sure that you want to hide the review created by {{$review->users->user_name}}?</h2>     
   </header>

   <div class="mx-4 flex flex-col items-center justify-center text-center">
       <form method="POST" action="/reviews/{{$review->id}}/hide">
           @csrf
           @method('put')
           
           <div class="m-6">
               <x-button-create>Confirm Hide for the review</x-button-create>
               <a href="/reviews" class="text-black m-10 ml-12"><i class="fa-solid fa-arrow-left" ></i> Back to the flagged reviews</a>
           </div>
       </form>
   </div>

</x-layout>