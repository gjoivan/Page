<?php
$path = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
session_start();
if(empty($_SESSION['log_in']) || $_SESSION['log_in'] == false){
    session_destroy();
    header('Location: pages/login.php');
}

?>