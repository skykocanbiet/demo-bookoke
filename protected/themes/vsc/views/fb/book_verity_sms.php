<div id="book_choose_verity_sms">
	<div class="alert">
		Xác thực thông tin
	</div>

	<div class="book_enter_form">
		<p>Chúng tôi đã gửi mã xác nhận, vui lòng kiểm tra tin nhắn hoặc email</p>
		<p class="verify1">Mã xác nhận sẽ được gửi đến trong vòng <span id="count"></span> giây</p>
		<p class="verify2" style="display: none;">Nếu chưa nhận được mã xác nhận, vui lòng yêu cầu <a href="" id="reSendCode">GỬI LẠI</a></p>
		<div class="form-group">
		    <div class="col-sm-7">
		      <input type="" class="form-control" id="codeCF" placeholder="Nhập mã xác nhận tại đây">
		    </div>
		    <div class="col-sm-7 error CodeErr">
		    </div>
		    
		    <button type="button" class="btn btn-default btn_bookoke choose_verity_sms">XÁC NHẬN</button>
		  </div>
	</div>
</div>

<!-- pop up information -->
<div class="modal pop_bookoke" id="info" role="dialog">
    <div class="modal-dialog" style="width: 350px;">
        <div class="modal-content">

            <div class="modal-header popHead">
                <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
                <h5 id="info_head">THÔNG BÁO</h5>
            </div>
            <div class="modal-body text-center">
                <p id="ifCt">Có lỗi xảy ra! Xin vui lòng thử lại sau!</p>
            </div>
            <div class="text-right" style="padding: 0 15px 15px">
                <button type="button" class="btn btn_bookoke ifSubmit">Đồng ý</button>
            </div>
        </div>
    </div>
</div>

<script>
function showCountDown(time) {
	$('.verify1').show();
	$('.verify2').hide();

	setInterval(function(){
		ct   = $('#count');
		time = parseInt(time - 1);
		if(time >= 0)
			ct.text(time);
		if(time == 0){
			$('.verify1').hide();
			$('.verify2').show();
		}
	}, 1000);
}

$('.ifSubmit').click(function(e){
	e.preventDefault();
	calBranch();
	$('#info').hide();
})
// gui lai
$('#reSendCode').click(function(e){
	e.preventDefault();

	$.ajax({
		url: "<?php echo CController::createUrl('fb/reSend'); ?>",
		type: 'POST',
		dataType: 'json',
		success: function (data) {
			if(data.status == 1)
				showCountDown(60);
			$('.CodeErr').text(data.ms);
		}, 
	})
})

$('#codeCF').keypress(function(e) {
	if (e.which == 13) {
	    code = $('#codeCF').val();
		if(code == '') {
			$('.CodeErr').text("Mã xác nhận không tồn tại!");
		}
		else {
			checkCode(code);
		}
	    return false;    //<---- Add this line
	 }
});

// xac nhan ma code
$('.choose_verity_sms').click(function (e) {
	e.preventDefault();
	
	code = $('#codeCF').val();
	if(code == '') {
		$('.CodeErr').text("Mã xác nhận không tồn tại!");
	}
	else {
		checkCode(code);
	}
});
</script>