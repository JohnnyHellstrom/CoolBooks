<x-layout>
  <header class="text-center">
    <h2 class="text-2xl font-bold uppercase mb-1">Edit a Book</h2>
    <p class="mb-4">Edit: {{$books->title}}</p>
  </header>
  <div class="flex justify-center md:justify-center">    
    {{-- when uploading files etc you have to have the enctype="multipart/form-data" --}}
    <form method="POST" action="/books/{{$books->id}}" enctype="multipart/form-data">
      @csrf <!-- this is an directive, prevents cross-site scripting attacks -->
      @method('PUT') <!-- laravel has the @method('PUT') so it becomes a put request instead of a POST -->
      
      <div>
        <img src="{{asset('storage/' . $books->image)}}" id="imagepreview" style="max-height: 200px">        
      </div>

      <div class="mb-6">
          <label for="title" class="inline-block text-lg mb-2">Book Title</label>
          <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title" value="{{$books->title}}"/>
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
        <label for="author" class="inline-block text-lg mb-2">Author</label>
        <select name="author_id" class="bg-gray-50 border border-gray-300 text-gray-900 block w-full p-2.5 mb-2 text-lg">
        @foreach ($authors as $author)
          <option value="{{$author->id}}">{{$author->first_name . " " . $author->last_name}}</option>
        @endforeach
        </select>
      </div>   
   
      <div class="mb-6">
          <label for="ISBN" class="inline-block text-lg mb-2">ISBN</label>
          <input type="text" class="border border-gray-200 rounded p-2 w-full" name="ISBN" placeholder="Example: 269-86095-990-2455"
          value="{{$books->ISBN}}"/>

          @error('ISBN') <!-- another directive, this is an error directive -->
          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
          @enderror
      </div>

      <div class="mb-6">
        <label for="tags" class="inline-block text-lg mb-2">Tags (Comma Separated)</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags" placeholder="Example: horror, scary, funny, etc" value="{{$books->tags}}"/>

        @error('tags') <!-- another directive, this is an error directive -->
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="description" class="inline-block text-lg mb-2">Book Description</label>
        <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10" placeholder="What is the book about..">
          {{$books->description}}
        </textarea>

        @error('description') <!-- another directive, this is an error directive -->
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>        

      <div class="mb-6">
          <label for="book_img" class="inline-block text-lg mb-2">Book picture</label>
          <input type="file" class="border border-gray-200 rounded p-2 w-full" name="book_img" id="previewimage"/>

          @error('book_img') <!-- another directive, this is an error directive -->
          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
          @enderror
      </div>       
    
      <div class="mb-6">
          <x-button-update>Update Book</x-button-update>
          <a href="/books" class="w-48 py-2 px-16 rounded-full text-white-400 bg-gradient-to-r from-cyan-500 to-blue-500">
            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>Back</a>
      </div>
    </form>
  </div>
</x-layout>

<script>
  // javascript for getting a preview then replacing the old picture with the new
  $(document).ready(function (){
    var output = document.getElementById('imagepreview');
    output.src = URL.createObjectURL($("#previewimage")[0].files[0]);
  });
  
  $("#previewimage").on("change", function (){
      var output = document.getElementById('imagepreview');
      output.src = URL.createObjectURL($(this)[0].files[0]);
  });

  // this hides the old picture and shows the new one when a file is selected
  $("#previewimage").on("change", function (){
      var oldImage = $("#imagepreview");
      if(oldImage.attr("src")){
          URL.revokeObjectURL(oldImage.attr("src"));
      }
      oldImage.hide();
      var newImage = $("<img>").attr("id", "imagepreview");
      newImage.insertBefore(oldImage);
      newImage.on("load", function(){
          oldImage.remove();
          newImage.show();
      });
      newImage.attr("src", URL.createObjectURL($(this)[0].files[0]));
  });
</script>