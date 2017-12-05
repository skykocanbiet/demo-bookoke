<div id="book_choose_verity_sms">
	<div class="alert">
		Đặt lịch hẹn thành công
	</div>

	<div class="book_enter_form">
		<div class="form-inline">
			<label>Nhắc nhở tôi </label>
				<select id="schRemain" class="form-control">
					<option value="0">Không, cảm ơn</option>
					<option value="1">Trước một giờ</option>
					<option value="2">Trước một ngày</option>
					<option value="3">Trước một tuần</option>
				</select>
			
			<button type="button" class="btn btn_bookoke choose_complete">HOÀN TẤT</button>
		</div>
		<div class="form-group">
			
		</div>
	</div>
</div>

<script>
function calRemain(remain){
	$.ajax({
			url     : '<?php echo CController::createUrl('fb/schRemail'); ?>',
			type    : "post",
			dataType: 'json',
			data: {
				remain: remain,
			},
			success : function (data) {
				
			}
	    })
}

$('.choose_complete').click(function (e) {
	e.preventDefault();

	remain = $('#schRemain').val();
	if(remain > 0) {
		calRemain(remain);
	}
	
	calBranch();
});
</script>