
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
'id'=>'gp-role-form',
'enableAjaxValidation'=>true,
)); ?>
<div id="box_title_content" class="row clearfix" >
    <label class="col-xs-8 col-sm-9 col-md-9">
         
    </label>  
    <div class="col-xs-4 col-sm-3 col-md-3 form-actions text-right margin-top-10" style="margin-bottom: 20px;"> 
        <div style="position: absolute;top: -75px;right: 15px;">
       	<?php $this->widget('booster.widgets.TbButton', array(
    		'buttonType'=>'submit',
    		'context'=>'success',
    		'label'=>'Save',
    	)); ?>
        </div>
    </div>
</div>

<?php echo $form->errorSummary($model); ?>

<?php 
    $list_group = array();
    $list_data = GpGroup::model()->findAll();
    foreach($list_data as $temp){
    		$list_group[$temp['id']] = $temp['group_name'];
    }
    echo $form->dropDownList($model,'group_id',$list_group,array('class'=>'hidden','options'=>array(''=>array('selected'=>true))));
?>

<div id="view_content_actions" style="overflow: auto; height: 700px;padding-bottom: 65px;"> 
    <?php 
    foreach($list_controller as $key => $value){
        $ActionCcp = CHtml::listData(GpAction::model()->findAllByAttributes(array('controller_id'=>$value['id'])), 'id', 'name');
        
        $selected_type_list = CHtml::listData(GpAction::model()->findAll(),'id','type');

        $selected_actions = explode('-',$model->action_id);
        if($ActionCcp)
        {
        ?>   
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    
                    <?php echo $value['name']; ?>
                </h4>
            </div>
            <div class="panel-body">
                <?php echo CHtml::checkBoxList($value['id'],$selected_actions,$ActionCcp,array('checkAll' => 'Check all','template' => '<div class="col-lg-3">{input} {label}</div>','separator' => '',)); ?>
            </div>
        </div>

        <?php 
        } 
    }
?>
</div> 
<?php $this->endWidget(); ?>
<script>
$(document).ready(function(){
    
    $('#gp-role-form').submit(function(e) {
		//Prevent the default action, which in this case is the form submission.
		e.preventDefault();
		//Serialize the form data and store to a variable.
		var formData = new FormData($("#gp-role-form")[0]);
        $('#loading_content').css('display','inline-block');
        if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({ type:"POST",
                            url:"<?php echo CController::createUrl('Role/UpdateRole')?>",
                            data:formData,
                            datatype:'json',
                            beforeSend: function() {
                                $("#loading_content").show();
                            },
                            complete: function(){
                                        $("#loading_content").hide();
                            },
                            success:function(data){
        						if(data == '1'){
        							alert('Successfully!');
        						}else{
        						  alert('Error');
        						}
                            },
                            error: function(data) { 
                                jQuery("#id_viewcontent").slideDown();
                                $('#idwaiting_main').html('');
                                alert("Error occured.Please try again!");
                            },
                            cache: false,
                            contentType: false,
                            processData: false
              });
          }
          return false;

	});
});
</script>
