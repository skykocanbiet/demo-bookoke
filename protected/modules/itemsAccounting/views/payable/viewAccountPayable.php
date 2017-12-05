

<?php $baseUrl = Yii::app()->baseUrl;?>
<style type="text/css">
.sHeader {
    background: #e6e6e5;
    color: #5a5a5a;
    padding: 10px 15px 5px 15px;
    font-size: 18px;
    text-transform: uppercase;
}
#return_popup_content{
    padding: 25px;
}
#return_content{
    margin-top: 5px;
}
</style>
<div id="oSrchBar" class="col-md-12">
    <?php include_once('_frmSearchAccountPayable.php') ?>
</div>
<div class="col-md-12 margin-top-20" id="return_content">
</div>


<script>

function <?php echo 'addnew_'.$model->tableName(); ?>(){
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl('Payable/addnew_'.$model->tableName().'')?>",
                    beforeSend: function() {
                        $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                    },
                    success:function(data){
            			if(data!='-1'){
            				jQuery("#idwaiting_main").html('');
            				jQuery("#return_popup_content").html(data);
                            $('html, body').animate({
                                scrollTop: $("#return_popup_content").offset().top
                            }, 400);
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
                    url:"<?php echo CController::createUrl('Payable/edit_'.$model->tableName().'')?>",
                    data:{
                        id  : id,  
                    },
                    beforeSend: function() {
                        $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                    },
                    success:function(data){
            			if(data!='-1'){
            				jQuery("#idwaiting_main").html('');
            				jQuery("#return_popup_content").html(data);
                            $('html, body').animate({
                                scrollTop: $("#return_popup_content").offset().top
                            }, 400);
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
                    url:"<?php echo CController::createUrl('Payable/delete_'.$model->tableName().'')?>",
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

function approvalPayable(id,status){
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl('Payable/approvalPayable')?>",
                    data:{
                        id      : id,
                        status  : status 
                    },
                    beforeSend: function(){
                        $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                    },
                    success:function(data){
                        if(data == 1){
                            $('#idwaiting_main').html('');
                            edit_v_payable(id);
                        }
                    },
                    error: function(data){
                        $('#idwaiting_main').html('');
                        alert("Error occured.Please try again!");
                    },
    });
}

function editVPayable(){
        $('#VPayable_name').prop("readonly",false);
        $('#VPayable_address').prop("readonly",false);
        $('#VPayable_phone').prop("readonly",false);
        $('#VPayable_amount').prop("readonly",false);
        $('#VPayable_in_words').prop("readonly",false);
        $('#VPayable_description').prop("readonly",false);
        $('#VPayable_note').prop("readonly",false);
        $('#VPayable_requester_date').prop("disabled",false);
        $('#VPayable_type').prop("disabled",false);
        $('#VPayable_payment_status').prop("disabled",false);
        
        $('#editVPayable').addClass('hiden');
        $('#saveVPayable').removeClass('hiden');
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
search_cus('1');
<?php echo 'addnew_'.$model->tableName(); ?>();
</script>