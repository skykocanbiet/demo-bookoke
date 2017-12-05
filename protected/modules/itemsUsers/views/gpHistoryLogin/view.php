<?php
$this->breadcrumbs=array(
	'Gp History Logins'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List GpHistoryLogin','url'=>array('index')),
array('label'=>'Create GpHistoryLogin','url'=>array('create')),
array('label'=>'Update GpHistoryLogin','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete GpHistoryLogin','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage GpHistoryLogin','url'=>array('admin')),
);
?>

<h1>View GpHistoryLogin #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'username',
		'password',
		'ip',
		'login_time',
		'logout_time',
		'error_code',
		'error_msg',
),
)); ?>
