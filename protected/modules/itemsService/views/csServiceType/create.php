<?php
$this->breadcrumbs=array(
	'Service Types'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List ServiceType','url'=>array('index')),
array('label'=>'Manage ServiceType','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>