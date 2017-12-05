<div id="book_choose_verity_type">
	<div class="alert">
		Verity Appointment
	</div>

	<div class="book_enter_form">
		<p>Nhận tin nhắn xác thực qua</p>
		<div class="col-sm-8 col-sm-offset-2">
		    <div class="radio">
			  <label><input type="radio" name="rdioSms" value="">Xác thực qua tin nhắn điệnt thoại</label>
			</div>
			<div class="radio">
			  <label><input type="radio" name="rdioSms" value="">Xác thực qua email</label>
			</div>
		</div>
		
		<div class="clearfix">
			
		</div>
		<div class="form-group">
				<button type="button" class="btn btn-default col-sm-8 btn_black choose_verity_type">OK</button>
		</div>
	</div>
</div>

<script>
$('.choose_verity_type').click(function (e) {
	e.preventDefault();
	runProcess('90%');

	$.ajax({
		url: "<?php echo CController::createUrl('book/book_verity_sms'); ?>",
		type: 'POST',
		dataType: 'html',
		success: function (data) {
			$('#book_choose').empty();
			$('#book_choose').html(data);
		}, 
	})
});
</script>