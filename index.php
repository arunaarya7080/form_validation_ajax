<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WP-DEMO</title>
    <!--Include Bootstrap’s CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
  </head>
  
  <body>
    <div class="container p-5">
        
      <form id="form_submit" action="" method="POST" class="form_submit" enctype="multipart/form-data" data-parsley-validate>
       <div class="row g-3">
           
          <h1>WP-DEMO</h1>
          <div class="col-6">
            <input type="text" class="form-control" name="name" placeholder="Full name" id="inputName" data-parsley-required="true">
          </div>
          <div class="col-6">
            <input type="email" class="form-control" name="email" placeholder="Email Id" id="inputEmail" data-parsley-required="true" data-parsley-type="email">
          </div>
          <div class="col-6">
            <input type="tel" class="form-control" name="phone" placeholder="Phone Number" id="inputPhone" data-parsley-required="true" data-parsley-type="number" data-parsley-pattern="^[0-9]+$">
          </div>
          <div class="col-6">
            <input type="text" class="form-control" name="url" placeholder="Website Url" id="inputWeburl" data-parsley-required="true" data-parsley-type="url">
          </div>
          <div class="col-12">
            <input type="text" class="form-control" name="subject" placeholder="Subject" id="inputSubject" data-parsley-required="true">
          </div>
          <div class="col-12">
               <textarea class="form-control" name="message" placeholder="message" id="inputTextarea" rows="3" data-parsley-required="true" required data-parsley-minlength="5"></textarea>
          </div>
          <div class="col-12">
                <input class="form-control" type="file" name="attachment" placeholder="Upload File" id="formFile" data-parsley-required="true">
          </div>
          
          <div class="col-12">
              <input type="submit" name="submit" id="submit_btn" class="btn btn-dark" value="Submit">
          </div>
          
           <div id="message"></div>
        </div>
        </form>

    </div>
    
  </body>
  <!--Include Bootstrap’s JS. -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <!--Include Jquery CDN -->
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <!--Include parsleyjs CDN -->
 <script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js"></script>
</html>

<script>
  $(document).ready(function() {
    $('#form_submit').on('submit', function(e) {
      e.preventDefault();
      var form_data = new FormData(this);
      $.ajax({
        url: 'client.php',
        method: 'POST',
        data: form_data,
        processData: false,
        contentType: false,
        beforeSend: function() {
          $('#form_submit button').attr('disabled', true);
          $('#message').html('Sending message...');
        },
        success: function(response) {
          $('#form_submit button').attr('disabled', false);
          $('#message').html(response);
        },
        error: function(xhr, status, error) {
          $('#form_submit button').attr('disabled', false);
          $('#message').html('Error: ' + error);
        },
        complete: function() {
          $('#form_submit')[0].reset();
        }
      });
    });
  });
</script>
