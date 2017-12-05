<?php
 	$list_ma = $model->getListMedicalHistoryAlert($model->id);  	
 	if(count($list_ma) > 0){
	?>
	<div class="row padding-left-15">
			<h4 style="display:inline-block;">BỆNH SỬ Y KHOA</h4>
			<input type="submit" id="update_info" class="actionMedicalHistory" name="update_info" value="Lưu" style="float:right;margin-right: 30px;">
	</div>

	<div class="row">
		<div class="col-md-11 col-md-offset-1 margin-bottom-15">
			<div class="form-group">                		
			<label class="col-md-12 control-label text-align-left">Bệnh nhân mắc phải:</label> 	
			<div class="clearfix"></div>	

				<?php foreach ($model->getListMedicineAlert() as $m_a) { ?>
					 <div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2">
						<div class="checkbox">
						  <label>
						  	<input <?php if(array_key_exists($m_a['id'],$list_ma)) echo "checked";?> type="checkbox" name="chk[]" id="chk<?php echo $m_a['id'];?>" value="<?php echo $m_a['id'];?>"><?php echo $m_a['name'];?>
						  </label>						 
						</div>	
						<?php if(array_key_exists($m_a['id'],$list_ma))
						{
						?>
						<label data-toggle="modal" data-target="#noteModal<?php echo $m_a['id'];?>" class="note_medical_history">
							<i id="i-note<?php echo $m_a['id'];?>"><?php if($list_ma[$m_a['id']]=='') echo "(Thêm ghi chú)"; else echo $list_ma[$m_a['id']];?></i>
							<input type="hidden" name="ipt[]"  id="ipt<?php echo $m_a['id'];?>" value="<?php echo $list_ma[$m_a['id']];?>">
						</label>
						<?php
						}
						?>				
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

<script>
$("input[name='chk[]']").change(function() {
    if(this.checked) {
        var id = $(this).val();
        $(this).parents(".col-md-4.col-md-offset-2.col-sm-4.col-sm-offset-2").append("<label data-toggle='modal' data-target='#noteModal"+id+"' class='note_medical_history'><i id='i-note"+id+"'>(Thêm ghi chú)</i><input type='hidden' name='ipt[]'' id='ipt"+id+"'></label");
    }
    else{
        $(this).parents(".checkbox").next().remove();
    }
});

</script>