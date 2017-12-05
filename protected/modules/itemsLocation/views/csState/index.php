<?php
$this->breadcrumbs=array(
	'Cs States',
);

$this->menu=array(
array('label'=>'Create CsState','url'=>array('create')),
array('label'=>'Manage CsState','url'=>array('admin')),
);
?>

<h1>Cs States</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
