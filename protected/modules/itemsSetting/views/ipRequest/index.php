<?php
$this->breadcrumbs=array(
	'Ip Requests',
);

$this->menu=array(
array('label'=>'Create IpRequest','url'=>array('create')),
array('label'=>'Manage IpRequest','url'=>array('admin')),
);
?>

<h1>Ip Requests</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
