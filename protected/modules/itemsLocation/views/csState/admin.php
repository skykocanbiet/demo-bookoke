<?php
$this->breadcrumbs=array(
	'Cs States'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List CsState','url'=>array('index')),
array('label'=>'Create CsState','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('cs-state-grid', {
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
'id'=>'cs-state-grid',
'type' => 'striped bordered condensed',
	'responsiveTable' => true,
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'id_country',
		'name_long',
		'name_short',
		'prefix_num',
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
