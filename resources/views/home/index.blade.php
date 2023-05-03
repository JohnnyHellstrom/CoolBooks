<x-layout>

    @can('view-button-for-user')
    @include('partials._search')
    @endcan
    @include('partials._rotatingBook')
    {{-- @include('partials._hero') --}}

        <div class="">
            @php $three_book = $comedy @endphp
            @if (!$three_book->isEmpty())
                <div class="grid gap-2 grid-cols-4 grid-rows-1 justify-items-center mt-10 ">
                    <span>
                        <a href="/genres/{{$three_book[0]->genres->id}}"><h2><b>{{ $three_book[0]->genres->name }}</b></h2></a>
                    <br>
                    <p class="overflow_description">{{$three_book[0]->genres->description}}</p>
                    </span>
                    @include('partials._book-row')
                </div>
            @else
                <h2>No books here</h2>
            @endif
            <hr>
            @php $three_book = $horror @endphp
            @if (!$three_book->isEmpty())
                <div class="grid gap-2 grid-cols-4 grid-rows-1 justify-items-center mt-10 ">
                    <span>
                        <a href="/genres/{{$three_book[0]->genres->id}}"><h2><b>{{ $three_book[0]->genres->name }}</b></h2></a>
                        <br>
                        <p class="overflow_description">{{$three_book[0]->genres->description}}</p>
                        </span>
                    @include('partials._book-row')
                </div>
            @else
                <h2>No books here</h2>
            @endif
            <hr>
            @php $three_book = $romance @endphp
            @if (!$three_book->isEmpty())
                <div class="grid gap-2 grid-cols-4 grid-rows-1 justify-items-center mt-10 ">
                    <span>
                        <a href="/genres/{{$three_book[0]->genres->id}}"><h2><b>{{ $three_book[0]->genres->name }}</b></h2></a>
                        <br>
                        <p class="overflow_description">{{$three_book[0]->genres->description}}</p>
                        </span>
                    @include('partials._book-row')
                </div>
            @else
                <h2>No books here</h2>
            @endif
        </div>

</x-layout>
