<?php include 'style.php' ?>
<?php $baseUrl = Yii::app()->baseUrl;?>
<div class="col-md-12 margin-top-20" id="return_content">
	<p class="title-report tt">Lịch hẹn không đến</p>
	<p class="time-report">
		<?= $title_report;?>
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
		  			<th colspan="">Lý do</th>
		  		</tr>
		  	</thead>
		  	<tbody>
		  		<?php if ($appointmentList == -2): ?>
				    <tr><td colspan="12" rowspan="" headers="">Không có dữ liệu!</td></tr>
				<?php else: ?>
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
									  else{echo "Không đến";} ?></td>
									 
							<td>N/A</td>
							<td><?php echo $v['note'];?></td>
						</tr>
					<?php endforeach ?>
				<?php endif ?>
		  		<tr>
		  			<td colspan="12" style="text-align: left;"><b>Tổng lịch hẹn:</b> <?php echo $count?> <i>(0 dịch vụ)</i></td>
		  			
		  		</tr>
		  	</tbody>
	  </table>
	</div>
	<!-- excel-->
	<div align="center" class="list_box" style="display:none;">     
      	<table id="list_export" width="100%" border="0" cellspacing="0" cellpadding="0">
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
		  			<th colspan="">Lý do</th>
		  		</tr>
		  	</thead>
		  	<tbody>
		  		
					<?php foreach ($exportList as $key => $val): ?>
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
									  else{echo "Không đến";} ?></td>
									 
							<td>N/A</td>
							<td><?php echo $val['note'];?></td>
						</tr>
					<?php endforeach ?>
		  	</tbody>
      	</table>
    </div>
</div>