<?php
$this->breadcrumbs=array(
	'Cs States'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List CsState','url'=>array('index')),
array('label'=>'Manage CsState','url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>