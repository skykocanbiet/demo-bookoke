<?php
$this->breadcrumbs=array(
	'Cs Cities'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List CsCity','url'=>array('index')),
array('label'=>'Manage CsCity','url'=>array('admin')),
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>