
<p class="tt" style="float:left;">Danh Sách Khách Hàng sử dụng dịch vụ</p>
<!-- 	<p style="font-size: 20pt;font-weight: 400;">Elite Dental</p>
 -->	<p style="float:right; padding-top:11px; font-size:15px;"><?php echo ''.$fromdate.' đến '.$todate.', '.$data.', '.$nhanvien.'';  ?></p>
	<!-- <hr> -->
	<div class="table table-responsive">
	  <table class="table table-hover">
	  	<thead class="headertable">
	  		<tr>
	  			<th>Mã số</th>
	  			<th>Họ và Tên</th>
	  			<th>Ngày sinh</th>
	  			<th>Giới tính</th>
	  			<th>Email</th>
	  			<th>Số điện thoại</th>
	  			<th>Địa chỉ</th>
	  			<th>Dịch vụ</th>
	  			<th>BS điều trị</th>
	  			<th>Tổng tiền</th>
	  			<th>Nguồn</th>
	  			<th>Giới thiệu</th>

	  			 					
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
	  			
	  			<td><?php if( $value['birthdate'] != ''){ echo $value['birthdate']; }else {
	  				# code...
	  			echo "N/A";} ?></td>
	  			<td><?php if ($value['gender']==1){ echo 'Nam'; }else{ echo "Nữ";}  ?></td>
	  			<td><?php echo $value['email']; ?></td>
	  			<td><?php echo $value['phone']; ?></td>
	  			<td><?php echo $value['address']; ?></td>
	  			<td><?= $value['name_service'] ?></td>
	  			<td><?= $value['user_name'] ?></td>	
	  			<td><?= (string)number_format($value['amount'] ,0,",",",")  ?></td>
	  			<td><?= $value['name_source'] ?></td>	
	  			<td><?= $value['introducer'] ?></td>
	  		</tr>
	  	<?php } ?>
	  		<tr>
	  			<td colspan="11"><div class="total-customer">Tổng số khách hàng: <?php echo $count; ?></div></td>
	  		</tr>
	  	</tbody>
	  </table>
	</div>

	<div align="center">
             
</div>

