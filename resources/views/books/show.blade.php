<x-layout>    
    <a href="/books" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i>Back to All Books</a>   
    <h2 class="text-3xl mb-4 text-center font-bold">{{$books->title}}</h2>  
     
    <div class="flex items-stretch">
        <div class="flex w-full items-center justify-center">
            <img src="{{$books->image ? asset('storage/' . $books->image) : asset('images/no-image.png')}}" >            
        </div>         
        <div class="flex flex-col w-full">
            <h3 class="text-3xl font-bold mb-4 text-center">Book Information</h3>
            <div class="flex flex-col text-lg items-center justify-center">
                <p>Description: {{$books->description}}  </p> 
                <p>Genre: {{$books->genres['name']}} </p>            
                @foreach($books->authors as $bookauthor)                  
                    <a href="/authors/{{$bookauthor->id}}">{{$bookauthor->first_name . " " . $bookauthor->last_name}}</a>                                 
                @endforeach      
                                   
                <x-books-tags :tagsCsv="$books->tags"/>   
            </div>                
        </div>
    </div>
    <div class="mr-10 mt-20">
        <h3 class="text-3xl font-bold mb-4 text-center">johnny's stuff</h3>
        @include('reviews.create')
        @include('reviews.all-reviews')
     </div>        
</x-layout>