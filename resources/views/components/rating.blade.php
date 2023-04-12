@props(['rating'])

<span>Rating: {{$rating}}/5 </span>

@for ($i = 0; $i < $rating; $i++)
      <img class="w-12 inline-block py-4" src="{{asset('images/elephpant-running-78x48.gif')}}" alt="stars">
@endfor