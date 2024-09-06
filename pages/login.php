<?php
session_start();
if(!empty($_SESSION['login'])){
  header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gradba Unikat</title>
  <link rel="stylesheet" href="../static/css/bootstrap.min.css">
  <link rel="stylesheet" href="../static/css/bootstrap-grid.min.css">

  <script src="../static/js/jquery.com_jquery-3.7.1.js"></script>
  <script src="../static/js/bootstrap.min.js"></script>

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script> -->


</head>

<div class="container" style="padding-top:150px;">
  <div class="row justify-content-md-center">
    <div class="col-md-auto">
      <div>
        <!-- Email input -->
        <div>
          <input type="email" id="email_entry" class="form-control"/>
          <label class="form-label">Email address</label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
          <input type="password" id="password_entry" class="form-control" />
          <label class="form-label">Password</label>
        </div>

        <!-- 2 column grid layout for inline styling -->
        <div class="row mb-4">
          <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
              <label class="form-check-label"> Remember me </label>
            </div>
          </div>

          <div class="col">
            <!-- Simple link -->
            <a href="#!">Forgot password?</a>
          </div>
        </div>

        <!-- Submit button -->
        <a type="button" class="btn btn-primary btn-block mb-4" onclick="verify_user();">Sign in</a>

        <!-- Register buttons -->
        <div class="text-center">
          <p>Not a member? <a href="#!">Register</a></p>
          <button type="button" class="btn btn-link btn-floating mx-1">
            <i class="fab fa-github"></i>
          </button>
        </div>
        <h4 id="response" style="color:red;text-align:center;"></h4>

        </div>
      </div>
    </div>
  </div>
</div>
<?php if(!empty($message)) { echo $message;} ?>
<script>
  function verify_user(){
    var email = $('#email_entry').val();
    var password = $('#password_entry').val();
    if(email == '' || email == undefined){
      $('#email_entry').focus();
      return;
    }
    if(!validateEmail(email)){ 
      alert("Wrong email format!");
      return;
    }
    $.post("../ajax/login_ajax.php", {event: 'verify_user', email: email, password: password}, function(data, status){
      var data = JSON.parse(data);
      if(data.status == "success"){
        window.location.href = 'http://localhost/Page/';
      }else{
        $('#response').html(data.message); 
      }
    });
  }
  function validateEmail($email) {
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      return emailReg.test( $email );
  }
  $(document).on('keypress',function(e) {
    if(e.which == 13) {
      verify_user();
    }
});
</script>

