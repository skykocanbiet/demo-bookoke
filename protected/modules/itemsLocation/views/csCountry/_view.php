<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->code),array('view','id'=>$data->code)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code_long')); ?>:</b>
	<?php echo CHtml::encode($data->code_long); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country')); ?>:</b>
	<?php echo CHtml::encode($data->country); ?>
	<br />


</div>
