<x-layout>

   <header class="text-center">
       <h2 class="text-2xl font-bold uppercase mb-1">Edit Quote</h2>        
   </header>


   <div class="flex justify-center md:justify-center">
       <form method="POST" action="/quotes/{{$quote->id}}" >
           @csrf <!-- prevents cross-site scripting attacks -->
           @method('PUT')
           <div class="mb-6">
            <label for="quote" class="inline-block text-lg mb-2">Quote:</label>
            <textarea class="border border-gray-200 rounded p-2 w-full" name="quote" id="input-text" cols="30" rows="10" maxlength="1000" 
           >{{$quote->quote}}</textarea>
            <p id="charcounter">250 chars remaining</p>
            @error('quote')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            </div>

            <div class="mb-6">
                <label for="quotee" class="inline-block text-lg mb-2">By whom:</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="quotee" value="{{$quote->quotee}}"/>
                @error('quotee')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
            <label for="genre_quote_id" class="inline-block text-lg mb-2">Genre:</label>
            <select name="genre_quote_id" class="border border-gray-200 rounded p-2 w-full">
               @foreach ($genres as $genre)
               <option value="{{$genre->id}}"  {{ $quote->qenrequote_id == $genre->id ? 'selected' : '' }}>
                  {{ucfirst($genre->name)}}
              </option>
               @endforeach

           </select>
            @error('genrequote_id')
                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            </div>

           <div class="mb-6">
               <x-button-create>Edit</x-button-create>
               <a href="/quotes" class="text-black m-10 ml-4"><i class="fa-solid fa-arrow-left"></i> Back to Quotes</a>
           </div>
       </form>
   </div>

</x-layout>

<script>

   const inputText = document.getElementById('input-text');
   const charCount = document.getElementById('charcounter');

   inputText.addEventListener('input', function() {
   const remainingChars = 250 - inputText.value.length;
   charCount.textContent = remainingChars + ' chars remaining';
   });

   // Calculate initial remaining characters on page load
   const initialChars = 250 - inputText.value.length;
   charCount.textContent = initialChars + ' chars remaining';

</script>