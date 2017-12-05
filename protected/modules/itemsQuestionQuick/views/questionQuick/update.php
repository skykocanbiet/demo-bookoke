<?php
$this->breadcrumbs=array(
	'Question Quicks'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List QuestionQuick','url'=>array('index')),
	array('label'=>'Create QuestionQuick','url'=>array('create')),
	array('label'=>'View QuestionQuick','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage QuestionQuick','url'=>array('admin')),
	);
	?>

	<h1>Update QuestionQuick <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>