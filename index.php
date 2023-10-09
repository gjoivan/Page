<?php 
require_once __DIR__."/config/index.php";
require_once  __DIR__."/config/login_session.php";
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradba Unikat</title>
    
    <link rel="stylesheet" href="static/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/css/bootstrap-grid.min.css"> 
    <link rel="stylesheet" href="static/css/bootstrap-select.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

    <script src="static/js/jquery.com_jquery-3.7.1.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
    <script src="static/js/bootstrap-select.min.js"></script>
    <script src="static/js/bootstrap-multiselect.min.js"></script>
    <script src="static/js/jquery-ui.min.js"></script>

  </head>
  <body>
    <?php
      $route = isset($_GET['route']) ? $_GET['route'] : 'home';
      $routes_allowed = array('home', 'employees', 'clients', 'projects', 'login');
      include_once('./includes/header.php'); ?>
      <div class="col-xs-3"> <?php  include_once('./includes/nav.php'); ?></div>
      <?php if(in_array($route, $routes_allowed)){ ?>
        <div class="col-xs-9"> <?php  include_once("./pages/{$route}.php"); ?></div>
      <?php }
      include_once('./includes/modals.php');
    ?>
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

