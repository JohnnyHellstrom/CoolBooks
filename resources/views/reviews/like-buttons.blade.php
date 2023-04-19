{{-- Decide icons to show --}}
@php
$showThumbs;
$likedReview = $review->likedReviews->firstWhere('user_id',$user_id);
if(!$likedReview){
   $showThumbs = "blank";
} elseif ($likedReview->liked == 1){
   $showThumbs = "up";
} elseif ($likedReview->liked == 0){
   $showThumbs = "down";
}
@endphp

{{-- Like button --}}
<form action="/reviews/like/{{$review->id}}" method="POST" class="inline-block">
   @csrf
   <input type="hidden" name="liked" value="1" >
   <input type="hidden" name="review_id" value="{{$review->id}}" >
   @if($showThumbs == "blank" || $showThumbs == "down")
   <button><i class="text-white fa-regular fa-thumbs-up"></i></button> 
   @else
   <button><i class="text-green-700 fa-solid fa-thumbs-up"></i></button> 
   @endif
</form>

{{-- Dislake button --}}
<form action="/reviews/like/{{$review->id}}" method="POST" class="inline-block">
   @csrf
   <input type="hidden" name="liked" value="0" >
   <input type="hidden" name="review_id" value="{{$review->id}}" >
   @if($showThumbs == "blank" || $showThumbs == "up")
   <button><i class="text-white fa-regular fa-thumbs-up rotate-180"></i></button> 
   @else
   <button><i class="text-red-700  fa-regular fa-thumbs-up rotate-180"></i></button> 
   @endif      
</form>