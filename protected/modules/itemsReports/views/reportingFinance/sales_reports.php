<?php $baseUrl = Yii::app()->baseUrl;
$today = date('m/d/Y ');
  $month = strtotime(date("m/d/Y", strtotime($today)) . " +1 month");
  $month = strftime("%m/%d/%Y", $month);
?>

<style type="text/css">

</style>

<div class="col-md-12 margin-top-20" id="return_content">
	<p class="title-report tt" >Tình hình kinh doanh</p>
	<p class="time-report" ><?php echo date('m/d/Y ') .'đến '. $month; ?>, tất cả văn phòng, tất cả nhân viên</p>
	
	<div class="table table-responsive">
	  <table class="table table-bordered table-hover">
	  	<thead class="headertable">
	  		<tr>
	  			<th  rowspan="2" style="text-align: center; vertical-align: top; padding-top: 28px !important;">Nhân viên</th>
	  			<th colspan="6" style="text-align: center;">Tổng chi phí bán hàng</th>
	  			
	  		</tr>
	  		<tr class="sort-field">
	  			
	  			<th colspan="1">Giảm giá bán hàng</th>
	  			
	  			<th>Hoa hồng bán hàng</th>	 
				<th>Chi phí bán hàng</th> 
				<th>Chi phí Quảng cáo và Tiếp thị</th>	 
				<th>Thuế và phí</th>	 
				<th>Chi phí khác</th>	 
				
	  		</tr>
	  	</thead>
	  	<tbody>
	  	
	  	<?php
	  		$listdata     = array();
                
                $User         = GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3));
                foreach($User as $temp):
                    
	  	 ?>
	  		<tr class="sort-field">
	  			<td><?php echo $temp['name']; ?></td>
	  			<td colspan="1"></td>
	  			
	  			<td></td>	 
				<td></td> 
				<td></td>	 
				<td></td>	 
				<td></td>	 
				
	  		</tr> 
	  	<?php endforeach; ?>
	  		<tr>
	  			<td >Tổng :</td>
	  			<td></td>
	  			<td></td>
	  			<td></td>
	  			<td></td>
	  			<td></td>
	  			<td></td>
	  		</tr>
	  	</tbody>
	  </table>
	</div>
</div>