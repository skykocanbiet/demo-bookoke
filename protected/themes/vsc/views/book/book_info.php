<div id="book_choose_info">
	<div class="alert">
		Enter Your Information
	</div>
	<div class="book_enter_form">
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

		<?php echo $form->errorSummary($cus); ?>
		<?php 
			// họ tên
			echo $form->textFieldGroup($cus,'name',array('wrapperHtmlOptions' => array('class' => 'col-sm-6'),'widgetOptions'=>array('htmlOptions'=>array('required'=>'','placeholder'=>'Name*')),'labelOptions' => array('class'=>'col-sm-3')));
			echo "<div class='col-sm-offset-3 error CsScheduleCustomer_name'></div>";
			
			// email
			echo $form->textFieldGroup($cus,'email',array('wrapperHtmlOptions' => array('class' => 'col-sm-6'),'widgetOptions'=>array('htmlOptions'=>array('required'=>'','maxlength'=>128,'placeholder'=>'Email*')),'labelOptions' => array("label" => 'Email', 'class'=>'col-sm-3')));
			echo "<div class='col-sm-offset-3 error CsScheduleCustomer_email'></div>";

			// số điện thoại
			echo $form->textFieldGroup($cus,'phone',array('wrapperHtmlOptions' => array('class' => 'col-sm-6'),'prepend' 				=> '+ 84','widgetOptions'=>array('htmlOptions'=>array('required'=>'','placeholder'=>'Phone*')),'labelOptions' => array("label" => 'Mobile', 'class'=>'col-sm-3')));
			echo "<div class='col-sm-offset-3 error CsScheduleCustomer_phone'></div>";

			// địa chỉ
			echo $form->textFieldGroup($cus,'address',array('wrapperHtmlOptions' => array('class' => 'col-sm-6'),'widgetOptions'=>array('htmlOptions'=>array('placeholder'=>'Address')),'labelOptions' => array("label" => 'Address', 'class'=>'col-sm-3')));
			echo "<div class='col-sm-offset-3 error CsScheduleCustomer_address'></div>";
		?>

		<div class="form-group">
		    <label class="control-label col-sm-3" for="email"></label>
		    <div class="col-sm-6">
		    	<div class="col-sm-6">
		      		<div class="row">
		      			<?php 	
		      				// country
		      				echo $form->dropDownList($cus, 'id_country',array(), array(
		      							'id'			=>	'id_country',
								       	'class'			=>	'form-control',
								       	'placeholder'	=>	'Country',
							)); 
							echo "<div class='col-sm-offset-3 error CsScheduleCustomer_id_country'></div>";
						?>
		      		</div>
		    	</div>
		    	<div class="col-sm-6">
		      		<div class="row">
		      			<?php 
		      				// city
		      				echo $form->dropDownList($cus, 'id_city',array('0'=>'City'), array(
		      							'id'			=>	'id_city',
								       	'class'			=>	'form-control',
								       	'placeholder'	=>	'City',
							)); 
							echo "<div class='col-sm-offset-3 error CsScheduleCustomer_id_city'></div>";
						?>
		      		</div>
		    	</div>
		    </div>
		</div>

		<?php echo $form->textAreaGroup($cus,'comment', array('wrapperHtmlOptions' => array('class' => 'col-sm-6',),'widgetOptions'=>array('htmlOptions' => array('rows' => 3)),'labelOptions' => array("label" => 'Comments', 'class'=>'col-sm-3'))); 
		?>

		<div class="form-group">
		    <label class="control-label col-sm-3" for="email"></label>
		    <div class="col-sm-6">
		    	<button type="submit" class="btn btn-default book_submit choose_info btn_blue">CONTINUE</button>		    	
		    </div>
		</div>
	
		<?php $this->endWidget();  ?>
	</div>
</div>

<script>
$.fn.select2.defaults.set( "theme", "bootstrap" );
// select 2
function selectCity(id_country) {
	$('#id_city').select2({
	    placeholder: 'City',
	    ajax: {
	        dataType : "json",
	        url      : '<?php echo CController::createUrl('book/getCityList'); ?>',
	        type     : "post",
	        delay    : 1000,
	        data : function (params) {
				return {
					q 		: params.term, // search term
					page 	: params.page || 1,
					id_country	: id_country,
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

$('#id_country').select2({
    placeholder: 'Country',
    ajax: {
        dataType : "json",
        url      : '<?php echo CController::createUrl('book/getCountryList'); ?>',
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

$('#id_country').change(function (e) {
	var id_country = $('#id_country').val();
	selectCity(id_country);
});

function book_verity() {
	$.ajax({
		url: "<?php echo CController::createUrl('book/book_verity'); ?>",
		type: 'POST',
		success: function (data) {
						
			if(data) {
				$('#book_choose').empty();
				$('#book_choose').html(data);
			}
			else {
				console.log(data);
			}
		}, 
	})
}

$('#Book-Customer-Info').submit(function(e) {
    e.preventDefault();

    //Serialize the form data and store to a variable.
    var formData = new FormData($("#Book-Customer-Info")[0]);

    if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({ 
        	type 		: 	"POST",
            url 		: 	"<?php echo CController::createUrl('book/cus_info')?>",
            data 		: 	formData,
            dataType 	: 	'json',
            success 	: 	function(data){
                if(data.status == '1'){
                	$('.error').addClass('hidden');
                	runProcess('80%');

                	book_verity();

                    return false;
                }
                else {
                	$('.error').addClass('hidden');
                	$.each(data, function (k, v) {
	            		$('.' + k +'').text(v);
	            		$('.' + k +'').removeClass('hidden');
	            	})
                }
            },
            error: function(data) {
                alert("Error occured.Please try again!");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
    return false;

});
</script>