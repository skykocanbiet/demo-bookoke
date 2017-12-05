
<style>
#send_sms label {
	width: 35%;
}
#send_sms input, #send_sms textarea {
	background: white;
	border: 1px solid #ccc !important;
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
	               			<input type="text" name="Sms[phone]" id="Sms_phone" value="" placeholder="Số điện thoại" class="form-control">
	               			<input type="hidden" id="Sms_cus" value="">
							<input type="hidden" id="Sms_id_cus" value="">								               			
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
	               		<div class="col-xs-9 text-center" style="line-height: 33px;">
	               			Tin nhắn không hỗ trợ tiếng Việt có dấu!
	               		</div>
	               		<div class="col-xs-3 text-right" style="padding: 0; padding-right: 40px;">
	               			<button type="submit" class="btn btn_bookoke">Gửi</button>
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
            	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">close</span></button>
            	<span>THÔNG BÁO</span>
         	</div>
   
         	<div class="modal-body">
        		<p id="smsSendRs">Gửi tin nhắn thành công</p>
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
		if(200 - len < 0) {
			e.preventDefault();
			return false;
		}
		$('#charNum').text(200 - len);
	});

	$('#send_sms').submit(function (e) {
		e.preventDefault();

		phone  = $('#Sms_phone').val();
		text   = $('#Sms_content').val();
		cus    = $('#Sms_cus').val();
		id_cus = $('#Sms_id_cus').val();

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
			},
			success: function(data) {
				if(data == 1) {
					$('#sendsSmsPop').modal('hide');
					$('#smsSendRs').text('Gửi tin nhắn thành công!')
					$('#sendSmsRs').modal('show');
				}
				else {
					$('#sendsSmsPop').modal('hide');
					$('#smsSendRs').text('Gửi tin nhắn thất bại!')
					$('#sendSmsRs').modal('show');
				}
				location.href = '<?php echo Yii::app()->getBaseUrl() ?>/itemsUsers/sms/view';
			},
	  });
	})
</script>