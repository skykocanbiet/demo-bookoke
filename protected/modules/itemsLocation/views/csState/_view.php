<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_country')); ?>:</b>
	<?php echo CHtml::encode($data->id_country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_long')); ?>:</b>
	<?php echo CHtml::encode($data->name_long); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_short')); ?>:</b>
	<?php echo CHtml::encode($data->name_short); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prefix_num')); ?>:</b>
	<?php echo CHtml::encode($data->prefix_num); ?>
	<br />


</div>
