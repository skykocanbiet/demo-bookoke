<?php 
     $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'type' =>'horizontal',
	'method'=>'get',
)); ?>
      <!-- BOX TITLE -->
        <div id="box_title_content" class="clearfix">
            <label class="col-xs-12 col-sm-6 col-md-9"><h3>Service Manager</h3></label>
            <div class="col-xs-12 col-sm-6 col-md-3 form-actions text-right">
                <?php

                $this->widget('booster.widgets.TbButton', array(
        			'buttonType' => 'submit',
        			'context'=>'success',
        			'label'=>'Apply filter',
                    'htmlOptions'=>array('class'=>'margin-top-10'),
        		)); ?>
                <?php echo CHtml::link('Create',array('CsService/create'),array('class'=>'margin-top-10 btn btn-success')); ?>
            </div>
        </div>
        <div class="col-md-6 col-lg-5 clearfix">
        <?php  echo $form->dropDownListGroup($model,'id_service_type',array('widgetOptions'=>array('data'=>CHtml::listData(ServiceType::model()->findAll(),'id', 'name'),'htmlOptions'=>array('empty'=>'--Choose Service--')))); ?>
		

		<?php echo $form->textFieldGroup($model,'name',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>255)))); ?>
        
		<input type="text" style='display:none' class="form-control col-md-6" id="Service_createdate" name="Service_createdate" />
        </div>

<?php $this->endWidget(); ?>

<script>
$("#Service_createdate").datepicker({dateFormat: 'yy-mm-dd',showAnim:'fold', });

</script>
