<?php
$this->breadcrumbs=array(
	'Branches'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Branch','url'=>array('index')),
array('label'=>'Create Branch','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('branch-grid', {
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
'id'=>'branch-grid',
'type' => 'striped bordered condensed',
'responsiveTable' => true,
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		
		'name',
		'address',
        'email',
		array(
                 'value'=>function($data){
                    echo $data->rel_country->country;
                },
                'name' => 'id_country',
                'header' => Yii::t('app','Country'),
            ),
		array(
                 'value'=>function($data){
                    echo $data->rel_city->name_long;
                },
                'name' => 'id_city',
                'header' => Yii::t('app','City'),
            ),
		'hotline1',
		'hotline2',

		array(
                'class' => 'booster.widgets.TbToggleColumn',
                'toggleAction' => 'Branch/toggle',
                'name' => 'status',
                'header' => Yii::t('app','Status'),
            ),
		/*
		'hotline2',
		'status',
		*/
array(
'class'=>'booster.widgets.TbButtonColumn',
'header'=>'Action',
),
),
)); ?>
