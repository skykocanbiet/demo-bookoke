<?php
$this->breadcrumbs=array(
	'Medicine Alerts'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List MedicineAlert','url'=>array('index')),
	array('label'=>'Create MedicineAlert','url'=>array('create')),
	array('label'=>'View MedicineAlert','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage MedicineAlert','url'=>array('admin')),
	);
	?>

	

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>