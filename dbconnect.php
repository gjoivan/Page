<?php
$hostname="localhost";
$username="root";
$pass_word="12345678";
$database_name="User";

$connection = new mysqli($hostname, $username, $pass_word, $database_name);
$connection->set_charset('utf8');
?>