<p class="tt" style="float:left;">Danh Sách Chi Tiêu Khách Hàng</p>
<!-- 	<p style="font-size: 20pt;font-weight: 400;">Elite Dental</p>
 -->	<p style="float:right; padding-top:11px; font-size:15px;"><?php echo ' Từ '.$fromdate.' đến '.$todate.', '.$data.', '.$nhanvien.'';  ?></p>
	<!-- <hr> -->
	<div >
	  <table class="table table-hover">
	  	<thead class="headertable">
	  		<tr>
	  			<th class="text-align-center" colspan="8" style="width: 25%;">Khách hàng</th> 	  			
	  			
	  			<th>Số dịch vụ</th>
	  			<th>Báo giá</th>
	  			<th>Hóa đơn</th>
	  			
	  			<th>Thanh toán</th>
	  			<th>Công nợ</th>
	  			<th>Bác sĩ</th>	  					
	  		</tr>
            <tr>
                <th>ID</th>         
                <th>Họ và Tên</th>
                <th>Giới tính</th>
                <th>Số điện thoại</th>   
                
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Nguồn</th>
                <th>Giới thiệu</th>
                <th></th>  
                <th></th>  
                <th></th>  
                <th></th>  
                <th></th>  
                <th></th>                           
            </tr>
	  	</thead>
	  	<tbody>
	  	<?php 
	  	foreach ($cs as $key => $value){
	  		# code...
	  	?>
	  		<tr class="sort-field">
	  			<td><a class="id-report" href="<?php echo yii::app()->request->baseUrl;?>/itemsCustomers/Accounts/admin?code_number=<?php echo $value["code_number"]; ?>"><?php echo $value['code_number']; ?></a></td>
	  			<td><?php echo $value['fullname']; ?></td>
	  			<td><?php if ($value['gender']==1){ echo 'Nam'; }else{ echo "Nữ";}  ?></td>

	  			<td><?php echo $value['phone']; ?></td>
	  			<td style="width: 10%;"><?php echo $value['email']; ?></td>

	  			<td><?php echo $value['address']; ?></td>

	  			<td><?php echo $value['name_source']; ?></td>
	  			<td><?php echo $value['introducer']; ?></td>
	
	  			<td><?php echo $value['count_service']; ?></td>

	  			<td><?php echo number_format($value['amount_quotation'] ,0,",",","); ?></td>
	  			<td><?php echo number_format($value['amount_invoice'] ,0,",",","); ?></td>
	  			<td><?php echo number_format(($value['amount_invoice']-$value['sum_balance']) ,0,",",","); ?></td>
                <td><?php echo number_format($value['sum_balance'] ,0,",",","); ?></td>  
                <td><?php echo $value['user_name']; ?></td>
              					
	  		</tr>
	  	<?php } ?>
	  		<tr>
	  			<td colspan="12"><div class="total-customer">Tổng số khách hàng: <?php echo $count; ?></div></td>
	  		</tr>
	  	</tbody>
	  </table>
	</div>