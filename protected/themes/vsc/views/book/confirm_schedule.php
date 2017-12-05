<?php $baseUrl = Yii::app()->getBaseUrl(); ?>

<div  class="container" id="bk_step">
	<div class="row">
		<div class="col-sm-12">
			<div class="row" id="bk_st_tt">
				<h3>ĐẶT LỊCH KHÁM</h3>
				<div id="bk_action">
					<ul class="list-inline">
						<li class="bk_fn"><a href="<?php echo $baseUrl; ?>/index.php/book/">1. ĐẶT LỊCH HẸN</a></li>
						<li class="bk_fn"><a href="<?php echo $baseUrl; ?>/index.php/book/register_info">2. ĐĂNG KÝ THÔNG TIN</a></li>
						<li class="bk_fn"><a href="<?php echo $baseUrl; ?>/index.php/book/verify_schedule">3. KIỂM CHỨNG LỊCH HẸN</a></li>
						<li class="bk_fn"><a href="<?php echo $baseUrl; ?>/index.php/book/confirm_schedule">4. XÁC NHẬN LỊCH HẸN</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="bk_step_num">
		4
</div>
<div  class="container" id="bk_info">
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-md-10 col-md-offset-1" id="bk_confirm">
					<div class="col-md-6">
						<p><b>Nhận tin nhắn xác nhận lịch khám qua:</b></p>
						<select name="" class="form-control" style="width: 70%;">
							<option value="">Qua email đã đăng ký</option>
						</select>
						<h6><i>*Quý khách vui lòng xác nhận email để hoàn tất</i></h6>
					</div>
					<div class="col-md-6">
						<p><b>Nhắc nhở lịch hẹn cho bệnh nhân:</b></p>
						<select name="" class="form-control" style="width: 70%;">
							<option value="">Nhắc nhở trước một ngày</option>
						</select>
						<h6><i>Dịch vụ không bắt buộcc, quý khách có thể chọn "Không nhắc nhở"</i></h6>
					</div>
				</div>
				<div class="col-md-12" style="margin-top: 20px;">
					<!-- <button type="submit" class="btn btn_blue pull-right">TIẾP TỤC</button> -->
					<a href="#" class="btn btn_blue pull-right">HOÀN TẤT</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(window).load(function () {
	$('body').delay(100) //wait 5 seconds
	    .animate({
	        'scrollTop': $('#bk_st_tt').offset().top
	    });
});
</script>