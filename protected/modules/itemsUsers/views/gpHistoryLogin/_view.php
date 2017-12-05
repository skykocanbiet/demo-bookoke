<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip')); ?>:</b>
	<?php echo CHtml::encode($data->ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('login_time')); ?>:</b>
	<?php echo CHtml::encode($data->login_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('logout_time')); ?>:</b>
	<?php echo CHtml::encode($data->logout_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('error_code')); ?>:</b>
	<?php echo CHtml::encode($data->error_code); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('error_msg')); ?>:</b>
	<?php echo CHtml::encode($data->error_msg); ?>
	<br />

	*/ ?>

</div>
