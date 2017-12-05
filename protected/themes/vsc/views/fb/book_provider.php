<div id="book_choose_provider">
	<div class="alert">
		Chọn người thực hiện
	</div>

	<div class="book_choose_table">
		<?php if (!$provider): ?>
			<div>
				Không có người thực hiện!
			</div>
		<?php else: ?>
			<table class="table collapseTable">
				<?php foreach ($provider as $key => $value): ?>
					<?php 	if ($value['image'])
								$img = 'sm/'.$value['image'];
							else
								$img = 'no_avatar.png';
					?>
					
					<tr class="choose_pr key<?php echo $key; ?>" data-pv='<?php echo $value['id']; ?>'>
						<td>
							<table class="tableSub pvTable">
								<tr>
									<td class="p1"><img class="imgP" src="<?php echo Yii::app()->getBaseUrl(). '/upload/users/'.$img; ?>"></td>
									<td class="p2"><span class="pvName"><?php echo $value['name']; ?></span></td>
									<td class="p3 text-right">
										<?php for($i = 1; $i <= 4; $i++){
											echo "<img class='imgS' src='".Yii::app()->getBaseUrl()."/images/icon_fb/1-star.png' >";
										} ?>
										<img class='imgS' src="<?php echo Yii::app()->getBaseUrl(). '/images/icon_fb/half-star.png'; ?>">
										  <span class="numRate">(123)</span>
									</td>
									<td class="p4 text-right showMore">
										<a href="#pv<?php echo $key; ?>" class="showMore" data-toggle="collapse"><img class="imgM showMore" src="<?php echo Yii::app()->getBaseUrl(). '/images/icon_fb/more.png'; ?>" alt=""></a>
									</td>
								</tr>

								<tr class="pvInfo key<?php echo $key; ?>">
									<td colspan="4" class="hiddenRow">
										<div id="pv<?php echo $key; ?>" class="collapse viewMore">
									    	<p>Kinh nghiệm: <?php echo $value['exp']; ?></p>
									    	<p>Bằng cấp: <?php echo $value['diploma']; ?></p>
									    	<p>Chứng chỉ: <?php echo $value['cer']; ?></p>
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


$('.choose_pr').click(function (e) {
	e.preventDefault();
	clsN = e.target.className;

	if(clsN.indexOf('showMore') > 0)
		return;

	provider_id 	= $(this).data('pv');
	provider_name	= $(this).find('.pvName').text();

	calDate(provider_id, provider_name);
});
</script>