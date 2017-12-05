<?php
$this->breadcrumbs=array(
	'Product Lines'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List ProductLine','url'=>array('index')),
array('label'=>'Create ProductLine','url'=>array('create')),
array('label'=>'Update ProductLine','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete ProductLine','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage ProductLine','url'=>array('admin')),
);
?>

<h1>View ProductLine #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'id_product_type',
		'name',
		'description',
		'status_proline',
		'status_hiden',
),
)); ?>
