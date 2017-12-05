<?php
$this->pageTitle=Yii::app()->name . ' - Menu';
$this->breadcrumbs=array(
	'Menu',
);
?>
<script>

function ClickClients(){  
}

function Click_view_users(){
    jQuery.ajax({type:'POST',
                    url:"<?php echo CController::createUrl('users/ajax_view_users')?>",
                    success:function(html){
                        jQuery('#id_view_content').html('');
                        jQuery('#id_view_content').html(html);
                    }});
}

function view_wholesale_clients(){
    jQuery.ajax({type:'POST',
                    url:"<?php echo CController::createUrl('clients/wholesale_clients');?>",
                    success:function(html){
                        jQuery('#id_view_content').html(html);
                    }});
}
function search_wholesale_client(cur_page){

    jQuery("#idwaiting_search").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/vtbusy.gif" alt="waiting....." />');
    
    var search_login          = $("#box_search_login").val();
    var search_password       = $("#box_search_password").val();
    var search_ip             = $("#box_search_ip").val();
    var search_reseller       = $("#box_search_reseller").val();
    var search_id_tariff      = $("#box_search_id_tariff").val();
    var search_remaining_form = $("#box_search_remaining_form").val();
    var search_remaining_to   = $("#box_search_remaining_to").val();

     jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('clients/ajax_search_wholesaleclients')?>&search_login="+search_login+"&search_password="+search_password+"&search_ip="+search_ip+"&search_reseller="+search_reseller+"&search_id_tariff="+search_id_tariff+"&search_remaining_form="+search_remaining_form+"&search_remaining_to="+search_remaining_to+"&cur_page="+cur_page,
                    success:function(html){                   
                                               if(html!='-1'){
                                                    
                        							jQuery("#view_list_content").html(html);
                                                   
                                                    jQuery("#idwaiting_search").html('');
                                               }else{
                                                    jQuery("#idwaiting_search").html('');
                                                    alert('Data not found','Notice');
                                               }
                                        }
                      });
}

/* VIEW RETAIL CLIENT */
function view_retail_client(){
    jQuery.ajax({type:'POST',
                    url:"<?php echo CController::createUrl('clients/retail_clients');?>",
                    success:function(html){
                        jQuery('#id_view_content').html(html);
                    }});
}
function search_retail_client(cur_page){

    jQuery("#idwaiting_search").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/vtbusy.gif" alt="waiting....." />');
    
    var search_login          = $("#box_search_login").val();
    var search_password       = $("#box_search_password").val();
    var search_pin            = $("#box_search_pin").val();
    var search_ani            = $("#box_search_ani").val();
    var search_reseller       = $("#box_search_ressller").val();
    var search_activity       = $("#box_search_activity").val();
    var search_id_tariff      = $("#box_search_id_tariff").val();
    var search_id_lot         = $("#box_search_id_lot").val();
    var search_remaining_from = $("#box_search_remaining_from").val();
    var search_remaining_to   = $("#box_search_remaining_to").val();

     jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('clients/ajax_search_retail_clients')?>&search_login="+search_login+"&search_password="+search_password+"&search_pin="+search_pin+"&search_ani="+search_ani+"&search_reseller="+search_reseller+"&search_activity="+search_activity+"&search_id_tariff="+search_id_tariff+"&search_id_lot="+search_id_lot+"&search_remaining_from="+search_remaining_from+"&search_remaining_to="+search_remaining_to+"&cur_page="+cur_page,
                    success:function(data){                   
                                               if(data!='-1'){
                        							jQuery("#view_list_content").html(data);
                                                    jQuery("#idwaiting_search").html('');
                                               }else{
                                                    jQuery("#idwaiting_search").html('');
                                                    alert('Data not found','Notice');
                                               }
                                        }
                      });
}
function runScript_retail_clients(e) {
    if (e.keyCode == 13) {
        var page_1=$('#id_text_page').val();
        if(page_1)
            search_retail_client(page_1);
        else
            search_retail_client('1');
    }
}
/* END RETAIL CLIENT */

