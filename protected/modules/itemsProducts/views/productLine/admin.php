<?php
$this->breadcrumbs=array(
	'Product Lines'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List ProductLine','url'=>array('index')),
array('label'=>'Create ProductLine','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('product-line-grid', {
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
'id'=>'product-line-grid',
'type' => 'striped bordered condensed',
'responsiveTable' => true,
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		array(
                 'value'=>function($data){
                    echo $data->rel_type->name;
                },
                'name' => 'id_product_type',
                'header' => Yii::t('app','Product Type'),
            ),
		'name',
		'description',
		array(
                'class' => 'booster.widgets.TbToggleColumn',
                'toggleAction' => 'ProductLine/toggle',
                'name' => 'status_proline',
                'header' => Yii::t('app','Status&nbsp;proline'),
            ),
		array(
                'class' => 'booster.widgets.TbToggleColumn',
                'toggleAction' => 'ProductLine/toggle',
                'name' => 'status_hiden',
                'header' => Yii::t('app','Status&nbsp;hiden'),
            ),
		array(
		'class'=>'booster.widgets.TbButtonColumn',
		),
),
)); ?>
