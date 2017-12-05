<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'type' =>'horizontal',
	'method'=>'get',
)); ?>
	
        
        <div class="row" style="padding-top: 10px;padding-bottom: 15px;border-bottom: 1px solid rgba(141, 138, 138, 0.44);">
	        <div class="col-md-2">
			

			<?php echo $form->textField($model,'code_number',array('placeholder'=>'Code Number','class'=>'form-control')); ?>

			</div>

			<div class="col-md-2">

			<?php echo $form->textField($model,'fullname',array('placeholder'=>'Fullname','class'=>'form-control')); ?>

			</div>
			
			
			
			<div class="col-md-2">
			
			<?php echo $form->textField($model,'phone',array('placeholder'=>'Phone','class'=>'form-control')); ?>

			</div>

			<div class="col-md-2">

			<?php echo $form->textField($model,'createdate',array('placeholder'=>'Createdate','class'=>'form-control')); 
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

			<div class="col-md-4 form-actions text-right">
                <?php

                $this->widget('booster.widgets.TbButton', array(
        			'buttonType' => 'submit',
        			'context'=>'success',
        			'label'=>'Apply filter',
                    'htmlOptions'=>array(),
        		)); ?>
                <?php echo CHtml::link('Create',array('Accounts/create'),array('class'=>'btn btn-success')); ?>
            </div>
		</div>
		
		<div class="clearfix"></div>

<?php $this->endWidget(); ?>
