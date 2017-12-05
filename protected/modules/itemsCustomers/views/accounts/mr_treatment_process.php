<?php 

$id_schedule=$model->getIdScheduleByIdCustomer($model->id);

?>
	<input type="hidden" id="id_quotation" value="<?php echo $existQuotation['id']; ?>">
	<input type="hidden" id="id_schedule" value="<?php echo $id_schedule;?>">	
	<div class="row padding-left-15">   
		<h4 style="display:inline-block;">QUÁ TRÌNH ĐIỀU TRỊ</h4>  	
		<?php 
		if ($existQuotation) 
		{
		?>
			<div style="float: right;">
				<a class="global_btn oUpdates" id="printTreatment" style="float: none;" onclick="printTreatment(<?php echo $model->id; ?>,<?php echo $id_mhg; ?>)">In điều trị</a> 
				<a class="global_btn oUpdates" data-toggle="modal" data-target="#update_quote_modal">Xem báo giá</a> 
			</div>
		<?php	
		}
		else
		{
		?>  
			 <a class="global_btn <?php if(!$id_schedule) echo "disabled";?>" id="oAdds" data-toggle="modal" data-target="#quote_modal">Thêm báo giá</a>   
		<?php 
		}	
		?>               		
	</div>
	<div class="clearfix"></div>


	<!-- modal báo giá-->
	<div id="quote_modal" class="modal fade">

	</div>
	<!-- model update quotation -->
	<div id="update_quote_modal" class="modal fade">

	</div>
	

	<div class="row" style="padding-bottom:10em;">
		<div class="col-md-12">	
			<div class="table-responsive">
				<div class="blur" id="add-treatment-process-blur">
					<div id="addnewMedicalHistoryPopup">								

							<div class="modal-header popHead" style="margin:-15px -15px 15px -15px;">
					           <a class="btn_close close_tp" data-dismiss="modal" aria-label="Close"></a>
					            <h5 id="treatment_process_title">Thêm Quá Trình Điều Trị</h5>
					        </div> 	

				            <form id="frm-save-medical-history" onsubmit="return false;" class="form-horizontal">								               
				               
				                <div class="popover-content row">
					
					                	<input type="hidden" id="id_medical_history" name="id_medical_history" value="">

					                	<div class="col-md-12 margin-bottom-15">
						                
											<label class="control-label">Chi tiết điều trị:</label>
											<textarea required class="form-control" id="medicalhistoryNewName" name="medicalhistoryNewName" rows="3" placeholder="Chi tiết điều trị"></textarea>
											<script>	
											CKEDITOR.replace( 'medicalhistoryNewName', {
											    height: 100,
											    toolbarGroups: [                                                     
											        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
											        { name: 'paragraph',   groups: [ 'list', 'indent' ] },
											        { name: 'links' }                                              
											    ]
											});
											</script>
										</div>	



					               		<div class="col-md-6">	

						               		<div class="form-group">
												<label class="col-md-5 control-label">Bác sĩ điều trị:</label>
												<div class="col-md-7">
													<?php 

													$selected=yii::app()->user->getState('group_id')==Yii::app()->params['id_group_dentist']?yii::app()->user->getState('user_id'):"";

													$listdata = array();

													foreach($model->getListDentists() as $temp){
														$listdata[$temp['id']] = $temp['name'];
													}

													echo CHtml::dropDownList('id_dentist','',$listdata,array('class'=>'form-control','required'=>'required','options'=>array($selected=>array('selected'=>true))));
													?>
												</div>
											</div>	

											<div class="form-group">
												<label class="col-md-5 control-label">Toa thuốc:</label>												
												<a id="action-prescription" class="btn btn_bookoke" data-toggle="modal" data-target="#prescriptionModal">Thêm toa thuốc</a>
											</div>	

											<div class="form-group">
												<label class="col-md-5 control-label">Lab:</label>												
												<a id="action-lab" class="btn btn_bookoke" data-toggle="modal" data-target="#labModal">Thêm lab</a>
											</div>	

											<div class="form-group">
								                <div class="checkbox col-md-12">
								                    <label>
								                        <input checked="checked" id="status_success" name="status_success" type="checkbox" value="true"> Cập nhật trạng thái hoàn tất
								                    </label>								                    
								                </div>	
								            </div>									     							
						                    
					                	</div>

					                	<div class="col-md-6">	
									
											<div class="form-group">
												<label class="col-md-5 control-label">Ngày giờ tái khám:</label>
												<div class="col-md-7"><input class="form-control" id="reviewdate" name="reviewdate" type="text" placeholder="Ngày giờ tái khám" onchange="setValueExaminationAfter();"></div>
											</div>		

											<div class="form-group">
						                        <label class="col-md-5 control-label">Thời gian:</label>
						                        <div class="col-md-7">
						                           <div class="input-group">						         
						                              <input class="form-control" type="number" id="length_time" name="length_time" placeholder="Thời gian">
						                              <span class="input-group-addon">phút</span>
						                           </div>
						                        </div>						                       
						                     </div>										

											<div class="form-group">
												<label class="col-md-5 control-label">Ghi chú:</label>
												<div class="col-md-7"><textarea id="description" name="description" class="form-control" rows="3" placeholder="Ghi chú"></textarea></div>
											</div>

										</div>

										<div class="clearfix"></div>

										<div class="col-md-12">								      
							                <div style="float:right;">
								                
						                    	<button type="reset" class="btn btn_cancel close_tp">Hủy</button> 
						                    	<button id="addnewMedicalHistory" class="btn btn_bookoke">Xác nhận</button>              
							                </div>								    
								        </div>
					   
				                </div>
				            </form>
					</div>	
				</div>


				<div class="modal fade" id="prescriptionModal" tabindex="-1" role="dialog" aria-hidden="true">
				    <div class="modal-dialog" role="document">
				      <div class="modal-content">				      	

						<div class="modal-header popHead">
				           <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
				            <h5>TOA THUỐC</h5>
				         </div> 				       

				        <div class="modal-body" style="padding-top:0px;">
				          <form id="frm-prescription" class="form-horizontal" onsubmit="return false;">
				          	<input type="hidden" id="id_cs_medical_history" name="id_cs_medical_history" value="">
				          	<div class="row">
				          		<div class="col-md-7">																		
									<span class="input-group-addon text-align-left spn-dots">Họ và tên bệnh nhân: <?php echo $model->fullname;?></span>
								</div>	
								<div class="col-md-5">																		
									<span class="input-group-addon text-align-left spn-dots">tuổi: <?php if($model->birthdate != '0000-00-00' && $model->birthdate != '') echo date("Y") - date('Y',strtotime($model->birthdate));?></span>
								</div>	
				          	</div>

				          	<div class="row">
				          		<div class="col-md-12">																		
									<span class="input-group-addon text-align-left spn-dots">Địa chỉ: <?php echo $model->address;?></span>
								</div>								
				          	</div>

				 																	
							<div class="input-group">
							  <span class="input-group-addon spn-dots">Chẩn đoán:</span>
							  <input required type="text" class="form-control ipt-dots" id="diagnose" name="diagnose">												 
							</div>
				

				          	<h4 align="center" style="color:#000;margin-bottom:0px;">THUỐC VÀ CÁCH SỬ DỤNG</h4>

				          	<div id="dntd">

				          		<div data-drug="1">
					          		<div class="input-group">
									  <span class="input-group-addon spn-dots">1.</span>
									  <input required type="text" class="form-control ipt-dots" name="drug_name[]">
									</div>	

									<div class="input-group">
									  <span class="input-group-addon dots spn-dots">Sáng:</span>
									  <input type="number" class="form-control ipt-dots text-align-center" name="morning[]">	
									  <span class="input-group-addon dots spn-dots">Trưa:</span>
									  <input type="number" class="form-control ipt-dots text-align-center" name="noon[]">
									  <span class="input-group-addon dots spn-dots">Chiều:</span>
									  <input type="number" class="form-control ipt-dots text-align-center" name="afternoon[]">	
									  <span class="input-group-addon dots spn-dots">Tối:</span>
									  <input type="number" class="form-control ipt-dots text-align-center" name="night[]">
									</div>			
									
								</div>								
								
							</div>

							<div class="margin-top-15">
								<button id="upAdd" class="btn sbtnAdd"><span class="glyphicon glyphicon-plus"></span> Thuốc</button>	
							</div>

							<div class="row margin-top-30">
								<div class="col-md-12">						                
									<label class="control-label">Lời dặn:</label>
									<textarea class="form-control" id="advise" name="advise"></textarea>
									<script>	
									CKEDITOR.replace( 'advise', {
									    height: 70,
									    toolbarGroups: [                                                     
									        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
									        { name: 'paragraph',   groups: [ 'list', 'indent' ] },
									        { name: 'links' }                                              
									    ]
									});
									</script>
								</div>								
							</div>	

															

							<div class="row">
								<div class="col-md-6">														
									<div class="input-group">
									  <span class="input-group-addon spn-dots">Tái khám sau</span>
									  <input type="number" class="form-control ipt-dots text-align-right" id="examination_after" name="examination_after" style="padding:15px 50px 0px 0px;">
									  <span class="input-group-addon spn-dots">ngày</span>										  							 
									</div>
								</div>									
							</div>											

							<div class="modal-footer" style="padding: 15px 0px 0px 0px;border-top:none;">
							  <button type="button" class="btn print">In toa thuốc</button>
					          <button type="button" class="btn btn_cancel" data-dismiss="modal">Hủy</button>
					          <button type="submit" class="btn btn_bookoke">Lưu</button>
					        </div>	
					        
				          </form>
				        </div>
				        
				      </div>
				    </div>
				</div>


				<div class="modal fade" id="labModal" tabindex="-1" role="dialog" aria-hidden="true">
				    <div class="modal-dialog" role="document">
				      <div class="modal-content">				      	

						<div class="modal-header popHead">
				           <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
				            <h5>THÔNG TIN GIAO NHẬN LABO</h5>
				         </div> 			       

				        <div class="modal-body" style="padding-top:0px;">
				          <form id="frm-lab" class="form-horizontal" onsubmit="return false;">
				          	<input type="hidden" id="id_cs_m3dical_history" name="id_cs_m3dical_history" value="">	




				          	<div class="row margin-top-20">

				          		<div class="col-md-6">

				          			<div class="form-group">
					   					<span class="col-md-4 control-label">Nha khoa:</span>
				   						<div class="col-md-8">
				   						<?php 
										  	$selected_branch = yii::app()->user->getState('user_branch');		
											$list_branch = array();														
											foreach($model->getListBranch() as $temp){
												$list_branch[$temp['id']] = $temp['name'];
											}	
											echo CHtml::dropDownList('id_br4nch','',$list_branch,array('class'=>'form-control','required'=>'required','options'=>array($selected_branch=>array('selected'=>true))));
										?>			
				   						</div>
					   				</div>

					   				<div class="form-group">
					   					<span class="col-md-4 control-label">Bệnh nhân:</span>
				   						<div class="col-md-8">
				   						<input disabled type="text" class="form-control" value="<?php echo $model->fullname;?>">			
				   						</div>
					   				</div>

					   				<div class="form-group">
					   					<span class="col-md-4 control-label">Ngày gửi:</span>
				   						<div class="col-md-8">
				   						<input required type="text" class="form-control" id="sent_date" name="sent_date" value="<?php echo date("Y-m-d");?>">			
				   						</div>
					   				</div>

				          		</div>

				          		<div class="col-md-6">

				          			<div class="form-group">
					   					<span class="col-md-4 control-label">Labo:</span>
				   						<div class="col-md-8">
				   						<?php 
				   							$list_labo_elite = array();														
											foreach($model->getListLaboElite() as $temp){
												$list_labo_elite[$temp['id']] = $temp['name'];
											}
											echo CHtml::dropDownList('id_labo_elite','',$list_labo_elite,array('class'=>'form-control','required'=>'required','options'=>array()));
										?>			
				   						</div>
					   				</div>					   				
					   				
			   						<div class="form-group">

			   							<span class="col-md-4 control-label">Giới tính:</span>
				   						<div class="col-md-3" style="padding-right:0px;">
				   						<input disabled type="text" class="form-control" value="<?php if($model->gender == 0) echo "Nam"; else echo "Nữ";?>">		   						
				   						</div>

					   					<span class="col-md-2 control-label">Tuổi:</span>
				   						<div class="col-md-3">
				   						<input disabled type="text" class="form-control" value="<?php echo date("Y") - date('Y',strtotime($model->birthdate));?>">			
				   						</div>				   						

					   				</div>					   						
					   				
					   				<div class="form-group">
					   					<span class="col-md-4 control-label">Ngày nhận:</span>
				   						<div class="col-md-8">
				   						<input required type="text" class="form-control" id="received_date" name="received_date" value="<?php echo date("Y-m-d");?>">			
				   						</div>
					   				</div>

				          		</div>

				          	</div>
				          	

							<div class="row">
								<div class="col-md-12">						                
									<label class="control-label">Chỉ định của bác sĩ</label>
									<textarea required class="form-control" id="assign" name="assign" rows="4"></textarea>									
								</div>								
							</div>	

							<div class="row margin-top-15">
								<div class="col-md-12">						                
									<label class="control-label">Ghi chú</label>
									<textarea class="form-control" id="n0te" name="n0te"></textarea>
									<script>	
									CKEDITOR.replace( 'n0te', {										
									    height: 70,																    				    
									    toolbarGroups: [                                                     
									        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
									        { name: 'paragraph',   groups: [ 'list', 'indent' ] },
									        { name: 'links' }                                              
									    ]
									});								
									</script>									
								</div>								
							</div>			

							<div class="modal-footer" style="padding: 15px 0px 0px 0px;border-top:none;">
							  <button type="button" class="btn print_lab">In lab</button>
					          <button type="button" class="btn btn_cancel" data-dismiss="modal">Hủy</button>
					          <button type="submit" class="btn btn_bookoke">Lưu</button>
					        </div>	
					        
				          </form>
				        </div>
				        
				      </div>
				    </div>
				</div>


				<table class="table table-treatment" style="border-collapse:collapse;">

		    			<thead>
					      <tr bgcolor="#8ca7ae" style="position:relative;">	
							<th>Lần</th>
					        <th>BS điều trị</th>				
					        <th>Chi tiết điều trị</th>	
					        <th>Ghi chú</th>	
					        <th>Toa thuốc</th>	
					        <th>Lab</th>
					        <th>Ngày tạo</th>	
					        <th colspan="2">
					        	<span class="action glyphicon glyphicon-plus plusTreatment" onclick="set_null_ipt_id_mh();">
					        </th>
					      </tr>

					    </thead>
					    <tbody id="medical_history">
					      	<?php include("medical_history.php");?>
					    </tbody>
		    	</table>

		    </div>

			<div style="position:relative">
				<hr style="border: 1px dashed #ddd;">
				<div id="pf_cir"></div>
			</div>


			<div id="pf_bill">
			
			</div>
		</div>
	</div>

