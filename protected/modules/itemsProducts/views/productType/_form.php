<?php 
	$baseUrl = Yii::app()->getBaseUrl();
	$form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'product-type-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(  
        'enctype' => 'multipart/form-data'
		),
)); ?>
<div id="box_title_content" class="row clearfix" >
        <label class="col-xs-8 col-sm-9 col-md-9">
            <?php if($model->isNewRecord == 1){ ?>
                <h3>Create Product Type</h3>
            <?php }else{ ?>
            <h3>Update Product Type <?php echo $model->id; ?></h3>
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

	

	<?php //echo $form->textFieldGroup($model,'image',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>765)))); ?>
	<?php echo $form->labelEx($model,'image'); ?>
    <?php echo CHtml::activeFileField($model, 'image'); ?>
    <?php echo $form->error($model,'image'); ?>
    <?php
    if(empty($model->image))
    {
     echo CHtml::image(Yii::app()->request->baseUrl.'/upload/product_type/no_image.png',"image",array("width"=>200,'id' =>'imgUpload'));
     }else
     {
        echo CHtml::image(Yii::app()->request->baseUrl.'/upload/product_type/'.$model->image,"image",array("width"=>200,'id' =>'imgUpload'));
     } 
     ?> 
	<!-- <input type="file" name="img" id="ProductType_images" /><br>
	<?php
	if(isset($model->image)!="")
	{?>
    <img style="width:10%" id="imgUpload" src="<?php echo $baseUrl.'/upload/product_type/'.$model->image?>" ><br><br>
	<?php }else{?>
    <img style="width:10%" id="imgUpload" src="<?php echo $baseUrl.'/upload/product_type/no_image.png'?>" ><br><br>
	<?php }?> -->
    <?php echo $form->textFieldGroup($model,'name',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>765)))); ?>
	<?php echo $form->textAreaGroup($model,'description', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50)))); ?>

	<!-- <?php echo $form->textFieldGroup($model,'status_protype',array('widgetOptions'=>array('htmlOptions'=>array()))); ?> -->
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
	<?php //echo $form->textFieldGroup($model,'status_hiden',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
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


<?php $this->endWidget(); ?>
<script>
$('h1').html('');
// $("#News_postdate").datepicker({dateFormat: 'yy-mm-dd',showAnim:'fold', });
$('#ProductType_image').on('change', function(evt) {
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
img
$('#img').change(function(){
	alert($('#img').var());
});

</script>
