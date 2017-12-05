<style>
.b1 {width: 20%;}
.b3 {width: 20%;}
</style>

<div id="book_choose_branch">
	<div class="alert">
		Chọn văn phòng
	</div>
	<div class="book_choose_table">
		<table class="table services">
		<?php if ($br): ?>
			<?php foreach ($br as $key => $v): ?>
				<tr class="choose_br" data-br="<?php echo $v['id']; ?>">
					<td class="b1 brName"><?php echo $v['name']; ?></td>
					<td class="b2 brAdrss"><?php echo $v['address']; ?></td>
					<td class="b3"><?php echo $v['hotline1']; ?></td>
				</tr>
			<?php endforeach ?>
		<?php else: ?>
			<tr><td>
				Không có dữ liệu!
			</td></tr>
		<?php endif ?>
		</table>
	</div>
</div>

<script>
$('.choose_br').click(function (e) {
	e.preventDefault();
	clsN = e.target.className;

	if(clsN.indexOf('showMore') > 0)
		return;

	branch_id = $(this).data('br');
	address   = $(this).find('.brAdrss').text();
	name      = $(this).find('.brName').text();

	calService(branch_id, address, name);
});
</script>