/* VIEW CALL */
function view_calls(){
    jQuery.ajax({type:'POST',
                    url:"<?php echo CController::createUrl('calls/view_calls');?>",
                    success:function(html){
                        jQuery('#id_view_content').html(html);
                    }
    });
}
function search_calls(cur_page){

    jQuery("#idwaiting_search").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/vtbusy.gif" alt="waiting....." />');
    
    var search_callnumber     = $("#box_search_callnumber").val();
    var search_duration1             = $("#box_search_duration1").val();
    var search_duration2             = $("#box_search_duration2").val();
    var search_revenue1              = $("#box_search_revenue1").val();
    var search_revenue2              = $("#box_search_revenue2").val();
    
    var search_period         = $("#box_search_period").val();
    var search_date_form      = $("#box_search_date_form").val();
    var search_date_to        = $("#box_search_date_to").val();
    var search_time_format    = $("#box_search_time_format").val();
    var search_time_shift       = $("#box_search_time_shift").val();
    
    var search_caller_ip      = $("#box_search_caller_ip").val();
    var search_caller_id      = $("#box_search_caller_id").val();
    var search_orig_caller_id = $("#box_search_orig_caller_id").val();
    var search_tem_caller_id      = $("#box_search_tem_caller_id").val();
    
    var search_pdd1      = $("#box_search_pdd1").val();
    var search_pdd2      = $("#box_search_pdd2").val();
    var search_tariff = $("#box_search_tariff").val();
    var search_route      = $("#box_search_route").val();
    var search_route_type      = $("#box_search_route_type").val();

     jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('calls/ajax_search_calls')?>&search_callnumber="+search_callnumber+"&search_duration1="+search_duration1+"&search_duration2="+search_duration2+"&search_revenue1="+search_revenue1+"&search_revenue2="+search_revenue2+
                                                                                          "&search_period="+search_period+"&search_date_form="+search_date_form+"&search_date_to="+search_date_to+"&search_time_format="+search_time_format+"&search_time_shift="+search_time_shift+"&search_caller_id="+search_caller_id+
                                                                                          "&search_pdd1="+search_pdd1+"&search_pdd2="+search_pdd2+"&search_tariff="+search_tariff+"&search_route="+search_route+"&search_route_type="+search_route_type+
                                                                                          "&cur_page="+cur_page,
                    success:function(data){                   
                                               if(data!='-1'){
                        							jQuery("#view_list_content").html(data);
                                                    jQuery("#idwaiting_search").html('');
                                               }else{
                                                    jQuery("#idwaiting_search").html('');
                                                    alert('Data not found','Notice');
                                               }
                                        }
                      });
}
function runScript_calls(e) {
    if (e.keyCode == 13) {
        var page_1=$('#id_text_page').val();
        if(page_1)
            search_calls(page_1);
        else
            search_calls('1');
    }
}
/* END CALL */

/* TARIFFS NAME */
function view_tariffs(){
    jQuery.ajax({type:'POST',
                    url:"<?php echo CController::createUrl('tariffs/view_tariffs');?>",
                    success:function(html){
                        jQuery('#id_view_content').html(html);
                    }});
}

function search_tariff(cur_page){

    jQuery("#idwaiting_search").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/vtbusy.gif" alt="waiting....." />');
    
    var search_tariff_name          = $("#box_search_tariff_name").val();
    var search_currency             = $("#box_search_currency").val();

     jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('tariffs/ajax_search_tariffs')?>&search_tariff_name="+search_tariff_name+"&search_currency="+search_currency+"&cur_page="+cur_page,
                    success:function(html){                   
                                               if(html!='-1'){
                        							jQuery("#view_list_content").html(html);
                                                    jQuery("#idwaiting_search").html('');
                                               }else{
                                                    jQuery("#idwaiting_search").html('');
                                                    alert('Data not found','Notice');
                                               }
                                        }
                      });
}

