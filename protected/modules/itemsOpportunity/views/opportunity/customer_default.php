<!-- Customer Information -->

<div class="customerDetailsContainer">
    <div id="oSrchBar" class="col-md-12">
	    <form class="form-inline">
	        <div id="oSrchRight" class="col-md-8">
	        <div class="form-group">
	            <label >Ngày</label>
	            <select name="" class="form-control">
	                <option value="">Tất cả</option>
	                <option value="">Hôm nay</option>
	                <option value="">7 ngày trước</option>
	                <option value="">Tháng trước</option>
	            </select>
	        </div>	       
	        <div class="form-group">
	            <label >Nhân viên:</label>
	            <select name="" class="form-control">
	                <option value="">Bùi Thị Mỹ Linh</option>
	         </select>
	        </div>
	        <div class="input-group">
	              <input type="text" class="form-control" id="exampleInputAmount" placeholder="Tìm kiếm">
	              <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
	        </div>
	        </div>
	        <div id="oSrchLeft" class="pull-right">   
	        	<div class="pipelineActions" style="margin-top:4px;">
	        	<?php include_once('_frm_search_deal_opportunity.php') ?>
	        	</div>		        	
	        	<a class="btn_plus" id="modal_add_new_deal" href="#modalAddNewDeal" role="button" data-toggle="modal"></a>
	        </div>
	        
	    </form>
	</div>	

	<div class="statsTabContent tabContentHolder" >

		<?php include("dealopportunity.php");?>

    </div>

</div>


