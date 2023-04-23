
<script>
  function user_log_out(){
    $.post("./ajax/login_ajax.php", {event: 'user_log_out'}, function(data, status){
      var data = JSON.parse(data);
      if(data.status == "success"){
        window.location.href = 'http://localhost/Page/';
      }else{
        $('#response').html(data.message); 
      }
    });
  }
</script>
