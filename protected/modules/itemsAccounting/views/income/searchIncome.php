<?php 
$baseUrl  = Yii::app()->request->baseUrl; 

if(isset($data))
{
//echo "<pre>";print_r($list_data); echo "</pre>";exit;    
$paging     = $data['paging'];
$num_row    = $paging['num_row'];
$num_page   = $paging['num_page'];
$cur_page   = $paging['cur_page'];
$lpp        = $paging['lpp'];
    
?>
<div style="background-color: #f9f3ff; padding: 2px;">
    <table bgcolor="#98aec0" cellpadding="2" cellspacing="1" width="100%"  style="border-spacing: 1px;" class="table_content" >
    	<tr  class="table_title">
            <td style="width: 10%"><strong>No.</strong></td>
            <td style="width: 15%"><strong>Number Order.</strong></td>
            <td style="width: 20%"><strong>Tracking Number</strong></td>
            <td style="width: 15%"><strong>Shipper</strong></td>
            <td style="width: 15%"><strong>Ordered</strong></td>
            <td style="width: 15%"><strong>Period</strong></td>
            <td style="width: 15%"><strong>Delivery</strong></td>
            <?php if(($group_no=='admin'||$group_no=='superadmin' || $group_no=='manager' ||  $group_no=='supplier')) { ?>
            <td style="width: 10%"><strong>Action</strong></td>
            <?php } ?>
    	</tr>
    	<?php 
            if($data['data'] != ""){
            $star_number = $num_row -($cur_page-1)*$lpp;
    		foreach($data['data'] as $temp){
    		?>
    		<tr style="cursor: pointer; height: 35px; line-height: 35px;background-color: <?php if($star_number % 2 == 1){ echo "#F2F2F2";} else{ echo "#FFF";}?>;" id="id_row_info<?php echo $temp['id']?>" class="id_row_customer" >
                <td><?php echo $star_number;  ?></td>
                <td>
                    <span style="display: inline-block;" onclick="ShippingDetail(<?php echo $temp['id'];  ?>)"><?php echo $temp['order_number']; ?></span>
                </td>
                <td><?php if($temp['tracking_number']){ echo $temp['tracking_number']; }else{ echo 'N/A';  }  ?></td>
                <td><?php echo $temp['shipper_name']; ?></td>
                <td><?php echo $temp['ordered_date']; ?></td>
                <td style="position: relative;">
                    <?php 
                        if($temp['delivery_shipping'] != 3){
                            if($temp['finished_date']){
                                echo $model->intervale_deal_activity(strtotime($temp['ordered_date']),strtotime($temp['finished_date'])); 
                            }elseif($temp['shipped_date']){
                                $due = $model->intervale_deal_activity(strtotime(date("Y-m-d H:i:s")),strtotime($temp['shipped_date'])); 
                                if($due > 24){
                                    $due_format  = round($due / 24).' days';
                                }else{
                                    $due_format = round($due)." o'clock";
                                }
                                echo '<span>'.$due_format.'</span>'; 
                                if($due >= 72){
                                    echo '<span class="icon_period_warring_lv1"><a class="icon stage_deal" ><i class="fa fa-exclamation-triangle icon_not_planned"></i></a><span class="bg_icon_warring_lv1"></span></span>';
                                }elseif($due > 24){
                                    echo '<span class="icon_period_warring"><a class="icon stage_deal" ><i class="fa fa-exclamation-triangle icon_not_planned"></i></a><span class="bg_icon_warring"></span></span>';
                                }
                            }elseif($temp['process_date']){
                                $due = $model->intervale_deal_activity(strtotime(date("Y-m-d H:i:s")),strtotime($temp['process_date'])); 
                                if($due > 24){
                                    $due_format  = round($due / 24).' days';
                                }else{
                                    $due_format = round($due)." o'clock";
                                }
                                echo '<span>'.$due_format.'</span>'; 
                                if($due >= 72){
                                    echo '<span class="icon_period_warring_lv1"><a class="icon stage_deal" ><i class="fa fa-exclamation-triangle icon_not_planned"></i></a><span class="bg_icon_warring_lv1"></span></span>';
                                }elseif($due > 24){
                                    echo '<span class="icon_period_warring"><a class="icon stage_deal" ><i class="fa fa-exclamation-triangle icon_not_planned"></i></a><span class="bg_icon_warring"></span></span>';
                                }
                            }else{
                                $due = $model->intervale_deal_activity(strtotime(date("Y-m-d H:i:s")),strtotime($temp['ordered_date']));
                                
                                if($due > 24){
                                    $due_format  = round($due / 24).' days';
                                }else{
                                    $due_format = round($due)." o'clock";
                                }
                                echo '<span>'.$due_format.'</span>';
                                if(round($due) >= 72){
                                    echo '<span class="icon_period_warring_lv1"><a class="icon stage_deal" ><i class="fa fa-exclamation-triangle icon_not_planned"></i></a><span class="bg_icon_warring_lv1"></span></span>';
                                }elseif(round($due) >= 24){
                                    echo '<span class="icon_period_warring"><a class="icon stage_deal" ><i class="fa fa-exclamation-triangle icon_not_planned"></i></a><span class="bg_icon_warring"></span></span>';
                                }
                            }
                        }else{
                            if($temp['finished_date']){
                                echo $model->intervale_deal_activity(strtotime($temp['ordered_date']),strtotime($temp['finished_date'])); 
                            }elseif($temp['shipped_date']){
                                $due = $model->intervale_deal_activity(strtotime(date("Y-m-d H:i:s")),strtotime($temp['shipped_date'])); 
                                echo '<span>'.$due.'</span>'; 
                            }else{
                                $due = $model->intervale_deal_activity(strtotime(date("Y-m-d H:i:s")),strtotime($temp['ordered_date']));
                                echo '<span>'.$due.'</span>';
                            }
                        }
                    ?>
                </td>
                <td>
                    <?php 
                        if($temp['delivery_shipping'] == 0){
                            echo '<span class="label label_order label-new">new</span>';
                        }elseif($temp['delivery_shipping'] == 1){
                            echo '<span class="label label_order label-info">awaiting</span>';
                        }elseif($temp['delivery_shipping'] == 2){
                            echo '<span class="label label_order label_confirm">shipping</span>';
                        }elseif($temp['delivery_shipping'] == 3){
                            echo '<span class="label label_order label-success" >delivered</span>';
                        }elseif($temp['delivery_shipping'] == 4){
                            echo '<span class="label label_order label-success" >canceled</span>';
                        }else{
                            echo '<span class="label label_order label-success" >'.$temp['delivery_shipping'].'</span>';
                        }
                    ?>
                </td>
                <?php if(($group_no=='admin'||$group_no=='superadmin' || $group_no=='manager' ||  $group_no=='supplier')) { ?>
                <td style=" margin: 0px !important;width: 100%;height: 100%;padding: 0px !important;text-align: center;">
                    <div style="width: 54px;margin: 0px auto;">
                        <span style="width: 27px;height: 35px;">
                            <img style="width:16px;vertical-align: middle;" onclick="edit_v_shipping(<?php  echo $temp['id']; ?>)" src="<?php echo $baseUrl."/images/edit.png";?>"/>
                        </span>
                    </div>
    			</td>
                <?php } ?>
    		</tr>
       <?php 
            $star_number=$star_number-1;
       } } else{ ?>
            <tr>
                <td colspan="10"> No records to display </td>
            </tr>
       <?php  } ?>
    </table>
</div>
<div style="height: 27px;padding:5px;color:#5c2b95">
    <div style="margin-top:3px;float:left">
    </div>
    <div style="margin-top:5px;float:right;">
            <span style="top:2px;position: relative;">
            <?php
                if($cur_page==1)
                {
                    ?>
                     <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/start.gif" />
                    <?php
                }
                else{
                    ?>
                     <a style="text-decoration: none; cursor: pointer;" onclick="search_cus('1')" >
                         <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/start.gif" />
                    </a>
                    <?php
                }
                $previous=$cur_page - 1;
                if($previous > 0 )
                {
                    ?>
                    <a style="text-decoration: none; cursor: pointer;" onclick="search_cus('<?php echo $previous?>')" >
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

            <span><input type="text" value="<?php echo $cur_page?>" size="1" id="id_text_page" name="id_text_page" style="color:#5c2b95;height: 13px;width:25px;text-align: center;" onkeypress="runScript(event)" /> of  <?php echo  $num_page?></span>
            <span style="top:2px;position: relative;">
            <? $next=$cur_page + 1;
                if($next <= $num_page )
                {
                    ?>
                    <a style="text-decoration: none; cursor: pointer;" onclick="search_cus('<?php echo $next?>')" >
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/next.gif" />
                    </a>
                    <?php
                }
                else{
                    ?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/next.gif" />
                    <?php
                }
                if($cur_page==$num_page)
                {
                    ?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/end.gif" />
                    <?php
                }
                else{
                    ?>
                     <a style="text-decoration: none; cursor: pointer;" onclick="search_cus('<?php echo $num_page?>')" >
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/end.gif" />
                    </a>
                    <?php
                }
            ?>
            </span>
     </div>
     <div class="clear"></div>
</div>
<div id="shippingdetail" style="margin-top: 20px;">

</div>
<?php } else {  echo '-1'; }?>
<script>
function ShippingDetail(id){
    $('.id_row_customer').removeClass('active_row');
    $('#id_row_info'+id).addClass('active_row');
     
    if(id == '' || id == null || id =='undefined' ){
        alert('Error ! Not found id order.');
        return false;
    }
    jQuery.ajax({   type:"POST",
                    url:"<?php echo CController::createUrl('sales/ShippingDetail')?>",
                    data:{
                        id  :  id,
                    },
                    success:function(data){
                        $("#shippingdetail").html(data);
                    }
    });
}
</script>