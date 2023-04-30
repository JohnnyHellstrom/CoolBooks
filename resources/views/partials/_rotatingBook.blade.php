<div class="container mt-3 pd-3">  
  <h3>Recommended Book:</h3>
</div>

<div class="row justify-content-center">
  <div class="col-md-4">
    <div class="input-group">              
    </div>
  </div>
  <div class="grid grid-cols-3 grid-rows-1 self-center justify-items-center mt-0">
    
      <div id="showBook" class="card grid justify-items-center align-content-center w-2/3">
        <a id="showBookLink" href="showBookLink"><img id="showBookImg" class="card-img-top h-48" src="" alt="Book Cover Image"></a>
      </div>
      <div class="h-48 w-1/3">
        <h4>Title:</h4>
        <h5><a id="showBookLink" href="showBookLink"><span id="showBookTitle" class="card-title"></span></a></h5>
        <h4>Author:</h4>
        <h5><a id="authorLink" href="authorLink"><span id="author" class="card-title"></span></a></h5>
      </div>
      <div class="h-48 w-2/3">
        <h4>Description:</h4>
        <p id="showBookDescription" class="card-text"></p>
      </div>      
     
  </div>  
</div>

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
          }, 3000);
        }
      });
    }
    loadBooks();
  });  
</script>
