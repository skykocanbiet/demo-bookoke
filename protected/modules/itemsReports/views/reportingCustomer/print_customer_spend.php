

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
 -->	<p style="text-align: center; padding-top:11px; font-size:15px;"><?php echo ''.$fromdate.' đến '.$todate.', '.$data.', '.$nhanvien.'';  ?></p>
	 
	  <table class="ivDt " style="width: 100%; padding: 20px 35px;">
	  	<thead class="">
	  		<tr>
	  			<th class="text-align-center" colspan="3">Khách hàng</th> 	  			
	  			
	  			<th>Số dịch vụ</th>
	  			<th>Báo giá</th>
	  			<th>Hóa đơn</th>
	  			
	  			<th>Thanh toán</th>
	  			<th>Công nợ</th>	  					
	  		</tr>
            <tr>
                <th>ID</th>         
                <th>Họ và Tên</th>
                <th>Số điện thoại</th>   
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
	  			<td><?php echo $value['phone']; ?></td>
	  			<td><?php echo $value['count_service']; ?></td>
	  			<td><?php echo number_format($value['amount_quotation'] ,0,",","."); ?></td>
	  			<td><?php echo number_format($value['amount_invoice'] ,0,",","."); ?></td>
	  			<td><?php echo number_format(($value['amount_invoice']-$value['sum_balance']) ,0,",","."); ?></td>
                <td><?php echo number_format($value['sum_balance'] ,0,",","."); ?></td>  
              										
	  						
	  		</tr>
	  	<?php } ?>
	  		
	  	</tbody>
	  </table>
	
</page>

