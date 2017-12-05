<style>
	.verifyBox>div>div {margin-bottom: 10px;}
	.verifyTT {color: #979797; font-weight: bold;}
	.verifyCode .radio-inline:first-child {padding-right: 50px;}
	.verifyCode .radio-inline input{margin-top: 1px;}
</style>
<div id="book_choose_verity_type">
<?php $st = $data['status'];
	if ($st != 1): ?>
		<div class="alert alert-warning" id="txtSchErr" style=" font-size: 14px; padding: 15px; font-weight: normal;">
			<?php echo $data['error-message']; ?>
		</div>
<?php endif ?>
	<div class="alert">
		Xác thực thông tin
	</div>
	<div class="panel panel-default" style="border-radius: 0;">
	  	<div class="panel-body verifyBox">
	  		<div class="col-sm-6">
	  			<div class="col-sm-4 verifyTT"> Cơ sở: </div>
	  			<div class="col-sm-8 txtschInfo"><?php echo ($st == 1 ) ? $book['branch_name'] : '&nbsp'; ?></div>
	  			<div class="col-sm-4 verifyTT"> Dịch Vụ: </div>
	  			<div class="col-sm-8 txtschInfo"> <?php echo ($st == 1 ) ? $book['service_name'] : '&nbsp'; ?> </div>
	  			<div class="col-sm-4 verifyTT"> Nhân viên: </div>
	  			<div class="col-sm-8 txtschInfo"> <?php echo ($st == 1 ) ? $book['provider_name'] : '&nbsp'; ?> </div>
	  			<div class="col-sm-4 verifyTT"> Ngày: </div>
	  			<div class="col-sm-8 txtschInfo"> <?php echo ($st == 1 ) ? $book['date'] : '&nbsp'; ?> </div>
	  			<div class="col-sm-4 verifyTT"> Giờ: </div>
	  			<div class="col-sm-8 txtschInfo"> <?php echo ($st == 1 ) ? $book['time_start'].' - '.$book['time_end'] : '&nbsp'; ?> </div>
	  		</div>
	  		<div class="col-sm-6">
	  			<div class="col-sm-4 verifyTT"> Thông tin: </div>
	  			<div class="col-sm-8"> 
	  				<div><?php echo $cus['fullname']; ?></div>
	  				<div>
	  					<?php $phone = "(+" . substr($cus['phone'],0,2) . ") " . substr($cus['phone'],2); ?>
	  					<?php echo $phone; ?>
	  				</div>
	  				<div class="veriEmail">
	  					<?php echo $cus['email']; ?>
	  				</div>
	  			</div>
	  			<div class="col-sm-4 verifyTT"> Ghi chú: </div>
	  			<div class="col-sm-8">
	  				<textarea class="form-control" name="">Nhập ghi chú</textarea>
	  			</div>
	  		</div>
	  	</div>
	</div>

	<div class="clearfix"></div>
	<?php if ($st == 1): ?>
		<div class="alert txtschInfo">
			Xác thực lịch hẹn
		</div>

		<div class="book_enter_form txtschInfo">
			<div class="col-sm-12 col-sm-offset-1">
				<div class="col-sm-3">
					Nhận tin nhắn xác nhận:
				</div>
				<div class="col-sm-4 verifyCode">
					<label class="radio-inline"><input type="radio" value="1" checked name="VerifyChoose">SMS</label>
					<label class="radio-inline"><input type="radio" value="2" name="VerifyChoose">EMAIL</label>
				</div>

				<div class="col-sm-3">
					<button type="button" class="btn btn_bookoke choose_verity_type" style="margin-top: -8px;">ĐỒNG Ý</button>
				</div>
			</div>

		</div>
	<?php endif ?>
</div>

<script>
/******* chon hinh thuc xac nhan  *********/
$('.choose_verity_type').click(function (e) {
	e.preventDefault();
	veriType = $('input[name=VerifyChoose]:checked').val();
	$('.cal-loading').fadeIn('fast');
	calVerifySMS(veriType);
	
});
</script>
