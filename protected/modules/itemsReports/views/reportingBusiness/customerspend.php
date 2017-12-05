<?php $baseUrl = Yii::app()->baseUrl;?>
<p class="type-report">Chi tiêu của Khách hàng</p>
<p class="time-report">
  <?= $title_report;?>
</p>
<div class="clearfix"></div>
<div class="table table-responsive">
  <table class="table table-bordered table-hover customerspend" cellspacing="0" cellpadding="0" cols="5" border="0" id="list_export">
  <thead class="headertable">
    <tr>
      <td>Khách hàng</td>
      <td style="width: 8%">Số lịch hẹn</td>
      <td style="width: 8%">Số dịch vụ</td>
      <td>Báo giá</td>
      <td>Hóa đơn</td>
      <td>Khuyến mãi</td>
      <td>Thanh toán</td>
      <td>Công nợ</td>
    </tr>
  </thead>
  	<tbody>
   <?php 
      $totalQuotationVND = 0;
      $totalQuotationUSD = 0;
      $balanceVND        = 0;
      $balanceUSD        = 0;
      $totalInvoiceVND   = 0;
      $totalInvoiceUSD   = 0;
      $totalDiscountVND  = 0;
      $totalDiscountUSD  = 0;
      $paymentVND        = 0;
      $paymentUSD        = 0;

   ?>
    <?php if (isset($lstCustomer) && $lstCustomer) {
      foreach ($lstCustomer as $value) { 
        $discount = CsSchedule::model()->getCustomerDiscount($value['id']);
        $payment = $value['sumInvoice'] - $value['balanceInvoice']; 

        if($value['currency_use']=='VND'){
          $totalQuotationVND += $value['sum_amount'];
          $balanceVND        += $value['balanceInvoice'];
          $totalInvoiceVND   += $value['sumInvoice'];
          $paymentVND         = $totalInvoiceVND - $balanceVND;
          $totalDiscountVND  += $discount;
        }elseif ($value['currency_use']=='USD') {
          $totalQuotationUSD += $value['sum_amount'];
          $balanceUSD        += $value['balanceInvoice'];
          $totalInvoiceUSD   += $value['sumInvoice'];
          $paymentUSD         = $totalInvoiceUSD - $balanceUSD;
          $totalDiscountUSD  += $discount;
        }
      ?>
      <tr>
        <td><?php echo $value['fullname']; ?></td>
        <td><?php echo $value['totalSchedule']; ?></td>
        <td><?php echo $value['totalService']; ?></td>
        <td><?php echo ($value['sum_amount'])?number_format($value['sum_amount'],0, ',', '.'):'0'; ?> <?php echo $value['currency_use'];?></td>
        <td><?php echo ($value['sumInvoice'])?number_format($value['sumInvoice'],0, ',', '.'):'0'; ?> <?php echo $value['currency_use'];?></td>
        <td><?php echo ($discount)?number_format($discount,0, ',', '.'):'0'; ?> <?php echo $value['currency_use'];?></td>
        <td><?php echo ($payment)?number_format($payment,0, ',', '.'):'0'; ?> <?php echo $value['currency_use'];?></td>
        <td><?php echo ($value['balanceInvoice'])?number_format($value['balanceInvoice'],0, ',', '.'):'0'; ?> <?php echo $value['currency_use'];?></td>
      </tr>
    <?php  }
    } ?>
    <?php if (isset($totalCustomerSpend) && $totalCustomerSpend) { 
    ?>
  		<tr>
  			<td>Tổng</td>
  			<td><?php echo $totalCustomerSpend['total_Schedule']; ?></td>
  			<td><?php echo $totalCustomerSpend['total_Service']; ?></td>
  			<td><?php echo ($totalQuotationVND)?number_format($totalQuotationVND,0, ',', '.').' VND':'0 VND'; ?> / <?php echo ($totalQuotationUSD)?number_format($totalQuotationUSD,0, ',', '.').' USD':'0 USD'; ?> </td>
        <td><?php echo ($totalInvoiceVND)?number_format($totalInvoiceVND,0, ',', '.').' VND':'0 VND'; ?> / <?php echo ($totalInvoiceUSD)?number_format($totalInvoiceUSD,0, ',', '.').' USD':'0 USD'; ?></td>
        <td><?php echo ($totalDiscountVND)?number_format($totalDiscountVND,0, ',', '.').' VND':'0 VND'; ?> / <?php echo ($totalDiscountUSD)?number_format($totalDiscountUSD,0, ',', '.').' USD':'0 USD'; ?></td>


        <td><?php echo ($paymentVND)?number_format($paymentVND,0, ',', '.').' VND':'0 VND'; ?> / <?php echo ($paymentUSD)?number_format($paymentUSD,0, ',', '.').' USD':'0 USD'; ?></td>
        <td><?php echo ($balanceVND)?number_format($balanceVND,0, ',', '.').' VND':'0 VND'; ?> / <?php echo ($balanceUSD)?number_format($balanceUSD,0, ',', '.').' USD':'0 USD'; ?></td>
  		</tr>
      <?php } ?>
  	</tbody>
  </table>
</div>