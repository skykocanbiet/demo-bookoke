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
<page backtop="15mm" backbottom="5mm" backleft="10mm" backright="10mm" format="Letter" backcolor="#fff" style="font: arial;font-family:freeserif ; margin-top:50px;">
	<p style="text-align: center;font-size: 20px;">CHI TIÊU CỦA KHÁCH HÀNG</p>
	<p style="text-align: right;">
		<?php if($search_time == "1"){
		$fromdate = date("d-m-Y");
		$todate= "";
		echo $fromdate;
	} elseif($search_time == "2"){
		$fromdate = date("d-m-Y",strtotime('monday this week'));
		$todate= date("d-m-Y",strtotime('sunday this week'));
		echo $fromdate .' đến '.$todate;
	}elseif($search_time == "3"){
		 $fromdate = date("01-m-Y", strtotime("first day of this month"));
		 $todate= date("t-m-Y", strtotime("last day of this month"));
		 echo $fromdate .' đến '.$todate;
	}elseif($search_time == "4"){
		$fromdate = date("d-m-Y", strtotime('first day of last month'));
    	$todate= date("d-m-Y", strtotime('last day of last month'));
		echo $fromdate .' đến '.$todate;
	}else{
		echo $fromtime .' đến '.$totime;
	}
	?>,
	<?php if($branch == ""){
		echo "Tất cả vị trí";
	} else{
		$branchList =  Branch::model()->findByPk($branch);
		echo 'Văn phòng:'.$branchList->name;
	}?>,
	<?php if($user == ""){
		echo "Tất cả nhân viên";
	} else{
		$userList =  GpUsers::model()->findByPk($user);
		echo 'Bác sĩ:'.$userList->name;
	}?>
	</p>
	<div style="margin-top: 20pt; width: 100%;" >
	 	<table class="ivDt">
		  	<thead>
		  		<tr>
		  			<th style="width:16%">Khách hàng</th>
		  			<th style="width:7%">Số lịch hẹn</th>
		  			<th style="width:7%">Số dịch vụ</th>
		  			<th style="width:14%">Báo giá</th>
		  			<th style="width:14%">Hóa đơn</th>
		  			<th style="width:14%">Khuyến mãi</th>
		  			<th style="width:14%">Thanh toán</th>
		  			<th style="width:14%">Công nợ</th>
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
</page>