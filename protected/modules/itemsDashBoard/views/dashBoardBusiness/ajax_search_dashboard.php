<?php 
    
            $group_no = Yii::app()->user->getState('group_no');
          
            $tongcot1 = round($data_info['target_new_account']);
            $usercot1 = $data_info['present_new_account'];

            $tongcot2 = $data_info['target_appointment'];
            $usercot2 = $data_info['present_schedule'];
            
            $tongcot3 = $data_info['target_revenue'];
            $usercot3 = $data_info['present_revenue'];
            
            $tongcot4 = $data_info['target_rerformance'];
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