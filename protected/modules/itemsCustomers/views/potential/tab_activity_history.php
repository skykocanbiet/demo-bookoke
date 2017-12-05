<?php $baseUrl = Yii::app()->baseUrl;?>

<div class="customerProfileContainer">

	<div id="customerProfileDetail" class="customerProfileHolder" style="display: block;margin:30px auto;">
			<div class="row" style="    margin: 29px -15px;">

		
			 <div>
				<label><input type="checkbox" name="cuocgoidi" checked> &nbsp Cuộc gọi đi</label>
				<span style="margin-left: 30px;">
				Trạng thái: <select id="id_checkconversation" name="checkconversation" style="height:34px; border-radius:4px; width: 196px;">
                  <option value="0" selected="">Trả lời</option>
                  <option value="1">Không trả lời</option>
                  <option value="2">Thư thoại</option>
                  <option value="3">Sai số</option>
                  <option value="4">Bắt máy nhưng không trả lời</option>
                 </select>
                 </span>
			</div>
			<div style="margin:15px 0px;">
				<p> </p> 

			</div> 
			<div class="clearfix" style="">
				<button class="btn1 btn btn-success">Khách hàng</button>
				<button class="btn1 btn btn-success" data-toggle="collapse" data-target="#addschedule">Lên lịch hẹn</button>
				<button class="btn1 btn btn-success">Giữ lại</button>
				<button class="btn1 btn btn-success">Báo cáo</button>
				<button class="btn1 btn btn-success">Xóa</button>
			</div>
			<div class="clearfix"></div>
			<div id="addschedule" class="collapse clearfix">
			<form id="frm-add-schedule" onsubmit="return false;" class="form-horizontal">
			<div class="add-schedules col-sm-12">
				
				<div class="row hed">
					<P style="margin-left:10px; margin-top: 8px; color: #fff;font-size: 16px; ">Lên lịch hẹn</P>
				</div>


				<input type="hidden" name="id_cus" value="<?php echo $model->id;?>">

				<div class="clearfix"></div>
				<div style="padding:20px 30px;">
					<label><input type="checkbox" name="rdo_schedule" checked> &nbsp Lên lịch</label><span style="margin-left: 30px;"><label>Ngày đặt lịch: </label>&nbsp<input type="text" name="date_schedule" id="date" class=" in1" value="<?php echo date('d-m-Y H:mm ') ?>" style="text-align:center;" /></span>
					<div class="clearfix"></div>
					
<!-- 					<input type="date" name="date_schedule"  class="in"> 
 -->					
					
				<div class="clearfix"></div>
					
					<div class="row" style="padding:  13px;">
						<label>Ghi chú</label>
						<textarea name="note" class="form-control f2" rows="4" id="comment" required=""></textarea>
					</div>
				<div class="clearfix"></div>
					
					<div>
						<p><label>Mức độ tiềm năng:</label> <select class="in1" name="trangthai" style="width:180px; margin:20px 0px;">
							<option>Cold</option>
							<option>Warm</option>
							<option>Hot</option>
						</select></p>
						<button id="btnsave_schedule" class="btn btn_bookoke btn_bookoke_w">Xác nhận</button>
						<button type="button" class=" btn btn_cancel" data-toggle="collapse" data-target="#addschedule">Hủy</button>
					</div>
				</div>
			</div>
			</form>
			</div>
		</div>
		<hr style="margin-left: -15px; margin-right: -15px;">
		<div class="clearfix"></div>
		<div class="row">
		<table id="tbl_deal" class="table table-striped deals_tbl ">
			<thead class="tbhead">
				
				<th style="width:25%;">Ngày tạo</th>
				
				<th style="width:55%; ">Ghi chú</th>
				
				
				<th style="width:20%; ">Người tạo</th>
				
				
			</thead>
			<tbody id="t_bd" class="tbody">

				
				
				<?php include 'chitiethoatdong.php' ?>
				
			
			</tbody>
		</table>
		</div>
		
		<div class="clearfix"></div>


	</div>
</div>
<script type="text/javascript">
	$(function() {
    $('input[name="date_schedule"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        timePicker: true,
    autoApply: true,
        locale: {
            format: 'DD-MM-YYYY H:mm'
        }
    }, 
    function(start, end, label) {
        
       
    });
});
	$('#btnsave_schedule').click(function(e) {
    var date = $('#date').val();
    
    var comment = $('#comment').val();
    if(comment == ""){
        $('#comment').addClass('error');
        return false;
    }
    e.preventDefault();
    var stt = $('#id_checkconversation').val();    

    var formData = new FormData($("#frm-add-schedule")[0]);    
    if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({           
            type:"POST",
            url: baseUrl+'/itemsCustomers/Potential/addschedule',   
            data:formData,
            datatype:'json',
            success:function(data){
                /*if(data == '-1'){                
                alert("in");
                               
                e.stopPropagation();
                return false;                
                }
                if(data > '0'){ 
                $('#frm-add-customer')[0].reset();    
                $('#addnewCustomerPopup').hide();               
                e.stopPropagation();
                 alert("on");
                return false; 
                searchCustomers();
                //detailCustomer(data);
                }*/
             
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
});
</script>
