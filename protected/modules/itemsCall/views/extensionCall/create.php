<?php
$this->breadcrumbs=array(
	'Cs Extension Calls'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List CsExtensionCall','url'=>array('index')),
array('label'=>'Manage CsExtensionCall','url'=>array('admin')),
);
?>

<h1>Create CsExtensionCall</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>