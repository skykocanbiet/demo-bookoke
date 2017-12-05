<?php
$this->breadcrumbs=array(
	'Cs Extension Calls'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List CsExtensionCall','url'=>array('index')),
	array('label'=>'Create CsExtensionCall','url'=>array('create')),
	array('label'=>'View CsExtensionCall','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CsExtensionCall','url'=>array('admin')),
	);
	?>

	<h1>Update CsExtensionCall <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>