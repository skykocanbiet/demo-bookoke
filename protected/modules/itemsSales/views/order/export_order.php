<style>
p, a, td {
	word-wrap: break-word;
}
</style>
<page style="font: arial;font-family:freeserif ;">
<div style="padding-left: 10pt;padding-right: 10pt;">
	<!-- header -->
	<div style="width: 100%">
        <table style="width: 100%;margin-top: 15pt;">
            <tbody>
                <tr>
                    <td style="color: #222; padding-right: 50pt;">
                   		<?php echo CHtml::image('images/logo_vi.png', 'EliteDental', array('width'=>230)); ?>
                    </td>

                    <td style="color: #222; padding-top: 5pt;">
						<strong><?php echo $branch['name']; ?></strong><br/><br/>
						<strong>Địa chỉ:</strong> <?php echo $branch['address']; ?><br/>
						<strong>Điện thoại:</strong> <?php echo $branch['hotline1']; ?> - <?php echo $branch['hotline2']; ?><br/>
						<strong>Email:</strong> <?php echo $branch['email']; ?><br/>
                    </td>
                </tr>
            </tbody>
        </table>
    </div> <!-- end table-->
	
	<!-- info customer -->
    <div style=" margin-top: 15pt;">
    	<div style="width: 100%;">
	    	<table>
	    		<tbody>
	    			<tr>
	    				<td style="width: 100mm;">
	    					<p style="color: #222; font-weight: bold; font-size: 17pt;">Thông tin khách hàng</p>
					        <table style="width: 100%;">
					            <tbody>
					                <tr>
					                    <td style="color: #222; padding-right: 15pt;"><strong>Họ tên:</strong></td>
					                    <td style="color: #222;"><?php echo $order['customer_name']; ?></td>
					                </tr>
					                <tr>
					                    <td style="color: #222;padding-top: 5pt; padding-right: 15pt;"><strong>Địa chỉ:</strong></td>
					                    <td style="color: #222;padding-top: 5pt;"><?php echo $cus['address']; ?></td>
					                </tr>
					                <tr>
					                    <td style="color: #222;padding-top: 5pt; padding-right: 15pt;"><strong>Điện thoại:</strong></td>
					                    <td style="color: #222;padding-top: 5pt;"><?php echo $cus['phone']; ?></td>
					                </tr>
					                <tr>
					                    <td style="color: #222;padding-top: 5pt; padding-right: 15pt;"><strong>Email:</strong></td>
					                    <td style="color: #222;padding-top: 5pt;"><?php echo $cus['email']; ?></td>
					                </tr>
					              </tbody>
					        </table>
	    				</td>
	    				<td style="width: 100mm;">
	    					<p style="color: #222; font-weight: bold; font-size: 17pt;">Thông tin đơn hàng</p>
					        <table style="width: 100%;">
					            <tbody>
					                <tr>
					                    <td style="color: #222; padding-right: 15pt;"><strong>Mã đơn hàng:</strong></td>
					                    <td style="color: #222;"><?php echo $order['code']; ?></td>
					                </tr>
					                <tr>
					                    <td style="color: #222;padding-top: 5pt; padding-right: 15pt;"><strong>Người tạo:</strong></td>
					                    <td style="color: #222;padding-top: 5pt;"><?php echo $order['author_name']; ?></td>
					                </tr>
					                <tr>
					                    <td style="color: #222;padding-top: 5pt; padding-right: 15pt;"><strong>Ngày tạo:</strong></td>
					                    <td style="color: #222;padding-top: 5pt;"><?php echo $order['create_date']; ?></td>
					                </tr>
					              </tbody>
					        </table>
	    				</td>
	    			</tr>
	    		</tbody>
	    	</table>
    		
    	</div>
    </div> 

    <div style=" margin-top: 10pt;" >
            <p style="font-size: 17pt; font-weight: bold;color: #222;">Danh mục đơn hàng</p>
			<div style="padding-left: 180mm;">Đơn vị: VNĐ</div>
            <table>
                <thead >
	                <tr style="background-color:#8FAAB1;">
	                    <th style="padding: 8px auto;text-align:center; color: #fff; width: 40mm;"><strong>Người thực hiện</strong></th>
	                    <th style="padding: 8px auto;text-align:center; color: #fff; width: 60mm;"><strong>Sản phẩm và dịch vụ</strong></th>
	                    <th style="padding: 8px auto;text-align:center; color: #fff; width: 20mm;"><strong>Số lượng</strong></th>
	                    <th style="padding: 8px auto;text-align:center; color: #fff; width: 28mm;"><strong>Đơn giá</strong></th>
	                    <th style="padding: 8px auto;text-align:center; color: #fff; width: 20mm;"><strong>Thuế</strong></th>
	                    <th style="padding: 8px auto;text-align:center; color: #fff; width: 28mm;"><strong>Tổng tiền</strong></th>
	            	</tr>
                </thead>
                <tbody>
                	<?php if ($orderDetail): ?>
                		<?php foreach ($orderDetail as $key => $value): ?>
                		<tr>
		                    <td style="width: 40mm;text-align: center; padding: 8px auto;"><?php echo $value['user_name']; ?></td>
		                    <td style="text-align: center; padding: 8px auto; width: 60mm;"><?php echo $value['description']; ?></td>
		                    <td style="width: 20mm;text-align: center; padding: 8px auto;"><?php echo $value['qty']; ?></td>
		                    <td style="text-align: center; padding: 8px auto; width: 28mm;"><?php echo number_format($value['unit_price'],0,'','.'); ?></td>
		                    <td style="text-align: center; padding: 8px auto;width: 20mm;"><?php echo number_format($value['tax'],0,'','.'); ?></td>
		                    <td style="text-align: center; padding: 8px auto;width: 28mm;"><?php echo number_format($value['amount'],0,'','.'); ?></td>
		            	</tr>
                		<?php endforeach ?>
                	<?php endif ?>
                
                <tr style="background-color: #fff;">
                    <td colspan="2" style=""></td>
                    <td colspan="2" style="padding-top: 12pt; padding-right: 15pt; color: #222; text-align: right;"><strong>Bao gồm thuế:</strong></td>
                    <td colspan="2" style="padding-top: 12pt; color: #222; text-align: left;">
                    	<?php echo number_format($order['sum_tax'],0,'','.'); ?> VNĐ
                    </td>
            	</tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2" style="padding-top: 12pt; padding-right: 15pt; color: #222; text-align: right;"><strong>Tổng cộng:</strong></td>
                    <td colspan="2" style="padding-top: 12pt; color: #222; text-align: left;">
                    	<?php  echo number_format($order['sum_amount'],0,'','.');?> VNĐ
                    </td>
            	</tr>
            </tbody>
            </table>
        </div>
        <div>
        <p style="margin:25pt 0pt 0pt 0pt;color: #222; text-align: left;font-style: italic;"><strong>Ghi chú:</strong> <br/>
        	<?php echo($order['note']); ?></p>
        </div>
      
</div>
</page>
