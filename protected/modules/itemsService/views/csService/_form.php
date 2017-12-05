<?php 
    $baseUrl = Yii::app()->getBaseUrl();
    $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'service-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(  
        'enctype' => 'multipart/form-data',
),
)); ?>

<div id="box_title_content" class="row clearfix" >
        <label class="col-xs-8 col-sm-9 col-md-9">
              <?php if($model->isNewRecord == 1){ ?>
                <h3>Create Service</h3>
            <?php }else{ ?>
            <h3>Update Service <?php echo $model->id; ?></h3>
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
<p class="help-block">Fields with <span class="required">*</span> are required.</p>
    
    <?php echo $form->dropDownListGroup($model,'id_service_type',array('widgetOptions'=>array('data'=>CHtml::listData(ServiceType::model()->findAll(),'id', 'name'),'htmlOptions'=>array('empty'=>'--Choose Service--','required'=>'required')))); ?>

	<?php echo $form->textFieldGroup($model,'name',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>255)))); ?>

	<?php //echo $form->textFieldGroup($model,'image',array('accept'=>'image/*')); ?>
    <input type="file" name="service_images" id="service_images" ><br>
    
    <?php
	if(isset($model->image)!="")
	{?>
    <img style="width:10%" id="imgUpload" src="<?php echo $baseUrl.'/upload/service/'.$model->image?>" ><br><br>
	<?php }else{?>
    <img style="width:10%" id="imgUpload" src="<?php echo $baseUrl.'/upload/service/no_image.png'?>" ><br><br>
	<?php }?>

	<?php echo $form->textFieldGroup($model,'description',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>500)))); ?>

	<?php //echo $form->textAreaGroup($model,'content', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>3, 'cols'=>50)))); ?>

	<?php echo $form->ckEditorGroup($model,'content', array('widgetOptions'=>array('editorOptions' => array(
						'fullpage' => 'js:true',
						/* 'width' => '640', */
						/* 'resize_maxWidth' => '640', */
						/* 'resize_minWidth' => '320'*/
					),'htmlOptions'=>array('rows'=>3, 'cols'=>50)))); ?>

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
    <?php echo $form->textFieldGroup($model,'code',array('widgetOptions'=>array('htmlOptions'=>array())));?>

<?php $this->endWidget(); ?>

<br>
<script>
$("h1").html('');
$('#service_images').on('change', function(evt) {
    var tgt = evt.target || window.event.srcElement,
        files = tgt.files;

    // FileReader support
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
            document.getElementById('imgUpload').src = fr.result;
        }
        fr.readAsDataURL(files[0]);
    }
});
</script>