function Click_on_row_tariffs(idtariff){
    
    $('#view_box_modify_tariff').css('display','block');
    $('#view_box_detail_tariff').css('display','none');
    
    var tariff_name = $('#tariff_name'+idtariff+' a').html();
    var min_time = $('#minimal_time'+idtariff).html();
    var resolution = $('#resolution'+idtariff).html();
    var surcharge_time = $('#surcharge_time'+idtariff).html();
    var surcharge_amount = $('#surcharge_amount'+idtariff).html();
    //var time_span = $('#').val();
    var currency = $('#currencyname'+idtariff).html();
    
    $('#box_id_tariff').val(idtariff);
    $('#box_tariff_name').val(tariff_name);
    $('#box_min_time').val(min_time);
    $('#box_resolution').val(resolution);
    //box_tariff_multiplier
    //box_rate_addition
    $('#box_surcharge_time').val(surcharge_time);
    $('#box_surcharge_amount').val(surcharge_amount);
    //$('#checkbox_time_span').val();
    $('#box_currency option').filter(function() {
        return $(this).text() == currency; 
    }).prop('selected', true);
}
function save_tariff(){
    var id_tariff = $('#box_id_tariff').val();
    var tariff_name = $('#box_tariff_name').val();
    var min_time = $('#box_min_time').val();
    var resolution = $('#box_resolution').val();
    var surcharge_time = $('#box_surcharge_time').val();
    var surcharge_amount = $('#box_surcharge_amount').val();
    var currency = $('#box_currency option').val();
    jQuery.ajax({type:'POST',
                    url:"<?php echo CController::createUrl('tariffs/save_tariff');?>&id_tariff="+id_tariff+'&tariff_name='+tariff_name+'&min_time='+min_time+'&resolution='+resolution+'&surcharge_time='+surcharge_time+'&surcharge_amount='+surcharge_amount+'&currency='+currency,
                    success:function(data){
                                            if(data=='1'){
                                                Click_view_tariffs();
                                            }
                    }});
}
function add_tariff(){
    var tariff_name = $('#box_tariff_name').val();
    var min_time = $('#box_min_time').val();
    var resolution = $('#box_resolution').val();
    var surcharge_time = $('#box_surcharge_time').val();
    var surcharge_amount = $('#box_surcharge_amount').val();
    var currency = $('#box_currency option').val();
    jQuery.ajax({type:'POST',
                    url:"<?php echo CController::createUrl('tariffs/add_tariff');?>&tariff_name="+tariff_name+'&min_time='+min_time+'&resolution='+resolution+'&surcharge_time='+surcharge_time+'&surcharge_amount='+surcharge_amount+'&currency='+currency,
                    success:function(data){
                                            if(data=='1'){
                                                Click_view_tariffs();
                                            }
                    }});
}
/* END TARIFFS NAME */
/* TARIFFS */
function Click_detail_tariff(idtariff){
    //alert(idtariff);
    var cur_page = 1;
    jQuery.ajax({type:'POST',
                    url:"<?php echo CController::createUrl('tariffs/view_detail_tariffs');?>&idtariff="+idtariff+"&cur_page="+cur_page,
                    success:function(data){
                        if(data){
                            $('#view_box_modify_tariff').css('display','none');
                            $('#view_box_detail_tariff').css('display','block');
                            $('#view_box_detail_tariff').html(data);
                        }
                    }});
}

