<?php
$this->breadcrumbs=array(
	'Group Ccps',
);

$this->menu=array(
array('label'=>'Create GroupCcp','url'=>array('create')),
array('label'=>'Manage GroupCcp','url'=>array('admin')),
);
?>

<h1>Group Ccps</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
