<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <?php
    $cs  = Yii::app()->getClientScript();
    $cs->registerCssFile(Yii::app()->baseUrl.'/css/font-awesome/css/font-awesome.min.css'); 

    $cs->registerCssFile(Yii::app()->baseUrl.'/dist/css/AdminLTE.css');
    $cs->registerCssFile(Yii::app()->baseUrl.'/dist/css/skins/_all-skins.min.css'); 
    $cs->registerCssFile(Yii::app()->baseUrl.'/assets_admin/iCheck/flat/blue.css'); 

    $cs->registerCssFile(Yii::app()->baseUrl.'/assets_admin/morris/morris.css'); 
    $cs->registerCssFile(Yii::app()->baseUrl.'/assets_admin/jvectormap/jquery-jvectormap-1.2.2.css'); 
    $cs->registerCssFile(Yii::app()->baseUrl.'/assets_admin/datepicker/datepicker3.css');
    $cs->registerCssFile(Yii::app()->baseUrl.'/assets_admin/daterangepicker/daterangepicker-bs3.css');
    $cs->registerCssFile(Yii::app()->baseUrl.'/assets_admin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');

    Yii::app()->clientScript->registerCoreScript('jquery.ui');
    ?>

    <?php  //include_once('notifications.php'); ?>
</head>

<body class="skin-blue">

    <div class="wrapper">
    	
    	<!-- HEADER -->
	   	<header class="main-header">
	        <!-- Logo -->
	        <a href="<?php echo Yii::app()->baseUrl;?>/index.php/admin/index" class="logo"><b>Admin</b>NhaKhoa2000</a>
	        <!-- Header Navbar: style can be found in header.less -->
	        <nav class="navbar navbar-static-top" role="navigation">
	          <!-- Sidebar toggle button-->
	          <a href="<?php echo Yii::app()->baseUrl;?>/index.php/admin/index" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	            <span class="sr-only">Toggle navigation</span>
	          </a>
	          <div class="navbar-custom-menu">
	            <ul class="nav navbar-nav">

	              <!-- Messages: style can be found in dropdown.less-->
	              <li class="dropdown messages-menu">
	                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                  <i class="fa fa-envelope-o"></i>
	                  <span class="label label-success">0</span>
	                </a>
	                <ul class="dropdown-menu">
	                  <li class="header">You have 0 messages</li>
	                  <li class="footer"><a href="#">See All Messages</a></li>
	                </ul>
	              </li>

	              <!-- Notifications: style can be found in dropdown.less -->
	              <li class="dropdown notifications-menu">
	                <?php include_once('sidebar-notification.php'); ?>
	              </li>

	              <!-- User Account: style can be found in dropdown.less -->
	              <li class="dropdown user user-menu">
	                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/user2-160x160.png" class="user-image" alt="User Image"/>
	                  <span class="hidden-xs"><?php echo Yii::app()->user->user_name;?></span>
	                </a>
	                <ul class="dropdown-menu">
	                  <!-- User image -->
	                  <li class="user-header">
	                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/user2-160x160.png" class="img-circle" alt="User Image" />
	                    <p>
	                      <?php echo Yii::app()->user->user_name;?> - Web Developer
	                      <small>Member since Nov. 2016</small>
	                    </p>
	                  </li>
	                  <!-- Menu Footer-->
	                  <li class="user-footer">
	                    <div class="pull-left">
	                      <a href="#" class="btn btn-default btn-flat">Profile</a>
	                    </div>
	                    <div class="pull-right">
	                      <a href="<?php echo Yii::app()->baseUrl;?>/index.php/admin/logout" class="btn btn-default btn-flat">Sign out</a>
	                    </div>
	                  </li>
	                </ul>
	              </li>

	            </ul>
	          </div>
	        </nav>
	    </header>

	    <!-- SIDEBAR LEFT -->
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<?php include_once('sidebar-left.php'); ?>
		</aside>
		<!-- /.sidebar -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper" style="padding: 25px;">
			<?php echo $content; ?>
		</div><!-- /.content-wrapper -->

		<footer class="main-footer">
	        <div class="pull-right hidden-xs">
	          <b>Version</b> 2.0
	        </div>
	        <strong>Copyright &copy; 2016-2017 <a href="http://dev.wintegrate.com/bookoke/">BookOke</a>.</strong> All rights reserved.
	    </footer>

    </div>
    <!-- /#wrapper -->


	<script>
	$.widget.bridge('uibutton', $.ui.button);
	</script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<?php 
	/** Morris.js charts **/
	//$cs->registerScriptFile(Yii::app()->baseUrl.'/assets_admin/morris/morris.min.js',CClientScript::POS_END);  

	/** Sparkline **/  
	$cs->registerScriptFile(Yii::app()->baseUrl.'/assets_admin/sparkline/jquery.sparkline.min.js',CClientScript::POS_END);

	/** jvectormap **/  
	$cs->registerScriptFile(Yii::app()->baseUrl.'/assets_admin/jvectormap/jquery-jvectormap-1.2.2.min.js',CClientScript::POS_END);
	$cs->registerScriptFile(Yii::app()->baseUrl.'/assets_admin/jvectormap/jquery-jvectormap-world-mill-en.js',CClientScript::POS_END);

	/** jQuery Knob Chart  **/
	$cs->registerScriptFile(Yii::app()->baseUrl.'/assets_admin/knob/jquery.knob.js',CClientScript::POS_END);

	/** daterangepicker  **/
	$cs->registerScriptFile(Yii::app()->baseUrl.'/assets_admin/daterangepicker/daterangepicker.js',CClientScript::POS_END);

	/** datepicker  **/
	$cs->registerScriptFile(Yii::app()->baseUrl.'/assets_admin/datepicker/bootstrap-datepicker.js',CClientScript::POS_END);

	/**  Bootstrap WYSIHTML5  **/
	$cs->registerScriptFile(Yii::app()->baseUrl.'/assets_admin/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',CClientScript::POS_END);

	/**  iCheck  **/
	$cs->registerScriptFile(Yii::app()->baseUrl.'/assets_admin/iCheck/icheck.min.js',CClientScript::POS_END);

	/**  Slimscroll  **/    
	$cs->registerScriptFile(Yii::app()->baseUrl.'/assets_admin/slimScroll/jquery.slimscroll.min.js',CClientScript::POS_END);

	/**  FastClick  **/
	$cs->registerScriptFile(Yii::app()->baseUrl.'/assets_admin/fastclick/fastclick.min.js',CClientScript::POS_END);

	/**  AdminLTE App **/
	$cs->registerScriptFile(Yii::app()->baseUrl.'/dist/js/app.min.js',CClientScript::POS_END);

	/**  AdminLTE App **/
	$cs->registerScriptFile(Yii::app()->baseUrl.'/dist/js/pages/dashboard.js',CClientScript::POS_END);

	/**  AdminLTE for demo purposes **/
	$cs->registerScriptFile(Yii::app()->baseUrl.'/dist/js/demo.js',CClientScript::POS_END);

	?>

</body>
</html>
