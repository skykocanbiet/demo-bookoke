<?php
$this->breadcrumbs=array(
	'Product Images'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List ProductImage','url'=>array('index')),
array('label'=>'Create ProductImage','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('product-image-grid', {
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
'id'=>'product-image-grid',
'type' => 'striped bordered condensed',
'responsiveTable' => true,
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		// 'id_product',
		array(
                 'value'=>function($data){
                    echo $data->rel_product->name;
                },
                'name' => 'id_product',
                'header' => Yii::t('app','Product'),
            ),
		'name',
		// 'url_action',
		array(
		'name'=>'name_upload',
		'type'=>'raw',
		'value'=>'(!empty($data->name_upload))?CHtml::image(Yii::app()->baseUrl."/upload/product_image/lg/".$data->name_upload,"",array("width"=>"70px" ,"height"=>"70px")):CHtml::image(Yii::app()->baseUrl . "/upload/product_image/no_image.png","",array("width"=>"70px" ,"height"=>"70px"))',
            ),
		'url_action',
		'update_time',
		/*
		'kind',
		'size',
		'status',
		*/
		array(
                'class' => 'booster.widgets.TbToggleColumn',
               	'toggleAction' => 'ProductImage/toggle',
                'name' => 'status',
                'header' => Yii::t('app','Status&nbsp;'),
            ),
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
