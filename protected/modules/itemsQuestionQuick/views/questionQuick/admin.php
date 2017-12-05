<?php
$this->breadcrumbs=array(
	'Question Quicks'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List QuestionQuick','url'=>array('index')),
array('label'=>'Create QuestionQuick','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('question-quick-grid', {
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
'id'=>'question-quick-grid',
'type' => 'striped bordered condensed',
'responsiveTable' => true,
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
	
		'title',
		
		array(
                'class' => 'booster.widgets.TbToggleColumn',
               
                'name' => 'status',
                'header' => Yii::t('app','Status&nbsp;hiden'),
            ),
array(
'class'=>'booster.widgets.TbButtonColumn',
'header'=>'Action',
),
),
)); ?>
