<?php 
$form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'question-quick-form',
	'enableAjaxValidation'=>false,
)); ?>

<div id="box_title_content" class="row clearfix" >
        <label class="col-xs-8 col-sm-9 col-md-9">
            <?php if($model->isNewRecord == 1){ ?>
                <h3>Create Question Quick</h3>
            <?php }else{ ?>
            <h3>Update Question Quick <?php echo $model->id; ?></h3>
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

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'title',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>500)))); ?>

	<?php //echo $form->textFieldGroup($model,'status',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
     <?php echo $form->switchGroup($model, 'status',
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


<?php $this->endWidget(); ?>
<script>
$('h1').html('');

</script>