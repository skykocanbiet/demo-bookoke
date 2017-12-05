<?php
$this->breadcrumbs=array(
	'Product Lines'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List ProductLine','url'=>array('index')),
array('label'=>'Manage ProductLine','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>