<?php
$this->breadcrumbs=array(
	'Users Ccps',
);

$this->menu=array(
array('label'=>'Create UsersCcp','url'=>array('create')),
array('label'=>'Manage UsersCcp','url'=>array('admin')),
);
?>

<h1>Users Ccps</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
