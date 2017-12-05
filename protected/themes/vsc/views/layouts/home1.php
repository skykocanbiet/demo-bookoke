<?php 	$baseUrl = Yii::app()->getBaseUrl(); 

		$controller = Yii::app()->getController()->getAction()->controller->id;
       	$action     = Yii::app()->getController()->getAction()->controller->action->id;

      	$lang = Yii::app()->request->getParam('lang','');
	        if($lang == ''){
	            $lang =  'vi';
	        }
        Yii::app()->setLanguage($lang);
?>
<style>
.dropdown {
    position: relative !important;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #FFF;
    /*min-width: 200px;*/
	z-index:1;
	width: 200px;
	color:#000;
	/*text-align:left;*/
	
}
.dropdown:hover .dropdown-content {
    display: block;
}
.dropdown-content ul{
	/*background-color: #ffffff !important;*/
	padding: 0px !important;

}
.dropdown-content ul li{
	background-color: #ffffff !important;
	float: left !important;
}

.dropdown-content ul li a{
	color: #919190 !important;
	float: left;
	padding: 10px 0px !important;
	background-color: #ffffff !important;
}
ul.menu-footer{	
	list-style: none inside;
	margin-bottom: 0px;
	padding: 5px 0px;
}
ul.menu-footer li{
	display: inline-block;
	padding: 0px 10px;
}
ul.menu-footer li a{
	color: #ffffff;
}
/*  .active{
  color: #a11c4a !important;
}*/
</style>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="en">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- main.css -->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/home.css">
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/animate.css">

		<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/Logo-NK-2000.png"/>
		 <?php Yii::app()->controller->widget('ext.seo.widgets.SeoHead',
	        array(
	        	'defaultKeywords'    => "Nha Khoa 2000, Kĩ thuật Nha Khoa , Nha Khoa Hiện Đại, Cơ sở vật chất Nha Khoa , Nha Khoa Nhi, Chăm Sóc Răng Miệng, Sản Phẩm Nha Khoa,...",
	            'defaultDescription' => "Nha Khoa 2000 - You Smile , We Smile",  
	        )
    	); ?>
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>

		<!-- Add mousewheel plugin (this is optional) -->
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
		<!-- Add fancyBox -->
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
		<!-- Optionally add helpers - button, thumbnail and/or media -->
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/wow.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.elevatezoom.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jssor.slider-21.1.6.min.js" type="text/javascript"></script>


		<!--  -->
		<!-- bxSlider Javascript file -->
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.bxslider.js"></script>
		<!-- bxSlider CSS file -->
		<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.bxslider.css" rel="stylesheet" />
		<!-- momentjs -->
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/moment-with-locales.js" type="text/javascript"></script>
		<!-- GOOGLE MAP -->
		

		

		<script type="text/javascript">
			$(document).ready(function(){
				
				$('.language-site').change(function(){
					var lang = $(this).val();
					var baseUrl = <?php echo json_encode($baseUrl); ?>;
					var controller = <?php echo json_encode($controller); ?>;
					var action = <?php echo json_encode($action); ?>;
					var link = baseUrl+'/index.php/'+controller+'/'+action+'/lang/'+lang+'/';
					window.location.href = link;
				});

				if($('#login-customer-modal div').length == 0){
					if($("#name_customer").length > 0){
						return false;
					}else{
						jQuery.ajax({ type:"POST",
						    url:"<?php echo CController::createUrl('home/login')?>",
						    datatype:'json',
						    success:function(data){
						        if(data){
						            $("#login-customer-modal").html(data);
						        }
						    },
						    error: function(data) {
						        alert("Error occured.Please try again!");
						    },
						    cache: false,
						    contentType: false,
						    processData: false
						});

					}
					
				}

				new WOW().init();

				$("#call").hover(function(){
					$(this).animate({ right: "0px" });}, 
					function() {
					$(this).animate({ right: "-195px" });
				});

			});
		</script>
		
</head>

<body >

