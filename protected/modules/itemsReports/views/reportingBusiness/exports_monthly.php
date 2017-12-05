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
<?php $search_month = explode(',', $search_month);?>
<page backtop="15mm" backbottom="5mm" backleft="10mm" backright="10mm" format="Letter" backcolor="#fff" style="font: arial;font-family:freeserif ; margin-top:50px;">
	<p style="text-align: center;font-size: 20px;">TÓM TẮT HOẠT ĐỘNG TRONG THÁNG</p>
	<p style="text-align: right;">
	<?php  if($search_month){foreach ($search_month as $key => $val) { echo 'Tháng '.$val.'-'.$search_year.','; }} ?>
	<?php if($branch == ""){
		echo "Tất cả vị trí";
	} else{
		$branchList =  Branch::model()->findByPk($branch);
		echo 'Văn phòng:'.$branchList->name;
	}?>
	</p>
	<div style="margin-top: 20pt; width: 100%;" >
	 	<?php if($search_month){
	 		?>
	 	<table class="ivDt">
		  <thead class="headertable">
		  	<tr>
				<th></th>
				<?php foreach ($search_month as $key => $v) { ?>
				<th><?php echo 'Tháng '.$v.'-'.$search_year;?></th>	
				<?php } ?>
				<th>Tổng</th>
			</tr>
		   </thead>
		   <tbody>
		      <?php
		       $i = 0;
		       $title = array('Tổng số lịch hẹn','Tổng số khách hàng mới','Tổng số báo giá','Tổng giá trị báo giá','Tổng số điều trị','Tổng số điều trị hoàn tất','Tổng số giờ điều trị','Tổng giá trị điều trị','Tổng giá trị hóa đơn','Tổng giá trị thanh toán','Tổng giá trị công nợ'); 
		       foreach ($title as $value) {
		      ?>
		            <tr>
		              <td><?= $value;?></td>
		              <?php
		                $totalSchedule1 = 0;
		                foreach ($data_month as $v ){
		                  echo "<td>";
		                    if($i==0){echo $v['totalSchedule'];}
		                    else if($i==1){echo $v['NewCustomer'];}
		                    else if($i==2){echo $v['totalQuotation'];}
		                    else if($i==3){echo ($v['sumQuotationVND'])?number_format($v['sumQuotationVND'],0, ',', '.').' VND':'0 VND';?> /
		                    <?php echo ($v['sumQuotationUSD'])?number_format($v['sumQuotationUSD'],0, ',', '.').' USD':'0 USD'; } 
		                    else if($i==4){echo $v['totalTreatmen'];}
		                    else if($i==5){echo $v['totalTreatmentComplete'];}
		                    else if($i==6){echo $v['totalTime']." phút";}
		                    else if($i==7){echo ($v['sumOrderVND'])?number_format($v['sumOrderVND'],0, ',', '.').' VND':'0 VND';?> /
		                    <?php echo ($v['sumOrderUSD'])?number_format($v['sumOrderUSD'],0, ',', '.').' USD':'0 USD'; } 
		                    else if($i==8){echo ($v['sumInvoiceVND'])?number_format($v['sumInvoiceVND'],0, ',', '.').' VND':'0 VND';?> /
		                    <?php echo ($v['sumInvoiceUSD'])?number_format($v['sumInvoiceUSD'],0, ',', '.').' USD':'0 USD'; } 
		                    else if($i==9){echo ($v['sumReceiptVND'])?number_format($v['sumReceiptVND'],0, ',', '.').' VND':'0 VND';?> /
		                    <?php echo ($v['sumReceiptUSD'])?number_format($v['sumReceiptUSD'],0, ',', '.').' USD':'0 USD'; }
		                    else if($i==10){echo ($v['sumBalanceVND'])?number_format($v['sumBalanceVND'],0, ',', '.').' VND':'0 VND';?> /
		                    <?php echo ($v['sumBalanceUSD'])?number_format($v['sumBalanceUSD'],0, ',', '.').' USD':'0 USD'; }
		                  echo "</td>";
		                }?>
		               
		            </tr>
		           
		      <?php 
		       $i++;
		      }?>
		          <tr class="total">
		            <td>Tổng</td>
		            <?php 
		              foreach ($data_month as $key => $va) {
		            ?>
		            <td>N/A</td>  
		            <?php } ?>
		          </tr>
		    </tbody>
		</table>
	 <?php }?>
	</div>
	
</page>