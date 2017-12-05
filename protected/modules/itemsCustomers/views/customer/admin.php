<?php
$baseUrl = Yii::app()->baseUrl;
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Customer','url'=>array('index')),
array('label'=>'Create Customer','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('customer-grid', {
data: $(this).serialize()
});
return false;
});
");
?>
<input type="hidden" id="baseUrl" value="<?php echo Yii::app()->baseUrl?>"/>
<div id="box_search_info" class="row clearfix search-form" style="text-align:center" >
	<?php 
	$temp_id = '';
        if(isset($id)){
            $temp_id = $id;
        }
	$this->renderPartial('_search',array('model'=>$model,'id'=>$temp_id)); ?>
</div><!-- search-form -->



<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'customer-grid',
'type' => 'striped bordered condensed',
'responsiveTable' => true,
'dataProvider'=>$model->search(),
'filter'=>$model,
'selectableRows'=>1,
'selectionChanged'=>'function(id){

	id=$.fn.yiiGridView.getSelection(id);		
	$("html, body").animate({
        scrollTop: $("#tab").offset().top
    }, 1500);
    var baseUrl = $("#baseUrl").val();
    $.ajax({
        type:"POST",
        url: baseUrl+"/itemsCustomers/Customer/tab",          
        data:{"id": id },
        success:function(data){                
            $("#tab").html(data);                
        },
        error: function(data){
            console.log("error");
            console.log(data);
        }
    });

}',
'columns'=>array(	
		'id',
		array(
		'name'=>'image',
		'type'=>'raw',
		'value'=>'(!empty($data->image))?CHtml::image(Yii::app()->baseUrl."/upload/customer/".$data->image,"",array("width"=>"45px" ,"height"=>"45px")):CHtml::image(Yii::app()->baseUrl . "/upload/customer/no_image.png","",array("width"=>"45px" ,"height"=>"45px"))',
            ),	
		'code_number',
		'fullname',		
		'phone',		
		'createdate',		
array(
'class'=>'booster.widgets.TbButtonColumn',
'header'=>'Action',
),
),
)); ?>


<div><hr></div>
<div id="tab">
	<!-- content tab --> 
</div>	



<?php include('_style.php'); ?>
<?php include('_js.php'); ?>