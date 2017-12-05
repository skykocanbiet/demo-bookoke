<?php
$this->breadcrumbs=array(
	'Question Quicks'=>array('index'),
	$model->title,
);

$this->menu=array(
array('label'=>'List QuestionQuick','url'=>array('index')),
array('label'=>'Create QuestionQuick','url'=>array('create')),
array('label'=>'Update QuestionQuick','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete QuestionQuick','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage QuestionQuick','url'=>array('admin')),
);
?>

<h1>View QuestionQuick #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'title',
		'status',
),
)); ?>
