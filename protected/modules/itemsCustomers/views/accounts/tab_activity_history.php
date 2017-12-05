<style type="text/css">
	.quantrong td{
		background-color: #fdc4c9 !important;
	}
	.sss td a{
		display: none;
	}
	.sss:hover td a{
		display: block;
	}
</style>
<?php $baseUrl = Yii::app()->baseUrl;?>
<?php include '_style_activity.php'; ?>
<div class="customerProfileContainer">

	<div id="customerProfileDetail" class="customerProfileHolder" style="display: block;margin:20px auto;">
			<div class="row" style="    margin: 0px -15px 20px -15px;">

		
			
			
			<div class="clearfix" style="">
			 <form id="frm-search-schedule" onsubmit="return false;" class="form-horizontal">
				 <div style="float: left;">
						<!-- <label><input type="checkbox" name="cuocgoidi" checked> &nbsp Cuộc gọi đi</label> -->
						<span style="margin-left: 0px;">
						Phân loại: <select id="phanloai_search" name="phanloai_search" onchange="searchnote(<?php echo $data; ?>)" style="height:34px; border-radius:4px; width: 150px;">
		                  <option value="">Tất cả</option>
		                  <option value="1" >Lịch hẹn</option>
		                  <option value="2">Báo giá</option>
		                  <option value="3">Điều trị</option>
		                  <option value="4">Phàn nàn</option>
		                  <option value="5">Tiềm năng</option>
		                  <option value="0">Khác</option>
		                 </select>
		                 </span>
						<span style="margin-left: 20px;">
						Trạng thái: <select id="status_search" name="status_search" onchange="searchnote(<?php echo $data; ?>)" style="height:34px; border-radius:4px; width: 150px;">
							<option value="">Tất cả</option>
		                  <option value="1" >Ghi nhận</option>
		                  <option value="2">Đang giải quyết</option>
		                  <option value="3">Hoàn tất</option>
		                  <option value="-1">Hủy</option>
		                 
		                 </select>
		                 </span>
		                 <span style="margin-left: 20px;">Ngày: <input type="text" name="date" id="date" value="" style="height:34px; border-radius:4px; width: 150px;border-color: #ccc;text-align: center;"  onchange="searchnote(<?php echo $data; ?>)" />
		                 </span>
					</div>
			
			</form>
				
				<a class="btn_plus" data-toggle="modal" data-target="#addschedule" style="float: right;"></a>
        		
				
			</div>
			<!-- <div class="clearfix"></div>
			<div id="addschedule" class="modal fade" role="dialog">
				<div class="modal-content">
					<div class="modal-body">
					
					</div>
				</div>
			</div> -->
			<div id="addschedule" class="modal fade" role="dialog">
			  <div class="modal-dialog pop_bookoke modal-lg" style="padding-top: 95px; ">

			    <!-- Modal content-->
			    <div class="modal-content" style="border-radius: 0;">
			      <div class="modal-header popHead">
					<a class="btn_close" data-dismiss="modal" aria-label="Close"></a>			        
					<h5>THÊM GHI CHÚ</h5>
			      </div>
			      <div class="modal-body clearfix">
			        <form id="frm-add-schedule" onsubmit="return false;" class="form-horizontal">
					 <div>
						<!-- <label><input type="checkbox" name="cuocgoidi" checked> &nbsp Cuộc gọi đi</label> -->
						<span style="margin-left: 0px;">
						Phân loại: <select id="phanloai" name="phanloai" style="height:34px; border-radius:4px; width: 196px;">
		                  <option value="">Phân loại</option>
		                  <option value="1" >Lịch hẹn</option>
		                  <option value="2">Báo giá</option>
		                  <option value="3">Điều trị</option>
		                  <option value="4">Phàn nàn</option>
		                  <option value="5">Tiềm năng</option>
		                  <option value="0">Khác</option>
		                 </select>
		                 </span>
						<span style="margin-left: 30px;">
						Trạng thái: <select id="status" name="status" style="height:34px; border-radius:4px; width: 196px;">

		                  <option value="1" >Ghi nhận</option>
		                  <option value="2">Đang giải quyết</option>
		                  <option value="3">Hoàn tất</option>
		                  <option value="3">Hủy</option>
		                 
		                 </select>
		                 </span>
					</div>
					<!-- <div class="add-schedules col-sm-12">
						
						<div class="row hed">
							<P style="margin-left:10px; margin-top: 8px; color: #fff;font-size: 16px; ">Lên lịch hẹn</P>
						</div> -->


						<input type="hidden" name="id_cus" value="<?php echo $data;?>">

						<div class="clearfix"></div>
						<div style="padding:0px 0px;">
							<!-- <label><input type="checkbox" name="chk_important" > &nbsp Quan trọng</label> --><!-- <span style="margin-left: 30px;"><label>Ngày đặt lịch: </label>&nbsp<input type="text" name="date_schedule" id="date" class=" in1" value="<?php echo date('d-m-Y H:mm ') ?>" style="text-align:center;" /></span> -->
							<div class="clearfix"></div>
							
		<!-- 					<input type="date" name="date_schedule"  class="in"> 
		 -->					
							
						<div class="clearfix"></div>
							
							<div class="row" style="padding:  13px;">
								<label>Nội dung</label>
								<textarea name="note" class="form-control f2" rows="4" id="comment" required=""></textarea>
							</div>
						<div class="clearfix"></div>
							
							 <div>
								<button type="button" class=" btn btn_cancel" data-toggle="collapse" data-dismiss="modal">Hủy</button>
								<button id="btnsave_schedule" class="btn btn_bookoke btn_bookoke_w">Xác nhận</button>
							</div> 
						</div>
					<!-- </div> -->
					</form>
			      </div>
			     
			    </div>

			  </div>
			</div>
		</div>
		<!-- <hr style="margin-left: -15px; margin-right: -15px;"> -->
		<div class="clearfix"></div>
		<div class="row">
		<table id="tbl_deal" class="table table-striped deals_tbl ">
			<thead class="tbhead">
				
				<th style="width:15%;">Ngày tạo</th>
				
				<th style="width:50%; ">Ghi chú</th>
				
				
				<th style="width:15%; ">Người tạo</th>
				<th style="width: 15%">Trạng thái</th>
				<th  style="width:5%;"></th>
				
				
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
function searchnote(id){
	var status_search = $('#status_search').val();
	var phanloai_search = $('#phanloai_search').val();
	var date = $('#date').val();
	$('.cal-loading').fadeIn('fast');
	$.ajax({
		type:'POST',
		url: baseUrl+"/itemsCustomers/Accounts/searchnote",
		data:{
				'status_search' 	: status_search,
				'phanloai_search'	: phanloai_search,
				'id'				: id,
				'date'				: date,

			},
		
		success:function(data){
			$('#t_bd').html(data);
			$('.cal-loading').fadeOut('slow');  
		},
		 error: function(data){
        console.log("error");
        console.log(data);
        }
	});

}
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
    var phanloai = $('#phanloai').val();

    var comment = $('#comment').val();
    if(phanloai == ""){
    	$('#phanloai').addClass('error');
        return false;
    }
    if(comment == ""){
        $('#comment').addClass('error');
        return false;
    }
    e.preventDefault();
    var stt = $('#id_checkconversation').val();    

    var formData = new FormData($("#frm-add-schedule")[0]);    
    if (!formData.checkValidity || formData.checkValidity()) {
    	$('.cal-loading').fadeIn('fast');
        jQuery.ajax({           
            type:"POST",
            url: baseUrl+'/itemsCustomers/Accounts/addnote',   
            data:formData,
            datatype:'json',
            success:function(data){
              	$('#t_bd').html(data);
			
             	$('#addschedule').modal("hide");
                $('.cal-loading').fadeOut('slow'); 
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
	/*$(function() {
    $('input[name="date_start"]').daterangepicker({
        singleDatePicker: true,
       
       
    autoApply: true,
        locale: {
            format: 'DD-MM-YYYY'
        }
    }, 
    function(start, end, label) {
        
       
    });
});*/
$( function() {
    $('input[name="date"]').datepicker();
    
  } );
</script>
