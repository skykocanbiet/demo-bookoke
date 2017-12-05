
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
    <div id="oSrchRight" class="pull-left">
        <div class="form-group" style="margin-right:25px;">
            <label>Loại: </label>
             <?php 
                $listdata      = array();
                $listdata['0'] = "Lịch làm việc";
                echo CHtml::dropDownList('frm_search_type','',$listdata,array('onChange'=>"search_cus();",'class'=>'form-control','style'=>'width: 250px;'));
            ?>
        </div>

        <div class="form-group" style="margin-right:25px;">
                <label>Thời gian: </label>
              <?php 
                    
                    $listdata        = array();
                    $listdata['']    = "Chọn thời gian";
                    $listdata['1']   = "Hôm nay";
                    $listdata['2']   = "Tuần này";
                    $listdata['3']   = "Tháng này";
                    $listdata['4']   = "Tháng tới";
                    $listdata['5']   = "Tháng trước";
                    echo CHtml::dropDownList('frm_search_due_requester_date',3,$listdata,array('onChange'=>"getapdate();search_cus(1);",'class'=>'form-control'));
                    
                ?>
                <input style="display: none;" type="text" value="3" id="frm_search_requester_date" name="frm_search_received_date" onkeypress="runScript(event);" style="width: 160px;"/>
        </div>



        <div class="form-group" style="margin-right:25px;">
            <label>Nhân viên: </label>
              <?php 
                $listdata     = array();
                $listdata[""] = "Tất cả";
                $User         = GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3));
                foreach($User as $temp){
                    $listdata[$temp['id']] =  $temp['name'];
                }
                echo CHtml::dropDownList('frm_search_user_id','',$listdata,array('class'=>'form-control')); 
            ?>
        </div>
        <!-- <div class="form-group">
            <button class="btn btn_bookoke">Xem báo cáo</button>
        </div> -->
    </div>

    <div id="oSrchLeft" class="pull-right" style="text-align: right;">
        <!-- Split button -->
        <div class="btn-group">
          <button type="sumit" class="btn btn_bookoke"><i class="fa fa-search-plus"></i>&nbsp;Xem</button>
          <button type="button" class="btn btn_bookoke dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu menu-export">
            <li><a href="#"><i class="fa fa-print"></i>&nbsp;In</a></li>
            <li><a href="#"><i class="fa fa-file-excel-o"></i>&nbsp;Excel</a></li>
            <li><a href="#"><i class="fa fa-file-word-o"></i>&nbsp;Word</a></li>
            <li><a href="#"><i class="fa fa-file-pdf-o"></i>&nbsp;PDF</a></li>
            <li><a href="#"><i class="fa fa-file-o"></i>&nbsp;CSV</a></li>
          </ul>
        </div>
    </div>

    <div class="clearfix"></div>
</form>




<script>
    function search_cus()
    {

        // var number          = $("#frm_search_number").val();
        var type            = $("#frm_search_type").val();
        // var status          = $("#frm_search_status").val();
        // var lpp             = $("#frmLpp").val();
        
        jQuery.ajax({   type:"POST",
                        url:"<?php echo CController::createUrl('ReportingEmployee/TypeReport')?>",
                        data:{
                            // cur_page        :  cur_page,
                            // lpp             :  lpp,
                            // number          :  number,
                            type            :  type,
                            // status          :  status,
                        },
                        beforeSend: function() {
                            jQuery("#idwaiting_search").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/vtbusy.gif" alt="waiting....." />'); 
                        },
                        success:function(data){
                            if(data == '-1'){
                                alert('Data not found');
                            }else if(data != ''){
                                jQuery("#return_content").fadeIn("slow");
    							jQuery("#return_content").html(data);

                            }else{
                                jAlert('Data not found','Notice');
                            }
                            jQuery("#idwaiting_search").html('');
                        }
        });                
    }
    function getapdate(){
        var dateap =  $("#frm_search_due_requester_date").val();
        $("#frm_search_requester_date").val(dateap);
    }
    
    
    $(function() {
    	$( "#frm_search_approval_date" ).datepicker({
    		changeMonth: true,
    		changeYear: true,
            buttonImage: "/images/favicon.ico",
            buttonImageOnly: true,
            buttonText: "Select date",
            dateFormat: 'yy-mm-dd'
    	});
    });
    
    
    function ResetPA(){
        jQuery.ajax({   type:"POST",
                        url:"<?php echo CController::createUrl('itemsAccounting/Payable/ResetPA')?>",
                        success:function(data){
                          console.log(data);
                        }
        });  
    }
</script>