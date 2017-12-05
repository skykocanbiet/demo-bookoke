<?php
$this->breadcrumbs=array(
	'Gp History Logins'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List GpHistoryLogin','url'=>array('index')),
	array('label'=>'Create GpHistoryLogin','url'=>array('create')),
	array('label'=>'View GpHistoryLogin','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage GpHistoryLogin','url'=>array('admin')),
	);
	?>


<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>