<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
require_once '../config/index.php';
$event = $_GET['e'] ?? $_POST['event'];
if(empty($event)){
    http_response_code(403);
    exit;
}

if($event == 'verify_user'){
    ini_set("display_errors", 1);
    error_reporting(E_ALL);
    $email = $_POST['email'];
    $password = $_POST['password'];
    require_once "../class/data_class.php";
    $data_obj = new Data_Class($mysqliObj);
    $user = $data_obj->get_user_by_email($email);
    if(!empty($user) && $password === $user['password']){
        session_start();
        $_SESSION['userEmail']=$email;
        $_SESSION['login'] = true;
        $_SESSION['UserID']=$user["user_id"];
        $_SESSION['UserType']=$user["type"];
        $_SESSION['activity'] = time();
        $_SESSION['message'] = 'You are logged in!';

        $response_arr = ['status'=>'success', 'log_in'=>true, 'message'=>'Login Succesfull'];
    }else{
        $response_arr = ['status'=>'fail', 'log_in'=>false, 'message'=>'Login failed'];
    }
    echo json_encode($response_arr);
    return;
}
?>