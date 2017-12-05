<?php
$this->breadcrumbs=array(
	'Question Quicks'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List QuestionQuick','url'=>array('index')),
array('label'=>'Manage QuestionQuick','url'=>array('admin')),
);
?>

<h1>Create QuestionQuick</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>