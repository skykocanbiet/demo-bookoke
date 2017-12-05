<?php 
$baseUrl = Yii::app()->baseUrl;
$customer = array();
?>

<div class="customerProfileContainer">

	<div id="customerProfileDetail" class="customerProfileHolder" style="display: block;margin:30px auto;">
		<div id="alert-success" style="position: fixed;top: 50px;right: 0px;"></div>
		<div class="row">

			<form class="col-md-2" id="imageUploader" enctype="multipart/form-data" style="margin:0px;">
				<?php include("customer_image.php");?>
			</form>

			<div class="col-md-9">		
				<div class="table" style="height:120px;">
					<div class="cell">
						<input  onchange="updateCustomer(<?php echo $model->id;?>);" type="text" class="customer_name yellow_hover blue_focus" value="<?php echo $model->fullname;?>" id="fullname" name="fullname" placeholder="Họ tên" />				
						
						<div class="row margin-top-20" style="text-indent: 7px;color:orange;font-size:15px;">
							<div class="col-md-3">
								<?php echo $model->countMissAppointment($model->id);?>
							</div>
							<div class="col-md-5">
								<?php echo $model->getSumBalance($model->id);?>
							</div>
							<!-- <div class="col-md-4">
								Đặt cọc: 0 VND
							</div> -->						
						</div>

					</div>
				</div>	
			</div>

		</div>


		<ul id="customerDetailFormList">
			<div class="col-md-6" style="display:inline-block;">
				<li>
					<label class="fl">Mã số</label>
					<input readonly type="text" value="<?php echo $model->code_number;?>" placeholder="Mã số" name="code_number" id="code_number" class="custProfileInput yellow_hover blue_focus fl">
					<div class="clearfix"></div>
				</li>   
				<li>
					<label class="fl">Email</label>
					<input onchange="sendEmail(<?php echo $model->id;?>),updateCustomer(<?php echo $model->id;?>);" type="email" value="<?php echo $model->email;?>" placeholder="Email" name="email" id="email" class="custProfileInput yellow_hover blue_focus fl">
					<div class="clearfix"></div>
				</li>                   
				<li>
					<label class="fl">Số điện thoại</label>                   
					<input style="width: 180px;" onchange="updateCustomer(<?php echo $model->id;?>);" type="text" placeholder="Số điện thoại" name="phone" id="phone" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $model->phone;?>">
					<span class="cus_cal cus_icon">
						<img onclick="outgoing_calls()" style="width: 25px;cursor: pointer;" src="<?php echo $baseUrl; ?>/images/medical_record/more_icon/phone.jpg" class="img-responsive">
					</span>                       
					<div class="clearfix"></div>
				</li>
				<li>
					<label class="fl">Số sms</label>                   
					<input style="width: 180px;" onchange="updateCustomer(<?php echo $model->id;?>);" type="text" placeholder="Số sms" name="phone_sms" id="phone_sms" class="custProfileInput yellow_hover blue_focus fl" value="<?php echo $model->phone_sms;?>">                       
					<span class="cus_sms cus_icon">
						<span style="cursor: pointer;" class="" id="sendSMS" data-toggle="modal" data-target="#sendSmsPop" title=""><img style="width: 25px;" src="<?php echo $baseUrl; ?>/images/medical_record/more_icon/phone_sms.jpg" class="img-responsive"></span>
					</span>
					<?php include 'send_sms.php'; ?>
					<div class="clearfix"></div>
				</li>
				<li>
					<label class="fl">Giới tính</label>
					<?php
					$listdata = array();
					$listdata[0] = "Nam";
					$listdata[1] = "Nữ";
					echo CHtml::dropDownList('gender','',$listdata,array('onchange'=>'updateCustomer('.$model->id.');','class'=>'custProfileInput yellow_hover blue_focus fl','options'=>array($model->gender=>array('selected'=>true))));
					?>                         
					<div class="clearfix"></div>
				</li>
				<li>
					<label class="fl">Ngày sinh</label>
					<input onchange="updateCustomer(<?php echo $model->id;?>);" type="text" placeholder="Ngày sinh" name="birthdate" id="birthdate" class="custProfileInput yellow_hover blue_focus fl" value="<?php if($model->birthdate != "0000-00-00" && $model->birthdate != "") echo date('d/m/Y',strtotime($model->birthdate));?>">
					<div class="clearfix"></div>
				</li>
				<li>
					<label class="fl">Nhà cung cấp</label>
					<?php
					$listdata = array();  
					if($model->id){
						foreach($model->getListCompany() as $temp){
							$listdata[$temp['Id']] = $temp['Name'];
						}
					} 
					echo CHtml::dropDownList('id_company','',$listdata,array('onchange'=>'updateCustomer('.$model->id.');','class'=>'custProfileInput yellow_hover blue_focus fl','empty' => 'Chọn nhà cung cấp','options'=>array($model->id_company=>array('selected'=>true))));
					?>                       
					<div class="clearfix"></div>
				</li> 				
			</div>                
			<div class="col-md-6" style="display:inline-block;">	
				<li>
					<label class="fl">Quốc tịch</label>
					<?php
					$listdata = array();  
					if($model->id){
						foreach($model->getListCountry() as $temp){
							$listdata[$temp['code']] = $temp['country'];
						}
					} 
					echo CHtml::dropDownList('id_country','',$listdata,array('onchange'=>'updateCustomer('.$model->id.');','class'=>'custProfileInput yellow_hover blue_focus fl','empty' => 'Chọn quốc tịch','options'=>array($model->id_country=>array('selected'=>true))));
					?>                       
					<div class="clearfix"></div>
				</li> 
				<li>
					<label class="fl">CMND/Passport</label>
					<input onchange="updateCustomer(<?php echo $model->id;?>);" type="text" placeholder="CMND/Passport" name="identity_card_number" id="identity_card_number" class="custProfileInput yellow_hover blue_focus fl" value="<?php if(!empty($model->identity_card_number)) echo $model->identity_card_number;?>">
					<div class="clearfix"></div>
				</li>
				<li> 
					<label class="fl">Nguồn</label>
					<?php
					$list_source = array();  
					if($model->id){
						foreach($model->getListSource() as $temp){
							$list_source[$temp['id']] = $temp['name'];
						}
					} 
					echo CHtml::dropDownList('id_source','',$list_source,array('onchange'=>'updateCustomer('.$model->id.');','class'=>'custProfileInput yellow_hover blue_focus fl','empty' => 'Chọn nguồn','options'=>array($model->id_source=>array('selected'=>true))));
					?>            
					<div class="clearfix"></div>
				</li>	
				<li> 
					<label class="fl">Nhóm</label>
					<?php					
					$list_segment = array();  
					$selected     = $model->getSelectedSegment($model->id);
					if($model->id){
						foreach($model->getListSegment() as $temp){
							$list_segment[$temp['id']] = $temp['name'];
						}
					} 
					echo CHtml::dropDownList('id_segment','',$list_segment,array('onchange'=>'updateCustomerSegment('.$model->id.');','class'=>'custProfileInput yellow_hover blue_focus fl','empty' => 'Chọn nhóm','options'=>array($selected=>array('selected'=>true))));
					?>             
					<div class="clearfix"></div>
				</li>				  
				<li> 
					<label class="fl">Nghề nghiệp</label>
					<?php
					$listdata = array();
					if($model->id){
						foreach($model->getJob() as $temp){
							$listdata[$temp['id']] = $temp['name'];
						}
					}
					echo CHtml::dropDownList('id_job','',$listdata,array('onchange'=>'updateCustomer('.$model->id.');','class'=>'custProfileInput yellow_hover blue_focus fl','empty' => 'Chọn nghề nghiệp','options'=>array($model->id_job=>array('selected'=>true))));
					?>                        
					<div class="clearfix"></div>
				</li>
				<li>
					<label class="fl">Chức vụ</label>
					<?php
					$listdata = array();
					$listdata[1] = "Nhân viên";
					$listdata[2] = "Quản lý";
					echo CHtml::dropDownList('position','',$listdata,array('onchange'=>'updateCustomer('.$model->id.');','class'=>'custProfileInput yellow_hover blue_focus fl','empty' => 'Chọn chức vụ','options'=>array($model->position=>array('selected'=>true))));
					?>                          
					<div class="clearfix"></div>
				</li>				
				<li>
					<label class="fl">Địa chỉ liên hệ</label>                        
					<textarea onchange="updateCustomer(<?php echo $model->id;?>);" id="address" name="address" placeholder="Địa chỉ liên hệ" rows="3" class="custProfileInput yellow_hover blue_focus fl"><?php echo $model->address;?></textarea>
					<div class="clearfix"></div>
				</li> 
			</div>
			<div class="clearfix"></div>
			<hr style="width:80%;" style="display:inline-block;">

			<div class="col-md-6" style="display:inline-block;"> 
			<?php 
				$member = CustomerMember::model()->findByAttributes(array('id_customer'=>$model->id));
				$code_member = $member['code_member'];
				$status_member	= $member['status'];
			?> 
				<li>
					<label class="fl">Mã hội viên</label>
					<input onchange="updateMember(<?php echo $model->id;?>);" type="number" value="<?php echo $code_member;?>" placeholder="Mã hội viên" name="membership_card" id="membership_card" class="custProfileInput yellow_hover blue_focus fl">
					<div class="clearfix"></div>
				</li>
			</div>
			<div class="col-md-6" style="display:inline-block;">  
				<li>
					<label class="fl" style="width:104px;">Kích hoạt</label>
					<div onclick="updateMember(<?php echo $model->id;?>);" class="slider_holder staffhours sliderdone" style="margin-left: 18px;">    
	    				<input id="hidden_flag_member" name="effect" type="hidden" value="<?php if($status_member) echo $status_member; ?>">
	   				 	<span  id="off_flag" class="slider_off sliders <?php if($status_member=="" || $status_member==0) echo "Off"; ?> "> TẮT </span>
	    				<span  id="on_flag" class="slider_on sliders <?php if($status_member=="" || $status_member==0) echo "On"; ?>"> BẬT </span>
	    				<span  id="switch_flag" class="slider_switch <?php if($status_member=="" || $status_member==0) echo "Switch";?>"></span>
                    </div> 
				</li>
			</div>

			<div class="clearfix"></div>
			<hr style="width:80%;" style="display:inline-block;">

			<div class="col-md-6" style="display:inline-block;">  
				<li>
					<label class="fl">Tài khoản</label>
					<input readonly type="text" value="<?php echo $model->username;?>" placeholder="Tài khoản" name="username" id="username" class="custProfileInput yellow_hover blue_focus fl">
					<div class="clearfix"></div>
				</li>  
				<li>
					<label class="fl">Mật khẩu</label>
					<input readonly type="password" value="<?php echo $model->password;?>" placeholder="Mật khẩu" name="password" id="password" class="custProfileInput yellow_hover blue_focus fl">
					<div class="clearfix"></div>
				</li> 
			</div>
			<div class="col-md-6" style="display:inline-block;">  
				<li>
					<label class="fl" style="width:104px;">Hồ sơ trực tuyến</label>
					<div onclick="updateFlag(<?php echo $model->id;?>);" class="slider_holder staffhours sliderdone" style="margin-left: 18px;">            
	    				<input id="hidden_flag" name="effect" type="hidden" value="<?php echo $model->flag;?>">
	   				 	<span  id="off_flag" class="slider_off sliders <?php if($model->flag == 0) echo "Off";?>"> TẮT </span>
	    				<span  id="on_flag" class="slider_on sliders <?php if($model->flag == 0) echo "On";?>"> BẬT </span>
	    				<span  id="switch_flag" class="slider_switch <?php if($model->flag == 0) echo "Switch";?>"></span>
                    </div> 
				</li>
			</div>

			<div class="clearfix"></div>	
			<hr style="width:80%;" style="display:inline-block;">

			<div class="col-md-6" style="display:inline-block;">  
				<li>
					<label class="fl">Mã bảo hiểm</label>                        
					<input onchange="insertUpdateCustomerInsurrance(<?php echo $model->id;?>);" type="text" placeholder="Mã bảo hiểm" name="code_insurrance" id="code_insurrance" class="custProfileInput yellow_hover blue_focus fl" value="">
					<div class="clearfix"></div>
				</li> 
				<li>
					<label class="fl">Loại bảo hiểm</label>
					<?php
					$list_data = array();
					if($model->id){
						foreach($model->getInsurranceType() as $temp){
							$list_data[$temp['id']] = $temp['name'];
						}
					}
					echo CHtml::dropDownList('type_insurrance','',$list_data,array('onchange'=>'insertUpdateCustomerInsurrance('.$model->id.');','class'=>'custProfileInput yellow_hover blue_focus fl','empty' => 'Chọn loại bảo hiểm'));
					?>     
					<div class="clearfix"></div>
				</li> 
			</div>
			<div class="col-md-6" style="display:inline-block;">  
				<li>
					<label class="fl">Ngày bắt đầu</label>                        
					<input onchange="insertUpdateCustomerInsurrance(<?php echo $model->id;?>);" type="text" placeholder="Thời gian bắt đầu" name="startdate" id="startdate" class="custProfileInput yellow_hover blue_focus fl" value="">
					<div class="clearfix"></div>
				</li> 
				<li>
					<label class="fl">Ngày kết thúc</label>                        
					<input onchange="insertUpdateCustomerInsurrance(<?php echo $model->id;?>);" type="text" placeholder="Thời gian kết thúc" name="enddate" id="enddate" class="custProfileInput yellow_hover blue_focus fl" value="">
					<div class="clearfix"></div>
				</li>  
			</div>  
		  
			<div class="clearfix"></div>      
			 
			<hr style="width:80%;" style="display:inline-block;">

			<div class="col-md-6" style="display:inline-block;"> 
			
				<div class="customersActionHolder" style="border:0px;">
                    <label class="fl" style="line-height:33px;padding-right:10px;">Người trong gia đình</label>
                    <a id="showFamilyPopover" class="btn_plus" style="float:left;"></a>                      
                    <div class="clearfix"></div>
                    <?php 
                    $relation_1= VRelationFamily::model()->findAllByAttributes(array('customer_1' =>($model->id),'id_relationship'=>'1'));
                    $relation_2= VRelationFamily::model()->findAllByAttributes(array('customer_1' =>($model->id),'id_relationship'=>'2'));
                    $relation_3= VRelationFamily::model()->findAllByAttributes(array('customer_1' =>($model->id),'id_relationship'=>'3'));
                    $relation_4= VRelationFamily::model()->findAllByAttributes(array('customer_1' =>($model->id),'id_relationship'=>'4'));
                    $relation_5= VRelationFamily::model()->findAllByAttributes(array('customer_1' =>($model->id),'id_relationship'=>'5'));
                    ?>
                    <?php if($relation_2){?>
                    <div  class="col-md-12 row" >
                    	<div style="width:89px;text-align: right;font-size: 13px;float: left; ">Vợ/chồng:</div>
                    	<div style="width:221px; float: left; ">
	                    	<ul style="padding: 0px 15px;">
	                    		<?php foreach ($relation_2 as $key => $v2) {?>
								<li><?php echo $v2['name_2'];?></li>
								<?php }?>
							</ul>
                    	</div>
                    </div>
                    <?php }?>
                    <?php if($relation_1){?>
                   	<div  class="col-md-12 row" style="margin-top:7px;">
                    	<div style="width:89px;text-align: right;font-size: 13px;float: left; ">Con:</div>
                    	<div style="width:221px; float: left; ">
	                    	<ul style="padding: 0px 15px;">
	                    		<?php foreach ($relation_1 as $key => $v1) {?>
								<li><?php echo $v1['name_2'];?></li>
								<?php }?>
							</ul>
                    	</div>
                    </div>
                    <?php }?>
                    <?php if($relation_3){?>
                    <div  class="col-md-12 row" style="margin-top:7px;" >
                    	<div style="width:89px;text-align: right;font-size: 13px;float: left; ">Cha/mẹ:</div>
                    	<div style="width:221px; float: left; ">
	                    	<ul style="padding: 0px 15px;">
	                    		<?php foreach ($relation_3 as $key => $v3) {?>
								<li><?php echo $v3['name_2'];?></li>
								<?php }?>
							</ul>
                    	</div>
                    </div>
                    <?php }?>
                    <?php if($relation_4){?>
                    <div  class="col-md-12 row" style="margin-top:7px;" >
                    	<div style="width:89px;text-align: right;font-size: 13px;float: left; ">Anh(chị)/em:</div>
                    	<div style="width:221px; float: left; ">
	                    	<ul style="padding: 0px 15px;">
	                    		<?php foreach ($relation_4 as $key => $v4) {?>
								<li><?php echo $v4['name_2'];?></li>
								<?php }?>
							</ul>
                    	</div>
                    </div>
                    <?php }?>
                    <?php if($relation_5){?>
                    <div  class="col-md-12 row" style="margin-top:7px;" >
                    	<div style="width:89px;text-align: right;font-size: 13px;float: left; ">Khác:</div>
                    	<div style="width:221px; float: left; ">
	                    	<ul style="padding: 0px 15px;">
	                    		<?php foreach ($relation_5 as $key => $v5) {?>
								<li><?php echo $v5['name_2'];?></li>
								<?php }?>
							</ul>
                    	</div>
                    </div>
                    <?php }?>
                </div>

                <div id="familyPopover" class="popover bottom " style="display: none; " >
                    <form id="frm-add-relation-family" onsubmit="return false;" class="form-horizontal">
                        <div class="arrow"></div>
                        <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Thêm người trong gia đình</h3>
                        <div class="popover-content" style="width:225px;">  
                        	<select name="customer_relation" class="form-control" id="customer_relation"></select>
                            <?php 										                            
                            $listFamily = array();
							$listFamily[1]  = "Con cái";
							$listFamily[2]  = "Vợ/chồng";
							$listFamily[3]  = "Cha/mẹ";	
							$listFamily[4]  = "Anh(chị)/em";
							$listFamily[5]  = "Khác";		
							echo CHtml::dropDownList('relation_family','',$listFamily,array('class'=>'form-control','style'=>'background-color: #fff;border:1px solid #ccc;box-shadow:inset 0 1px 1px rgba(0, 0, 0, .075);','empty' => 'Chọn quan hệ'));					
                            ?>  
                             <input  type="hidden" id="id_customer" name="id_customer" value="<?php echo $model->id ?>">                        
                            <span class="help-block"></span>
                            <button id="" class="btn btn_bookoke btn_bookoke_w" >Tạo mới</button>
                            <button id="hideFamilyPopover" type="reset" class="btn btn_cancel"  style="min-width: 94px;margin-right: 0px;">Hủy</button>
                        </div>
                    </form>
                </div>
				
			</div>
			<div class="col-md-6" style="display:inline-block;">  
			
				<div class="customersActionHolder" style="border:0px;">
                    <label class="fl" style="line-height:33px;padding-right:10px;">Quan hệ xã hội</label>
                    <a id="showSocietyPopover" class="btn_plus" style="float:left;"></a>                      
                    <div class="clearfix"></div>
                    <?php 
                    $relation_social_1= VRelationSocial::model()->findAllByAttributes(array('customer_1' =>($model->id),'id_relation'=>'1'));
                    $relation_social_2= VRelationSocial::model()->findAllByAttributes(array('customer_1' =>($model->id),'id_relation'=>'2'));
                    ?>
                    <?php if($relation_social_1){?>
                    <div  class="col-md-12 row" >
                    	<div style="width:89px;text-align: right;font-size: 13px;float: left; ">Cơ quan:</div>
                    	<div style="width:221px; float: left; ">
	                    	<ul style="padding: 0px 15px;">
	                    		<?php foreach ($relation_social_1 as $key => $val1) {?>
								<li><?php echo $val1['name_2'];?></li>
								<?php }?>
							</ul>
                    	</div>
                    </div>
                    <?php }?>
                    <?php if($relation_social_2){?>
                   	<div  class="col-md-12 row" style="margin-top:7px;">
                    	<div style="width:89px;text-align: right;font-size: 13px;float: left; ">Bạn bè:</div>
                    	<div style="width:221px; float: left; ">
	                    	<ul style="padding: 0px 15px;">
	                    		<?php foreach ($relation_social_2 as $key => $val2) {?>
								<li><?php echo $val2['name_2'];?></li>
								<?php }?>
							</ul>
                    	</div>
                    </div>
                    <?php }?>
                </div>

                <div id="societyPopover" class="popover bottom" style="display: none;">
                    <form id="frm-add-relation-social" onsubmit="return false;" class="form-horizontal">
                        <div class="arrow"></div>
                        <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Thêm quan hệ xã hội</h3>
                        <div class="popover-content" style="width:225px;"> 
                        	<select name="customer_relation_social" class="form-control" id="customer_relation_social"></select>  
                            <?php 		                           
							 echo CHtml::dropDownList('relation_social','',CHtml::listData(RelationSocial::model()->findAll(), 'id', 'name'),array('class'=>'form-control','style'=>'background-color: #fff;border:1px solid #ccc;box-shadow:inset 0 1px 1px rgba(0, 0, 0, .075);','empty'=>'Chọn quan hệ'))	;				
                            ?>
                            <input  type="hidden" id="id_customer" name="id_customer" value="<?php echo $model->id ?>">                            
                            <span class="help-block"></span>
                            <button id="" class="btn btn_bookoke btn_bookoke_w">Tạo mới</button>
                            <button id="hideSocietyPopover" type="reset" class="btn btn_cancel" style="min-width: 94px;margin-right: 0px;">Hủy</button>
                        </div>
                    </form>
                </div>
				
			</div>  
		  
			<div class="clearfix"></div> 
            
		</ul> 
				
	</div>
</div>

<?php include('relation_js.php'); ?>
