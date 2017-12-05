<?php $baseUrl = Yii::app()->baseUrl;?>
<p class="type-report">Doanh thu Dịch vụ</p>
<p class="time-report">
  <?= $title_report;?>
</p>
<div class="clearfix"></div>
<div class="table table-responsive">
  <table class="table table-bordered table-hover servicevenue" cellspacing="0" cellpadding="0" cols="5" border="0" id="list_export"> 
  <thead class="headertable">
    <tr>
      <td style="width: 25%">Dịch vụ</td>
      <td>Số lịch hẹn</td>
      <td>Trực tuyến</td>
      <td>Thời lượng</td>
      <td>Số khách hàng</td>
      <td>Doanh thu</td>
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
            <td><?php echo $value['name']; ?></td>
            <td><?php echo $value['totalSchedule']; ?></td>
            <td><?php echo $value['schedule_online'];?></td>
            <td><?php if($value['lenghtSchedule']){echo $value['lenghtSchedule'].' phút';}else { echo "0 phút";} ?></td>
            <td><?php if($value['totalCustomerService']){echo $value['totalCustomerService'];}else { echo "0 ";}  ?> </td>
            <td><?php echo ($value['totalInvoiceService'])?number_format($value['totalInvoiceService'],0, ',', '.').' VND':'0 VND'; ?>/<?php echo ($value['totalInvoiceService_USD'])?number_format($value['totalInvoiceService_USD'],0, ',', '.').' USD':'0 USD'; ?> </td>
          </tr>
       <?php  }
      } ?>

    </tbody>
  </table>
</div>