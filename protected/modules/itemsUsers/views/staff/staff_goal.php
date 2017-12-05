<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
padding: 3px;
vertical-align: top !important;
padding: 10px 15px !important;
text-align: center;
}
.table-goal thead tr {
    background-color: #8ca7ae;
}
.table-goal thead tr th { 
    color: #fff !important;
}
.table-goal thead tr th {
    text-align: center;
    border: 1px solid #fff !important;
}
.table-goal tbody {
    background-color: #f1f5f6;
}
.table-goal tbody tr td {
    border: 1px solid #fff !important;
}
.goal_modal{
	width: 450px;
}
.sss td a {
    display: none;
}
.sss:hover td a{
  display: block !important;
}
p {
    margin: 0px 0px 0px !important;
}

.input-group[class*=col-] {
    float: none;
    padding-right: 15px;
    padding-left:15px; 
}
.input-group-addon{
	border-top-right-radius: 4px !important ;
	border-bottom-right-radius: 4px !important;
}
</style>
<?php 
$id_user = $model->id;
$branch_id = $model->id_branch;
$form_date = date("Y-m-01", strtotime("first day of this month"));
$to_date   = date("Y-m-t", strtotime("last day of this month"));
$user_goal = CsTarget::model()->getUserGoal($id_user);
$month= (date('m'));
$year = (date('Y'));
$worktime_target = CsTarget::model()->getWorktime_target($branch_id,$id_user,$form_date,$to_date);
?>
<div style="margin: 30px 0px;">
<a class="btn_plus" data-toggle="modal" data-target="#add_goal" style="float: right;margin-bottom: 10px;"></a>
	<div style="">
	  <table class="table table-goal" style="margin-top:15px;">
	    <thead>
	      <tr>
	        <th>STT</th>
	        <th>Năm</th>
	        <th>Tháng</th>
	        <th>Khách mới</th>
	        <th>Lịch hẹn</th>
	        <th>Doanh thu</th>
	        <th>Hiệu suất</th>
	        
	      </tr>
	    </thead>
	    <tbody>
	    <?php if(!$user_goal){ ?>
		    	<tr><td colspan="8" >Chưa có dữ liệu!</td></tr>
		<?php }else{
			foreach ($user_goal as $key => $value) { ?>
			    <tr class="sss">
			      <td><?php echo $key+1 ;?></td>
				  <td><?php echo $value['year'];?></td>
				  <td><?php echo $value['month'];?></td>
				  <td><?php echo $value['new_account_target'];?></td>
				  <td><?php echo $value['appointment_target'];?></td>
				  <td><?php echo number_format( $value['revenue_target'],0,",","."); ?> VND</td>
				  <td><p style="width:95%; float:left;"><?php echo $value['worktime_target'];?> </p>
						<a href="#"  style="width:5%; float:right;" class="hide" onclick="editGoal(<?php echo $value['id'] ?>)">
							<img src="<?php echo yii::app()->request->baseUrl; ?>/images/icon_sb_left/edit_cam.png" style="width:18px; height: 18px;">
						</a>
				  </td>
			    </tr>
		<?php  }
		   } ?>
	    </tbody>
	  </table>
  	</div>

  	<div id="add_goal" class="modal fade" role="dialog">
		<div class="modal-dialog pop_bookoke goal_modal" style="padding-top: 95px; "> 
			    <!-- Modal content--> 
		    <div class="modal-content" style="border-radius: 0;">
			    <div class="modal-header popHead">
					<a class="btn_close" data-dismiss="modal" aria-label="Close"></a>			        
					<h5 style="text-align:center;">THÊM CHỈ TIÊU</h5>
			    </div>
		      	<div class="modal-body clearfix">
			        <form id="frm-add-goal" onsubmit="return false;" class="form-horizontal">
						<div class="form-group">
						    <label  class="col-sm-4 control-label">Tháng:</label>
						    <div class="col-sm-6">
						      <input type="number" class="form-control" id="month" name="month" value="<?php echo $month;?>" required max="12" min="1">
						    </div>
						</div>
						<div class="form-group">
						    <label  class="col-sm-4 control-label">Doanh thu:</label>
						    <div class="col-sm-6 input-group">
						      <input type="text" class="form-control num" id="revenue_target" name="" required >
						       <div class="input-group-addon">VND</div>
						      <input id="revenue_target_h" name="revenue_target"  type="hidden">
						    </div>
						</div>
						<div class="form-group">
						    <label  class="col-sm-4 control-label">Khách mới:</label>
						    <div class="col-sm-6">
						      <input type="number" class="form-control" id="new_account_target" name="new_account_target" required min="0">
						    </div>
						</div>
						<div class="form-group">
						    <label  class="col-sm-4 control-label">Lịch hẹn:</label>
						    <div class="col-sm-6">
						      <input type="number" class="form-control" id="appointment_target" name="appointment_target" required min="0">
						    </div>
						</div>
						<div class="form-group">
						    <label  class="col-sm-4 control-label">Hiệu suất:</label>
						    <div class="col-sm-6">
						      <input type="number" class="form-control" id="worktime_target" name="worktime_target" value="<?php echo $worktime_target; ?>" required min="0">
						    </div>
						</div>
						<div class="form-group">
						    <div class="col-sm-offset-2 col-sm-10">
						      <div class="checkbox">
						        <label>
						          <input type="checkbox" id="btnCheck" name="check"> Cập nhật tự động chỉ tiêu cho tháng sau
						          <input type="hidden" name="check_td" id="check_td" value="-1">
						        </label>
						      </div>
						    </div>
						</div>
						<input type="hidden" name="user_id" id="user_id" value="<?php echo $model->id;?>">
						<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $model->id_branch;?>">
						<input type="hidden" name="year" id="year" value="<?php echo $year;?>">
						<div class="form-group">
						    <div class="col-sm-10" style="text-align:right;">
						        <button id="" class="btn btn_bookoke btn_bookoke_w" >Tạo mới</button>
                            	<button type="button" class=" btn btn_cancel" data-toggle="collapse" data-dismiss="modal">Hủy</button>
						    </div>
						</div>
					</form>
		      	</div>
		    </div>

		  </div>
	</div> <!-- end add_goal -->

	<div id="editgoal" class="modal fade" role="dialog">
	</div>
</div>

<script>

$(document).ready(function(){
	var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
	$('.num').autoNumeric('init',numberOptions);

    $('#revenue_target').change(function(){

        var revenue_target =   $('#revenue_target').autoNumeric('get');
        $("#revenue_target_h").val(revenue_target);
    });

    $('#btnCheck').click(function()
    {	

    	if (this.checked == true){
            $("#check_td").val(1);
    	}
        else{
           $("#check_td").val(-1);
        }
    });
});


$('#frm-add-goal').submit(function(e) {
    e.preventDefault();    
    var formData = new FormData($("#frm-add-goal")[0]);    
    if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({           
            type:"POST",
            url: baseUrl+'/itemsUsers/Staff/AddGoal',    
            data:formData,
            datatype:'json',
            success:function(data){                          
                if(data == -1){                   
                }if(data == -2){                
                }else if(data >= 1){
                    $('#frm-add-goal')[0].reset();   

                    $('#add_goal').hide();  
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
function editGoal(id){
 		$.ajax({
            type:'POST',
            url: baseUrl+'/itemsUsers/Staff/EditGoal',   
            data: {"id":id},   
            success:function(data){
                    $('#editgoal').html(data);
                    $("#editgoal").modal();             
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });
 	}
</script>