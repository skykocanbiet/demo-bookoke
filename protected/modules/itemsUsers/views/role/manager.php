<h3>Manager Role</h3>
<?php 
    $listarr  = GpGroup::model()->findAll();
    $list['']   = "- Choose Group -";
    foreach($listarr as $temp){
        if($temp['id'] > 0){
            $list[$temp['id']] =  $temp['group_name'];
        }
    }
	echo CHtml::dropDownList('group_id',"",$list,array('class'=>'form-control','onChange'=>'check_acton_controller();'));
?>
<div id="view_content_actions"></div>

<?php include('_js.php'); ?>
