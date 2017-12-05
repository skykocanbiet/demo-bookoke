<?php include 'add_deals.php'; ?>
<style type="text/css">
.deals_tbl .tbhead{
	color: #fff;
    background-color: rgba(115, 149, 158, 0.80);
}	
</style>
	
	

		<table id="tbl_deal" class="table table-striped deals_tbl ">
			<thead class="tbhead">
				
				<th style="width:34%; text-align: center;">Tên chương trình</th>
				<th style="width:15%; text-align: center;">Trạng thái</th>
				
				<th style="width:15%; text-align: center;">Ngày bắt đầu</th>
				<th style="width:15%; text-align: center;">Ngày kết thúc</th>
				<th style="width:23%; text-align: center;">Loại khuyến mãi</th>
				
				
			</thead>
			<tbody id="t_bd" class="tbody">

				<?php 
				$model = new PromotionProduct();
				foreach ($model->getget() as $k=>$v){ ?>
				<tr class="sss" data-toggle="collapse" data-target="#collapse<?php echo $v['id']; ?>">
					
					
					<td style="width:32%;padding-top: 20px;"><?php echo $v['name'] ?></td>
					<td style="width:15%;padding-top: 20px;">
						<?php if($v['status']==1){echo 'Đang duyệt';}
    						  elseif($v['status']==2){ echo 'Khởi động'; } 
    						   elseif($v['status']==3){ echo 'Tạm dừng'; }
    						    elseif($v['status']==4){ echo 'Kết thúc'; }
    						    else{ echo "Xóa"; } 
    						  ?>
	                       
	                  
					</td>
					
					<td style="width:14%;padding-top: 20px;"><?php echo $v['start_date']; ?></td>
					<td style="width:14%;padding-top: 20px;"><?php echo $v['end_date']; ?></td>
					<td style="width:22%;padding-top: 20px;"> 
						<?php 
								 if($v['type_price']==1){echo 'Phần trăm (%)';}
								 elseif($v['type_price']==2){echo 'Giảm theo số tiền';}
								 elseif($v['type_price']==3){echo 'Giảm giá cố định';}
								 else{echo 'Giảm theo giá trị';}
						?>
                       
				</td>
					 	
					
				</tr>
				<tr id="collapse<?php echo $v['id']; ?>" class="   collapse trdetail">
					<td  colspan="6">
						<?php include'detail_promotion.php'; ?>
			      	</td>
		      </tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
	
		


<script type="text/javascript">
	$( document ).ready(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var head = $('.head').height();
    var tbhead  = $('.tbhead').height();
    $('#t_bd').height(windowHeight-header-head-tbhead-30);
    $('#profileSideNav').height(windowHeight-header);
    $('.customerListContainer').height(windowHeight-header);
    $('#detailCustomer').height(windowHeight-header);
    $('.cal-loading').fadeOut('slow');

});
	$(window).resize(function() {
     var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var head = $('.head').height();
    var tbhead  = $('.tbhead').height();
    $('#t_bd').height(windowHeight-header-head-tbhead-30);
    $('#profileSideNav').height(windowHeight-header);
    $('.customerListContainer').height(windowHeight-header);
    $('#detailCustomer').height(windowHeight-header);

});
	$('.collapse').on('show.bs.collapse', function () {    
    $('.collapse.in').collapse('hide');   
});
</script>