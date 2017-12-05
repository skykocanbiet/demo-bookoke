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
if($list_data['data'] != ""){
    foreach($list_data['data'] as $row)
    {
        $sum = $sum+ $row['currExchange'];
    }
}
    
?>

<div style="width: 100%; font-size: 15px;margin-bottom: 5px;">
    <div style="float: right;">
        <span style="font-size: 13px;padding-right: 5px;"><strong>Tổng cộng</strong></span>
        <span style="display: inline-block;background-color: #3da257;color: #fff; padding: 4px 15px;"><?php  echo number_format($sum,0,',','.') . " VND"; ?></span>
    </div>
    <div class="clear"></div>
</div>    

<div style="margin-top:15px;">
    <table bgcolor="#98aec0" cellpadding="2" cellspacing="1" width="100%"  style="border-spacing: 1px;" class="table_content" >
    	<tbody >
    		<tr style="background-color: rgba(115, 149, 158, 0.80);color: #FFF;" class="table_title">
    			<td style="width: 5%;"><strong>STT</strong></td>
    			<td style="width: 13%;"><strong>Mã</strong></td>
                <td style="width: 25%;"><strong>Mô tả</strong></td>
                <td style="width: 7%;"><strong>Số tiền (VND)</strong></td>
                <td style="width: 7%;"><strong>Số tiền (ngoại tệ)</strong></td>
                <td style="width: 17%;"><strong>Người nhận</strong></td>
                <td style="width: 11%;"><strong>Ngày yêu cầu</strong></td>
                <td style="width: 11%;"><strong>Ngày phê duyệt</strong></td>
                <td style="width: 7%;"><strong>Trạng thái</strong></td>
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
    				<td onclick="edit_v_payable(<?php echo $row['id']; ?>);" id="hover_view_product">
    					<?php echo $row['number'];?>
                    </td>
                    <td style="<?php if(strlen($row['description']) > 48){ echo "line-height: 21px"; } ?>">
                        <?php echo $row['description'];?>
                      
                    </td>
                    <td>
                        <?php echo number_format($row['currExchange'],0,'.',','). " VND"; ?>
                    </td>
                     <td>
                        <?php echo number_format($row['amount'],0,'.',','). " ".$row['currency']; ?>
                    </td>
                    <td style="<?php if(strlen($row['name']) > 48){ echo "line-height: 21px"; } ?>">
                        <?php echo $row['name']; ?>
                    </td>
                    <td>
                        <?php echo $row['requester_date']; ?>
                    </td>
                    <td>
                        <?php if($row['status'] == 0){ echo "N/A"; }else{ echo $row['approval_date']; } ?>
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
