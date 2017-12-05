<?php 
//echo date("Y/m/d");

if($list_lead100)
{
    ?>
    
    <table bgcolor="#98aec0" cellpadding="2" cellspacing="1" width="100%"  style="border-spacing: 1px;"  >
			<tbody >
				<tr style="background-color: #bca8d2;color: #5c2b95;" class="table_title" >
					<td style="text-align: center;"><strong>No.</strong></td>
					<td style="text-align: center;"><strong>Product Type</strong></td>
					<td style="text-align: center;"><strong>Product</strong></td>
					<td style="text-align: center;"><strong>Opportunity</strong></td>
					<td style="text-align: center;"><strong>Action</strong></td>
				</tr>
    <?php 
    
    $ln=Yii::app()->params['lpp_lead'];
    $sorecord=$num_record-($current_page-1)*$ln;
    foreach($list_lead100 as $row)
    {
        ?>
        <tr style="cursor: pointer; background-color: <?php if($sorecord % 2 == 1){ echo "#fff";} else{ echo "#F2F2F2";}?>;" style="background-color: yellow;" class="row_info2">
			<td style="padding-top: 15px; text-align: center;"><?php echo $sorecord?></td>
			<td style="padding-top: 15px; text-align: center;" style="text-align: center;">
				<?php 
				$oneproducttype = ProductType::model()->findByPk($row['id_product_type']);
				echo $oneproducttype->name;
				?>
			</td>
			<td style="padding-top: 15px; text-align: center;" style="text-align: center;">
				<?php 
				$oneproduct = Product::model()->findByPk($row['id_product']);
				echo $oneproduct->name;
				?>
			</td>
			<td style="padding-top: 15px; text-align: center;" style="text-align: center;">
				<?php 
				echo $row['opportunity'];
				?>
			</td>
			<td style="padding-top: 15px; text-align: center;" style="text-align: center;">
				<?php
					$list = array();
					$list['0'] = 'Opportunity';
					$list['1'] = 'Order';
					$list['2'] = 'Finish';
					echo CHtml::dropDownList('add_new_account_products_type',$row['st'],$list,
										array('onChange'=>CHtml::ajax(array(
													'type'=>'POST',
													'url'=>CController::createUrl('opportunity/change_status'),
													'data'=>array('st'=>'js:this.value','idopportunity'=>$row['id']),
													'beforeSend'=> "function( request ) {
														$('#idwaiting_main').html('<img src=\'".Yii::app()->request->baseUrl."/images/waitingmain.gif\' alt=\'loading.....\' />');
													}
													",
													 'success'=>'function(data) {
														 $("#idwaiting_main").html("");
														 jAlert(\'Update success Opportunity!\',\'Notice\');
													  }',
													))));
				?>
			</td>
		</tr>
        <?
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
