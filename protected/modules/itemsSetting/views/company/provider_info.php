<!-- Customer Information -->

<div class="customerDetailsContainer">
    
	<!-- tabs -->
	<div id="tabcontent" class="tabbable">

	  <ul class="nav nav-tabs menuTabDetail">
	    <li class="active"><a href="#tab_medical_record" data-toggle="tab">Thông Tin</a></li>
	    <li><a href="#appointment_schedule" data-toggle="tab">Tài khoản</a></li><!-- 
	     <li><a href="#billing" data-toggle="tab">Billing</a></li>
	    <li><a href="#tab_treatment_history" data-toggle="tab">Function</a></li>
	    <li><a href="#tab_website" data-toggle="tab">Website</a></li> -->
	  </ul>

	  <div class="tab-content">
	    <div class="tab-pane active" id="tab_medical_record">
	    	<div class="statsTabContent tabContentHolder" >
	        	<?php include 'tab_provider_detail.php'; ?>
	        </div>
	    </div>
		
	    <div class="tab-pane" id="appointment_schedule">
	    	<div class="statsTabContent tabContentHolder" >
	    		<?php include 'accout.php'; ?>
	        </div>
	    </div>

<!-- 		
	    <div class="tab-pane" id="billing">
		    <div class="statsTabContent tabContentHolder" >
		    	<?php //include 'billing.php'; ?>
		    </div>
	        
	    </div>


	    <div class="tab-pane" id="tab_website">
	    	<div class="statsTabContent tabContentHolder" >
	        </div>
	    </div>

	    <div class="tab-pane " id="tab_hoivien">
	    	<div class="statsTabContent tabContentHolder" >
	        	
	        </div>
	    </div>

	    <div class="tab-pane" id="tab_note">
	    	<div class="statsTabContent tabContentHolder" >
		    	updating...
		        
	        </div>
	    </div>

	    <div class="tab-pane" id="tab_statistical">
	    	<div class="statsTabContent tabContentHolder" >
		    	updating...
		        
	        </div>
	    </div> -->

	   </div>
	</div>
	<!-- /tabs -->

</div>


