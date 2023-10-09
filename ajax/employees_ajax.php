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
$roles = array(
    '1'=>"Engineer",
    '2'=>"Supervisor",
    '3'=>"Construction",
    '4'=>"Tesar",
    '5'=>"Armirac",
    '6'=>"Labor",
    '7'=>"Machine Operator",
    '8'=>"Finances",
);
if($event == 'load_active_employees_table'){
    $name = $_POST['name'];
    $status = $_POST['status'];
    require_once "../class/employees_class.php";
    $employees_obj = new Employees_Class($mysqliObj);
    $get_employees = $employees_obj->get_active_employees($status, $name);
    require_once "../class/projects_class.php";
    $projects_obj = new Projects_Class($mysqliObj);
    $projects = $projects_obj->get_projects(null, null);
    ?>
    <table class="table table-responsive table-bordered table-hover" id="table_clients" style=" width: 100%;height: 100%;">
        <thead>
            <tr>
                <th style="width:auto;">#</th>
                <th style="width:auto;">ID</th>
                <th>Name</th>
                <th>Last name</th> 
                <th>Role</th> 
                <th style="width:auto;">Email</th>
                <th>EMBG</th>
                <th>Status</th>
                <!-- <th>Projects</th> -->
                <th>Date Started</th>
                <th>Options</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody  style="font-size:13px;">
            <?php $count = 1; 
                foreach($get_employees as $employee){ 
                    if(!empty($employee['project_id'])){
                        $employee_projects = json_decode($employee['project_id'], true);
                    } 
                    $employee_active_projects = '';
                    // foreach($employee_projects as $e_key=>$e_val){
                    //     if($projects[$e_key]['status'] == 1){
                    //         $employee_active_projects = $employee_active_projects.$projects[$e_key]['code'].'<br>';
                    //     }
                    // } 
                    ?>
                    <tr>
                        <th><?php echo $count; $count ++;?></th>
                        <th><?php echo $employee['id']?></th>
                        <th><?php echo $employee['name']?></th>
                        <th><?php echo $employee['last_name']?></th>
                        <th><?php echo $roles[$employee['role']]?></th>
                        <th><?php echo $employee['email']?></th>
                        <th><?php echo $employee['embg']?></th>
                        <th><?php echo $employee['status'] == 1 ? 'Active' : 'Inactive';?></th>
                        <!-- <th> <?php echo !empty($employee_active_projects) ? $employee_active_projects : 'none' ?> </th> -->
                        <th><?php echo $employee['date_start']?></th>
                        <th><a class="btn btn-lg" onclick="create_edit_employee_modal(<?php echo $employee['id']?>)"><i class="glyphicon glyphicon-wrench"></i></a></th>
                        <th><a class="btn btn-danger" onclick="delete_employee(<?php echo $employee['id']?>)">Delete</a></th>
                    </tr>
            <?php } ?>
        </tbody>
    </table>
<?php return;
}
if($event == 'create_edit_employee_modal'){
    ini_set("display_errors",1);
    error_reporting(E_ALL); 
    $id = !empty($_POST['id']) ? $_POST['id'] : null;
    require_once "../class/employees_class.php";
    require_once "../class/projects_class.php";
    $employees_obj = new Employees_Class($mysqliObj);
    $projects_obj = new Projects_Class($mysqliObj);
    $employee = $employees_obj->get_employee($id);
    // $employee_projects = json_decode($employee['project_id'], true);
    // $employee_projects_ids = !empty($employee_projects) ? array_keys($employee_projects) :null;
    $projects = $projects_obj->get_projects(null, null);
    $employee_projects=null;
    if(!empty($projects)){
        foreach($projects as $key=>$project){
            if($project['status'] != '1'){
                unset($projects[$key]);
                continue;
            }
            if(empty($project['project_employees'])){ 
                continue;
            }else{
                $project_employees_ids = json_decode($project['project_employees'], true);
                $project_employees_ids = array_keys($project_employees_ids);
                if(in_array($id, $project_employees_ids)){
                    $employee_projects[$project['id']]=$project;
                }
            }
            
        }
    }

    if(!empty($id) && empty($employee)){
        $return_arr = ['status'=>'error', 'message'=>'No employee found in database.'];
        echo json_encode($return_arr, true);
        return;
    }
    ?>
    <div class="modal generic_modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-6" style="margin: auto;left:25%;">
                    <h4><?php echo ($id != 0 ? "Edit employee" : "Create employee");?></h4>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right;" onclick="display_modal('.generic_modal');">X</a>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Name</label>
                        <input type="email" id="employee_name" class="form-control" placeholder="Employee name" style="margin-bottom:10px;" value="<?php echo !empty($employee['name']) ? $employee['name'] : ''; ?>"/>
                    </div>
                    <div class="col-sm-3">
                        <label>Last Name</label>
                        <input type="email" id="employee_last_name" class="form-control" placeholder="Employee last name" style="margin-bottom:10px;"  value="<?php echo !empty($employee['last_name']) ? $employee['last_name'] : ''; ?>"/>
                    </div>
                    <div class="col-sm-2">
                        <label>Emplyee Role</label>
                        <select type="text" class="form-control" id="employee_role">
                            <option value=1; <?php echo isset($employee['role']) && $employee['role'] == 1 ? 'selected' : ''; ?>> <?php echo 'Engineer' ?></option>                        
                            <option value=2; <?php echo isset($employee['role']) && $employee['role'] == 2 ? 'selected' : ''; ?>> <?php echo 'Supervisor' ?></option>                        
                            <option value=3; <?php echo isset($employee['role']) && $employee['role'] == 3 ? 'selected' : ''; ?>> <?php echo 'Construction' ?></option>                        
                            <option value=4; <?php echo isset($employee['role']) && $employee['role'] == 4 ? 'selected' : ''; ?>> <?php echo 'Tesar' ?></option>                        
                            <option value=5; <?php echo isset($employee['role']) && $employee['role'] == 5 ? 'selected' : ''; ?>> <?php echo 'Armirac' ?></option>                        
                            <option value=6; <?php echo isset($employee['role']) && $employee['role'] == 6 ? 'selected' : ''; ?>> <?php echo 'Labor' ?></option>                        
                            <option value=7; <?php echo isset($employee['role']) && $employee['role'] == 7 ? 'selected' : ''; ?>> <?php echo 'Machine Operator' ?></option>                        
                            <option value=8; <?php echo isset($employee['role']) && $employee['role'] == 8 ? 'selected' : ''; ?>> <?php echo 'Finance' ?></option>                        
                        </select>                    
                    </div>
                    <div class="col-sm-4">
                        <label>Email</label>
                        <input type="email" id="employee_email" class="form-control" placeholder="Employee email" style="margin-bottom:10px;" value="<?php echo !empty($employee['email']) ? $employee['email'] : ''; ?>"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>EMBG</label>
                        <input type="email" id="employee_embg" class="form-control" placeholder="Employee EMBG" style="margin-bottom:10px;" value="<?php echo !empty($employee['embg']) ? $employee['embg'] : ''; ?>"/>
                    </div>
                    <div class="col-sm-2">
                        <label>Status</label>
                        <select type="text" class="form-control" id="employee_status_modal">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label>Start Date</label>
                        <input type="date" id="employee_start_date" class="form-control" placeholder="Employee start date" style="margin-bottom:10px;" value="<?php echo !empty($employee['date_start']) ? date('Y-m-d', strtotime($employee['date_start'])) : ''; ?>"/>
                    </div>
                    <div class="col-sm-4">
                        <label>Projects</label>
                        <ul>
                            <?php if(!empty($employee_projects)){
                                foreach($employee_projects as $key=>$project){
                                    ?>
                                    <li value=<?php echo $project['id']; ?> ><?php echo $project['code']; ?></option>
                                <?php } 
                            } ?>
                        </ul>
                        <!-- EMPLOYEE PROJECTS -->
                        <!-- <label>Project</label>
                        <select id="employee_project" multiple>
                            <?php foreach($projects as $key=>$project){ ?>
                                <option value=<?php echo $project['id']; ?> 
                                    <?php $flag = false;
                                    if(!empty($employee_projects_ids)){
                                        if(in_array($project['id'], $employee_projects_ids)){ 
                                            $flag = true;
                                        }
                                    }
                                    echo $flag==true ? 'selected' : ''; ?>>
                                    <?php echo $project['code']; ?>
                                </option>
                            <?php } ?>
                        </select> -->
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="display_modal('.generic_modal');">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_employee(<?php echo !empty($employee['id']) ? $employee['id'] : ''; ?>);">Save changes</button>
            </div>
            </div>
        </div>
    </div>  
    <script>
        $('#employee_project').selectpicker();
    </script>
    <?php return;
} 
if($event == 'delete_employee'){
    $id = $_POST['id'];
    require_once "../class/employees_class.php";
    $employees_obj = new Employees_Class($mysqliObj);
    $check_employee = $employees_obj->get_employee($id);
    if(!empty($check_employee)){
        $delete_employee = $employees_obj->delete_employee($id);
        if($delete_employee > 0){
            $return_arr = ['status'=>'success', 'message'=>'Employee deleted'];
            echo json_encode($return_arr, true);
            return;
        }else{
            $return_arr = ['status'=>'error', 'message'=>'Error while deleting client!'];
            echo json_encode($return_arr, true);
            return;
        }
    }else{
        $return_arr = ['status'=>'error', 'message'=>'Employee already dont exist'];
        echo json_encode($return_arr, true);
        return;
    }
}
if($event == 'save_employee'){
    require_once "../class/projects_class.php";
    $projects_obj = new Projects_Class($mysqliObj);
    $projects = $projects_obj->get_projects(null, null);
    foreach($projects as $key=>$project){
        if($project['status'] != '1'){
            unset($projects[$key]);
        }
    }
    $id = !empty($_POST['id']) ? $_POST['id'] : null;
    $employee_data = $_POST['employee_data'];
    if(empty($employee_data)){
        $return_arr = ['status'=>'error', 'message'=>'Error in employee data input.'];
        echo json_encode($return_arr, true);
        return;
    }
    require_once "../class/employees_class.php";
    $employees_obj = new Employees_Class($mysqliObj);
    $check_employee = $employees_obj->get_employee_embg($employee_data['embg']);
    if($check_employee && $check_employee['embg'] == $employee_data['embg'] && $id==null){
        $return_arr = ['status'=>'error', 'message'=>'Employee with same EMBG allready exists.'];
        echo json_encode($return_arr, true);
        return;
    }
    // EMPLOYEE PROJECTS
    // $emplyee_projects_arr = array();
    // if(!empty($employee_data['project_id']) && !empty($projects)){
    //     foreach($employee_data['project_id'] as $key=>$val){
    //         $emplyee_projects_arr[$val]=[
    //             'code' => $projects[$val]['code']
    //         ];
    //     }
    // }
    // $employee_data['project_id'] = !empty($emplyee_projects_arr) ? $emplyee_projects_arr : null;
    $employee = $employees_obj->save_employee($id, $employee_data);
    if($employee > 0){
        $return_arr = ['status'=>'success', 'message'=>'Employee saved!'];
        echo json_encode($return_arr, true);
    }else{
        $return_arr = ['status'=>'error', 'message'=>'Fail to save!'];
        echo json_encode($return_arr, true);
    }
    return;
}
