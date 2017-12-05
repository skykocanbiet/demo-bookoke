<?php
    include 'style.php';
    $action = Yii::app()->getController()->getAction()->controller->action->id;
?>
 <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/excel/jquery.table2excel.min.js"></script> 
 <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/excel/jquery.tabletoCSV.js" charset="utf-8"></script>


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
                $listdata['0'] = "Danh sách Khách hàng";
                $listdata['1'] = "Ngày tạo Khách hàng";
                $listdata['2'] = "Sinh nhật Khách hàng";
                $listdata['3'] = "Chi tiêu của Khách hàng";
                $listdata['4'] = "Khách hàng theo dịch vụ";
                $listdata['5'] = "Khách hàng còn công nợ";
                $listdata['6'] = "Các ghi chú của Khách hàng";
                $listdata['7'] = "Các phàn nàn của Khách hàng";
                 $listdata['8'] = "Hình thức thanh toán";

                switch ($action) {
                    case 'View':
                        $selected = 0;
                        break;
                    case 'Date':
                        $selected = 1;
                        break;    
                    case 'Birthday':
                        $selected = 2;
                        break; 
                    case 'Spend':
                        $selected = 3;
                        break;     
                    case 'Service':
                        $selected = 4;
                        break;  
                    case 'Note':
                        $selected = 6;
                        break;         
                }

                echo CHtml::dropDownList('frm_search_type','',$listdata,array('onChange'=>"search_report(this);",'class'=>'form-control','style'=>'width: 250px;','options'=>array($selected=>array('selected'=>true))));
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
                echo CHtml::dropDownList('frm_search_branch','',$listdata,array('onChange'=>"search_cus(this);",'class'=>'form-control')); 
            ?>
        </div>

        <div class="form-group" style="margin-right:20px;">
                <label>Thời gian: </label>
              <?php 
                    
                    $listdata        = array();
                    $listdata['0']    = "Chọn thời gian";
                    $listdata['1']   = "Hôm nay";
                    $listdata['2']   = "Tuần này";
                    $listdata['3']   = "Tháng này";
                    
                    $listdata['5']   = "Tháng trước";
                    echo CHtml::dropDownList('frm_search_due_requester_date',3,$listdata,array('onChange'=>"search_date(this);",'class'=>'form-control'));
                    
                ?>
                <input style="display: none;" type="text" value="3" id="frm_search_requester_date" name="frm_search_received_date" onkeypress="runScript(event);" style="width: 160px;"/>
        </div>        

        <div class="form-group" style="margin-right:20px;">
            <label>Nhân viên: </label>
              <?php 
                $listdata     = array();
                $listdata[""] = "Tất cả";
                $User         = GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3));
                foreach($User as $temp){
                    $listdata[$temp['id']] =  $temp['name'];
                }
                echo CHtml::dropDownList('frm_search_user_id','',$listdata,array('onChange'=>"search_cus(this);",'class'=>'form-control')); 
            ?>
        </div> 
       <!--  <div class="form-group" style="margin-right:20px;">
                <label>Hình thức thanh toán: </label>
              <?php 
                    
                    $listdata        = array();
                    $listdata['']    = "Chọn hình thức thanh toán";
                    
                    echo CHtml::dropDownList('frm_search_hinh_thuc_thanh_toan',3,$listdata,array('onChange'=>"search_cus(this);",'class'=>'form-control'));
                    
                ?>
                <input style="display: none;" type="text" value="3" id="frm_search_requester_date" name="frm_search_received_date" onkeypress="runScript(event);" style="width: 160px;"/>
        </div>      
 -->
    </div>

    <div id="oSrchLeft" class="pull-right" style="text-align: right;">
        <!-- Split button -->
        <div class="btn-group">
          <button type="button" class="btn btn_bookoke" onclick="detailreportdate()"><i class="fa fa-search-plus"></i>&nbsp;Xem</button>
          <button type="button" class="btn btn_bookoke dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu menu-export">
            <li><a href="#" class="print"><i class="fa fa-print"></i>&nbsp;Print</a></li>
            <li><a href="#" class="btn_excel"><i class="fa fa-file-excel-o"></i>&nbsp;Excel</a></li>
            <li><a href="#" class="word"><i class="fa fa-file-word-o"></i>&nbsp;Word</a></li>
            <li><a href="#" class="pdf"><i class="fa fa-file-pdf-o"></i>&nbsp;PDF</a></li>
            <li><a href="#" class="csv"><i class="fa fa-file-o"></i>&nbsp;CSV</a></li>
          </ul>
        </div>
    </div>  

    <div class="clearfix"></div>
<div class="hide" id="date" style=" margin-top: 20px;">
    <div class="form-group" style="margin-right:20px;">  
        <label>Từ ngày: </label>&nbsp<input type="text" name="date_start" id="date_start" class="form-control" value="<?php echo date("01-m-Y", strtotime("first day of this month")); ?>" style="text-align:center;" />
    </div>
    <div class="form-group" style="margin-right:20px;">  
        <label>Đến ngày: </label>&nbsp<input type="text" name="date_end" id="date_end" class=" form-control" value="<?php echo date("t-m-Y", strtotime("last day of this month")); ?>" style="text-align:center;" />
    </div>
