<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'type' =>'horizontal',
	'method'=>'get',
)); ?>
<div id="box_title_content" class="clearfix">
            <label class="col-xs-12 col-sm-6 col-md-9"><h3>Product Type Manager</h3></label>
            <div class="col-xs-12 col-sm-6 col-md-3 form-actions text-right">
                <?php

                $this->widget('booster.widgets.TbButton', array(
        			'buttonType' => 'submit',
        			'context'=>'success',
        			'label'=>'Apply filter',
                    'htmlOptions'=>array('class'=>'margin-top-10'),
        		)); ?>
                <?php echo CHtml::link('Create',array('ProductType/create'),array('class'=>'margin-top-10 btn btn-success')); ?>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 clearfix">
		<?php echo $form->textFieldGroup($model,'name',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>765)))); ?>
		<!-- <?php //echo $form->textFieldGroup($model,'status_protype',array('widgetOptions'=>array('htmlOptions'=>array()))); ?> -->
        <?php echo $form->switchGroup($model, 'status_protype',
        array(
            'widgetOptions' => array(
                'events'=>array(
                    'switchChange'=>'js:function(event, state) {
                      console.log(this); // DOM element
                      console.log(event); // jQuery event
                      console.log(state); // true | false
                    }'
                )
            )
        )
    ); ?>
		<!-- <?php ///echo $form->textFieldGroup($model,'status_hiden',array('widgetOptions'=>array('htmlOptions'=>array()))); ?> -->
        <?php echo $form->switchGroup($model, 'status_hiden',
        array(
            'widgetOptions' => array(
                'events'=>array(
                    'switchChange'=>'js:function(event, state) {
                      console.log(this); // DOM element
                      console.log(event); // jQuery event
                      console.log(state); // true | false
                    }'
                )
            )
        )
    ); ?>
		</div>
<?php $this->endWidget(); ?>
