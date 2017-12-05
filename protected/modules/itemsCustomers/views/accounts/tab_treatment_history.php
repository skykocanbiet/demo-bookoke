

<style>
.autoNum {text-align: right !important; padding-right: 10px !important;}
table.table-inv th, table.table-inv td{
	border: 1px solid white;
}
table.table-inv td{
	color: black;
}
h4.tt {color: #455862 !important;}
</style>
<!-- LỊCH SỬ GIAO DỊCH -->
<input type="hidden" name="" id="idCusRecipt" value="<?php echo $id_customer; ?>">

<?php 
	$ivL = $inv['data'];
	$payType = Receipt::model()->payType;
?>

<div class="statsTabContent tabContentHolder" id="invDetail">
	<?php if (!$ivL): ?>
	
		<div class="no-data col-md-12" style="display: table-cell; vertical-align: middle;text-align: center;">
			<div style="text-align: center;">
				<img src="<?php yii::app()->request->baseUrl; ?>/images/no-data.png" style="width:200px; height: auto;"><br>
				<p style="color: #464646; font-size: 15px;">Không có dữ liệu !</p>
			</div>
		</div>
	<?php else: ?>
		<?php foreach ($ivL as $key => $dt): 
			$idInv = $dt->id;
		?>
			<div class="col-md-12" style="background-color:#F6F6F5;margin:20px 0;border-radius: 7px;padding-bottom: 20px;">

				<div class="row" style="padding-left: 60px;padding-top: 10px;">   
					<h4 class="tt">Mã hóa đơn: <span><?php echo $dt->code; ?></span>
						<?php if ($dt->vat): ?>
							<span class="label" style="background: #f1b51b;">VAT</span>
						<?php endif ?>
					</h4>                        		
				</div>

				<div class="row">
					<div class="col-md-12" style="margin-bottom: 15px;">
						<div class="col-md-6">
							<div class="row">                		
								<div class="col-md-5 text-right"><b>Văn phòng:</b></div>
								<div class="col-md-7"><?php echo $dt->branch_name; ?></div>	
							</div>
							<div class="row">                		
								<div class="col-md-5 text-right"><b>Ngày tạo:</b></div>
								<div class="col-md-7"><?php echo $dt->create_date; ?></div>	
							</div>
							<div class="row">                		
								<div class="col-md-5 text-right"><b>Người tạo:</b></div>
								<div class="col-md-7"><?php echo $dt->author_name; ?></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">                		
								<div class="col-md-5 text-right"><b>Tổng tiền:</b></div>
								<div class="col-md-5 text-right"><span class="autoNum"><?php echo $dt->sum_amount; ?></span> VND</div>
							</div>
							<div class="row">                		
								<div class="col-md-5 text-right"><b>Còn nợ:</b></div>
								<div class="col-md-5 text-right"><span class="autoNum"><?php echo $dt->balance; ?></span> VND</div>
							</div>
						</div>
					</div>
				</div>

				<?php $rc = array_filter($rpt, function ($v) use($idInv) {
					return $v['id_invoice'] == $idInv;
				}) ?>

				<div class="col-md-12 table-responsive">
					<table class="table table-bordered table-inv">
				    	<thead style="background: #8ca7ae; color: white;">
							<tr style="">
							    <th>#</th>
						        <th>Ngày giao dịch</th>
						        <th>Hình thức</th>
						        <th>Bệnh nhân trả </th>
						        <th>Bảo hiểm trả (VNĐ)</th>
						        <th>Khuyến mãi phí (VNĐ)</th>
							</tr>
						</thead>
						<tbody style="background: #f1f5f6; color: black;">
							<?php if (!$rc): ?>
								<tr>
								    <td colspan="6" class="text-center">Không có dữ liệu!</td>
								</tr>

							<?php else: ?>
								<?php foreach ($rc as $k => $r): ?>
									<tr>
									    <td><?php echo $k + 1; ?></td>
								        <td><?php echo $r['pay_date']; ?></td>
								        <td><?php echo $payType[$r['pay_type']]; ?></td>
								        <td class="autoNum"><?php echo $r['pay_amount']; ?></td>
								        <td class="autoNum"><?php echo $r['pay_insurance']; ?></td>
								        <td class="autoNum"><?php echo $r['pay_promotion']; ?></td>
									</tr>
								<?php endforeach ?>
							<?php endif ?>
						</tbody>	
					</table>
			    </div>
			</div>
		<?php endforeach ?>
	<?php endif ?>
</div>

<div style="clear:both"></div>
<div id="" class="row fix_bottom">
    <?php if($page) echo $page;?> 
</div>
	
<!-- END LỊCH SỬ ĐIỀU TRỊ --> 
<script>
	var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
	$('.autoNum').autoNumeric('init',numberOptions);
	var h_ct  = $(".tab-content").height();

	$('#invDetail').css('height', h_ct-150);
</script>					