<div id="page">
<!-- HEAD -->
<div id="call" style="background-color: #94c640; height: 50px; width:250px;display:block; position: fixed;right: -190px; top: 120px; border-top-left-radius: 25px; border-bottom-left-radius: 25px ;">
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/call-24.png" alt="" style="width: 40px;margin-top: 5.5px;margin-left: 7px;">
		<div style=" color: #fff;position: absolute;top:2px;left: 60px;font-size: 13px;"><b>Worldwide</b> (+1) 714 587 2789</div>
      <div style="color: #ffffff; position: absolute;top:20px;left: 60px;font-size: 13px"><b>Việt Nam</b> (08) 39 255 634</div>
	</div>
	<div id="header">
		<div class="container">
			<div class="row margin-default">
				<!-- LOGO-->
				<div class="col-xs-3 hidden-xs col-sm-3 col-md-3 margin-top-10 padding-default">
					<a href="<?php echo $baseUrl; ?>/index.php/"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Logo NK 2000_color-01.png" alt="" style="    width: 85%;" class="img-responsive"></a>
				</div> 
				
				<!-- SETTING INFO -->
				<div class="col-xs-8 hidden-xs col-sm-9 col-md-9 margin-top-10 padding-default">
					<div  id="head">
						<ul class="list-inline">
							<li class="bounce" data-wow-duration="1s" data-wow-delay="5s" data-wow-iteration="5" style="margin-right: 20px;animation-iteration-count: infinite;
    visibility: visible;
    animation-duration: 1s;
    animation-delay: 5s;
    animation-name: bounce;"><a href="<?php echo $baseUrl; ?>/book/index" class="btn_book"><?php echo Yii::t('translate','booking'); ?></a></li>
							<li style="margin-right: 20px;">
								<ul class="list-inline" id="log">
								<?php if(isset(Yii::app()->session['guest']) && Yii::app()->session['guest'] == false) { ?>

									<li><a id="name_customer" href="<?php echo $baseUrl; ?>/profile">Hi, <?php echo yii::app()->user->getState('customer_name'); ?></a></li>
									<li><a  href="<?php echo $baseUrl; ?>/home/logout">Đăng xuất</a></li>	
								<?php }else{ ?>
									<li><a href="<?php echo $baseUrl; ?>/register"><?php echo Yii::t('translate','register'); ?></a></li>
									<li><a href="#" data-toggle="modal" data-target="#login-customer-modal"><?php echo Yii::t('translate','login') ?></a></li>
								<?php } ?>
								</ul>
							</li>
							<li>	
								<div class="" style="padding-left: 0px;padding-right: 0px">
									<select name="" class="language-site">
									<?php $val = array('vi' => 'Tiếng Việt'); 
										foreach ($val as $key => $value) {
											echo "<option value='$key'";
											if ($lang == $key) {
												echo "selected";
											}
											echo ">$value</option>";
										}
									?>
								</select>
								</div>
							</li>
							
						</ul>
					</div>
				</div> 

				<!-- MENU -->
				<div class="col-xs-12 col-sm-12 col-md-9 margin-top-10 padding-default">
							<nav class="navbar navbar-default box_menu">
							<div class="navbar-header">
							    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
							    	<span class="icon-bar"></span>
							        <span class="icon-bar"></span>
							        <span class="icon-bar"></span>                        
							    </button>
							    <div class="logo-mobile hidden-sm hidden-md hidden-lg">
										<a href="<?php echo $baseUrl; ?>/index.php/"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Logo NK 2000_color-01.png" alt="" class="img-responsive"></a>
								</div>
								<div class="clear"></div>
							</div>

							<div class="collapse navbar-collapse " id="myNavbar">
								<ul id="menu" class="nav navbar-nav">
								    
				                  
				                  <li >  <?php if ($lang == 'vi') { ?>
			                              <a style="padding-right: 30px;" href="<?php echo $baseUrl; ?>/contact/" <?php if ($controller == 'contact') echo 'class="menu-active"'; ?> >
			                           <?php }else if($lang == 'en'){ ?>
			                              <a style="padding-right: 30px;" href="<?php echo $baseUrl; ?>/contact/" <?php if ($controller == 'contact') echo 'class="menu-active"'; ?> >
			                           <?php } ?>
			                           <?php echo Yii::t('translate','contact'); ?> </a>
				                  </li>
				                  <li>
                       				<?php if ($lang == 'vi') { ?>
		                              <a href="<?php echo $baseUrl; ?>/faq/" <?php if ($controller == 'faq') echo 'class="menu-active"'; ?> >
		                           <?php }else if($lang == 'en'){ ?>
		                              <a href="<?php echo $baseUrl; ?>/faq/" <?php if ($controller == 'faq') echo 'class="menu-active"'; ?> >
		                           <?php } ?>
		                           <?php echo Yii::t('translate','advisory'); ?> </a>
                       			</li>
				                  <li>  <?php if ($lang == 'vi') { ?>
			                              <a href="<?php echo $baseUrl; ?>/tin-tuc/" <?php if ($controller == 'news') echo 'class="menu-active"'; ?> >
			                           <?php }else if($lang == 'en'){ ?>
			                              <a href="<?php echo $baseUrl; ?>/news/" <?php if ($controller == 'news') echo 'class="menu-active"'; ?> >
			                           <?php } ?>
			                           <?php echo Yii::t('translate','news'); ?> </a>
				                  </li>
				                  <li>  <?php if ($lang == 'vi') { ?>
			                              <a href="<?php echo $baseUrl; ?>/dich-vu" <?php if ($controller == 'service') echo 'class="menu-active"'; ?> >
			                           <?php }else if($lang == 'en'){ ?>
			                              <a href="<?php echo $baseUrl; ?>/service" <?php if ($controller == 'service') echo 'class="menu-active"'; ?> >
			                           <?php } ?>
			                           <?php echo Yii::t('translate','service'); ?> </a>
				                  </li>
				                  <li>  <?php if ($lang == 'vi') { ?>
			                              <a href="<?php echo $baseUrl; ?>/gioi-thieu" <?php if ($controller == 'introduce') echo 'class="menu-active"'; ?> >
			                           <?php }else if($lang == 'en'){ ?>
			                              <a href="<?php echo $baseUrl; ?>/introduce" <?php if ($controller == 'introduce') echo 'class="menu-active"'; ?> >
			                           <?php } ?>
			                           <?php echo Yii::t('translate','introduce'); ?> </a>
				                  </li>
				                  <li>  <?php if ($lang == 'vi') { ?>
			                              <a href="<?php echo $baseUrl; ?>/trang-chu/" <?php if ($controller == 'home') echo 'class="menu-active"'; ?> >
			                           <?php }else if($lang == 'en'){ ?>
			                              <a href="<?php echo $baseUrl; ?>/home/" <?php if ($controller == 'home') echo 'class="menu-active"'; ?> >
			                           <?php } ?>
			                           <?php echo Yii::t('translate','home'); ?> </a>
				                  </li>
								 <li id="box_w" class="hidden-xs"></li>	
								</ul>
					    	</div>
						</nav>

				</div> 

			</div>
			
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="content" id="body_content">
		<?php echo $content; ?>
	</div>
	<!-- <hr style="margin-bottom: 0px"> -->
	<div class="clearfix"></div>
	<div id="footer" class="col-xs-12">
		<div class="col-xs-12 col-sm-6 text_footer" style="padding: 5px 0px;">Nha Khoa 2000  &copy; 2016. Privacy Policy</div>
		<div class="col-xs-12 col-sm-6" style="padding: 0px;">
			<ul class="menu-footer text_footer">
	          <li>  <?php if ($lang == 'vi') { ?>
	                  <a href="<?php echo $baseUrl; ?>/khuyen-mai" >
	               <?php }else if($lang == 'en'){ ?>
	                  <a href="<?php echo $baseUrl; ?>/promotion" >
	               <?php } ?>
	               <?php echo Yii::t('translate','promotion'); ?> </a>
	          </li>
	          <li>  <?php if ($lang == 'vi') { ?>
	                  <a href="<?php echo $baseUrl; ?>/mua-sam" >
	               <?php }else if($lang == 'en'){ ?>
	                  <a href="<?php echo $baseUrl; ?>/shop" >
	               <?php } ?>
	               <?php echo Yii::t('translate','shopping'); ?> </a>
	          </li>
	          <li>  <?php if ($lang == 'vi') { ?>
	                  <a href="<?php echo $baseUrl; ?>/career">
	               <?php }else if($lang == 'en'){ ?>
	                  <a href="<?php echo $baseUrl; ?>/career" >
	               <?php } ?>
	               <?php echo Yii::t('translate','job'); ?> </a>
	          </li>
			</ul>
		</div
	</div>
	<div class="clearfix"></div>
