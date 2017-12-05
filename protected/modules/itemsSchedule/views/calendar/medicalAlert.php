<?php /** @var TbActiveForm $form */
	$form = $this->beginWidget('booster.widgets.TbActiveForm',array(
	        'id' 					=> 	'frm-alert-cus',
	        'type' 					=> 	'horizontal',
	        'action'				=>	CController::createUrl('calendar/medicalAlert'),
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
	<div class="col-xs-10 col-xs-offset-1">
		<?php 
			$t = 0;
			$alert 		= 	MedicineAlert::model()->findAllByAttributes(array('status'=>1));
			$alert 		= 	CHtml::listData($alert,'id','name');
			
			foreach ($alert as $key => $value): 
				$checked = '';
				if(isset($als[$t]) && $key == $als[$t]) {
					$checked = 'checked';
					$t++;
				}
		?>

		<div class="checkbox">
			<label>
				<input id="ytCsMedicalHistoryAlert_id_medicine_alert_<?php echo $key; ?>" type="hidden" value="0" name="CsMedicalHistoryAlert[id_medicine_alert][<?php echo $key; ?>]">

				<input <?php echo $checked; ?> name="CsMedicalHistoryAlert[id_medicine_alert][<?php echo $key; ?>]" id="CsMedicalHistoryAlert_id_medicine_alert_<?php echo $key; ?>" value="1" type="checkbox">
				<?php echo $value; ?>
			</label>
		</div>
		<?php endforeach ?>
	</div>

	<div class="form-group">
	  	<div class="col-xs-11 text-right" style="margin: 10px 0;">
	  		<button type="button" class="btn btn_book " data-dismiss="modal" style="color: white;">Đóng</button>
			<button type="submit" class="btn btn_book" id="step-4" style="color: white;">Cập nhật</button>
	  	</div>  
	</div>
	<?php 
		$this->endWidget();
		unset($form);
	?>

<script>
$('#step-4').click(function (e) {
	e.preventDefault();
	
	var formData 	= new FormData($("#frm-alert-cus")[0]);
	$('.cal-loading').fadeIn('fast');
	$.ajax({ 
     	type 	:"POST",
        url 	:"<?php echo CController::createUrl('calendar/medicalAlert'); ?>",
        dataType:'json',
        data 	: formData,
        success: function (data) {
        	if(data == 1) {
        		$('#create_sch_modal').modal('hide');
				$('#update_sch_modal').modal('hide');
        	}
        	$('.cal-loading').fadeOut('slow');
        	return;
        },
        error: function(data) {
            alert("Error occured.Please try again!");
        },
        cache: false,
        contentType: false,
        processData: false
    });
})
</script>