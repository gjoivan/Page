<?php 
class Employees_Class{

    public $connection;
	function __construct($mysqliObj){
        $this->connection = $mysqliObj;
    }
    public function get_active_employees($status=null, $name=null){
        $name_sql = '';
        if(!empty($name)){
            $name_sql = " AND `name` LIKE '%{$name}%'";
        }
        $request = "SELECT * FROM niko_san.employees WHERE `status` = '{$status}' ".$name_sql.";";
        $QueryObj = $this->connection->query($request, MYSQLI_USE_RESULT);
        $return_arr = [];
        while($row = $QueryObj->fetch_assoc()){
            $return_arr[$row['id']] = $row;
        }
        $QueryObj->close();
        return $return_arr;
    }
    public function get_employee($id){
        $request = "SELECT * FROM niko_san.employees WHERE `id` = '{$id}' LIMIT 1;";
        $QueryObj = $this->connection->query($request, MYSQLI_USE_RESULT);
        $return_arr = [];
        $row = $QueryObj->fetch_assoc();
        $QueryObj->close();
        return $row;
    }
    public function get_employee_embg($embg){
        $request = "SELECT * FROM niko_san.employees WHERE `embg` = '{$embg}' LIMIT 1;";
        $QueryObj = $this->connection->query($request, MYSQLI_USE_RESULT);
        $return_arr = [];
        $row = $QueryObj->fetch_assoc();
        $QueryObj->close();
        return $row;
    }
    public function delete_employee($id){
        $stmt = $this->connection->prepare("DELETE FROM `employees` WHERE `id`=? LIMIT 1;");
		$stmt->bind_param('i', $id);
		$stmt->execute();	
		$return = $stmt->affected_rows;
        $stmt->close();
        return $return;
    }
    public function save_employee($id, $data){
        $data_json = json_encode($data['project_id'], JSON_UNESCAPED_UNICODE);
        if($id==null){
            $stmt = $this->connection->prepare("INSERT INTO `employees` (`name`, `last_name`, `role`, `email`, `embg`, `status`, `project_id`, `date_start`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ssississ', $data['name'], $data['last_name'], $data['role'], $data['email'], $data['embg'], $data['status'], $data_json, $data['date_start']);
        }else{
            $stmt = $this->connection->prepare("UPDATE `employees` SET `name` = ?, `last_name` = ?, `role` = ?, `email` = ?, `embg` = ?, `status` = ?, `project_id` = ?, `date_start` = ? WHERE `id`=? LIMIT 1");
            $stmt->bind_param('ssississi', $data['name'],  $data['last_name'], $data['role'], $data['email'], $data['embg'], $data['status'], $data_json, $data['date_start'], $id);
        }
		$stmt->execute();	
		$return = $stmt->affected_rows;
        $stmt->close();
        return $return;
    }
}