<?php
$this->breadcrumbs=array(
	'Group'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Group','url'=>array('index')),
array('label'=>'Manage Group','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>