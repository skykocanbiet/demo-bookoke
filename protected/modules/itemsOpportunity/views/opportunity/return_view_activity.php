<?php
$today = strtotime(date("Y-m-d")); 
$icon_type_schedule = array('1'=>'fa-phone','2'=>'fa-users icon_change_meeting','3'=>'fa-clock-o','4'=>'fa-flag','5'=>'fa-envelope','6'=>'fa-coffee');
$date_current       = strtotime(date("Y-m-d H:i:s"));
$k_d = 0;
$k_p = 0;
$k_f = 0;
foreach( $schedule as $k =>$value  ){
$datetime_schedule    = strtotime(date("Y-m-d",strtotime($value['datetime_schedule']))) ;
    if($datetime_schedule >= $date_current){ $k_d++; ?>
        <?php if($k_d == 1){ ?> 
        <li style="<?php if($k==0){ echo ' border-radius: 4px 4px 0 0;'; } ?> background-color: #f7f7f7;font-size: 12px; line-height: 25px;padding: 4px 18px;text-align: left;border-bottom:1px solid #e0e4e7;">
            PLANNED (<?php echo $k_d; ?>)
        </li>
        <?php } ?>
        <li class="active_planned" class="active_planned" onclick="view_schedule_activity(<?php echo $id_opportunity; ?>);edit_schedule_activity(<?php echo $value['id']; ?>);" href="#modalAddnewScheduleActivity" data-toggle="modal" >
            <span>
                <input class="stt_view_activity hiden" value="<?php echo $k+1; ?>" type="text"/>
            </span>
            <span style="font-size: 25px; display: inline-block;width: 15%;text-align: center;float: left;margin: 10px 5px 0px 5px;">
                <i class="fa <?php echo $icon_type_schedule[$value['type_schedule']]; ?>"></i>
            </span>
            <span style="display: inline-block;width: 10%;float: left;margin-top: 10px;"><input type="checkbox" style="width: 25px;" value="" name=""/></span>
            <span class="detail_planned" style="display: inline-block;width: 60%;float: left;text-align: left;padding-left: 10px;">
                <span class="title"><?php echo $value['name_schedule']; ?></span><br />
                <span class=" <?php if($datetime_schedule == $date_current){ echo 'activity_planned_doday'; }else{ echo 'activity_planned'; } ?> " >Due in <?php echo $model->intervale_deal_activity(strtotime(date("Y-m-d H:i:s")),strtotime($value['datetime_schedule']));?></span>
            </span>
            <div class="clearfix"></div>
            <span class="note"><?php  echo $value['note']; ?></span>
        </li>
   <?php }else{ $k_p++;  ?>
        <?php if($k_p == 1){ ?> 
        <li style="<?php if($k==0){ echo ' border-radius: 4px 4px 0 0;'; } ?> background-color: #f7f7f7;font-size: 12px;line-height: 25px;padding: 4px 18px;text-align: left;color: #e84646;border-bottom:1px solid #e0e4e7;">
            OVERDUE (<?php echo $k_p; ?>) 
        </li>
        <?php } ?>
        <li class="active_planned" class="active_planned" onclick="view_schedule_activity(<?php echo $id_opportunity; ?>);edit_schedule_activity(<?php echo $value['id']; ?>);" href="#modalAddnewScheduleActivity" data-toggle="modal">
            <span>
                <input class="stt_view_activity hiden" value="<?php echo $k+1; ?>" type="text"/>
            </span>
            <span style="font-size: 25px; display: inline-block;width: 15%;text-align: center;float: left;margin: 10px 5px 0px 5px;">
                <i class="fa <?php echo $icon_type_schedule[$value['type_schedule']]; ?>"></i>
            </span>
            <span style="display: inline-block;width: 10%;float: left;margin-top: 10px;"><input style="width: 25px;" type="checkbox" value="" name=""/></span>
            <span class="detail_planned" style="display: inline-block;width: 60%;float: left;text-align: left;padding-left: 10px;">
                <span class="title"><?php echo $value['name_schedule']; ?></span><br />
                <span class="activity_overdue" ><?php echo $model->intervale_deal_activity(strtotime(date("Y-m-d H:i:s")),strtotime($value['datetime_schedule']));?> overdue</span>
            </span>
            <div class="clearfix"></div>
            <span class="note"><?php  echo $value['note']; ?></span>
        </li>
   <?php } } ?>