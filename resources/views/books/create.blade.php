<x-layout>
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">Create a Book</h2>        
    </header>    
  <div class="flex justify-center md:justify-center">
    {{-- when uploading files etc you have to have the enctype="multipart/form-data" --}}
    <form method="POST" action="/books" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      @csrf <!-- this is an directive, prevents cross-site scripting attacks -->
        <div class="mb-6">
            <label for="title" class="inline-block text-lg mb-2">Book Title</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title" value="{{old('title')}}"/>
            <!-- use this old() helper to store to data that was correct but something wasn't filled in correctly  -->
            @error('title') <!-- another directive, this is an error directive -->
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>
       
        <div class="mb-6">
            <label for="genre" class="inline-block text-lg mb-2">Genre</label>
            <select name="genre_id" class="bg-gray-50 border border-gray-300 text-gray-900 block w-full p-2.5 mb-2 text-lg">
            @foreach ($genres as $genre)
              <option value="{{$genre->id}}">{{$genre->name}}</option>
            @endforeach
            </select>
        </div>
        
        <div class="mb-6">
          <label for="user" class="inline-block text-lg mb-2">User</label>
          <select name="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 block w-full p-2.5 mb-2 text-lg">
          @foreach ($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
          @endforeach
          </select>
        </div>  
     
        <div class="mb-6">
            <label for="ISBN" class="inline-block text-lg mb-2">ISBN</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="ISBN" placeholder="Example: 269-86095-990-2455"
            value="{{old('ISBN')}}"/>

            @error('ISBN') <!-- another directive, this is an error directive -->
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
          <label for="tags" class="inline-block text-lg mb-2">Tags (Comma Separated)</label>
          <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags" placeholder="Example: horror, scary, funny, etc" value="{{old('tags')}}"/>

          @error('tags') <!-- another directive, this is an error directive -->
          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="description" class="inline-block text-lg mb-2">Book Description</label>
          <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10" placeholder="What is the book about..">
            {{old('description')}}
          </textarea>

          @error('description') <!-- another directive, this is an error directive -->
          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>        

        <div class="mb-6">
            <label for="book_img" class="inline-block text-lg mb-2">Book picture</label>
            <input type="file" class="border border-gray-200 rounded p-2 w-full" name="book_img"/>

            @error('book_img') <!-- another directive, this is an error directive -->
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>        

        <div class="mb-6">
            <x-button-create>Create Book</x-button-create>
            <a href="/books" class="w-48 py-2 px-16 rounded-full text-white-400 bg-gradient-to-r from-cyan-500 to-blue-500">
            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>Back</a>            
        </div>
    </form>
  </div>
</x-layout>