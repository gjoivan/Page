<?php
$path = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$hostname="localhost";
$username="root";
$pass_word="";
$database_name="NikoSan";

$mysqliObj = new mysqli($hostname, $username, $pass_word, $database_name);
$mysqliObj->set_charset('utf8');
?>