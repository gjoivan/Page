<div class="row">
    <h4>Projects:</h4>
    <div class="col-xs-3">
        <div class="input-group" style="margin:7px 0;max-width:300px;" >
            <input type="text" class="form-control" placeholder="Search" id="get_project">
            <div class="input-group-btn">
                <a class="btn btn-primary" placeholder="Search by code" onclick="load_projects_table();"><i class="glyphicon glyphicon-search"></i></a>
            </div>
        </div>
    </div>
    <div class="col-xs-2">
        <div class="input-group" style="margin:7px 0;max-width:300px;">
            <select type="text" class="form-control" placeholder="Search" id="project_status">
                <option value="1" selected>Active</option>
                <option value="2">Finished</option>
                <option value="-1">Deleted</option>
            </select>
            <div class="input-group-btn">
                <a class="btn btn-primary" placeholder="Search by email" onclick="load_projects_table();"><i class="glyphicon glyphicon-search"></i></a>
            </div>
        </div>
    </div>
    <div class="col-xs-2">
        <a style="margin-top: 10px;" class="btn btn-sm btn-primary" target="_blank" onclick="create_edit_project_modal();">Create project</a>
    </div>
    <div class="col-xs-2">
        <a style="margin-top: 10px;" class="btn btn-sm btn-primary" target="_blank" href="/bo/ajax/clients_ajax.php?e=export_verified_clients">Export project</a>
    </div>
    <div>
        <div id="table_active_projects_tbody"></div>
    </div>
</div>
<script>
    $(document).ready(function(){
        load_projects_table();
    });
    function load_projects_table(){
        var code;
        code = $('#get_project').val(); 
        var status;
        status = $('#project_status').val(); 
        $('#table_active_projects_tbody').load('./ajax/projects_ajax.php', {event: "load_projects_table", code: code, status: status});
    }
    function create_edit_project_modal(id){
        $('#generic_modal_body').css({"max-width": "700px", "min-width": "700px"}).html('');
        $.post("./ajax/projects_ajax.php", {event: 'create_edit_project_modal', id: id}, function(data, status){
            // var data = JSON.parse(data);
            $('#generic_modal_body').html(data);
            display_modal('.generic_modal');
        });
    }
    function delete_project(id){
        if(!confirm('Are you sure you want to delete project?')){
            return;
        }
        $.post("./ajax/projects_ajax.php", {event: 'delete_project', id: id}, function(data, status){
            var data = JSON.parse(data);
            if(data.status){
                alert(data.message);
                load_projects_table();
            }else{
                alert("Error in response data");
            }
        });
    }
    function save_project(id){
        var project_data={};
        project_data.code = $('#project_code').val();
        project_data.status = $('#selected_project_status').val();
        project_data.date_start = $('#project_date_start').val();
        project_data.location = $('#project_location').val();
        project_data.project_employees = $('#project_employees').val();

        $.post("./ajax/projects_ajax.php", {event: 'save_project', id: id, project_data: project_data}, function(data, status){
            var data = JSON.parse(data);
            if(data.status=='success'){
                alert(data.message);
                display_modal('.generic_modal');
            }else{
                alert(data.message);
            }
            load_projects_table();
        });
        return;
    }
</script>