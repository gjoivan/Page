<?php

if(!empty($_POST['uname']) && !empty($_POST['password'])){
    $r_name = $_POST['uname'];
    $r_email = $_POST['email'];
    $r_password = $_POST['password'];
    $r_repassword = $_POST['repassword'];
    $command = "INSERT INTO `User` (`username`, `email`, `password` ) VALUES ('".$r_name."', '".$r_email."', '".$r_password."');";
    $QueryObj = $connection->query($command, MYSQLI_USE_RESULT);
    
}

?>



<div>
    <form  method='POST'>
    
        <label><b>Userame: </b></label>
        <input type="text" placeholder='Your Username' name='uname'>

        <label><b>email: </b></label>
        <input type="text" placeholder='Your email' name='email'>

        <label><b>Password: </b></label>
        <input type="text" placeholder='New Password' name='password'>

        <label><b>Retype Password: </b></label>
        <input type="text" placeholder='Retype New Password' name='repassword'>

       <button type="submit">Submit</button>

    </form>
</div>