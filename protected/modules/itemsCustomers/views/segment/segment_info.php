<div class="customerDetailsContainer">
    
	<!-- tabs -->
	<div id="tabcontent" class="tabbable">

	  <ul class="nav nav-tabs menuTabDetail">
	    <li class="active"><a href="#tab_list" data-toggle="tab">Danh sách</a></li>
	    <li><a href="#tab_description" data-toggle="tab">Mô tả</a></li>
	  </ul>

	  <div class="tab-content">
	    <div class="tab-pane active" id="tab_list">
	    	<div class="statsTabContent tabContentHolder" >
	        	<?php include('tab_list.php') ?>
	        </div>
	    </div>
		
	    <div class="tab-pane" id="tab_description">
	    	<div class="statsTabContent tabContentHolder" >
	        	<?php include('tab_description.php')  ?>
	        </div>
	    </div>	  
	    

	   </div>
	</div>
	<!-- /tabs -->

</div>


