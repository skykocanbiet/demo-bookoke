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
	<p style="text-align: center;font-size: 20px;margin-top:50px;">TÓM LƯỢT GIAO DỊCH</p>
	<p style="text-align: right;">
	<?= $title_report;?>
	</p>
	<div style="margin-top: 20pt; width: 100%;" >
	 	<table class="ivDt">
		  	<thead >
		  		<tr>
		  			<th style="width: 10%">STT </th>
		  			<th style="width: 15%">Số hóa đơn</th>
		  			<th style="width: 15%">Loại hình</th>
		  			<th style="width: 15%">Số tiền</th>
		  			<th style="width: 15%">Ngày giao dịch</th>
		  			<th style="width: 15%">Người nhận</th>
		  			<th style="width: 15%">Khách hàng</th>
		  		</tr>
		  	</thead>
		  	<tbody> 

				<?php
					$i =0;
				 	foreach ($exportList as $key => $v): ?>
					<tr>
						<td><?php echo ++$i; ?></td>
			  			<td><?php echo $v['code'];?></td>
			  			<td><?php if($v['pay_type']==1){echo 'Tiền mặt';}
			  					  elseif($v['pay_type']==2){echo 'Thẻ tín dụng';}
			  					  elseif($v['pay_type']==3){echo 'Chuyển khoản';}
			  					  elseif($v['pay_type']==4){echo 'Bảo hiểm';} ?></td>
			  			<td><?php echo number_format(($v['pay_amount']),0,'','.');?></td>
			  			<td><?php echo date_format(date_create($v['pay_date']),'d-m-Y'); ?></td>
			  			<td>
			  				<?php $id_author = $v['id_author'];
							$author = GpUsers::model()->findByPk($id_author); 
							echo $author->name;
							?>
			  			</td>
			  			<td>
				  			<?php $id_customer = $v['id_customer'];
							$customer = Customer::model()->findByPk($id_customer); 
							echo $customer->fullname;
							?>
						</td>
					</tr>
				<?php endforeach ?>
		  	</tbody>
		</table>
	</div>

 </page>