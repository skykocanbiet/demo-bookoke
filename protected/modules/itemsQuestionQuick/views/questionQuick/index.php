<?php
$this->breadcrumbs=array(
	'Question Quicks',
);

$this->menu=array(
array('label'=>'Create QuestionQuick','url'=>array('create')),
array('label'=>'Manage QuestionQuick','url'=>array('admin')),
);
?>

<h1>Question Quicks</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
