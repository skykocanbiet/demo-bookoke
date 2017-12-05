<?php  include_once('_js.php'); ?>
<style type="text/css">
#frm_search_user_id{
    height: 30px;
    font-size: 12px;
    width: 150px;
}
.titlesearch{
    font-size: 9pt;font-weight: bold;color: #333; 
}
.numberRowTotal {
    font-size: 30px;
    color: #fff; font-weight: bold;text-align: center;display: block;
}
.titleRowTotal{
    font-size: 20px;
    font-weight: normal;text-align: center;color: #fff;display: block;
}


@media screen and (min-width: 1366px) {
  .numberRowTotal {
    font-size: 40px;
  }
  .titleRowTotal{
    font-size: 23px;
  }
  .footer_chart{padding-top: 0px;}
}

@media screen and (min-width: 1600px) {
  .numberRowTotal{
    font-size: 47px;
  }
  .titleRowTotal{
     font-size: 30px;
  }
 /* .footer_chart{padding-top: 10px;}*/
}

</style>

<!-- VIEW DASHBOARD -->
<div id="body_dashboard">
        <?php 
    
            $group_no = Yii::app()->user->getState('group_no'); 
          
            $tongcot1 = round($data_info['target_new_account']);
            $usercot1 = $data_info['present_new_account'];

            $tongcot2 = round($data_info['target_appointment']);
            $usercot2 = round($data_info['present_schedule']);
            
            $tongcot3 = round($data_info['target_revenue']);
            $usercot3 = $data_info['present_revenue'];
            
            $tongcot4 = round($data_info['target_rerformance']);
            $usercot4 = $data_info['present_rerformance'];

            if($usercot1){
                if($tongcot1){
                    $phantram1 = round($usercot1/$tongcot1 *100,2);
                    if($phantram1 > 100){
                        $phantramtong1 = round($tongcot1/$usercot1 *100,2);
                        //$phantran1 = 100;
                    }
                    else{
                        $phantramtong1 = 100;
                    }
                }else{
                    $phantram1 = 0;
                    $phantramtong1 = 0;
                }
                
            }else{
                if($tongcot1){
                    $phantramtong1 = 100;
                }else{
                    $phantramtong1 = 0;
                }
                $phantram1 = 0;
            }
            
            if($usercot2){
                if($tongcot2){
                    $phantram2 = round($usercot2/$tongcot2 *100,2);
                    if($phantram2 > 100){
                        $phantramtong2 = round($tongcot2/$usercot2 *100,2);
                        //$phantram2 = 100;
                    }
                    else{
                        $phantramtong2 = 100;
                    }
                }else{
                    $phantram2 = 0;
                    $phantramtong2 = 0;
                }
                
            }else{
                if($tongcot2){
                    $phantramtong2 = 100;
                }else{
                    $phantramtong2 = 0;
                }
                $phantram2 = 0;
            }
            
            
            if($usercot3){
                if($tongcot3){
                    $phantram3 = round($usercot3/$tongcot3 *100,2);
                    if($phantram3 > 100){
                        $phantramtong3 = round($tongcot3/$usercot3 *100,2);
                        //$phantram3 = 100;
                    }
                    else{
                        $phantramtong3 = 100;
                    }
                }else{
                    $phantram3 = 0;
                    $phantramtong3 = 0;
                }
                
            }else{
                if($tongcot3){
                    $phantramtong3 = 100;
                }else{
                    $phantramtong3 = 0;
                }
                $phantram3 = 0;
            }
            
            if($usercot4){
                if($tongcot4){    
                    $phantram4 = round($usercot4/$tongcot4 *100,2);
                    if($phantram4 > 100){
                        $phantramtong4 = round($tongcot4/$usercot4 *100,2);
                        //$phantram4 = 100;
                    }
                    else{
                        $phantramtong4 = 100;
                    }
                }else{
                    $phantram4 = 0;
                    $phantramtong4 = 0;
                }
            }else{
                if($tongcot4){
                    $phantramtong4 = 100;
                }else{
                    $phantramtong4 = 0;
                }
                $phantram4 = 0;
            } 
        ?>
        <style>
            .chart {
                padding: 70px 35px 20px 20px;
                min-height: 400px;
                color: #5d5d5d;
            }
            .footer_chart {
                height: 20%;
                margin-top: 3px;
                text-align: center;
                border-radius: 3px;
            }
            .content_chart_one {
                float: left;
                padding-left: 2.5%;
                height: 100%;
                width: 25%;
            }
            .col_body_chart{
                width: 100%;
                height: 80%;
                display: inline-block;
            
                display: -webkit-inline-flex;
                display: -moz-inline-flex;
                display: inline-flex;
            
                -webkit-flex-flow: row nowrap;
                -moz-flex-flow: row nowrap;
                flex-flow: row nowrap;
            
                -webkit-align-items: flex-end;
                -moz-align-items: flex-end;
                align-items: flex-end;
            }
            .col_data{
                height: 100%;
                width: 100%;
                position: relative;
                
            }
            .col_number_data{
               width: 200%;
               height: 25px;
               text-align: center;
               position: absolute;
               top:-25px;
               right: -30px;
            }
            
            /*  Revenue */
            .revenue{
                 background-color:#a1d07e;
            }
            .present_revenue{
                background-color: #a1d07e;
                margin-left: 25%;
                height: <?php if($phantram1 > 100){echo "100";}else{echo $phantram1;} ?>%;
                width: 55px;
                vertical-align: bottom;
                
            }
            .target_revenue{
                background-color: #e1e1e1;
                margin-left: 10%;
                height: <?php echo $phantramtong1; ?>%;
                width: 55px;
                vertical-align: bottom;
            }
            
            /*  New Accounts */
            .new_accounts{
                 background-color:#8acdc3;
            }
            .present_new_accounts{
                background-color: #8acdc3;
                margin-left: 25%;
                height: <?php if($phantram2 > 100){echo "100";}else{echo $phantram2;} ?>%;
                width: 55px;
                vertical-align: bottom;
                
            }
            .target_new_accounts{
                background-color: #e1e1e1;
                margin-left: 10%;
                height: <?php echo $phantramtong2; ?>%;
                width: 55px;
                vertical-align: bottom;
            }
            
            /*  Sales Calls */
            .sales_calls{
                 background-color:#90a7cf;
            }
            .present_sales_calls{
                background-color: #90a7cf;
                margin-left: 25%;
                height: <?php if($phantram3 > 100){echo "100";}else{echo $phantram3;} ?>%;
                width: 55px;
                vertical-align: bottom;
                
            }
            .target_sales_calls{
                background-color: #e1e1e1;
                margin-left: 10%;
                height: <?php echo $phantramtong3; ?>%;
                width: 55px;
                vertical-align: bottom;
            }
            
            /*  Complaints */
            .complaints{
                 background-color:#eacc78;
            }
            .present_complaints{
                background-color:#eacc78;
                margin-left: 25%;
                height: <?php if($phantram4 > 100){echo "100";}else{echo $phantram4;} ?>%;
                width: 55px;
                vertical-align: bottom;
                
            }
            .target_complaints{
                background-color: #e1e1e1;
                margin-left: 10%;
                height: <?php echo $phantramtong4; ?>%;
                width: 55px;
                vertical-align: bottom;
            }
        </style>
        <div class="content">
            <div class="chart" style="height: 680px;">

                <!-- REVENUE -->
                <div class="content_chart_one">
                    <div class="col_body_chart">
                        <div class="col_data present_revenue">
                            <div class="col_number_data">
                                <?php echo $phantram1."%";?>
                            </div>
                        </div>
                        <div class="col_data target_revenue">
                            <div class="col_number_data">
                                <?php echo number_format($tongcot1);?>
                            </div>
                        </div>
                    </div>
                    <div class="footer_chart revenue">
                        <span class="numberRowTotal"><?php echo number_format($usercot1);?></span>
                        <span class="titleRowTotal">Khách mới</span>
                    </div>
                </div>
                
                <!-- NEW ACCOUNT -->
                <div class="content_chart_one">
                    <div class="col_body_chart">
                        <div class="col_data present_new_accounts">
                            <div class="col_number_data">
                                <?php echo $phantram2."%";?>
                            </div>
                        </div>
                        <div class="col_data target_new_accounts">
                            <div class="col_number_data">
                                <?php echo number_format($tongcot2);?>
                            </div>
                        </div>
                    </div>
                    <div class="footer_chart new_accounts">
                        <span class="numberRowTotal"><?php echo number_format($usercot2);?></span>
                        <span class="titleRowTotal">Lịch hẹn</span>
                    </div>
                </div>
               
                <div class="content_chart_one">
                    <div class="col_body_chart">
                        <div class="col_data present_sales_calls">
                            <div class="col_number_data">
                                <?php echo $phantram3."%";?>
                            </div>
                        </div>
                        <div class="col_data target_sales_calls">
                            <div class="col_number_data">
                                <?php echo number_format($tongcot3);?>
                            </div>
                        </div>
                    </div>
                    <div class="footer_chart sales_calls">
                        <span  class="numberRowTotal"><?php echo number_format($usercot3);?></span>
                        <span class="titleRowTotal">Doanh thu</span>
                    </div>
                </div>
                
                <!-- SALES ORDER -->
                <div class="content_chart_one">
                    <div class="col_body_chart">
                        <div class="col_data present_complaints">
                            <div class="col_number_data">
                                <?php echo $phantram4."%";?>
                            </div>
                        </div>
                        <div class="col_data target_complaints">
                            <div class="col_number_data">
                                <?php echo number_format($tongcot4);?> '
                            </div>
                        </div>
                    </div>
                    <div class="footer_chart complaints">
                        <span class="numberRowTotal"><?php echo number_format($usercot4);?> '</h1>
                        <span class="titleRowTotal">Hiệu suất</span>
                    </div>
                </div>
                <div class="clearfix"></div>


            </div>
        </div>
