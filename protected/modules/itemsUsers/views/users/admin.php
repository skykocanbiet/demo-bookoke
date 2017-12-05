<?php

$baseUrl = Yii::app()->baseUrl;

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Users','url'=>array('index')),
array('label'=>'Create Users','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update('gb-users-grid', {
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
        $this->renderPartial('_search',array('model'=>$model,'id'=>$temp_id)); 
    ?>
</div><!-- search-form -->
<style>
#gp-users-grid td{
    text-align: center;
}
#gp-users-grid td img{
    width: 45px;
    height: 45px;
    margin: 0px auto;
    border-radius: 50%;
}

</style>
<?php
    $this->widget('booster.widgets.TbExtendedGridView',array(
    'id'=>'gp-users-grid',
    'type' => 'striped bordered condensed',
    'responsiveTable' => true,
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'pager' => array(
           'class' => 'booster.widgets.TbPager',
           'displayFirstAndLast' => true,
    ),
    'columns'=>array(
            array(
                'name'=>'image',
                'type'=>'raw',
                //'value'=>$model->imageLinkUser(),
                'value'=>'(!empty($data->image))?CHtml::image(Yii::app()->baseUrl . "/upload/users/sm/" . $data->image,"",array("width"=>"50px" ,"height"=>"50px")):CHtml::image(Yii::app()->baseUrl . "/upload/users/user-default.png","",array("width"=>"50px" ,"height"=>"50px"))',

            ),
    		'username',
    		'name',
    		//'password',
            array(
    			'name' => 'email',
    			'type' => 'raw',
    			'value' => 'CHtml::link(CHtml::encode($data->email), "mailto:".CHtml::encode($data->email))',
    		),
            array(
                'name'=>'rel_group',
                'value'=>function($data){
                    echo $data->rel_group->group_name;
                },
            ),

            array(
                'name' => 'createDate',
                'type' => 'datetime'
            ),
            array(
                'name' => 'lastvisitDate',
                'type' => 'date'
            ),
            array(
                'class' => 'booster.widgets.TbToggleColumn',
                'toggleAction' => 'Users/toggle',
                'name' => 'block',
                'header' => Yii::t('app','Block?'),

            ),
            array(
                'class' => 'booster.widgets.TbToggleColumn',
                'toggleAction' => 'Users/toggle',
                'name' => 'status_hidden',
                'header' => Yii::t('app','Status&nbsp;hiden'),
            ),
            array(
            'class'=>'booster.widgets.TbButtonColumn',
            'header'=>'Action',
            ),
    ),
)); ?>
<div class="margin-top-20"></div>
