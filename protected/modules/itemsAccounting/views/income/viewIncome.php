<?php
$this->breadcrumbs=array(
	'Reports'=>array('quotations'),
	'Income',
);

?>
<?php if(isset($this->breadcrumbs))?>
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	))?><!-- breadcrumbs -->

<div id="content" style="padding-right: 0;">
	<ul id="menuk" class="menuk">
	<?php
		include_once(Yii::app()->theme->basePath.'/views/layouts/tab.php');
        MyTab::getTab('accountpayable', 'Account Payable', 'Reports/accountpayable');
        MyTab::getTab('receivable', 'Account Receivable', 'Reports/receivable');
        MyTab::getTab('income', 'Income Statement', 'Reports/Income','active');
        MyTab::getTab('cashflow', 'Cashflow', 'Reports/Cashflow');
        MyTab::getTab('balancesheet', 'Balance Sheet', 'Reports/BalanceSheet');
	?>
	</ul>
	<div id="description" class="contentk">  
		<div id="idwaiting_search" style="position: absolute;margin-left: 260px;margin-top:-18px"></div>
		<div style="" id="id_viewcontent">
            <div id="frm_search">
                <?php include_once('_frmSearchIncome.php'); ?>
            </div>
		</div>
	</div>
</div>
<script>
function <?php echo 'addnew_'.$model->tableName(); ?>(){
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl('sales/addnew_'.$model->tableName().'')?>",
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
                    url:"<?php echo CController::createUrl('sales/edit_'.$model->tableName().'')?>",
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
                    url:"<?php echo CController::createUrl('sales/delete_'.$model->tableName().'')?>",
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