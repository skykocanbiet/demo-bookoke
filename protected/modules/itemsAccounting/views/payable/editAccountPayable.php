<?php 
$baseUrl = Yii::app()->request->baseUrl; 
$group_no = Yii::app()->user->getState('group_no');

?>
<hr style="background-color: #5C2B95  ;opacity:0.5;" />
<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'View-Frm-Account-Payable',
'enableClientValidation'=>false,
'enableAjaxValidation'=>false,
'htmlOptions'=>array(   'onsubmit'=>"return false;",
                        'enctype' => 'multipart/form-data',
),
)); ?>
    
    <?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="alert alert-success">
        <button type="button" data-dismiss="alert" class="close">×</button>
        <?php echo Yii::app()->user->getFlash('success')?>
    </div>
    <?php endif?>
    <?php if(Yii::app()->user->hasFlash('error')):?>
    <div class="alert alert-error">
    	<button data-dismiss="alert" class="close">×</button>
        <?php echo Yii::app()->user->getFlash('error')?>
    </div>
    <?php endif?> 
    
    <div style="color:#5C2B95;margin: 10px;position: relative;text-align: center;margin-bottom: 45px;">
        <span style="padding: 5px 10px;font-size: 20px; display: block;">PAYMENT VOUCHER</span>
        <?php if($model->status < 3 || ($group_no=='admin'|| $group_no=="superadmin" )){ ?>
            <span id="saveVPayable" class="hedin" style="position: absolute;top: 7px;right: 0px;">
                <?php echo CHtml::submitButton('Save',array('class'=>'button_izi'));?> 
            </span>
        <?php } ?>
        
        <?php if( ($group_no=='admin'|| $group_no=="superadmin" ) || $model->status < 3){ ?>
            <span id="editVPayable" style="position: absolute;top: 7px;right: 0px;">
               <span class="button_izi" onclick="editVPayable();"style="display: inline-block;line-height: 30px;" >Edit</span> 
            </span>
        <?php } ?>
        
        <span style="position: absolute;top: 45px;right: 0px;">
           <span class="button_izi" onclick="printVPayable();"style="display: inline-block;line-height: 30px;" >Print</span> 
        </span>
        
        <?php if($model->status < 3){ ?>
        <span style="position: absolute;top: 85px;right: 0px;">
           <span class="button_izi" onclick="delete_v_payable(<?php echo $model->id; ?>);"style="display: inline-block;line-height: 30px;" >Delete</span> 
        </span>
        <?php } ?>
    </div>
    
    <div class="box_form">
    <?php echo $form->errorSummary($model,'<button type="button" class="close" data-dismiss="alert">&times;</button>','',array('class'=>'alert alert-block')); ?>
        <div style="float: left;width: 50%;">
            <!-- Id -->
            <div class="new_product_row hiden">
                <span class="account_label"><span style="color: red;">*</span>Id:</span>
                <span>
                    <?php echo $form->textField($model,'id',array('value'=>$model->id,'required'=>'required')); ?>
                    <span class="error_message"><?php echo $form->error($model,'id',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Order Number -->
            <div class="new_product_row hiden">
                <span class="account_label"><span style="color: red;">*</span>Order Number:</span>
                <span>
                    <?php echo $form->textField($model,'order_number',array('value'=>$model->order_number)); ?>
                    <span class="error_message"><?php echo $form->error($model,'order_number',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Receiver -->
            <div class="new_product_row">
                <span class="account_label"><span style="color: red;">*</span>Receiver:</span>
                <span>
                    <?php echo $form->textField($model,'name',array('value'=>$model->name,'required'=>'required',"readonly"=>"readonly")); ?>
                    <span class="error_message"><?php echo $form->error($model,'name',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Address -->
            <div class="new_product_row">
                <span class="account_label">Address:</span>
                <span>
                    <?php echo $form->textField($model,'address',array('value'=>$model->address,"readonly"=>"readonly")); ?>
                    <span class="error_message"><?php echo $form->error($model,'address',array('class'=>'alert fade in')); ?></span>
                </span> 
            </div>
            <!-- Phone -->
            <div class="new_product_row">
                <span class="account_label"><span style="color: red;">*</span>Phone:</span>
                <span>
                    <?php echo $form->textField($model,'phone',array('value'=>$model->phone,'required'=>'required',"readonly"=>"readonly",'pattern'=>'[0-9]+','title'=>'Please enter the number!')); ?>
                    <span class="error_message"><?php echo $form->error($model,'phone',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Amount -->
            <div class="new_product_row">
                <span class="account_label"><span style="color: red;">*</span>Amount:</span>
                <span>
                    <?php echo $form->textField($model,'amount',array('value'=>$model->amount,'required'=>'required',"readonly"=>"readonly",'type'=>'number','pattern'=>'[0-9]+','title'=>'Please enter the number!')); ?>
                    <span class="error_message"><?php echo $form->error($model,'amount',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- In Words -->
            <div class="new_product_row">
                <span class="account_label">In words:</span>
                <span>
                    <?php echo $form->textField($model,'in_words',array('value'=>$model->in_words,"readonly"=>"readonly")); ?>
                    <span class="error_message"><?php echo $form->error($model,'in_words',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Description -->
            <div class="new_product_row">
                <span class="account_label"><span style="color: red;">*</span>Description:</span>
                <span>
                    <?php echo $form->textArea($model,'description',array('value'=>$model->description,'style'=>'width: 40%;height:95px;','required'=>'required',"readonly"=>"readonly")); ?>
                    <span class="error_message"><?php echo $form->error($model,'description',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
        </div>
        <div style="float: left; width: 45%;">
            <!-- Number -->
            <div class="new_product_row">
                <span class="account_label">AP Number:</span>
                <span>
                    <?php echo $form->textField($model,'number',array('value'=>$model->number,'required'=>'required',"readonly"=>"readonly")); ?>
                    <span class="error_message"><?php echo $form->error($model,'number',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Type -->
            <div class="new_product_row">
                <span class="account_label"><span style="color: red;">*</span>Type:</span>
                <span>
                    <?php 
                        $listdata      = array();
                        $listdata['']  = "Select Type";
                        $listdata['0'] = "Cost of goods sold";
                        $listdata['1'] = "Discount and promotion";
                        $listdata['2'] = "Marketing and PR expenses";
                        $listdata['3'] = "Labor cost";
                        $listdata['4'] = "Instruments and tools";
                        $listdata['5'] = "Outside purchasing service cost";
                        $listdata['6'] = "Tax, Charges & Fee";
                        $listdata['7'] = "Other expenses";
                        echo $form->dropDownList($model,'type',$listdata,array('required'=>'required',"disabled"=>"disabled",'style'=>'width: 205px;'));
                    ?>
                    <span class="error_message"><?php echo $form->error($model,'type',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Payment Status -->
            <div class="new_product_row">
                <span class="account_label"><span style="color: red;">*</span>Payment Status:</span>
                <span>
                    <?php 
                        $listdata      = array();
                        $listdata['1'] = "Cash";
                        $listdata['2'] = "Creadit Card";
                        $listdata['3'] = "Check";
                        echo $form->dropDownList($model,'payment_status',$listdata,array('required'=>'required',"disabled"=>"disabled",'style'=>'width: 205px;'));
                    ?>
                    <span class="error_message"><?php echo $form->error($model,'payment_status',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Requester date -->
            <div class="new_product_row">
                <span class="account_label">Requested date:</span>
                <span>
                    <?php echo $form->textField($model,'requester_date',array('value'=>$model->requester_date,"disabled"=>"disabled",'required'=>'required',"readonly"=>"readonly")); ?>
                    <span class="error_message"><?php echo $form->error($model,'requester_date',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Approval date -->
            <div class="new_product_row">
                <span class="account_label">Approval date:</span>
                <span>
                    <?php echo $form->textField($model,'approval_date',array('value'=>$model->approval_date,"readonly"=>"readonly")); ?>
                    <span class="error_message"><?php echo $form->error($model,'approval_date',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Requester -->
            <div class="new_product_row">
                <span class="account_label">Requester:</span>
                <span>
                    <?php
                        $list = array();
                        $list[''] = "ALL";
                        $list_user_cs =  User::model()->findAllByAttributes(array('block'=>0));
                        foreach($list_user_cs as $temp){
                            if($temp['group_id'] > 0){
                                $list[$temp['id']] =  $temp['name'];
                            }
                        }
                        echo $form->dropDownList($model,'id_user',$list,array('style'=>'width: 205px;',"readonly"=>"readonly",'options'=>array(Yii::app()->user->getState('id_user')=>array('selected'=>true))));
                        
                    ?>
                    
                    <span class="error_message"><?php echo $form->error($model,'id_user',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Notes -->
            <div class="new_product_row">
                <span class="account_label">Notes:</span>
                <span>
                    <?php echo $form->textArea($model,'note',array('value'=>$model->note,"readonly"=>"readonly",'style'=>'width: 45%;height:50px;')); ?>
                    <span class="error_message"><?php echo $form->error($model,'note',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            
        </div>
        <div class="clearfix"></div>
    </div>
<?php $this->endWidget(); ?>
<style>
.approval {
    background-color: rgb(132, 205, 55);
}
.requesteda{
    background-color: rgba(171, 166, 166, 0.85);
}
</style>
<!-- APPROVAL -->
<?php 
    $group_no = Yii::app()->user->getState('group_no');
    if($model->status ==  0){
        $approvalReq = 'approval';
        $approvalMan = 'requesteda';
        $approvalDir = 'requesteda';
        $approvalAcc = 'requesteda';  
        
    }elseif($model->status ==  1){
        $approvalReq = 'approval';
        $approvalMan = 'approval';
        $approvalDir = 'requesteda';
        $approvalAcc = 'requesteda';
    }elseif($model->status ==  2){
        $approvalReq = 'approval';
        $approvalMan = 'approval';
        $approvalDir = 'approval';
        $approvalAcc = 'requesteda';
    }elseif($model->status ==  3){
        $approvalReq = 'approval';
        $approvalMan = 'approval';
        $approvalDir = 'approval';
        $approvalAcc = 'approval';
    }else{
        $approvalReq = 'requesteda';
        $approvalMan = 'requesteda';
        $approvalDir = 'requesteda';
        $approvalAcc = 'requesteda';
    }
?>
<div style="width: 85%; margin: 25px auto;margin-top: 4em;">

    <div style="width: 100px; float: left;text-align: center;">
        <span style="display: block;margin-bottom: 5px;">Requester</span>
        <?php if($model->status >= 0){ ?>
            <span onclick="approvalPayable(<?php echo $model->id; ?>,0);" class="button_izi <?php echo $approvalReq; ?>" style="display: inline-block;line-height: 30px; text-align: center; border-radius: 1px; ">Ok</span>
        <?php }else{ ?>
            <span class="button_izi <?php echo $approvalReq; ?>" style="display: inline-block;line-height: 30px; text-align: center; border-radius: 1px; ">Ok</span>
        <?php } ?>
    </div>
    
    <div style="width: 100px; float: left; text-align: center;margin-left:10.5em;">
        <span style="display: block; margin-bottom: 5px;">Manager</span>
        <?php if($model->status <= 1){ ?>
            <span onclick="approvalPayable(<?php echo $model->id; ?>,1);" class="button_izi <?php echo $approvalMan; ?>" style="display: inline-block;line-height: 30px; text-align: center; border-radius: 1px;">Ok</span>
        <?php }else{ ?>
            <span class="button_izi <?php echo $approvalMan; ?>" style="display: inline-block;line-height: 30px; text-align: center; border-radius: 1px;">Ok</span>
        <?php } ?>
    </div>
    
    <div style="width: 100px; float: left; text-align: center;margin-left:10.5em;">
        <span style="display: block; margin-bottom: 5px;">Director</span>
        <?php 
        if($model->status <= 2){
            if($group_no=='admin'|| $group_no=="superadmin"){ ?>
                <span onclick="approvalPayable(<?php echo $model->id; ?>,2);" class="button_izi <?php echo $approvalDir; ?>" style="display: inline-block;line-height: 30px; text-align: center; border-radius: 1px;">Ok</span>
            <? }else{ ?>
                <span class="button_izi <?php echo $approvalDir; ?>" style="display: inline-block;line-height: 30px; text-align: center; border-radius: 1px;">Ok</span>
            <?php } ?>
            
        <?php }else{ ?>
            <span class="button_izi <?php echo $approvalDir; ?>" style="display: inline-block;line-height: 30px; text-align: center; border-radius: 1px;">Ok</span>
        <?php } ?>
    </div>
    
    <div style="width: 100px; float: left; text-align: center;margin-left:10.5em;">
        <span style="display: block; margin-bottom: 5px;">Accountant</span>
        <?php if($model->status == 2){ ?>
            <span onclick="approvalPayable(<?php echo $model->id; ?>,3);" class="button_izi <?php echo $approvalAcc; ?>" style="display: inline-block;line-height: 30px; text-align: center; border-radius: 1px;">Ok</span>
        <?php }else{ ?>
            <span class="button_izi <?php echo $approvalAcc; ?>" style="display: inline-block;line-height: 30px; text-align: center; border-radius: 1px;">Ok</span>
        <?php } ?>
    </div>
    
    <div class="clearfix"></div>
</div>

<script>
$(document).ready(function(){
    
    $('#View-Frm-Account-Payable').submit(function(e) {
		//Prevent the default action, which in this case is the form submission.
		e.preventDefault();
		//Serialize the form data and store to a variable.
		var formData = new FormData($("#View-Frm-Account-Payable")[0]);
        if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({ type:"POST",
                            url:"<?php echo CController::createUrl('reports/edit_'.$model->tableName().'')?>",
                            data:formData,
                            datatype:'json',
                            beforeSend: function() {
                                jQuery("#view_payment_voucher").slideUp();
                                $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                            },
                            success:function(data){
                                var id = $("#VPayable_id").val();
                                if(data = '-2'){
                                    var order_number = $("#VPayable_order_number").val();
                                    alert("Please check the information order number :"+order_number+" from account receivable !");
                                }else{
                                    if(data!='-1' || data != "" ){
            							jQuery("#view_payment_voucher").html(data);
            						}
                                }
                                jQuery("#view_payment_voucher").slideDown();
                                jQuery("#idwaiting_main").html('');
                                var cur_page = $("#id_text_page").val();
                                search_cus(cur_page);
                                edit_v_payable(id);
        						
                            },
                            error: function(data) { 
                                jQuery("#view_payment_voucher").slideDown();
                                $('#idwaiting_main').html('');
                                alert("Error occured.Please try again!");
                            },
                            cache: false,
                            contentType: false,
                            processData: false
              });
          }
          return false;

	});
    
    $(function(){
    	$( "#VPayable_requester_date" ).datepicker({
    		changeMonth: true,
    		changeYear: true,
            dateFormat: 'yy-mm-dd'
    	});
    });
        
});
</script>