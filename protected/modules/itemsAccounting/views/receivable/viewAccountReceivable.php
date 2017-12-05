

<?php $baseUrl = Yii::app()->baseUrl;?>

<div id="oSrchBar" class="col-md-12">
    <?php include_once('_frmSearchAccountReceivable.php') ?>
</div>

<div class="col-md-12" id="return_content" style="margin-top: 15px;">
    <!-- Table List -->
</div>

<script>
function <?php echo 'addnew_'.$model->tableName(); ?>(){
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl('Receivable/addnew_'.$model->tableName().'')?>",
                    beforeSend: function() {
                        $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                    },
                    success:function(data){
            			if(data!='-1'){
            				jQuery("#idwaiting_main").html('');
            				jQuery("#view_payment_voucher").html(data);
                            $('html, body').animate({
                                scrollTop: $("#view_payment_voucher").offset().top
                            }, 800);
            			}
                    },
                    error: function(data){
                        $('#idwaiting_main').html('');
                        alert("Error occured.Please try again!");
                    },
    });
}
function <?php echo 'edit_'.$model->tableName(); ?>(id){
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl('Receivable/edit_'.$model->tableName().'')?>",
                    data:{
                        id  : id,  
                    },
                    beforeSend: function() {
                        $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                    },
                    success:function(data){
            			if(data!='-1'){
            				jQuery("#idwaiting_main").html('');
            				jQuery("#view_payment_voucher").html(data);
                            $('html, body').animate({
                                scrollTop: $("#view_payment_voucher").offset().top
                            }, 800);
            			}
                    },
                    error: function(data){
                        $('#idwaiting_main').html('');
                        alert("Error occured.Please try again!");
                    },
    });
}
function <?php echo 'delete_'.$model->tableName(); ?>(id){
    if(!confirm('Are you sure?')) return false;
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl('Receivable/delete_'.$model->tableName().'')?>",
                    data:{
                        id  :  id,
                    },
                    beforeSend: function() {
                        $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                    },
                    success:function(data){
                        if(data == '1'){
                            search_cus(1);
                        }else{
                            alert('Error.Delete failed !');  
                        }
                        $('#idwaiting_main').html('');
                    },
                    error: function(data) { 
                        $('#idwaiting_main').html('');
                        alert("Error occured.Please try again!");
                    },
    });
}
function confirmedReceivable(id,status){
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl('Receivable/confirmedReceivable')?>",
                    data:{
                        id      : id,
                        status  : status 
                    },
                    beforeSend: function() {
                        $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                    },
                    success:function(data){
                        if(data == 1){
                            $('#idwaiting_main').html('');
                            edit_v_receivable(id);
                        }
                    },
                    error: function(data){ 
                        $('#idwaiting_main').html('');
                        alert("Error occured.Please try again!");
                    },
    });
}
function editVReceivable (){
        $('#VReceivable_name').prop("readonly",false);
        $('#VReceivable_address').prop("readonly",false);
        $('#VReceivable_phone').prop("readonly",false);
        $('#VReceivable_amount').prop("readonly",false);
        $('#VReceivable_in_words').prop("readonly",false);
        $('#VReceivable_description').prop("readonly",false);
        $('#VReceivable_note').prop("readonly",false);
        $('#VReceivable_requester_date').prop("disabled",false);
        $('#VReceivable_type').prop("disabled",false);
        $('#VReceivable_payment_status').prop("disabled",false);
        
        $('#editVReceivable').addClass('hiden');
        $('#saveVReceivable').removeClass('hiden');
}
function runScript(e) {
    if (e.keyCode == 13) {
        var page_1=$('#id_text_page').val();
        if(page_1)
            search_cus(page_1);
        else
            search_cus('1');
    }
}
</script>