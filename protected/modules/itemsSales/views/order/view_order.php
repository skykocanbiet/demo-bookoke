<style>
	.sHeader{background: #0eb1dc; color: white; padding: 8px 30px; font-size: 18px;}
	.view_info tbody>tr>td, .view_info tbody>tr>th {padding-bottom: 4px;}
	.view_sum tbody>tr>td {border: 0;padding-bottom: 5px;}
	.line {border-top: 1px solid #ccc;}
	.view_btn button, .view_btn a {background: #94c63f; color: white;}
   
</style>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
    	<div class="modal-header sHeader">
	       	Hóa đơn điều trị
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    </div>
	    <div class="modal-body">
		    <div class="row">
		    	<div class="col-md-6">
		    	<input type="hidden" name="id_order" value="<?php echo $order['id']; ?>">
		        	<table class="view_info">
	        			<tr>
	        				<th class="text-right">Văn phòng:</th>
	        				<td class="text-left"><?php echo $order['branch_name']; ?></td>
	        			</tr>
	        			<tr>
	        				<th class="text-right">Mã đơn hàng: </th>
	        				<td class="text-left"><?php echo $order['code']; ?></td>
	        			</tr>
	        			<tr>
	        				<th class="text-right">Khách hàng: </th>
	        				<td class="text-left"><?php echo $order['customer_name']; ?></td>
	        			</tr>
		        	</table>
		        </div>
		        <div class="col-md-6">
		        	<table class="pull-right view_info">
	        			<tr>
	        				<th class="text-right">Ngày tạo hóa đơn: </th>
	        				<td class="text-left"><?php echo $order['create_date']; ?></td>
	        			</tr>
	        			<tr>
	        				<th class="text-right">Ngày hết hạn: </th>
	        				<td class="text-left"><?php echo $order['create_date']; ?></td>
	        			</tr>
		        	</table>
		        </div>
			    <div class="col-md-12">
			    	<div class="col-md-12 text-right"><span>Đơn vị: VNĐ</span></div>
			    	<table class="table table-bordered">
			            <thead>
			                <tr>
			                    <th>Người thực hiện</th>
			                    <th>Sản phẩm và Dịch vụ</th>
			                    <th>Số lượng</th>
			                    <th>Đơn giá</th>
			                    <th>Thuế</th>
			                    <th>Tổng tiền</th>
			                </tr>
			            </thead>
			            <tbody>
			            	<?php foreach ($orderDetail as $key => $value): ?>
			            		<tr>
				                    <td><?php echo $value['user_name']; ?></td>
				                    <td><?php if ($value['services_name'] != '')
				                    			echo $value['services_name'];
				                    		elseif ($value['product_name'] != '') {
				                    			echo $value['product_name'];
				                    		}
				                    	?>
				                    </td>
				                    <td><?php echo $value['qty']; ?></td>
				                    <td class="autoNum"><?php echo $value['unit_price']; ?></td>
				                    <td class="autoNum"><?php echo $value['tax']; ?></td>
				                    <td class="autoNum"><?php echo $value['amount']; ?></td>
				                </tr>
				            <?php endforeach; ?>
			            </tbody>
			        </table>
	        	</div>
				<div class="col-md-7" id="pay_history" style="margin-bottom: 15px;">
					<?php 	$pay = 0;
							$balance = $order['sum_amount'];
						if ($paymentDetail): ?>
						<h5>Lịch sử thanh toán:</h5>
			        	<?php foreach ($paymentDetail as $key => $vl): 
			        		$hidden = ($key >= 3) ? 'hidden' : '';
			        	?>
			        		<div class="<?php echo $hidden; ?>">
			        			<span><?php echo date_format(date_create($vl['pay_date']),"d/m/Y"); ?></span> | <span class="autoNum"><?php echo $vl['pay_amount']; ?></span> VNĐ | <span><?php echo $pay_type[$vl['pay_type']]; ?></span>
			        		</div>
			        		<?php $pay = (int)$order['sum_amount']-(int)$order['balance']; 
			        		$balance = $order['balance'];?>
			        	<?php endforeach ?>
			        	<?php if ($hidden): ?>
			        		<a href="#" class="pay_detail">Xem thêm ...</a>
			        	<?php endif ?>
			        <?php endif ?>
				</div>
	        	<div class="col-md-5 pull-right">
		            <table class="table view_sum">
		                <tbody>
		                    <tr>
		                        <td class="text-right"><b>Bao gồm thuế</b></td>
		                        <td class="text-left"><b class="autoNum"><?php echo $order['sum_tax']; ?></b> VNĐ</td>
		                    </tr>
		                    <tr>
		                        <td class="text-right"><b>Tổng cộng</b></td>
		                        <td class="text-left"><b class="autoNum"><?php echo $order['sum_amount']; ?></b> VNĐ</td>
		                    </tr>
		                     <tr class="line">
		                        <td class="text-right"><b>Đã trả</b></td>
		                        <td class="text-left"><b class="autoNum"><?php echo $pay; ?></b> VNĐ</td>
		                    </tr>
		                     <tr>
		                        <td class="text-right"><b>Còn lại</b></td>
		                        <td class="text-left"><b class="autoNum"><?php echo $balance; ?></b> VNĐ</td>
		                    </tr>                             
		                </tbody>
		            </table>
		        </div>
		        <div class=" clearfix"></div>
		        
		        <?php $btn = '<button class="btn oBtnDetail cal_pay">Thanh toán</button>';
		        	if($order['id_invoice'] && $order['balance'] == 0) {
		        		$btn = '<a href="'. Yii::app()->getBaseUrl().'/itemsSales/invoices/View?id='.$order['id'].'" class="btn oBtnDetail">Xem chi tiết</a>';
		        	} ?>
		        
		        <div class="col-md-12 text-left view_btn">
		            <button type="button" class="btn oBtnDetail">In đơn hàng</button>
		            <button type="button" class="btn oBtnDetail">Gửi email</button>
		            <?php echo $btn; ?>
		        </div>
        	</div>
    	</div>
    </div>
</div>


<?php include 'view_order_js.php'; ?>