<?php 
//echo date("Y/m/d");

if($list_lead100)
{
    ?>
    
    <table bgcolor="#98aec0" cellpadding="2" cellspacing="1" width="100%"  style="border-spacing: 1px;"  >
    <tbody >
    <tr style="background-color: #bca8d2;color: #5c2b95;" class="table_title" >
        <td style="text-align: center;"><strong>No.</strong></td>
        <td style="text-align: center;"><strong>First name</strong></td>
        <td style="text-align: center;"><strong>Last name</strong></td>
        <td style="text-align: center;"><strong>Phone number</strong></td>
        <td style="text-align: center;"><strong><span style="cursor: pointer;" onclick="search_opp('1')">Scheduled date <span id="sort_img"></span></span></strong></td>
        <td style="text-align: center;"><strong>Potential Rating</strong></td>
        <td style="text-align: center;"><strong>Trial Balance</strong></td>
        <td style="text-align: center;"><strong>Referred by <?php //echo $num_record?></strong></td>

    </tr>
    <?php 
    
    $ln=Yii::app()->params['lpp_lead'];
    $sorecord=$num_record-($current_page-1)*$ln;
    foreach($list_lead100 as $row)
    {
        
        if($row['scheduled']==date("Y/m/d") || $row['priority']=='1')
        {
           ?>
            <tr style="cursor: pointer; background-color: <?php if($sorecord % 2 == 1){ echo "#fff";} else{ echo "#F2F2F2";}?>;" id="id_row_info_<?php echo $row['idlead']?>" style="background-color: yellow;" class="row_info2">
				<td style="padding-top: 15px; text-align: center;"><?php echo $sorecord?></td>
				<td style="padding-top: 15px; text-align: center;" id="id_firstname_row_<?php echo $row['idlead']?>" style="text-align: center;"><a href="javascript:void(0)" onclick="view_information_lead('<?php echo $row['idlead']?>')"><?php if($row['firstname']) echo $row['firstname']; else echo 'N/A';?></a></td>
				<td style="padding-top: 15px; text-align: center;" id="id_lastname_row_<?php echo $row['idlead']?>" style="text-align: center;"><?php echo $row['lastname']?></td>
				<td style="padding-top: 15px; text-align: center;" id="id_phone_row_<?php echo $row['idlead']?>" style="text-align: center;"><?php echo $row['phone']?></td>
				<td style="padding-top: 15px; text-align: center;" id="id_schedule_row_<?php echo $row['idlead']?>" style="text-align: center;"><?php if($row['scheduled']) echo $row['scheduled'].' - '.$row['time']; else echo 'N/A' ?></td>
				<td style="padding-top: 15px; text-align: center;" id="id_potential_row_<?php echo $row['idlead']?>" style="text-align: center;"><?php if($row['potential_rating']) echo $row['potential_rating']; else echo 'N/A' ?></td>
				<td style="padding-top: 15px; text-align: center;" id="id_balance_row_<?php echo $row['idlead']?>" style="text-align: center;">
				<?php  
				$trial_balance=izi_client::get_trial_balance_client($row['userid'],$row['phone']);
				if($trial_balance)
					echo '$ '.$trial_balance;
				else echo 'N/A';
				?>
				</td>
				<td style="padding-top: 15px; text-align: center;" id="id_referredby_row_<?php echo $row['idlead']?>" style="text-align: center;"><?php if($row['referredby']) echo $row['referredby']; else echo 'N/A' ?></td>
    
            </tr>
        <?
        }
        else{
            ?>
            <tr style="cursor: pointer; background-color: <?php if($sorecord % 2 == 1){ echo "#fff";} else{ echo "#F2F2F2";}?>;" id="id_row_info_<?php echo $row['idlead']?>"  class="row_info">
				<td style="padding-top: 15px; text-align: center;"><?php echo $sorecord?></td>
				<td style="padding-top: 15px; text-align: center;" id="id_firstname_row_<?php echo $row['idlead']?>" style="text-align: center;"><a href="javascript:void(0)" onclick="view_information_lead('<?php echo $row['idlead']?>')"><?php if($row['firstname']) echo $row['firstname']; else echo 'N/A';?></a></td>
				<td style="padding-top: 15px; text-align: center;" id="id_lastname_row_<?php echo $row['idlead']?>" style="text-align: center;"><?php echo $row['lastname']?></td>
				<td style="padding-top: 15px; text-align: center;" id="id_phone_row_<?php echo $row['idlead']?>" style="text-align: center;"><?php echo $row['phone']?></td>
				<td style="padding-top: 15px; text-align: center;" id="id_schedule_row_<?php echo $row['idlead']?>" style="text-align: center;"><?php if($row['scheduled']) echo $row['scheduled'].' - '.$row['time']; else echo 'N/A' ?></td>
				<td style="padding-top: 15px; text-align: center;" id="id_potential_row_<?php echo $row['idlead']?>" style="text-align: center;"><?php if($row['potential_rating']) echo $row['potential_rating']; else echo 'N/A' ?></td>
				<td style="padding-top: 15px; text-align: center;" id="id_balance_row_<?php echo $row['idlead']?>" style="text-align: center;">
				<?php  
				/*
				$trial_balance=izi_client::get_trial_balance_client($row['userid'],$row['phone']);
				if($trial_balance)
					echo '$ '.$trial_balance;
				else echo 'N/A';*/
				?>
				</td>
				<td style="padding-top: 15px; text-align: center;" id="id_referredby_row_<?php echo $row['idlead']?>" style="text-align: center;"><?php if($row['referredby']) echo $row['referredby']; else echo 'N/A' ?></td>
    
            </tr>
        <?
        }
        
        if($sorecord > 1)
            $sorecord=$sorecord-1;
    }
    ?>
    </tbody>
    </table>
    <div style="height: 27px;padding:5px;color:#5c2b95">
         <div style="margin-top:5px;float:right;">
            <span style="top:2px;position: relative;">
            <?php
                if($current_page==1)
                {
                    ?>
                     <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/start.gif" />
                    <?php
                }
                else{
                    ?>
                     <a style="text-decoration: none; cursor: pointer;" onclick="search_opp('1')" >
                         <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/start.gif" />
                    </a>
                    <?php
                }
                $previous=$current_page - 1;
                if($previous > 0 )
                {
                    ?>
                    <a style="text-decoration: none; cursor: pointer;" onclick="search_opp('<?php echo $previous?>')" >
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/previous.gif" />
                    </a>
                    <?php
                }
                else{
                    ?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/previous.gif" />
                    <?php
                }

            ?>


            </span>

            <span><input type="text" value="<?php echo $current_page?>" size="1" id="id_text_page" name="id_text_page" style="color:#5c2b95;height: 13px;width:25px;text-align: center;" onkeypress="runScript(event)" /> of  <?php echo  $num_page?></span>
            <span style="top:2px;position: relative;">
            <? $next=$current_page + 1;
                if($next <= $num_page )
                {
                    ?>
                    <a style="text-decoration: none; cursor: pointer;" onclick="search_opp('<?php echo $next?>')" >
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/next.gif" />
                    </a>
                    <?php
                }
                else{
                    ?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/next.gif" />
                    <?php
                }
                if($current_page==$num_page)
                {
                    ?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/end.gif" />
                    <?php
                }
                else{
                    ?>
                     <a style="text-decoration: none; cursor: pointer;" onclick="search_opp('<?php echo $num_page?>')" >
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/end.gif" />
                    </a>
                    <?php
                }
            ?>
            </span>
     </div>
</div>
    <?php
}
else{
    echo '-1';
}
/**/
?>
