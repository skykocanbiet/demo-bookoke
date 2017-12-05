<?php $baseUrl = Yii::app()->baseUrl;?>
<?php 
    $dt =  date("d-m-Y");  
    $from = date("d-m-Y", strtotime('first day of this month'));
    $to= date("d-m-Y", strtotime('last day of this month'));
?>
<p class="type-report">Tóm tắt hoạt động kinh doanh</p>
<p class="time-report">
  <?= $title_report;?>
</p>
<div class="clearfix"></div>
<div class="table table-responsive executive">
  <table class="table table-bordered table-hover" id="list_export">
  	<thead class="headertable">
  		<tr>
  			<td>Nhân viên</td>
  			<td colspan="2">Khách hàng</td>
  			<td colspan="4">Lịch hẹn</td>
  			<td colspan="4">Bán hàng</td>
  		</tr>
  	</thead>
  	<tbody>
  		<tr class="sort-field">
  			<td style="width: 25%;">Tên</td>
  			<td>Tổng</td>
        <td>Mới</td>
  			<td>Tổng</td>
  			<td>Trực tuyến</td> 
  			<td>Hoàn tất</td>	 
  			<td>Bỏ hẹn</td>
  			<td>Doanh số</td>	 
  			<td>Khuyến mãi</td>	 
  			<td>Hóa đơn</td>	 
  			<td>Công nợ</td>
    	</tr>
        <?php
        if (isset($listStaff) && $listStaff) 
        {
          foreach ($listStaff as $value) 
          {
        ?>
            <tr>
              <td><?php echo $value['name']; ?></td>
              <td><?php echo $value['total']; ?></td>
              <td><?php echo $value['totalNew']; ?></td>
              <td><?php echo $value['total']; ?></td>
              <td><?php echo $value['online'];?></td>
              <td><?php echo $value['completed']; ?></td>
              <td><?php echo $value['leaving']; ?></td>
              <td><?php echo ($value['totalOrder'])?number_format($value['totalOrder'],0, ',', '.').' VND':'0 VND'; ?>/<?php echo ($value['totalOrderUSD'])?number_format($value['totalOrderUSD'],0, ',', '.').' USD':'0 USD'; ?></td>

              <td><?php echo ($value['totalDiscount'])?number_format($value['totalDiscount'],0, ',', '.').' VND':'0 VND'; ?>/<?php echo ($value['totalDiscountUSD'])?number_format($value['totalDiscountUSD'],0, ',', '.').' USD':'0 USD'; ?></td>

              <td><?php echo ($value['totalInvoice'])?number_format($value['totalInvoice'],0, ',', '.').' VND':'0 VND'; ?>/<?php echo ($value['totalInvoiceUSD'])?number_format($value['totalInvoiceUSD'],0, ',', '.').' USD':'0 USD'; ?></td>
              
              <td><?php echo ($value['totalBalance'])?number_format($value['totalBalance'],0, ',', '.').' VND':'0 VND'; ?>/<?php echo ($value['totalBalanceUSD'])?number_format($value['totalBalanceUSD'],0, ',', '.').' USD':'0 USD'; ?></td>
            </tr>
        <?php  
          } 
        }
        ?>
  	</tbody>
  </table>
</div>