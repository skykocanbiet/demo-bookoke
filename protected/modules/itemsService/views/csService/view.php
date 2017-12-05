<?php
$this->breadcrumbs=array(
	'Services'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Service','url'=>array('index')),
array('label'=>'Create Service','url'=>array('create')),
array('label'=>'Update Service','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Service','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Service','url'=>array('admin')),
);
?>

<h1>View Service #<?php echo $model->id; ?></h1>
<?php $ima=isset($model->image)!=""?$model->image:'no_image.png'; ?>
<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'id_service_type',
		'name',
		array(
		'name'=>'image',
		'type'=>'raw',
		'value'=>CHtml::image(Yii::app()->baseUrl . '/upload/service/'.$ima,"",array("width"=>"50px" ,"height"=>"50px")),
            ),
		'description',
		'content',
		'createdate',
		'status_hiden',
		'status',
),
)); ?>
