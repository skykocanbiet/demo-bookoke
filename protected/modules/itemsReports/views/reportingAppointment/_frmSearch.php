
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
        <div class="form-group" style="margin-right:20px;">
            <label>Loại: </label>
             <?php 
                $listdata      = array();
                // $listdata['']  = "Chọn loại báo cáo";
                $listdata['0'] = "Tổng lịch hẹn";
                $listdata['1'] = "Lịch hẹn bị hủy";
                $listdata['2'] = "Không đến";
             
                echo CHtml::dropDownList('frm_search_type','',$listdata,array('onChange'=>"search_cus()",'class'=>'form-control'));
            ?>
        </div>
        <div class="form-group" style="margin-right:20px;">
            <label>Văn phòng: </label>
              <?php 
                $listdata     = array();
                $listdata[""] = "Tất cả";
                $branch         = Branch::model()->findAll();
                foreach($branch as $temp){
                    $listdata[$temp['id']] =  $temp['name'];
                }
                echo CHtml::dropDownList('frm_search_branch','',$listdata,array('class'=>'form-control','onChange'=>'changeBranch()')); 
            ?>
        </div>
        <div class="form-group" style="margin-right:20px;">
                <label>Thời gian: </label>
              <?php 
                    
                    $listdata        = array();
                    $listdata['5']   = "Chọn thời gian";
                    $listdata['1']   = "Hôm nay";
                    $listdata['2']   = "Tuần này";
                    $listdata['3']   = "Tháng này";
                    $listdata['4']   = "Tháng trước";
                    echo CHtml::dropDownList('frm_search_due_requester_date',3,$listdata,array('class'=>'form-control'));
                    
                ?>
        </div>

        <div class="form-group" style="margin-right:20px;">
            <label>Nhân viên: </label>
            <span id="lstStaff">
                <?php 
                $listdata     = array();
                $listdata[""] = "Tất cả";
                $User         = GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3));
                foreach($User as $temp){
                    $listdata[$temp['id']] =  $temp['name'];
                }
                echo CHtml::dropDownList('frm_search_user_id','',$listdata,array('class'=>'form-control')); 
                ?>
            </span>
             
        </div>
        <div id="time" class="hidden">
            <div class="form-group" style="margin-right:20px;margin-top: 20px;">
                <label>Từ ngày: </label> 
                <input  type="text" id="fromtime" class="form-control" value="">
            </div>
            <div class="form-group" style="margin-right:20px;margin-top: 20px;">
                <label>Đến ngày: </label>
                <input  type="text" id="totime" class="form-control" value="">
                 
            </div>
        </div>

    </div>

    <div id="oSrchLeft" class="pull-right" style="text-align: right;">
        <!-- Split button -->
        <div class="btn-group">
          <button type="button" class="btn btn_bookoke" onclick="search_cus()"><i class="fa fa-search-plus"></i>&nbsp;Xem</button> 
          <button type="button" class="btn btn_bookoke dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu menu-export">
            <li><a href="#" class="print"><i class="fa fa-print"></i>&nbsp;In</a></li>
            <li><a href="#" class="btn_excel"><i class="fa fa-file-excel-o"></i>&nbsp;Excel</a></li>
            <li><a href="#" class="word"><i class="fa fa-file-word-o"></i>&nbsp;Word</a></li>
            <li><a href="#" class="pdf"><i class="fa fa-file-pdf-o"></i>&nbsp;PDF</a></li>
            <li><a href="#" class="csv"><i class="fa fa-file-o"></i>&nbsp;CSV</a></li>
          </ul>
        </div>
    </div>

    <div class="clearfix"></div>
</form>
<script type="text/javascript">
    $('#frm_search_due_requester_date').click(function () {
        if ($(this).val() == 5) {
          
            $('#time').removeClass('hidden');
        }else{
              $('#time').addClass('hidden');
        }
    });

     $(function () {
            $('#fromtime').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            });
             $('#totime').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
             });

    }); 

     $('#time').change(function(e){
        fromtime = $('#fromtime').datepicker( "getDate");
        totime   = $('#totime').datepicker( "getDate");
        if(fromtime > totime)
            $('#totime').datepicker( "setDate", fromtime);
    })
    $(document).ready(function(){
        search_cus();
    });

    function changeBranch()
    {
        var dataBranch =  $("#frm_search_branch").val();
        jQuery.ajax({   
            type:"POST",
            url:"<?php echo CController::createUrl('reportingAppointment/ChangeBranch')?>",
            data:{
                'dataBranch' :  dataBranch,
            },
            success:function(string){
                if (string!=="") {
                    $('#lstStaff').html(string);
                }
                
            }
        });
    }
    function search_cus()
    {
        var branch        = $("#frm_search_branch").val();
        var type          = $("#frm_search_type").val();
        var lstUser       = $("#frm_search_user_id").val();
        var search_time   = $("#frm_search_due_requester_date").val();
        var fromtime      = $("#fromtime").val();
        var totime        = $('#totime').val();
        $('.cal-loading').fadeIn('fast');
        jQuery.ajax({   
            type:"POST",
            url:"<?php echo CController::createUrl('reportingAppointment/typeReport')?>",
            data:{
                'branch'        :  branch,
                'lstUser'       :  lstUser,
                'type'          :  type,
                'search_time'   : search_time, 
                'fromtime'      :fromtime,
                'totime'        :totime    
            },
            beforeSend: function() {
               
            },
            success:function(data){
                if(data == '-1'){
                    alert('Data not found');
                }else if(data != ''){
                    $('.cal-loading').fadeOut('fast');
                    jQuery("#return_content").fadeIn("slow");
                    jQuery("#return_content").html(data);

                }else{
                    jAlert('Data not found','Notice');
                }
                jQuery("#idwaiting_search").html('');
            }
        });                
    }

    
$( document ).ready(function() {

    $('#oSrchBar').on('click','.print',function(e){      
        var branch        = $("#frm_search_branch").val();
        var type          = $("#frm_search_type").val();
        var lstUser       = $("#frm_search_user_id").val();
        var search_time   = $("#frm_search_due_requester_date").val();
        var fromtime      = $("#fromtime").val();
        var totime        = $('#totime').val();
        var url="<?php echo CController::createUrl('reportingAppointment/exportAppointment')?>?type="+type+"&branch="+branch+"&lstUser="+lstUser+"&search_time="+search_time+"&fromtime="+fromtime+"&totime="+totime;
        window.open(url,'name');
       
    });

});

$( document ).ready(function() {

    $('#oSrchBar').on('click','.pdf',function(e){  
         var branch        = $("#frm_search_branch").val();
        var type          = $("#frm_search_type").val();
        var lstUser       = $("#frm_search_user_id").val();
        var search_time   = $("#frm_search_due_requester_date").val();
        var fromtime      = $("#fromtime").val();
        var totime        = $('#totime').val();
        var url="<?php echo CController::createUrl('reportingAppointment/exportPDF_Appointment')?>?type="+type+"&branch="+branch+"&lstUser="+lstUser+"&search_time="+search_time+"&fromtime="+fromtime+"&totime="+totime;
        window.open(url,'name');
       
    });

});


</script>