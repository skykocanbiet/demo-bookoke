
<div class="customerProfileContainer">

	<div id="customerProfileDetail" class="customerProfileHolder" style="display: block;margin:30px auto;">

		<div class="row">

			<form class="col-md-2" id="imageUploader" enctype="multipart/form-data" style="margin:0px;">
				 <?php  include("customer_image.php");  ?> 
			</form>
			
			<div class="col-md-10" style="line-height:120px;">
			<div class="col-md-6">
				<div class="configmouseout">
					<i class="delete_camera customer_delete_camera icon-remove-sign icon-2x" style="display:none;"></i>
				</div>

				<div style="line-height:0px; margin-top:30px;">
				<div class="colunm1 clearfix">
				<label class="f1" style="margin-top: 15px; text-align: right;">Name business:</label>
				</div> 
				<div class="colunm2">
				<input onchange="updateProvider(<?php echo $model->Id;?>);" style=" margin-bottom:5px; font-size: 20px !important; float:right;"  onchange="updateCustomer(<?php echo $model->Id;?>);" type="text" class="customer_name yellow_hover blue_focus" value="<?php echo $model->Name;?>" id="fullname" name="fullname" placeholder="Họ tên" />
				</div>
				<div class="colunm1 clearfix">
				<label class="f1" style="margin-top: 15px; text-align: right;">Mini website:</label>
				</div> 
				<div class="colunm2">
				<input type="text"   onchange="updateSubdomain(<?php echo $data['id']?>);"  class="customer_name yellow_hover blue_focus" id="fullname" aria-describedby="basic-addon3" value="<?php echo $data['sub_domain'] ?>" style="font-size:15px !important; float:right;" >
				</div>
				</div>
				</div>
				<div class="clearfix"></div>
				<hr style="border-style: dashed;">
			</div>

		</div>
		
 <ul id="customerDetailFormList">
 <div class="col-md-10" style="float:right;">
 			<!-- <div class="col-md-2">
			 	<label class="detail_lable">Mini website</label> 
			 </div>
			
			<div class="col-md-10" style="display:inline-block;">
				<li>
				
				    
	  				
	  				<label><?php echo $baseUrl;?>/</label>
	  				<input type="text"   onchange="updateSubdomain(<?php echo $data['id']?>);" lass="custProfileInput yellow_hover blue_focus fl" id="sub_domain" aria-describedby="basic-addon3" value="<?php echo $data['sub_domain'] ?>" >
					
				 </li>
        		
                 
			</div> -->
			<!-- <div class="clearfix"></div>
			<hr style="" style="display:inline-block;"> -->
