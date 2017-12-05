<div id="book_choose_verity_sms">
	<div class="alert">
		Đặt lịch hẹn thành công
	</div>

	<div class="book_enter_form">
		<div class="form-group">
			<label>Nhắc nhở tôi 
			<select name="" class="form-control">
				<option value="">Không, cảm ơn</option>
			</select>
			</label>
			
				<button type="button" class="btn btn-default">COMPLETE</button>
			
		</div>
	</div>
</div>

<script>
$('.choose_verity_sms').click(function (e) {
	e.preventDefault();
	runProcess('41%');

	$.ajax({
		url: "<?php echo CController::createUrl('book/book_complete'); ?>",
		type: 'POST',
		dataType: 'html',
		success: function (data) {
			$('#book_choose').empty();
			$('#book_choose').html(data);
		}, 
	})
});
</script>