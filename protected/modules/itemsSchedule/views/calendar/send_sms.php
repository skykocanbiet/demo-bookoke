
<style>
#send_sms label {
	width: 35%;
}
#send_sms input, #send_sms textarea {
	background: white;
	border: 1px solid #ccc !important;
}
#send_sms textarea {
	resize: none;
}
</style>

<div id="sendsSmsPop" class="modal pop_bookoke">
   	<div class="modal-dialog" style="width: 380px; padding-top: 100px;">
      	<div class="modal-content">
         	<div class="modal-header popHead">
            	<a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
            	<h5>GỬI TIN NHẮN</h5>
         	</div>
   
         	<div class="modal-body">
        		<form enctype="multipart/form-data" class="form-horizontal" id="send_sms" action="" method="post">  
    				<div class="form-group">
	               		<label class="col-xs-4 control-label">Số điện thoại</label>
	               		<div class="col-xs-7">
	               			<input type="text" readonly name="Sms[phone]" id="Sms_phone" value="" placeholder="Số điện thoại" class="form-control">
	               			<input type="hidden" id="Sms_cus" value="">
							<input type="hidden" id="Sms_id_cus" value="">
							<input type="hidden" id="Sms_id_sch" value="">
		                </div>
	               	</div>
	               	<div class="form-group">
	               		<label class="col-xs-4 control-label">Nội dung</label>
	               		<div class="col-xs-7">
		                  	 <textarea class="form-control" placeholder="Nội dung" name="Sms[content]" id="Sms_content" rows=5></textarea>
		               		<div class="clearfix"></div>
			                <div class="charLeft">Còn <span id="charNum">200</span> ký tự</div>
		                </div>
	               	</div>
	               	<div class="form-group">
	               		<div class="col-xs-9 text-center" style="line-height: 33px; font-size: 0.95em;">
	               			Tin nhắn không hỗ trợ tiếng Việt có dấu!
	               		</div>
	               		<div class="col-xs-3 text-right" style="padding: 0; padding-right: 40px;">
	               			<button type="submit" id="sendSMSBtn" class="btn btn_unactive">Gửi</button>
	               		</div>
	               	</div>
		        </form>
          	</div>
        </div>
    </div>
</div>
<div id="sendSmsRs" class="modal pop_bookoke">
   	<div class="modal-dialog" style="width: 380px; padding-top: 100px;">
      	<div class="modal-content">
         	<div class="modal-header popHead">
            	<a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
            	<h5>THÔNG BÁO</h5>
         	</div>
   
         	<div class="modal-body">
        		<p id="smsMs">Gửi tin nhắn thành công.</p>
          	</div>
        </div>
    </div>
</div>
<script>

$('#sendsSmsPop').on('hide.bs.modal', function () {
  $('#Sms_content').val('');
  $('#Sms_phone').val('');
});
	$('#Sms_content').on('keypress keyup',function (e) {
		len = $("#Sms_content").val().length;
		phone = $('#Sms_phone').val();

		if(200 - len < 0) {
			e.preventDefault();
			return false;
		}

		if(len > 0 && phone)
			$('#sendSMSBtn').removeClass('btn_unactive').addClass('btn_bookoke');
		else
			$('#sendSMSBtn').removeClass('btn_bookoke').addClass('btn_unactive');

		$('#charNum').text(200 - len);
	});

	$('#send_sms').submit(function (e) {
		e.preventDefault();

		if ($('#sendSMSBtn').hasClass('btn_unactive')) {
			return;
		}
		
		phone = $('#Sms_phone').val();
		text  = $('#Sms_content').val();
		cus   = $('#Sms_cus').val();
		id_cus = $('#Sms_id_cus').val();
		id_schedule = $('#Sms_id_sch').val();

		$.ajax({
			type: "post",
			dataType: 'json',
			url: '<?php echo Yii::app()->createUrl('itemsUsers/Sms/sendSMS'); ?>',
			data: {
				phone : phone,
				text  : text,
				source: 1,
				id_cus: id_cus,
				cus   : cus,
				id_sch: id_schedule,
			},
			success: function(data) {
				$('#sendsSmsPop').modal('hide');
				if(data == 1) {
					$('#smsMs').text("Gửi tin nhắn thành công!");
					$('#sendSmsRs').modal('show');
				}
				else if(data == -2) {
					$('#smsMs').text("Số điện thoại không tồn tại!");
					$('#sendSmsRs').modal('show');
				}
				else {
					$('#smsMs').text("Có lỗi xảy ra. Vui lòng thử lại sau!");
					$('#sendSmsRs').modal('show');
				}
			},
	  	});
	})
</script>