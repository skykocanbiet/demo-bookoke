
<form id="frm-treatment" onsubmit="return false;" class="form-horizontal">	

	
	
	<?php
	 	$list_ma = $model->getListMedicalHistoryAlertOfCustomer($model->id);
	 	if(count($list_ma) > 0){
		?>
		<div class="row padding-left-15">
			<h4 style="display:inline-block;">BỆNH SỬ Y KHOA</h4>
			<input type="submit" class="actionMedicalHistory" id="edit_info" value="Chỉnh sửa" onclick="return false;" style="float:right;margin-right: 30px;">
		</div>

		<div class="row">
			<div class="col-md-11 col-md-offset-1 margin-bottom-15">
				<b>Bệnh nhân mắc phải:</b>
			</div>

			<?php foreach ($list_ma as $p_w) {
				?>
				<div class="col-md-4 col-md-offset-2">
					<ul>
					  <li><?php echo $p_w['name_medicine_alert'];?></li>	
					  <li><label class="note_medicalHistory"><?php echo $p_w['note'];?></label></li>								  
					</ul>
				</div>	
			<?php } ?>	
		</div>

	<?php  }else{ ?>
		<div class="row padding-left-15">
			<h4 style="display:inline-block;">BỆNH SỬ Y KHOA</h4>
			<input type="submit" class="actionMedicalHistory" id="save_info" name="save_info" value="Lưu" style="float:right;margin-right: 30px;">		
		</div>
		
	

		<div class="row">
			<div class="col-md-11 col-md-offset-1 margin-bottom-15">
				<div class="form-group">                		
				<label class="col-md-12 control-label text-align-left">Bệnh nhân mắc phải:</label> 	
				<div class="clearfix"></div>	

					<?php foreach ($model->getListMedicineAlert() as $m_a) { ?>
					 <div class="col-md-5 col-md-offset-1 col-sm-5 col-sm-offset-1">
						<div class="checkbox">
						  <label>
						  	<input type="checkbox" name="chk[]" id="chk<?php echo $m_a['id'];?>" value="<?php echo $m_a['id'];?>"><?php echo $m_a['name'];?>
						  </label>						 
						</div>					
					</div>


					<!-- Modal Note -->
					<div class="modal fade" id="noteModal<?php echo $m_a['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					        <h4 class="modal-title" id="myModalLabel">Thêm Ghi Chú</h4>
					      </div>
					      <div class="modal-body">
					        <input id="ipt-note<?php echo $m_a['id'];?>" type="text" class="form-control">					 
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
					        <button type="button" class="btn btn-primary" onclick="noteMedicalHistory(<?php echo $m_a['id'];?>);">Lưu</button>
					      </div>
					    </div>
					  </div>
					</div>


					<?php } ?>	
				</div>
			</div>
		</div>

	<?php }  ?>	

</form>