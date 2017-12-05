<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="en">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/css/reset.css">
		
		<!-- bootstrap -->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/bootstrap/css/bootstrap.min.css" media="screen, projection">

		<!-- main.css -->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/css/main.css">

  		<script language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/js/jquery-2.2.4.min.js"></script>
  		<!-- 	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->
		
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>

<body>
<div class="container-fluid">
	<div class="row" id="header">
		<div class="pull-left" style="margin-left: 10%; width: 15%;">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/Logo NK 2000_color-01.png" alt="" class="size_img">
		</div>
		<div class="pull-right" id="head" style="margin-right: 12%; width: 50%;">
			<ul class="list-inline pull-right">
				<li><button>ĐẶT LỊCH KHÁM</button></li>
				<li>
					<ul class="list-inline" id="log">
						<li><a href="">Đăng Ký</a></li>
						<li><a href="">Đăng Nhập</a></li>
					</ul>
				</li>
				<li>
					<select name="" >
						<option value="">Tiếng Việt</option>
					</select>
				</li>
			</ul>
		</div>
		<div class="pull-right" id="menu" style="width: 75%;">
			<div style="margin-right: 14%;">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="navbar-header">
						    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						    	<span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>                        
						    </button>
						</div>
				
						<div class="collapse navbar-collapse" id="myNavbar">
						    <ul class="nav navbar-nav navbar-right">
								<li><a href="">TRANG CHỦ</a></li>
								<li><a href="">GIỚI THIỆU</a></li>
								<li><a href="">KHUYẾN MÃI</a></li>
								<li><a href="">DỊCH VỤ</a></li>
								<li><a href="">MUA SẮM</a></li>
								<li><a href="">TIN TỨC</a></li>
								<li><a href="">NGHỀ NGHIỆP</a></li>
								<li><a href="">LIÊN HỆ</a></li>
							</ul>
				    	</div> 
				  	</div>
				</nav>
			</div>
		</div>	
	</div>
	<div class="row" id="banner">
		<div id="call"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/call-24.png" alt=""></div>
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/banner_01w.jpg" alt="" class="size_img">
	</div>
	<div class="row" id="intro">
		<div class="content">
			<div class="col-xs-5">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/Untitled-1.jpg" alt="" class="size_img">
			</div>
			<div class="col-xs-7" id="intro_text">
				<h2 class="text_green">Chào mừng bạn đến với</h2>
				<h2 class="text_green">NHA KHOA 2000</h2>
				<hr/>
				<div>
					Luôn quan tâm và thấu hiểu những nhu cầu về sức khỏe và thẩm mỹ. Nha khoa 2000 mang đến cho Quý khách sự chăm sóc răng miệng hàng đầu tại Việt Nam. Qua nhiều năm hoạt động đến nay. Nha Khoa 2000 luôn khẳng định vị trí tiên phong trong lĩnh vực nha khoa hiện đại: Nha Khoa Thẩm Mỹ, Nha Khoa Toàn Diện, Cấy ghép răng 	Implant.
				</div>
			</div>
		</div>
	</div>
	<div class="row" id="info">
		<div class="content">
			<div class="col-xs-12" style="margin-bottom: -60px;">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#chungtoi"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/ve chung toi-01.png" alt=""><h4>VỀ CHÚNG TÔI</h4></a></li>
					<li><a data-toggle="tab" href="#bacsi"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/doi ngu bs-01.png" alt=""><h4>ĐỘI NGŨ BÁC SĨ</h4></a></li>
					<li><a data-toggle="tab" href="#dichvu"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/chat luong dv-01.png" alt=""><h4>CHẤT LƯỢNG DỊCH VỤ</h4></a></li>
				</ul>

				<div class="tab-content">
					<div id="chungtoi" class="tab-pane fade in active">
						<div class="col-xs-7 info_text">
							<p>Luôn quan tâm và thấu hiểu những nhu cầu về sức khỏe và thẩm mỹ. Nha khoa 2000 mang đến cho Quý khách sự chăm sóc răng miệng hàng đầu tại Việt Nam. Qua nhiều năm hoạt động đến nay. Nha Khoa 2000 luôn khẳng định vị trí tiên phong trong lĩnh vực nha khoa hiện đại: Nha Khoa Thẩm Mỹ, Nha Khoa Toàn Diện, Cấy ghép răng Implant.</p>
							<button class="btn btn_green">XEM THÊM</button>
						</div>
						<div class="col-xs-5">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/ve chung toi-vuong.jpg" class="size_img" alt="">
						</div>
					</div>
					<div id="bacsi" class="tab-pane fade in">
						<div class="col-xs-7 info_text">
							<p>Luôn quan tâm và thấu hiểu những nhu cầu về sức khỏe và thẩm mỹ. Nha khoa 2000 mang đến cho Quý khách sự chăm sóc răng miệng hàng đầu tại Việt Nam. Qua nhiều năm hoạt động đến nay. Nha Khoa 2000 luôn khẳng định vị trí tiên phong trong lĩnh vực nha khoa hiện đại: Nha Khoa Thẩm Mỹ, Nha Khoa Toàn Diện, Cấy ghép răng Implant.</p>
							<button class="btn btn_green">XEM THÊM</button>
						</div>
						<div class="col-xs-5">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/doi ngu bs-vuong.jpg" class="size_img" alt="">
						</div>
					</div>
					<div id="dichvu" class="tab-pane fade in">
						<div class="col-xs-7 info_text">
							<p>Luôn quan tâm và thấu hiểu những nhu cầu về sức khỏe và thẩm mỹ. Nha khoa 2000 mang đến cho Quý khách sự chăm sóc răng miệng hàng đầu tại Việt Nam. Qua nhiều năm hoạt động đến nay. Nha Khoa 2000 luôn khẳng định vị trí tiên phong trong lĩnh vực nha khoa hiện đại: Nha Khoa Thẩm Mỹ, Nha Khoa Toàn Diện, Cấy ghép răng Implant.</p>
							<button class="btn btn_green">XEM THÊM</button>
						</div>
						<div class="col-xs-5">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/chat luong dv-vuong.jpg" class="size_img" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" id="bg_01"><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/bg_01.jpg" class="size_img" alt=""></div>
	<div class="row" id="hotro">
		<div class="content">
			<h3 class="text_green">CÁC DỊCH VỤ CHÚNG TÔI HỖ TRỢ</h3>
			<div class="col-xs-3 hotro_text">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/nha-khoa-tham-my.png" alt="" class="size_img">
				<p><b>NHA KHOA THẨM MỸ</b></p>
				<p>Áp dụng cho đối tượng ABC</p>
				<button class="btn btn_blue">TÌM HIỂU THÊM</button>
			</div>
			<div class="col-xs-3 hotro_text">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/nha-khoa-nhi.png" alt="" class="size_img">
				<p><b>NHA KHOA NHI</b></p>
				<p>Áp dụng cho đối tượng ABC</p>
				<button class="btn btn_blue">TÌM HIỂU THÊM</button>
			</div>
			<div class="col-xs-3 hotro_text">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/nha-khoa-du-lich.png" alt="" class="size_img">
				<p><b>NHA KHOA NHI</b></p>
				<p>Áp dụng cho đối tượng ABC</p>
				<button class="btn btn_blue">TÌM HIỂU THÊM</button>
			</div>
			<div class="col-xs-3 hotro_text">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/nha-khoa-dieu-tri.png" alt="" class="size_img">
				<p><b>NHA KHOA ĐIỀU TRỊ</b></p>
				<p>Áp dụng cho đối tượng ABC</p>
				<button class="btn btn_blue">TÌM HIỂU THÊM</button>
			</div>
		</div>
	</div>
	<div class="row" id="baiviet">
		<div class="content">
			<h3>BÀI VIẾT</h3>
			<div class="col-xs-6">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/tin-tuc-1.png" alt="" class="size_img">
				<h4>Lười vệ sinh răng miệng và những căn bệnh nguy hiểm khôn lường</h4>
				<p>Lười vệ sinh răng miệng không chỉ gây sâu răng, rụng răng, mà còn vô số bệnh,...</p>
				<button class="btn btn_blue">XEM THÊM</button>
			</div>
			<div class="col-xs-6">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/tin-tuc-2.png" alt="" class="size_img">
				<h4>Lười vệ sinh răng miệng và những căn bệnh nguy hiểm khôn lường</h4>
				<p>Lười vệ sinh răng miệng không chỉ gây sâu răng, rụng răng, mà còn vô số bệnh,...</p>
				<button class="btn btn_blue">XEM THÊM</button>
			</div>
		</div>
	</div>
	<div class="row" id="bg_02">
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/bg_02.jpg" alt="" class="size_img">
	</div>
	<div class="row" id="nhakhoa">
		<div class="content">
			<h3 class="text_green text_center">NHA KHOA 2000</h3>
			<div class="col-xs-6">
				<ul class="list-unstyled" id="time">
					<li><p><b>Thứ 2 đến thứ 7:</b></p>
						<ul class="list-unstyled" id="t27">
							<li><p>Sáng: 8h đến 12h</p></li>
							<li><p>Chiều 13h30 đến 20h</p></li>
						</ul>
					</li>
					<li><p><b>Chủ nhật, ngày lễ:</b> nghỉ</p>
				</ul>
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/olock.png" alt="" id="clock">	
			</div>
			<div class="col-xs-6" id="branch">
				<h3>CÁC CHI NHÁNH</h3>
				<ul class="list-unstyled">
					<li><b>Cơ sở 1:</b>
						<ul class="list-unstyled">
							<li>A36 Cống Quỳnh, P. Nguyễn Cư Trinh, Quận 1, TPHCM</li>
							<li>ĐT: 08 3925 5634 - 08 3925 2674</li>
						</ul>
					</li>
					<li><b>Cơ sở 2:</b>
						<ul class="list-unstyled">
							<li>502 Ngô Gia Tự, Phường 9, Quận 5, TPHCM</li>
							<li>ĐT: 08 3504 0421 - 08 3957 0304</li>
						</ul>
					</li>
				</ul>					
			</div>
			<div class="col-xs-6">
				<button class="btn btn_green col-xs-12">XEM QUY TRÌNH KHÁM BỆNH</button>
			</div>
			<div class="col-xs-6">
				<button class="btn btn_blue col-xs-12">CÂU HỎI THƯỜNG GẶP</button>
			</div>
		</div>
	</div>
	<div class="row" id="map">
		MAP
	</div>
	<div class="row" id="fb">
		<div class="content">
			<div class="col-xs-7">
				LOGO
				NHA KHOA 2000
				LIKE
				Bạn đã like trang này	
			</div>
			<div class="col-xs-5" id="form_lich">
				<div id="form_tt">ĐẶT LỊCH KHÁM</div>
				<form action="" method="get" accept-charset="utf-8">
					<div class="form-group">
						<input type="text" name="" value="" placeholder="Họ tên" class="form-control">
					</div>
					<div class="form-group">
						<input type="text" name="" value="" placeholder="Số điện thoại" class="form-control">
					</div>
					<div class="form-group">
						<input type="text" name="" value="" placeholder="Email" class="form-control">
					</div>
					<div class="form-group">
						<input type="text" name="" value="" placeholder="Giờ khám" class="form-control">
					</div>
					<div class="form-group">
						<textarea class="form-control" placeholder="Nội dung"></textarea>
					</div>
					<button class="btn btn_blue">GỬI</button>
				</form>
			</div>
		</div>
	</div>
	<div class="row" id="menu_ft">
		<div class="content">
			<div class="col-xs-4 borderr">
				<div class="col-xs-6 ">
					<p>VỀ CHÚNG TÔI</p>
					<ul class="list-unstyled">
						<li><a href="">Trang chủ</a></li>
						<li><a href="">GIới thiệu</a></li>
						<li><a href="">Dịch Vụ</a></li>
						<li><a href="">Mua Sắm</a></li>
						<li><a href="">Tin Tức</a></li>
						<li><a href="">Liên Hệ</a></li>
					</ul>
				</div>
				<div class="col-xs-6 pl0">
					<p>DỊCH VỤ & HỖ TRỢ</p>
					<ul class="list-unstyled">
						<li><a href="">Hệ thống bệnh viện</a></li>
						<li><a href="">Hướng dẫn khám bệnh</a></li>
						<li><a href="">Hướng dẫn đặt lịch</a></li>
						<li><a href="">Câu hỏi thường gặp</a></li>
					</ul>
				</div>
			</div>
			<div class="col-xs-4 borderr">
			VIDEO
			</div>
			<div class="col-xs-4">
				<p>Đăng kí email để nhận nhiều ưu đãi từ Nha Khoa 2000</p>
				<form action="" method="get" accept-charset="utf-8" class="form-inline">
					<input type="text" name="" value="" placeholder="Nhập email" class="form-control">
					<button class="btn btn_black">OK</button>
				</form>
				<div id="social">
					<span><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/fb-act.png" alt=""></span>
					<span><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/youtube-def.png" alt=""></span>
					<span><img src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/images/google-def.png" alt=""></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row" id="footer">
		Dentist  &copy; 2016. Privacy Policy
	</div>	
</div>

<script language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets_home/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>