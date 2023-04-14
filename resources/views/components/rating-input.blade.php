@for ($i = 1; $i < 6; $i++)
   <label>
      <input class="" type="radio" name="rating" value="{{$i}}"/>
      <img class="w-10 inline-block" 
            src="{{asset('images/elephpant-running-78x48.gif')}}" alt="star">
   </label>
@endfor    