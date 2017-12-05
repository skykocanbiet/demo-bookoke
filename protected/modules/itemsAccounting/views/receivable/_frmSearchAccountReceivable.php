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

<form class="form-inline">
    <div id="oSrchRight" class="pull-left" style="width: 69%">
        <div class="form-group">
                <label>AP Date:</label>
              <?php 
                    
                    $listdata        = array();
                    $listdata['']    = "Select date";
                    $listdata['1']   = "Today";
                    $listdata['2']   = "This week";
                    $listdata['3']   = "This month";
                    $listdata['4']   = "Next month";
                    $listdata['5']   = "Last month";
                    echo CHtml::dropDownList('frm_search_due_received_date',3,$listdata,array('onChange'=>"getapdate();search_cus(1);",'class'=>'form-control'));
                    
                ?>
                <input style="display: none;" type="text" value="3" id="frm_search_requester_date" name="frm_search_due_received_date" onkeypress="runScript(event);" style="width: 160px;"/>
        </div>

        <div class="form-group">
            <label>AP Type:</label>
             <?php 
                $listdata      = array();
                $listdata['']  = "Select Type";
                $listdata['0'] = "Revenue";
                $listdata['1'] = "Investment";
                $listdata['2'] = "Others";
                echo CHtml::dropDownList('frm_search_type','',$listdata,array('onChange'=>"search_cus(1);",'class'=>'form-control'));
            ?>
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input class="form-control"  type="text" value="" id="frm_search_phone" name="frm_search_phone" onkeypress="runScript(event);" />
        </div>

        <div class="form-group">
            <label>Payer</label>
            <input class="form-control"  type="text" value="" id="frm_search_payer" name="frm_search_payer" onkeypress="runScript(event);" />
        </div>

    </div>

    <div id="oSrchLeft" class="pull-right" style="width: 30%;text-align: right;">
        <div class="input-group" style="width: 65%;">
          <input type="text" class="form-control" id="frm_search_number" placeholder="Tìm kiếm theo mã AR & Order number">
          <div class="input-group-addon" id="order_srch"><span class="glyphicon glyphicon-search"></span></div>
       </div>

        <a type="" class="btn_plus" id="oAdds" data-toggle="modal" data-target="#quote_modal"></a>
    </div>
    <div class="clearfix"></div>
</form>

<div id="view_payment_voucher" style="">
    
</div>
<script>
    function search_cus(cur_page)
    {
        var number          = $("#frm_search_number").val();

        var type            = $("#frm_search_type").val();
        var status          = $("#frm_search_status").val();
        var received_date   = $("#frm_search_due_received_date").val();
        var payer           = $("#frm_search_payer").val();
        var phone           = $("#frm_search_phone").val();
        var lpp             = $("#frmLpp").val();
        
        jQuery.ajax({   type:"POST",
                        url:"<?php echo CController::createUrl('Receivable/search_'.$model->tableName().'')?>",
                        data:{
                            cur_page        :  cur_page,
                            lpp             :  lpp,
                            number          :  number,
                            type            :  type,
                            status          :  status,
                            received_date   :  received_date,
                            payer           :  payer,
                            phone           :  phone,
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
    function getapdate(){
        var dateap =  $("#frm_search_due_received_date").val();
        $("#frm_search_received_date").val(dateap);
    }
    $(function() {
    	$( "#frm_search_approval_date" ).datepicker({
    		changeMonth: true,
    		changeYear: true,
            dateFormat: 'yy-mm-dd'
    	});
    });
    
    search_cus('1');
    
    
    function resetAR(){
        jQuery.ajax({   type:"POST",
                        url:"<?php echo CController::createUrl('Receivable/ResetRA')?>",
                        success:function(data){
                          console.log(data);
                        }
        });  
    }
</script>