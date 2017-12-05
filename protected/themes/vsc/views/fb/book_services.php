<style>
#book_choose td.t1 { width: 55%; }
#book_choose td.t2 { width: 15%;  text-align: right;}
#book_choose td.t4 { width: 30%; text-align: right;}
</style>

<div id="book_choose_services">
	<div class="alert">
		Chọn dịch vụ
	</div>

	<div class="book_choose_table">
		<?php if (!$services): ?>
			<div>
				Không có người thực hiện!
			</div>
		<?php else: ?>
			<table class="table services collapseTable">
				<?php foreach ($services as $key => $v): ?>			
					<tr class="choose_sv key<?php echo $key; ?>" data-sv="<?php echo $v['id']; ?>">
						<td>
							<table class="tableSub pvTable">
								<tr>
									<td class="t1"><?php echo $v['name']; ?></td>
									<td class="t2"><?php echo $v['length']; ?> phút</td>
									<td class="t3"><span class="autoNum svPrice"><?php echo $v['price']; ?></span> VND</td>
									<td class="t4 text-right showMore">
										<a href="#sv<?php echo $key; ?>" class="showMore" data-toggle="collapse"><img class="imgM showMore" src="<?php echo Yii::app()->getBaseUrl(). '/images/icon_fb/more.png'; ?>" alt=""></a>
									</td>
								</tr>

								<tr class="pvInfo key<?php echo $key; ?>">
									<td colspan="3" class="hiddenRow">
										<div id="sv<?php echo $key; ?>" class="collapse viewMore">
									    	<span>Mô tả: </span> <?php echo $v['description']; ?>
									  	</div>
									</td>
								</tr>	
							</table>
						</td>
					</tr>
				<?php endforeach ?>
			</table>
		<?php endif ?>
	</div>
</div>

<script>
$('.collapse').on('show.bs.collapse', function () {
    $('.collapse.in').collapse('hide');
});


	var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
	$('.autoNum').autoNumeric('init',numberOptions);

$('.services').on('click','.choose_sv',function (e) {
	e.preventDefault();
	clsN = e.target.className;
	if(clsN.indexOf('showMore') > 0)
		return;

	service_id 		= 	$(this).data('sv');
	service_name	=	$(this).find('.t1').text();
	service_len		=	$(this).find('.t2').text();
	len 			=	service_len.split(" ");
	service_price	=	$(this).find('.svPrice').text();

	price = service_price.replace(/\./g,'');

	calProvider(service_id, service_name, len[0], price);
});
</script>