<style>

.lable_phone_new{
    position: absolute;
    top: 7px;
    right: 10px;
    background: #3498db;
    color: #fff;
    padding: 1px 8px;
    text-transform:uppercase;
    border: 1px solid #3498db;
    box-sizing:border-box;
    border-radius: 10px;
    font-size: 9px;
    text-shadow: 0px 1px 1px #c2c8cd;
    border: 1px solid #3498db;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -ms-box-sizing: border-box;
    -o-box-sizing: border-box;
}
.lable_phone_invalid{
    position: absolute;
    top: 7px;
    right: 10px;
    background: red;
    color: #fff;
    padding: 1px 8px;
    text-transform:uppercase;
    border: 1px solid red;
    box-sizing:border-box;
    border-radius: 10px;
    font-size: 9px;
    text-shadow: 0px 1px 1px #c2c8cd;
    border: 1px solid red;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -ms-box-sizing: border-box;
    -o-box-sizing: border-box;
}
.key_search{ 
    color: #0072f4;
}
.input-icon-prepend .dropdown-menu{
    width: 300px;
}

.input-icon-prepend .dropdown-menu a{
    padding:5px;
}
.dropdown-menu>li{
    border-top: 1px solid #ccd6dd;
}
.dropdown-menu>li:first-child{
    border-top:none;
}
.dropdown-menu>li a:hover .typeahead_wrapper .typeahead_primary { color: #fff !important;}
.dropdown-menu .active{
    color: #fff !important;
}
.dropdown-menu>li a:hover .typeahead_wrapper .typeahead_secondary { color: #fff !important;}
.typeahead_wrapper                             { display: block;width: 100%;margin: 0px auto;}
.typeahead_wrapper .typeahead_labels           { float: left; line-height: 19px; }
.typeahead_wrapper .typeahead_labels::after    { clear:both; }
.typeahead_wrapper .typeahead_primary          { font-size: 15px;  }
.typeahead_wrapper .typeahead_secondary        { font-size: 11px; color: #666;  }
.typeahead_wrapper .typeahead_userinfo         { float: right; line-height: 17px;}
.typeahead_wrapper .typeahead_userinfo::after  { clear: both; } 
.typeahead_wrapper .typeahead_userinfo .lable_accounts{ display: inline-block;font-size: 11px; color: #8899a6;width: 60px; text-align: right;}
.typeahead_wrapper .typeahead_userinfo .users_name{ display: inline-block;font-size: 12px;margin-left: 5px; width: 85px; }
.typeahead_wrapper .typeahead_userinfo .status{ display: inline-block;font-size: 12px;margin-left: 5px; width: 85px; }
</style>
<!-- SHOW VIEW FORM INFO SEARCH -->
<div style="margin:10px auto 25px; width:100%; position: relative;">

    <!-- VIEW BUTTON ACTION -->
    <span style="position: absolute;top: 3px;right: 15px;">
        <button class="button_izi" onclick="search_cus('1')" >Search</button>
        <span id="idwaiting_search" style="position: absolute;right:80px; top: 3px;"></span>
    </span>
    <!-- END BUTTON ACTION -->
    
    <div style="float: left;margin-right: 5%;margin-left: 6%;">
        
        <!-- Supplier -->
        <div class="new_account_row">
            <span class="account_label" style="width: 120px;">Supplier:</span>
            <span>
                <?php
        		$supplier = array();
        		$list_data = Supplier::model()->findAll();
        		$supplier[''] = "Select Supplier";
        		foreach($list_data as $temp){
        			$supplier[$temp['id']] = $temp['name'];
        		}
                echo CHtml::dropDownList('search_product_sup_name','',$supplier,array('onChange'=>"search_cus(1)"));
                ?>
            </span>
        </div>
        <!-- Users Manager -->
        <div class="new_account_row">
            <span class="account_label" style="width: 120px;">Users Manager:</span>
            <span>
                <?php 
                    $listdata     = array();
                    $listdata[''] = "ALL";
                    foreach($model->getListUsers() as $temp){
                        $listdata[$temp['id']] =  $temp['name'];
                    }
                    $group_no = Yii::app()->user->getState('group_no');
                    if(($group_no=='admin'||$group_no=='superadmin' || $group_no=='manager' || $group_no=='leader')){
                        echo CHtml::dropDownList('frm_search_id_user',$model->id_user,$listdata,array('onChange'=>"search_cus(1);",'style'=>'width: 175px;')); 
                    }else{
                        echo CHtml::dropDownList('frm_search_id_user',$model->id_user,$listdata,array('onChange'=>"search_cus(1);",'style'=>'width: 175px;',"disabled"=>"disabled",'options'=>array(Yii::app()->user->getState('id_user')=>array('selected'=>true)))); 
                    }
                ?>
            </span>
        </div>
        <!-- Product -->
        <div class="new_account_row">
            <span class="account_label" style="width: 120px;">Product:</span>
            <span>
                <input data-provide="typeahead" data-list-size="5" data-maxage="20"  type="text" value="<?php echo ($model)?($model->product_name):'' ?>" id="frm_search_product_name" name="frm_search_product_name" onkeypress="runScript(event);" style="width: 160px;"/>
            </span>
        </div>
        
        
    </div>
    <div style="float: left;">
        <!-- Phone -->
        <div class="new_account_row">
            <span class="account_label" style="width: 120px;">Phone:</span>
            <span class="input-icon-prepend">
                <input  type="text" value="<?php echo ($model)?($model->getPhoneCustomer($model->id_customer)):'' ?>" id="frm_search_phone" name="frm_search_phone" onkeypress="runScript(event);" style="width: 160px;" data-provide="typeahead" />
            </span>
        </div>
        <!-- From Date -->
        <div class="new_account_row">
            <span class="account_label" style="width: 120px;">From Date:</span>
            <span>
                <input  type="text" value="" id="frm_search_from_date" name="frm_search_from_date" onkeypress="runScript(event);" style="width: 160px;"/>
            </span>
        </div>
        <!-- To Date -->
        <div class="new_account_row">
            <span class="account_label" style="width: 120px;">To Date:</span>
            <span>
                <input  type="text" value="" id="frm_search_to_date" name="frm_search_to_date" onkeypress="runScript(event);" style="width: 160px;"/>
            </span>
        </div>
        
    </div>
    <div style="clear: both;"></div>
</div>

<!-- END VIEW FORM INFO SEARCH -->
<div id="return_content">
    <?php // Content table search ?>
</div>
<script>
    function search_cus(cur_page)
    {
        var order_number        = $("#frm_search_order_number").val();
        var ordered_date        = $("#frm_search_ordered_date").val();
        var shipped_date        = $("#frm_search_shipped_date").val();
        var tracking_number     = $("#frm_search_tracking_number").val();
        var delivery_shipping   = $("#frm_search_delivery_shipping").val();
        var shipper_name        = $("#frm_search_shipper_name").val();
        
        jQuery.ajax({   type:"POST",
                        url:"<?php echo CController::createUrl('sales/search_'.$model->tableName().'')?>",
                        data:{
                            cur_page                :  cur_page,
                            order_number            :  order_number,
                            ordered_date            :  ordered_date,
                            shipped_date            :  shipped_date,
                            tracking_number         :  tracking_number,
                            delivery_shipping       :  delivery_shipping,
                            shipper_name            :  shipper_name,
                        },
                        beforeSend: function() {
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
    $(function() {
    	$( "#frm_search_from_date" ).datepicker({
    		changeMonth: true,
    		changeYear: true,
            dateFormat: 'yy-mm-dd'
    
    	});
        $( "#frm_search_to_date" ).datepicker({
    		changeMonth: true,
    		changeYear: true,
            dateFormat: 'yy-mm-dd'
    
    	});
    });
    $(document).ready(function() {
        
        // use this hash to cache search results
        window.query_cache = {};
        
        $('#frm_search_phone').typeahead({
            minLength:3,
            source: function (phone, process) {
            if(query_cache[phone]){
                  process(query_cache[phone]);
                  return;
            }
            if( typeof searching != "undefined") {
                  clearTimeout(searching);
                  process([]);
            }
            
            $.ajax({
                url: '<?php echo CController::createUrl('Opportunity/ListPhoneContact')?>',
                type: 'POST',
                dataType: 'JSON',
                data:{
                    phone        : phone,
                },
                success: function(data){
                    Accounts = {};
                    AccountLabels = [];
                    map = [];
                    
                    $.each(data, function(i, v){
                       
                        Accounts[ v.phone ] = {
                            idlead  : v.idlead
                            ,name   : v.lastname + ' ' + v.firstname
                            ,phone  : v.phone
                            ,user   : v.user_names
                            ,status : v.status
                        };
        
                        AccountLabels.push(v.phone);
                        
                    })
                    return process(AccountLabels);
                }
            });
            
            },
            highlighter: function(item){
                
                var p = Accounts[item];
                
                if(p.name.length > 1){
                    fullname =  p.name ; 
                }else{
                    fullname = 'N/A';
                }
                
                if(p.status == 0 || p.status == '' || p.status == null ){
                    accountstatus = 'Lead';
                }else if(p.status == 1 ){
                    accountstatus = 'Account';
                }else{
                    accountstatus = 'N/A';
                }
                
                var rep_phone = p.phone.replace(this.query,'<strong>'+this.query+'</strong>');
                
                var itm = ''
                         + "<div class='typeahead_wrapper'>"
                         + "<div class='typeahead_labels'>"
                         + "<div class='typeahead_primary'>" + rep_phone + "</div>"
                         + "<div class='typeahead_secondary'>" +  fullname + "</div>"
                         + "</div>"
                         + "<div class='typeahead_userinfo'>"
                         + "<div class='status_account'><span class='lable_accounts'>Status :</span><span class='status'>"+ accountstatus +"</span></div>"
                         + "<div class='user_account'><span class='lable_accounts'>Manager :</span><span class='users_name'>" + p.user + "</span></div>"
                         + "</div><div class='clearfix'></div>"
                         + "</div>";
                return itm;
            }
    
        });
        
    });
    $(document).ready(function() {
        
        // use this hash to cache search results
        window.query_cache = {};
        
        $('#frm_search_product_name').typeahead({
            minLength:3,
            source: function (name, process) {
            if(query_cache[name]){
                  process(query_cache[name]);
                  return;
            }
            if( typeof searching != "undefined") {
                  clearTimeout(searching);
                  process([]);
            }
            
            $.ajax({
                url: '<?php echo CController::createUrl('Reports/getAllListProducts')?>',
                type: 'POST',
                dataType: 'JSON',
                data:{
                    name        : name,
                },
                success: function(data){

                    Accounts = {};
                    AccountLabels = [];
                    map = [];
                    
                    $.each(data, function(i, v){
                       
                        Accounts[ v.name ] = {
                             id_product          : v.id_product
                            ,name                : v.name
                            ,price               : v.price
                            ,unit                : v.unit
                            ,stock               : v.stock
                            ,name_pl             : v.pl_name
                            ,sup_name            : v.sup_name
                            ,status              : v.st
                        };
        
                        AccountLabels.push(v.name);
                        
                    })
                    return process(AccountLabels);
                }
            });
            
            },
            highlighter: function(item){
                
                var p = Accounts[item];
                
                if(p.status > 0 ){
                    pro_status = 'Active';
                }else{
                    pro_status = 'Inactive';
                }
                
                if(p.stock > 0 ){
                    pro_stock = p.stock;
                }else{
                    pro_stock = 'sold out';
                }
                
                var rep_name = p.name.replace(this.query,'<strong>'+this.query+'</strong>');
                
                var itm = ''
                         + "<div class='typeahead_wrapper'>"
                         + "<div class='typeahead_labels'>"
                         + "<div class='typeahead_primary'>" + rep_name + "</div>"
                         + "<div class='typeahead_secondary'>Price: " +  p.price + "</div>"
                         + "</div>"
                         + "<div class='typeahead_userinfo'>"
                         + "<div class='status_account'><span class='lable_accounts'>Status :</span><span class='status'>"+ pro_status +"</span></div>"
                         + "<div class='user_account'><span class='lable_accounts'>Stock :</span><span class='users_name'>" + pro_stock + "</span></div>"
                         + "</div><div class='clearfix'></div>"
                         + "</div>";
                return itm;
            }
    
        });
        
    });
    //search_cus('1');
</script>