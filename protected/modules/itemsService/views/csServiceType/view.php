<?php
$this->breadcrumbs=array(
	'Service Types'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List ServiceType','url'=>array('index')),
array('label'=>'Create ServiceType','url'=>array('create')),
array('label'=>'Update ServiceType','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete ServiceType','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage ServiceType','url'=>array('admin')),
);
?>

<h1>View ServiceType #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'description',
		'createdate',
		'status_hiden',
		'status',
),
)); ?>
