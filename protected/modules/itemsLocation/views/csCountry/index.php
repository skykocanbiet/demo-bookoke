<?php
$this->breadcrumbs=array(
	'Cs Countries',
);

$this->menu=array(
array('label'=>'Create CsCountry','url'=>array('create')),
array('label'=>'Manage CsCountry','url'=>array('admin')),
);
?>

<h1>Cs Countries</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
