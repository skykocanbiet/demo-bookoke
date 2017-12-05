<?php
$this->breadcrumbs=array(
	'Branches'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Branch','url'=>array('index')),
	array('label'=>'Create Branch','url'=>array('create')),
	array('label'=>'View Branch','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Branch','url'=>array('admin')),
	);
	?>

	

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>