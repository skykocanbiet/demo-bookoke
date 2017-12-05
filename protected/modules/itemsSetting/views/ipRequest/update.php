<?php
$this->breadcrumbs=array(
	'Ip Requests'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List IpRequest','url'=>array('index')),
	array('label'=>'Create IpRequest','url'=>array('create')),
	array('label'=>'View IpRequest','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage IpRequest','url'=>array('admin')),
	);
	?>

	

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>