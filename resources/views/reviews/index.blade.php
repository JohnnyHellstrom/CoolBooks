<x-layout>
   <h1 class="text-4xl"> review page / book view </h1>
   <h3 class="text-3xl" style="margin-bottom:10rem"> Display hero partial here? </h3>
   

   <div class="flex flex-wrap">

      {{-- Column with Create new review and/or Edit review --}}
      <div class="w-1/2 flex flex-col">
         <div class="p-6">
            @include('reviews.create-review')
         </div>

         <div class="p-6">   
            @include('reviews.edit-review')        
         </div>
      </div>

      {{-- Column with all reviews for a book --}}
      <div class="w-1/2 flex flex-col">
         <div class="p-6">
            @include('reviews.all-reviews')
         </div>

      </div>

   </div>

</x-layout> 