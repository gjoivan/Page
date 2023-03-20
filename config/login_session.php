<?php
$path = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
session_start();
if(!empty($_POST['logout'])){
    session_destroy();
    $message = "You are logged out";
}
?>