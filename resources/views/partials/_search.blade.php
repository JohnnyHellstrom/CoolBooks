<form action="/search/search" method="get">
    <div class="relative border-2 border-gray-100 m-4 rounded-lg flex items-center">
        <label for="type" class="absolute left-0 pl-4">        
        </label>
        <select name="type" id="type" class="h-14 pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none">
            <option value="title">Title</option>
            <option value="author">Author</option>
            <option value="genre">Genre</option>
        </select>
        <input type="text" name="search" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none" placeholder="Search CoolBooks...">
        <div class="absolute top-2 right-2">
            <button type="submit" class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600">Search</button>
        </div>
    </div>
</form>


