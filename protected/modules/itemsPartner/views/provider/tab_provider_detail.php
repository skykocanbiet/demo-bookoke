<div class="customerProfileContainer">

	<div id="customerProfileDetail" class="customerProfileHolder" style="display: block;margin:30px auto;">

		<div class="row">

			<form class="col-md-3" id="imageUploader" enctype="multipart/form-data" style="margin:0px;">
				 <?php include("customer_image.php");?> 
			</form>

			<div class="col-md-9" style="line-height:120px;">
				<div class="configmouseout">
					<i class="delete_camera customer_delete_camera icon-remove-sign icon-2x" style="display:none;"></i>
				</div>
				<div style="line-height:0px; margin-top:30px;">
				<input onchange="updateProvider(<?php echo $model->Id;?>);" style=" margin-bottom:5px;"  onchange="updateCustomer(<?php echo $model->Id;?>);" type="text" class="customer_name yellow_hover blue_focus" value="<?php echo $model->Name;?>" id="fullname" name="fullname" placeholder="Họ tên" />
				
				
				</div>
			</div>

		</div>
		<hr>
 <ul id="customerDetailFormList">
 			<div class="col-md-2">
			 	<label class="detail_lable">Page URL</label> 
			 </div>
			
			<div class="col-md-10" style="display:inline-block;">
				<li>
				<div class="URL">
				<a class="link" style="font-size:12px;" href="<?php echo $model->link ?>"><?php echo $model->link ?></a><span>|</span> 
				<button type="button" class="btn btn-default btn-sm" id="EditURL" onclick="EditURL()"> 
          			<span class="glyphicon glyphicon-pencil"></span> EDIT
        		</button>
        		</div>
        		<input type="text" onchange="updateProvider(<?php echo $model->Id;?>);" class="yellow_hover blue_focus" value="<?php echo $model->link;?>" id="link" name="link" placeholder="URL Website" style="width:100%;">
				 </li>
                 
			</div>
			<div class="clearfix"></div>
			<hr style="" style="display:inline-block;">
			<div class="col-md-2">
			 	<label class="detail_lable">Mini website</label> 
			 </div>
			
			<div class="col-md-10" style="display:inline-block;">
				<li>
				<div class="Sub">

				<a class="sub" style="font-size:12px;" href="<?php echo $baseUrl;?>/<?php echo $data['sub_domain']; ?>/index.html"><?php echo $baseUrl;?>/<?php echo $data['sub_domain']; ?>/index.html</a><span>|</span>
				<a href="#demo" data-toggle="collapse"> 
				<button type="button" class="btn btn-default btn-sm" id="EditSub" onclick="EditSub()"> 
          			<span class="glyphicon glyphicon-pencil"></span> EDIT
        		</button>
        		</a>
        		</div>

				  <div id="demo" class="collapse">
				    <div class="input-group">
	  				<span class="input-group-addon yellow_hover blue_focus" id="basic-addon3">
	  					<?php echo $baseUrl;?>/
	  				</span>
	  				<input type="text" style="border-right-radius: 3px; border: solid 1px #ccc;" onchange="updateSubdomain(<?php echo $data['id']?>);" class="form-control" id="sub_domain" aria-describedby="basic-addon3" value="<?php echo $data['sub_domain'] ?>" >
					</div>
				 </div>
        		
                 
			</div>
			<div class="clearfix"></div>

			<hr style="" style="display:inline-block;">

			<div class="col-md-2">
			 	<label class="detail_lable">View maps</label> 
			 </div>
			 <div class="col-md-10" style="display:inline-block;">
			 	<li>
					<!--  -->
				
			    <label for="radio-1"  >ON</label>
			    <input type="radio" <?php if($model->Status =="1"){ echo "checked";} ?>  onchange="updateStatus(<?php echo $model->Id;?>);" name="radio-1" id="stt0">
			    <label for="radio-2">OFF</label>
			    <input type="radio" <?php if($model->Status =="0"){ echo "checked";} ?>  onchange="updateStatusOff(<?php echo $model->Id; ?>)" name="radio-1" id="stt1">
			    
			 
				
                 </li>
			 </div>
		<div class="clearfix"></div>
			<hr style="" style="display:inline-block;">
			<div class="col-md-2">
			 	<label class="detail_lable">Status</label> 
			 </div>
			 <div class="col-md-10" style="display:inline-block;">
			 	<li>
					<!--  -->
				<form action="">
			    <label for="Distance"  >Distance</label>
			    <input type="radio" <?php if($model->statushot =="0"){ echo "checked";} ?>  onchange="updateStatusDistance(<?php echo $model->Id;?>);" name="radio-1" id="stt0">
			    <label for="Featured">Featured</label>
			    <input type="radio" <?php if($model->statushot =="1"){ echo "checked";} ?>  onchange="updateStatusFeatured(<?php echo $model->Id; ?>)" name="radio-1" id="stt1">
			    
			 	<label for="Most">Most pupola</label>
			    <input type="radio" <?php if($model->statushot =="2"){ echo "checked";} ?>  onchange="updateStatusMost(<?php echo $model->Id; ?>)" name="radio-1" id="stt1">
				</form>
                 </li>
			 </div>
			<div class="clearfix"></div>

			<hr style="" style="display:inline-block;">
			 <div class="col-md-2">
			 	<label class="detail_lable">Contact Detail</label> 
			 </div>
			
			<div class="col-md-5" style="display:inline-block;">
				 <li>
				 	<div class="colunm1">
					<label class="fl">Hotline:</label>
					</div>
					 <div class="colunm2">                
					<input onchange="updateProvider(<?php echo $model->Id;?>);" type="text" placeholder="Tell" name="phone" id="phone" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $model->Phone;?>">   
					</div>                    
					<div class="clearfix"></div>
				</li>               
				                  
				<li>
					<div class="colunm1">

					<label class="fl">Office Phone:</label>
					</div>
					<div class="colunm2">
					<input  onchange="updateProvider(<?php echo $model->Id;?>);" type="text" placeholder="Home-Phone" name="phone" id="homephone" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $model->Home_Phone;?>"> </div>                      
					<div class="clearfix"></div>               
					<div class="clearfix"></div>
				</li>
				
				
			</div>                
			<div class="col-md-5" style="display:inline-block;">
				<li>
				<div class="colunm1">
					<label class="fl">Email:</label>
				</div>
				<div class="colunm2">
					<input  onchange="updateProvider(<?php echo $model->Id;?>);" type="email" value="<?php echo $model->Email;?>" placeholder="Email" name="email" id="email" class="custProfileInput yellow_hover blue_focus fl">
				</div>
					<div class="clearfix"></div>
				<li>
					<div class="colunm1">
					<label class="fl">Address:</label>
					</div>
					<div class="colunm2">
					<input  onchange="updateProvider(<?php echo $model->Id;?>);"  type="text" value="<?php echo $model->Address;?>" placeholder="Mã số" name="address" id="address" class="custProfileInput yellow_hover blue_focus fl">
					</div>
					<div class="clearfix"></div>
				</li>
				</li> 
				
				
			</div>
			<div class="col-md-2"></div>
			 <div class="col-md-10">
			 	
			 </div>
			<div class="clearfix"></div>

			<hr style="" style="display:inline-block;">
			<div class="col-md-2">
				<label class="detail_lable">Location Detail</label>
			</div>
			<div class="col-md-5">
				<li>
				<div class="colunm1">
					<label class="fl">Country</label>
				</div>
				<div class="colunm2">
					<?php
					$listdata = array();  
					if($model->Id){
						foreach($model->getCountry() as $temp){
							$listdata[$temp['code']] = $temp['country'];
						}
					} 
					echo CHtml::dropDownList('Id_Country','',$listdata,array('onchange'=>'updateProviderCountry('.$model->Id.');','class'=>'custProfileInput yellow_hover blue_focus fl','empty' => 'Country','options'=>array($model->Id_Country=>array('selected'=>true))));
					?> 
					</div>                      
					<div class="clearfix"></div>

				</li> 
				<li>
				<div class="colunm1">
					<label class="fl">City</label>
				</div>
				<div class="colunm2">
				<div id="city1">
					<?php
					$listdata = array();  
					if($model->Id){
						foreach($model->getCity1() as $temp){
							$listdata[$temp['id']] = $temp['name_long'];
						}
					} 
					echo CHtml::dropDownList('Id_City','',$listdata,array('onchange'=>'savecity('.$model->Id.');','class'=>'custProfileInput yellow_hover blue_focus fl','empty' => 'City','options'=>array($model->Id_City=>array('selected'=>true))));
					?>
					</div>
				</div>                       
					<div class="clearfix"></div>
				</li> 
				
			</div>
			<div class="col-md-5">
				<li>
					<div class="colunm1">

					<label class="fl">State</label>
					</div>
					<div class="colunm2">
					<div id="state1">
					<?php
					$listdata = array();  
					if($model->Id){
						foreach($model->getState() as $temp){
							$listdata[$temp['id']] = $temp['name_long'];
						}
					} 
					echo CHtml::dropDownList('Id_State','',$listdata,array('onchange'=>'updateCustomer('.$model->Id.');','class'=>'custProfileInput yellow_hover blue_focus fl','empty' => 'State','options'=>array($model->Id_State=>array('selected'=>true))));
					?> 
					</div>
					</div>                      
					<div class="clearfix"></div>
				</li>
				<li>
				<div class="colunm1">
					<label class="fl">Zipcode</label>
					</div>
					<div class="colunm2">
					<input onchange="updateCustomer(<?php echo $model->Id;?>);" type="text" placeholder="Zip-code" name="zipcode" id="zipcode" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $model->Zipcode;?>">
					</div>                       
					<div class="clearfix"></div>               
					
				</li>  
			</div>
			<div class="clearfix"></div>
			<hr style="" style="display:inline-block;">
		  <div class="col-md-2">
			 	<label class="detail_lable">Coordinates</label> 
			 </div>
			<div class="col-md-5" style="display:inline-block;">
				 <li>
				 	<div class="colunm1">
						<label class="fl">location X</label>
					</div>

					<div class="colunm2">                   
					<input onchange="updateProvider(<?php echo $model->Id;?>);"  type="text" placeholder="Tell" name="X" id="X" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $model->X;?>"> 
					</div>                      
					<div class="clearfix"></div>
				</li>               
				                  
				
				
				
			</div>  
			<div class="col-md-5" style="display:inline-block;">
				 <li>
				 <div class="colunm1">
					<label class="fl">location Y</label> 
				</div>
				<div class="colunm2">                  
					<input onchange="updateProvider(<?php echo $model->Id;?>);"  type="text" placeholder="Tell" name="Y" id="Y" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $model->Y;?>"> 
				</div>                      
					<div class="clearfix"></div>
				</li>                
				
			</div>   
			<div class="clearfix"></div> 
			<hr style="" style="display:inline-block;">
		  <div class="col-md-2">
			 	<label class="detail_lable">Description</label> 
			 </div>
			<div class="col-md-10" style="display:inline-block;">
				 <li style="margin-right:0px;">
					 <textarea class="form-control" rows="5" id="comment"></textarea>               
					<!-- <input onchange="updateCustomer(<?php echo $model->Id;?>);" type="text" placeholder="Tell" name="phone" id="phone" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $model->X;?>">                       
					<div class="clearfix"></div> -->
				</li>               
				                  
				
				
				
			</div>
						<div class="clearfix"></div> 
                  
		</ul>  
				

		
	</div>
