<?php
$this->breadcrumbs=array(
	'Medicine Alerts'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List MedicineAlert','url'=>array('index')),
array('label'=>'Create MedicineAlert','url'=>array('create')),
array('label'=>'Update MedicineAlert','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete MedicineAlert','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage MedicineAlert','url'=>array('admin')),
);
?>

<h1>View MedicineAlert #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'description',
		'status',
),
)); ?>
