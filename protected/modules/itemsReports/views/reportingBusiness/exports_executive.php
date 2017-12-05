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
	<p style="text-align: center;font-size: 20px;">TÓM TẮT HOẠT ĐỘNG KINH DOANH</p>
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
		  	<thead >
		  		<tr>
		  			<th style="width:10%">Nhân viên</th>
		  			<th colspan="2" style="width:10%">Khách hàng</th>
		  			<th colspan="4" style="width:20%">Lịch hẹn</th>
		  			<th colspan="4" style="width:60%">Bán hàng</th>
		  		</tr>
			</thead>
			<tbody>
				<tr>
		  			<td style="width:10%">Tên</td>
		  			<td style="width:5%">Tổng</td>
		  			<td style="width:5%">Mới</td>
		        	<td style="width:5%">Tổng</td>
		  			<td style="width:5%">Trực tuyến</td> 
		  			<td style="width:5%">Hoàn tất</td>	 
		  			<td style="width:5%">Bỏ hẹn</td>
		  			<td style="width:15%">Doanh số</td>	 
		  			<td style="width:10%">Khuyến mãi</td>	 
		  			<td style="width:15%">Hóa đơn</td>	 
		  			<td style="width:10%">Công nợ</td>
		    	</tr>
		    	<?php foreach ($listStaff as $value): ?>
		    		<tr>
			            <td style="width:10%"><?php echo $value['name']; ?></td>
			            <td style="width:5%"><?php echo $value['total']; ?></td>
			            <td style="width:5%"><?php echo $value['totalNew']; ?></td>
			            <td style="width:5%"><?php echo $value['total']; ?></td>
			            <td style="width:5%"><?php echo $value['online'];?></td>
			            <td style="width:5%"><?php echo $value['completed']; ?></td>
			            <td style="width:5%"><?php echo $value['leaving']; ?></td>
			            <td style="width:15%"><?php echo ($value['totalOrder'])?number_format($value['totalOrder'],0, ',', '.').' VND':'0 VND'; ?>/<?php echo ($value['totalOrderUSD'])?number_format($value['totalOrderUSD'],0, ',', '.').' USD':'0 USD'; ?></td>
			             <td style="width:10%"><?php echo ($value['totalDiscount'])?number_format($value['totalDiscount'],0, ',', '.').' VND':'0 VND'; ?>/<?php echo ($value['totalDiscountUSD'])?number_format($value['totalDiscountUSD'],0, ',', '.').' USD':'0 USD'; ?></td>
			            <td style="width:15%"><?php echo ($value['totalInvoice'])?number_format($value['totalInvoice'],0, ',', '.').' VND':'0 VND'; ?>/<?php echo ($value['totalInvoiceUSD'])?number_format($value['totalInvoiceUSD'],0, ',', '.').' USD':'0 USD'; ?></td>
			            <td style="width:10%"><?php echo ($value['totalBalance'])?number_format($value['totalBalance'],0, ',', '.').' VND':'0 VND'; ?>/<?php echo ($value['totalBalanceUSD'])?number_format($value['totalBalanceUSD'],0, ',', '.').' USD':'0 USD'; ?></td>
		            </tr>
		    	<?php endforeach ?>
			</tbody>
		</table>
	</div>
</page>