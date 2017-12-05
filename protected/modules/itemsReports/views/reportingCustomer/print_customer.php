

	<!-- <hr> -->
<style type="text/css">
p, a, td {
	word-wrap: break-word;
    font-size: 10pt;
}
.ivDt {
	width: 100%;
	border-collapse: collapse;
}
.ivDt thead tr{
	background: #8FAAB1;
	font-size: 10pt;
}
.ivDt thead th, .ivDt tbody td{
	padding: 8px auto;
	text-align: center;
	color: #fff;
	border: 1px solid #ccc;
}
.ivDt tbody td{
	color: #000;	
}
</style>	
<page   style="font: arial;font-family:freeserif ;">

<p style="text-align: center;font-size: 20px;margin-top:50px;"><?PHP echo $total; ?></p><!-- 	<p style="font-size: 20pt;font-weight: 400;">Elite Dental</p>
 -->	<p style="float:right; padding-top:11px; font-size:15px;"><?php echo ''.$fromdate.' đến '.$todate.', '.$data.', '.$nhanvien.'';  ?></p>
	  <table class="ivDt">
	  	<thead class="headertable">
	  		<tr>
	  			<th style="width: 7%;" >Mã số</th>
	  			<th style="width: 8%;">Ngày tạo</th>
	  			<th style="width: 10%;" >Họ và Tên</th>
	  			<th style="width: 5%;">ID</th>
	  			<th style="width: 5%;">Ngày sinh</th>
	  			<th style="width: 5%;">Giới tính</th>
	  			<th style="width: 10%;" >Email</th>
	  			<th style="width: 10%;" >Số điện thoại</th>
	  			<th style="width: 10%;" >Địa chỉ</th>
	  			<th style="width: 5%;">Nghề nghiệp</th>
	  			<th style="width: 5%;">Hội viên</th>
	  			<th style="width: 5%;">Nguồn</th>
	  			<th style="width: 5%;">Nhóm</th>
	  			<th style="width: 5%;">Bảo hiểm</th>
	  			<th style="width: 5%;">Ngày hẹn cuối</th>	  					
	  		</tr>
	  	</thead>
	  	<tbody>
	  	<?php 
	  	foreach ($cs as $key => $value){
	  		# code...
	  	?>
	  		<tr class="sort-field">
	  			<td style="width: 7%;"><?php echo $value['code_number']; ?></td>
	  			<td style="width: 8%;"><?php echo date('d/m/Y',strtotime($value['createdate'])); ?></td>
	  			<td style="width: 10%;"><?php echo $value['fullname']; ?></td>
	  			<td style="width: 5%;"><?php echo $value['id']; ?></td>
	  			<td style="width: 5%;"><?php if( $value['birthdate'] != ''){ echo $value['birthdate']; }else {
	  				# code...
	  			echo "N/A";} ?></td>
	  			<td><?php if ($value['gender']==1){ echo 'Nam'; } echo "Nữ";  ?></td>
	  			<td><?php echo $value['email']; ?></td>
	  			<td><?php echo $value['phone']; ?></td>
	  			<td style="width: 10%;"><?php echo $value['address']; ?></td>
	  			<td style="width: 5%;">N/A</td>
	  			<td style="width: 5%;">N/A</td>
	  			<td style="width: 5%;">N/A</td>
	  			<td style="width: 5%;">N/A</td>
	  			<td style="width: 5%;">N/A</td>
	  			<td style="width: 5%;">N/A</td>	  			
	  		</tr>
	  	<?php } ?>
	  		<tr>
	  			
	  		</tr>
	  	</tbody>
	  </table>
</page>

