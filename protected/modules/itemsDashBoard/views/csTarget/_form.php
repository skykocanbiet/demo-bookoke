<?php  
$baseUrl = Yii::app()->request->baseUrl; 
?>

<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'View-Frm-CsTarget',
        'enableClientValidation'=>false,
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array(   'onsubmit'=>"return false;",
                                'enctype' => 'multipart/form-data',
        ),
    ));
?>
    
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
    
    <?php if($model->id){ $action = 'Update'; ?>
        <div style="color:#5C2B95;margin-bottom: 10px;">
            <span style="padding: 5px 10px;font-size: 17px; display: block;">Edit Target</span>
            <span style="position: absolute;top: 7px;right: 10px;">
                <?php echo CHtml::submitButton('Save',array('class'=>'button_izi'));?> 
            </span>
        </div> 
    <?}else{ $action = 'Create'; ?>
        <div style="color:#5C2B95;margin-bottom: 10px;">
            <span style="padding: 5px 10px;font-size: 17px; display: block;">Create Target</span>
            <span style="position: absolute;top: 7px;right: 10px;">
                <?php echo CHtml::submitButton('Add',array('class'=>'button_izi')); ?> 
            </span>
        </div>
    <?php } ?>
    
    <div class="box_form">
    <?php echo $form->errorSummary($model,'<button type="button" class="close" data-dismiss="alert">&times;</button>','',array('class'=>'alert alert-block')); ?>
        <div style="float: left; width: 45%;">
            <!-- ID -->
            <div style="display: none;">
                <?php echo $form->textField($model,'id',array('value'=>$model->id)); ?>
            </div>
            <!-- USERS -->
            <div class="new_product_row">
                <span class="account_label"><span style="color: red;">*</span>Users:</span>
                <span>
                    <?php 
        				$User = User::model()->findAllByAttributes(array('block'=>0,'group_id'=>3));
        				$listdata = array();
        				$listdata[''] = "Select User";
        				foreach($User as $temp){
        					$listdata[$temp['id']] = $temp['name'];
        				}
                        if($model->id){
                            echo $form->dropDownList($model,'user_id', $listdata,array("disabled"=>"disabled",'required'=>'required','style'=>'width: 205px; height: 30px;','options'=>array($model->user_id=>array('selected'=>true))));
                        }else{
                            echo $form->dropDownList($model,'user_id', $listdata,array('required'=>'required','style'=>'width: 205px; height: 30px;','options'=>array($model->user_id=>array('selected'=>true))));
                        }
        				
                    ?>
                </span>
            </div>
            <!-- Month -->
            <div class="new_product_row">
                <span class="account_label"><span style="color: red;">*</span>Month:</span>
                <span>
                    <span class="error_message"><?php echo $form->error($model,'month',array('class'=>'alert fade in')); ?></span>
                    <?php 
                        echo $form->dropDownList($model,'month',$list_month,array('required'=>'required','style'=>'width: 205px; height: 30px;','options'=>array($model->month=>array('selected'=>true))));
                    ?>
                </span>
            </div>
            <!-- Year -->
            <div class="new_product_row" style="display: none;">
                <span class="account_label"><span style="color: red;">*</span>Year:</span>
                <span>
                    <?php echo $form->textField($model,'year',array('value'=>date('Y'),'required'=>'required','pattern'=>'[0-9]+')); ?>
                    <span class="error_message"><?php echo $form->error($model,'year',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Revenue -->
            <div class="new_product_row">
                <span class="account_label"><span style="color: red;">*</span>Revenue:</span>
                <span>
                    <?php echo $form->textField($model,'revenue_target',array('value'=>$model->revenue_target,'required'=>'required','pattern'=>'[0-9]+')); ?>
                    <span class="error_message"><?php echo $form->error($model,'revenue_target',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            
        </div>
        <div style="float: left;width: 50%;">
            <!-- New Account Target -->
            <div class="new_product_row">
                <span class="account_label"><span style="color: red;">*</span>New Account:</span>
                <span>
                    <?php echo $form->textField($model,'new_account_target',array('value'=>$model->new_account_target,'required'=>'required','pattern'=>'[0-9]+')); ?>
                    <span class="error_message"><?php echo $form->error($model,'new_account_target',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Calls -->
            <div class="new_product_row">
                <span class="account_label"><span style="color: red;">*</span>Calls:</span>
                <span>
                    <?php echo $form->textField($model,'call_target',array('value'=>$model->call_target,'required'=>'required','pattern'=>'[0-9]+')); ?>
                    <span class="error_message"><?php echo $form->error($model,'call_target',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
            <!-- Orders  -->
            <div class="new_product_row">
                <span class="account_label">Orders:</span>
                <span>
                    <?php echo $form->textField($model,'order_target',array('value'=>$model->order_target)); ?>
                    <span class="error_message"><?php echo $form->error($model,'order_target',array('class'=>'alert fade in')); ?></span>
                </span>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- Description  -->
        <div class="new_product_row">
            <span class="account_label">Description:</span>
            <span>
                <?php echo $form->textArea($model,'description',array('value'=>$model->description,'style'=>'width:620px')); ?>
                <span class="error_message"><?php echo $form->error($model,'description',array('class'=>'alert fade in')); ?></span>
            </span>
        </div>

        <div class="clearfix"></div>
    </div>
<?php $this->endWidget(); ?>
<!-- BG POPUP -->

<script>
$(document).ready(function(){
    
    $('#View-Frm-CsTarget').submit(function(e) {
		//Prevent the default action, which in this case is the form submission.
		e.preventDefault();
		//Serialize the form data and store to a variable.
		var formData = new FormData($("#View-Frm-CsTarget")[0]);
        if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({ type:"POST",
                            url:"<?php echo CController::createUrl('CsTarget/'.$action.'')?>",
                            data:formData,
                            datatype:'json',
                            beforeSend: function() {
                                $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                            },
                            success:function(data){
        						if(data!='-1' || data != ""){
        							jQuery("#main_content").html(data);
                                    
        						}
                                jQuery("#idwaiting_main").html('');
                            },
                            error: function(data) { 
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
});
</script>