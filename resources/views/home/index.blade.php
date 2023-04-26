<x-layout>

    @include('partials._search')
    @include('partials._hero')
    @php $three_book = $comedy @endphp
    {{-- lägg genre infon här --}}
    <div class="grid gap-2 grid-cols-4 grid-rows-1 justify-items-center mt-10 ">
        <h2>Comedy</h2>
        @include('partials._book-row')
    </div>
    <hr>
    @php $three_book = $horror @endphp
    {{-- lägg genre infon här --}}
    <div class="grid gap-2 grid-cols-4 grid-rows-1 justify-items-center mt-10 ">
        <h2>Horror</h2>
        @include('partials._book-row')
    </div>
    <hr>
    @php $three_book = $romance @endphp
    {{-- lägg genre infon här --}}
    <div class="grid gap-2 grid-cols-4 grid-rows-1 justify-items-center mt-10 ">
        <h2>Romance</h2>
        @include('partials._book-row')
    </div>
</x-layout>
