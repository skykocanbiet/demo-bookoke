<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'type' =>'horizontal',
	'method'=>'get',
)); ?>
	<!-- BOX TITLE -->
        <div id="box_title_content" class="clearfix">
            <label class="col-xs-12 col-sm-6 col-md-9"><h3>Patients Manager</h3></label>
            <div class="col-xs-12 col-sm-6 col-md-3 form-actions text-right">
                <?php

                $this->widget('booster.widgets.TbButton', array(
        			'buttonType' => 'submit',
        			'context'=>'success',
        			'label'=>'Apply filter',
                    'htmlOptions'=>array('class'=>'margin-top-10'),
        		)); ?>
                <?php echo CHtml::link('Create',array('Customer/create'),array('class'=>'margin-top-10 btn btn-success')); ?>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 clearfix">
		

		<?php echo $form->textFieldGroup($model,'code_number',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>

		<?php echo $form->textFieldGroup($model,'fullname',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>255)))); ?>

		
		
		</div>

		<div class="col-md-6 col-lg-4 clearfix">

		
		<?php echo $form->textFieldGroup($model,'phone',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
		

		<?php echo $form->textFieldGroup($model,'createdate',array('widgetOptions'=>array('htmlOptions'=>array()))); 
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
									'name'=>'Customer_createdate',
									// additional javascript options for the date picker plugin
									'options'=>array(

									'showAnim'=>'fold',
									'changeMonth'=>true,
									'changeYear'=>true,
									'dateFormat' => 'yy-mm-dd',
									),
									'htmlOptions'=>array(
									'style'=>'display:none',
									'class'=>'form-control col-md-6'
									),
									)); 
		?>
			
		</div>
		<div class="clearfix"></div>

<?php $this->endWidget(); ?>
