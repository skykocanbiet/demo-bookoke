<?php if ($tm['numRow'] == 0): ?>
	<div class="no-data" style="display: table-cell; vertical-align: middle; text-align: center; width: 820px; height: 662px;">
		<div style="text-align: center;">
			<img src="/images/no-data.png" style="width:200px; height: auto;"><br>
			<p style="color: #464646; font-size: 15px;">Không có dữ liệu !</p>
		</div>
	</div>
<?php else: ?>
	<table id="tbl_deal" class="table table-striped deals_tbl tbl_tm">
		<thead class="tbhead">
			<th class="tmo2">Ngày điều trị</th>
			<th class="tmo3">Ngày hoàn thành</th>
			<th class="tmo4">Bác sỹ</th>
			<th class="tmo5">Dịch vụ điều trị</th>
			<th class="tmo6">Chi phí</th>
			<th class="tmo7">Đã thanh toán</th>
			<th class="tmo8">Còn lại</th>
		</thead>
		<tbody id="table_tm" class="tbody">
			<?php foreach ($tm['data'] as $key => $value): ?>
				<tr>
					<td class="tmo2"><?php echo date_format(date_create($value['create_date']),'d/m/Y'); ?></td>
					<td class="tmo3"><?php echo date_format(date_create($value['complete_date']),'d/m/Y'); ?></td>
					<td class="tmo4"><?php echo $value['name_dentist']; ?></td>
					<td class="tmo5"><?php echo $value['sevices']; ?></td>
					<td class="tmo6 autoNum"><?php echo $value['amount']; ?></td>
					<td class="tmo7 autoNum"><?php echo $value['pay']; ?></td>
					<td class="tmo8 autoNum"><?php echo $value['owe']; ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
<?php endif ?>

<div style="clear:both"></div>
<div id="" class="row fix_bottom">
    <?php if($page) echo $page;?> 
</div>