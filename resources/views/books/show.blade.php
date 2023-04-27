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
        @can('view-button-for-user')
        <x-button-create class="m-2" onclick="hideShow('create-review')">Write Review?</x-button-create>        
        <section id="create-review" class="hidden">@include('reviews.create')</section>
        @include('reviews.book-reviews')
        @endcan
     </div> 
     
     
     <script>
        let divArray = [];
        function hideShow(div){
           if(divArray.includes(div)){
              document.getElementById(div).style.display="none";
              divArray = removeDiv(divArray, div);
              return divArray;  
           } else {
              document.getElementById(div).style.display="block";
              divArray.push(div);
              return divArray;
           }
        }
     
        // Helpfunction to remove an item from an array
        function removeDiv(array, div) {
        let index = array.indexOf(div);
        if (index > -1) {
           array.splice(index, 1);
        }
        return array;
     }
     </script>     
</x-layout>