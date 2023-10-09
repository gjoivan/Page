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
if($event == 'load_active_employees_table'){
    $name = $_POST['name'];
    $status = $_POST['status'];
    require_once "../class/employees_class.php";
    $employees_obj = new Employees_Class($mysqliObj);
    $get_employees = $employees_obj->get_active_employees($status, $name);
    ?>
    <table class="table table-responsive table-bordered table-hover" id="table_clients" style=" width: 100%;height: 100%;">
        <thead>
            <tr>
                <th style="width:auto;">#</th>
                <th style="width:auto;">ID</th>
                <th>Name</th>
                <th>Last name</th> 
                <th style="width:auto;">Email</th>
                <th>EMBG</th>
                <th>Date Started</th>
                <th>Status</th>
                <th>Options</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody  style="font-size:13px;">
            <?php $count = 1; 
                foreach($get_employees as $employee){ ?>
                <tr>
                    <th><?php echo $count; $count ++;?></th>
                    <th><?php echo $employee['id']?></th>
                    <th><?php echo $employee['name']?></th>
                    <th><?php echo $employee['last_name']?></th>
                    <th><?php echo $employee['email']?></th>
                    <th><?php echo $employee['embg']?></th>
                    <th><?php echo $employee['date_start']?></th>
                    <th><?php echo $employee['status']?></th>
                    <th><a class="btn btn-lg" onclick="create_edit_employee_modal(<?php echo $employee['id']?>)"><i class="glyphicon glyphicon-wrench"></i></a></th>
                    <th><a class="btn btn-danger" onclick="delete_employee(<?php echo $employee['id']?>)">Delete</a></th>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php return;
}
if($event == 'create_edit_employee_modal'){
    $id = !empty($_POST['id']) ? $_POST['id'] : null;
    require_once "../class/employees_class.php";
    $employees_obj = new Employees_Class($mysqliObj);
    $employee = $employees_obj->get_employee($id);
    if(!empty($id) && empty($employee)){
        $return_arr = ['status'=>'error', 'message'=>'No client found in database.'];
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
                    <div class="col-sm-4">
                        <label for="client_modal_email">Name</label>
                        <input type="email" id="employee_name" class="form-control" placeholder="Employee name" style="margin-bottom:10px;" value="<?php echo !empty($employee['name']) ? $employee['name'] : ''; ?>"/>
                    </div>
                    <div class="col-sm-4">
                        <label for="client_modal_email">Last Name</label>
                        <input type="email" id="employee_last_name" class="form-control" placeholder="Employee last name" style="margin-bottom:10px;"  value="<?php echo !empty($employee['last_name']) ? $employee['last_name'] : ''; ?>"/>
                    </div>
                    <div class="col-sm-4">
                        <label for="client_modal_email">Email</label>
                        <input type="email" id="employee_email" class="form-control" placeholder="Employee email" style="margin-bottom:10px;" value="<?php echo !empty($employee['email']) ? $employee['email'] : ''; ?>"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="client_modal_email">EMBG</label>
                        <input type="email" id="employee_embg" class="form-control" placeholder="Employee EMBG" style="margin-bottom:10px;" value="<?php echo !empty($employee['embg']) ? $employee['embg'] : ''; ?>"/>
                    </div>
                    <div class="col-sm-4">
                        <label for="client_modal_email">Status</label>

                        <select type="text" class="form-control" placeholder="Search" id="employee_status_modal">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="client_modal_email">Start Date</label>
                        <input type="date" id="employee_start_date" class="form-control" placeholder="Employee start date" style="margin-bottom:10px;" value="<?php echo !empty($employee['date_start']) ? date('Y-m-d', strtotime($employee['date_start'])) : ''; ?>"/>
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
    $employee = $employees_obj->save_employee($id, $employee_data);
    if($employee > 0){
        $return_arr = ['status'=>'success', 'message'=>'Client saved!'];
        echo json_encode($return_arr, true);
    }else{
        $return_arr = ['status'=>'error', 'message'=>'Fail to save!'];
        echo json_encode($return_arr, true);
    }
    return;
}
