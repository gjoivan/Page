<?php 
require_once __DIR__."/config/index.php";
require_once  __DIR__."/config/login_session.php";
?>
<!DOCTYPE html>
<html lang="en"> 
  <?php
  $route = isset($_GET['route']) ? $_GET['route'] : 'home';
  $routes_allowed = array('home', 'employees');
  include_once('./includes/header.php');
  include_once('./includes/nav.php');
  if(in_array($route, $routes_allowed)){
    include_once("./pages/{$route}.php");
  }
  include_once('./includes/modals.php');
  ?>
  <head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradba Unikat</title>
    <!-- <link rel="stylesheet" href="./static/css/bootstrap.css"> -->
    <link rel="stylesheet" href="static/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/css/bootstrap-grid.min.css">
    <script src="static/js/bootstrap.min.js"></script>
    <script src="static/js/bootstrap.bundle.min.js"></script>
    <script src="static/js/jquery.com_jquery-3.7.0.js"></script>
    <script src="static/js/jquery-ui.min.js"></script>
   
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
  </head>
  <body>

  </body>
</html>
<script>
  function user_log_out(){
    $.post("./ajax/login_ajax.php", {event: 'user_log_out'}, function(data, status){
      var data = JSON.parse(data);
      if(data.status == "success"){
        window.location = './';
      }else{
        $('#response').html(data.message); 
      }
    });
  }
</script>

