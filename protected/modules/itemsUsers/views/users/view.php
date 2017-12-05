<?php
$this->breadcrumbs=array(
	'Users Ccps'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List UsersCcp','url'=>array('index')),
array('label'=>'Create UsersCcp','url'=>array('create')),
array('label'=>'Update UsersCcp','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete UsersCcp','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage UsersCcp','url'=>array('admin')),
);
?>

<h1>View UsersCcp #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'username',
		'name',
		'email',
		'group_id',
		'createDate',
		'lastvisitDate',
		'block',
),
)); ?>
