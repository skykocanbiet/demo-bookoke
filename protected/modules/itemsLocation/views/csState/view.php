<?php
$this->breadcrumbs=array(
	'Cs States'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List CsState','url'=>array('index')),
array('label'=>'Create CsState','url'=>array('create')),
array('label'=>'Update CsState','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete CsState','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage CsState','url'=>array('admin')),
);
?>

<h1>View CsState #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'id_country',
		'name_long',
		'name_short',
		'prefix_num',
),
)); ?>
