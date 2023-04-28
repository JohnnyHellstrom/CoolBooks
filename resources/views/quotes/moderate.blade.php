<x-layout>

   <header>
      <h2 class="text-3xl text-center font-bold my-6">Moderate Quotes</h2>
  </header>
  <a href="/quotes" class="text-black text-center m-2 ml-10"><i class="fa-solid fa-arrow-left"></i> Back to Quotes</a>
   <section class="flex flex-wrap justify-center">
      @foreach ($quotes as $quote)

      {{-- Card --}}
      <div class="flex flex-col border border-gray-200 rounded p-3 m-5 w-96
      shadow-xl shadow-black">
         <p>“{{$quote->quote}}”</p>
         <p class="text-xs italic m-2">- {{$quote->quotee}}</p>

         <div class="flex place-content-around mt-2">
            @can('view-button-for-moderator')
               <form action="/quotes/{{$quote->id}}/approve" method="post">
                  @csrf
                  @method('PUT')
                  <button class="text-green-700"><i class="fa-solid fa-check mr-1"></i>Approve</button> 
               </form>
           
               <form method="POST" action="/quotes/{{$quote->id}}/hide">
                  @csrf
                  @method('PUT')
                  <x-button-hide>Hide</x-button-hide>
               </form>

               @can('view-button-for-admin') 
                  <form method="POST" action="/quotes/{{ $quote->id }}">
                     @csrf
                     @method('delete')
                     <x-button-delete>Delete</x-button-delete>
                  </form> 
               @endcan
            @endcan
         </div>
         
      </div>
      @endforeach



   </section>

</x-layout>