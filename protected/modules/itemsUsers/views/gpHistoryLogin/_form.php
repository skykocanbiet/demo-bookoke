<?php 
    $baseUrl = Yii::app()->getBaseUrl();
    $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'gp-history-login-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(  
        'enctype' => 'multipart/form-data',
),        
)); ?>

<div id="box_title_content" class="row clearfix" >
        <label class="col-xs-8 col-sm-9 col-md-9">
            <?php if($model->isNewRecord == 1){ ?>
                <h3>Create History Login</h3>
            <?php }else{ ?>
            <h1>Update History Login <?php echo $model->id; ?></h1>
            <?php } ?>     
        </label>  
        <div class="col-xs-4 col-sm-3 col-md-3 form-actions text-right margin-top-10">  
            <?php 
                $this->widget(
                    'booster.widgets.TbButton',
                    array(
                        'context' => 'success',
                        'label' => $model->isNewRecord ? 'Add' : 'Save',
                        'buttonType' => 'submit',
            
                    )
                );
            ?>
        </div>
    </div>
    

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'username',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>135,'required'=>'required')))); ?>

	<?php echo $form->passwordFieldGroup($model,'password',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>135,'required'=>'required')))); ?>    

	<?php echo $form->textFieldGroup($model,'ip',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>135,'required'=>'required')))); ?>

	<?php echo $form->textFieldGroup($model,'login_time',array('widgetOptions'=>array('htmlOptions'=>array('required'=>'required')))); 
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'name'=>'GpHistoryLogin_login_time',
                                    // additional javascript options for the date picker plugin
                                    'options'=>array(
                                    'showAnim'=>'fold',
                                    'dateFormat' => 'yy-mm-dd',
                                    ),
                                    'htmlOptions'=>array(
                                    'style'=>'display:none',
                                    'class'=>'form-control col-md-6'
                                    ),
                                    ));
    ?>

	<?php echo $form->textFieldGroup($model,'logout_time',array('widgetOptions'=>array('htmlOptions'=>array('required'=>'required')))); 
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'name'=>'GpHistoryLogin_logout_time',
                                    // additional javascript options for the date picker plugin
                                    'options'=>array(
                                    'showAnim'=>'fold',
                                    'dateFormat' => 'yy-mm-dd',
                                    ),
                                    'htmlOptions'=>array(
                                    'style'=>'display:none',
                                    'class'=>'form-control col-md-6'
                                    ),
                                    ));
    ?>

	<?php echo $form->textFieldGroup($model,'error_code',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>60,'required'=>'required')))); ?>

	<?php echo $form->textFieldGroup($model,'error_msg',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>300,'required'=>'required')))); ?>



<?php $this->endWidget(); ?>
