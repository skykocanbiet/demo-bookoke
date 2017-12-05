<?php
$this->breadcrumbs=array(
	'Medicine Alerts'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List MedicineAlert','url'=>array('index')),
array('label'=>'Create MedicineAlert','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('medicine-alert-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<div id="box_search_info" class="row clearfix search-form" style="text-align:center" >
	<?php 
	$temp_id = '';
        if(isset($id)){
            $temp_id = $id;
        }
	$this->renderPartial('_search',array('model'=>$model,'id'=>$temp_id)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'medicine-alert-grid',
'type' => 'striped bordered condensed',
'responsiveTable' => true,
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(	
		'name',
		'description',
		array(
                'class' => 'booster.widgets.TbToggleColumn',
               
                'name' => 'status',
                'header' => Yii::t('app','Status'),
            ),
array(
'class'=>'booster.widgets.TbButtonColumn',
'header'=>'Action',
),
),
)); ?>
