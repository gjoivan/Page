<div class="modal generic_modal">
    <div class="modals-grey"></div>
    <div class="modals-all" id="generic_modal_body"></div>
</div>
<!-- <div class="modal generic_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modals-all" id="generic_modal_body">
        </div>
    </div>
  </div>
</div> -->
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