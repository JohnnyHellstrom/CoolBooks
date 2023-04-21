<x-layout>
   
   @include('partials._search')
   @include('partials._hero')

   @php $three_book = $comedy @endphp
   @include('partials._book-row')
   <hr>
   @php $three_book = $horror @endphp
   @include('partials._book-row')
   <hr>
   @php $three_book = $romance @endphp
   @include('partials._book-row')
</x-layout>