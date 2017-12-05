<?php      
    $date_current = strtotime(date("Y-m-d"));
    $schedule = $model->checkSchedule($temp['id']); 
    if(count($schedule) && $schedule)
    {
    ?>
        <a class="icon stage_deal"  data-toggle="popover" data-placement="bottom" data-popover-content="#activity<?php echo $temp['id'];?>">
            <i class="fa fa-chevron-circle-right 
            <?php 
            $newDate        = date("Y-m-d",strtotime($schedule[0]['datetime_schedule']));
            $newTime        = $schedule[0]['time_schedule'];
            if( (strtotime($newDate) == strtotime(date("Y-m-d")) && $newTime == "") || (strtotime($newDate) == strtotime(date("Y-m-d")) && strtotime($newTime) >= strtotime(date("H:i:s"))) ){ 
                echo 'icon_to_date'; 
            }elseif( (strtotime($newDate) < strtotime(date("Y-m-d"))) || (strtotime($newDate) == strtotime(date("Y-m-d")) && strtotime($newTime) < strtotime(date("H:i:s"))) ){ 
                echo 'icon_out_of_date'; 
            }else{ 
                echo 'icon_furture_date';
            } 
            ?>">
            </i>
        </a>
        <div class="hiden" id="activity<?php echo $temp['id'];?>">
            <div class="popover-body">
                <ul class="DealActivity">
                
                <?php    
                $k_p = 0;              
                foreach( $schedule as $k =>$value)
                {
                    $datetime_schedule    = strtotime(date("Y-m-d",strtotime($value['datetime_schedule']))) ;
                    if( ($datetime_schedule > $date_current) || ($datetime_schedule == $date_current && strtotime($value['time_schedule']) >= strtotime(date("H:i:s"))) || ($datetime_schedule == $date_current && $value['time_schedule'] == "") )
                    { 
                   
                    }
                    else
                    { 
                    $k_p++;
                    if($k_p == 1)
                    { 
                    ?> 
                    <li style="border-radius: 4px 4px 0 0;background-color: #f7f7f7;font-size: 12px;line-height: 25px;padding: 4px 18px;text-align: left;color: #e84646;border-bottom:1px solid #e0e4e7;">
                        OVERDUE () 
                    </li>
                    <?php 
                    } 
                    ?>  
                        <li class="active_planned" class="active_planned" onclick="view_schedule_activity(<?php echo $temp['id']; ?>);edit_schedule_activity(<?php echo $value['id']; ?>);" href="#modalAddnewScheduleActivity" data-toggle="modal">
                            <span>
                                <input class="stt_view_activity hiden" value="<?php echo $k+1; ?>" type="text"/>
                            </span>
                            <span style="font-size: 25px; display: inline-block;width: 15%;text-align: center;float: left;margin: 10px 5px 0px 5px;">
                                <i class="fa <?php echo $icon_type_schedule[$value['type_schedule']]; ?>"></i>
                            </span>
                            <span style="display: inline-block;width: 10%;float: left;margin-top: 10px;"><input style="width: 25px;" type="checkbox" value="" name=""/></span>
                            <span class="detail_planned" style="display: inline-block;width: 60%;float: left;text-align: left;padding-left: 10px;">
                                <span class="title"><?php echo $value['name_schedule']; ?></span><br />
                                <span class="activity_overdue" ><?php echo $model->intervale_deal_activity($today,strtotime($value['datetime_schedule']));?> overdue</span>
                            </span>
                            <div class="clearfix"></div>
                            <span class="note"><?php  echo $value['note']; ?></span>
                        </li>
                    <?php 
                    } 
                }                    
                ?>    



                <?php   
                $k_d = 0;               
                foreach( $schedule as $k =>$value)
                {
                    $datetime_schedule    = strtotime(date("Y-m-d",strtotime($value['datetime_schedule']))) ;
                    if( ($datetime_schedule > $date_current) || ($datetime_schedule == $date_current && strtotime($value['time_schedule']) >= strtotime(date("H:i:s"))) || ($datetime_schedule == $date_current && $value['time_schedule'] == "") )
                    { 
                    $k_d++;    
                    if($k_d == 1)
                    { 
                    ?> 
                    <li style="border-radius: 4px 4px 0 0;background-color: #f7f7f7;font-size: 12px; line-height: 25px;padding: 4px 18px;text-align: left;border-bottom:1px solid #e0e4e7;">
                        PLANNED ()
                    </li>
                    <?php 
                    } 
                    ?>                
                        <li class="active_planned" class="active_planned" onclick="view_schedule_activity(<?php echo $temp['id']; ?>);edit_schedule_activity(<?php echo $value['id']; ?>);" href="#modalAddnewScheduleActivity" data-toggle="modal" >
                            <span>
                                <input class="stt_view_activity hiden" value="<?php echo $k+1; ?>" type="text"/>
                            </span>
                            <span style="font-size: 25px; display: inline-block;width: 15%;text-align: center;float: left;margin: 10px 5px 0px 5px;">
                                <i class="fa <?php echo $icon_type_schedule[$value['type_schedule']]; ?>"></i>
                            </span>
                            <span style="display: inline-block;width: 10%;float: left;margin-top: 10px;"><input type="checkbox" style="width: 25px;" value="" name=""/></span>
                            <span class="detail_planned" style="display: inline-block;width: 60%;float: left;text-align: left;padding-left: 10px;">
                                <span class="title"><?php echo $value['name_schedule']; ?></span><br />
                                <span class=" <?php if($datetime_schedule == $date_current){ echo 'activity_planned_doday'; }else{ echo 'activity_planned'; } ?> " ><?php if($datetime_schedule == $date_current && $value['time_schedule'] == "") echo "Hôm nay"; else echo "Due in ".$model->intervale_deal_activity($today,strtotime($value['datetime_schedule']));?></span>
                            </span>
                            <div class="clearfix"></div>
                            <span class="note"><?php echo $value['note']; ?></span>
                        </li>
                    <?php 
                    }  
                }                    
                ?>
               
                

                </ul>
                <div onclick="view_schedule_activity(<?php echo $temp['id']; ?>);" class="add_schedule_activity" href="#modalAddnewScheduleActivity" role="button" data-toggle="modal">+ Lên kế hoạch</div>
            </div>
        </div>
    <?php     
    }
    else
    { 
    ?>
        <a class="icon stage_deal"  data-toggle="popover" data-placement="bottom" data-popover-content="#activity<?php echo $temp['id'];?>">
            <i class="fa fa-exclamation-triangle icon_not_planned"></i>
        </a>
        <span class="bg_icon_not_planned"></span>
        
        <div class="hiden" id="activity<?php echo $temp['id'];?>">
            <h3 class="popover-heading" style="background-color: #fff;">               
               Bạn chưa có kế hoạch cho cơ hội này.
            </h3>
            <div class="popover-body">
                <div onclick="view_schedule_activity(<?php echo $temp['id']; ?>);" class="add_schedule_activity" href="#modalAddnewScheduleActivity" role="button" data-toggle="modal">+ Lên kế hoạch</div>
            </div>
        </div>
    <?php } ?>