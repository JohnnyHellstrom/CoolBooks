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
        <img id="showBookImg" class="card-img-top h-48" src="" alt="Book Cover Image">
      </div>
      <div class="h-48 w-1/3">
        <h4>Title:</h4>
        <h5 id="showBookTitle" class="card-title"></h5>
        <h4>Author:</h4>
        <h5 id="author" class="card-title"></h5>
      </div>
      <div class="h-48 w-2/3">
        <h4>Description:</h4>
        <p id="recommended-book-description" class="card-text"></p>
      </div>      
     
  </div>  
</div>

<script>
  $(document).ready(function() {
    $.ajax({
      url: '/home',
      type: 'GET',    
      success: function(data) {        
        var showBooks = data;
        var currentIndex = 0;        
        var showBook = $('#showBook');
        var showBookImg = $('#showBookImg');
        var showBookTitle = $('#showBookTitle');
        var author = $('#author');
        var showBookDescription = $('#recommended-book-description');

        // Display a book on load
        var currentBook = showBooks[currentIndex];
        showBookImg.attr('src', currentBook.image ? '{{ asset("storage") }}/' + currentBook.image : '{{ asset("images/no-image.jpg") }}');
        showBookTitle.text(currentBook.title);
        var authorName = "";
        $.each(currentBook.authors, function(index, author){
          authorName += author.first_name + " " + author.last_name;
        })      
        author.text(authorName);
        var shorterDescription = currentBook.description.substr(0, 200) + '...';
        showBookDescription.text(shorterDescription);
        
        setInterval(function() {
          var currentBook = showBooks[currentIndex];
          showBookImg.attr('src', currentBook.image ? '{{ asset("storage") }}/' + currentBook.image : '{{ asset("images/no-image.jpg") }}');
          showBookTitle.text(currentBook.title);
          var authorName = "";
          $.each(currentBook.authors, function(index, author){
            authorName += author.first_name + " " + author.last_name;
          })
          author.text(authorName);
          var shorterDescription = currentBook.description.substr(0, 200) + '...';
          showBookDescription.text(shorterDescription);
          currentIndex = (currentIndex + 1) % showBooks.length;
        }, 3000);
      }
    });
  });
</script>