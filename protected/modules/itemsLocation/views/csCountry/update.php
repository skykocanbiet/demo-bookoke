<?php
$this->breadcrumbs=array(
	'Cs Countries'=>array('index'),
	$model->code=>array('view','id'=>$model->code),
	'Update',
);

	$this->menu=array(
	array('label'=>'List CsCountry','url'=>array('index')),
	array('label'=>'Create CsCountry','url'=>array('create')),
	array('label'=>'View CsCountry','url'=>array('view','id'=>$model->code)),
	array('label'=>'Manage CsCountry','url'=>array('admin')),
	);
	?>


<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>