<?php
$this->breadcrumbs=array(
	'Gp History Logins',
);

$this->menu=array(
array('label'=>'Create GpHistoryLogin','url'=>array('create')),
array('label'=>'Manage GpHistoryLogin','url'=>array('admin')),
);
?>

<h1>Gp History Logins</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
