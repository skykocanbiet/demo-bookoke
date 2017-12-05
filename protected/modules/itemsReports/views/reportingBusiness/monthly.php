<style type="text/css">
	.monthly th{
	text-align: center;
}
#return_content .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
	border-top: none;
}
.title-monthly{
	font-weight: bold;
}
</style>
<?php $baseUrl = Yii::app()->baseUrl;?>
<p class="type-report">Tóm tắt hoạt động trong tháng</p>
<p class="time-report"><?php  if($search_month){foreach ($search_month as $key => $val) { echo 'Tháng '.$val.'-'.$search_year.','; }} ?><?php echo (isset($dataBrach) && $dataBrach)?"Văn phòng : ".$dataBrach:"tất cả vị trí"; ?>, <?php echo (isset($dataLstUser) && $dataLstUser)?"Bác sĩ : ".$dataLstUser:"tất cả nhân viên"; ?></p>
<div class="clearfix"></div>
<div class="table table-responsive">
<?php if($search_month){?>
 	<table class="table table-bordered table-hover monthly" cellspacing="0" cellpadding="0" cols="5" border="0" style="width: 100%" id="list_export">
	  <thead class="headertable">
	  	<tr>
			<td></td>
			<?php foreach ($search_month as $key => $v) { ?>
			<td><?php echo 'Tháng '.$v.'-'.$search_year;?></td>	
			<?php } ?>
			<td>Tổng</td>
		</tr>
	   </thead>
	   <tbody>
		<tr>
		
			<td>Tổng số lịch hẹn</td>
			<?php 
				$totalSchedule= 0;
				foreach ($search_month as $key => $v) {
				$totalSchedule_month = CsSchedule::model()->getTotalSchedule($id_branch,$v,$search_year);
				$totalSchedule += $totalSchedule_month;
			?>

			<td><?php echo $totalSchedule_month; ?></td>	
			<?php } ?>
			<td><?php echo $totalSchedule;?></td>
		</tr>
		<tr>
			<td>Tổng số khách hàng mới</td>
			<?php 
				$getNewCustomer= 0;
				foreach ($search_month as $key => $v) {
				$getNewCustomerByMonth =VSchedule::model()->getNewCustomerByMonth($id_branch,$v,$search_year);
				$getNewCustomer += $getNewCustomerByMonth;
			?>

			<td><?php echo $getNewCustomerByMonth; ?></td>	
			<?php } ?>
			<td><?php echo  $getNewCustomer; ?></td>
		</tr>

		<tr>
			<td>Tổng số báo giá</td>
			<?php 
				$totalQuotation= 0;
				foreach ($search_month as $key => $v) {
				$totalQuotationMonth =VQuotations::model()->totalQuotation('count',$id_branch,$v,$search_year,'');
				$totalQuotation += $totalQuotationMonth[0]['totalQuotation'];
			?>

			<td><?php echo $totalQuotationMonth[0]['totalQuotation']; ?></td>	
			<?php } ?>
			<td><?php echo  $totalQuotation; ?></td>
		</tr>
		<tr>
			<td>Tổng giá trị báo giá</td>
			<?php 
				$totalSumAmount_VND= 0;
				$totalSumAmount_USD= 0;
				foreach ($search_month as $key => $v) {
				$amount_VND =VQuotations::model()->totalQuotation('sum',$id_branch,$v,$search_year,'VND');
				$amount_USD =VQuotations::model()->totalQuotation('sum',$id_branch,$v,$search_year,'USD');

				$totalSumAmount_VND += $amount_VND[0]['totalSumAmount'];
				$totalSumAmount_USD += $amount_USD[0]['totalSumAmount'];
			?>
			<td>
				<?php echo ($amount_VND[0]['totalSumAmount'])?number_format($amount_VND[0]['totalSumAmount'],0, ',', '.').' VND':'0 VND';?> / 
			    <?php echo ($amount_USD[0]['totalSumAmount'])?number_format($amount_USD[0]['totalSumAmount'],0, ',', '.').' USD':'0 USD';?>
			    	
			</td>	
			<?php } ?>
			<td>
				<?php echo ($totalSumAmount_VND)?number_format($totalSumAmount_VND,0, ',', '.').' VND':'0 VND';?> /
				<?php echo ($totalSumAmount_USD)?number_format($totalSumAmount_USD,0, ',', '.').' USD':'0 USD';?>	
			</td>
		</tr>
		<tr>
			<td>Tổng số điều trị</td>
			<?php 
				$totalTreatment = 0;
				foreach ($search_month as $key => $v) {
				$totalTreatmentMonth= CsSchedule::model()->getTotalTimesCure($id_branch,"",$v,$search_year);
				$totalTreatment +=$totalTreatmentMonth;
			?>
			<td><?php echo $totalTreatmentMonth;?></td>	
			<?php } ?>
			<td><?php echo $totalTreatment;?></td>
		</tr>
		<tr>
			<td>Tổng số điều trị hoàn tất</td>
			<?php 
				$totalTreatmentComplete = 0;
				foreach ($search_month as $key => $v) {
				$totalTreatmentCompleteMonth= CsSchedule::model()->getTotalTimesCure($id_branch,4,$v,$search_year);
				$totalTreatmentComplete +=$totalTreatmentCompleteMonth;
			?>
			<td><?php echo $totalTreatmentCompleteMonth;?></td>	
			<?php } ?>
			<td><?php echo $totalTreatmentComplete;?></td>
		</tr>
		<tr>
			<td>Tổng số giờ điều trị</td>
			<?php 
				$totalTimeCure = 0;
				foreach ($search_month as $key => $v) {
				$totalTimeMonth = CsSchedule::model()->getTotalTimeCure($id_branch,$v,$search_year);
				$totalTimeCure += $totalTimeMonth;
			?>
			<td><?php echo $totalTimeMonth; ?> phút</td>	
			<?php } ?>
			<td><?php echo $totalTimeCure; ?> phút</td>
		</tr>

		<tr>
			<td>Tổng giá trị điều trị</td>
			<?php 
				$totalOrder_VND= 0;
				$totalOrder_USD= 0;
				foreach ($search_month as $key => $v) {
				$amount_VND =VQuotations::model()->totalOrder($id_branch,$v,$search_year,'VND');
				$amount_USD =VQuotations::model()->totalOrder($id_branch,$v,$search_year,'USD');

				$totalOrder_VND += $amount_VND[0]['total'];
				$totalOrder_USD += $amount_USD[0]['total'];
			?>
			<td>
				<?php echo ($amount_VND[0]['total'])?number_format($amount_VND[0]['total'],0, ',', '.').' VND':'0 VND';?> / 
			    <?php echo ($amount_USD[0]['total'])?number_format($amount_USD[0]['total'],0, ',', '.').' USD':'0 USD';?>
			    	
			</td>	
			<?php } ?>
			<td>
				<?php echo ($totalOrder_VND)?number_format($totalOrder_VND,0, ',', '.').' VND':'0 VND';?> /
				<?php echo ($totalOrder_USD)?number_format($totalOrder_USD,0, ',', '.').' USD':'0 USD';?>	
			</td>
		</tr>

		<tr>
			<td>Tổng giá trị hóa đơn</td>
			<?php 
				$totalInvoice_VND = 0;
				$totalInvoice_USD = 0;
				foreach ($search_month as $key => $v) {
				$totalInvoiceMonth_VND = VReceipt::model()->totalValueInvoice($id_branch,$v,$search_year,'VND');
				$totalInvoiceMonth_USD = VReceipt::model()->totalValueInvoice($id_branch,$v,$search_year,'USD');

				$totalInvoice_VND += $totalInvoiceMonth_VND;
				$totalInvoice_USD += $totalInvoiceMonth_USD;
			?>
			<td> 
				<?php echo ($totalInvoiceMonth_VND)?number_format($totalInvoiceMonth_VND,0, ',', '.').' VND':'0 VND';?>/
				<?php echo ($totalInvoiceMonth_USD)?number_format($totalInvoiceMonth_USD,0, ',', '.').' USD':'0 USD';?>	
			</td>	
			<?php } ?>
			<td>
				<?php echo ($totalInvoice_VND)?number_format($totalInvoice_VND,0, ',', '.').' VND':'0 VND';?>/
				<?php echo ($totalInvoice_USD)?number_format($totalInvoice_USD,0, ',', '.').' USD':'0 USD';?>	
				
			</td>
		</tr>
		<tr>
			<td>Tổng giá trị thanh toán</td>
			<?php 
				$totalReceipt_VND = 0;
				$totalReceipt_USD = 0;
				foreach ($search_month as $key => $v) {
				$totalReceiptMonth_VND = VReceipt::model()->totalValueReceipt($id_branch,$v,$search_year,'VND');
				$totalReceiptMonth_USD = VReceipt::model()->totalValueReceipt($id_branch,$v,$search_year,'USD');
				$totalReceipt_VND += $totalReceiptMonth_VND;
				$totalReceipt_USD += $totalReceiptMonth_USD;
			?>
			<td>
				<?php echo ($totalReceiptMonth_VND)?number_format($totalReceiptMonth_VND,0, ',', '.').' VND':'0 VND';?>/
				<?php echo ($totalReceiptMonth_USD)?number_format($totalReceiptMonth_USD,0, ',', '.').' USD':'0 USD';?>
			</td>	
			<?php } ?>
			<td>
				<?php echo ($totalReceipt_VND)?number_format($totalReceipt_VND,0, ',', '.').' VND':'0 VND';?>/
				<?php echo ($totalReceipt_USD)?number_format($totalReceipt_USD,0, ',', '.').' USD':'0 USD';?>
			</td>
		</tr>
		<tr>
			<td>Tổng giá trị công nợ</td>
			<?php 
				$totalBalance_VND = 0;
				$totalBalance_USD = 0;
				foreach ($search_month as $key => $v) {
				$totalBalanceMonth_VND = VReceipt::model()->totalValueBalance($id_branch,$v,$search_year,'VND');
				$totalBalanceMonth_USD = VReceipt::model()->totalValueBalance($id_branch,$v,$search_year,'USD');
				$totalBalance_VND += $totalBalanceMonth_VND;
				$totalBalance_USD += $totalBalanceMonth_USD;
			?>
			<td>
				<?php echo ($totalBalanceMonth_VND)?number_format($totalBalanceMonth_VND,0, ',', '.').' VND':'0 VND';?>/
				<?php echo ($totalBalanceMonth_USD)?number_format($totalBalanceMonth_USD,0, ',', '.').' USD':'0 USD';?>
			</td>	
			<?php } ?>
			<td>
				<?php echo ($totalBalance_VND)?number_format($totalBalance_VND,0, ',', '.').' VND':'0 VND';?>/
				<?php echo ($totalBalance_USD)?number_format($totalBalance_USD,0, ',', '.').' USD':'0 USD';?>
			</td>

		</tr>
		<!-- <tr>
			<td>Tổng giá trị bán hàng</td>
			
				foreach ($search_month as $key => $v) {
			?>
			<td>N/A</td>	
			 } ?>
			<td>N/A</td>
		</tr> -->
		<tr class="total">
			<td>Tổng</td>
			<?php 
				foreach ($search_month as $key => $v) {
			?>
			<td>N/A</td>	
			<?php } ?>
			<td>N/A</td>
		</tr>
	   </tbody>
	</table>
 <?php }?>
</div>