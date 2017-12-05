<div id="book_choose_provider">
	<div class="alert">
		Choose Provider
	</div>
	<div class="book_choose_table">

		<table class="table">
		<?php foreach ($provider as $key => $value): 
			$color = ($key%2 == 0) ? 'col_grey' : '';
		?>
			<tr class="<?php echo $color; ?> choose_pr" data-pv='<?php echo $value['id']; ?>'>
				<td><?php echo $value['name']; ?></td>
			</tr>
		<?php endforeach ?>
		</table>
	</div>
</div>

<script>
$('.choose_pr').click(function (e) {
	e.preventDefault();
	runProcess('42%');

	provider_id 	= $(this).data('pv');
	provider_name	= $(this).find('td').text();

	$.ajax({
		url: "<?php echo CController::createUrl('book/book_date'); ?>",
		type: 'POST',
		data: {
			provider_id 	: 	provider_id,
			provider_name	: 	provider_name,
		},
		success: function (data) {
			$('#book_choose').empty();
			$('#book_choose').html(data);
		}, 
	})
});
</script>