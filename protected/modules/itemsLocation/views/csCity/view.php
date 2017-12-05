<?php
$this->breadcrumbs=array(
	'Cs Cities'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List CsCity','url'=>array('index')),
array('label'=>'Create CsCity','url'=>array('create')),
array('label'=>'Update CsCity','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete CsCity','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage CsCity','url'=>array('admin')),
);
?>

<h1>View CsCity #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'id_country',
		'name_short',
		'name_long',
),
)); ?>
