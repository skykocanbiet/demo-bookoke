
			  <div class="modal-dialog pop_bookoke modal-lg" style="padding-top: 95px; ">

			    <!-- Modal content-->
			    <div class="modal-content" style="border-radius: 0;">
			      <div class="modal-header popHead">
					<a class="btn_close" data-dismiss="modal" aria-label="Close"></a>			        
					<h5>CHỈNH SỬA GHI CHÚ</h5>
			      </div>
			      <div class="modal-body clearfix">
			        <form id="frm-edit-schedule"  class="form-horizontal">
					  <div>
						<!-- <label><input type="checkbox" name="cuocgoidi" checked> &nbsp Cuộc gọi đi</label> -->
						<span style="margin-left: 0px;">
						Phân loại: <select id="phanloai_edit" name="phanloai_edit" style="height:34px; border-radius:4px; width: 196px;">
		                  <option value="">Phân loại</option>
		                  <option value="1" <?php if($data['flag']==1){echo 'selected';}?> >Lịch hẹn</option>
		                  <option value="2" <?php if($data['flag']==2){echo 'selected';}?> >Báo giá</option>
		                  <option value="3" <?php if($data['flag']==3){echo 'selected';}?> >Điều trị</option>
		                  <option value="4" <?php if($data['flag']==4){echo 'selected';}?> >phàn nàn</option>
		                  <option value="5" <?php if($data['flag']==5){echo 'selected';}?> >tiềm năng</option>
		                  <option value="0" <?php if($data['flag']==0){echo 'selected';}?> >Khác</option>
		                 </select>
		                 </span>
						<span style="margin-left: 30px;">
						Trạng thái: <select id="status" name="status_edit" style="height:34px; border-radius:4px; width: 196px;">

		                  <option value="1" <?php if($data['status']==1){echo 'selected';}?>>Ghi nhận</option>
		                  <option value="2" <?php if($data['status']==2){echo 'selected';}?>>Đang giải quyết</option>
		                  <option value="3" <?php if($data['status']==3){echo 'selected';}?>>Hoàn tất</option>
		                 
		                 </select>
		                 </span>

					</div>
					



						<div class="clearfix"></div>
						<div style="padding:0px 0px;">
							<!-- <label><input type="checkbox" name="chk_important_edit" <?php if($data['important'] == 1){echo 'checked';} ?> > &nbsp Quan trọng</label> -->
							<div class="clearfix"></div>
						<div class="clearfix"></div>
							<div class="row" style="padding:  13px;">
								<label>Ghi chú</label>
								<textarea name="note_edit" class="form-control f2" rows="4" id="comment_edit" required=""><?php echo $data['note']; ?></textarea>
							</div>
						<div class="clearfix"></div>
							
							 
						</div>
					
					</form>
					<div>
								
								<button type="button" id="update" onclick="updatenote(<?php echo $data['id']; ?>)" class="btn btn_bookoke btn_bookoke_w">Xác nhận</button>
								<button type="button" class=" btn btn_cancel" data-toggle="collapse" data-dismiss="modal">Hủy</button>
							</div> 
			      </div>
			     
			    </div>

			  </div>
<script type="text/javascript">
	function updatenote(id){
   

    
    var comment = $('#comment_edit').val();
    if(comment == ""){
        $('#comment_edit').addClass('error');
        return false;
    }
  
   
    var formData = new FormData($("#frm-edit-schedule")[0]); 
    formData.append('id',id);   
    if (!formData.checkValidity || formData.checkValidity()) {
      $.ajax({       
            type:"POST",
            url: baseUrl+'/itemsCustomers/Accounts/updatenote',   
            data:formData,
            datatype:'json',
            success:function(data){
               
             	$('#editnote').modal("hide");
                detailCustomer(data);
                return false;
            },
            error: function(data) {
                alert("Error occured. Please try again!");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
    return false;
};
</script>