</div>
</form>


<script>
 function search_date(cur_page)
    {
            var time            = $("#frm_search_due_requester_date").val();
            if (time == 0) {
                    $('#date').removeClass('hide');
            }else{
                 $('#date').addClass('hide');
            }
          
    }
    function search_report(selectObject){

        var value = selectObject.value; 

        if (value == 0) 
            window.location.assign("<?php echo CController::createUrl('ReportingCustomer/View')?>");  
        else if(value == 1)
            window.location.assign("<?php echo CController::createUrl('ReportingCustomer/Date')?>"); 
        else if(value == 2)
            window.location.assign("<?php echo CController::createUrl('ReportingCustomer/Birthday')?>"); 
        else if(value == 3)
            window.location.assign("<?php echo CController::createUrl('ReportingCustomer/Spend')?>");
        else if(value == 4)
            window.location.assign("<?php echo CController::createUrl('ReportingCustomer/Service')?>"); 
        else if(value == 6)
            window.location.assign("<?php echo CController::createUrl('ReportingCustomer/Note')?>"); 

    }
    /*function search_cus(cur_page)
    {

        //var number          = $("#frm_search_number").val();
        var time            = $("#frm_search_due_requester_date").val();
        var id_user         = $("#frm_search_user_id").val();
        var location        = $("#frm_search_branch").val();
        
        $.ajax({   type:"POST",
                        url:"<?php echo CController::createUrl('ReportingCustomer/DetailReport')?>",
                        data:{
                            time        :  time,
                            id_user     :  id_user,
                            location    :  location,
                            
                        },
                        success:function(data){     

                            $('#return_content').html(data);
                            $('.cal-loading').fadeOut('slow');  
                           
                        },
                        error: function(data){
                        console.log("error");
                        console.log(data);
                        }
        });                
    }*/
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
    function detailreportdate(){     

    $('.cal-loading').fadeIn('fast');     
        var test = $("#frm_search_due_requester_date").val();
        if(test > 0){
            
             var date = "";
         }else{
            var date_start = $('#date_start').val();
            var date_end = $('#date_end').val();
            var date = date_start.concat("+",date_end);
         }
        var time            = $("#frm_search_due_requester_date").val();
        var id_user         = $("#frm_search_user_id").val();
        var location        = $("#frm_search_branch").val();

    $.ajax({
        type:'POST',
        url: "<?php echo CController::createUrl('ReportingCustomer/DetailReportdate')?>", 
        data: {             time        :  time,
                            id_user     :  id_user,
                            location    :  location,
                            date        : date,
                        },   
        success:function(data){     

            $('#return_content').html(data);
            $('.cal-loading').fadeOut('slow');  
           
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });  
  
}
$( document ).ready(function() {

    $('#oSrchBar').on('click','.print',function(e){
        var type            = $('#frm_search_type').val();
        var time            = $("#frm_search_due_requester_date").val();
        if(time == 0)
        {
            var date_start = $('#date_start').val();
            var date_end = $('#date_end').val();
           
        }
        else
        {
            var date_start = "";
            var date_end = "";
        }
        var id_user         = $("#frm_search_user_id").val();
        var location        = $("#frm_search_branch").val();
        var url="<?php echo CController::createUrl('ReportingCustomer/printreport')?>?type="+type+"&location="+location+"&id_user="+id_user+"&time="+time+"&date_start="+date_start+"&date_end="+date_end;
        
        window.open(url,'name');
       
    });
    $('#oSrchBar').on('click','.pdf',function(e){
        var type            = $('#frm_search_type').val();
        var time            = $("#frm_search_due_requester_date").val();
        if(time == 0)
        {
            var date_start = $('#date_start').val();
            var date_end = $('#date_end').val();
           
        }
        else
        {
            var date_start = "";
            var date_end = "";
        }
        var id_user         = $("#frm_search_user_id").val();
        var location        = $("#frm_search_branch").val();
         var url="<?php echo CController::createUrl('ReportingCustomer/Exportreport')?>?type="+type+"&location="+location+"&id_user="+id_user+"&time="+time+"&date_start="+date_start+"&date_end="+date_end;
        
        window.open(url,'name');
       
    });
 $('.btn_excel').click(function(){
      $('.table-hover').table2excel({
          name: "file",
          filename: "DanhSach",
          fileext: ".xls"
      });
      
       // var path = window.location.pathname;
       // alert(path);
   }); 
 $(function(){
            $(".csv").click(function(){
                $(".table-hover").tableToCSV(
                  );
            });
  });
   $('.word').click(function(){
      $('.table-hover').table2excel({
          name: "file",
          filename: "DanhSach",
          fileext: ".doc"
      });
   }); 
});
$(function() {
    $('input[name="date_start"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        
    autoApply: true,
        locale: {
            format: 'DD-MM-YYYY'
        }
    }, 
    function(start, end, label) {
        
       
    });
    $('input[name="date_end"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       
    autoApply: true,
        locale: {
            format: 'DD-MM-YYYY'
        }
    }, 
    function(start, end, label) {
        
       
    });
});
</script>