</div>
<!-- END DASHBOARD -->

<!-- VIEW SEARCH DASHBOARD -->
<div id="dashboard_sales" style="margin-top: 10px;margin-left: 20px;">

    <div style="font-weight: bold;margin-left: 5%;">

    <div style="float: left; line-height: 35px;">
            <span class="titlesearch">Văn phòng :</span>
            <span style="display: inline-block;">  
              <?php 
                    $listdata     = array();
                    $listdata[''] = "Tất cả";
                    $branch         = Branch::model()->findAllByAttributes(array('status'=>1));
                    foreach($branch as $temp){
                        $listdata[$temp['id']] =  $temp['name'];
                    }
                    echo CHtml::dropDownList('frm_search_branch_id','',$listdata,array('class'=>'form-control','onChange'=>'changeBranch()')); 
                ?>
               
            </span>
        </div>

        <div style="float: left; line-height: 35px;margin-left: 35px;">
            <span class="titlesearch">Nhân sự :</span>
            <span id="lstStaff" style="display: inline-block;">  
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

        <div style="float: left;line-height: 35px;margin-left: 100px;">
            <span><input type="radio" checked="" id="id_daily" name="dashboard" value="today"/></span>
            <span>
                <span class="titlesearch">Hôm nay: </span>
                <input size="10" type="text" id="id_today" value="<?php echo date('d/m/Y')?>" readonly="" style="border: none;color: #808080;font-weight: bold;width: 105px;height: 27px;text-align: center;border-radius: 3px;" />
            </span>
        </div>

        <div style=" float: left;line-height: 35px;margin-left: 35px;">
            <input type="radio" id="id_weekly" name="dashboard" value="week"/>
            <span class="titlesearch">Tuần: </span>
            <input  id="id_week" size="7" value="<?php echo date("d")?>" type="text" readonly="" style="border: none;color: #808080;font-weight: bold;width: 27px;height: 27px;text-align: center;border-radius: 3px;" />
        </div>

        <div style="float: left;line-height: 35px;margin-left: 35px;">
            <input type="radio" id="id_monthly" name="dashboard" value="month"/>
            <span class="titlesearch">Tháng :</span> 
            <input id="id_month" size="7" value="<?php echo date("m")?>" type="text" readonly="" style="border: none;color: #808080;font-weight: bold; width: 27px;height: 27px;text-align: center;border-radius: 3px;" /> 
            <span class="titlesearch">Năm :</span>
            <input  id="id_year" size="7" value="<?php echo date("Y")?>" type="text" readonly="" style="border: none;color: #808080;font-weight: bold;width: 60px;height: 27px;text-align: center;border-radius: 3px;" />                    
        </div>
        <div class="clearfix"></div>
    </div>

    <div style="display: none;" >
        <input id="box_search_date_from" value="<?php echo date('Y-m-d'); ?>" type="text"  />
        <input id="box_search_date_to" value="<?php echo date('Y-m-d') ?>" type="text" />
        <input id="box_search_date_type" value="today" type="text" />
    </div>

 <!--    <div style="position: absolute;right: 25px; display: none;">
        <button style="position: absolute;right: -10px;top: 0px;" onclick="LeadSearchDashboard();" class="button_save">FILTER </button>
    </div> -->

