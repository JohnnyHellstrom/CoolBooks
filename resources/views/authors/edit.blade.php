<x-layout>

    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">Edit Author: {{$author->first_name . ' ' . $author->last_name}}</h2>
    </header>

    <div class="flex justify-center md:justify-center">    
        <form method="POST" action="/authors/{{$author->id}}" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="flex justify-center">
                <img class="w-48 m-6" src="{{$author->author_image ? asset('storage/' . $author->author_image) : asset('images/no-author_image.svg')}}" alt="" id="imagepreview"/>
            </div>
            <div class="mb-6">
                <label for="author_image" class="inline-block text-lg mb-2">Author Portrait</label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="author_image" id="previewimage"/>
                @error('author_image')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>        
            <div class="mb-6">
                <label for="first_name" class="inline-block text-lg mb-2">First Name</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="first_name" value="{{$author->first_name}}"/>
                @error('first_name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="last_name" class="inline-block text-lg mb-2">Last Name</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="last_name" value="{{$author->last_name}}"/>
                @error('last_name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="biography" class="inline-block text-lg mb-2">Biography</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="biography" value="{{$author->biography}}"/>
                @error('biography')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <x-button-create>Update Author</x-button-create>
                <a href="/authors" class="text-black m-10 ml-4"><i class="fa-solid fa-arrow-left"></i> Back to Authors</a>
            </div>
        </form>
    </div>

</x-layout>

<script>
  //  the URL.createObjectURL() function is used to generate an object URL for the selected file. This function creates a temporary URL that points to the selected file
  $(document).ready(function (){
    var output = document.getElementById('imagepreview');
    output.src = URL.createObjectURL($("#previewimage")[0].files[0]);
  });
  
  $("#previewimage").on("change", function (){
      var output = document.getElementById('imagepreview');
      output.src = URL.createObjectURL($(this)[0].files[0]);
  });
</script>