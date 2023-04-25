<x-layout> 

   <header class="text-center">
       <h2 class="text-3xl font-bold mb-1">Are you sure that you want to remove the flag?</h2>     
   </header>

   <div class="mx-4 flex flex-col items-center justify-center text-center">
      <form  method="POST" action="/comments/flag/{{$comment->id}}">
         @csrf
         @method('put')
         <div class="m-6">
            <x-button-create>Confirm flaggremoval</x-button-create>
            <a href="/reviews" class="text-black m-10 ml-12"><i class="fa-solid fa-arrow-left" ></i> Back to moderator page</a>
        </div>
      </form>
   </div>

</x-layout>