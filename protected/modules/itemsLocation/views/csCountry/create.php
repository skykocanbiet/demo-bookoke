<?php
$this->breadcrumbs=array(
	'Cs Countries'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List CsCountry','url'=>array('index')),
array('label'=>'Manage CsCountry','url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>