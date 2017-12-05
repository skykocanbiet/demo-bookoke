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
<page backtop="5mm" backbottom="5mm" backleft="10mm" backright="10mm" format="Letter" backcolor="#fff" style="font: arial;font-family:freeserif ; margin-top:50px;">
	<p style="text-align: center;font-size: 20px;margin-top:50px;">HÓA ĐƠN CHI TIẾT</p>
	<p style="text-align: right;">
	<?= $title_report;?>
	</p>
	<div style="margin-top: 20pt; width: 100%;" >
	 	<table class="ivDt">
		  	<thead >
		  		<tr>
		  			<th style="width: 15%">Mã số </th>
		  			<th style="width: 20%">Ngày xuất</th>
		  			<th style="width: 20%" >Khách hàng</th>
		  			<th style="width: 15%" >Người xuất</th>
		  			<th style="width: 15%">Tổng tiền</th>
		  			<th style="width: 15%">Trạng thái</th>
		  		</tr>
		  	</thead>
		  	<tbody>

				<?php
				 	foreach ($exportList as $key => $v): ?>
					<tr>
						<td><?php echo  $v['code'];?></td>
						<td><?php echo date_format(date_create($v['create_date']),'d-m-Y'); ?></td>
						<td>
						<?php $id_customer = $v['id_customer'];
						$customer = Customer::model()->findByPk($id_customer); 
						echo $customer->fullname;
						?>
						</td>
						<td><?php echo $v['author_name'];?></td>
						<td><?php echo number_format(($v['sum_amount']),0,'','.');?></td>
						<td><?php if($v['balance']==0){echo 'Hoàn tất';}
								  else{ echo 'Chưa hoàn tất';} ?>
								  
						</td>
					</tr>
				<?php endforeach ?>
		  	</tbody>
		</table>
	</div>

 </page>