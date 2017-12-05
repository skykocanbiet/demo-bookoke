

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
	  			<th class="text-align-center" colspan="3" style="width: 40%;">Khách hàng</th> 	  			
	  			
	  			<th style="width: 10%;">Phân loại</th>
	  			<th style="width: 10%;">Trạng thái</th>
	  			<th style="width: 30%;">Ghi chú</th>
	  			
	  			<th style="width: 10%;">Nhân viên</th>
	  							
	  		</tr>
            <tr>
                <th>ID</th>         
                <th>Họ và Tên</th>
                <th>Số điện thoại</th>   
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
	  			
	  			<td style="width: 15%;"><a class="id-report" href="<?php echo yii::app()->request->baseUrl;?>/itemsCustomers/Accounts/admin?code_number=<?php echo $value["code_number"]; ?>"><?php echo $value['code_number']; ?></a></td>
	  			<td style="width: 15%;"><?php echo $value['fullname']; ?></td>
	  			<td style="width: 10%;"><?php echo $value['phone']; ?></td>
	  			
	  			<td style="width: 7%;"><?php if($value['flag']==1){ echo "Lịch hẹn" ;}elseif ($value['flag']==2){echo "Hoạt động";}elseif ($value['flag']==3){echo "Điều trị";}elseif ($value['flag']==4){echo "Báo giá";} ?></td>
	  			<td style="width: 8%;"><?php if($value['note_status']==1){ echo "Ghi nhân"; }elseif ($value['note_status']==2){echo "Đang giải quyết";}elseif ($value['note_status']==3){echo "Hoàn tất";}else{echo "Hủy"; } ?></td>
	  			<td style="width: 30%;"><?php echo $value['note']; ?></td>
	  			<td style="width: 15%;"><?php echo $value['user_name']; ?></td>
               
              										
	  						
	  		</tr>
	  	<?php } ?>
	  		
	  	</tbody>
	  </table>
	
</page>

