<?php
$this->breadcrumbs=array(
	'Users Ccps'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List UsersCcp','url'=>array('index')),
	array('label'=>'Create UsersCcp','url'=>array('create')),
	array('label'=>'View UsersCcp','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage UsersCcp','url'=>array('admin')),
	);
	?>

	

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>