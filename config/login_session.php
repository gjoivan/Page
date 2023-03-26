<?php
$path = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
session_start();
if(empty($_SESSION['login'])){
    session_destroy();
    $message = "You are logged out";
    $_SESSION['login_message']='You are logged out!';
    // var_dump($_SESSION['login_message']); return;
    header('Location: login.php');
}
// if($_SESSION['userEmail']==NULL || $_SESSION['activity']==NULL){
// 	if(basename($_SERVER['PHP_SELF'])!='index.php' && basename($_SERVER['PHP_SELF'])!='cronEmailOrderStatistics.php' ){
// 		$JSONResponse['Status']=-1;				
// 		$JSONResponse['Message']=date('Y-m-d H:i:s');					
// 		echo json_encode($JSONResponse);
// 		exit;	
// 	}else{
// 		header('Location: login.php');
// 	}
	
// }
?>