<?php
$this->breadcrumbs=array(
	'Group'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List GroupCcp','url'=>array('index')),
array('label'=>'Create GroupCcp','url'=>array('create')),
array('label'=>'Update GroupCcp','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete GroupCcp','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage GroupCcp','url'=>array('admin')),
);
?>

<h1>View GroupCcp #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'group_no',
		'group_name',
),
)); ?>
