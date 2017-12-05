<?php 
$baseUrl = Yii::app()->request->baseUrl; 
if(isset($list_data) )
{
//echo "<pre>";print_r($list_data); echo "</pre>";exit;    
$paging = $list_data['paging'];
$num_row = $paging['num_row'];
$num_page = $paging['num_page'];
$cur_page = $paging['cur_page'];
$lpp = $paging['lpp'];

$sum = 0;
if(  $list_data['data'] != "" && count($list_data['data']) > 0){
   foreach($list_data['data'] as $row)
    {
        $sum = $sum+ $row['amount'];
    } 
}

    
?>
<div style="width: 100%;  font-size: 15px;margin-bottom: 5px;">
    <div style="float: right;">
        <span style="font-size: 13px;padding-right: 5px;"><strong>Total</strong></span>
        <span style="display: inline-block;background-color: #3da257;color: #fff; padding: 4px 15px;"><?php  echo "$ ".number_format($sum,2,'.',','); ?></span>
    </div>
    <div class="clear"></div>
</div>  

<div style="margin-top:15px;">
    <table bgcolor="#98aec0" cellpadding="2" cellspacing="1" width="100%"  style="border-spacing: 1px;" class="table_content" >
    	<tbody >
    		<tr style="background-color: rgba(115, 149, 158, 0.80);color: #FFF;" class="table_title">
    			<td style="width: 5%;"><strong>No.</strong></td>
    			<td style="width: 16%;"><strong>AR No.</strong></td>
                <td style="width: 25%;"><strong>Description</strong></td>
                <td style="width: 7%;"><strong>Amount</strong></td>
                <td style="width: 10%;"><strong>Payer</strong></td>
                <td style="width: 12%;"><strong>Received date</strong></td>
                <td style="width: 12%;"><strong>Confirmed date</strong></td>
                <td style="width: 6%;"><strong>Action</strong></td>
    		</tr>
    					
        <?php
            if($list_data['data'] != ""){
            
            $start_num = $num_row -($cur_page-1)*$lpp; 
            foreach($list_data['data'] as $row)
            {
                ?>
                <tr style="cursor: pointer; background-color: <?php if($start_num % 2 == 1){ echo "#fff";} else{ echo "#F2F2F2";}?>;" class="id_row_customer" id="id_row_info<?php echo $row['id']; ?>" >
                    <td>
    					<?php echo $start_num;?>
                    </td>
                    
    				<td onclick="edit_v_receivable(<?php echo $row['id']; ?>);" id="hover_view_product">
    					<?php echo $row['number'];?>
                    </td>
                    <td style="<?php if(strlen($row['description']) > 50){ echo "line-height: 21px"; } ?>" >
    					<?php  echo $row['description']; ?>
                    </td>
                    <td>
                        <?php  echo "$ ".number_format($row['amount'],2,'.',','); ?>
                    </td>
                    <td>
                        <?php echo $row['name']; ?>
                    </td>
                    <td>
                        <?php echo $row['received_date']; ?>
                    </td>
                    <td>
                        <?php 
                        if($row['confirmed_date']){
                            echo $row['confirmed_date'];
                        }else{
                            echo "N/A";
                        }
                        ?>
                    </td>
                    <td style=" margin: 0px !important;width: 100%;height: 100%;padding: 0px !important;">
                        <?php
                            if($row['status'] >= 3){
                                $n_st = '<span style="margin-top: 9px;" class="label label-success">Completed</span>';
                            }else{
                                $n_st = '<span style="margin-top: 9px;" class="label label-primary">pending</span>';
                            }
                            echo $n_st;
                         ?>
    				</td>
                </tr>
    		<?php 
            $start_num=$start_num-1; }
            }else{ ?>
                <tr>
                    <td colspan="7"> No records to display </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>    
<!-- PAGE PAGING -->   
<?php include(dirname(__FILE__).'/../_frm_page.php'); ?>
<!-- END PAGING --> 

<?php } else {  echo '-1'; }?>

