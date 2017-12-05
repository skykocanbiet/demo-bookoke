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
						<li><a href="<?php echo $baseUrl; ?>/index.php/book/verify_schedule">3. KIỂM CHỨNG LỊCH HẸN</a></li>
						<li><a href="<?php echo $baseUrl; ?>/index.php/book/confirm_schedule">4. XÁC NHẬN LỊCH HẸN</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="bk_step_num">
		2
</div>
<div  class="container" id="bk_info">
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-md-4" id="bk_select">
					<div class="col-md-12" id="bk_register_info">
						<h4>THÔNG TIN CUỘC HẸN</h4>
						<p><b>Thời gian khám:</b></p>
						<div id="bk_box_time">
							<div id="box_day">Thứ 2 - 21/10/2016</div>
							<span id="box_time">
								<p>09:00 am</p>
								<hr>
								<p>Thời gian khám: 60 phút</p>
							</span>
						</div>
						<div>
							<span><b>Phòng khám:</b></span>
							<span>Phòng khám số 1</span>
						</div>
						<div>
							<span><b>Dịch vụ:</b></span>
							<span>Dịch vụ số 1</span>
						</div>
						<div id="bk_dentist_info">
							<span><b>Nha sỹ chỉ định điều trị:</b></span>
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ve chung toi-01.png" alt="NHA SỸ">
							<span>Nguyễn Văn A<button type="button"  class="btn_quest" >?</button></span>
						</div>
							<div class="col-md-12">
								<button type="button" class="btn btn_green col-md-12">Chỉnh sửa</button>
							</div>
					</div>
				</div>
				<div class="col-md-8">
					<form action="" method="get" accept-charset="utf-8" class="form-horizontal">
						<div class="col-md-12" id="bk_register_info">
							<h4 class="pl30">THÔNG TIN CỦA BẠN</h4>
							<div>
								<p style="padding-left: 50px">Tôi đã có tài khoản <a href="#" class="btn btn_green">Đăng nhập</a> / Chưa có tài khoản, vui lòng nhập thông tin</p>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4">Họ tên*</label>
								<div class="col-md-6">
									<input type="text" name="" value="" placeholder="" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4">Giới tính*</label>
								<div class="col-md-4">
									<select name="" class="form-control">
										<option value="">Nam</option>
										<option value="">Nữ</option>
									</select>
								</div>
							</div>
							<div class="form-group" id="no_arr">
								<label class="control-label col-md-4">Ngày tháng năm sinh*</label>
								<div class="col-md-4">
									<select name="" class="form-control col-md-1">
										<option value="">01</option>
										<option value="">02</option>
									</select>
									<select name="" class="form-control col-md-1">
										<option value="">01</option>
										<option value="">02</option>
									</select>
									<select name="" class="form-control col-md-1">
										<option value="">2016</option>
										<option value="">2017</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4">Số điện thoại*</label>
								<div class="col-md-5">
									<input type="text" name="" value="" placeholder="" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4">Địa chỉ</label>
								<div class="col-md-8">
									<input type="text" name="" value="" placeholder="" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4">Ghi chú</label>
								<div class="col-md-8">
									<textarea name="" class="form-control"></textarea>
								</div>
							</div>
							<div class="line_dot col-md-8 pull-right"></div>
								<div class="row">
									<div class="col-md-8" id="bk_res_log">
										<div class="form-group">
											<label class="control-label col-md-6">Email*</label>
											<div class="col-md-6 bk_res_inp">
												<input type="text" name="" value="" placeholder="" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-6">Mật khẩu*</label>
											<div class="col-md-6 bk_res_inp">
												<input type="password" name="" value="" placeholder="" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-6">Nhập lại mật khẩu*</label>
											<div class="col-md-6 bk_res_inp">
												<input type="password" name="" value="" placeholder="" class="form-control">
											</div>
										</div>
									</div>
									<div class="col-md-4" id="bk_res_log_info">
										Nhập email và mật khẩu để tạo tài khoản, thông tin của bạn sẽ được lưu trự lại
									</div>	
								</div>
								<h4 class="pl30">Tình trạng sức khỏe:</h4>
								<div class="col-md-12" id="bk_health">
									<div class="col-md-6">
										<div class="col-md-12">
											<p>Ông (bà) có đang khỏe không?</p>
											<label class="radio-inline"><input type="radio" name="optradio">Có</label>
											<label class="radio-inline"><input type="radio" name="optradio">Không</label>
										</div>
										<div class="col-md-12">
											<p>Ông bà có đang trị bệnh ở bác sĩ nào không?</p>
											<label class="radio-inline"><input type="radio" name="optradio">Có</label>
											<label class="radio-inline"><input type="radio" name="optradio">Không</label>
										</div>
										<div class="col-md-12">
											<p>Ông (bà) hiện có uống thuốc gì không?</p>
											<label class="radio-inline"><input type="radio" name="optradio">Có</label>
											<label class="radio-inline"><input type="radio" name="optradio">Không</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="col-md-12">
											<p>Ông (bà) có bị phản ứng với thuốc tê hay thuốc nào không?</p>
											<label class="radio-inline"><input type="radio" name="optradio">Có</label>
											<label class="radio-inline"><input type="radio" name="optradio">Không</label>
										</div>
										<div class="col-md-12">
											<p>Ông (bà) có bệnh máu loảng không?</p>
											<label class="radio-inline"><input type="radio" name="optradio">Có</label>
											<label class="radio-inline"><input type="radio" name="optradio">Không</label>
										</div>
									</div>
								</div>
								<div class="col-md-12" id="bk_rule">
									<div class="checkbox">
										<label><input type="checkbox" value="">Tôi đồng ý với tất cả <a href="">Điều khoản dịch vụ</a></label>
									</div>
								</div>
							</div>
						<div class="col-md-12" style="margin: 15px">
							<!-- <button type="submit" class="btn btn_blue pull-right">TIẾP TỤC</button> -->
							<a href="<?php echo $baseUrl; ?>/index.php/book/verify_schedule" class="btn btn_blue pull-right">TIẾP TỤC</a>
						</div>
					</form>
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