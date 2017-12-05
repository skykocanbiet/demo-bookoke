<?php
$this->breadcrumbs=array(
	'Product Lines'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List ProductLine','url'=>array('index')),
	array('label'=>'Create ProductLine','url'=>array('create')),
	array('label'=>'View ProductLine','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ProductLine','url'=>array('admin')),
	);
	?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>