<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
    'id'=>'product-image-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(  
        'enctype' => 'multipart/form-data'
        ),
)); ?>
<div id="box_title_content" class="row clearfix" >
        <label class="col-xs-8 col-sm-9 col-md-9">
            <?php if($model->isNewRecord == 1){ ?>
                <h3>Create Product Image</h3>
            <?php }else{ ?>
            <h3>Update Product Image <?php echo $model->id; ?></h3>
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

    <?php echo $form->dropDownListGroup($model,'id_product',array('widgetOptions'=>array('data'=>CHtml::listData(Product::model()->findAll(),'id', 'name'),'htmlOptions'=>array('empty'=>'--Choose Country--','required'=>'required')))); ?>

    <?php echo $form->textFieldGroup($model,'name',array('widgetOptions'=>array('htmlOptions'=>array('disabled' => true,'maxlength'=>765)))); ?>

    <!-- <?php //echo $form->textFieldGroup($model,'url_action',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>150)))); ?> -->
    <?php echo $form->labelEx($model,'name_upload'); ?>
    <?php echo CHtml::activeFileField($model, 'name_upload'); ?>
    <?php echo $form->error($model,'name_upload'); ?>
    <?php
    if(empty($model->name_upload))
    {
     echo CHtml::image(Yii::app()->request->baseUrl.'/upload/product_image/no_image.png',"image",array("width"=>200,'id' =>'imgUpload'));
     }else
     {
        echo CHtml::image(Yii::app()->request->baseUrl.'/upload/product_image/lg/'.$model->name_upload,"image",array("width"=>200,'id' =>'imgUpload'));
     } 
     ?>
    <?php echo $form->textFieldGroup($model,'url_action',array('widgetOptions'=>array('htmlOptions'=>array('value' =>'product_image','maxlength'=>300)))); ?>

    <?php echo $form->textFieldGroup($model,'update_time',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
    <input type="text" style='display:none' class="form-control col-md-6" id="ProductImage_update_time" name="ProductImage_update_time" />
    <?php echo $form->textFieldGroup($model,'kind',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>

    <?php echo $form->textFieldGroup($model,'size',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>

    <!-- <?php //echo $form->textFieldGroup($model,'status',array('widgetOptions'=>array('htmlOptions'=>array()))); ?> -->
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
$("#ProductImage_update_time").datepicker({dateFormat: 'yy-mm-dd',showAnim:'fold', });
$('#ProductImage_name_upload').on('change', function(evt) {
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
// img
// $('#img').change(function(){
//  alert($('#img').var());
// });

</script>