<div class="grid justify-self-center">
    <button class="m-auto p-3 jusitfy-self-center bg-gray-500 rounded-full hover:bg-gray-600 mb-4" wire:click="getRandomBook()"><b>Give me something i have to reed!</b></button>

    @if ($isOpen)
        <div class="justify-self-center">
            <br>
            <h4>
                <b>{{ $bookes->title }}</b>
            </h4>
        </div>
        <div class="justify-self-center">
            <a class="self-center" href="/books/{{ $bookes->id }}"><img class="h-36"
                    src="{{ $bookes->image ? asset('storage/' . $bookes->image) : asset('images/no-image.jpg') }}"
                    alt="" /></a>
            <br>
        </div>
        <button wire:click="close"><i class="p-2 fa-regular fa-eye-slash"></i></button>
        @endif
</div>