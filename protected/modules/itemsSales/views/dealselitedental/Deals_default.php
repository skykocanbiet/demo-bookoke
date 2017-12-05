<?php include 'add_deals.php'; ?>
<?php include 'edit_deals.php';
	include 'js_search.php';
 ?>
 <style type="text/css">
 .add_deals{
 	border: solid 1px #D7D7D7;
    border-radius: 3px;
    background: #6ec4a1;
    color: #Fff;
    font-size: 20px;
    line-height: 28px;
    height: 30px;
    width: 30px;
    padding: 0px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
 }
 .input-group{
 	max-width: 300px;
 }	
 </style>
 <div id="detail">
<div class="col-sm-12">
	<div class="head row clearfix">
			<div class="col-lg-6">
			<h3>Danh sách chương trình </h3>
			</div>
			  <div class="col-lg-6 ss">
			  <a class="btn_plus" id="newDeals" data-delay="0" data-placement="right" data-original-title="Thêm khách hàng" data-toggle="modal" data-target="#add_deals"></a>
			    <div class="input-group search_deals">
			      <input type="text" class="form-control" placeholder="Tìm thông tin.." id="searchnamepromotion" value="" onkeypress="runScript_search(event);">
			      <span class="input-group-btn">
			        <button class="btn btn-secondary" type="button" onclick="searchpromotion();" >Tìm</button>
			      </span>
			    </div>
			  </div>
		</div>
	</div>
	<div class="clearfix"></div>
	
	<div id="abcabc" class="">
		
		<table id="tbl_deal" class="table table-striped deals_tbl ">
			<thead class="tbhead">
				
				<th style="width:10%; text-align: left;">Hình ảnh</th>
				<th style="width:25%; text-align: left;">Tên chương trình</th>
				<th style="width:15%; text-align: left;">Trạng thái</th>
				
				<th style="width:15%; text-align: left;">Ngày bắt đầu</th>
				<th style="width:15%; text-align: left;">Ngày kết thúc</th>
				<th style="width:20%; text-align: left;">Loại khuyến mãi</th>
				
				
			</thead>
			<tbody id="t_bd" class="tbody">

				
			
				<tr class="sss" data-toggle="collapse" data-target="#collapse">
					
					<td style="width:10%;"> 
						<img  src="<?php echo Yii::app()->request->baseUrl;?>/upload/deals/lg/placeholder_70x70.gif" id="file_preview_1" style="width:40px; height:40px; border-radius:100%;" >
					</td>
					<td style="width:25%;padding-top: 20px;"></td>
					<td style="width:15%;padding-top: 20px;">
						<select class="" name="status_deal" disabled=""  style="float: left;
    background-color: #f9f9f9;
    border: 0px;">
	                        <option value="1" >Đang duyệt</option>
	                        <option value="2" >Khởi động</option>
	                        <option value="3" >Tạm dừng</option>
	                        <option value="4" >Kết thúc</option>
	                        <option value="-1">Xóa</option>
	                  </select>
					</td>
					
					<td style="width:14%;padding-top: 20px;"></td>
					<td style="width:14%;padding-top: 20px;"></td>
					<td style="width:20%;padding-top: 20px;"> 
						<select class="" name="type_price" id="type_promotion" onchange="promotion_type()" disabled="" style="float: left;
    background-color: #f9f9f9;
    border: 0px;">
                        <option value="0">Select promotional value</option>
                        <option value="1" >phần trăm (%)</option>
                        <option value="2" >giảm theo số tiền</option>
                        <option value="3" >Bán giá cố định</option>
                        <option value="4" >Giảm theo giá trị</option>
                  </select>
				</td>
					 	
					
				</tr>
				<tr id="collapse" class="   collapse trdetail">
					<td >
			      	</td>
		      </tr>
			
			</tbody>
		</table>
	</div>
		
</div>

<script type="text/javascript">
	$( document ).ready(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var head = $('.head').height();
    var tbhead  = $('.tbhead').height();
    $('#t_bd').height(windowHeight-header-head-tbhead-37);
    $('#profileSideNav').height(windowHeight-header);
    $('.customerListContainer').height(windowHeight-header);
    $('#detailCustomer').height(windowHeight-header);
    $('.cal-loading').fadeOut('slow');
   

});
	
	 function edit(id){
	 	
	 	$.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/editdeals',   
            data: {"id":id},   

            success:function(data){ 

                  
                    $('#editdeals').html(data);
                    $("#edit_deals").modal();
                    $(function(){
					    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
					    $('.num').autoNumeric('init',numberOptions);
					});
                         
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });
	 	 
	 }

</script>