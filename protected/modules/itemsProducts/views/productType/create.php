<?php
$this->breadcrumbs=array(
	'Product Types'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List ProductType','url'=>array('index')),
array('label'=>'Manage ProductType','url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>