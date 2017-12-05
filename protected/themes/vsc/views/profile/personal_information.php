<form class="form-horizontal" id="" action="Profile/Edit_info" method="post" enctype="multipart/form-data">
					   	<div class="col-xs-3">
						   	<div class="col-xs-12" id="pf_img">
						   		<img src="<?php echo Yii::app()->baseUrl; ?>/upload/customer/<?php if($model->image=="") echo "no_image.png"; else echo $model->image;?>" alt="">
						   		<input style="display:none;" type="file" id="image" name="image">
						   		<p><?php echo $model->fullname;?></p>
						   		<p>Mã số</p>
						   		<p><?php if(isset($model->code_number)) echo $model->code_number; else echo "N/A";?></p>
						   	</div>
					   	</div>
					   	<div class="col-xs-9" style="padding-bottom:40px;">
					   		<div>
					   			<div class="row">
					   			<h4 style="display:inline-block;">1. THÔNG TIN CƠ BẢN</h4>					   			
					   			<input type="submit" id="save_info" name="save_info" value="Save" style="float:right;margin-right: 30px;display:none;">
					   			<span id="edit_info" style="margin-right:30px;float:right;cursor:pointer;" class="glyphicon glyphicon-pencil"></span>					   			
					   			</div>
					  
					   				<div class="col-xs-6">
					   					<div class="form-group">
					   						<label class="col-md-4 control-label">Họ tên</label>
					   						<div class="col-md-8">
					   							<input disabled required type="text" id="fullname" name="fullname" value="<?php echo $model->fullname;?>" class="form-control">
					   						</div>
					   					</div>
					   					<div class="form-group">
					   						<label class="col-md-4 control-label">Giới tính</label>
					   						<div class="col-md-8">
					   						<?php
												$listdata = array();
												$listdata[0] = "Nam";
												$listdata[1] = "Nữ";
												echo CHtml::dropDownList('gender','',$listdata,array('class'=>'form-control',"disabled"=>"disabled",'options'=>array($model->gender=>array('selected'=>true))));
											?>				
					   						</div>
					   					</div>
					   					<div class="form-group">
					   						<label class="col-md-4 control-label">Ngày tháng năm sinh</label>
					   						<div class="col-md-8">
					   							<input disabled required type="date" id="birthdate" name="birthdate" value="<?php echo $model->birthdate;?>" class="form-control">					   							
					   						</div>
					   					</div>
					   					<div class="form-group">
					   						<label class="col-md-4 control-label">CMND</label>
					   						<div class="col-md-8">
					   							<input disabled type="text" pattern="\d{9,12}" id="identity_card_number" name="identity_card_number" value="<?php if(!empty($model->identity_card_number)) echo $model->identity_card_number;?>" class="form-control">
					   						</div>
					   					</div>
					   					<div class="form-group">
					   						<label class="col-md-4 control-label">Quốc tịch</label>
					   						<div class="col-md-8">		
					   							<?php
													$country = array();
													$list_data = $model->getListCountry();

													foreach($list_data as $temp){
														$country[$temp['code']] = $temp['country'];
													}
													echo CHtml::dropDownList('id_country','',$country,array('class'=>'form-control',"disabled"=>"disabled",'options'=>array($model->id_country=>array('selected'=>true))));
												?>
					   						</div>
					   					</div>					   					
					   					<div class="form-group">
					   						<label class="col-md-4 control-label">Số điện thoại</label>
					   						<div class="col-md-8">
					   							<input required disabled pattern="\d{6,12}" type="text" id="phone" name="phone" value="<?php echo $model->phone; ?>" class="form-control">
					   						</div>
					   					</div>
					   					<div class="form-group">
					   						<label class="col-md-4 control-label">Email</label>
					   						<div class="col-md-8">
					   							<input disabled type="email" id="email" name="email" value="<?php echo $model->email;?>" class="form-control">
					   						</div>
					   					</div>
					   				</div>
					   				<div class="col-md-6">
					   					<div class="form-group">
					   						<label class="col-md-4 control-label">Địa chỉ</label>
					   						<div class="col-md-8">
					   							<textarea disabled id="address" name="address" rows="3" class="form-control"><?php echo $model->address;?></textarea>
					   						</div>
					   					</div>
					   					<div class="form-group">
					   						<label class="col-md-4 control-label">Nghề nghiệp</label>
					   						<div class="col-md-8">
					   							<?php
													$job = array();
													$list_data = $model->getJob();

													foreach($list_data as $temp){
														$job[$temp['id']] = $temp['name'];
													}
													echo CHtml::dropDownList('id_job','',$job,array('class'=>'form-control','empty' => 'Chọn nghề nghiệp',"disabled"=>"disabled",'options'=>array($model->id_job=>array('selected'=>true))));
												?>					   							
					   						</div>
					   					</div>
					   					<div class="form-group">
					   						<label class="col-md-4 control-label">Chức vụ</label>
					   						<div class="col-md-8">					   							
					   						<?php
												$listdata = array();
												$listdata[1] = "Nhân viên";
												$listdata[2] = "Quản lý";
												echo CHtml::dropDownList('position','',$listdata,array('class'=>'form-control','empty' => 'Chọn chức vụ',"disabled"=>"disabled",'options'=>array($model->position=>array('selected'=>true))));
											?>		
					   						</div>
					   					</div>
					   					<div class="form-group">
					   						<label class="col-md-4 control-label">Cơ quan</label>
					   						<div class="col-md-8">
					   							<input disabled type="text" id="organization" name="organization" value="<?php echo $model->organization;?>" class="form-control">
					   						</div>
					   					</div>
					   					<div class="form-group">
					   						<label class="col-md-4 control-label">Ghi chú</label>
					   						<div class="col-md-8">
					   							<textarea disabled id="note" name="note" class="form-control" rows="4"><?php echo $model->note;?></textarea>
					   						</div>
					   					</div>
					   				</div>				   				
					   	
					   		</div>
					   		<!-- <div class="col-md-12">
					   			<h4>2. THÔNG TIN BẢO HIỂM HIỆN TẠI</h4>
					   			<?php 
					   			if(yii::app()->user->getState('customer_id')){
					   				$customer_insurrance = $model->getCustomerInsurrance(yii::app()->user->getState('customer_id'));
					   				/*echo "<pre>";print_r($customer_insurrance);echo "</pre>";
					   				exit;*/
					   			}				   								   								   							   								   							   			
					   			?>
					   			<div class="form-group col-md-6">
			   						<label class="col-md-4 control-label">Mã bảo hiểm</label>
			   						<div class="col-md-8">
			   							<input disabled type="text" name="" value="<?php if(isset($customer_insurrance)) echo $customer_insurrance->id; else echo "N/A";?>" class="form-control">
			   						</div>
			   					</div>
			   					<div class="form-group col-md-6">
			   						<label class="col-md-4 control-label">Thời gian bắt đầu</label>
			   						<div class="col-md-8">
			   							<input disabled type="text" name="" value="<?php if(isset($customer_insurrance)) echo date('d/m/Y',strtotime($customer_insurrance->startdate)); else echo "N/A";?>" class="form-control">
			   						</div>
			   					</div>
			   					<div class="form-group col-md-6">
			   						<label class="col-md-4 control-label">Loại bảo hiểm</label>
			   						<div class="col-md-8">
			   							<input disabled type="text" name="" value="<?php if(isset($customer_insurrance)) echo $customer_insurrance->type_insurrance; else echo "N/A";?>" class="form-control">
			   						</div>
			   					</div>
			   					<div class="form-group col-md-6">
			   						<label class="col-md-4 control-label">Thời gian kết thúc</label>
			   						<div class="col-md-8">
			   							<input disabled type="text" name="" value="<?php if(isset($customer_insurrance))  echo date('d/m/Y',strtotime($customer_insurrance->enddate)); else echo "N/A";?>" class="form-control">
			   						</div>
			   					</div>
					   		</div> -->
					   		<!-- <div class="col-md-12" id="pf_qh">
					   			<h4>3. CÁC MỐI QUAN HỆ</h4>
					   			<div class="col-md-6">
					   				<p id="pf_rs">Người trong gia đình</p>
					   				<div class="col-md-4" id="pf_qh_tt">Con cái:</div>
					   				<div class="col-md-8"> Nguyễn Văn A </div>
					   				<div class="col-md-4" id="pf_qh_tt"> Vợ/ chồng: </div>
					   				<div class="col-md-8"> Nguyễn Văn A </div>
					   				<div class="col-md-4" id="pf_qh_tt"> Cha/ mẹ: </div>
					   				<div class="col-md-8"> Nguyễn Văn A, Nguyễn Thị A </div>
					   			</div>
					   			<div class="col-md-6">
					   				<p id="pf_rs">Quan hệ xã hội</p>
					   				<div class="col-md-4" id="pf_qh_tt"> Cơ quan: </div>
					   				<div class="col-md-8"> Nguyễn Văn A </div>
					   				<div class="col-md-4" id="pf_qh_tt"> Bạn bè: </div>
					   			</div>
					   		</div> -->
					   </div>
					   </form>