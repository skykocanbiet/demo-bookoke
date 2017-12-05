<?php $baseUrl = Yii::app()->baseUrl;?>

<?php 
    $dt =  date("d-m-Y");  
    $from = date("d-m-Y", strtotime('first day of this month'));
    $to= date("d-m-Y", strtotime('last day of this month'));
?>
<p class="type-report">Tóm tắt hoạt động trong tháng</p>
<p class="time-report"><?php  if($search_month){foreach ($search_month as $key => $val) { echo 'Tháng '.$val.'-'.$search_year.','; }} ?><?php echo (isset($dataBrach) && $dataBrach)?"Văn phòng : ".$dataBrach:"tất cả vị trí"; ?></p>

<div class="clearfix"></div>
<div class="table table-responsive executive">
  <table class="table table-bordered table-hover" id="list_export">
    <thead class="headertable">
      <tr>
      <td></td>
      <?php foreach ($search_month as $key => $month) { ?>
      <td><?php echo 'Tháng '.$month.'-'.$search_year;?></td> 
      <?php } ?>
      <td>Tổng</td>
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
</div>