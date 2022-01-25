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
<div class='container'>
    <form method='POST'>
        <div class='form-group mb-3'>
            <label><b>Username: </b></label>
            <input type="text" class='form-contorl' placeholder='Enter username..' name='uname'>
        </div>

        <div>
            <label>Password:</label>
            <input type="text" placeholder='Enter password..' name='psw'>
        </div>
        <div>
            <label><b>Remember me</b></label>
            <input type="checkbox" id='rememebrMeCheck'>
        </div> 
        <div>
            <button type="submit">Login</button>
        </div>
        <div>
        <?php if(!empty($error)) echo $error ?>
        </div>

    </form>
</div>