function search_detail_tariff(cur_page){
    
    var search_prefix         = $("#box_search_prefix").val();
    var search_description    = $("#box_search_description").val();

     jQuery.ajax({ type:"POST",
                    url:" <?php echo CController::createUrl('tariffs/ajax_search_detail_tariffs')?>&search_prefix="+search_prefix+"&search_description="+search_description+"&cur_page="+cur_page,
                    success:function(html){                   
                                               if(html!='-1'){
                        							jQuery("#view_list_detail_tariff").html(html);
                                               }else{
                                                    alert('Data not found','Notice');
                                               }
                                        }
                      });
}
function Click_on_row_detail_tariffs(idtariff){
    var prefix = $('#row_prefix'+idtariff).html();
    var description = $('#row_description'+idtariff).html();
    var rate = $('#row_multiplier'+idtariff).html();
    var from_day = $('#row_from_day'+idtariff).html();
    var to_day = $('#row_to_day'+idtariff).html();
    var from_hour = $('#row_from_hour'+idtariff).html();
    var to_hour = $('#row_to_hour'+idtariff).html();
    var grace_per = $('#row_grace_period'+idtariff).html();
    var minimal_time = $('#row_minimal_time'+idtariff).html();
    var resolution = $('#row_resolution'+idtariff).html();
    var surcharge_time = $('#row_surcharge_time'+idtariff).html();
    var surcharge_amount = $('#row_surcharge_amount'+idtariff).html();
    
    $('#info_idtariff').val(idtariff);
    $('#info_prefix').val(prefix);
    $('#info_description').val(description);
    $('#box_voice_rate').val(rate);
    //$('#from_day').val(from_day);
    $('#from_day').val(from_day).prop('selected',true);
    $('#to_day').val(to_day);
    $('#from_hour').val(from_hour);
    $('#to_hour').val(to_hour);
    $('#box_grace_period').val(grace_per);
    $('#box_minimal_time').val(minimal_time);
    $('#box_resolution').val(resolution);
    $('#box_surcharge_time').val(surcharge_time);
    $('#box_surcharge_amount').val(surcharge_amount);
}
function save_detail_tariff(id_tariff_father){
    var id_tariff = $('#info_idtariff').val();
    var prefix = $('#info_prefix').val();
    var description = $('#info_description').val();
    var rate = $('#box_voice_rate').val();
    //var from_day = $('#from_day').val();
    var from_day = $('#from_day option:selected').val();
    var to_day = $('#to_day option:selected').val();
    var from_hour = $('#from_hour').val();
    var to_hour = $('#to_hour').val();
    var grace_per = $('#box_grace_period').val();
    var minimal_time = $('#box_minimal_time').val();
    var resolution = $('#box_resolution').val();
    var surcharge_time = $('#box_surcharge_time').val();
    var surcharge_amount = $('#box_surcharge_amount').val();
    
    jQuery.ajax({type:'POST',
                    url:"<?php echo CController::createUrl('tariffs/save_detail_tariff');?>&id_tariff_father="+id_tariff_father+'&id_tariff='+id_tariff+'&prefix='+prefix+'&description='+description+'&rate='+rate+'&from_day='+from_day+'&to_day='+to_day+'&from_hour'+from_hour+'&to_hour='+to_hour,
                    success:function(data){
                        if(data!='-1'){
                            alert('Save success!');
                            search_detail_tariff(1);
                        }
                        else{
                            alert('Save fail!');
                        }
                    }});
}
function add_detail_tariff(id_tariff_father){
    
    var prefix = $('#info_prefix').val();
    var description = $('#info_description').val();
    var rate = $('#box_voice_rate').val();
    //var from_day = $('#from_day').val();
    var from_day = $('#from_day option:selected').val();
    var to_day = $('#to_day option:selected').val();
    var from_hour = $('#from_hour').val();
    var to_hour = $('#to_hour').val();
    var grace_per = $('#box_grace_period').val();
    var minimal_time = $('#box_minimal_time').val();
    var resolution = $('#box_resolution').val();
    var surcharge_time = $('#box_surcharge_time').val();
    var surcharge_amount = $('#box_surcharge_amount').val();
    jQuery.ajax({type:'POST',
                    url:"<?php echo CController::createUrl('tariffs/add_detail_tariff');?>&id_tariff_father="+id_tariff_father+'&prefix='+prefix+'&description='+description+'&rate='+rate+'&from_day='+from_day+'&to_day='+to_day+'&from_hour'+from_hour+'&to_hour='+to_hour,
                    success:function(data){
                        if(data!='-1'){
                            alert('Add success!');
                            search_detail_tariff(1);
                        }
                        else{
                            alert('Add fail!');
                        }
                    }});
}