<!--  			<div class="col-md-2">
			 	<label class="detail_lable">Page URL</label> 
			 </div>
			
			<div class="col-md-10" style="display:inline-block;">
				<li>
				
        		<input type="text" onchange="updateProvider(<?php echo $model->Id;?>);" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $model->link;?>" name="link" placeholder="URL Website" style="width:100%;">
				 </li>
                 
			</div>
			
			
			<div class="clearfix"></div>
			<hr style="" style="display:inline-block;">
			<div class="col-md-2">
			 	<label class="detail_lable">Trang Facebook </label> 
			 </div>
			
			<div class="col-md-10" style="display:inline-block;">
				<li>
				<div class="colunm1">

					<label class="fl"><?php echo "https://www.facebook.com/"?></label>
				</div>
				<div class="colunm2">
					<input type="text" onchange="updateProvider(<?php echo $model->Id;?>);" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $model->link;?>"  name="facebook" placeholder="URL Website" style="width:100%;">
				</div>
        		</li>
                 
			</div>
			<div class="clearfix"></div>
			<hr style="" style="display:inline-block;"> -->
			<div class="ct">
			 	<label class="detail_lable1">Danh mục kinh doanh </label> 
			 </div>
			
			<div class="col-md-6" style="display:inline-block;">
				<li>
					
        		
        		<div class="colunm1">

					<label class="fl">Doanh mục :</label>
					</div>
					<div class="colunm2">
						<select class="custProfileInput yellow_hover blue_focus fl">
							<option>Doanh mục kinh doanh</option>
						</select>
					</div>        
                </li> 
			</div>
			<div class="col-md-6" style="display:inline-block;">
				<li>
					
        		
        		<div class="colunm1">
        			
					<label class="fl">Tiền tệ :</label>
					</div>
					<div class="colunm2">
						
                                <select class="custProfileInput yellow_hover blue_focus fl">
                                     <option>Đơn vị tính</option>
                                 </select>
                           
					</div>        
                </li> 
			</div>
			

			<div class="clearfix"></div>

			<hr style="" style="display:inline-block;">
			 <div class="ct">
			 	<label class="detail_lable1">Chi tiết liên hệ</label> 
			 </div>
			
			<div class="col-md-6" style="display:inline-block;">
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
			<div class="col-md-6" style="display:inline-block;">
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
					<label class="fl">Địa chỉ:</label>
					</div>
					<div class="colunm2">
					<input  onchange="updateProvider(<?php echo $model->Id;?>);"  type="text" value="<?php echo $model->Address;?>" placeholder="Mã số" name="address" id="address" class="custProfileInput yellow_hover blue_focus fl">
					</div>
					<div class="clearfix"></div>
				</li>
				</li> 
				
				
			</div>
  
			
			<div class="clearfix"></div>

			<hr style="" style="display:inline-block;">
			<div class="ct">
				<label class="detail_lable1">Thiết lập khu vực</label>
			</div>
			<div class="col-md-6">
				<li>
				<div class="colunm1">
					<label class="fl">Quốc gia:</label>
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
					<label class="fl">Thành phố: </label>
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
				<li>
				<div class="colunm1">
					<label class="fl">Ngày giờ:</label>
					</div>
					<div class="colunm2">
					<input onchange="updateCustomer(<?php echo $model->Id;?>);" type="text" placeholder="Zip-code" name="zipcode" id="zipcode" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo date('m/d/Y H:i:s');?>">
					</div>                       
					<div class="clearfix"></div>               
					
				</li>
				
			</div>
			<div class="col-md-6">
				<li>
					<div class="colunm1">

					<label class="fl">Quận (huyện):</label>
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
					<label class="fl">Zipcode:</label>
					</div>
					<div class="colunm2">
					<input onchange="updateCustomer(<?php echo $model->Id;?>);" type="text" placeholder="Zip-code" name="zipcode" id="zipcode" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $model->Zipcode;?>">
					</div>                       
					<div class="clearfix"></div>               
					
				</li>
				<li>
				<div class="colunm1">
					<label class="fl">Múi giờ:</label>
					</div>
					<div class="colunm2">
						<select class="custProfileInput yellow_hover blue_focus fl">
							
						<option value="-1"></option>
						<option value="94">(GMT-12:00) International Date Line West</option>
						<option value="92">(GMT-10:00) Hawaii</option>
						<option value="91">(GMT-09:00) Alaska</option>
						<option value="89">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
						<option value="90">(GMT-08:00) Baja California</option>
						<option value="86">(GMT-07:00) Arizona</option>
						<option value="87">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
						<option value="88">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
						<option value="82">(GMT-06:00) Central America</option>
						<option value="83">(GMT-06:00) Central Time (US &amp; Canada)</option>
						<option value="84">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
						<option value="85">(GMT-06:00) Saskatchewan</option>
						<option value="79">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
						<option value="80">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
						<option value="81">(GMT-05:00) Indiana (East)</option>
						<option value="74">(GMT-04:00) Atlantic Time (Canada)</option>
						<option value="75">(GMT-04:00) Georgetown, La Paz, Manaus, San Juan</option>
						<option value="78">(GMT-04:00) Caracas</option>
						<option value="73">(GMT-03:50) Newfoundland</option>
						<option value="69">(GMT-03:00) City of Buenos Aires</option>
						<option value="70">(GMT-03:00) Cayenne, Fortaleza</option>
						<option value="71">(GMT-03:00) Greenland</option>
						<option value="72">(GMT-03:00) Montevideo</option>
						<option value="76">(GMT-03:00) Cuiaba</option>
						<option value="77">(GMT-03:00) Santiago</option>
						<option value="68">(GMT-02:00) Brasilia</option>
						<option value="65">(GMT-01:00) Azores</option>
						<option value="66">(GMT-01:00) Cabo Verde Is.</option>
						<option value="8">(GMT+00:00) Casablanca</option>
						<option value="9">(GMT+00:00) Dublin, Edinburgh, Lisbon, London</option>
						<option value="10">(GMT+00:00) Monrovia, Reykjavik</option>
						<option value="11">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
						<option value="12">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
						<option value="13">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
						<option value="14">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
						<option value="15">(GMT+01:00) West Central Africa</option>
						<option value="16">(GMT+02:00) Amman</option>
						<option value="17">(GMT+02:00) Athens, Bucharest</option>
						<option value="18">(GMT+02:00) Beirut</option>
						<option value="19">(GMT+02:00) Cairo</option>
						<option value="20">(GMT+02:00) Harare, Pretoria</option>
						<option value="21">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
						<option value="22">(GMT+02:00) Jerusalem</option>
						<option value="23">(GMT+02:00) Chisinau</option>
						<option value="24">(GMT+02:00) Windhoek</option>
						<option value="25">(GMT+03:00) Baghdad</option>
						<option value="26">(GMT+03:00) Kuwait, Riyadh</option>
						<option value="27">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
						<option value="28">(GMT+03:00) Nairobi</option>
						<option value="30">(GMT+03:50) Tehran</option>
						<option value="29">(GMT+04:00) Tbilisi</option>
						<option value="31">(GMT+04:00) Abu Dhabi, Muscat</option>
						<option value="32">(GMT+04:00) Baku</option>
						<option value="33">(GMT+04:00) Yerevan</option>
						<option value="34">(GMT+04:50) Kabul</option>
						<option value="35">(GMT+05:00) Ekaterinburg</option>
						<option value="36">(GMT+05:00) Islamabad, Karachi</option>
						<option value="37">(GMT+05:00) Ashgabat, Tashkent</option>
						<option value="38">(GMT+05:50) Chennai, Kolkata, Mumbai, New Delhi</option>
						<option value="39">(GMT+05:50) Sri Jayawardenepura</option>
						<option value="40">(GMT+05:75) Kathmandu</option>
						<option value="42">(GMT+06:00) Astana</option>
						<option value="43">(GMT+06:50) Yangon (Rangoon)</option>
						<option value="41">(GMT+07:00) Novosibirsk</option>
						<option selected="selected" value="44">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
						<option value="45">(GMT+07:00) Krasnoyarsk</option>
						<option value="46">(GMT+08:00) Beijing, Chongqing, Hong Kong SAR, Urumqi</option>
						<option value="47">(GMT+08:00) Irkutsk</option>
						<option value="48">(GMT+08:00) Kuala Lumpur, Singapore</option>
						<option value="49">(GMT+08:00) Perth</option>
						<option value="50">(GMT+08:00) Taipei</option>
						<option value="51">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
						<option value="52">(GMT+09:00) Seoul</option>
						<option value="53">(GMT+09:00) Yakutsk</option>
						<option value="55">(GMT+09:50) Darwin</option>
						<option value="56">(GMT+10:00) Brisbane</option>
						<option value="58">(GMT+10:00) Guam, Port Moresby</option>
						<option value="60">(GMT+10:00) Vladivostok</option>
						<option value="54">(GMT+10:50) Adelaide</option>
						<option value="57">(GMT+11:00) Canberra, Melbourne, Sydney</option>
						<option value="59">(GMT+11:00) Hobart</option>
						<option value="61">(GMT+11:00) Solomon Is., New Caledonia</option>
						<option value="62">(GMT+13:00) Auckland, Wellington</option>
						<option value="63">(GMT+13:00) Fiji</option>
						<option value="64">(GMT+13:00) Nuku'alofa</option>
						<option value="93">(GMT+14:00) Samoa</option>
						</select>
						
					</div>                       
					<div class="clearfix"></div>               
					
				</li>    
			</div>
			<div class="clearfix"></div>
			<hr style="" style="display:inline-block;">
		  <div class="ct">
			 	<label class="detail_lable1">Tọa độ địa lý</label> 
			 </div>
			<div class="col-md-6" style="display:inline-block;">
				 <li>
				 	<div class="colunm1">
						<label class="fl">Tọa độ X:</label>
					</div>

					<div class="colunm2">                   
					<input onchange="updateProvider(<?php echo $model->Id;?>);"  type="text" placeholder="Tell" name="X" id="X" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $model->X;?>"> 
					</div>                      
					<div class="clearfix"></div>
				</li>               
				                  
				
				
				
			</div> 
			 <div class="col-md-6">
				 <li>
				 <div class="colunm1">
					<label class="fl">Tọa độ Y:</label> 
				</div>
				<div class="colunm2">                  
					<input onchange="updateProvider(<?php echo $model->Id;?>);"  type="text" placeholder="Tell" name="Y" id="Y" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $model->Y;?>"> 
				</div>                      
					<div class="clearfix"></div>
				</li>                
				
			</div>   
			<div class="col-md-12" style="display:inline-block;">
			
			<div class="clearfix"></div> 
			<hr style="" style="display:inline-block;">
		  <div class="ct">
			 	<label class="detail_lable1">Ghi chú</label> 
			 </div>
			<div class="col-md-12" style="display:inline-block;">
				 <li style="margin-right:0px;">
					 <textarea class="form-control" rows="5" id="comment"></textarea>               
					
				</li>               
				                  
				
				
				
			</div>
						<div class="clearfix"></div> 
           </div>       
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
