<?php
$this->breadcrumbs=array(
	'Product Images'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List ProductImage','url'=>array('index')),
	array('label'=>'Create ProductImage','url'=>array('create')),
	array('label'=>'View ProductImage','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ProductImage','url'=>array('admin')),
	);
	?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>