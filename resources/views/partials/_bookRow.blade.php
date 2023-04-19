<div class="grid gap-2 grid-cols-3 grid-rows-1 justify-items-center mt-10 ">
@if(!$books->isEmpty())
{{--have a check if det database if empty--}}
{{-- @foreach($books as $book) --}}
@for($x = 0; $x <= 2; $x++)
@php
        $rand_book = random_int(1, (count($books)-1));
        @endphp
        @if($books[$rand_book]->is_deleted == 0)
  
    {{-- @if($book->is_deleted == 0) --}}
    <div class="w-48 tooltip pb-2">
       <div class="">
            {{-- {{dd($books[$rand_book])}} --}}
            <a class="self-center" href="/books/{{$books[$rand_book]['id']}}"><img
                class="h-36"
                src="{{$books[$rand_book]->image ? asset('storage/' . $books[$rand_book]->image) : asset('images/no-image.png')}}"
                alt=""/></a>
                <span class="tooltiptext_left">Title:<br><b>{{$books[$rand_book]->title}}</b> <br> Author:<br><b>{{$books[$rand_book]->authors[0]['firsn_name']}} {{$books[$rand_book]->authors[0]['last_name']}}</b> </span>
            {{-- {{dd($book->authors)}} --}}
       </div>
       <div class="w-36">
 
          {{--check to se if there is a rating for the book--}}
          {{-- {{dd($rating[5])}} --}}
          @if(!empty($rating[$rand_book]))
            @unless($rating[$rand_book]->rating == null)
                <span>
                    <p class=" flex"><x-rating :rating="$rating[$rand_book]->rating" /></p>
                </span>
                        @else
                    <p>Rating: 0/5</p>
            @endunless
          @else
            <p>Not rated yet.</p>
          @endif
       </div>
    </div>
    @endif
    
    {{-- @endif --}}
    @endfor
    {{-- @endforeach --}}
    
 @else
    <p class="text-center">No Books found</p>
    @endif  
</div>

