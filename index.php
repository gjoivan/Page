<?php 

// var_dump($_SERVER); return;
require_once __DIR__."/config/index.php";
require_once  __DIR__."/config/login_session.php";
$route = isset($_GET['route']) ? $_GET['route'] : 'home';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Niko-San Gradba</title>
    <link rel="stylesheet" href="./static/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./static/css/bootstrap-grid.min.css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script href="jquery-3.6.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>
    <!-- <script src="./js/jquery-ui.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/bootstrap-select.min.js"></script> -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NBRVWPD"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTMKCTSNJC"
    height="0" width="0"
    style="display:none;visibility:hidden"></iframe></noscript>

    <?php 
    include_once('./header.php');
    if($route == 'login'){
        include_once('./login.php');
    }elseif($route == "register"){
        include_once("./register.php");
    }elseif($route == 'contact'){
        include_once('./contact.php');
    }else{
        include('./home.php');
    }
    ?>

</body>
</html>