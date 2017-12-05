<?php
$this->breadcrumbs=array(
	'Cs States'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List CsState','url'=>array('index')),
	array('label'=>'Create CsState','url'=>array('create')),
	array('label'=>'View CsState','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CsState','url'=>array('admin')),
	);
	?>


<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>