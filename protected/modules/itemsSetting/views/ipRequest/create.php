<?php
$this->breadcrumbs=array(
	'Ip Requests'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List IpRequest','url'=>array('index')),
array('label'=>'Manage IpRequest','url'=>array('admin')),
);
?>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>