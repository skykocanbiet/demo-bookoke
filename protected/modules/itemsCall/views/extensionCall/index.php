<?php
$this->breadcrumbs=array(
	'Cs Extension Calls',
);

$this->menu=array(
array('label'=>'Create CsExtensionCall','url'=>array('create')),
array('label'=>'Manage CsExtensionCall','url'=>array('admin')),
);
?>

<h1>Cs Extension Calls</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
