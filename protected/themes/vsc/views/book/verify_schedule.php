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
						<li><a href="<?php echo $baseUrl; ?>/index.php/book/confirm_schedule">4. XÁC NHẬN LỊCH HẸN</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="bk_step_num">
		3
</div>
<div  class="container" id="bk_info">
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-4" id="bk_cf">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/xac-nhan.png" alt="">
					</div>
					<div class="col-md-5" id="bk_code">
						<div class="col-md-12">
							<form action="" method="get" accept-charset="utf-8" class="form-inline">
								<div class="form-group">
									<label>Nhận mã code bằng:</label>
									<label class="radio-inline"><input type="radio" name="">Tin nhắn</label>
									<label class="radio-inline"><input type="radio" name="">Cuộc gọi thoại</label>
								</div>
								<div class="bk_ver_ali">
									<button type="button" class="btn btn_black btn-block">OK</button>
								</div>
							</form>
							<div class="bk_ver_ali">
								<p>
									Chúng tôi đã gửi tin nhắn, vui lòng kiểm tra tin nhắn! <br/> Chưa nhận được tin nhắn, vui lòng nhấn <a href="" title="">GỬI LẠI</a>
								</p>
							</div>
							<div class="bk_ver_ali">
								<input type="text" name="" value="" placeholder="Nhập mã code tại đây" class="form-control">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<!-- <button type="submit" class="btn btn_blue pull-right">TIẾP TỤC</button> -->
					<a href="<?php echo $baseUrl; ?>/index.php/book/confirm_schedule" class="btn btn_blue pull-right">TIẾP TỤC</a>
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