</div>
<!-- LOGIN MODAL -->
<div class="modal fade" id="login-customer-modal" role="dialog" >

</div>

<!-- Modal HTML -->
<div id="VideoModal" class="modal fade">
    <div class="modal-dialog padding-top-video">
        <div class="modal-content">
            <div class="modal-body">
               	<div id="iframeVideo" style="width:100%;height:auto;min-height:300px;"></div>
            </div>
        </div>
    </div>
</div>

<script>
	function email()
	{
		var reg_mail = /^[A-Za-z0-9]+([_\.\-]?[A-Za-z0-9])*@[A-Za-z0-9]+([\.\-]?[A-Za-z0-9]+)*(\.[A-Za-z]+)+$/;
		var email = $('#send_email').val();
		if(email=="")
		{
			alert("Vui lòng nhập email!");
			document.forms['form_email'].send_email.focus();
		}
		else if(reg_mail.test(email)==false)
		{
			alert("Email này không hợp lệ! vui lòng nhập lại");
			document.forms['form_email'].send_email.focus();
		}
		else{
			$.ajax({
				type : "POST",
				url  : "<?php echo CController::createUrl('home/sendemail') ?>",
				data : {
					  "email"     : email,
				},
				success : function(data)
				{
					alert(data);
				},
				complete : function()
				{
					$('#send_email').val("");
				}
			});
		}
	}
</script>
<script>

var a = $("#menu").offset().top;

$(document).scroll(function(){
		if($(this).scrollTop() > a){   
			$('#menu li a').css({"background-color":"#FFF"});
			$('#menu li ').css({"background-color":"#FFF"});
			$('#menu li a').css({"color":"#2d2d2d"});
			$('#menu .menu-active').css({'box-shadow':" inset 0px -3px 0px  rgb(25, 168, 224)"});
			$('#header').css({"position":"fixed"});
			
		}else{
			
			$('#menu li ').css({"background-color":"rgb(25, 168, 224)"});
			$('#menu li a').css({"background-color":"#19a8e0"});
			$('#menu li a').css({"color":"white"});
			$('#menu .menu-active').css({'box-shadow':"inset 0px -3px 0px #FFF"});
			$('#header').css({"position":"relative"});
		}
});

</script>


</body>
</html>