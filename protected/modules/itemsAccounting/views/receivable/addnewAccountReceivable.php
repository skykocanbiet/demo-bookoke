<?php $baseUrl = Yii::app()->request->baseUrl; ?>
<hr style="background-color: #5C2B95  ;opacity:0.5;" />
<?php 
$model->received_date = date("Y-m-d");  
$model->number = $model->getArNumber(date("Y-m-d"));
$form=$this->beginWidget('CActiveForm', array(
'id'=>'View-Frm-Account-Receivable',
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
        <span style="padding: 5px 10px;font-size: 20px; display: block;">RECEIPT VOUCHER</span>
        <span style="position: absolute;top: 7px;right: 0px;">
            <?php echo CHtml::submitButton('Add',array('class'=>'button_izi')); ?> 
        </span>
        <span style="position: absolute;top: 45px;right: 0px;">
           <span class="button_izi" onclick="addnew_v_receivable();"style="display: inline-block;line-height: 30px;" >Clear</span> 
        </span>
    </div>

    <div class="box_form">
    <?php echo $form->errorSummary($model,'<button type="button" class="close" data-dismiss="alert">&times;</button>','',array('class'=>'alert alert-block')); ?>
        <div style="float: left;width: 50%;">
            <!-- Payer -->
            <div class="new_product_row">
                <span class="account_label"><span style="color: red;">*</span>Payer:</span>
                <span>
                    <?php echo $form->textField($model,'name',array('value'=>$model->name,'required'=>'required')); ?>
                    <span class="error_message"><?php echo $form->error($model,'name',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Address -->
            <div class="new_product_row">
                <span class="account_label">Address:</span>
                <span>
                    <?php echo $form->textField($model,'address',array('value'=>$model->address)); ?>
                    <span class="error_message"><?php echo $form->error($model,'address',array('class'=>'alert fade in')); ?></span>
                </span> 
            </div>
            <!-- Phone -->
            <div class="new_product_row">
                <span class="account_label"><span style="color: red;">*</span>Phone:</span>
                <span>
                    <?php echo $form->textField($model,'phone',array('value'=>$model->phone,'required'=>'required','pattern'=>'[0-9]+','title'=>'Please enter the number!')); ?>
                    <span class="error_message"><?php echo $form->error($model,'phone',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Amount -->
            <div class="new_product_row">
                <span class="account_label"><span style="color: red;">*</span>Amount:</span>
                <span>
                    <?php echo $form->textField($model,'amount',array('value'=>$model->amount,'required'=>'required','type'=>'number','pattern'=>'[0-9]+','title'=>'Please enter the number!')); ?>
                    <span class="error_message"><?php echo $form->error($model,'amount',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- In Words -->
            <div class="new_product_row">
                <span class="account_label">In words:</span>
                <span>
                    <?php echo $form->textField($model,'in_words',array('value'=>$model->in_words)); ?>
                    <span class="error_message"><?php echo $form->error($model,'in_words',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Description -->
            <div class="new_product_row">
                <span class="account_label"><span style="color: red;">*</span>Description:</span>
                <span>
                    <?php echo $form->textArea($model,'description',array('value'=>$model->description,'style'=>'width: 40%;height:95px;','required'=>'required')); ?>
                    <span class="error_message"><?php echo $form->error($model,'description',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
        </div>
        
        <div style="float: left; width: 45%;">
            <!-- Number -->
            <div class="new_product_row">
                <span class="account_label">AR Number:</span>
                <span>
                    <?php echo $form->textField($model,'number',array('value'=>$model->number,'required'=>'required',"readonly"=>"readonly")); ?>
                    <span class="error_message"><?php echo $form->error($model,'number',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Type -->
            <div class="new_product_row">
                <span class="account_label"><span style="color: red;">*</span>AR Type:</span>
                <span>
                    <?php 
                        $listdata      = array();
                        $listdata['']  = "Select Type";
                        $listdata['0'] = "Revenue";
                        $listdata['1'] = "Investment";
                        $listdata['2'] = "Others";
                        echo $form->dropDownList($model,'type',$listdata,array('required'=>'required','style'=>'width: 205px;','options'=>array($model->type =>array('selected'=>true))));
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
                        echo $form->dropDownList($model,'payment_status',$listdata,array('required'=>'required','style'=>'width: 205px;'));
                    ?>
                    <span class="error_message"><?php echo $form->error($model,'payment_status',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Requester date -->
            <div class="new_product_row">
                <span class="account_label">Received date:</span>
                <span>
                    <?php echo $form->textField($model,'received_date',array('value'=>$model->received_date,'required'=>'required',"readonly"=>"readonly")); ?>
                    <span class="error_message"><?php echo $form->error($model,'received_date',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Approval date -->
            <div class="new_product_row">
                <span class="account_label">Confirmed date:</span>
                <span>
                    <?php echo $form->textField($model,'confirmed_date',array('value'=>$model->confirmed_date,"disabled"=>"disabled")); ?>
                    <span class="error_message"><?php echo $form->error($model,'confirmed_date',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Cashier -->
            <div class="new_product_row">
                <span class="account_label">Cashier:</span>
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
                    <?php echo $form->textArea($model,'note',array('value'=>$model->note,'style'=>'width: 45%;height:50px;')); ?>
                    <span class="error_message"><?php echo $form->error($model,'note',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            
        </div>
        <div class="clearfix"></div>
    </div>
<?php $this->endWidget(); ?>

<!-- BG POPUP -->

<script>
$(document).ready(function(){
    
    $('#View-Frm-Account-Receivable').submit(function(e) {
		//Prevent the default action, which in this case is the form submission.
		e.preventDefault();
		//Serialize the form data and store to a variable.
		var formData = new FormData($("#View-Frm-Account-Receivable")[0]);
        if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({ type:"POST",
                            url:"<?php echo CController::createUrl('reports/addnew_'.$model->tableName().'')?>",
                            data:formData,
                            datatype:'json',
                            beforeSend: function() {
                                jQuery("#view_payment_voucher").slideUp();
                                $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                            },
                            success:function(data){
        						if(data!='-1' || data != "" ){
        							jQuery("#idwaiting_main").html('');
        							jQuery("#view_payment_voucher").html(data);
                                    jQuery("#view_payment_voucher").slideDown();
                                    var cur_page = $("#id_text_page").val();
                                    search_cus(cur_page);
                                    
        						}
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
    
    $(function() {
    	$( "#VReceivable_received_date" ).datepicker({
    		changeMonth: true,
    		changeYear: true,
            dateFormat: 'yy-mm-dd'
    	});
    });
    
});
</script>