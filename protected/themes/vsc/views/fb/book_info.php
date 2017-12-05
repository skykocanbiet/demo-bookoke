<style>
#book_choose_info #Book-Customer-Info .form-group {margin-bottom: 6px;}
.panel-group .panel {box-shadow: none;}
.infoHead {font-size: 16px; font-weight: normal; padding: 10px;}
a.infoBtn {text-transform: uppercase; color: #5cb85c; text-decoration: none;}
a.infoBtn:hover {text-decoration: none;}
.iconFb {width: 28px; margin-bottom: 8px;}
.oclick {cursor: pointer;}
</style>

<script>
	<?php if ($customer != ''): ?>
		calVerify();
	<?php endif ?>
</script>

<div id="book_choose_info">
	<div class="panel-group" id="accordion" style="padding-top: 20px;">
		<div class="panel FbLoginInfo">
		    <div class="infoHead">
		      	Đã có tài khoản, <a class="infoBtn" data-toggle="collapse" data-parent="#accordion" href="#fbLogin">Đăng nhập</a> hoặc đăng nhập bằng
		      	<span class="oclick" id="loginAccFb"><img class="iconFb" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_fb/ic_fb.jpg" alt=""></span >
		      	 hoặc 
		      	<span class="oclick" id="loginAccGg"><img class="iconFb" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_fb/ic_gg.jpg" alt=""></span >
		    </div>

		    <script>startApp();</script>

		    <div id="fbLogin" class="panel-collapse collapse">
		      	<div class="panel-body">
		      		<?php $form 	=	$this->beginWidget('booster.widgets.TbActiveForm',array(
						'id'					=>	'Book-Login-Info',
						'enableAjaxValidation'	=>	false,
						'type' 					=> 	'horizontal',
						'htmlOptions'			=>	array(  
							'enctype' => 'multipart/form-data',
						),
						'clientOptions' 		=> 	array(
				            'validateOnSubmit'	=>	true,
				            'validateOnChange'	=>	true,
				            'validateOnType'	=>	true,
				        ),
					)); ?>
					
					<div class="infoAcc">
						<?php	// tài khoản
							echo $form->textFieldGroup($cus,'email',array('wrapperHtmlOptions' => array('class' => 'col-sm-6'),'widgetOptions'=>array('htmlOptions'=>array('required'=>true,'placeholder'=>'Tài khoản', 'id' => 'accEmail')),'labelOptions' => array('class'=>'col-sm-3','label'=>'Email*')));
							echo "<div class='col-sm-offset-3 error Customer_Email'></div>";

							// mật khẩu
							echo $form->passwordFieldGroup($cus,'password',array('wrapperHtmlOptions' => array('class' => 'col-sm-6'),'widgetOptions'=>array('htmlOptions'=>array('required'=>true,'placeholder'=>'Mật khẩu', 'id' => 'accPass')),'labelOptions' => array('class'=>'col-sm-3','label'=>'Mật khẩu*')));
							echo "<div class='col-sm-offset-3 error Customer_password'></div>";

							echo "<div class='col-sm-offset-3 error errorLog'></div>";

							echo "<a class='col-sm-offset-3' href=''>Quên mật khẩu?</a>";
						?>			
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="email"></label>
					    <div class="col-sm-6 text-right">
					    	<button type="submit" class="btn btn_bookoke book_submit choose_info">ĐĂNG NHẬP</button>		    	
					    </div>
					</div>
				
					<?php $this->endWidget();  ?>
		      	</div>
		    </div>
		</div>

		<div class="panel FbLoginInfo">
		    <div class="infoHead">
		      	Chưa có tài khoản, <a class="infoBtn" data-toggle="collapse" data-parent="#accordion" href="#fbSignIn">Đăng ký</a>
		    </div>

		    <div id="fbSignIn" class="panel-collapse collapse">
		    	<div class="panel-body">
		      		<?php $form 	=	$this->beginWidget('booster.widgets.TbActiveForm',array(
						'id'					=>	'Book-Customer-Info',
						'enableAjaxValidation'	=>	false,
						'type' 					=> 	'horizontal',
						'htmlOptions'			=>	array(  
							'enctype' => 'multipart/form-data',
						),
						'clientOptions' 		=> 	array(
				            'validateOnSubmit'	=>	true,
				            'validateOnChange'	=>	true,
				            'validateOnType'	=>	true,
				        ),
					)); ?>
					<div class="infoPer">
						<?php 
							// họ tên
							echo $form->textFieldGroup($cus,'fullname',array(
								'wrapperHtmlOptions' => array('class' => 'col-sm-6'),
								'widgetOptions'=>array('htmlOptions'=>array('required'=>true,'placeholder'=>'Họ tên','id'=>'logFullname')),
								'labelOptions' => array('class'=>'col-sm-3','label'=>'Họ tên*')));
							echo "<div class='col-sm-offset-3 error Customer_fullname'></div>";

							// số điện thoại
							echo $form->textFieldGroup($cus,'phone',array(
								'wrapperHtmlOptions' => array('class' => 'col-sm-6'),
								'prepend'=> '+ 84',
								'widgetOptions'=>array('htmlOptions'=>array('required'=>true,'placeholder'=>'Số điện thoại','id'=>'logPhone')),
								'labelOptions' => array("label" => 'Điện thoại*', 'class'=>'col-sm-3')));
							echo "<div class='col-sm-offset-3 error Customer_phone'></div>";

							// địa chỉ
							echo $form->textFieldGroup($cus,'address',array(
								'wrapperHtmlOptions' => array('class' => 'col-sm-6'),
								'widgetOptions'=>array('htmlOptions'=>array('placeholder'=>'Địa chỉ','id'=>'logAddress')),
								'labelOptions' => array("label" => 'Địa chỉ', 'class'=>'col-sm-3')));
							echo "<div class='col-sm-offset-3 error Customer_address'></div>";
						?>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email"></label>
						    <div class="col-sm-6">
						    	<div class="col-sm-6">
						      		<div class="row">
						      			<?php 	
						      				// country
						      				echo $form->dropDownList($cus, 'id_country',array('VN'=>'Viet Nam'), array(
						      							'id'			=>	'logCountry',
												       	'class'			=>	'form-control id_country',
												       	'placeholder'	=>	'Quốc gia',
											));
										?>
						      		</div>
						    	</div>
						    	<div class="col-sm-6">
						      		<div class="row">
						      			<?php 
						      				// city
						      				echo $form->dropDownList($cus, 'id_city',array('1752'=>'TP HCM'), array(
						      							'id'			=>	'logCity',
												       	'class'			=>	'form-control id_city',
												       	'placeholder'	=>	'Thành phố',
											));
										?>
						      		</div>
						    	</div>
						    </div>
						</div>
					</div>
					
					<div class="infoAcc" style="margin-top: 20px;">
						<?php	
							// email
							echo $form->textFieldGroup($cus,'email',array(
								'wrapperHtmlOptions' => array('class' => 'col-sm-6'),
								'widgetOptions'=>array('htmlOptions'=>array('required'=>true,'placeholder'=>'Email', 'id'=>'logEmail')),
								'labelOptions' => array('class'=>'col-sm-3','label'=>'Email*')));
							echo "<div class='col-sm-offset-3 error Customer_email'></div>";

							// mật khẩu
							echo $form->passwordFieldGroup($cus,'password',array(
								'wrapperHtmlOptions' => array('class' => 'col-sm-6'),
								'widgetOptions'=>array('htmlOptions'=>array('required'=>true,'placeholder'=>'Mật khẩu','id'=>'logPass')),
								'labelOptions' => array('class'=>'col-sm-3','label'=>'Mật khẩu*')));
							echo "<div class='col-sm-offset-3 error Customer_password'></div>";

							// mật khẩu
							echo $form->passwordFieldGroup($cus,'repeatpassword',array(
								'wrapperHtmlOptions' => array('class' => 'col-sm-6'),
								'widgetOptions'=>array('htmlOptions'=>array('required'=>true,'placeholder'=>'Nhập lại mật khẩu','id'=>'LogRePass')),
								'labelOptions' => array('class'=>'col-sm-3','label'=>'Nhập lại mật khẩu*')));
							echo "<div class='col-sm-offset-3 error Customer_repeatpassword'></div>";
						?>
					</div>

					<div class="form-group">
						<div class="col-xs-6 col-xs-offset-3" id="html_element"></div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="email"></label>
					    <div class="col-sm-6 text-right">
					    	<button type="submit" class="btn btn_bookoke book_submit choose_info">ĐĂNG KÝ</button>		    	
					    </div>
					</div>
				
					<?php $this->endWidget();  ?>
		      	</div>
		    </div>
		</div>

		<div class="FbInfoCus" style="display: none;">
			<div class="infoHead">
		      	Cập nhật thông tin cá nhân
		    </div>

		    <div id="" class="">
		    	<div class="">
		      		<?php $form 	=	$this->beginWidget('booster.widgets.TbActiveForm',array(
						'id'					=>	'Update-Customer-Info',
						'enableAjaxValidation'	=>	false,
						'type' 					=> 	'horizontal',
						'htmlOptions'			=>	array(  
							'enctype' => 'multipart/form-data',
						),
						'clientOptions' 		=> 	array(
				            'validateOnSubmit'	=>	true,
				            'validateOnChange'	=>	true,
				            'validateOnType'	=>	true,
				        ),
					)); ?>
					<div class="infoPer">
						<?php 
							// họ tên
							echo $form->textFieldGroup($cus,'fullname',array(
								'wrapperHtmlOptions' => array('class' => 'col-sm-6'),
								'widgetOptions'=>array('htmlOptions'=>array('required'=>true,'placeholder'=>'Họ tên','id'=>'cusFullname')),
								'labelOptions' => array('class'=>'col-sm-3','label'=>'Họ tên*')));
							echo "<div class='col-sm-offset-3 error Customer_fullname'></div>";

							echo $form->hiddenField($cus,'id_fb');
							echo $form->hiddenField($cus,'name_fb');

							echo $form->hiddenField($cus,'id_gg');
							echo $form->hiddenField($cus,'name_gg');
							
							// email
							echo $form->textFieldGroup($cus,'email',array(
								'wrapperHtmlOptions' => array('class' => 'col-sm-6'),
								'widgetOptions'=>array('htmlOptions'=>array('required'=>true,'maxlength'=>128,'placeholder'=>'Email','id'=>'cusEmail')),
								'labelOptions' => array('class'=>'col-sm-3','label'=>'Email*')));
							echo "<div class='col-sm-offset-3 error Customer_email'></div>";

							// số điện thoại
							echo $form->textFieldGroup($cus,'phone',array(
								'wrapperHtmlOptions' => array('class' => 'col-sm-6'),
								'prepend'=> '+ 84',
								'widgetOptions'=>array('htmlOptions'=>array('required'=>true,'placeholder'=>'Số điện thoại','id'=>'cusPhone')),
								'labelOptions' => array("label" => 'Điện thoại*', 'class'=>'col-sm-3')));
							echo "<div class='col-sm-offset-3 error Customer_phone'></div>";

							// địa chỉ
							echo $form->textFieldGroup($cus,'address',array(
								'wrapperHtmlOptions' => array('class' => 'col-sm-6'),
								'widgetOptions'=>array('htmlOptions'=>array('placeholder'=>'Địa chỉ','id'=>'cusAddress')),
								'labelOptions' => array("label" => 'Địa chỉ', 'class'=>'col-sm-3')));
							echo "<div class='col-sm-offset-3 error Customer_address'></div>";
						?>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email"></label>
						    <div class="col-sm-6">
						    	<div class="col-sm-6">
						      		<div class="row">
						      			<?php 	
						      				// country
						      				echo $form->dropDownList($cus, 'id_country',array('VN'=>'Viet Nam'), array(
						      							'id'			=>	'cusCountry',
												       	'class'			=>	'form-control id_country',
												       	'placeholder'	=>	'Quốc gia',
											));
										?>
						      		</div>
						    	</div>
						    	<div class="col-sm-6">
						      		<div class="row">
						      			<?php 
						      				// city
						      				echo $form->dropDownList($cus, 'id_city',array('1752'=>'TP HCM'), array(
						      							'id'			=>	'cusCity',
												       	'class'			=>	'form-control id_city',
												       	'placeholder'	=>	'Thành phố',
											));
										?>
						      		</div>
						    	</div>
						    </div>
						</div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="email"></label>
					    <div class="col-sm-6 text-right">
					    	<button type="submit" class="btn btn_bookoke book_submit choose_info">CẬP NHẬT</button>		    	
					    </div>
					</div>
				
					<?php $this->endWidget();  ?>
		      	</div>
		    </div>
		</div>
	</div> 
</div>

<!-- pop up information -->
<div class="modal fade pop_bookoke" id="account" role="dialog">
    <div class="modal-dialog" style="width: 350px; margin-top: 23%;">
        <div class="modal-content">

            <div class="modal-header popHead">
                <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
                <h5 id="info_head">THÔNG BÁO</h5>
            </div>
            <div class="modal-body text-center">
                <p id="accCt"></p>
                <input type="hidden" id="idAcc" value="">
                <input type="hidden" id="emailAcc" value="">
                <input type="hidden" id="nameAcc" value="">
            </div>
            <div class="text-right" style="padding: 0 15px 15px">
            	<button type="button" class="btn btn_cancel" data-dismiss="modal">Hủy</button><!-- 
                <button type="button" class="btn btn_bookoke btnSub accSubmit">Đồng ý</button> -->
                <button type="button" class="btn btn_bookoke btnSub logSubmit" style="display: none;">Đồng ý</button>
            </div>
        </div>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

<script>
$.fn.select2.defaults.set( "theme", "bootstrap" );
/********** dang nhap fb ***************/
	$('#loginAccFb').click(function (e) {
	  	e.preventDefault();
		FB.login(function(response){
		  	if (response.status === 'connected') {
      			getUFbInfo();
      		}
		},{scope: 'public_profile,email'});
	})
/********** chon thanh pho ***************/
	function selectCity(id_country) {
		$('.id_city').select2({
			placeholder: 'Thành phố',
			language   : "vi",
			width: '100%',
		    
		    ajax: {
		        dataType : "json",
		        url      : '<?php echo CController::createUrl('fb/getCityList'); ?>',
		        type     : "post",
		        delay    : 1000,
		        data : function (params) {
					return {
						q         : params.term, // search term
						page      : params.page || 1,
						id_country: id_country,
					};
				},
				processResults: function (data, params) {
					params.page = params.page || 1;
					
					return {
						results 	: data,
						pagination 	: {
							more 	:true
						}
					};
				},
				cache: true,
		    },
		});
	}
/********** chon quoc gia ***************/
	$('.id_country').select2({
		placeholder: 'Quốc gia',
		language   : "vi",
		width: '100%',

	    ajax: {
	        dataType : "json",
	        url      : '<?php echo CController::createUrl('fb/getCountryList'); ?>',
	        type     : "post",
	        delay    : 1000,
	        data : function (params) {
				return {
					q 		: params.term, // search term
					page 	: params.page || 1
				};
			},
			processResults: function (data, params) {
				params.page = params.page || 1;
				
				return {
					results 	: data,
					pagination 	: {
						more 	:true
					}
				};
			},

			cache: true,
	    },
	});

	selectCity('VN');

	$('#logCountry').change(function (e) {
		var id_country = $(this).val();
		$('#logCity').html('');
		selectCity(id_country);
	});
	$('#cusCountry').change(function (e) {
		var id_country = $(this).val();
		$('#cusCity').html('');
		selectCity(id_country);
	});
/********** chuyen den trang xac thuc tai khoan ***************/
	function book_verity() {
		$.ajax({
			url     : "<?php echo CController::createUrl('fb/book_verity'); ?>",
			type    : 'POST',
			dataType: 'html',
			success: function (data) {
				if(data) {
					$('#book_choose').empty();
					$('#book_choose').html(data);
				}
			},
			error: function(xhr, status, error) {
			  	console.log(error);
			}
		})
	}
/********** Dang nhap tai khoan ***************/
	$('#Book-Login-Info').submit(function(e) {
	    e.preventDefault();

	    //Serialize the form data and store to a variable.
	    var formData = new FormData($("#Book-Login-Info")[0]);

	    if (!formData.checkValidity || formData.checkValidity()) {
	        jQuery.ajax({ 
				type    : 	"POST",
				url     : 	"<?php echo CController::createUrl('fb/logUser')?>",
				data    : 	formData,
				dataType: 	'json',
				success : 	function(data){
	               	if(data == 0) {
	               		$('.errorLog').text("Tài khoản hoặc mật khẩu không chính xác!");
	               		$('.errorLog').show();
	               	}
	               	else if(data == 1) {
	               		$('.errorLog').text("");
	               		calVerify();
	               	}
	            },
	            error: function(data) {
	                alert("Error occured.Please try again!");
	            },
				cache      : false,
				contentType: false,
				processData: false
	        });
	    }
	    return false;
	});
/********** cap nhat thong tin khach hang fb ***************/
	$('#Update-Customer-Info').submit(function(e) {
	    e.preventDefault();

	    //Serialize the form data and store to a variable.
	    var formData = new FormData($("#Update-Customer-Info")[0]);

	    if (!formData.checkValidity || formData.checkValidity()) {
	        jQuery.ajax({ 
				type    : 	"POST",
				url     : 	"<?php echo CController::createUrl('fb/addCusFb')?>",
				data    : 	formData,
				dataType: 	'json',
				success : 	function(data){
					$('.error').addClass('hidden');
	               	if(data.status == 1) {
	               		calVerify();
	               	}
	               	else if(data.status == -1){
	                	$('#idAcc').val(data.id);
	                	$('#emailAcc').val(data.email);
	                	$('#nameAcc').val(data.name);
	                	$('#accCt').html("Bạn đã có tài khoản sử dụng dịch vụ BookOke. </br> Với địa chỉ email: " +data.email + ". </br> Bạn có thể <a href='javascript:void(0);' onclick='oOpen();' class=' oClick' title=''>ĐĂNG NHẬP</a> hoặc khởi <a href='javascript:void(0);' onclick='SendEmail();' class='accSubmit oClick' title=''>KHỞI TẠO</a> lại mật khẩu của tài khoản.");
	                	$('.accSubmit').show();
	                	$('.logSubmit').hide();
	                	$('#account').modal('show');
	                }
	               	else {
	                	$.each(data.error, function (k, v) {
		            		$('.Customer_' + k +'').text(v[0]);
		            		$('.Customer_' + k +'').removeClass('hidden');
		            	});
	                }
	            },
	            error: function(data) {
	                alert("Error occured.Please try again!");
	            },
				cache      : false,
				contentType: false,
				processData: false
	        });
	    }
	    return false;
	});
/********** dang ky khach hang bookoke ***************/
	$('#Book-Customer-Info').submit(function(e) {
	    e.preventDefault();

	    var isCaptchaValidated = false;
		var response = grecaptcha.getResponse();

		if(response.length == 0) {
		    isCaptchaValidated = false;
		    alert('Please verify that you are a Human.');
		} else {
		    isCaptchaValidated = true;
		}

		if (!isCaptchaValidated ) {
		    return;
		}

	    //Serialize the form data and store to a variable.
	    var formData = new FormData($("#Book-Customer-Info")[0]);

	    if (!formData.checkValidity || formData.checkValidity()) {
	        jQuery.ajax({ 
				type    : 	"POST",
				url     : 	"<?php echo CController::createUrl('fb/cus_info')?>",
				data    : 	formData,
				dataType: 	'json',
				success : 	function(data){
					$('.error').addClass('hidden');
	                if(data.status == '1'){
	    				calVerify();
	    				getNoti(1);
	                    return false;
	                }
	                else if(data.status == -1){
	                	$('#idAcc').val(data.id);
	                	$('#emailAcc').val(data.email);
	                	$('#nameAcc').val(data.name);
	                	$('#accCt').html("Bạn đã có tài khoản sử dụng dịch vụ BookOke. </br> Với địa chỉ email: " +data.email + ". </br> Bạn có thể <a href='javascript:void(0);' onclick='oOpen();' class=' oClick' title=''>ĐĂNG NHẬP</a> hoặc khởi <a href='javascript:void(0);' onclick='SendEmail();' class='accSubmit oClick' title=''>KHỞI TẠO</a> lại mật khẩu của tài khoản.");
	                	$('.accSubmit').show();
	                	$('.logSubmit').hide();
	                	$('#account').modal('show');
	                }
	                else {
	                	$.each(data.error, function (k, v) {
		            		$('.Customer_' + k +'').text(v[0]);
		            		$('.Customer_' + k +'').removeClass('hidden');
		            	});
		            	grecaptcha.reset();
	                }
	            },
	            error: function(data) {
	                alert("Error occured.Please try again!");
	            },
				cache      : false,
				contentType: false,
				processData: false
	        });
	    }
	    return false;
	});

	function oOpen() {
		//e.preventDefault();
		$('.FbInfoCus').hide();
		$('.FbLoginInfo').show();
		$('#account').modal('hide');
		$('#fbLogin').collapse('show');
		$('#fbSignIn').collapse('hide');
		$('.errorLog').text("");

		return false;
	}
/********** gửi mail kich hoat tai khoan ***************/
	function SendEmail() {
		console.log("ckdchiak");
		id    = $('#idAcc').val();
		email = $('#emailAcc').val();
		name  = $('#nameAcc').val();

		$.ajax({ 
			type    : 	"POST",
			url     : 	"<?php echo CController::createUrl('fb/activeAcc')?>",
			dataType: 	'json',
			data    : 	{
				id   :id,
				email:email,
				name :name,
			},
			success : 	function(data){
	           	if(data == 1){		// gui thanh cong
	           		$('#accCt').text("Chúng tôi đã gửi thông tin truy cập đến email của bạn. Vui lòng kiểm tra email và sử dụng để truy cập sử dụng dịch vụ.");
	           		$('.accSubmit').hide();
	                $('.logSubmit').show();
	           		$('#account').modal('show');
	           	}
	        },
	        error: function(data) {
	            alert("Error occured.Please try again!");
	        },
	    });
	}
	$('.accSubmit').click(function(e) {
	    e.preventDefault();

		SendEmail();
	});

	$('.logSubmit').click(function (e) {
		e.preventDefault();
		$('.FbInfoCus').hide();
		$('.FbLoginInfo').show();
		$('#account').modal('hide');
		$('#fbLogin').collapse('show');
		$('#fbSignIn').collapse('hide');
		$('.errorLog').text("");
	})
</script>