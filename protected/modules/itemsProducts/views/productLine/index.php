<?php
$this->breadcrumbs=array(
	'Product Lines',
);

$this->menu=array(
array('label'=>'Create ProductLine','url'=>array('create')),
array('label'=>'Manage ProductLine','url'=>array('admin')),
);
?>


<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
