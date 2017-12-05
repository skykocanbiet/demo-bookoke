<script> 
$( document ).ready(function() {
	if(!$("input[name='Customer[gender]']:checked").val())
	{		
      $('#Customer_gender_0').prop('checked',true);
	}
});  

</script>
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'customer-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(  
		'enctype' => 'multipart/form-data',
),
)); ?>
<input type="hidden" id="baseUrl" value="<?php echo Yii::app()->baseUrl?>"/>
<div id="box_title_content" class="row clearfix" >
		<label class="col-xs-8 col-sm-9 col-md-9">
			<?php if($model->isNewRecord == 1){ ?>
				<h3>Create Patient</h3>
			<?php }else{ ?>
			<h1>Update Patient <?php echo $model->id; ?></h1>
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

	<?php echo $form->textFieldGroup($model,'code_number',array('widgetOptions'=>array('htmlOptions'=>array('required'=>'required')))); ?>


	<?php echo $form->labelEx($model,'image'); ?>
    <?php echo CHtml::activeFileField($model, 'image'); ?>
    <?php echo $form->error($model,'image'); ?>
    <?php
    if(empty($model->image))
    {
     echo CHtml::image(Yii::app()->request->baseUrl.'/upload/customer/no_image.png',"image",array("width"=>200,'id' =>'imgUpload'));
     }else
     {
        echo CHtml::image(Yii::app()->request->baseUrl.'/upload/customer/'.$model->image,"image",array("width"=>200,'id' =>'imgUpload'));
     } 
     ?> 



	<?php echo $form->textFieldGroup($model,'fullname',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>255,'required'=>'required')))); ?>	

	<?php echo $form->textFieldGroup($model,'address',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>255,'required'=>'required')))); ?>

	<?php echo $form->textFieldGroup($model,'phone',array('widgetOptions'=>array('htmlOptions'=>array('required'=>'required')))); ?>

	<?php echo $form->textFieldGroup($model,'email',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>255,'required'=>'required')))); ?>

	<?php 
	$defaultCountry = "VN";
	if($model->id_country){
		$defaultCountry = $model->id_country;
	}
	echo $form->dropDownListGroup($model,'id_country',array('widgetOptions'=>array('data'=>CHtml::listData(CsCountry::model()->findAll("flag=1"),'code', 'country'),'htmlOptions'=>array('onChange' =>'javascript:getlistcity(this.value)','required'=>'required', 'options'=>array($defaultCountry=>array('selected'=>'selected')) )))); ?>
	<div id="listcity">
	<?php 
	$defaultCity = "id_country='VN'";
	if($model->id_city){
		$defaultCity = "";
	}
	echo $form->dropDownListGroup($model,'id_city',array('widgetOptions'=>array('data'=>CHtml::listData(CsCity::model()->findAll($defaultCity),'id', 'name_long'),'htmlOptions'=>array('required'=>'required')))); ?>
	</div>
	<div id="liststate">
	<?php 
	$defaultState = "id_country='VN'";
	if($model->id_state){
		$defaultState = "";
	}
	echo $form->dropDownListGroup($model,'id_state',array('widgetOptions'=>array('data'=>CHtml::listData(CsState::model()->findAll($defaultState),'id', 'name_long'),'htmlOptions'=>array('empty'=>'--Choose State--')))); ?>
	</div>
	<?php echo $form->textFieldGroup($model,'zipcode',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>16,'required'=>'required')))); ?>
	
	<?php echo $form->labelEx($model,'gender')."<br>"; echo $form->radioButtonList($model, 'gender', array('1'=>'Male', '2'=>'Female'),array('separator'=>' ','separator'=>' ','labelOptions'=>array('style'=>'display:inline')))."<br><br>"; ?>
	
	<?php echo $form->textFieldGroup($model,'birthdate',array('widgetOptions'=>array('htmlOptions'=>array()))); 
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
									'name'=>'Customer_birthdate',
									// additional javascript options for the date picker plugin
									'options'=>array(
									'showAnim'=>'fold',
									'dateFormat' => 'yy-mm-dd',
									),
									'htmlOptions'=>array(
									'style'=>'display:none',
									'class'=>'form-control col-md-6'
									),
									)); 
	?>

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

<script>

	function getlistcity(code)
    {
    	       
    	var baseUrl = $('#baseUrl').val();
    
        $.ajax({
            type:'POST',
            url: baseUrl+'/index.php/itemsLocation/CsCity/listcityofcountry',          
            data:{"code": code },
            success:function(data){           	
            	
            	$('#listcity').html(data);
            	getliststate(code);
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }

    function getliststate(code)
    {

    	var baseUrl = $('#baseUrl').val();
    
        $.ajax({
            type:'POST',
            url: baseUrl+'/index.php/itemsLocation/CsState/liststateofcountry',          
            data:{"code": code },
            success:function(data){           	
            	
            	$('#liststate').html(data);

            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }


    
	$('#Customer_image').on('change', function(evt) {
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
<?php $this->endWidget(); ?>
