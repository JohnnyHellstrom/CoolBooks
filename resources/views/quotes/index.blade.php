<x-layout>

   <header>
      <h2 class="text-3xl text-center font-bold my-6">Quotes</h2>
      <div class="flex justify-center md:justify-center mt-1 mb-5">
         @auth
            <x-button-create><a href="/quotes/create">Create New Quote</a></x-button-create>
         @endauth
         @can('view-button-for-moderator')
            <x-button-create class="ml-12"><a href="/quotes/moderate">Moderate Quotes</a></x-button-create>
         @endcan    
      </div>
  </header>

   <section class="flex flex-wrap justify-center">
      @foreach ($quotes as $quote)

      {{-- Card --}}
      <div class="flex flex-col border border-gray-200 rounded p-3 m-5 w-96
      shadow-xl shadow-black">
         <p>“{{$quote->quote}}”</p>
         <p class="text-xs italic m-2">- {{$quote->quotee}}</p>

         <div class="flex place-content-around mt-2">
            @can('view-button-for-admin')
            <a a href="/quotes/{{$quote->id}}/edit"><x-button-edit>Edit</x-button-edit></a> 
            <a href="/quotes/{{$quote->id}}/hide"><x-button-hide>Hide</x-button-hide></a>    
            <form method="POST" action="/quotes/{{ $quote->id }}">
                @csrf
                @method('delete')
                <x-button-delete>Delete</x-button-delete>
            </form> 
            @endcan
         </div>
         
      </div>
      @endforeach



   </section>

</x-layout>

