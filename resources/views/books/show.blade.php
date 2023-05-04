<x-layout>    
    <a href="/books" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i>Back to All Books</a>   
    <h2 class="text-3xl mb-4 text-center font-bold">{{$books->title}}</h2>  
     
    <div class="flex items-stretch">
        <div class="flex w-full items-center justify-center">
            <img src="{{$books->image ? asset('storage/' . $books->image) : asset('images/no-image.png')}}" class="h-2/3">            
        </div>         
        <div class="flex flex-col w-full">
            <div class="flex flex-col text-lg items-center justify-center">
                @foreach($books->authors as $bookauthor)
                    <div class="inline-block">
                        <span class="font-bold">Author: </span>
                        <span><a href="/authors/{{$bookauthor->id}}">{{$bookauthor->first_name . " " . $bookauthor->last_name}}</a></span>
                    </div>
                @endforeach
                <div class="inline-block">
                    <span class="font-bold">Genre: </span>
                    <span>{{$books->genres['name']}}</span>
                </div>
                <div class="inline-block mt-6">
                    <span class="font-bold">Description: </span>
                    <span>{{$books->description}}</span>
                </div>
                                  
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