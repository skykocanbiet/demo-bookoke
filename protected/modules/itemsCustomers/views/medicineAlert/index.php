<?php
$this->breadcrumbs=array(
	'Medicine Alerts',
);

$this->menu=array(
array('label'=>'Create MedicineAlert','url'=>array('create')),
array('label'=>'Manage MedicineAlert','url'=>array('admin')),
);
?>

<h1>Medicine Alerts</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
