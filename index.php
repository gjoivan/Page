<?php 
session_start();
if(!empty($_POST['logout'])){
    session_destroy();
    $message = "You are logged out";
}

$route = isset($_GET['route']) ? $_GET['route'] : 'home';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./page.css">
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>
    
    <?php include('./header.php'); ?>

    <?php
    if($route == 'login'){
        include('./login.php');
    }elseif($route == "register"){
        include("./register.php");
    }elseif($route == 'contact'){
        include('./contact.php');
    }else{
        include('./home.php');
    }
    ?>


</body>
</html>