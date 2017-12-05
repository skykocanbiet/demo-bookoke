<script>
function search_cus(cur_page)
{
    var month       = $("#frm_search_month").val();
    var year        = $("#frm_search_year").val();
    var user_id     = $("#frm_search_user_id").val();
    var from_day    = $('#box_search_date_from').val();
    var to_day      = $('#box_search_date_to').val();
    var date_type   = $('#box_search_date_type').val();
    
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl(''.$subject_js.'/AjaxSearchKpi')?>",
                    data:{
                        cur_page           :  cur_page,
                        month              :  month,
                        user_id            :  user_id,
                        from_day           :  from_day,
                        to_day             :  to_day,
                        date_type          :  date_type,
                    },
                    beforeSend: function() {
                        jQuery("#idwaiting_search").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/vtbusy.gif" alt="waiting....." />'); 
                    },
                    success:function(data){
                        if(data == '-1'){
                            alert('Data not found');
                        }else if(data != ''){
                            jQuery("#return_content").fadeOut( 250 , function() {
                                jQuery(this).html(data);
                            }).fadeIn( 350 );
                        }else{
                            jAlert('Data not found','Notice');
                        }
                        jQuery("#idwaiting_search").html('');
                    }
    });                
}
function save_key_activities(){
    var multi = $('.row_info_key_acctivities');
    var keyactivities =  [];

    $.each(multi, function (i, item) {
        keyactivities.push({
            "title":$(item).find('textarea').val(),
            "number":$(item).find('input[type="text"]').val(),
            "color":$(item).find('input[type="color"]').val(),
            })
    });
    
    var datakpi =  JSON.stringify(keyactivities);
    //console.log(keyactivities);
    jQuery.ajax({ 
                type:"POST",
                url:"<?php echo CController::createUrl(''.$subject_js.'/save_key_activities')?>",
                data:{datakpi:datakpi},
                success:function(data){
					ajax_search_key_activities();
                }
   });
}
function ajax_search_key_activities(){
    jQuery.ajax({ 
                type:"POST",
                url:"<?php echo CController::createUrl(''.$subject_js.'/ajax_search_key_activities')?>",
                success:function(data){
					$("#return_content_key_activities").html(data);
                }
   });
}
</script>