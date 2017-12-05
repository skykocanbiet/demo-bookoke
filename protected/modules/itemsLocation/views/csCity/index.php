<?php
$this->breadcrumbs=array(
	'Cs Cities',
);

$this->menu=array(
array('label'=>'Create CsCity','url'=>array('create')),
array('label'=>'Manage CsCity','url'=>array('admin')),
);
?>

<h1>Cs Cities</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
