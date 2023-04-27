@for ($i = 1; $i < 6; $i++)
   <label class="tooltip">
      <input class="" type="radio" name="rating" value="{{$i}}"/>
      <img class="w-10 inline-block" 
            src="{{asset('images/elephpant-running-78x48.gif')}}" alt="star">
            <span class="tooltiptext tooltip_author">{{$i}}</span>
   </label>
@endfor 
@error('rating') <!-- another directive, this is an error directive -->
<p class="text-red-500 text-xs mt-1">{{$message}}</p>
@enderror   