<?php $baseUrl = Yii::app()->getBaseUrl(); ?>
<div class="col-md-12" id="bk_register_info">
		<h4 class="pl30">THÔNG TIN CỦA BẠN</h4>
		<div id="Cus_info">
			<div class="form-group" id="remain_login" style="text-align: left;">
				<p style="padding-left: 50px">Tôi đã có tài khoản <a href="#" class="btn btn_green" data-toggle="modal" data-target="#login-customer-modal">Đăng nhập</a> / Chưa có tài khoản, vui lòng nhập thông tin</p>
			</div>
	
	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id'=>'Register-Book-Customer',
		'action' => Yii::app()->createUrl('book/create_cus'),
		'enableAjaxValidation'=>false,
		'type' => 'horizontal',
		'htmlOptions'=>array(  
			'enctype' => 'multipart/form-data',
		),
		'clientOptions' => array(
            'validateOnSubmit'=>true,
            'validateOnChange'=>true,
            'validateOnType'=>true,
        ),
	)); ?>
			
		<?php 
			// họ tên
			echo $form->textFieldGroup($model,'fullname',array('wrapperHtmlOptions' => array('class' => 'col-md-5'),'widgetOptions'=>array('htmlOptions'=>array('maxlength'=>255,'required'=>'required','placeholder'=>'')),'labelOptions' => array("label" => 'Họ tên', 'class'=>'col-md-4'))); 

			// giới tính
			$defaultGender = "VN";
			if($model->gender){
				$defaultGender = $model->gender;
			}
			echo $form->dropDownListGroup($model,'gender',array('wrapperHtmlOptions' => array('class' => 'col-md-3'),'widgetOptions'=>array('data'=>array('0'=>'Nam','1'=>'Nữ'),'htmlOptions'=>array('options'=>array($defaultGender=>array('selected'=>'selected')))),'labelOptions' => array("label" => 'Giới tính','class'=>'col-md-4')));

			// ngày tháng năm sinh
			echo $form->datePickerGroup($model,'birthdate',array('wrapperHtmlOptions' => array('class' => 'col-md-3'),'widgetOptions'=>array('htmlOptions'=>array('maxlength'=>128,'placeholder'=>'')),'labelOptions' => array("label" => 'Ngày tháng năm sinh', 'class'=>'col-md-4')));

			// email
			echo $form->textFieldGroup($model,'email',array('wrapperHtmlOptions' => array('class' => 'col-md-5'),'widgetOptions'=>array('htmlOptions'=>array('maxlength'=>128,'placeholder'=>'')),'labelOptions' => array("label" => 'Email', 'class'=>'col-md-4')));

			// địa chỉ
			echo $form->textFieldGroup($model,'address',array('wrapperHtmlOptions' => array('class' => 'col-md-5'),'widgetOptions'=>array('htmlOptions'=>array('maxlength'=>255,'placeholder'=>'')),'labelOptions' => array("label" => 'Địa chỉ', 'class'=>'col-md-4')));

			echo '<div class="line_dot col-md-8 pull-right" style="margin-bottom: 15px;"></div>';
			echo '<div class="clearfix"></div>';

			// số điện thoại
			echo $form->textFieldGroup($model,'phone',array('wrapperHtmlOptions' => array('class' => 'col-md-4'),'widgetOptions'=>array('htmlOptions'=>array('required'=>'required','placeholder'=>'')),'labelOptions' => array("label" => 'Số điện thoại', 'class'=>'col-md-4')));

			// nhập mật khẩu
			
			echo $form->passwordFieldGroup($model,'password',array('wrapperHtmlOptions' => array('class' => 'col-md-4'),'widgetOptions'=>array('htmlOptions'=>array('maxlength'=>128,'required'=>'required','placeholder'=>'')),'labelOptions' => array("label" => 'Mật khẩu', 'class'=>'col-md-4')));

			// nhập lại mật khẩu
			echo $form->passwordFieldGroup($model,'repeatpassword',array('wrapperHtmlOptions' => array('class' => 'col-md-4'),'widgetOptions'=>array('htmlOptions'=>array('maxlength'=>128,'required'=>'required','placeholder'=>'')),'labelOptions' => array("label" => 'Nhập lại mật khẩu', 'class'=>'col-md-4')));
			
		?>
				
			<div class="col-md-4" id="bk_res_log_info">
				Nhập số điện thoại và mật khẩu để tạo tài khoản, thông tin của bạn sẽ được lưu trữ lại
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12" id="bk_rule">
				<div class="checkbox">
					<label class="labelFrmDkRule"><input required="required" type="checkbox" id="check_ale" name="Customer[check_ale]" value="1"> <span>Tôi đồng ý với tất cả </span><span class="DkRegister">Điều khoản dịch vụ</span></label>
				</div>
			</div>
		</div> <!-- end Custormer_info -->
	</div>
	<div class="col-md-12" style="margin: 15px">
		<!-- <a href="<?php echo $baseUrl; ?>/index.php/book/verify_schedule" class="btn btn_blue pull-right">TIẾP TỤC</a> -->
		<button type="submit" class="btn btn_blue pull-right">TIẾP TỤC</button>
	</div>
	<?php $this->endWidget();  ?>

</div>