<x-layout>    
    <a href="/books" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i>Back to All Books</a>
    <h1 class="text-5xl font-bold mb-4">Eriks Special knapp</h1>    
    <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa fa-radiation-alt" style="color: red;"></i>Back to Home</a>
    <h3 class="text-3xl mb-2 text-center">Headline: {{$books->title}}</h3>
          
    <div class="flex items-stretch">
        <div class="flex w-full items-center justify-center">
            <img src="{{$books->image ? asset('storage/' . $books->image) : asset('images/no-image.png')}}" >            
        </div>         
        <div class="flex flex-col w-full">
            <h3 class="text-3xl font-bold mb-4">Book Information</h3>
            <div class="text-lg space-y-6">
                <p>Description: {{$books->description}}  </p>
                <p>Author: </p>
                                             
            </div>             
            <x-books-tags :tagsCsv="$books->tags" />   
            <div>
                <div class="mr-10">
                    @include('partials._create-review')
                 </div>
            </div>
        </div>
    </div>         
                   
 
  </x-layout>