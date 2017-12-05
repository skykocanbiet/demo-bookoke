<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(  
        'enctype' => 'multipart/form-data'
		),
)); ?>
<script src="<?php echo Yii::app()->baseUrl.'/ckeditor/ckeditor.js'; ?>"></script>
<div id="box_title_content" class="row clearfix" >
        <label class="col-xs-8 col-sm-9 col-md-9">
            <?php if($model->isNewRecord == 1){ ?>
                <h3>Create Product </h3>
            <?php }else{ ?>
            <h3>Update Product <?php echo $model->id; ?></h3>
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

	<?php echo $form->dropDownListGroup($model,'id_product_line',array('widgetOptions'=>array('data'=>CHtml::listData(ProductLine::model()->findAll(),'id', 'name'),'htmlOptions'=>array('empty'=>'--Choose Country--','required'=>'required')))); ?>

	<?php echo $form->textFieldGroup($model,'name',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>765)))); ?>

	<?php //echo $form->textAreaGroup($model,'description', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50)))); ?>
	<?php echo $form->labelEx($model,'description'); ?>
    <?php echo $form->textArea($model, 'description', array('id'=>'editor1')); ?>
    <?php echo $form->error($model,'description'); ?>
 
	<script type="text/javascript">
	     CKEDITOR.replace( 'editor1', {
         filebrowserBrowseUrl: '<?php echo Yii::app()->baseUrl; ?>/kcfinder/browse.php?type=files',
         filebrowserImageBrowseUrl: '<?php echo Yii::app()->baseUrl; ?>/kcfinder/browse.php?type=images',
         filebrowserFlashBrowseUrl: '<?php echo Yii::app()->baseUrl; ?>/kcfinder/browse.php?type=flash',
         filebrowserUploadUrl: '<?php echo Yii::app()->baseUrl; ?>/kcfinder/upload.php?type=files',
         filebrowserImageUploadUrl: '<?php echo Yii::app()->baseUrl; ?>/kcfinder/upload.php?type=images',
         filebrowserFlashUploadUrl: '<?php echo Yii::app()->baseUrl; ?>/kcfinder/upload.php?type=flash'
    });
	</script>

	<?php //echo $form->textAreaGroup($model,'instruction', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50)))); ?>
	<?php echo $form->labelEx($model,'instruction'); ?>
    <?php echo $form->textArea($model, 'instruction', array('id'=>'editor2')); ?>
    <?php echo $form->error($model,'instruction'); ?>
 
	<script type="text/javascript">
	     CKEDITOR.replace( 'editor2', {
         filebrowserBrowseUrl: '<?php echo Yii::app()->baseUrl; ?>/kcfinder/browse.php?type=files',
         filebrowserImageBrowseUrl: '<?php echo Yii::app()->baseUrl; ?>/kcfinder/browse.php?type=images',
         filebrowserFlashBrowseUrl: '<?php echo Yii::app()->baseUrl; ?>/kcfinder/browse.php?type=flash',
         filebrowserUploadUrl: '<?php echo Yii::app()->baseUrl; ?>/kcfinder/upload.php?type=files',
         filebrowserImageUploadUrl: '<?php echo Yii::app()->baseUrl; ?>/kcfinder/upload.php?type=images',
         filebrowserFlashUploadUrl: '<?php echo Yii::app()->baseUrl; ?>/kcfinder/upload.php?type=flash'
    });
	</script>

	<?php echo $form->textFieldGroup($model,'price',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>

	<?php echo $form->textFieldGroup($model,'stock',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>

	<?php echo $form->textFieldGroup($model,'discount',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>

	<?php echo $form->textFieldGroup($model,'unit',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>765)))); ?>

	<?php echo $form->textFieldGroup($model,'postdate',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<input type="text" style='display:none' class="form-control col-md-6" id="Product_postdate" name="Product_postdate" />
	<!-- <?php //echo $form->textFieldGroup($model,'status_product',array('widgetOptions'=>array('htmlOptions'=>array()))); ?> -->
	<?php echo $form->switchGroup($model, 'status_product',
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
	<!-- <?php //echo $form->textFieldGroup($model,'status_hiden',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
 -->
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
$("#Product_postdate").datepicker({dateFormat: 'yy-mm-dd',showAnim:'fold', });
</script>