@props(['rating'])


<div class="tooltip">
      @for ($i = 0; $i < $rating; $i++)
      <img class="w-5 inline-block pb-2" src="{{asset('images/elephpant-running-78x48.gif')}}" alt="star">
      <span class="tooltiptext tooltip_main">Rating: {{$rating}}/5 </span>
      @endfor
</div>
