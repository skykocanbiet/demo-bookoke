<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'group-ccp-form',
	'enableAjaxValidation'=>true,
    'htmlOptions'=>array(  
        'enctype' => 'multipart/form-data',
    ),
)); ?>
    <div id="box_title_content" class="row clearfix" >
        <label class="col-xs-8 col-sm-9 col-md-9">
            <?php if($model->isNewRecord == 1){ ?>
                <h3>Create UsersCcp</h3>
            <?php }else{ ?>
            <h1>Update UsersCcp <?php echo $model->id; ?></h1>
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

	<?php echo $form->textFieldGroup($model,'group_no',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>45,'required'=>'required')))); ?>

	<?php echo $form->textFieldGroup($model,'group_name',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>45,'required'=>'required','class'=>'text-capitalize')))); ?>

<?php $this->endWidget(); ?>
