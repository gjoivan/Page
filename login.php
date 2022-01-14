<?php
require './dbconnect.php';

if(!empty($_SESSION['logged_in'])){
    header("Location: home");
    return;
}

if(!empty($_POST['uname']) && !empty($_POST['psw'])){
    $username = $_POST['uname'];
    $passWord = $_POST['psw'];
    $request = "SELECT `username`, `password` FROM User WHERE `username`='".$username."'";
    $QueryObj = $connection->query($request, MYSQLI_USE_RESULT);
    $data = $QueryObj->fetch_assoc();
    if(!empty($data) && $data['password'] == $passWord){
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: home");
        return;
    } else{
        $_SESSION['logged_in'] = false;
        $error = 'Username/Password error.';
    }
}
?>
<div>
    <form method='POST'>
   
        <label><b>Username: </b></label>
        <input type="text" placeholder='Enter username..' name='uname'>

        <label><b>Password: </b></label>
        <input type="text" placeholder='Enter password..' name='psw'>

        <button type="submit">Login</button>
        <div>
        <?php if(!empty($error)) echo $error ?>
        </div>

    </form>
</div>