<x-layout>  
    <a href="/books" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i>Back</a>
    <div class="mx-4">      
        <div class="flex flex-col items-center justify-center text-center">                
          <h3 class="text-2xl mb-2">{{$books->title}}</h3>

          <div class="border border-gray-200 w-full mb-6"></div>
          <div>
              <h3 class="text-3xl font-bold mb-4">Book Description</h3>
              <div class="text-lg space-y-6">
                  {{$books->description}}                  
              </div>
          </div>
        </div>      
    </div>
  </x-layout>