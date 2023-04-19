<x-layout>

    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">Create a new Author</h2>        
    </header>

    <div class="flex justify-center md:justify-center">
        <form method="POST" action="/authors" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf <!-- prevents cross-site scripting attacks -->
            
            <div class="mb-6">
                <label for="author_image" class="inline-block text-lg mb-2">Author Portrait</label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="author_image"/>
                @error('author_image')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>        
            <div class="mb-6">
                <label for="first_name" class="inline-block text-lg mb-2">First Name</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="first_name" value="{{old('first_name')}}"/>
                @error('first_name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="last_name" class="inline-block text-lg mb-2">Last Name</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="last_name" value="{{old('last_name')}}"/>
                @error('last_name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="biography" class="inline-block text-lg mb-2">Biography</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="biography" value="{{old('biography')}}"/>
                @error('biography')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <x-button-create>Save Author</x-button-create>
                <a href="/authors" class="text-black ml-4">Back to Authors</a>
            </div>
        </form>
    </div>

</x-layout>