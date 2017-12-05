<div class="modal-dialog pop_bookoke goal_modal" style="padding-top: 95px; "> 
			    <!-- Modal content--> 
		    <div class="modal-content" style="border-radius: 0;">
			    <div class="modal-header popHead">
					<a class="btn_close" data-dismiss="modal" aria-label="Close"></a>			        
					<h5 style="text-align:center;">CHỈNH SỬA CHỈ TIÊU</h5>
			    </div>
		      	<div class="modal-body clearfix">
			        <form id="frm-update-goal" onsubmit="return false;" class="form-horizontal">
						<div class="form-group">
						    <label  class="col-sm-4 control-label">Tháng:</label>
						    <div class="col-sm-6">
						      <input type="number" class="form-control" id="month" name="month" value="<?php echo $data['month'];?>" required max="12" min="1">
						    </div>
						</div>
						<div class="form-group">
						    <label  class="col-sm-4 control-label">Doanh thu:</label>
						    <div class="col-sm-6 input-group">
						      <input type="text" class="form-control num" id="revenue" name="" value="<?php echo $data['revenue_target'];?>" required >
						      <div class="input-group-addon">VND</div>
						      <input id="revenue_target_u" name="revenue_target"  type="hidden" value="<?php echo $data['revenue_target'];?>">
						    </div>
						</div>
						<div class="form-group">
						    <label  class="col-sm-4 control-label">Khách mới:</label>
						    <div class="col-sm-6">
						      <input type="number" class="form-control" id="new_account_target" name="new_account_target" value="<?php echo $data['new_account_target'];?>" required min="0">
						    </div>
						</div>
						<div class="form-group">
						    <label  class="col-sm-4 control-label">Lịch hẹn:</label>
						    <div class="col-sm-6">
						      <input type="number" class="form-control" id="appointment_target" name="appointment_target" value="<?php echo $data['appointment_target'];?>" required min="0">
						    </div>
						</div>
						<div class="form-group">
						    <label  class="col-sm-4 control-label">Hiệu suất:</label>
						    <div class="col-sm-6">
						      <input type="number" class="form-control" id="worktime_target" name="worktime_target" value="<?php echo $data['worktime_target'];?>" required min="0">
						    </div>
						</div>
						<input type="hidden" name="id_goal" id="id_goal" value="<?php echo $data['id'];?>">
						<div class="form-group">
						    <div class="col-sm-10" style="text-align:right;">
						        <button id="" class="btn btn_bookoke btn_bookoke_w" >Cập nhật</button>
                            	<button type="button" class=" btn btn_cancel" data-toggle="collapse" data-dismiss="modal">Hủy</button>
						    </div>
						</div>
					</form>
		      	</div>
		    </div>

		  </div>
<script>
$(document).ready(function(){
	var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
	$('.num').autoNumeric('init',numberOptions);
	
    $('#revenue').change(function(){
        var revenue_target =   $('#revenue').autoNumeric('get');
        $("#revenue_target_u").val(revenue_target);
    });
});

$('#frm-update-goal').submit(function(e) {
    e.preventDefault();    
    var formData = new FormData($("#frm-update-goal")[0]);    
    if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({           
            type:"POST",
            url: baseUrl+'/itemsUsers/Staff/UpdateGoal',    
            data:formData,
            datatype:'json',
            success:function(data){                           
                if(data == -1){                   
                }if(data == -2){                
                }else if(data >= 1){
                    $('#frm-update-goal')[0].reset();   

                    $('#editgoal').hide();  
                    window.location.href = '<?php echo CController::createUrl("Staff/View");?>';   
                }
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
});
</script>