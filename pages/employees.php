<div class="row">
    <h4>Employees:</h4>
    <div class="row">
        <div class="col-xs-3">
            <div class="input-group" style="margin:7px 0;max-width:300px;" style="float: left">
                <input type="text" class="form-control" placeholder="Search" id="get_employee">
                <div class="input-group-btn">
                    <a class="btn btn-primary" placeholder="Search by email" onclick="load_active_employees_table();"><i class="glyphicon glyphicon-search"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="input-group" style="margin:7px 0;max-width:300px;"  style="float: left;">
                <select type="text" class="form-control" placeholder="Search" id="employee_status">
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
                <div class="input-group-btn">
                    <a class="btn btn-primary" placeholder="Search by email" onclick="load_active_employees_table();"><i class="glyphicon glyphicon-search"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xs-2"></div>
        <div class="col-xs-2">
            <a style="float: right; margin-top: 10px;" class="btn btn-sm btn-primary" target="_blank" onclick="create_edit_employee_modal();">Create employee</a>
        </div>
        <div class="col-xs-2">
            <a style="margin-top: 10px;" class="btn btn-sm btn-primary" target="_blank" href="/bo/ajax/clients_ajax.php?e=export_verified_clients">Export Employees</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div id="table_active_employees_tbody"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        load_active_employees_table();
    });
    function load_active_employees_table(){
        var name;
        name = $('#get_employee').val(); 
        var status;
        status = $('#employee_status').val(); 
        $('#table_active_employees_tbody').load('./ajax/employees_ajax.php', {event: "load_active_employees_table", name: name, status: status});
    }
    function create_edit_employee_modal(id){
        $('#generic_modal_body').css({"max-width": "1200px", "min-width": "1200px"}).html('');
        $.post("./ajax/employees_ajax.php", {event: 'create_edit_employee_modal', id: id}, function(data, status){
            $('#generic_modal_body').html(data);
            display_modal('.generic_modal');
        });
    }
    function delete_employee(id){
        if(!confirm('Are you sure you want to delete emplyee?')){
            return;
        }
        $.post("./ajax/employees_ajax.php", {event: 'delete_employee', id: id}, function(data, status){
            var data = JSON.parse(data);
            if(data.status){
                alert(data.message);
                load_active_employees_table();
            }else{
                alert("Error in response data");
            }
        });
    }
    function save_employee(id){
        var employee_data={};
        if($('#employee_name').val()== '' || $('#employee_last_name').val() == '' || $('#employee_email').val() =='' || $('#employee_embg').val() == '' || $('#employee_start_date').val() == '' || $('#employee_status').val() == ''){
            alert('All fields must me filled');
            return;
        }
        if($('#employee_status_modal').val() != 1 && $('#employee_status_modal').val() != 0 ){
            alert('Status can be 1 for active  or 0 for inactive employee');
            $('#employee_status_modal').focus();
            return; 
        }
        employee_data.name = $('#employee_name').val();
        employee_data.last_name = $('#employee_last_name').val();
        employee_data.role = $('#employee_role').val();
        employee_data.email = $('#employee_email').val();
        employee_data.embg = $('#employee_embg').val();
        employee_data.date_start = $('#employee_start_date').val();
        employee_data.status = $('#employee_status_modal').val();
        employee_data.project_id = $('#employee_project').val();
        $.post("./ajax/employees_ajax.php", {event: 'save_employee', id: id, employee_data: employee_data}, function(data, status){
            var data = JSON.parse(data);
            if(data.status=='success'){
                alert(data.message);
                display_modal('.generic_modal');
            }else{
                alert(data.message);
            }
            load_active_employees_table();
        });
        return;
    }
</script>