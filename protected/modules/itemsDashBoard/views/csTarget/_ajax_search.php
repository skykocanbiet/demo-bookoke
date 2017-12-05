<?php 
$baseUrl = Yii::app()->request->baseUrl; 
if(isset($list_product) && $list_product['data'] != "")
{
//echo "<pre>";print_r($list_product); echo "</pre>";exit;    
$paging = $list_product['paging'];
$num_row = $paging['num_row'];
$num_page = $paging['num_page'];
$cur_page = $paging['cur_page'];
$lpp = $paging['lpp'];
    
?>
<table bgcolor="#98aec0" cellpadding="2" cellspacing="1" width="100%"  style="border-spacing: 1px;" class="table_content" >
	<tbody >
		<tr style="background-color: #bca8d2;color: #5c2b95;" class="table_title">
			<td style="width: 5%;"><strong>No.</strong></td>
			<td style="width: 15%;"><strong>User</strong></td>
			<td style="width: 10%;"><strong>Year</strong></td>			
			<td style="width: 10%;"><strong>Month</strong></td>
            <td style="width: 15%;"><strong>Revenue</strong></td>
            <td style="width: 15%;"><strong>New Account</strong></td>
			<td style="width: 15%;"><strong>Sale Calls</strong></td>
			<td style="width: 10%;"><strong>Sale Orders</strong></td>
            <td style="width: 5%;"><strong>Action</strong></td>
		</tr>
					
    <?php
        
        $start_num = $num_row -($cur_page-1)*$lpp; 
        foreach($list_product['data'] as $row)
        {
            ?>
            <tr style="cursor: pointer; background-color: <?php if($start_num % 2 == 1){ echo "#fff";} else{ echo "#F2F2F2";}?>;" class="id_row_customer" id="id_row_info<?php echo $row['id']; ?>" >
                <td>
					<?php echo $start_num;?>
                </td>
				<td  id="hover_view_row_info">
					<?php 
                    $user =  User::model()->findByPk($row['user_id']);
                    if($user->name){ echo $user->name; }else{ echo "N/A";  }
                    ?>
                </td>
				<td>
                    <?php echo $row['year']; ?>
                </td>
                <td>
					<?php echo $row['month']; ?>
                </td>
                <td>
					<?php echo $row['revenue_target'];?>
                </td>
				<td>
					<?php echo $row['new_account_target'];?>
                </td>
                <td>
					<?php echo $row['call_target'];?>
                </td>
                <td>
					<?php echo $row['order_target'];?>
                </td>
                <td style=" margin: 0px !important;width: 100%;height: 100%;padding: 0px !important;">
                    <div style="width: 54px;margin: 0px auto; text-align: center;">
                        <span style="display:table-cell;vertical-align: middle;width: 27px;height: 35px;" >
                            <img style="width:16px;vertical-align: middle;" title="Edit" onclick="<?php echo $subject_js.'Update' ?>(<?php echo $row['id']; ?>);" src="<?php echo $baseUrl."/images/edit.png";?>"/>
                        </span>
                        <span style="display:table-cell;vertical-align: middle;width: 27px;height: 35px;" >
                            <img style="width:18px;vertical-align: middle;" title="Delete" onclick="<?php echo $subject_js.'Delete'?>(<?php echo $row['id']; ?>);" src="<?php echo $baseUrl."/images/delete.png";?>"/>
                        </span>
                    </div>
				</td>
            </tr>
		<?php 
        $start_num=$start_num-1;
		}
		?>
    </tbody>
</table>
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
<?php } else {  echo '-1'; }?>
