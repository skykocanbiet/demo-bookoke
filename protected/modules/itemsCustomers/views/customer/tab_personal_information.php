<?php $baseUrl = Yii::app()->baseUrl;?>
<form class="form-horizontal">
<div class="row">
	<div class="col-md-3 margin-top-50">
	    <div class="profile-left">
	    	<div id="profile-image">
	    		<img  src="<?php echo $baseUrl; ?>/upload/customer/<?php if($data->image=="") echo "no_image.png"; else echo $data->image;?>">
	    	</div>
	    	<div id="profile-name"><?php echo $data->fullname;?></div>
	    	<div id="profile-code">Mã số</div>
	    	<div id="code"><div><?php echo $data->code_number;?></div></div>
	    </div>
	</div>

	<div class="col-md-9 margin-top-15">
		<!-- THÔNG TIN CƠ BẢN -->
		<div class="row">   
			<h4>1. THÔNG TIN CƠ BẢN</h4>                        		
		</div>
		<div class="row">  
		   	<div class="col-md-6">
		   		<div class="form-group">                		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Họ tên</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" value="<?php echo $data->fullname;?>" />		
					</div>	
				</div>
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Giới tính</label>
					<div class="col-md-8 col-sm-8">											
						<select class="form-control">
							<option value="1" <?php if($data->gender==1) echo "selected";?> >Nam</option>
							<option value="2" <?php if($data->gender==2) echo "selected";?> >Nữ</option>
						</select>		
					</div>								
				</div>
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Ngày sinh</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" id="birthdate" name="birthdate" value="<?php echo $data->birthdate;?>" />	
						<?php 
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'birthdate',
						// additional javascript options for the date picker plugin
						'options'=>array(
						'showAnim'=>'fold',
						'changeMonth'=>true,
						'changeYear'=>true,
						'yearRange'=>'1900:2099',
				        'minDate' => '1900-01-01',      // minimum date
				        'maxDate' => '2099-12-31',
						'dateFormat' => 'yy-mm-dd',
						),
						'htmlOptions'=>array(
						'style'=>'display:none',
						'class'=>'form-control col-md-6'
						),
						)); 
						?>	
					</div>								
				</div>	
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">CMND</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" />		
					</div>								
				</div> 
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Quốc tịch</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" />		
					</div>								
				</div> 
				<div class="form-group">                 		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Số điện thoại</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" value="<?php echo $data->phone;?>" />		
					</div>	
				</div>
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Email</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" value="<?php echo $data->email;?>" />		
					</div>								
				</div> 
		   	</div>  

			<div class="col-md-6">
				<div class="form-group">              		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Địa chỉ</label>
					<div class="col-md-8 col-sm-8">
						<textarea class="form-control" rows="3" style="height:100%;"><?php echo $data->address;?></textarea>		
					</div>
				</div>
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Nghề nghiệp</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" />		
					</div>								
				</div>
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Chức vụ</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" />		
					</div>								
				</div>  
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Cơ quan</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" />		
					</div>								
				</div>	
				<div class="form-group">              		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Ghi chú</label>
					<div class="col-md-8 col-sm-8">
						<textarea class="form-control" rows="3" style="height:100%;"></textarea>		
					</div>
				</div>	
		   	</div>
		</div> 
			  
									 
		<!-- THÔNG TIN BẢO HIỂM HIỆN TẠI -->  
		<div class="row">   
			<h4>2. THÔNG TIN BẢO HIỂM HIỆN TẠI</h4>
		</div>

		<div class="row">   
			<div class="col-md-6"> 
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Mã bảo hiểm</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" />		
					</div>								
				</div> 
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Loại bảo hiểm</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" />		
					</div>								
				</div> 									
			</div> 
			<div class="col-md-6">   
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Thời gian bắt đầu</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" />		
					</div>								
				</div>
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Thời gian kết thúc</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" required="required" />		
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
						<input type="text" class="form-control" />		
					</div>								
				</div> 	
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Vợ/chồng:</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" />		
					</div>								
				</div> 	
				<div class="form-group">                        		
					<label class="col-md-4 col-sm-4 control-label text-align-right">Cha/mẹ:</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" />		
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
						<input type="text" class="form-control" required="required" />		
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