<?php 
if($treatment){
	$id_mhg = $treatment->id;
	$name   = $treatment->name;
}else{
	$id_mhg = $treatment;
	$name   = 'GẦN NHẤT';	
}
?>
<div class="row margin-top-30">	

	<div class="col-md-3 col-lg-4" id="col-md-3">
		<h4 style="background-color: #F2B339;color:#fff;padding:7px 10px;width:100%;margin:0;font-size: 14px;font-size: 13px;letter-spacing: 1px;" id="table_treatment">
			ĐỢT ĐIỀU TRỊ <?php echo $name;?>
			<span id="triangle" class="glyphicon glyphicon-triangle-bottom" style="float:right;"></span>
		</h4> 
		
		<input type="hidden" name="id_customer" id="id_customer" class="form-control" value="<?php echo $model->id;?>">
		<input type="hidden" id="id_mhg" value="<?php echo $id_mhg;?>">
		<div  class="treatment col-md-4 col-lg-5" style="z-index:100;left: 0%;margin-bottom:50px;"> 
            <div class="formholder">
				<table class="table" id="treatment_4" border="0">			    
	
					<?php				
					$medical_history_group = $model->getListMedicalHistoryGroupByCustomer($model->id);
					$count = count($medical_history_group);
					if($medical_history_group && $count > 0){
						foreach ($medical_history_group as $k_m_h_g => $m_h_g) {
							?>
					<tr id="tm<?php echo $m_h_g['id'];?>" class="bg-cl" style="cursor:pointer;" onclick="detailTreatment(<?php echo $m_h_g['id'];?>);">
						<td style="text-align:left;vertical-align:middle;">Đợt điều trị <?php echo $count-$k_m_h_g;?></td>
						<td style="text-align:right;">

						<select class="form-control uT" onchange="updateTreatment(<?php echo $m_h_g['id'];?>);" style="width:auto;float:right;">
							<option <?php if($m_h_g['status_process']==0) echo "selected";?>>Chưa Hoàn tất</option>
							<option <?php if($m_h_g['status_process']!=0) echo "selected";?>>Hoàn tất</option>
						</select>

						<?php /*
						<span onclick="updateTreatment(<?php echo $m_h_g['id'];?>);" class="btn btn-dangerous btn-completed" <?php if($m_h_g['status_process']==0) echo 'style="background-color:#666;"'; else echo '';?>><?php if($m_h_g['status_process']==0) echo "Chưa Hoàn tất"; else echo "Hoàn tất";?></span>
						*/ ?>

						</td>										      				        
					</tr>

					<?php } }?>	
				</table>
			
				<div class="row">
					<div class="col-md-6 col-md-offset-3"><input id="add_new_treatment" class="form-control" type="submit" value="Thêm đợt điều trị mới"/></div>
				</div>
            </div>
        </div>
	</div>		 
</div>
