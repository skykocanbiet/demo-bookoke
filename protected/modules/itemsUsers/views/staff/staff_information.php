<style type="text/css">
	#tabcontent {
    	padding: 30px 30px 0px 30px;
	}
</style>
<?php $baseUrl = Yii::app()->baseUrl;?>

<!-- Customer Information -->
<div class="customerDetailsContainer">
    
	<!-- tabs -->
	<div id="tabcontent" class="tabbable">
	  <ul class="nav nav-tabs">

	    <li class="active"><a href="#tab_information" data-toggle="tab">Hồ sơ</a></li>
	    <li><a href="#tab_agenda" data-toggle="tab">Lịch làm việc</a></li>
	    <li><a href="#tab_goal" data-toggle="tab">Chỉ tiêu</a></li>
	    <li><a href="#tab_performance" data-toggle="tab">Hiệu suất</a></li>
	    <li><a href="#tab_compensation" data-toggle="tab">Chấm công</a></li>
	  </ul>
	  <div class="tab-content">
	    <div class="tab-pane active" id="tab_information">
	      <?php include("staff_detail.php"); ?>
	      <!-- <p style="margin-top:15px;">Đang cập nhật chỉ tiêu</p> -->
	    </div>
		
	    <div class="tab-pane row" id="tab_agenda">
	     	<?php include("staff_working_hours.php"); ?>
	    </div>
		
	    <div class="tab-pane" id="tab_goal">
			<?php include("staff_goal.php"); ?>		
	    </div>

	    <div class="tab-pane" id="tab_performance">
	       	<div class="no-data" style="display: table-cell; vertical-align: middle;text-align: center;">
				<div style="text-align: center;">
					<img src="<?php yii::app()->request->baseUrl; ?>/images/no-data.png" style="width:200px; height: auto;"><br>
					<p style="color: #464646; font-size: 15px;">Đang chờ cập nhật dữ liệu !</p>
				</div>
			</div>
	    </div>

	    <div class="tab-pane" id="tab_compensation">
	      	<div class="no-data" style="display: table-cell; vertical-align: middle;text-align: center;">
				<div style="text-align: center;">
					<img src="<?php yii::app()->request->baseUrl; ?>/images/no-data.png" style="width:200px; height: auto;"><br>
					<p style="color: #464646; font-size: 15px;">Đang chờ cập nhật dữ liệu !</p>
				</div>
			</div>
	    </div>

	   </div>
	</div>
	<!-- /tabs -->

</div>
<script type="text/javascript">
$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .nav-tabs").height();

    // $('#profileSideNav').height(windowHeight-header);

    $('#content_tab_agenda').height(windowHeight-header-tab_menu-36);
     $('#content_tab_information').height(windowHeight-header-tab_menu-36);
    

    var w_ct  = $("#tabcontent").width();
    var h_ct  = $("#detailCustomer").height();
    
    $('#tabcontent .no-data').css('width',w_ct); 
    $('#tabcontent .no-data').css('height',h_ct-90);
    
});
$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .nav-tabs").height();

    // $('#profileSideNav').height(windowHeight-header);

    $('#content_tab_agenda').height(windowHeight-header-tab_menu-36);
    $('#content_tab_information').height(windowHeight-header-tab_menu-36);


    var w_ct  = $("#tabcontent").width();
    var h_ct  = $("#detailCustomer").height();
    
    $('#tabcontent .no-data').css('width',w_ct); 
    $('#tabcontent .no-data').css('height',h_ct-90);

});
</script>
