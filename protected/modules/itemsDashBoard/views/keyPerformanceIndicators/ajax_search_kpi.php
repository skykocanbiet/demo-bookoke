<style>
.title_kpi{
    background-color: #8B71A7;
    text-align: center;
}
.title_kpi h3{
    color: #fff !important;
    padding: 14px 16px;
    font-size: 15px;
}
.label-kpi{
    border: none;
    background-color: #F2F2F2;
    line-height: 30px;
    color: #000;
    font-size: 13px;
    text-align: center;
}
#kpi_info_row{
    line-height: 40px;
    color: #333;  
}
#kpi_info_row .measures{
     text-indent: 15px;
     font-size: 13px;
}
#kpi_info_row .current{
     text-align: center;
     font-size: 13px;
}
#kpi_info_row .target{
     text-align: center;
     font-size: 13px;
}
#kpi_info_row .variance{
     text-align: center;
     font-size: 14px;
}
#kpi_info_row .trend{
     text-align: center;
     font-size: 13px;
}
.row_info_key_acctivities{
    position: relative;
    background-color: #F2F2F2;
    width: 94%;
    float: right;
    margin: 30px 0px 0px 0px;
    font-size: 14px;
    color: #333;
    cursor: pointer;
}
.round-key-acctivities{
    position: absolute;
    top: -10px;
    left: -17px;
    width: 60px;
    color: #000;
    border-radius: 50% 50%;
    height: 60px;
    background: #fff;
}
.round-key-acctivities .round-center-key-acctivities{
    position: absolute;
    top: 7px;
    left: 7px;
    width: 45px;
    color: #000;
    border-radius: 50% 50%;
    height: 45px;
    color: #fff;
    line-height: 44px;
    text-align: center;
    font-size: 15px;
}
.color-key-acctivities{
    position: absolute;
    top: 0px;
    left: -5px;
    width: 15px;
    display: none;
}
</style>
<?php 
    $tongcot1 = $data_info['target_revenue'];
    $usercot1 = $data_info['present_revenue'];
    
    $tongcot2 = round($data_info['target_new_account']);
    
    if($tongcot2 < 0.5){
        $tongcot2 = 1;
    }
    
    $usercot2 = $data_info['present_new_account'];
    
    $tongcot3 = $data_info['target_call'];
    $usercot3 = $data_info['present_calls'];

    
    if($usercot1){
        $phantram1 = round($usercot1/$tongcot1 *100);
    }else{
        $phantram1 = 0;
    }
    
    if($usercot2){
        $phantram2 = round($usercot2/$tongcot2 *100);
    }else{
        $phantram2 = 0;
    }
    
    if($usercot3){
        $phantram3 = round($usercot3/$tongcot3 *100);
    }else{
        $phantram3 = 0;
    }
    
    
    if($month == date('m') ){
        if(isset($now_target) && $now_target){
            if($tongcot1){
                $now_target1 = round(($tongcot1/$toal_day_in_month)*$now_target);
                $p1   = round($usercot1/$now_target1 *100);
            }
            
            if($tongcot2){
                $now_target2 = round(($tongcot2/$toal_day_in_month)*$now_target);
                $p2   = round($usercot2/$now_target2 *100);
            }
            
            if($tongcot3){
                $now_target3 = round(($tongcot3/$toal_day_in_month)*$now_target);
                $p3   = round($usercot3/$now_target3 *100);
            }
            
        }    
    }else{
        $p1 = $phantram1;
        $p2 = $phantram2;
        $p3 = $phantram3;
    }
    include_once('datapresenttrend.php');
//print_r($presentday);
//print_r($data_info);
//print_r($toal_day_in_month) ;
//print_r($now_target);
//exit;    
?>
<!-- Chart -->
          
