<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_product_type')); ?>:</b>
	<?php echo CHtml::encode($data->id_product_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_proline')); ?>:</b>
	<?php echo CHtml::encode($data->status_proline); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_hiden')); ?>:</b>
	<?php echo CHtml::encode($data->status_hiden); ?>
	<br />


</div>
