<x-layout>

  <div class="container mt-3 pd-3">  
    <h3>Search for a book</h3>  
  </div>
  
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="input-group">
        <input type="search" id="livesearch" name="livesearch" class="form-control rounded-lg py-3 bg-gray-200" style="width:80%" placeholder="Enter search...." />        
      </div>
    </div>
    <div class="col-md-8">
      <div class="grid grid-cols-3 grid-rows-1 self-center justify-items-center mt-0 mycard">  
      </div>
    </div>  
  </div>
  
  <script>  
    $(document).ready(function () {
      $('#livesearch').on('keyup', function(){
        var value = $(this).val();           
        $.ajax({
          type: "get",
          url: "/livesearch",
          data: {'livesearch':value},
          success: function (data){
            $('.mycard').html(data);
          }
        });
      });
    });  
  </script>  
  
</x-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>  
<script type="text/javascript">$.ajaxSetup({headers: { 'csrftoken' : '{{ csrf_token() }}' } });</script>  