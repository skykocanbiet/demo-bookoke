<?php
$this->breadcrumbs=array(
	'Product Images',
);

$this->menu=array(
array('label'=>'Create ProductImage','url'=>array('create')),
array('label'=>'Manage ProductImage','url'=>array('admin')),
);
?>

<h1>Product Images</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
