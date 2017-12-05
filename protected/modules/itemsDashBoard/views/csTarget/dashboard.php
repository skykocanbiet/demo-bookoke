<!-- Chart -->
<?php 

    $tongcot1 = $data_info['target_revenue'];
    $usercot1 = $data_info['present_revenue'];
    
    $tongcot2 = $data_info['target_new_account'];
    $usercot2 = $data_info['present_new_account'];
    
    $tongcot3 = $data_info['target_call'];
    $usercot3 = $data_info['present_calls'];
    
    $tongcot4 = $data_info['target_order'];
    $usercot4 = $data_info['present_order'];
    
    $tickets  = $data_info['present_tickets'];
    
    if($usercot1){
        $phantram1 = round($usercot1/$tongcot1 *100,2);
        if($phantram1 > 100){
        	$phantramtong1 = round($tongcot1/$usercot1 *100,2);
        	//$phantran1 = 100;
        }
        else{
        	$phantramtong1 = 100;
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

        $phantram2 = round($usercot2/$tongcot2 *100,2);
        
        if($phantram2 > 100){
        	$phantramtong2 = round($tongcot2/$usercot2 *100,2);
        	//$phantram2 = 100;
        }
        else{
        	$phantramtong2 = 100;
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
        $phantram3 = round($usercot3/$tongcot3 *100,2);
        if($phantram3 > 100){
        	$phantramtong3 = round($tongcot3/$usercot3 *100,2);
        	//$phantram3 = 100;
        }
        else{
        	$phantramtong3 = 100;
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
        $phantram4 = round($usercot4/$tongcot4 *100,2);
        if($phantram4 > 100){
        	$phantramtong4 = round($tongcot4/$usercot4 *100,2);
        }
        else{
        	$phantramtong4 = 100;
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
        border: 1px solid #CCC;
        box-shadow: 1px 1px 4px 0px #DDD6D6;
        position: relative;
        
    }
    .col_number_data{
       width: 200%;
       height: 25px;
       text-align: center;
       position: absolute;
       top:-25px;
       right: -20px;
    }
    
    /*  Revenue */
    .revenue{
         background-color:#46BDDD;
    }
    .present_revenue{
        background-color: #46bddd;
    	margin-left: 25%;
    	height: <?php if($phantram1 > 100){echo "100";}else{echo $phantram1;} ?>%;
    	width: 41.2px;
        vertical-align: bottom;
        
    }
    .target_revenue{
        background-color: #CCC;
    	margin-left: 10%;
    	height: <?php echo $phantramtong1; ?>%;
    	width: 41.2px;
    	vertical-align: bottom;
    }
    
    /*  New Accounts */
    .new_accounts{
         background-color:#8DC641;
    }
    .present_new_accounts{
        background-color: #8DC641;
    	margin-left: 25%;
    	height: <?php if($phantram2 > 100){echo "100";}else{echo $phantram2;} ?>%;
    	width: 41.2px;
        vertical-align: bottom;
        
    }
    .target_new_accounts{
        background-color: #CCC;
    	margin-left: 10%;
    	height: <?php echo $phantramtong2; ?>%;
    	width: 41.2px;
    	vertical-align: bottom;
    }
    
    /*  Sales Calls */
    .sales_calls{
         background-color:#FFDA3B;#
    }
    .present_sales_calls{
        background-color: #FFDA3B;
    	margin-left: 25%;
    	height: <?php if($phantram3 > 100){echo "100";}else{echo $phantram3;} ?>%;
    	width: 41.2px;
        vertical-align: bottom;
        
    }
    .target_sales_calls{
        background-color: #CCC;
    	margin-left: 10%;
    	height: <?php echo $phantramtong3; ?>%;
    	width: 41.2px;
    	vertical-align: bottom;
    }
    
    /*  Complaints */
    .complaints{
         background-color:#AD86BD;
    }
    .present_complaints{
        background-color: #AD86BD;
    	margin-left: 25%;
    	height: <?php if($phantram4 > 100){echo "100";}else{echo $phantram4;} ?>%;
    	width: 41.2px;
        vertical-align: bottom;
        
    }
    .target_complaints{
        background-color: #CCC;
    	margin-left: 10%;
    	height: <?php echo $phantramtong4; ?>%;
    	width: 41.2px;
    	vertical-align: bottom;
    }
    
    <?php if(isset($now_target) && $now_target < 28 ){
        if($tongcot1){
            $now_target1 = round(($tongcot1/$toal_day_in_month)*$now_target);
            $p1          = round($now_target1/$tongcot1 *100,2);
        }
        
        if($tongcot2){
            $now_target2 = round(($tongcot2/$toal_day_in_month)*$now_target);
            $p2          = round($now_target2/$tongcot2 *100,2);
        }
        
        if($tongcot3){
            $now_target3 = round(($tongcot3/$toal_day_in_month)*$now_target);
            $p3          = round($now_target3/$tongcot3 *100,2);
        }
        
        if($tongcot4){
            $now_target4 = round(($tongcot4/$toal_day_in_month)*$now_target);
            $p4         = round($now_target4/$tongcot4 *100,2);
        }
        
    ?>
    .now_target_revenue{
        position: absolute;
        width: 41.2px;
        height:1px;
        bottom: <?php if($p1){echo $p1;}?>%;
        left: -1px;
        display: inline-block !important;
    }
    .now_target_revenue .label{
        background-color: #46BDDD;
        position: absolute;
        left: 3px;
        top: -16px;
        text-shadow:none !important;
        z-index: 1
    }
    
    .now_target_new_accounts{
        position: absolute;
        width: 41.2px;
        height:1px;
        bottom: <?php if($p2){echo $p2;}?>%;
        left: -1px;
        display: inline-block !important;
    }
    .now_target_new_accounts .label{
        background-color:#8DC641;
        position: absolute;
        left: 3px;
        top: -16px;
        text-shadow:none !important;
        z-index: 1
    }
    
    .now_target_sales_calls{
        position: absolute;
        width: 41.2px;
        height:1px;
        bottom: <?php if($p3){echo $p3;}?>%;
        left: -1px;
        display: inline-block !important;
    }
    .now_target_sales_calls .label{
        background-color:#FFDA3B;
        position: absolute;
        left: 3px;
        top: -16px;
        text-shadow:none !important;
        z-index: 1
        
    }
    
    .now_target_sales_orders{
        position: absolute;
        width: 41.2px;
        height:1px;
        bottom: <?php if($p4){echo $p4;}?>%;
        left: -1px;
        display: inline-block !important;
    }
    .now_target_sales_orders .label{
        background-color:#AD86BD;
        position: absolute;
        left: 3px;
        top: -16px;
        text-shadow:none !important;
        z-index: 1
        
    }
    <?php } ?>
</style>
<div class="content">
	<div class="chart">
		<div class="content_chart_one">
			<div class="col_body_chart">
				<div class="col_data present_revenue">
                    <div class="col_number_data">
						<?php echo round($phantram1,2)."%";?>
                        
					</div>
				</div>
				<div class="col_data target_revenue">
                    <div class="col_number_data">
						<?php echo round($tongcot1,2);?>
					</div>
                    <?php if(isset($now_target1) && $now_target1 && $tongcot1 ){ ?>
                    <div class="now_target_revenue" style="display: none;">
                        <span style="font-size: 10px;position: absolute;top: -4px;left: -3px;color: #46BDDD;z-index: 2;"><i class="fa fa-circle"></i></span>
                        <span style="font-size: 5px;position: absolute;top: 0px;left: -1px;color: #fff;z-index: 2"><i class="fa fa-circle"></i></span>
                        <span class="label"><?php echo $now_target1,2;  ?></span>
                    </div>
                    <?php } ?>
				</div>
			</div>
			<div class="footer_chart revenue">
				<h1 style="font-size: 27px; padding-bottom: 10px; margin-bottom: 0px; padding-top: 10px;"><?php echo number_format($usercot1);?></h1>
				<h3>Revenue</h3>
			</div>
		</div>
        
        <div class="content_chart_one">
			<div class="col_body_chart">
				<div class="col_data present_new_accounts">
                    <div class="col_number_data">
						<?php echo round($phantram2,2)."%";?>
					</div>
				</div>
				<div class="col_data target_new_accounts">
                    <div class="col_number_data">
						<?php echo round($tongcot2,2);?>
					</div>
                    <?php if(isset($now_target2) && $now_target2 && $tongcot2 ){ ?>
                    <div class="now_target_new_accounts" style="display: none;">
                        <span style="font-size: 10px;position: absolute;top: -4px;left: -3px;color: #8DC641;z-index: 2"><i class="fa fa-circle"></i></span>
                        <span style="font-size: 5px;position: absolute;top: 0px;left: -1px;color: #fff;z-index: 2"><i class="fa fa-circle"></i></span>
                        <span class="label"><?php echo $now_target2;  ?></span>
                    </div>
                    <?php } ?>
				</div>
			</div>
			<div class="footer_chart new_accounts">
				<h1 style="font-size: 27px; padding-bottom: 10px; margin-bottom: 0px; padding-top: 10px;"><?php echo number_format($usercot2);?></h1>
				<h3>New accounts</h3>
			</div>
		</div>
       
        <div class="content_chart_one">
			<div class="col_body_chart">
				<div class="col_data present_sales_calls">
                    <div class="col_number_data">
						<?php echo number_format($phantram3,2)."%";?>
					</div>
				</div>
				<div class="col_data target_sales_calls">
                    <div class="col_number_data">
						<?php echo number_format($tongcot3,2);?>
					</div>
                    <?php if(isset($now_target3) && $now_target3 && $tongcot3 ){ ?>
                    <div class="now_target_sales_calls" style="display: none;">
                        <span style="font-size: 10px;position: absolute;top: -4px;left: -3px;color: #FFDA3B;z-index: 2"><i class="fa fa-circle"></i></span>
                        <span style="font-size: 5px;position: absolute;top: 0px;left: -1px;color: #fff;z-index: 2"><i class="fa fa-circle"></i></span>
                        <span class="label"><?php echo $now_target3;  ?></span>
                    </div>
                    <?php } ?>
				</div>
			</div>
			<div class="footer_chart sales_calls">
				<h1 style="font-size: 27px; padding-bottom: 10px; margin-bottom: 0px; padding-top: 10px;"><?php echo number_format($usercot3);?></h1>
				<h3>Sale calls</h3>
			</div>
		</div>
        
        
        <div class="content_chart_one">
			<div class="col_body_chart">
				<div class="col_data present_complaints">
                    <div class="col_number_data">
                    <?php echo round($phantram4,2)."%";?>
					</div>
				</div>
				<div class="col_data target_complaints">
                    <div class="col_number_data">
						<?php echo number_format($tongcot4,2); ?>
					</div>
                    <?php if(isset($now_target4) && $now_target4 && $tongcot4 ){ ?>
                    <div class="now_target_sales_orders" style="display: none;">
                        <span style="font-size: 10px;position: absolute;top: -4px;left: -3px;color: #AD86BD;z-index: 2"><i class="fa fa-circle"></i></span>
                        <span style="font-size: 5px;position: absolute;top: 0px;left: -1px;color: #fff;z-index: 2"><i class="fa fa-circle"></i></span>
                        <span class="label"><?php echo $now_target4;  ?></span>
                    </div>
                    <?php } ?>
				</div>
			</div>
			<div class="footer_chart complaints">
				<h1 style="font-size: 27px; padding-bottom: 10px; margin-bottom: 0px; padding-top: 10px;"><?php echo number_format($usercot4);?></h1>
				<h3>Sale orders</h3>
			</div>
		</div>
        <div class="clearfix"></div>
	</div>
</div>