<div id="keyperformanceindicators" style="margin-top: 20px;">
    <div class="group-kpi">
        <div class="title_kpi">
            <h3>Key Performance Indicators (KPIs)</h3>
        </div>
        <div class="content_kpi">
            <table>
                <tr>
                    <th class="label-kpi" style="width: 25%;text-indent: 35px;text-align: left;">Measures</th>
                    <th class="label-kpi" style="width: 15%;">Current</th> 
                    <th class="label-kpi" style="width: 15%;">Target</th>
                    <th class="label-kpi" style="width: 15%;">Variance</th>
                    <th class="label-kpi" style="width: 30%;">Trend</th>
                </tr>
                <tr id="kpi_info_row">
                    <td class="measures" style="padding-top: 20px;">Gia tăng doanh thu bán hàng.</td>
                    <td class="current" style="padding-top: 20px;">$<?php echo number_format($usercot1);?></td>
                    <td class="target" style="padding-top: 20px;">$<?php echo number_format($tongcot1);?></td>
                    <td class="variance" style="padding-top: 20px;">
                        <span style="display: inline-block;min-width: 75px;color: #fff;background-color: <?php if(isset($p1)){ if($p1 >= 80){ echo "#63bb4a";} elseif($p1 >= 50){ echo "#FFDA3B";}else{ echo "#ee432e";} } ?> ;"><?php echo $phantram1."%";?></span>
                    </td>
                    <td class="trend" style="padding-top: 20px;">
                        <?php if($presentday['revenue'] && is_array($presentday['revenue'])) { ?>
                        	<svg id = "revenue"></svg>
                            <script>
                                var revenue = document.getElementById('revenue');
                                var color = '<?php if($p1 >= 80){ echo "green";} elseif($p1 >= 50){ echo "yellow";}else{ echo "red";}  ?>';
                                revenue.setAttribute("width",0.15*window.innerWidth);
                                revenue.setAttribute("height",0.05*window.innerHeight);
                                
                                plot1 = new clevorne(revenue, datarevenue, 1, 2, color); //use the 2nd and 3rd columns as x and y respectively for the second plot.
                                //plot1.placeGrid([1,5,10,15,20,25,30],[1,15,30,45,65,85,100]);  //place a grid for the plot
                                plot1.colourBy(0); //colour by the first column of the data
                                plot1.groupBy(0); //group by the first column of the data
                                plot1.drawLines(); //draw line graphs 
                            </script>
                         <?php } ?>   
                    </td>
                </tr>
                <tr id="kpi_info_row">
                    <td class="measures">Phát triển khách hàng mới.</td>
                    <td class="current"><?php echo number_format($usercot2);?></td>
                    <td class="target"><?php echo number_format($tongcot2);?></td>
                    <td class="variance">
                        <span style="display: inline-block;min-width: 75px;color: #fff;background-color: <?php if($p2 >= 80){ echo "#63bb4a";} elseif($p2 >= 50){ echo "#FFDA3B";}else{ echo "#ee432e";}  ?>;"><?php echo $phantram2."%";?></span>
                    </td>
                    <td class="trend">
                        <?php if($presentday['newaccount'] && is_array($presentday['newaccount'])) { ?>
                            <svg id = "accounts"></svg>
                            <script>
                                var accounts = document.getElementById('accounts');
                                var color = '<?php if(isset($p2)){ if($p2 >= 80){ echo "green";} elseif($p2 >= 50){ echo "yellow";}else{ echo "red";} } ?>';
                                accounts.setAttribute("width",0.15*window.innerWidth);
                                accounts.setAttribute("height",0.05*window.innerHeight);
                                
                                plot2 = new clevorne(accounts, dataaccounts, 1, 2, color); //use the 2nd and 3rd columns as x and y respectively for the second plot.
                                //plot2.placeGrid([1,5,10,15,20,25,30],[1,15,30,45,65,85,100]); //place a grid for the plot
                                plot2.colourBy(0); //colour by the first column of the data
                                plot2.groupBy(0); //group by the first column of the data
                                plot2.drawLines(); //draw line graphs 
                            </script>
                        <?php } ?>
                    </td>
                </tr>
                <tr id="kpi_info_row">
                    <td class="measures" style="padding-bottom: 20px;">Số lần liên lạc với Khách hàng.</td>
                    <td class="current" style="padding-bottom: 20px;"><?php echo number_format($usercot3);?></td>
                    <td class="target" style="padding-bottom: 20px;"><?php echo number_format($tongcot3);?></td>
                    <td class="variance" style="padding-bottom: 20px;">
                        <span style="display: inline-block;min-width: 75px;color: #fff;background-color: <?php if(isset($p3)){ if($p3 >= 80){ echo "#63bb4a";} elseif($p3 >= 50){ echo "#FFDA3B";}else{ echo "#ee432e";} } ?>;"><?php echo $phantram3."%";?></span>
                    </td>
                    <td class="trend" style="padding-bottom: 20px;">
                        <?php if($presentday['callsale'] && is_array($presentday['callsale'])) { ?>
                            <svg id = "salecalls"></svg>
                            <script>
                                var salecalls = document.getElementById('salecalls');
                                var color = '<?php if(isset($p3)){ if($p3 >= 80){ echo "green";} elseif($p3 >= 50){ echo "yellow";}else{ echo "red";} }  ?>';
                                salecalls.setAttribute("width",0.15*window.innerWidth);
                                salecalls.setAttribute("height",0.05*window.innerHeight);
                                
                                plot3 = new clevorne(salecalls, datasalecalls, 1, 2, color); //use the 2nd and 3rd columns as x and y respectively for the second plot.
                                //plot3.placeGrid([1,5,10,15,20,25,30],[1,15,30,45,65,85,100]); //place a grid for the plot
                                plot3.colourBy(0); //colour by the first column of the data
                                plot3.groupBy(0); //group by the first column of the data
                                plot3.drawLines(); //draw line graphs 
                            </script>
                        <?php } ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="group-kpi">
        <div class="title_kpi">
            <h3>Key Activities</h3>
        </div>
        <div id="return_content_key_activities" class="content_kpi" style="padding-right: 30px;">
            <?php include_once('view_key_activities_kpi.php'); ?>
        </div>
    </div>
    <div class="group-kpi">
        <div class="title_kpi">
            <h3>Notes</h3>
        </div>
        <div class="content_kpi" style="height: 150px;">
            <div style="padding: 30px 52px;font-size: 14px;">
                <p style="color: #333;margin-bottom: 20px;" >
                    Nhân viên bán hàng cần biết chủ động phân chia thời gian và nguồn lực thực hiện công việc theo tỷ trong phân bổ để có kết quả tốt có gắn kết với các chỉ tiêu kinh doanh.
                </p>
                <p style="color: #333;">
                    Tập trung thực hiện nhất quán các công việc cộng với việc tự trau dồi để nâng cao kỹ năng cá nhân sẽ dẫn đến khả năng hoàn thành các chỉ tiêu cao nhất.
                </p>
            </div>
        </div>
    </div>
</div>


