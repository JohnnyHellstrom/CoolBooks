@props(['tagsCsv'])

@php
    $tags = explode(',', $tagsCsv);
@endphp
<ul class="flex">
  @foreach($tags as $tag)
    <li class="flex items-center justify-center bg-black text-white rounded-xl px-3 py-1 mr-2 text-xs mt-2">
      <form action="/search/search" method="GET">
        <input type="hidden" name="tag" value="{{ $tag }}">
        <button type="submit" class="flex items-center justify-center bg-black text-white rounded-xl px-3 py-1 mr-2 text-xs">
          {{ $tag }}
        </button>
      </form>
    </li>
  @endforeach
</ul>