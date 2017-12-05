<?php /** @var TbActiveForm $form */
	$form = $this->beginWidget('booster.widgets.TbActiveForm',array(
	        'id' 					=> 	'frm-update-sch',
	        'type' 					=> 	'horizontal',
	        'action'				=>	CController::createUrl('calendar/schCus')
	        'enableAjaxValidation'	=>	true,
	        'clientOptions' 		=> array(
	            'validateOnSubmit'		=>	true,
	            'validateOnChange'		=>	true,
	            'validateOnType'		=>	true,
	        ),
	        'htmlOptions'			=>	array(  
	            'enctype'   			=> 	'multipart/form-data'                        
	        ),
	    )
); ?>

<?php 
	$img 	=	'<img src="'.$baseUrl.'/upload/customer/no_avatar.png" id="img_cus" />';
	echo $form->textFieldGroup($cus, "fullname",array(
		'wrapperHtmlOptions' => array('class' => 'col-xs-6',),
		'widgetOptions'=>array(
			'htmlOptions'=>array('required'=>false,'placeholder'=>'Họ và tên', 'class'=>'ckError read', 'readonly'=>true)),
			'labelOptions' => array("label" => $img,'class' => 'col-xs-5')
	));

	echo $form->hiddenField($cus,'id',array('class'=>''));

	echo $form->textFieldGroup($cus, "phone",array(
		'wrapperHtmlOptions' => array('class' => 'col-xs-6',),
		'widgetOptions'=>array(
			'htmlOptions'=>array('required'=>'','placeholder'=>'Số điện thoại', 'class'=>'ckError read', 'readonly'=>true)),
			'labelOptions' => array("label" => 'Số điện thoại','class' => 'col-xs-5')
	));

	echo $form->textFieldGroup($cus, "email",array(
		'wrapperHtmlOptions' => array('class' => 'col-xs-6',),
		'widgetOptions'=>array(
			'htmlOptions'=>array('required'=>'','placeholder'=>'Email', 'class'=>'read', 'readonly'=>true)),
			'labelOptions' => array("label" => 'Email','class' => 'col-xs-5')
	));


	echo $form->dropDownListGroup($cus, "gender",array(
		'wrapperHtmlOptions' => array('class' => 'col-xs-6',),
		'widgetOptions'=>array(
			'data'		=>	array('1'=>'Nữ', '0'=>'Nam'),
			'htmlOptions'=>array('required'=>'','placeholder'=>'', 'class'=>'read', 'readonly'=>true)),
			'labelOptions' => array("label" => 'Giới tính','class' => 'col-xs-5')
	)); 

	echo $form->textFieldGroup($cus, "birthdate",array(
		'wrapperHtmlOptions' => array('class' => 'col-xs-6',),
		'widgetOptions'=>array(
			'htmlOptions'=>array('required'=>'','placeholder'=>'Ngày sinh', 'class'=>'read', 'readonly'=>true)),
			'labelOptions' => array("label" => 'Ngày sinh','class' => 'col-xs-5')
	));

	echo $form->textFieldGroup($cus, "identity_card_number",array(
		'wrapperHtmlOptions' => array('class' => 'col-xs-6',),
		'widgetOptions'=>array(
			'htmlOptions'=>array('required'=>'','placeholder'=>'CMND', 'class'=>'read', 'readonly'=>true)),
			'labelOptions' => array("label" => 'CMND','class' => 'col-xs-5')
	));

	echo $form->textFieldGroup($cus, "id_country",array(
		'wrapperHtmlOptions' => array('class' => 'col-xs-6',),
		'widgetOptions'=>array(
			'htmlOptions'=>array('required'=>'','placeholder'=>'Quốc tịch', 'class'=>'read', 'readonly'=>true)),
			'labelOptions' => array("label" => 'Quốc tịch','class' => 'col-xs-5')
	));
?>
	<div class="form-group">
	  	<div class="col-xs-11 btn_cus">
			<button type="submit" class="btn btn_book pull-right col-xs-4 sch_up" id="step-2" style="color: white;">Cập nhật</button>
	  	</div>  
	</div>
<?php 
	$this->endWidget();
	unset($form);
?>