</div>
<!-- END SEARCH DASHBOARD -->
<script type="text/javascript">
    
// $(function(){
//     // Change period
//     $('input:radio[name=dashboard]').click(function() { 
//         var period = $(this).val();
//         var today = new Date();

//         var dd = today.getDate();
//         var dd_from = dd; 
//         var dd_to = dd; 
        
//         var mm = today.getMonth()+1;
//         var mm_from = mm; 
//         var mm_to = mm; 
        
//         var yyyy = today.getFullYear();
//         var yyyy_from = yyyy; 
//         var yyyy_to = yyyy; 
        
//         var day_from; 
//         var day_to;
        
//         var d = new Date(yyyy, mm, 0); 
//         var n = today.getDay(); //3
//         var beforeOneWeek = new Date(new Date().getTime() - 60 * 60 * 24 * 7 * 1000);
        
//         switch(period) {
//             //This week
//             case 'week':
//                 if(dd <= n){
//                     dd_from = beforeOneWeek.getDate() - n + 7 + 1;
//                     mm_from = mm_from - 1;
//                 }else if((dd - n + 6) > d.getDate()){
//                     dd_from = dd - n + 1;
//                 }else{
//                     dd_from = dd - n;
//                 }
//                 break;
//             case 'month':
//                 dd_from = 1;
//                 break;
//             default:
//                 break;
//         }
//         if(dd_from < 10) { dd_from = '0' + dd_from;}
//         if(dd_to < 10) { dd_to = '0' + dd_to;}
//         if(mm_from < 10) { mm_from = '0' + mm_from;}
//         if(mm_to < 10) { mm_to = '0' + mm_to;}
//         day_from = yyyy_from + '-' + mm_from + '-' + dd_from ;
//         day_to = yyyy_to + '-' + mm_to + '-' + dd_to;
        
