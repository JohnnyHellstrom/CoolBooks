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
            <h3 class="text-3xl font-bold mb-4 text-center">Book Information</h3>
            <div class="flex flex-col text-lg items-center justify-center">
                <p>Description: {{$books->description}}  </p>             
                @foreach($books->authors as $bookauthor)
                    <div class="flex items-center justify-center">
                        <img class="w-36" src="{{$bookauthor->image ? asset('storage/' . $bookauthor->image) : asset('images\elephpant-running-78x48.gif')}}"> 
                    </div>
                    

                    <p>Author: {{$bookauthor->first_name ." " . $bookauthor->last_name}}</p>
                    <p>Biography: {{$bookauthor->biography}}</p>                
                @endforeach      
                                   
                <x-books-tags :tagsCsv="$books->tags"/>   
            </div>       
            <div>
                <div class="mr-10">
                    @include('reviews.all-reviews')
                 </div>
            </div>
        </div>
    </div>         
                   
 
  </x-layout>