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
                    echo CHtml::dropDownList('frm_search_due_requester_date',3,$listdata,array('onChange'=>"getapdate();search_cus(1);",'class'=>'form-control'));
                    
                ?>
                <input style="display: none;" type="text" value="3" id="frm_search_requester_date" name="frm_search_received_date" onkeypress="runScript(event);" style="width: 160px;"/>
        </div>

        <!-- From Date -->
        <div class="form-group">
            <span class="account_label" style="width: 120px;">From Date:</span>
            <span>
                <input class="form-control"  type="text" value="" id="frm_search_from_date" name="frm_search_from_date" onkeypress="runScript(event);" style="width: 160px;"/>
            </span>
        </div>

        <!-- From Date -->
        <div class="form-group">
            <span class="account_label" style="width: 120px;">To Date:</span>
            <span>
                <input class="form-control"  type="text" value="" id="frm_search_to_date" name="frm_search_to_date" onkeypress="runScript(event);" style="width: 160px;"/>
            </span>
        </div>

    </div>

  <!--   <div id="oSrchLeft" class="pull-right" style="width: 30%;">
        <div class="input-group">
          <input type="text" class="form-control" id="frm_search_number" placeholder="Tìm kiếm theo mã PA && Order number">
          <div class="input-group-addon" id="order_srch"><span class="glyphicon glyphicon-search"></span></div>
       </div>

        <a type="" class="btn oBtnAdd" id="oAdds" data-toggle="modal" data-target="#quote_modal" title="" style="color: black;"><span class="glyphicon glyphicon-plus" style="color: white;"></span></a>
    </div> -->
    <div class="clearfix"></div>
</form>

<script>
    function search_cus(cur_page)
    {
        var from_date      = $("#frm_search_from_date").val();
        var to_date        = $("#frm_search_to_date").val();

        jQuery.ajax({   type:"POST",
                        url:"<?php echo CController::createUrl('Cashflow/searchcashflow')?>",
                        data:{
                            cur_page           :  cur_page,
                            from_date          :  from_date,
                            to_date            :  to_date,
                        },
                        beforeSend: function() {
                            jQuery("#idwaiting_search").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/vtbusy.gif" alt="waiting....." />'); 
                        },
                        success:function(data){
                            console.log(data);
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
    search_cus('1');
</script>