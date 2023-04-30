<form action="/search/search" method="GET">
    <div class="relative border-2 border-gray-100 m-4 rounded-lg">        
        <label for="type">Search by:</label>
        <select name="type" id="type">
            <option value="">All</option>
            <option value="genre">Genre</option>
            <option value="author">Author</option>
            <option value="title">Title</option>
        </select>
        <label for="search">Search:</label>
        <input type="text" name="search" class="h-10 w-2/3 pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none" placeholder="Search CoolBooks...">
        <div class="absolute top-2 right-2">
            <button type="submit" class="h-7 w-20 text-white rounded-lg bg-slate-400 hover:bg-slate-300">Search</button>
        </div>
    </div>
</form>
