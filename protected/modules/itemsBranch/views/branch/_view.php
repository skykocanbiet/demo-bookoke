<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_country')); ?>:</b>
	<?php echo CHtml::encode($data->id_country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_city')); ?>:</b>
	<?php echo CHtml::encode($data->id_city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hotline1')); ?>:</b>
	<?php echo CHtml::encode($data->hotline1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hotline2')); ?>:</b>
	<?php echo CHtml::encode($data->hotline2); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>