/* END TARIFFS */
function runScript_tariff(e) {
    if (e.keyCode == 13) {
        var page_1=$('#id_text_page').val();
        if(page_1)
            search_tariff(page_1);
        else
            search_tariff('1');
    }
}

function runScript_wholesale(e){
    if (e.keyCode == 13) {
        var page_1=$('#id_text_page').val();
        if(page_1)
            search_wholesale_client(page_1);
        else
            search_wholesale_client('1');
    }
}
/* START BUY/CANCEL DID */
function view_buy_cancel_did(){
    jQuery.ajax({type:'POST',
                    url:"<?php echo CController::createUrl('didmanager/view_buy_cancel_did');?>",
                    success:function(data){
                                        jQuery('#id_view_content').html(data);
                    }});
}
/* END BUY/CANCEL DID */

/* START COUNTRY MANAGEMENT DID */
function view_country_management(){
    jQuery.ajax({type:'POST',
                    url:"<?php echo CController::createUrl('didmanager/view_country_management');?>",
                    success:function(data){
                                        jQuery('#id_view_content').html(data);
                    }});
}
/* END COUNTRY MANAGEMENT DID */

/* START DID MANAGEMENT */
function view_did_management(){
    jQuery.ajax({type:'POST',
                    url:"<?php echo CController::createUrl('didmanager/view_did_management');?>",
                    success:function(data){
                                        jQuery('#id_view_content').html(data);
                    }});
}
/* END DID MANAGEMENT   */

</script>

<div id="menu_items" style="width: 20%;float: left;">
    <ol class="tree">
		<li>
			<label onclick="ClickClients();" for="folder1">Clients</label> <input type="checkbox" id="folder1" /> 
			<ol>
				<li class="file" onclick="Click_view_Wholesale_clients();"><span class="title_file">Wholesale clients</span></li>
                <li class="file" onclick="view_retail_client();" ><span class="title_file">Retail clients</span></li>
                <li class="file"><span class="title_file">CallShop clients</span></li>
                <li>
					<label for="subfolder2">Other</label> <input type="checkbox" id="subfolder2" />
                    <ol>
                        <li class="file">CallBack clients</li>
                        <li class="file">IVR clients</li>
                    </ol>
				</li>
			</ol>
		</li>
        <li>
            <label onclick="view_calls();" for="folder2">Calls</label> <input type="checkbox" id="folder2" /> 
            <ol>
				<li class="file" onclick="" style="cursor: pointer;">Wholesale clients</li>
                <li class="file">Retail clients</li>
            </ol>
        </li>
        <li style="cursor: pointer;" onclick="">
            <label onclick="view_tariffs();" for="folder3">Tariffs</label> <input type="checkbox" id="folder3" /> 
        </li>
        <li style="cursor: pointer;" onclick="">
            <label onclick="Click_view_users();" for="folder4">Users</label> <input type="checkbox" id="folder4" /> 
        </li>
        <li>
			<label onclick="" for="folder5">DID Manager</label> <input type="checkbox" id="folder5" /> 
			<ol>
				<li class="file" onclick="view_buy_cancel_did();"><span class="title_file">Buy/Cancel DIDs</span></li>
                <li class="file" onclick="view_country_management();"><span class="title_file">Country management</span></li>
                <li class="file" onclick="view_did_management();"><span class="title_file">DID management</span></li>
			</ol>
		</li>
	</ol>
</div>
<div id="container" style="float:left; width: 79%; border: 1px solid #bcbcbc;">
    <div id="table_view" style="width: 98%;position: relative;padding: 10px;">
        <div style="position:relative; display: block;" id="id_view_content">Filter</div>
    </div>
</div>
<div class="clear"></div>