//         $('#box_search_date_type').val(period);
//         $('#box_search_date_from').val(day_from);
//         $('#box_search_date_to').val(day_to);
//         console.log(period);
//         console.log(day_from);
//         console.log(day_to);
        
//     });

// });
$(function(){
    // click period
    $('input:radio[name=dashboard]').click(function() { 
     var dateap = $(this).val();
      jQuery.ajax({   
            type:"POST",
            url:"<?php echo CController::createUrl('DashBoardBusiness/GetTime')?>",
            data:{
                'time' :  dateap,
           },
            success:function(string){
                var getData = $.parseJSON(string);
                if (getData) {
                    $('#box_search_date_from').val(getData.fromdate);
                    $('#box_search_date_to').val(getData.todate);
                    $('#box_search_date_type').val(dateap);
                    console.log(getData.fromdate);
                    console.log(getData.todate);
                    console.log(dateap);
                }
                SearchDashboard();
            }
        });

   });
   
});
function changeBranch()
{
    var dataBranch =  $("#frm_search_branch_id").val();
    jQuery.ajax({   
        type:"POST",
        url:"<?php echo CController::createUrl('DashBoardBusiness/ChangeBranch')?>",
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
function SearchDashboard(id){
    var from_day    =   $('#box_search_date_from').val();
    var to_day      =   $('#box_search_date_to').val();
    var date_type   =   $('#box_search_date_type').val();
    if(id){
        $('#id_user_manager').val(id);
        $('.id_row_customer').removeClass('active_row');
        $('#id_row_info'+id).addClass('active_row');
    }
    var id_user     =   $('#frm_search_user_id').val();
    var id_branch   = $('#frm_search_branch_id').val();
    if(id_user && id_user ==  'Undefined')
    {
        return false;
    }
    
    
    if(from_day && to_day){
        jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl('DashBoardBusiness/SearchDashboard')?>",
                    data:{
                                id_user            :  id_user,
                                id_branch          : id_branch,
                                from_day           :  from_day,
                                to_day             :  to_day,
                                date_type          :  date_type,
                    },
                    beforeSend: function() {
                        $('.cal-loading').fadeIn('fast');
                    },
                    success:function(data){
                        if(data!='-1'){
                             //console.log(data);
                             //return;
                           $('.cal-loading').fadeOut('fast');
                            jQuery("#body_dashboard").show().html(data);
                        }
                    },
                    error: function(data){ 
                        $('#idwaiting_main').html('');
                        alert("Error occured.Please try again!");
                    },
    
        }); 
    } 
}

$("#frm_search_user_id").change(function(){
    SearchDashboard();
});
$("#frm_search_branch_id").change(function(){
    SearchDashboard();
});

<?php
//if($group_no=="admin" ||$group_no=="superadmin" ||$group_no=="manager")
//{
?>
// $('#dashboard_sales input[type=radio]').change(function(){
//     SearchDashboard();
//     //GetListPerfozmance();
// });

/*$('#performance_dashboard input[type=radio]').change(function(){
    GetListPerfozmance();
});*/
<?php 
//}else {
 ?>
// $('#dashboard_sales input[type=radio]').change(function(){
//     SearchDashboard();
// });
<?php 
//} 
?> 

</script>