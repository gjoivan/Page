<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
ini_set("display_errors",1);
error_reporting(E_STRICT); 
require_once '../config/index.php';
$event = !empty($_POST['event']) ? $_POST['event'] : '';
$event = !empty($event) ? $event : $_GET['e'];
if(empty($event)){
    return;
}
if($event == 'load_projects_table'){
    $code = $_POST['code'];
    $status = $_POST['status'];
    require_once "../class/projects_class.php";
    $projects_obj = new Projects_Class($mysqliObj);
    $projects = $projects_obj->get_projects($code, $status);
    require_once "../class/employees_class.php";
    $employees_obj = new Employees_Class($mysqliObj);

    ?>
    <table class="table table-responsive table-bordered table-hover" id="table_clients" style=" width: 100%;height: 100%;">
        <thead>
            <tr>
                <th style="width:auto;">ID</th>
                <th>Code</th>
                <th>Status</th>
                <th>Location</th> 
                <th>Start date</th>
                <th>Details</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody  style="font-size:13px;">
            <?php foreach($projects as $project){
                $get_employees = $employees_obj->get_active_employees(1, null); 
                $employees_text='';
                foreach($get_employees as $key=>$employee){ 
                    if($employee['project_id'] != $project['id']) continue;
                    $employees_text .= $employee['name'].' '.$employee['last_name'].'</br>';
                }
                ?>
                <tr>
                    <th><?php echo $project['id']?></th>
                    <th><?php echo $project['code']?></th>
                    <th><?php echo $project['status'] == 1 ? 'Active' : ($project['status'] == 2 ? 'Finished' : ($project['status'] == -1 ? 'Deleted' : 'None'));?></th>
                    <th><?php echo $project['location']?></th>
                    <th><?php echo $project['date_start']?></th>
                    <th><a class="btn btn-lg" onclick="create_edit_project_modal(<?php echo $project['id']?>)"><i class="glyphicon glyphicon-folder-open"></i></a></th>
                    <th><a class="btn btn-danger" onclick="delete_project(<?php echo $project['id']?>)">Delete</a></th>
                </tr>
            <?php }?>
        </tbody>
    </table>
<?php return;

}
if($event == 'create_edit_project_modal'){
    // ini_set("display_errors",1);
    // error_reporting(E_ALL);
    $id = !empty($_POST['id']) ? $_POST['id'] : null;
    require_once "../class/projects_class.php";
    $projects_obj = new Projects_Class($mysqliObj);
    $project = $projects_obj->get_project($id);
    require_once "../class/employees_class.php";
    $employees_obj = new Employees_Class($mysqliObj);
    $get_employees = $employees_obj->get_active_employees(1, null);
    $projects_employees = !empty($project['project_employees']) ? json_decode($project['project_employees'], true) : null;
    $projects_employee_ids = !empty($projects_employees) ? array_keys($projects_employees) : null;

    if(!empty($id) && empty($project)){
        $return_arr = ['status'=>'error', 'message'=>'No project found in database.'];
        echo json_encode($return_arr, true);
        return;
    }
    ?>
    <div class="modal generic_modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-6" style="margin: auto;left:25%;">
                    <h4><?php echo ($id != 0 ? "Edit project" : "Create project");?></h4>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right;" onclick="display_modal('.generic_modal');">X</a>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Code</label>
                        <input type="email" id="project_code" class="form-control" placeholder="Project code" style="margin-bottom:10px;" value="<?php echo !empty($project['code']) ? $project['code'] : ''; ?>"/>
                    </div>
                    <div class="col-sm-2">
                        <label for="project_status_modal">Status</label>
                        <select type="text" class="form-control" placeholder="Search" id="selected_project_status">
                            <option value="1" <?php echo $project['status']=='1' ? 'selected' : '' ?>>Active</option>
                            <option value="2" <?php echo $project['status']=='2' ? 'selected' : '' ?>>Finished</option>
                            <option value="-1" <?php echo $project['status']=='-1' ? 'selected' : '' ?>>Deleted</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label>Start Date</label>
                        <input type="date" id="project_date_start" class="form-control" placeholder="Project start date" style="margin-bottom:10px;" value="<?php echo !empty($project['date_start']) ? date('Y-m-d', strtotime($project['date_start'])) : ''; ?>"/>
                    </div>
                    <div class="col-sm-3">
                        <label>Location (Address)</label>
                        <input type="text" id="project_location" class="form-control" placeholder="Project location" style="margin-bottom:10px;" value="<?php echo !empty($project['location']) ? $project['location'] : ''; ?>"/>
                    </div>
                </div><br></br><br></br>
                <label>Client Details:</label>
                <div class="row panel panel-default">
                    <div class="col-sm-3" style="margin-left:20px">
                        <label>Name:</label>
                        <input type="email" id="employee_last_name" class="form-control" placeholder="Employee last name" style="margin-bottom:10px;"  value="<?php echo !empty($employee['last_name']) ? $employee['last_name'] : ''; ?>"/>
                    </div>
                    <div class="col-sm-3">
                        <label>Last Name:</label>
                        <input type="email" id="employee_last_name" class="form-control" placeholder="Employee last name" style="margin-bottom:10px;"  value="<?php echo !empty($employee['last_name']) ? $employee['last_name'] : ''; ?>"/>
                    </div>
                    <div class="col-sm-4">
                        <labe>Address:</label>
                        <input type="email" id="employee_last_name" class="form-control" placeholder="Employee last name" style="margin-bottom:10px;"  value="<?php echo !empty($employee['last_name']) ? $employee['last_name'] : ''; ?>"/>
                    </div>
                    <div class="col-sm-4">
                        <label>Phone #:</label>
                        <input type="email" id="employee_last_name" class="form-control" placeholder="Employee last name" style="margin-bottom:10px;"  value="<?php echo !empty($employee['last_name']) ? $employee['last_name'] : ''; ?>"/>
                    </div>
                    <div class="col-sm-4">
                        <label >Email:</label>
                        <input type="email" id="employee_last_name" class="form-control" placeholder="Employee last name" style="margin-bottom:10px;"  value="<?php echo !empty($employee['last_name']) ? $employee['last_name'] : ''; ?>"/>
                    </div>
                    <div class="col-sm-4">
                        <label>EMBG:</label>
                        <input type="email" id="employee_last_name" class="form-control" placeholder="Employee last name" style="margin-bottom:10px;"  value="<?php echo !empty($employee['last_name']) ? $employee['last_name'] : ''; ?>"/>
                    </div>
                </div>
                <br></br><br></br>
                <div class="row">
                    <div class="col-xs-4">
                        <label>Employees</label>
                        <select id="project_employees" multiple>
                            <?php foreach($get_employees as $key=>$emplyee){ ?>
                                <option value=<?php echo $emplyee['id']; ?> 
                                    <?php $flag = false;
                                    if(!empty($projects_employee_ids)){
                                        if(in_array($emplyee['id'], $projects_employee_ids)){ 
                                            $flag = true;
                                        }
                                    }
                                    echo $flag==true ? 'selected' : ''; ?>>
                                    <?php echo $emplyee['name'].' '.$emplyee['last_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-xs-4" style="margin-left:20px">
                        <label>Dedicated employees: </label>
                        <ul>
                            <?php if(!empty($projects_employee_ids)){
                                foreach($get_employees as $key=>$employee){
                                    if(!in_array($employee['id'], $projects_employee_ids)) continue; ?>
                                    <li value=<?php echo $employee['id']; ?> ><?php echo $employee['name'].' '.$employee['last_name']; ?></option>
                                <?php } 
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="display_modal('.generic_modal');">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_project(<?php echo !empty($project['id']) ? $project['id'] : ''; ?>);">Save changes</button>
            </div>
            </div>
        </div>
    </div>
    <script>
        $('#project_employees').selectpicker();
    </script>
    <?php return;
} 
if($event == 'delete_project'){
    $id = $_POST['id'];
    require_once "../class/projects_class.php";
    $projects_obj = new Projects_Class($mysqliObj);
    $project = $projects_obj->get_project($id);
    if(!empty($project)){
        $delete_project = $projects_obj->delete_project($id);
        if($delete_project > 0){
            $return_arr = ['status'=>'success', 'message'=>'Project deleted'];
            echo json_encode($return_arr, true);
            return;
        }else{
            $return_arr = ['status'=>'error', 'message'=>'Error while deleting project!'];
            echo json_encode($return_arr, true);
            return;
        }
    }else{
        $return_arr = ['status'=>'error', 'message'=>'Project already dont exist'];
        echo json_encode($return_arr, true);
        return;
    }
}
if($event == 'save_project'){
    ini_set("display_errors",1);
    error_reporting(E_ALL);
    $id = !empty($_POST['id']) ? $_POST['id'] : null;
    $project_data = $_POST['project_data'];
    if(empty($project_data)){
        $return_arr = ['status'=>'error', 'message'=>'Error in project data input.'];
        echo json_encode($return_arr, true);
        return;
    }
    require_once "../class/projects_class.php";
    $projects_obj = new Projects_Class($mysqliObj);
    require_once "../class/employees_class.php";
    $employees_obj = new Employees_Class($mysqliObj);
    $get_employees = $employees_obj->get_active_employees(1, null);

    $project_employees_ids = array();
    if(!empty($project_data['project_employees']) && !empty($get_employees)){
        foreach($project_data['project_employees'] as $key=>$val){
            $project_employees_ids[$val]=[
                'name' => $get_employees[$val]['name'],
                'last_name' => $get_employees[$val]['last_name']
            ];
        }
    }
    $project_data['project_employees'] = !empty($project_employees_ids) ? $project_employees_ids : null;
    $project_save = $projects_obj->save_project($id, $project_data);

    if($project_save > 0){
        $return_arr = ['status'=>'success', 'message'=>'Project saved!'];
        echo json_encode($return_arr, true);
    }elseif($project_save == 0){
        $return_arr = ['status'=>'error', 'message'=>'No changes made!'];
        echo json_encode($return_arr, true);
    }else{
        $return_arr = ['status'=>'error', 'message'=>'Fail to save!'];
        echo json_encode($return_arr, true);
    }
    return;
}
