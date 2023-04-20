<x-layout>

    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">Create a new Genre</h2>        
    </header>

    <div class="flex justify-center md:justify-center">
        <form method="POST" action="/genres" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf <!-- prevents cross-site scripting attacks -->
            
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">Genre Name</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" placeholder="E.g. Comedy" value="{{old('name')}}"/>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">Description</label>
                <input class="border border-gray-200 rounded p-2 w-full" name="description" id="description-text" maxlength="50" placeholder="Describe the genre..." value="{{old('description')}}"/>
                <p id="charcounter">50 chars remaining</p>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <x-button-create>Save Genre</x-button-create>
                <a href="/genres" class="text-black m-10 ml-4"><i class="fa-solid fa-arrow-left"></i>Back to Genres</a>
            </div>
        </form>
    </div>

</x-layout>

<script>

    const inputText = document.getElementById('description-text');
    const charCount = document.getElementById('charcounter');

    inputText.addEventListener('input', function() {
    const remainingChars = 50 - inputText.value.length;
    charCount.textContent = remainingChars + ' chars remaining';
    });

</script>