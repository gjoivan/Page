<?php 
class Data_Class{

    public $connection;
	function __construct($mysqliObj){
        $this->connection = $mysqliObj;
    }
    public function get_user_by_email($email){
        
        $request = "SELECT * FROM users WHERE `email` = '{$email}' LIMIT 1";
        $QueryObj = $this->connection->query($request, MYSQLI_USE_RESULT);
        $return_arr = array();
        $row = $QueryObj->fetch_assoc();
        // $return_arr[]=$row;
        $QueryObj->close();
        return $row;
    }
}