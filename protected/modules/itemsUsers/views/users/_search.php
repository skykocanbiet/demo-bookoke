<?php

$form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
    'type' =>'horizontal',
	'method'=>'get',
)); ?>
        <!-- BOX TITLE -->
        <div id="box_title_content" class="clearfix">
            <label class="col-xs-12 col-sm-6 col-md-9"><h3>Users Manager</h3></label>
            <div class="col-xs-12 col-sm-6 col-md-3 form-actions text-right">
                <?php

                $this->widget('booster.widgets.TbButton', array(
        			'buttonType' => 'submit',
        			'context'=>'success',
        			'label'=>'Apply filter',
                    'htmlOptions'=>array('class'=>'margin-top-10'),
        		)); ?>
                <?php echo CHtml::link('Create',array('Users/create'),array('class'=>'margin-top-10 btn btn-success')); ?>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 clearfix">
    		<?php echo $form->textFieldGroup($model,'username',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>128)))); ?>
    
    		<?php echo $form->textFieldGroup($model,'name',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>128)))); ?>
    
            <?php echo $form->textFieldGroup($model,'email',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>128)))); ?>
        </div>
        <div class="col-md-6 col-lg-4 clearfix">
    		<?php  echo $form->dropDownListGroup($model,'group_id',array('widgetOptions'=>array('data'=>CHtml::listData(GpGroup::model()->findAll(),'id', 'group_name'),'htmlOptions'=>array('empty'=>'--Choose Group--')))); ?>
    
    		<?php echo $form->textFieldGroup($model,'createDate',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
    
    		<?php echo $form->textFieldGroup($model,'lastvisitDate',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
    
    		<?php //echo $form->textFieldGroup($model,'block',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
        </div>
<?php $this->endWidget(); ?>
