<p class="tt" style="float:left;">Danh Sách Ghi Chú Khách Hàng</p>
<!-- 	<p style="font-size: 20pt;font-weight: 400;">Elite Dental</p>
 -->	<p style="float:right; padding-top:11px; font-size:15px;"><?php echo ' Từ '.$fromdate.' đến '.$todate.', '.$data.', '.$nhanvien.'';  ?></p>
	<!-- <hr> -->
	<div class="table table-responsive">
	  <table class="table table-hover">
	  	<thead class="headertable">
            <tr>
                <th class="text-align-center" colspan="3">Khách hàng</th>               
                
                <th>Phân loại</th>
                <th>Trạng thái</th>
                <th style="width: 30%;">Nội dung</th>
                
                <th>nhân viên</th>
                                    
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
	  			<td><a class="id-report" href="<?php echo yii::app()->request->baseUrl;?>/itemsCustomers/Accounts/admin?code_number=<?php echo $value["code_number"]; ?>"><?php echo $value['code_number']; ?></a></td>
	  			<td><?php echo $value['fullname']; ?></td>
	  			<td><?php echo $value['phone']; ?></td>
	  			
	  			<td><?php if($value['flag']==1){ echo "Lịch hẹn" ;}elseif ($value['flag']==2){echo "Hoạt động";}elseif ($value['flag']==3){echo "Điều trị";}elseif ($value['flag']==4){echo "Báo giá";} ?></td>
	  			<td><?php if($value['note_status']==1){ echo "Ghi nhân"; }elseif ($value['note_status']==2){echo "Đang giải quyết";}elseif ($value['note_status']==3){echo "Hoàn tất";}else{echo "Hủy"; } ?></td>
	  			<td><?php echo $value['note']; ?></td>
	  			<td><?php echo $value['user_name']; ?></td>
               
              					
	  		</tr>
	  	<?php } ?>
	  		<tr>
	  			<td colspan="7"><div class="total-customer">Tổng số khách hàng: <?php echo $count; ?></div></td>
	  		</tr>
	  	</tbody>
	  </table>
	</div>