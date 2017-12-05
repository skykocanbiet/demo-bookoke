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
<?php 
    $dt =  date("d-m-Y");  
    $from = date("d-m-Y", strtotime('first day of this month'));
    $to= date("d-m-Y", strtotime('last day of this month'));
?>
<page backtop="15mm" backbottom="5mm" backleft="10mm" backright="10mm" format="Letter" backcolor="#fff" style="font: arial;font-family:freeserif ; margin-top:50px;">
	<p style="text-align: center;font-size: 20px;">LỊCH HẸN BỊ HỦY</p>
	<p style="text-align: right;">
	<?= $title_report;?>
	</p>
	<div style="margin-top: 20pt; width: 100%; padding-left: 10px;" >
	 	<table class="ivDt">
		  	<thead >
		  		<tr>
		  			<th style="width: 9%;"><strong>Ngày </strong></th>
		  			<th style="width: 8%;"><strong>Văn phòng</strong></th>
		  			<th style="width: 7%;"><strong>Khách hàng</strong></th>
		  			<th style="width: 7%;"><strong>Nhân viên</strong></th>
		  			<th style="width: 9%;"><strong>Bắt đầu</strong></th>
		  			<th style="width: 9%;"><strong>Kết thúc</strong></th>
		  			<th style="width: 15%;" ><strong>Nội dung</strong></th>
		  			<th style="width: 7%;"><strong>Người tạo</strong></th>
		  			<th style="width: 8%;"><strong>Trạng thái</strong></th>
		  			<th style="width: 7%;"><strong>Tổng tiền</strong></th>
		  			<th style="width: 7%;">Ngày hủy</th>
		  			<th style="width: 7%;">Lý do</th>
		  		</tr>
		  	</thead>
		  	<tbody>

				<?php foreach ($export_appointmentList as $key => $v): ?>
					<tr>
						<td style="width: 9%;"><?php echo date_format(date_create($v['create_date']),'d-m-Y'); ?></td>
						<td style="width: 8%;"><?php 
							$id_branch = $v['id_branch'];
							$branch =  Branch::model()->findByPk($id_branch);
							echo $branch->name;
							?>
						</td>
						<td style="width: 7%;"><?php echo $v['fullname'];?></td>
						<td style="width: 7%;"><?php echo $v['name_dentist'];?></td>
						<td style="width: 9%;"><?php echo date_format(date_create($v['start_time']),'d-m-Y'); ?></td>
						<td style="width: 9%;"><?php echo date_format(date_create($v['end_time']),'d-m-Y'); ?></td>
						<td style="width: 15%;"><?php echo $v['name_service'];?></td>
						<td style="width: 7%;"><?php echo $v['author'];?></td>
						<td style="width: 8%;"><?php if($v['status']==-1){echo "Hủy hẹn";}
								  elseif($v['status']==0){echo "Không làm việc";}
								  elseif($v['status']==1){echo "Lịch mới";}
								  elseif($v['status']==2){echo "Đã đến";}
								  elseif($v['status']==3){echo "Vào khám";}
								  elseif($v['status']==4){echo "Hoàn tất";}
								  elseif($v['status']==5){echo "Bỏ về";}
								  else{echo "Không đến";} ?></td>

					   	<td style="width: 7%;">N/A</td>
						<td style="width: 7%;">N/A</td>
						<td style="width: 7%;"><?php echo $v['note'];?></td>
					</tr>
				<?php endforeach ?>
		  	</tbody>
		</table>
	</div>

 </page>