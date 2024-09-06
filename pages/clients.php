<div class="row">
    <h4>Clients:</h4>
    <div class="col-xs-3">
        <div class="input-group" style="margin:7px 0;max-width:300px;" >
            <input type="text" class="form-control" placeholder="Search" id="get_client">
            <div class="input-group-btn">
                <a class="btn btn-primary" placeholder="Search by code" onclick="load_clients_table();"><i class="glyphicon glyphicon-search"></i></a>
            </div>
        </div>
    </div>
    <div class="col-xs-2">
        <div class="input-group" style="margin:7px 0;max-width:300px;">
            <select type="text" class="form-control" placeholder="Search" id="client_status">
                <option value="1" selected>Active</option>
                <option value="2">Finished</option>
                <option value="-1">Deleted</option>
            </select>
            <div class="input-group-btn">
                <a class="btn btn-primary" placeholder="Search by email" onclick="load_clients_table();"><i class="glyphicon glyphicon-search"></i></a>
            </div>
        </div>
    </div>
    <div class="col-xs-2">
        <a  class="btn btn-sm btn-primary" target="_blank" onclick="create_edit_client_modal();">Create client</a>
    </div>
    <div class="col-xs-2">
        <a class="btn btn-sm btn-primary" target="_blank" href="/bo/ajax/clients_ajax.php?e=export_verified_clients">Export client</a>
    </div>
    <div>
        <div id="table_active_clients_tbody"></div>
    </div>
</div>
<script>
    $(document).ready(function(){
        load_clients_table();
    });
    function load_clients_table(){
        var code;
        code = $('#get_client').val(); 
        var status;
        status = $('#client_status').val(); 
        $('#table_active_clients_tbody').load('./ajax/clients_ajax.php', {event: "load_clients_table", code: code, status: status});
    }
    function create_edit_client_modal(id){
        $('#generic_modal_body').css({"max-width": "900px", "min-width": "900px"}).html('');
        $.post("./ajax/clients_ajax.php", {event: 'create_edit_client_modal', id: id}, function(data, status){
            // var data = JSON.parse(data);
            $('#generic_modal_body').html(data);
            display_modal('.generic_modal');
        });
    }
    function delete_client(id){
        if(!confirm('Are you sure you want to delete client?')){
            return;
        }
        $.post("./ajax/clients_ajax.php", {event: 'delete_client', id: id}, function(data, status){
            var data = JSON.parse(data);
            if(data.status){
                alert(data.message);
                load_clients_table();
            }else{
                alert("Error in response data");
            }
        });
    }
    function save_client(id){
        var client_data={};
        client_data.code = $('#client_code').val();
        client_data.status = $('#client_status').val();
        client_data.date_start = $('#client_date_start').val();
        $.post("./ajax/clients_ajax.php", {event: 'save_client', id: id, client_data: client_data}, function(data, status){
            var data = JSON.parse(data);
            if(data.status=='success'){
                alert(data.message);
                display_modal('.generic_modal');
            }else{
                alert(data.message);
            }
            load_clients_table();
        });
        return;
    }
</script>