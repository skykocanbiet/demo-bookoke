<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Product','url'=>array('index')),
array('label'=>'Create Product','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('product-grid', {
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
'id'=>'product-grid',
'type' => 'striped bordered condensed',
'responsiveTable' => true,
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		array(
                 'value'=>function($data){
                    echo $data->rel_line->name;
                },
                'name' => 'id_product_line',
                'header' => Yii::t('app','Product Line'),
            ),
		'name',
		'description',
		'price',
		'stock',
		/*
		'discount',
		'unit',
		'createdate',
		'postdate',
		'status_product',
		'status_hiden',
		*/
		array(
                'class' => 'booster.widgets.TbToggleColumn',
               	'toggleAction' => 'Product/toggle',
                'name' => 'status_product',
                'header' => Yii::t('app','Status&nbsp;product'),
            ),
		array(
                'class' => 'booster.widgets.TbToggleColumn',
               	'toggleAction' => 'Product/toggle',
                'name' => 'status_hiden',
                'header' => Yii::t('app','Status&nbsp;hiden'),
            ),
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
