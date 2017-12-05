<?php
$this->breadcrumbs=array(
	'Service Types',
);

$this->menu=array(
array('label'=>'Create ServiceType','url'=>array('create')),
array('label'=>'Manage ServiceType','url'=>array('admin')),
);
?>

<h1>Service Types</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
