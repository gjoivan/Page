<?php 
class Projects_Class{

    public $connection;
	function __construct($mysqliObj){
        $this->connection = $mysqliObj;
    }
    public function get_projects($code=null, $status=null){
        $where_sql = " WHERE `id` !='NULL'";
        if(!empty($code)){
            $where_sql .= " AND `code` LIKE '%{$code}%'";
        }
        if(!empty($status)){
            $where_sql .= " AND `status`='{$status}'";
        }
        $request = "SELECT * FROM niko_san.projects ".$where_sql.";";
        $QueryObj = $this->connection->query($request, MYSQLI_USE_RESULT);
        $return_arr = [];
        while($row = $QueryObj->fetch_assoc()){
            $return_arr[$row['id']] = $row;
        }
        $QueryObj->close();
        return $return_arr;
    }
    public function get_project($id){
        $request = "SELECT * FROM niko_san.projects WHERE `id` = '{$id}' LIMIT 1;";
        $QueryObj = $this->connection->query($request, MYSQLI_USE_RESULT);
        $return_arr = [];
        $row = $QueryObj->fetch_assoc();
        $QueryObj->close();
        return $row;
    }
    public function delete_project($id){
        $stmt = $this->connection->prepare("DELETE FROM `projects` WHERE `id`=? LIMIT 1;");
		$stmt->bind_param('i', $id);
		$stmt->execute();	
		$return = $stmt->affected_rows;
        $stmt->close();
        return $return;
    }
    public function save_project($id, $data){
        if(!empty($data['project_employees'])){
            $data_json = json_encode($data['project_employees'], JSON_UNESCAPED_UNICODE);
        }else{
            $data_json = null;
        }

        if($id==null){
            $stmt = $this->connection->prepare("INSERT INTO `projects` (`code`, `status`, `date_start`, `location`, `project_employees`) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sisss', $data['code'], $data['status'], $data['date_start'], $data['location'], $data_json);
        }else{
            $stmt = $this->connection->prepare("UPDATE `projects` SET `code` = ?, `status` = ?, `date_start` = ?, `location`=?, `project_employees`=? WHERE `id`=? LIMIT 1");
            $stmt->bind_param('sisssi', $data['code'],  $data['status'], $data['date_start'], $data['location'], $data_json, $id);
        }
		$stmt->execute();
		$return = $stmt->affected_rows;
        $stmt->close();
        return $return;
    }
}