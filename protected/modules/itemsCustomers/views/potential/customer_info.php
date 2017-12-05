<style type="text/css">


</style>
<!-- Customer Information -->

<div class="customerDetailsContainer">
    
	<!-- tabs -->
	<div id="tabcontent" class="tabbable">

	  <ul class="nav nav-tabs menuTabDetail">
	    <li class="active"><a href="#tab_medical_record" data-toggle="tab">Hồ sơ</a></li>
	    <li class=""><a href="#tab_medical_activity" data-toggle="tab">Hoạt động</a></li>
	      <li class=""><a href="#tab_medical_note" data-toggle="tab">ghi chú</a></li>
	  </ul>

	  <div class="tab-content">
	    <div class="tab-pane active" id="tab_medical_record">
	    	<div class="statsTabContent tabContentHolder" >
	        	<?php include('tab_medical_record.php') ?>
	        </div>
	    </div>
	    <div class="tab-pane" id="tab_medical_activity">
	    	<div class="statsTabContent tabContentHolder" >
	        	<?php include('tab_activity_history.php'); ?>
	        </div>
	    </div>
	    <div class="tab-pane" id="tab_medical_note">
	    	<div class="statsTabContent tabContentHolder" >
	        	<?php include('tab_activity_note.php'); ?>
	        </div>
	    </div>  
	   </div>
	</div>
	<!-- /tabs -->

</div>
<script type="text/javascript">
	$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();
    var customer_action = $(".customersActionHolder").height();    
    var customer_search = $(".customerSearchHolder").height();

    $('#profileSideNav').height(windowHeight-header);

    $('.tabContentHolder').height(windowHeight-header-tab_menu-45);   

    $('#customerList').css('max-height', windowHeight-header-customer_action-customer_search-80);
   
});
</script>
