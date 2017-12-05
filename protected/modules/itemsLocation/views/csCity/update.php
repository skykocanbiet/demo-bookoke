<?php
$this->breadcrumbs=array(
	'Cs Cities'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List CsCity','url'=>array('index')),
	array('label'=>'Create CsCity','url'=>array('create')),
	array('label'=>'View CsCity','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CsCity','url'=>array('admin')),
	);
	?>


<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>