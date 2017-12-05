
<style type="text/css">
    .tm1 {width: 5% !important;}
    .tm2 {width: 12% !important;}
    .tm4 {width: 7% !important;}
    .tm6 {width: 7.5% !important;}
    .tm7 {width: 7% !important;}
    .tm8 {width: 8% !important;}
</style>

<div class="col-md-12 tableList"> 
    <table class="table table-condensed table-hover" id="oListT" style="border-collapse:collapse;">
        <thead>
            <tr>
                <th>Mã điều trị</th>
                <th>Khách hàng</th>
                <th>Văn phòng</th>
                <th>Người tạo</th>
                <th>Ngày tiến hành</th>
                <th>Ngày hoàn tất</th>
                <!-- <th>Công nợ</th> -->
          </tr>
       </thead>
       <tbody>
<?php if ($orderList == -1): ?>
    <tr><td colspan="7" rowspan="" headers="">Không có dữ liệu!</td></tr>
<?php else: ?>

<?php foreach ($orderList as $key => $v): 
    $id = $v['id'];?>
    <tr data-toggle="collapse" data-target="#q<?php echo $v['id'];?>" class="accordion-toggle <?php if($key%2!=0) echo "tr_col"; ?>">
        <td style="padding: 8px 20px;"><?php echo $v['id_group_history']; ?></td>
        <td><?php echo $v['customer_name']; ?></td>
        <td><?php echo $v['branch_name']; ?></td>
        <td><?php echo $v['author_name']; ?></td>
        <td><?php echo $v['create_date']; ?></td>
        <td><?php echo $v['create_date']; ?></td>
        <!-- <td class="autoNum"><?php //echo $v['sum_amount']; ?></td> -->
    </tr>
    <tr >
        <input type="hidden" name="id_quote" value="<?php echo $v['id']; ?>">
		<td colspan="7" class="hiddenRow">
			<div class="accordian-body collapse oView col-md-12" id="q<?php echo $v['id'];?>">
				<div class="oViewDetail col-md-12">
    <div id="oInfo" class="col-md-12">
        <div class="col-md-6 text-left">
            <div class="row">
            	<table>
            		<tbody>
            			<tr>
            				<th class="text-right">Khách hàng: </th>
            				<td class="text-left"><?php echo $v['customer_name']; ?></td>
            			</tr>
                        <tr>
                            <th class="text-right">Mã báo giá: </th>
                            <td class="text-left"><?php echo $v['code']; ?></td>
                        </tr>
                        <!-- <tr>
                            <th class="text-right">Mã điều trị: </th>
                            <td class="text-left"><?php //echo $v['code']; ?></td>
                        </tr> -->
            		</tbody>
            	</table>
            </div>
        </div>
        <div class="col-md-6">
        	<div class="row">
            	<table class="pull-right">
            		<tbody>
                        <tr>
                            <th class="text-right">Văn phòng:</th>
                            <td class="text-left"><?php echo $v['branch_name']; ?></td>
                        </tr>
            			<tr>
            				<th  class="text-right">Ngày tạo đơn hàng: </th>
            				<td  class="text-left"><?php echo $v['create_date']; ?></td>
            			</tr>
            			<tr>
            				<th  class="text-right">Ngày hết hạn: </th>
            				<td  class="text-left"><?php echo $v['create_date']; ?></td>
            			</tr>
            		</tbody>
            	</table>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-right"><span>Đơn vị: VNĐ</span></div>
        <table class="table oViewB">
            <thead>
                <tr>
                    <th class="tm1" style="border-left: 0;"">STT</th>
                    <th class="tm2">Ngày điều trị</th>
                    <th class="tm3">Chuẩn đoán</th>
                    <th class="tm4">Răng số</th>
                    <th class="tm5">Dịch vụ</th>
                    <th class="tm6">Đơn giá</th>
                    <th class="tm7">Số lượng</th>
                    <th class="tm8" style="border-right: 0">Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
	<?php $orderDetails = array_filter($orderDetail,function($v) use ($id){
			if($v['id_quotation'] == $id)
				return true;
		});
	?>
	<?php $sum = 0;
        foreach ($orderDetails as $key => $value): 
            $sum += $value['amount'];
    ?>
        <tr class="deta">
            <td class="tm1"><?php echo $key+1; ?></td>
            <td class="tm2"><?php echo $value['create_date']; ?></td>
            <td class="tm3"><?php echo $value['diagnose']; ?></td>
            <td class="tm4"><?php echo str_replace(',',' ',$value['teeth']); ?></td>
            <td class="tm5"><?php echo $value['description']; ?></td>
            <td class="autoNum tm6"><?php echo $value['unit_price']; ?></td>
            <td class="tm7"><?php echo $value['qty']; ?></td>
            <td class="autoNum tm8"><?php echo $value['amount'] ?></td>
        </tr>
		
	<?php endforeach ?>
            <tr>
                <td colspan="7" class="text-right"><b>Tổng cộng</b></td>
                <td colspan="1" class="autoNum tm8"><?php echo $sum; ?></b></td>
            </tr>

            <tr>
                <td colspan="7">
                    <div id="pBtn" class="text-left">
                        <!-- <a class="btn btn_bookoke oUpdate">Cập nhật</a> -->
                        <button type="button" class="btn btn_bookoke" onclick="exportOrder(<?php echo $v['id_group_history'].','.$v['id_customer']; ?>);">In điều trị</button>
                        <button type="button" class="btn btn_bookoke">Gửi email</button>
                        <span class="pull-right"><button type="button" class="btn btn_cancel">Hủy</button></span>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
</div>
			</div>
		</td>
    </tr>
<?php endforeach ?>
<?php endif ?>
       </tbody>
    </table>
</div>

<div style="clear:both"></div>
<div id="" class="row fix_bottom">
    <?php if($page_list) echo $page_list;?>
</div>

<script>
$(function(){
    win = $(window).height();
    head = $('#headerMenu').height();
    srch = $('#oSrchBar').height();    
    $('.tableList .table>tbody').css('max-height',win - head - srch - 120);
    
    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    $('.autoNum').autoNumeric('init',numberOptions);

    $('.oUpdate').click(function(e) {
        $('#update_order_modal').modal('show');
    });
})
</script>