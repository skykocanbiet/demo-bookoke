<?php 
    $dt =  date("d-m-Y");  
    $from = date("d-m-Y", strtotime('first day of this month'));
    $to= date("d-m-Y", strtotime('last day of this month'));
?>

<div class="col-md-12 margin-top-20" id="return_content">
<p class="title-report tt">Hóa Đơn chi tiết</p>
<p class="time-report">
<?= $title_report;?>	
</p>
	
	<div class="table table-responsive">
	  <table class="table table-bordered table-hover">
	  	<thead class="headertable">
	  		<tr>
	  			<th>Mã số </th>
	  			<th>Ngày xuất</th>
	  			<th>Khách hàng</th>
	  			<th>Người xuất</th>
	  			<th>Tổng tiền</th>
	  			<th>Trạng thái</th>
	  		</tr>
	  	</thead>
	  	<tbody>
	  		<?php if ($invoiceList == -2): ?>
			    <tr><td colspan="6" rowspan="" headers="">Không có dữ liệu!</td></tr>
			<?php else: ?>
				<?php foreach ($invoiceList as $key => $v): ?>
				<tr>
					<td><?php echo  $v['code'];?>
					<td><?php echo $v['create_date'];?></td>
					<td>
					<?php $id_customer = $v['id_customer'];
					$customer = Customer::model()->findByPk($id_customer); 
					echo $customer->fullname;
					?>
					</td>
					<td><?php echo $v['author_name'];?></td>
					<td> <span class="autoNum"><?php echo $v['sum_amount'];?></span> <span><?= $v['currency_use'];?></span></td>
					<td><?php if($v['balance']==0){echo 'Hoàn tất';}
							  else{ echo 'Chưa hoàn tất';} ?>
							  
					</td>
				</tr>
		  		
	  	<?php endforeach ?>
	  	<?php endif ?>
	  	<tr>
		  <td colspan="6">Tổng :<?php echo $count;?> (Hóa đơn)</td>		
		 </tr>
	  	</tbody>
	  </table>
	</div>

	<!-- excel-->
	<div class="table table-responsive" style="display: none;">
	  <table class="table table-bordered table-hover" id="list_export">
	  	<thead class="headertable">
	  		<tr>
	  			<th>Mã số </th>
	  			<th>Ngày xuất</th>
	  			<th>Khách hàng</th>
	  			<th>Người xuất</th>
	  			<th>Tổng tiền</th>
	  			<th >Trạng thái</th>
	  		</tr>
	  	</thead>
	  	<tbody>
	  		<?php if ($exportList == -2): ?>
			    <tr><td colspan="6" rowspan="" headers="">Không có dữ liệu!</td></tr>
			<?php else: ?>
				<?php foreach ($exportList as $key => $val): ?>
				<tr>
					<td><?php echo  $val['code'];?>
					<td><?php echo $val['create_date'];?></td>
					<td>
					<?php $id_cus = $val['id_customer'];
					$cus = Customer::model()->findByPk($id_cus); 
					echo $cus->fullname;
					?>
					</td>
					<td><?php echo $val['author_name'];?></td>
					<td class="autoNum"><?php echo $val['sum_amount'];?></td>
					<td><?php if($val['balance']==0){echo 'Hoàn tất';}
							  else{ echo 'Chưa hoàn tất';} ?>
							  
					</td>
				</tr>
	  	<?php endforeach ?>
	  	<?php endif ?>
	  	</tbody>
	  </table>
	</div>

</div>

<script type="text/javascript">
	$(function(){
    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    $('.autoNum').autoNumeric('init',numberOptions);
});

</script>