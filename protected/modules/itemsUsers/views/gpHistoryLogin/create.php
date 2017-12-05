<?php
$this->breadcrumbs=array(
	'Gp History Logins'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List GpHistoryLogin','url'=>array('index')),
array('label'=>'Manage GpHistoryLogin','url'=>array('admin')),
);
?>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>