<x-layout>

    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">Edit Genre: {{$genre->name}}</h2>
    </header>

    <div class="flex justify-center md:justify-center">    
        <form method="POST" action="/genres/{{$genre->id}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">Genre Name</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{$genre->name}}"/>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">Description</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="description" value="{{$genre->description}}"/>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <x-button-create>Update Genre</x-button-create>
                <a href="/genres" class="text-black m-10 ml-4"><i class="fa-solid fa-arrow-left"></i> Back to Genres</a>
            </div>
        </form>
    </div>

</x-layout>