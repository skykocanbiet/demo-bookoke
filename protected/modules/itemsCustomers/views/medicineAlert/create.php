<?php
$this->breadcrumbs=array(
	'Medicine Alerts'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List MedicineAlert','url'=>array('index')),
array('label'=>'Manage MedicineAlert','url'=>array('admin')),
);
?>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>