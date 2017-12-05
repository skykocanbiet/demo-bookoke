<!-- SHOW VIEW FORM INFO SEARCH -->

<div class="form-horizontal" style="margin:20px auto 25px; width:100%; position: relative;display:none;">   

    <div class="col-md-4">
        <!-- Users Manager -->
        <div class="new_account_row form-group">
            <span class="account_label col-md-5 control-label">Users Manager:</span>
            <div class="col-md-7">  
                <?php 
                    $model=new CsOpportunity;
                    $listdata     = array();
                    $listdata[''] = "ALL";
                    foreach($model->getListUsers() as $temp){
                        $listdata[$temp['id']] =  $temp['name'];
                    }
                    $group_no = Yii::app()->user->getState('group_no');
                    if(($group_no=='admin'||$group_no=='superadmin' || $group_no=='manager' || $group_no=='leader')){
                        echo CHtml::dropDownList('frm_search_id_user','',$listdata,array('class'=>'form-control','onChange'=>"AjaxSearchDealOpportunity(1);",'style'=>'width: 175px;')); 
                    }else{
                        echo CHtml::dropDownList('frm_search_id_user','',$listdata,array('class'=>'form-control','onChange'=>"AjaxSearchDealOpportunity(1);",'style'=>'width: 175px;',"disabled"=>"disabled",'options'=>array(Yii::app()->user->getState('id_user')=>array('selected'=>true)))); 
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <!-- Deal Phone -->
        <div class="new_account_row form-group">
            <span class="account_label col-md-5 control-label">Title:</span>
            <div class="col-md-7">
                <input  type="text" value="" id="frm_search_phone" class="form-control" name="frm_search_title" onkeypress="runScript(event);" style="width: 160px;"/>
            </div>
        </div>
    </div>

    <!-- VIEW BUTTON ACTION -->
    <div class="col-md-2 col-md-offset-2">
        <button class="button_izi btn btn-success btn-fw" onclick="AjaxSearchDealOpportunity('1')" >Search</button>
        <span id="idwaiting_search" style="position: absolute;right:80px; top: 3px;"></span>
    </div>
    <!-- END BUTTON ACTION -->

    <div style="clear: both;"></div>
</div>
<!-- END VIEW FORM INFO SEARCH -->

<div style="width: 100%;height: 35px;">
    <span class="pipelineSwitch">
    	<a id="deal_action_gourp_stage" class="active"><span class="icon_opption"><i class="fa fa-tasks active_icon_opption"></i></span></a>
    	<a id="deal_action_list_contact" style="color: #7cc9ac;"><span class="icon_opption"><i class="fa fa-list "></i></span></a>
    	<a id="deal_action_time_line" style="color: #7cc9ac;"><span class="icon_opption"><i class="fa fa-clock-o "></i></span></a>
    </span>   
</div>
<div class="clearfix"></div>

<script>
$(function(){
    $("#deal_action_gourp_stage").click(function(e){
        window.location.assign("<?php echo Yii::app()->baseUrl.'/itemsOpportunity/Opportunity/admin'; ?>"); 
        //console.log($(this).find('.active'));
        if($(this).find('.active')){
            return false;
        }
        $('.pipelineSwitch a').removeClass('active');
        $(this).addClass('active');
        AjaxSearchDealOpportunity(1,1);
    });
    $("#deal_action_list_contact").click(function(e){
        window.location.assign("<?php echo Yii::app()->baseUrl.'/itemsOpportunity/Opportunity/deals'; ?>");
        //console.log($(this).find('.active'));
        if($(this).find('.active')){
            return false;
        }
        $('.pipelineSwitch a').removeClass('active');
        $(this).addClass('active');
        AjaxSearchDealOpportunity(1,2);
    });
    $("#deal_action_time_line").click(function(e){
        //console.log($(this).find('.active'));
        if($(this).find('.active')){
            return false;
        }
        $('.pipelineSwitch a').removeClass('active');
        $(this).addClass('active');
        AjaxSearchDealOpportunity(1,3);
    });
});
function AjaxSearchDealOpportunity(cur_page)
{
    var title                  = $("#frm_search_title").val();
    var id_user                = $("#frm_search_id_user").val();

    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl('Opportunity/AjaxSearchDealOpportunity')?>",
                    data:{
                        cur_page                :  cur_page,
                        title                   :  title,
                        id_user                 :  id_user
                    },
                    beforeSend: function() {
                        jQuery("#idwaiting_search").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/vtbusy.gif" alt="waiting....." />'); 
                    },
                    success:function(data){
                        if(data == '-1'){
                            alert('Data not found');
                        }else if(data != ''){
                            jQuery("#return_content").fadeOut( 250 , function() {
                                jQuery(this).html( data);
                            }).fadeIn( 350 );
                        }else{
                            jAlert('Data not found','Notice');
                        }
                        jQuery("#idwaiting_search").html('');   
                        $('.cal-loading').fadeOut('slow');                   
                    }
    });                
}
AjaxSearchDealOpportunity('1');
</script>