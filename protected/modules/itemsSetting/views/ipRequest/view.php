<?php
$this->breadcrumbs=array(
	'Ip Requests'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List IpRequest','url'=>array('index')),
array('label'=>'Create IpRequest','url'=>array('create')),
array('label'=>'Update IpRequest','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete IpRequest','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage IpRequest','url'=>array('admin')),
);
?>

<h1>View IpRequest #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'ip_address',
		'create_date',
		'status',
),
)); ?>
