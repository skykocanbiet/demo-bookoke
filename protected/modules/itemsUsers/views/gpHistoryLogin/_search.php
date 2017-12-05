<?php 
    $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'type' =>'horizontal',
	'method'=>'get',
)); ?>

	<!-- BOX TITLE -->
        <div id="box_title_content" class="clearfix">
            <label class="col-xs-12 col-sm-6 col-md-9"><h3>History Login Manager</h3></label>
            <div class="col-xs-12 col-sm-6 col-md-3 form-actions text-right">
                <?php

                $this->widget('booster.widgets.TbButton', array(
        			'buttonType' => 'submit',
        			'context'=>'success',
        			'label'=>'Apply filter',
                    'htmlOptions'=>array('class'=>'margin-top-10'),
        		)); ?>               
            </div>
        </div>

        <div class="col-md-6 col-lg-4 clearfix">

		

		<?php echo $form->textFieldGroup($model,'username',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>135)))); ?>

			<?php echo $form->textFieldGroup($model,'ip',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>135)))); ?>

		<?php echo $form->textFieldGroup($model,'login_time',array('widgetOptions'=>array('htmlOptions'=>array())));
        $this->widget('CJuiDateTimePicker', array(
                                    'name'=>'GpHistoryLogin_login_time',
                                    // additional javascript options for the date picker plugin
                                    'options'=>array(
                                    'showAnim'=>'fold',
                                    'dateFormat' => 'yy-mm-dd',
									'timeFormat'=>'HH:mm:ss',
                                    ),
                                    'htmlOptions'=>array(
                                    'style'=>'display:none',
                                    'class'=>'form-control col-md-6'
                                    ),
                                    )); 
        ?>
        </div>
        <div class="col-md-6 col-lg-4 clearfix">
		<?php echo $form->textFieldGroup($model,'logout_time',array('widgetOptions'=>array('htmlOptions'=>array())));
        $this->widget('CJuiDateTimePicker', array(
                                    'name'=>'GpHistoryLogin_logout_time',
                                    // additional javascript options for the date picker plugin
                                    'options'=>array(
                                    'showAnim'=>'fold',
                                    'dateFormat' => 'yy-mm-dd',
									'timeFormat'=>'HH:mm:ss',
                                    ),
                                    'htmlOptions'=>array(
                                    'style'=>'display:none',
                                    'class'=>'form-control col-md-6'
                                    ),
                                    )); 
        ?>

		<?php echo $form->textFieldGroup($model,'error_code',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>60)))); ?>

		<?php echo $form->textFieldGroup($model,'error_msg',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>300)))); ?>

	
	    </div>

<?php $this->endWidget(); ?>
