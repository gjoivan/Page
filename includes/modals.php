<div class="modal generic_modal">
    <div class="modals-grey"></div>
    <div class="modals-all" id="generic_modal_body"></div>
</div>
<script>
    function display_modal(modal){
        if($(modal).is(':visible')){
            $(modal).fadeTo(150, 0);
            setTimeout(function(){$(modal).css("display", "none");}, 350);
            $(modal).find('.modals-all').removeClass('active');
        }
        else{
            $(modal).fadeTo(150, 1);
            $(modal).find('.modals-all').addClass('active');
        }
    }

</script>
<style>
    .modal-content {
      position: relative;
      display: -ms-flexbox;
      display: flex;
      -ms-flex-direction: column;
      flex-direction: column;
      width: 100%;
      pointer-events: auto;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid rgba(0, 0, 0, 0.2);
      border-radius: 0.3rem;
      outline: 0;
      max-height: 600px;
      max-width: 900px;
      overflow: scroll;
    }
</style>