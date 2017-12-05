<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="Content-Security-Policy" content="block-all-mixed-content">
    
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/logo-line-white.png"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bookoke.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/select2/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jAlert.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />


	<!--End Chat_test:Thành-->
    <?php
    $cs  = Yii::app()->getClientScript();
    $cs->registerCssFile(Yii::app()->baseUrl.'/css/font-awesome/css/font-awesome.min.css'); 
    $cs->registerCssFile(Yii::app()->baseUrl.'/css/admin/tab.css');
    Yii::app()->clientScript->registerCoreScript('jquery.ui');
    ?>

    <script src='<?php echo Yii::app()->request->baseUrl; ?>/js/select2/select2.full.min.js'></script>
   
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/moment.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/moment-with-locales.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/autoNumeric.js" type="text/javascript"></script>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jAlert.min.js" type="text/javascript"></script>
    <script src='<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datetimepicker.min.js'></script>

</head>
<body>

	<style>
	/* pop up */
	.popHead {
		background: #e6e6e5;
		color: #5a5a5a;
	}
	/* button */
	.btn:hover {
		color: white;
	}
	.btn_bookoke{
		background: #7cc9ac !important;
		color: white;
	}
	.btn_bookoke:hover {
		background: #48b64e !important;
		color: white;
	}
	.btn_unactive, .btn_cancel {
		background: #c0bfbf;
		color: white;
	}
	.btn_unactive {
		cursor: not-allowed !important;
	}
	.cal-loading {
		  position: fixed;
		  left: 0px;
		  top: 0px;
		  width: 100%;
		  height: 100%;
		  z-index: 9999;
		  background: url('../../images/icon_sb_left/loading.gif') 50% 40% no-repeat rgba(221,221,221,0.5);
		  background-size: 5% auto;
	 }
		#mn_nav .navbar {border: 0; background: #2e363e; border-radius: 0;}
		#mn_nav ul.menuMain li a {color: #737271; padding-bottom: 13px; font-size: 14px;text-transform: capitalize;}
		#mn_nav ul.menuMain  li a:hover {color: #46c649;}
		#mn_ad ul.menuMain  li {margin-right: 5px;}
		#mn_nav .navbar-default .navbar-nav>.open>a, #mn_nav .navbar-default .navbar-nav>.open>a:focus, #mn_nav .navbar-default .navbar-nav>.open>a:hover {background: transparent; color: #46c649;}

		#mn_nav  #headerMenu .dropdown-menu {right: 0; left:auto;  border-radius: 0;color: white;}

		#mn_nav #headerMenu .dropdown-menu li a {color: white;}
		ul.nav li.dropdown:hover > ul.dropdown-menu {display: block;}
		#mn_nav #headerMenu .dropdown-menu>li>a:focus, #mn_nav #headerMenu .dropdown-menu>li>a:hover {background: #94c63f; color: white;}

		#mn_nav #mn_ad .dropdown-menu {background: #fff;}
		#mn_nav #mn_ad .dropdown-menu>li>a {color: black;}

		#mn_ad .dropdown-menu, #mn_ad .dropdown-menu>li>a:focus,#mn_ad .dropdown-menu>li>a:hover {background: #e6e6e5;color: black;}
		
		#mn_nav ul.menuMain li .active {color: #46c649;}

		#mn_nav ul.menuMain li a:hover{
			color: #46c649 !important;
		}

		#mn_ad .dropdown-menu>li>a:focus,
		#mn_ad .dropdown-menu>li>a:hover {
		    color: #46c649;
		    text-decoration: none;
		    background-color: #fff;
		}

		.dropdown-multi {
		    width: 415px;
		}

		#oSrchLeft .menu-export li{
			border-top: none;
		}
		#oSrchLeft .menu-export{
			min-width: 96px;
		}

		/* custom inclusion of right, left and below tabs */

		.tabs-below > .nav-tabs,
		.tabs-right > .nav-tabs,
		.tabs-left > .nav-tabs {
		  border-bottom: 0;
		}

		.tab-content > .tab-pane,
		.pill-content > .pill-pane {
		  display: none;
		}

		.tab-content > .active,
		.pill-content > .active {
		  display: block;
		}

		.tabs-below > .nav-tabs {
		  border-top: 1px solid #ddd;
		}

		.tabs-below > .nav-tabs > li {
		  margin-top: -1px;
		  margin-bottom: 0;
		}

		.tabs-below > .nav-tabs > li > a {
		  -webkit-border-radius: 0 0 4px 4px;
		     -moz-border-radius: 0 0 4px 4px;
		          border-radius: 0 0 4px 4px;
		}

		.tabs-below > .nav-tabs > li > a:hover,
		.tabs-below > .nav-tabs > li > a:focus {
		  border-top-color: #ddd;
		  border-bottom-color: transparent;
		}

		.tabs-below > .nav-tabs > .active > a,
		.tabs-below > .nav-tabs > .active > a:hover,
		.tabs-below > .nav-tabs > .active > a:focus {
		  border-color: transparent #ddd #ddd #ddd;
		}

		.tabs-left > .nav-tabs > li,
		.tabs-right > .nav-tabs > li {
		  float: none;
		}

		.tabs-left > .nav-tabs > li > a,
		.tabs-right > .nav-tabs > li > a {
		  min-width: 74px;
		  margin-right: 0;
		  margin-bottom: 3px;
		}

		.tabs-left > .nav-tabs {
		  float: left;
		  margin-right: 19px;
		  border-right: 1px solid #ddd;
		}

		.tabs-left > .nav-tabs > li > a {
		  margin-right: -1px;
		  -webkit-border-radius: 4px 0 0 4px;
		     -moz-border-radius: 4px 0 0 4px;
		          border-radius: 4px 0 0 4px;
		}

		.tabs-left > .nav-tabs > li > a:hover,
		.tabs-left > .nav-tabs > li > a:focus {
		  border-color: #eeeeee #dddddd #eeeeee #eeeeee;
		}

		.tabs-left > .nav-tabs .active > a,
		.tabs-left > .nav-tabs .active > a:hover,
		.tabs-left > .nav-tabs .active > a:focus {
		  border-color: #ddd transparent #ddd #ddd;
		  *border-right-color: #ffffff;
		}

		.tabs-right > .nav-tabs {
		  float: right;
		  margin-left: 19px;
		  border-left: 1px solid #ddd;
		}

		.tabs-right > .nav-tabs > li > a {
		  margin-left: -1px;
		  -webkit-border-radius: 0 4px 4px 0;
		     -moz-border-radius: 0 4px 4px 0;
		          border-radius: 0 4px 4px 0;
		}

		.tabs-right > .nav-tabs > li > a:hover,
		.tabs-right > .nav-tabs > li > a:focus {
		  border-color: #eeeeee #eeeeee #eeeeee #dddddd;
		}

		.tabs-right > .nav-tabs .active > a,
		.tabs-right > .nav-tabs .active > a:hover,
		.tabs-right > .nav-tabs .active > a:focus {
		  border-color: #ddd #ddd #ddd transparent;
		  *border-left-color: #ffffff;
		}
		#mn_nav #headerMenu .dropdown-menu>li>a:hover {
		    color: #262626;
		    text-decoration: none;
		    background-color: #f5f5f5;
		}
		#activity_notification_list .watched{
			background-color: rgba(204, 204, 204, 0.21);
		}

		#activity_notification_list_holder {
			padding: 5px 0px;
			border-bottom: 1px solid rgba(204, 204, 204, 0.21);
		}

		#activity_notification_list{
			list-style: none;
		  	margin: 0px !important;
		    padding: 0px  !important;
			max-height: 425px;
			width: 330px;
			overflow-y: auto !important;
		}
		#activity_notification_list li{
			cursor: pointer;
			padding: 0px 15px;
			color: #ccc;
		}

		#activity_notification_header{
			text-align: left;
			padding: 10px 25px !important;
		    border-bottom: 2px solid #E4EBF1;
		    background:#e6e6e5 !important;
		    color: #5a5a5a !important;
			font-size: 15px;
		    font-family: inherit;

		}

		.label_bookoke{
			padding: 0.4em 0.5em;
			float: right;
		}

		.label_sch_hoantat{
			background-color: rgb(102, 134, 157);
			
		}
		.label_notworking{
			background-color: rgb(180, 180, 180);
		}

		.label_sch_moi{
			background-color: rgb(89, 179, 90);
		}

		.label_sch_khongden{
			background-color: rgb(150, 80, 80);
		}

		.label_sch_daden{
			background-color: rgb(59, 179, 168);
		}

		.label_sch_vaokham{
			background-color: rgb(8, 100, 170);
		}

		.label_sch_bove{
			background-color: rgb(160, 130, 100);
		}
	
		.label_sch_huy{
			background-color: rgb(219, 189, 90);
		}
		

		

		.activity_icon img {
			width: 30px;
			height: auto;
		}

		.activity_icon .create{
		    color: rgb(89, 179, 90) !important;
		}
		.activity_icon .update {
		    color: rgb(59, 179, 168) !important;
		}
		.activity_icon .delete {
		    color: #ED6060 !important;
		}

		.table-boooke tbody tr td{
			border-top: 1px solid #fff !important;
		}
		.background-color-f1f5f6{
			background-color: #f1f5f6 !important;
		}
		.background-color-fff{
			background-color: #fff !important;
		}


		/* call-animation-css*/
		.call-animation {
		    background: #fff;
		    width: 50px;
		    height: 50px;
		    position: relative;
		    margin: 0 auto;
		    border-radius: 100%;
		    border: solid 5px #fff;
		    animation: play 2s ease infinite;
		    -webkit-backface-visibility: hidden;
		    -moz-backface-visibility: hidden;
		    -ms-backface-visibility: hidden;
		    backface-visibility: hidden;
		  
		}
		 .img-circle {
		 	cursor: pointer;
		    width: 50px;
		    height: 50px;
		    border-radius: 100%;
		    position: absolute;
		    left: -5px;
		    top: -5.6px;
		    }
		@keyframes play {

		    0% {
		        transform: scale(1);
		    }
		    15% {
		        box-shadow: 0 0 0 5px rgba(97, 203, 235, 0.4);
		    }
		    25% {
		        box-shadow: 0 0 0 10px rgba(97, 203, 235, 0.4), 0 0 0 20px rgba(97, 203, 235, 0.2);
		    }
		    25% {
		        box-shadow: 0 0 0 15px rgba(97, 203, 235, 0.4), 0 0 0 30px rgba(97, 203, 235, 0.2);
		    }

		}
		.btn_plus{
			height: 30px;
    		width: 30px;
			float: right;
			cursor: pointer;
			background: url('<?php echo Yii::app()->baseUrl; ?>/images/icon_add/add-def.png');
			background-size: 100%;
	   		background-repeat: no-repeat;
		}
		.btn_plus:hover{
			height: 30px;
    		width: 30px;
			float: right;
			cursor: pointer;
			background: url('<?php echo Yii::app()->baseUrl; ?>/images/icon_add/add-act.png');
			background-size: 100%;
	   		background-repeat: no-repeat;
		}
		.btn_bookoke_w{
			width: 98px;
		}
		.btn_w{
			width: 86px;
		}
		.btn_material_w{
			width: 93px;
		}
		.btn_delete {
			background: #C0BFBF;
			color: white;
		}
		#icon_logo{
			padding: 7px;
			margin-left:10px;
		}
		#icon_logo img{
			width:35px;
		}
		@media (min-width: 768px)
		{
				#mn_nav ul.menuMain li a{
					padding: 15px 8px;
					font-size: 13px;

				}
				#icon_logo{
					margin-left:0px;
					padding: 8px 7px;
				}
				#icon_logo img{
					width:30px;
				}
		}
		@media (min-width: 1200px)
		{
				#mn_nav ul.menuMain li a{
					padding: 15px 9px;
					font-size: 14px;
				}
				#icon_logo{
					margin-left:5px;
				}
		}
		@media (min-width: 1400px)
		{
				#mn_nav ul.menuMain li a{
					padding: 15px 10px;
					font-size: 15px;
				}
				#icon_logo{
					margin-left:10px;
				}
		}

		#sumBoxNotification{
			display: inline-block;
		    position: absolute;
		    background-color: #c52626;
		    color: #fff;
		    line-height: 15px;
		    text-align: center;
		    top: 7px;
		    left: 5px;
		    border-radius: 15%;
		    font-size: 11px;
		    padding: 2px 5px;
		}

		.navbar .nav>li>a:hover {
		    color: #46c649 !important;
		    text-decoration: none;
		}

	</style>
	<div id="ring-call"></div>

	<div class="cal-loading"></div>
	<div class="container-fluid" id="mn_nav">
		<div id="headerMenu" class="row">
			<nav class="navbar navbar-default">
	
			    <!-- Brand and toggle get grouped for better mobile display -->
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse" id="navbar-collapse">
				    	<ul class="nav navbar-nav">
				    		<li><a href="#" id="icon_logo" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo-line-white.png" alt="" ></a></li>
				    	</ul>
				      <ul class="nav navbar-nav menuMain">

				        <li><a href="<?php echo Yii::app()->baseUrl.'/itemsDashBoard/DashBoardBusiness/index'; ?>" title="" class="<?php if(Yii::app()->controller->id == 'dashBoardBusiness'){ echo "active"; } ?>">Tổng quan<span class="sr-only">(current)</span></a></li>
				        
				        <li><a href="<?php echo Yii::app()->baseUrl.'/itemsSchedule/calendar/index'; ?>" title="" class="<?php if(Yii::app()->controller->id == 'calendar'){ echo "active"; } ?>">Lịch hẹn</a></li>

				        <li>
				        	<a href="<?php echo Yii::app()->baseUrl.'/itemsCustomers/Accounts/admin'; ?>" class="<?php if(Yii::app()->controller->module->id == 'itemsCustomers' ){ echo "active"; } ?>" >Khách hàng</a>
				        </li>
				     <!--     <li>
				        	<a href="<?php echo Yii::app()->baseUrl.'/itemsPartner/company/view'; ?>" class="<?php if(Yii::app()->controller->module->id == 'itemsPartner' ){ echo "active"; } ?>" >Đối tác</a>
				        </li> -->
				        <li>
				        	<a href="<?php echo Yii::app()->baseUrl.'/itemsUsers/Notifications/View'; ?>" class="<?php 
				        	if( Yii::app()->controller->module->id ==  'itemsUsers' && ( Yii::app()->controller->id == 'notifications' || Yii::app()->controller->id == 'sms' || Yii::app()->controller->id == 'chat' ) ){ echo "active"; } ?>" >Hoạt động</a>
				        </li>
				        <li>
				        	<a href="<?php echo Yii::app()->baseUrl.'/itemsSales/quotations/view'; ?>" class="<?php if(Yii::app()->controller->module->id == 'itemsSales'){ echo "active"; } ?>">Kinh doanh</a>
				        </li>
				        <li>
				        	<a href="<?php echo Yii::app()->baseUrl.'/itemsProducts/ProductService/View'; ?>" class="<?php if(Yii::app()->controller->module->id == 'itemsProducts'){ echo "active"; } ?>">Hàng hóa</a>
				        </li>
				        <li>
					        <a href="<?php echo Yii::app()->baseUrl.'/itemsAccounting/Payable/Index'; ?>" class="
					        <?php 
					        if(Yii::app()->controller->id == 'payable' || Yii::app()->controller->id == 'receivable' || Yii::app()->controller->id == 'cashflow'){ echo "active"; } 

					        ?>">Tài chính</a>
				        </li>
				        <li>
				        	<a href="<?php echo Yii::app()->baseUrl.'/itemsUsers/Staff/View'; ?>" class="<?php if(Yii::app()->controller->module->id  == 'itemsUsers' && Yii::app()->controller->id == 'staff' ){ echo "active"; } ?>">Nhân sự</a>
				        </li>
				        <li>
				        	<a href="<?php echo Yii::app()->baseUrl.'/itemsReports/reportingBusiness/View'; ?>" class="<?php if(Yii::app()->controller->module->id == 'itemsReports'){ echo "active"; } ?>">Báo cáo</a>
				        </li>
				        <li>
				        	<a href="<?php echo Yii::app()->baseUrl.'/itemsSetting/SettingLocations/View'; ?>" class="<?php if(Yii::app()->controller->module->id == 'itemsSetting'){ echo "active"; } ?>">Thiết lập</a>
				        </li>

				      </ul>
				      
				      <ul class="nav navbar-nav navbar-right" id="mn_ad">
				      	<li class="dropdown">
						    

						     <ul class="dropdown-menu dropdown-alerts" style="padding: 0;width: 332px;" >

						    	<div id="activity_notification_header">
							    	<span>THÔNG BÁO</span> 
							    	<span style="float:right;"> 
							    		<a style="cursor: pointer; " onclick="allWatchNoti(2);">Xem tất cả </a>
							    	</span>
							    </div>

						    	<ul  id="activity_notification_list">
							      	<?php 
							      	$CsNotifications 	= new CsNotifications;
							      	$list_notifications	= $CsNotifications->getUserListNotifications(Yii::app()->user->getState('user_id'));
							      	$sumNotification 	= $CsNotifications->getSumNotificationsNotSeen(Yii::app()->user->getState('user_id'));

							      	foreach ($list_notifications as $v){
							      		$data= json_decode($v['data']);
							      	?>
								      	<?php if($v['flag']==0){ ?>
							            <li id="notification_sch<?php echo $v['id']; ?>" class="<?php  if($v['id_user']){ echo 'watched'; } ?>" >
							            	
							            	<div id="activity_notification_list_holder" onclick="showNotifications(<?php  echo $v['id']; ?>,<?php echo $data->id; ?>);">

							            		<?php if($v['action']=="add" ){ ?>
							            			<div style=" float: left;width:100%; color: #333;">
								                        <div style="margin-bottom: 2px;">
								                        	<span style="font-size: 14px;"><?php if($data->status == 0){ echo "Không làm việc"; }else{ echo $data->fullname;} ?></span>
								                        	<span style="text-align: right;float: right;font-size: 11px;">
								                        		<em></em>
								                        		<input type="hidden" class="createdate_noti" value="<?php echo $v['creatdate']; ?>"/>
								                        	</span>
								                        </div>
								                         <p style="font-size: 12px;margin:0px;line-height: 19px;">
								                         	<span><strong>Bác Sĩ:</strong> <?php echo $data->name_dentist; ?></span><br/>
											                <span><?php  echo date("Y/m/d",strtotime($data->start_time)) ;?></span>
											                <span><?php echo date("h:i",strtotime($data->start_time)); ?>-<?php echo date("h:i",strtotime($data->end_time)); ?></span>
											                <?php 

											                if($data->status == '-2'){
											                	echo '<span class = "label label_bookoke label_sch_khongden">Không đến</span>';
											                }

											                if($data->status == '-1'){
											                	echo '<span class = "label label_bookoke label_sch_huy">Hủy hẹn</span>';
											                }

											                if($data->status == 0){
											                	echo '<span class = "label label_bookoke label_notworking">Không làm việc</span>';
											                }

											                if($data->status == 1){
											                	echo '<span class = "label label_bookoke label_sch_moi">Lịch mới</span>';
											                }

											                if($data->status == 2){
											                	echo '<span class = "label label_bookoke label_sch_daden">Đã đến</span>';
											                }

											                if($data->status == 3){
											                	echo '<span class = "label label_bookoke label_sch_vaokham">Vào khám</span>';
											                }

											                if($data->status == 4){
											                	echo '<span class = "label label_bookoke label_sch_hoantat">Hoàn tất</span>';
											                }

											                if($data->status == 5){
											                	echo '<span class = "label label_bookoke label_sch_hoantat">Bỏ về</span>';
											                }


											                ?>
											                
								                        </p>

							                    	</div>
							            		<?php } ?>

							            		<?php if($v['action']=="update"){ ?><!-- 
							            			<div class="activity_icon" style="float: left;width: 30px;font-size: 24px;margin-top: 10px;margin-right: 12px;" >
							            				<img src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/noti-lich-moi.png">
							            			</div> -->
							            			<div style=" float: left;width:100%;color: #333;">
								                        <div style="margin-bottom: 2px;">
								                        	<span style="font-size: 14px;"><?php echo $data->fullname; ?></span>
								                        	<span style="text-align: right;float: right;font-size: 11px;">
								                        		<em></em>
								                        		<input type="hidden" class="createdate_noti" value="<?php echo $v['creatdate']; ?>"/>
								                        	</span>
								                        </div>
								                         <p style="font-size: 12px;margin:0px;line-height: 19px;">
								                        	<span><strong>Bác Sĩ:</strong> <?php echo $data->name_dentist; ?></span><br/>
											                <span><?php  echo date("Y/m/d",strtotime($data->start_time)) ;?></span>
											                <span><?php echo date("h:i",strtotime($data->start_time)); ?>-<?php echo date("h:i",strtotime($data->end_time)); ?></span>
											                <?php 

											                if($data->status == '-2'){
											                	echo '<span class = "label label_bookoke label_sch_khongden">Không đến</span>';
											                }

											                if($data->status == '-1'){
											                	echo '<span class = "label label_bookoke label_sch_huy">Hủy hẹn</span>';
											                }

											                if($data->status == 0){
											                	echo '<span class = "label label_bookoke label_notworking">Không làm việc</span>';
											                }

											                if($data->status == 1){
											                	echo '<span class = "label label_bookoke label_sch_moi">Lịch mới</span>';
											                }

											                if($data->status == 2){
											                	echo '<span class = "label label_bookoke label_sch_daden">Đã đến</span>';
											                }

											                if($data->status == 3){
											                	echo '<span class = "label label_bookoke label_sch_vaokham">Vào khám</span>';
											                }

											                if($data->status == 4){
											                	echo '<span class = "label label_bookoke label_sch_hoantat">Hoàn tất</span>';
											                }

											                if($data->status == 5){
											                	echo '<span class = "label label_bookoke label_sch_hoantat">Bỏ về</span>';
											                }


											                ?>
								                        </p>
							                    	</div>
							            		<?php } ?>

							                    <div class="clearfix"></div>
								            </div>

							            </li>
							            <?php } ?>
						       		<?php } ?>
					            </ul>
					            
					            <div>
					            	 <a class="text-center" href="<?php echo Yii::app()->getBaseUrl(); ?>/itemsUsers/Notifications/View">
					                    <h5>Xem thông báo <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></h5>
					                </a>
					            </div>
						    </ul>

						    <a class="dropdown-toggle icon_vsc" data-toggle="dropdown" href="#">
						        <i class="fa fa-bell fa-fw"></i>
						        <span id="sumBoxNotification" ><?php echo $sumNotification; ?></span>
						        <input id="sumNotification" type="hidden"  value="<?php echo $sumNotification; ?>">
						        <i class="fa fa-caret-down"></i>
						    </a>

						    <!-- /.dropdown-alerts -->
						</li>
				        <li class="dropdown" id="info_user">
					        <a class="dropdown-toggle icon_vsc" data-toggle="dropdown" href="#" style="font-size:17px;">
					            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
					        </a>
					        <ul class="dropdown-menu dropdown-user">
					            <li>
					            	<input type="text" name="username_login" id="username_login" value="<?php echo Yii::app()->user->getState('user_name');?>" style="display: none;">
					            	<?php $avatar_img = GpUsers::model()->findByPK(Yii::app()->user->getState('user_id')); ?>
					            	<input type="text" name="avatar_login" id="avatar_login" value="<?php echo $avatar_img['image'];?>" style="display: none;">
						            <!-- <a href="#"><i class="fa fa-user fa-fw"></i>
						            	<?php //echo Yii::app()->user->getState('user_name');?>
						            </a> -->
						            <div id="jsxc_personal">
						            </div>
					            </li>
					            <li>
						            <a id='logout_chat' href="<?php echo Yii::app()->baseUrl;?>/index.php/">
						            <i class="fa fa-sign-out fa-fw"></i> Đăng Xuất</a>
					            </li>
					        </ul>
					        <!-- /.dropdown-user -->
					    </li>

				      </ul>

				    </div><!-- /.navbar-collapse -->
			</nav>
		</div>
		<?php echo $content; ?>

	</div>	

	<?php include_once('notifications.php');?>

	<div class="updateEventAllLayout"></div>
	
</body>
