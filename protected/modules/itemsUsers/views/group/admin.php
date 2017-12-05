<?php
$this->breadcrumbs=array(
	'Manager Group '=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List GroupCcp','url'=>array('index')),
array('label'=>'Create GroupCcp','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('gp-group-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<div id="box_search_info" class="row clearfix search-form" >
	<?php $this->renderPartial('_search',array('model'=>$model,)); ?>
</div><!-- search-form -->

<?php 
$this->widget('booster.widgets.TbExtendedGridView',array(
        'id'=>'gp-group-grid',
        'type' => 'striped bordered condensed',
        'responsiveTable' => true,
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
        		'id',
        		'group_no',
        		'group_name',
        array(
            'class'=>'booster.widgets.TbButtonColumn',

            ),
        ),
)); 
?>
