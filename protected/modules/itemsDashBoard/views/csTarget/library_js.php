<script>
function search_cus(cur_page)
{
    var user_id             = $("#frm_search_user_id").val();
    var month               = $("#frm_search_month").val();
    var year                = $("#frm_search_year").val();
    var revenue_target      = $("#frm_search_revenue_target").val();
    var new_account_target  = $("#frm_search_new_account_target").val();
    var call_target         = $("#frm_search_call_target").val();
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl(''.$subject_js.'/AjaxSearch')?>",
                    data:{
                        cur_page            :  cur_page,
                        user_id             :  user_id,
                        month               :  month,
                        year                :  year,
                        revenue_target      :  revenue_target,
                        new_account_target  :  new_account_target,
                        call_target         :  call_target,
                    },
                    beforeSend: function() {
                        $("#id_view_cusinfo").css({'display':'none'});
                        jQuery("#idwaiting_search").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/vtbusy.gif" alt="waiting....." />'); 
                    },
                    success:function(data){
                        if(data == '-1'){
                            alert('Data not found');
                        }else if(data != ''){
                            jQuery("#return_content").slideUp();
							jQuery("#return_content").html(data);
                            jQuery("#return_content").slideDown();
                        }else{
                            jAlert('Data not found','Notice');
                        }
                        jQuery("#idwaiting_search").html('');
                    }
    });                
}
function <?php echo $subject_js.'SearchDashboard';?>(){
    var from_day    =   $('#box_search_date_from').val();
    var to_day      =   $('#box_search_date_to').val();
    var id_user     =   $('#frm_search_user_id').val();
    var date_type   =   $('#box_search_date_type').val();
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl(''.$subject_js.'/SearchDashboard')?>",
                    data:{
                                id_user            :  id_user,
                                from_day           :  from_day,
                                to_day             :  to_day,
                                date_type          :  date_type,
                    },
                    beforeSend: function() {
                        $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                    },
                    success:function(data){
                        if(data!='-1'){
                        	jQuery("#idwaiting_main").html('');
                        	jQuery("#body_chart12").html(data);
                        }
                    },
                    error: function(data){ 
                        jQuery("#body_chart12").slideDown();
                        $('#idwaiting_main').html('');
                        alert("Error occured.Please try again!");
                    },
    
    });
    
}
function <?php echo $subject_js.'Delete';?>(id){ 
    if(!confirm('Are you sure?')) return false;
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl(''.$subject_js.'/delete')?>",
                    data:{
                            id      :  id,
                    },
                    beforeSend: function() {
                        jQuery("#main_content").slideUp();
                        $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                    },
                    success:function(data){
        				jQuery("#idwaiting_main").html('');
        				jQuery("#main_content").html(data);
                        jQuery("#main_content").slideDown();
                    },
                    error: function(data) { 
                        jQuery("#main_content").slideDown();
                        $('#idwaiting_main').html('');
                        alert("Error occured.Please try again!");
                    },
    });
}
function <?php echo $subject_js.'Create'; ?>(){ 
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl(''.$subject_js.'/Create')?>",
                    beforeSend: function() {
                        jQuery("#main_content").slideUp();
                        $("#id_view_cusinfo").css({'display':'none'});
                        $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                    },
                    success:function(data){
            			if(data!='-1'){
            				jQuery("#idwaiting_main").html('');
            				jQuery("#main_content").html(data);
                            jQuery("#main_content").slideDown();
            			}
                    },
                    error: function(data){ 
                        jQuery("#main_content").slideDown();
                        $('#idwaiting_main').html('');
                        alert("Error occured.Please try again!");
                    },
    });
}
function <?php echo $subject_js.'Update'; ?>(id){ 
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl(''.$subject_js.'/Update')?>",
                    data:{
                        id: id,  
                    },
                    beforeSend: function() {
                        jQuery("#main_content").slideUp();
                        $("#id_view_cusinfo").css({'display':'none'});
                        $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                    },
                    success:function(data){
                    	if(data!='-1'){
                    		jQuery("#idwaiting_main").html('');
                    		jQuery("#main_content").html(data);
                            jQuery("#main_content").slideDown();
                    	}
                    },
                    error: function(data){ 
                        jQuery("#main_content").slideDown();
                        $('#idwaiting_main').html('');
                        alert("Error occured.Please try again!");
                    },
    
    });
}
function <?php echo $subject_js.'Admin'; ?>(){ 
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl(''.$subject_js.'/Admin')?>",
                    beforeSend: function() {
                        jQuery("#main_content").slideUp();
                        $("#id_view_cusinfo").css({'display':'none'});
                        $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                    },
                    success:function(data){
                    	if(data!='-1'){
                    		jQuery("#idwaiting_main").html('');
                    		jQuery("#main_content").html(data);
                            jQuery("#main_content").slideDown();
                    	}
                    },
                    error: function(data){ 
                        jQuery("#main_content").slideDown();
                        $('#idwaiting_main').html('');
                        alert("Error occured.Please try again!");
                    },
    
    });
}
function <?php echo $subject_js.'Chart'; ?>(){ 
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl(''.$subject_js.'/Chart')?>",
                    beforeSend: function() {
                        $("#id_view_cusinfo").css({'display':'none'});
                        $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                    },
                    success:function(data){
                    	if(data!='-1'){
                    		jQuery("#idwaiting_main").html('');
                    		jQuery("#main_content").show().html(data);
                    	}
                    },
                    error: function(data){ 
                        $('#idwaiting_main').html('');
                        alert("Error occured.Please try again!");
                    },
    
    });
}
function runScript(e) {
    if (e.keyCode == 13) {
        var page_1=$('#id_text_page').val();
        if(page_1)
            search_cus(page_1);
        else
            search_cus('1');
    }
}

</script>