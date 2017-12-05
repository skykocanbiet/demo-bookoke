<div id="book_choose_verity_sms">
	<div class="alert">
		Verity Appointment
	</div>

	<div class="book_enter_form">
		<p>Chúng tôi đã gửi mã xác nhận, xin vui lòng kiểm tra tin nhắn</p>
		<p>Chưa nhận được tin nhắn, vui lòng nhấn <span>GỬI LẠI</span></p>
		<div class="form-group">
		    <div class="col-sm-7">
		      <input type="" class="form-control" id="email" placeholder="Nhập mã xác nhận tại đây">
		    </div>
		    <div class="col-sm-5">
		    	
		    	<button type="button" class="btn btn-default choose_verity_sms">SEND</button>
		    	
		    </div>
		  </div>
	</div>
</div>

<script>
$('.choose_verity_sms').click(function (e) {
	e.preventDefault();
	runProcess('100%');

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