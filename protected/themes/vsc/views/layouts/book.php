<?php $baseUrl = Yii::app()->getBaseUrl(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="en">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- main.css -->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/book.css">

		
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>

<body>

<div id="page">
	<div id="header">
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Logo NK 2000_color-01.png" alt="" class="full_size">
				</div>
				<!-- <div class="col-md-6 pull-right" id="head">
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
				</div> -->
				<div class="pull-right" id="bk_menu">
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
									<li><a href="<?php echo $baseUrl ?>/index.php/">TRANG CHỦ</a></li>
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
	</div>
	<div class="content">
		<?php echo $content; ?>
	</div>

	
	<div id="menu_ft">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="col-md-5">
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
					<div class="col-md-7 pl0">
						<p>DỊCH VỤ & HỖ TRỢ</p>
						<ul class="list-unstyled">
							<li><a href="">Hệ thống bệnh viện</a></li>
							<li><a href="">Hướng dẫn khám bệnh</a></li>
							<li><a href="">Hướng dẫn đặt lịch</a></li>
							<li><a href="">Câu hỏi thường gặp</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-4" id="mv_line">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/A1Yt_rrsOgA" frameborder="0" allowfullscreen class="size_90"></iframe>
				</div>
				<div class="col-md-4">
					<p>Đăng kí email để nhận nhiều ưu đãi từ Nha Khoa 2000</p>
					<form action="" method="get" accept-charset="utf-8" class="form-inline">
						<input type="text" name="" value="" placeholder="Nhập email" class="form-control">
						<button class="btn btn_black">OK</button>
					</form>
					<div id="social">
						<span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/fb-act.png" alt=""></span>
						<span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/youtube-def.png" alt=""></span>
						<span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/google-def.png" alt=""></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		Dentist  &copy; 2016. Privacy Policy
	</div>
</div>
</body>
</html>