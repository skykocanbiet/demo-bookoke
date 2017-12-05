<?php
$this->breadcrumbs=array(
	'Cs Countries'=>array('index'),
	$model->code,
);

$this->menu=array(
array('label'=>'List CsCountry','url'=>array('index')),
array('label'=>'Create CsCountry','url'=>array('create')),
array('label'=>'Update CsCountry','url'=>array('update','id'=>$model->code)),
array('label'=>'Delete CsCountry','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->code),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage CsCountry','url'=>array('admin')),
);
?>

<h1>View CsCountry #<?php echo $model->code; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'code',
		'code_long',
		'country',
),
)); ?>
