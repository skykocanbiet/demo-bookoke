<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'cs-state-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(  
        'enctype' => 'multipart/form-data',),
)); ?>
<div id="box_title_content" class="row clearfix" >
        <label class="col-xs-8 col-sm-9 col-md-9">
            <?php if($model->isNewRecord == 1){ ?>
                <h3>Create State</h3>
            <?php }else{ ?>
            <h3>Update State<?php echo $model->id; ?></h3>
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

	<?php echo $form->textFieldGroup($model,'id_country',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>6)))); ?>

	<?php echo $form->textFieldGroup($model,'name_long',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>300)))); ?>

	<?php echo $form->textFieldGroup($model,'name_short',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>33)))); ?>

	<?php echo $form->textFieldGroup($model,'prefix_num',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>


<?php $this->endWidget(); ?>
