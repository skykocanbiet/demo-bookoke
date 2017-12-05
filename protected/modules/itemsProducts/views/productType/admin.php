<?php
$this->breadcrumbs=array(
	'Product Types'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List ProductType','url'=>array('index')),
array('label'=>'Create ProductType','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('product-type-grid', {
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
'id'=>'product-type-grid',
'type' => 'striped bordered condensed',
'responsiveTable' => true,
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'name',
		array(
		'name'=>'image',
		'type'=>'raw',
		'value'=>'(!empty($data->image))?CHtml::image(Yii::app()->baseUrl."/upload/product_type/".$data->image,"",array("width"=>"70px" ,"height"=>"70px")):CHtml::image(Yii::app()->baseUrl . "/upload/product_type/no_image.png","",array("width"=>"70px" ,"height"=>"70px"))',
            ),
		'description',
		array(
                'class' => 'booster.widgets.TbToggleColumn',
               	'toggleAction' => 'ProductType/toggle',
                'name' => 'status_protype',
                'header' => Yii::t('app','Status&nbsp;protype'),
            ),
		array(
                'class' => 'booster.widgets.TbToggleColumn',
               	'toggleAction' => 'ProductType/toggle',
                'name' => 'status_hiden',
                'header' => Yii::t('app','Status&nbsp;hiden'),
            ),
		array(
		'class'=>'booster.widgets.TbButtonColumn',
		'header'=>'Action',
		),
),
)); ?>
