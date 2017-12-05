<?php $baseUrl = Yii::app()->baseUrl;?>
<form class="form-horizontal" id="" action="Edit_info" method="post" enctype="multipart/form-data">
<div class="row">
	<div class="col-md-3 margin-top-50">
	    <div class="profile-left">
	    	<div id="profile-image">
	    		<img  src="<?php echo $baseUrl; ?>/upload/customer/<?php if($data->image=="") echo "no_image.png"; else echo $data->image;?>">	    		
	    	</div>
	    	
	    	<div id="profile-name"><?php echo $data->fullname;?></div>
	    	<div class="col-md-10 col-md-offset-2">
	    		<input style="display:none;" type="file" id="image" name="image">
	    	</div>
	    	<div id="profile-code">Mã số</div>
	    	<div id="code"><div><?php echo $data->code_number;?></div></div>
	    </div>
	</div>

	<div class="col-md-9 margin-top-15">
		<!-- THÔNG TIN CƠ BẢN -->
		<div class="row">   
			<h4 style="display:inline-block;">1. THÔNG TIN CƠ BẢN</h4>  
			<input type="submit" id="save_info" name="save_info" value="Save" style="float:right;margin-right: 30px;display:none;">
			<span id="edit_info" style="margin-right:30px;float:right;cursor:pointer;" class="glyphicon glyphicon-pencil"></span>  
			<input type="hidden" id="id" name="id" value="<?php echo $data->id;?>"/>                    		
		</div>
		<div class="row">  
		   	<div class="col-md-6">
		   		<div class="form-group">                		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Họ tên</label>
					<div class="col-md-8 col-sm-8">
						<input disabled required type="text" id="fullname" name="fullname" class="form-control" value="<?php echo $data->fullname;?>" />		
					</div>	
				</div>
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Giới tính</label>
					<div class="col-md-8 col-sm-8">											
					<?php
						$listdata = array();
						$listdata[0] = "Nam";
						$listdata[1] = "Nữ";
						echo CHtml::dropDownList('gender','',$listdata,array('class'=>'form-control',"disabled"=>"disabled",'options'=>array($data->gender=>array('selected'=>true))));
					?>			
					</div>								
				</div>
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Ngày sinh</label>
					<div class="col-md-8 col-sm-8">
						<input disabled required type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo $data->birthdate;?>" />							
					</div>								
				</div>	
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">CMND</label>
					<div class="col-md-8 col-sm-8">
						<input disabled type="text" pattern="\d{9,12}" id="identity_card_number" name="identity_card_number" value="<?php if(!empty($model->identity_card_number)) echo $model->identity_card_number;?>" class="form-control" />		
					</div>								
				</div> 
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Quốc tịch</label>
					<div class="col-md-8 col-sm-8">
						<?php
													$country = array();
													$list_data = $data->getListCountry();

													foreach($list_data as $temp){
														$country[$temp['code']] = $temp['country'];
													}
													echo CHtml::dropDownList('id_country','',$country,array('class'=>'form-control',"disabled"=>"disabled",'options'=>array($data->id_country=>array('selected'=>true))));
												?>		
					</div>								
				</div> 
				<div class="form-group">                 		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Số điện thoại</label>
					<div class="col-md-8 col-sm-8">
						<input required disabled pattern="\d{6,12}" type="text" id="phone" name="phone" class="form-control" value="<?php echo $data->phone;?>" />		
					</div>	
				</div>
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Email</label>
					<div class="col-md-8 col-sm-8">
						<input disabled type="email" id="email" name="email" class="form-control" value="<?php echo $data->email;?>" />		
					</div>								
				</div> 
		   	</div>  

			<div class="col-md-6">
				<div class="form-group">              		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Địa chỉ</label>
					<div class="col-md-8 col-sm-8">
						<textarea disabled id="address" name="address" class="form-control" rows="4"><?php echo $data->address;?></textarea>		
					</div>
				</div>
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Nghề nghiệp</label>
					<div class="col-md-8 col-sm-8">
						<?php
													$job = array();
													$list_data = $data->getJob();

													foreach($list_data as $temp){
														$job[$temp['id']] = $temp['name'];
													}
													echo CHtml::dropDownList('id_job','',$job,array('class'=>'form-control','empty' => 'Chọn nghề nghiệp',"disabled"=>"disabled",'options'=>array($data->id_job=>array('selected'=>true))));
												?>			
					</div>								
				</div>
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Chức vụ</label>
					<div class="col-md-8 col-sm-8">
						<?php
												$listdata = array();
												$listdata[1] = "Nhân viên";
												$listdata[2] = "Quản lý";
												echo CHtml::dropDownList('position','',$listdata,array('class'=>'form-control','empty' => 'Chọn chức vụ',"disabled"=>"disabled",'options'=>array($data->position=>array('selected'=>true))));
											?>			
					</div>								
				</div>  
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Cơ quan</label>
					<div class="col-md-8 col-sm-8">
						<input disabled type="text" id="organization" name="organization" value="<?php echo $data->organization;?>" class="form-control">		
					</div>								
				</div>	
				<div class="form-group">              		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Ghi chú</label>
					<div class="col-md-8 col-sm-8">
						<textarea disabled id="note" name="note" class="form-control" rows="4"><?php echo $data->note;?></textarea>		
					</div>
				</div>	
		   	</div>
		</div> 
			  
									 
		<!-- THÔNG TIN BẢO HIỂM HIỆN TẠI -->  
		<div class="row">   
			<h4>2. THÔNG TIN BẢO HIỂM HIỆN TẠI</h4>
		</div>
		<?php 					   			
			$customer_insurrance = $data->getCustomerInsurrance($data->id);					   							   								   								   							   								   							   			
		?>
		<div class="row">   
			<div class="col-md-6"> 
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Mã bảo hiểm</label>
					<div class="col-md-8 col-sm-8">
						<input disabled type="text" class="form-control" id="id_insurrance" value="<?php if(isset($customer_insurrance[0]['id'])) echo $customer_insurrance[0]['id']; else echo "N/A";?>" />		
					</div>								
				</div> 
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Loại bảo hiểm</label>
					<div class="col-md-8 col-sm-8">
						<input disabled type="text" class="form-control" id="type_insurrance" value="<?php if(isset($customer_insurrance[0]['type_insurrance'])) echo $customer_insurrance[0]['type_insurrance']; else echo "N/A";?>" />		
					</div>								
				</div> 									
			</div> 
			<div class="col-md-6">   
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Thời gian bắt đầu</label>
					<div class="col-md-8 col-sm-8">
						<input disabled type="text" class="form-control" id="startdate" value="<?php if(isset($customer_insurrance[0]['startdate'])) echo date('d/m/Y',strtotime($customer_insurrance[0]['startdate'])); else echo "N/A";?>" />		
					</div>								
				</div>
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Thời gian kết thúc</label>
					<div class="col-md-8 col-sm-8">
						<input disabled type="text" class="form-control" id="enddate" value="<?php if(isset($customer_insurrance[0]['enddate']))  echo date('d/m/Y',strtotime($customer_insurrance[0]['enddate'])); else echo "N/A";?>"/>		
					</div>								
				</div>    
			</div>   
		</div>
		
		<!-- CÁC MỐI QUAN HỆ -->
		<div class="row">   
			<h4>3. CÁC MỐI QUAN HỆ</h4>
		</div>
		<div class="row">   
			<div class="col-md-6"> 
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right" style="font-size: 16px;font-weight: 600;">Người trong gia đình:</label>
					<div class="col-md-8 col-sm-8">											
					</div>								
				</div>   
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Con cái:</label>
					<div class="col-md-8 col-sm-8">
						<input disabled id="con_cai" type="text" class="form-control" />		
					</div>								
				</div> 	
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Vợ/chồng:</label>
					<div class="col-md-8 col-sm-8">
						<input disabled id="vo_chong" type="text" class="form-control" />		
					</div>								
				</div> 	
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Cha/mẹ:</label>
					<div class="col-md-8 col-sm-8">
						<input disabled id="cha_me" type="text" class="form-control" />		
					</div>								
				</div> 		                      											
			</div> 
			<div class="col-md-6">   
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right" style="font-size: 16px;font-weight: 600;">Quan hệ xã hội:</label>
					<div class="col-md-8 col-sm-8">											
					</div>								
				</div> 
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Cơ quan:</label>
					<div class="col-md-8 col-sm-8">
						<input disabled id="co_quan" type="text" class="form-control" />		
					</div>								
				</div> 
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Bạn bè:</label>
					<div class="col-md-8 col-sm-8">
					</div>								
				</div>    
			</div>   
		</div>
		</div>
	
</div>
</form>
<script>
$('#edit_info').click(function (e) { 
	$("#edit_info").css("display", "none");
	$("#save_info").css("display", "block");
	$("#image").css("display", "block");
	$("#fullname").attr("disabled", false); 
	$("#gender").attr("disabled", false);
	$("#birthdate").attr("disabled", false);
	$("#identity_card_number").attr("disabled", false);
	$("#id_country").attr("disabled", false);
	$("#phone").attr("disabled", false);
	$("#email").attr("disabled", false);
	$("#address").attr("disabled", false);
	$("#id_job").attr("disabled", false);
	$("#position").attr("disabled", false);
	$("#organization").attr("disabled", false);
	$("#note").attr("disabled", false);
	$("#id_insurrance").attr("disabled", false);
	$("#type_insurrance").attr("disabled", false);
	$("#startdate").attr("disabled", false);
	$("#enddate").attr("disabled", false);
	$("#con_cai").attr("disabled", false);
	$("#vo_chong").attr("disabled", false);
	$("#cha_me").attr("disabled", false);
	$("#co_quan").attr("disabled", false);
});
</script>