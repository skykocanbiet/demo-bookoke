<?php include 'style.php' ?>


<div class="col-md-12 margin-top-20" id="return_content">
	<p class="title-report tt">Tổng hợp lịch hẹn</p>
	<p class="time-report">
	<?= $title_report;?>
	<?php
	//  if($search_time == "1"){
	// 	$fromdate = date("d-m-Y");
	// 	$todate= "";
	// 	echo $fromdate .',';
	// } elseif($search_time == "2"){
	// 	$fromdate = date("d-m-Y",strtotime('monday this week'));
	// 	$todate= date("d-m-Y",strtotime('sunday this week'));
	// 	echo $fromdate .' đến '.$todate .',';
	// }elseif($search_time == "3"){
	// 	 $fromdate = date("01-m-Y", strtotime("first day of this month"));
	// 	 $todate= date("t-m-Y", strtotime("last day of this month"));
	// 	 echo $fromdate .' đến '.$todate .',';
	// }elseif($search_time == "4"){
	// 	$fromdate = date("d-m-Y", strtotime('first day of last month'));
 //    	$todate= date("d-m-Y", strtotime('last day of last month'));
	// 	echo $fromdate .' đến '.$todate .',';
	// }else{
	// 	echo $fromtime .' đến '.$totime .',';
	// }
	// if($branch == ""){
	// 	echo "Tất cả vị trí";
	// } else{
	// 	$branchList =  Branch::model()->findByPk($branch);
	// 	echo 'Văn phòng:'.$branchList->name .',';
	// }
	// if($user == ""){
	// 	echo "Tất cả nhân viên";
	// } else{
	// 	$userList =  GpUsers::model()->findByPk($user);
	// 	echo 'Bác sĩ:'.$userList->name;
	// }
	?>
	</p>
	
 	<div class="table table-responsive">
	 	<table class="table table-bordered table-hover">
	  	<thead class="headertable">
	  		<tr>
	  			<th>Ngày </th>
	  			<th colspan="">Văn phòng</th>
	  			<th colspan="">Khách hàng</th>
	  			<th colspan="">Nhân viên</th>
	  			<th>Ngày tạo</th>
	  			<th>Bắt đầu</th>
	  			<th>Kết thúc</th>
	  			<th>Nội dung</th>
	  			<th>Người tạo</th>
	  			<th>Trạng thái</th>
	  			<th>Tổng tiền</th>
	  			<th colspan="">Hóa đơn</th>
	  		</tr>
	  	</thead>
	  	<tbody>
	  		<?php if ($appointmentList == -2): ?>
			    <tr><td colspan="12" rowspan="" headers="">Không có dữ liệu!</td></tr>
			<?php else: 
			$status_0 = 0;
			$status_1 = 0;
			$status_2 = 0;
			$status_3 = 0;
			$status_4 = 0;
			$status_5 = 0;
			$status_6 = 0;
			$status_7 = 0;
			$status_8 = 0;
			?>
				<?php foreach ($appointmentList as $key => $v): ?>
					<tr>
						<td><?php echo date_format(date_create($v['create_date']),'d-m-Y'); ?></td>
						<td><?php 
							$id_branch = $v['id_branch'];
							$branch =  Branch::model()->findByPk($id_branch);
							echo $branch->name;
							?>
						</td>
						<td><?php echo $v['fullname'];?></td>
						<td><?php echo $v['name_dentist'];?></td>
						<td><?php echo date_format(date_create($v['create_date']),'d-m-Y'); ?></td>
						<td><?php echo $v['start_time']; ?></td>
						<td><?php echo $v['end_time']; ?></td>
						<td style="width: 15%;"><?php echo $v['name_service'];?></td>
						<td><?php echo $v['author'];?></td>
						<td><?php if($v['status']==-1){echo "Hủy hẹn";}
								  elseif($v['status']==0){echo "Không làm việc";}
								  elseif($v['status']==1){echo "Lịch mới";}
								  elseif($v['status']==2){echo "Đã đến";}
								  elseif($v['status']==3){echo "Vào khám";}
								  elseif($v['status']==4){echo "Hoàn tất";}
								  elseif($v['status']==5){echo "Bỏ về";}
								  else{echo "Không đến";} ?></td>

								  <?php if($v['status']==-2){$status_1++;}
								  elseif($v['status']==-1){$status_2++;}
								  elseif($v['status']==0){$status_3++;}
								  elseif($v['status']==1){$status_4++;}
								  elseif($v['status']==2){$status_5++;}
								  elseif($v['status']==3){$status_6++;}
								  elseif($v['status']==4){$status_7++;}
								  else{$status_8++;} ?>

						<?php $id_quotation = $v['id_quotation'];

					  	if($id_quotation ==''){ ?>

					   	<td>N/A</td>
					   	<?php }else{
					   		
					   		$quotation = Quotation::model()->findByPk($id_quotation); 
					   		?>
					   		<td class="autoNum"><?php  if($quotation){ echo $quotation->sum_amount;  }else{ echo  "N/A"; } ?></td>
					   		
					   	<?php }?>
						<td>N/A</td>
					</tr>
				<?php endforeach ?>
				<tr>
		  			<td colspan="12" style="text-align: left;"><b>Tổng lịch hẹn:</b> <?php echo $count?>  <i>(
		  			Không đến: <?php echo $status_1;?>, 
		  			Hủy hẹn: <?php echo $status_2;?>,
		  			Không làm việc: <?php echo $status_3;?>,
		  			Lịch mới: <?php echo $status_4;?>,
		  			Đã đến: <?php echo $status_5;?>,
		  			Vào khám: <?php echo $status_6;?>,
		  			Hoàn tất: <?php echo $status_7;?>,
		  			Bỏ về:<?php echo $status_8;?>
		  			)</i> 
		  			</td>
		  			
		  		</tr>
				<?php endif ?>
	  		
	  	</tbody>
	  </table>
	</div>

	<!-- table excel-->
	 <div align="center" class="list_box" style="display:none;">     
      <table id="list_export" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>

          	<tr>
          		<th>Ngày </th>
	  			<th colspan="">Văn phòng</th>
	  			<th colspan="">Khách hàng</th>
	  			<th colspan="">Nhân viên</th>
	  			<th>Ngày tạo</th>
	  			<th>Bắt đầu</th>
	  			<th>Kết thúc</th>
	  			<th>Nội dung</th>
	  			<th>Người tạo</th>
	  			<th>Trạng thái</th>
	  			<th>Tổng tiền</th>
	  			<th colspan="">Hóa đơn</th>
	  		</tr>
          
        <?php foreach ($exportList as $key => $val): 
           
        ?>
          <tr>
           <td><?php echo date_format(date_create($val['create_date']),'d-m-Y'); ?></td>
						<td><?php if($val['id_branch']==1){echo "EDG-TQT";}else{echo "EDG-TX";}?></td>
						<td><?php echo $val['fullname'];?></td>
						<td><?php echo $val['name_dentist'];?></td>
						<td><?php echo date_format(date_create($val['create_date']),'d-m-Y'); ?></td>
						<td><?php echo $val['start_time']; ?></td>
						<td><?php echo $val['end_time']; ?></td>
						<td><?php echo $val['name_service'];?></td>
						<td><?php echo $val['author'];?></td>
						<td><?php if($val['status']==-1){echo "Hủy hẹn";}
								  elseif($val['status']==0){echo "Không làm việc";}
								  elseif($val['status']==1){echo "Lịch mới";}
								  elseif($val['status']==2){echo "Đã đến";}
								  elseif($val['status']==3){echo "Vào khám";}
								  elseif($val['status']==4){echo "Hoàn tất";}
								  elseif($val['status']==5){echo "Bỏ về";}
								  else{echo "Không đến";} ?></td>
						<?php $id_ex = $val['id_quotation'];
							  	if($id_ex ==''){ ?>
							   	<td>N/A</td>
							   	<?php }else{
							   		
							   		$quotation_ex = Quotation::model()->findByPk($id_ex); 
							   		?>
							   		<td class="autoNum"><?php  if($quotation_ex){ echo $quotation_ex->sum_amount;  }else{ echo  "N/A"; } ?></td>
							   		
							   	<?php }?>
						<td>N/A</td>
          </tr>
          <?php endforeach ?>
          
          
        </tbody>
      </table>
    </div>
	<div style="clear:both"></div>
	 <div id="" class="row fix_bottom">
	    <?php if($page_list) echo $page_list;?>
	</div> 
</div>

<script type="text/javascript">
$(function(){
    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    $('.autoNum').autoNumeric('init',numberOptions);
});

  
</script>