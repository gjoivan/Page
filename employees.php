<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-10">
        <h4>Verified Clients:</h4>
        
        <div class="row">
            <div class="col-xs-4">
                <div class="input-group" style="margin:7px 0;max-width:300px;">
                    <input type="text" class="form-control" placeholder="Search" id="verified_client_email">
                    <div class="input-group-btn">
                        <a class="btn btn-primary" placeholder="Search by email" onclick="load_verified_clients_table();"><i class="glyphicon glyphicon-search"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xs-4">
                <a class="btn btn-primary" style="margin-top:8px;" target="_blank" href="/bo/ajax/clients_ajax.php?e=export_verified_clients">Export Verified Clients</a>
            </div>
        </div>
        <div id="table_clients_verified_tbody"></div>
    </div>
</div>
