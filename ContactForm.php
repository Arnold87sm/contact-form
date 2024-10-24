<?php
    $error = "";
    $successMessage = "";

    if($_POST) {
      if(!$_POST["email"]){
        $error .= "An email address is required.<br>";
      }

      if(!$_POST["content"]){
        $error .= "The content field is required.<br>";
      }

      if(!$_POST["subject"]){
        $error .= "The subject is required.<br>";
      }
      if($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false){
        $error .= "The email address is invalid.<br>";
      }
      // check if there are errors
      if($error != ""){
        $error = '<div class="alert alert-danger" role="alert"<p>There were an error(s) in your form:</p>' . $error . '</div>';
      }
      else{ //email address is good
        $emailTo = "receiver-email@company.com";
        $subject = $_POST['subject'];
        $content = $_POST['content'];
        $headers = "From: " . $_POST['email'];

        //try sending email
        if(mail($emailTo, $subject, $content, $headers)){
            $successMessage = '<div class="alert alert-success" role="alert">Your message was sent. '. 
                              'we\'ll get back to you ASAP!</div>';
        }
        else{
          $error = '<div class="alert alert-danger" role="alert">Your message couldn\'t be sent - try again later</div>';
        }
      } // end if else check and send email
    } // end if $_POST
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
  </head>
  <body>
  
    <div class="container">
        <h1>Get in Touch!</h1>
        <div id="error"><?php echo $error.$successMessage; ?></div>

        <form method="post">
            <fieldset class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Please enter your email">
              <small class="txt-muted">We'll never share your e-mail with anyone else!</small>
            </fieldset>

            <fieldset class="form-group">
              <label for="subject">Subject</label>
               <input type="text" class="form-control" id="subject" name="subject">
            </fieldset>
            
            <fieldset class="form-group">
              <label for="content">What would you like to ask us?</label>
              <textarea class="form-control" id="content" name="content" rows="3"></textarea>
            </fieldset>
            
            <button type="submit" id="submit" class="btn btn-primary">Submit</button>   
        </form><!-- end of form -->
    </div><!-- end of container div -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous">     
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" 
                integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
      $("form").submit(function(e){
          let error = "";
          if($("#email").val() == ""){
              error += "The email field is required!<br>";
          }
          if($("#subject").val() == ""){
              error += "The subject field is required!<br>";
          }
          if($("#content").val() == ""){
              error += "The content field is required!<br>";
          }
          // test if there was an error

          if(error != ""){
              $("#error").html('<div class="alert alert-danger"' + 
              'role="alert"><p><strong>There were error(s) in your form:</strong></p>' + error + '</div>');

              return fals;
          }
          else{ // no errors!
              return true;
          }
      });
    </script>

  </body>
</html>
