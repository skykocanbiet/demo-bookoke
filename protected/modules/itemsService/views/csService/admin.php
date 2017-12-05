<?php
$this->breadcrumbs=array(
	'Services'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Service','url'=>array('index')),
array('label'=>'Create Service','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('service-grid', {
		data: $(this).serialize()
		});
		return false;
	});
	");
?>


<div id="box_search_info" class="row clearfix search-form" >
	<?php 
	$temp_id = '';
        if(isset($id)){
            $temp_id = $id;
        }
	$this->renderPartial('_search',array('model'=>$model)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'service-grid',
'type' => 'striped bordered condensed',
'responsiveTable' => true,
'dataProvider'=>$model->search(),

'filter'=>$model,
'pager' => array(
           'class' => 'booster.widgets.TbPager',
           'displayFirstAndLast' => true,
    ),
'columns'=>array(
		'code',
		
		array(
                'name'=>'id_service_type',
                'value'=>function($data){
                    echo $data->rel_service_type->name;
                },
				'header' => Yii::t('app','Service type'),
            ),
		'name',
		
		
	    
		array(
		'class'=>'booster.widgets.TbButtonColumn',
		'header'=>'Action',
		),
    ),
)); ?>
<div class="margin-top-20"></div>