</div>
<style type="text/css">
	
#customerProfileDetail input[type="text"] {
    transition: none;
    box-shadow: none;
    margin-top: 0px;
    margin-bottom: 0px;
    }
.customerProfileHolder ul li .custProfileInput {
     margin-left: 0px;
    font-size: 14px;
    position: relative;
    padding: 5px;
    /* width: 220px; */
    width: 100% !important;
     border-radius: 3px;
     margin-left: 10px;

}
#customerDetailFormList label {
    font-size: 12px;
    margin-bottom: 0;
    text-align: right;
}
.customer_name {
	width: 96%;
}
.detail_lable{
	margin-top: 10px;
	font-weight: normal;
	
}
.colunm1{
	width: 30%;
	float:left;
}
.colunm2{
	width: 70%;
	float: right;

}
.on{
	display: block;
	background-color: #dff6f5;
	border-radius: 10px;
	width: 116px;
	font-size: 13px
}
#customerDetailFormList .on label{
	padding: 10px;
}
.off{
	display: none;
}
#link{
	display: none;
}
</style>
<script type="text/javascript">
$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();
    var customer_action = $(".customersActionHolder").height();  
    var customer_search = $(".customerSearchHolder").height();

    $('#profileSideNav').height(windowHeight-header);

    $('.statsTabContent').height(windowHeight-header-tab_menu-45);     

    $('#customerList').css('max-height', windowHeight-header-customer_action-customer_search-80);

});
$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();
    var customer_action = $(".customersActionHolder").height();  
    var customer_search = $(".customerSearchHolder").height();

    $('#profileSideNav').height(windowHeight-header);

    $('.statsTabContent').height(windowHeight-header-tab_menu-45);     

    $('#customerList').css('max-height', windowHeight-header-customer_action-customer_search-80);
});



</script> 
