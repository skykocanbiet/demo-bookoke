<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Product','url'=>array('index')),
array('label'=>'Create Product','url'=>array('create')),
array('label'=>'Update Product','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Product','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Product','url'=>array('admin')),
);
?>

<h1>View Product #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'id_product_line',
		'name',
		'description',
		'instruction',
		'price',
		'stock',
		'discount',
		'unit',
		'createdate',
		'postdate',
		'status_product',
		'status_hiden',
),
)); ?>
