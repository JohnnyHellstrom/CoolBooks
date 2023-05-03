<section class="relative h-64 bg-hero flex flex-col align-center space-y-4 mb-4">
  <div class="container mt-3 pd-3">  
    <h3 class="font-bold text-center">Recommended Book:</h3>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="input-group">              
      </div>
    </div>
    <div class="grid grid-cols-3 grid-rows-1 self-center justify-items-center mt-0 overflow-hidden">      
        <div id="showBook" class="card grid justify-items-center align-content-center w-2/3">
          <a id="showBookLink" href="showBookLink"><img id="showBookImg" class="card-img-top h-48 w-full" src="" alt="Book Cover Image"></a>
        </div>
        <div class="h-48 w-1/3">
          <h4 class="font-bold">Title:</h4>
          <h5><a id="showBookLink" href="showBookLink"><span id="showBookTitle" class="card-title"></span></a></h5>
          <h4 class="font-bold">Author:</h4>
          <h5><a id="authorLink" href="authorLink"><span id="author" class="card-title"></span></a></h5>
          <h4 class="font-bold mb-2">Rating:</h4>
          <p class=" flex" id="showBookRating"><br></p>
        </div>
        <div class="h-48 w-2/3">
          <h4 class="font-bold">Description:</h4>
          <p id="showBookDescription" class="card-text"></p>
        </div>          
    </div>  
  </div>
</section>


<script>
  $(document).ready(function() 
  {    
    var currentIndex = 0;  
    var showBooks = [];

    function displayBook(book) 
    {
      var showBook = $('#showBook');
      var showBookImg = $('#showBookImg');
      var showBookTitle = $('#showBookTitle');
      var showBookLink = $('#showBookLink');
      var author = $('#author');
      var authorLink = $('#authorLink');
      var showBookDescription = $('#showBookDescription');
      var showBookRating = $('#showBookRating');

      showBookImg.attr('src', book.image ? '{{ asset("storage") }}/' + book.image : '{{ asset("images/no-image.jpg") }}');
      showBookTitle.text(book.title);
      showBookLink.attr('href', '/books/' + book.id);
      var authorName = "";
      $.each(book.authors, function(index, author){
        authorName += author.first_name + " " + author.last_name;
      })      
      author.text(authorName);
      var authorId = "";
      $.each(book.authors, function(index, author){
        authorId = author.id;
      })   
      authorLink.attr('href', '/authors/' + authorId);
      // for the "truncate"
      var shorterDescription = book.description.substr(0, 200) + '...';
      showBookDescription.text(shorterDescription);   
    
      if (book.average_rating) 
      {
        var rating = parseFloat(book.average_rating);
        var stars = "";
        for (var i = 0; i < Math.round(rating); i++) 
        {
          stars += '<img class="w-8 inline-block pb-2" src="{{asset('images/elephpant-running-78x48.gif')}}" alt="star">';
        }              
        showBookRating.html(stars);
      } 
      else 
      {
          showBookRating.html('No ratings yet.');
      }

    }

    function loadBooks() 
    {
      $.ajax({
        url: '/home',
        type: 'GET',    
        success: function(data) 
        {                        
          showBooks = data;
          currentIndex = 0;
          displayBook(showBooks[currentIndex]);
          currentIndex = (currentIndex + 1) % showBooks.length;
          setInterval(function() 
          {
              displayBook(showBooks[currentIndex]);
              currentIndex = (currentIndex + 1) % showBooks.length;
              if (currentIndex === 0) {
                  // retrieving new set of random books
                  $.ajax({
                      url: '/home',
                      type: 'GET',
                      success: function(data) 
                      {
                        showBooks = data;
                      }
                  });
              }
          }, 5000);
        }
      });
    }
    loadBooks();
  });  
</script>
