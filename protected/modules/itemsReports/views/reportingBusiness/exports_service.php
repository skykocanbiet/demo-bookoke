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
	<p style="text-align: center;font-size: 20px;">DOANH THU THEO DỊCH VỤ</p>
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
		      <th style="width: 25%">Dịch vụ</th>
		      <th style="width: 10%">Số lịch hẹn</th>
		      <th style="width: 10%">Trực tuyến</th>
		      <th style="width: 10%">Thời lượng</th>
		      <th style="width: 15%">Số khách hàng</th>
		      <th style="width: 30%">Doanh thu</th>
		    </tr>
		  </thead>

		    <tbody>
		    <?php if(!$listService){?>
		       <tr>
		        <td colspan="6">Chưa có dữ liệu</td>
		      </tr>
		    <?php
		        }else {
		        foreach ($listService as $value) { ?>
		          <tr>
		            <td style="width: 25%"><?php echo $value['name']; ?></td>
		            <td style="width: 10%"><?php echo $value['totalSchedule']; ?></td>
		            <td style="width: 10%"><?php echo $value['schedule_online'];?></td>
		            <td style="width: 10%"><?php if($value['lenghtSchedule']){echo $value['lenghtSchedule'].' phút';}else { echo "0 phút";} ?></td>
		            <td style="width: 15%"><?php if($value['totalCustomerService']){echo $value['totalCustomerService'];}else { echo "0 ";}  ?> </td>
		            <td style="width: 30%"><?php echo ($value['totalInvoiceService'])?number_format($value['totalInvoiceService'],0, ',', '.').' VND':'0 VND'; ?>/<?php echo ($value['totalInvoiceService_USD'])?number_format($value['totalInvoiceService_USD'],0, ',', '.').' USD':'0 USD'; ?> </td>
		          </tr>
		       <?php  }
		      } ?>

		    </tbody>
		</table>
	</div>
</page>