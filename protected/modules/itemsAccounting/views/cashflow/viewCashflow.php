<?php $baseUrl = Yii::app()->baseUrl;?>

<div id="oSrchBar" class="col-md-12">
    <?php include_once('_frmSearchCashflow.php') ?>
</div>

<div class="col-md-12" id="return_content" style="margin-top: 15px;">
    <!-- Table List -->
</div>

<script>

function <?php echo 'addnew_'.$model->tableName(); ?>(){
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl('Cashflow/addnew_'.$model->tableName().'')?>",
                    beforeSend: function() {
                        $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                    },
                    success:function(data){
            			if(data!='-1'){
            				jQuery("#idwaiting_main").html('');
            				jQuery("#id_viewcontent").html(data);
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
                    url:"<?php echo CController::createUrl('Cashflow/edit_'.$model->tableName().'')?>",
                    data:{
                        id  : id,  
                    },
                    beforeSend: function() {
                        $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                    },
                    success:function(data){
            			if(data!='-1'){
            				jQuery("#idwaiting_main").html('');
            				jQuery("#id_viewcontent").html(data);
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
                    url:"<?php echo CController::createUrl('Cashflow/delete_'.$model->tableName().'')?>",
                    data:{
                        id  :  id,
                    },
                    beforeSend: function() {
                        $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                    },
                    success:function(data){
                        if(data == id){
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