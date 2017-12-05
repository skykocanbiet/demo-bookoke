<?php $baseUrl = Yii::app()->getBaseUrl(); ?>
<tr class="currentRow t<?php echo $i; ?>" id="">
 <?php 

    // service
    echo "<td class='padding_left_0 qc1'>";
    echo $form->dropDownListGroup($orderDetail, "[$i]id_service",array('widgetOptions'=>array('data'=>$dataService,'htmlOptions'=>array('required'=>true,'placeholder'=>'Số lượng','class'=>'group_services cal group')),'labelOptions' => array("label" => '')));
    echo $form->hiddenField($orderDetail,"[$i]description",array('class'=>'quote_des','value'=>$des));
    echo "</td>";

    if(Yii::app()->user->getState('group_id') != 3) {
        $user = array();
    }
    // dentist
    echo "<td class='qc2'>";
    echo $form->dropDownListGroup($orderDetail, "[$i]id_user",array('widgetOptions'=>array('data'=>$user,'htmlOptions'=>array('required'=>false,'placeholder'=>'Số lượng','class'=>'group_dentist')),'labelOptions' => array("label" => ''))); 
    echo "</td>";

    // so rang
    echo "<td class='qc3'>";
    echo $form->textFieldGroup($orderDetail,"[$i]qty",array('widgetOptions'=>array('htmlOptions'=>array('required'=>false,'class'=>'inputW cal group_qty','value'=>'1')),'labelOptions' => array("label" => '')));
    echo "</td>"; ?>

    <!-- đơn giá -->
    <td class='qc4'>
    <div class="form-group">
        <label></label>
        <?php 
            echo CHtml::textField('unit_price',$unit,array('placeholder'=>'Đơn giá','readOnly' => true,'class'=>'inp_price group_unit cal_ans autoNum form-control')); 
            echo $form->hiddenField($orderDetail,"[$i]unit_price",array('class'=>'s_group_unit','value'=>$unit));
        ?>
    </div>
    </td>

    <!-- Thuế -->
    <td class='qc5'>
    <div class="form-group">
        <label></label>
        <?php 
            echo CHtml::textField('tax',$tax,array('placeholder'=>'Thuế','readOnly' => true,'class'=>'inp_price group_tax cal_tax cal_ans autoNum form-control')); 
            echo $form->hiddenField($orderDetail,"[$i]tax",array('class'=>'s_group_tax','value'=>$tax));
        ?>
    </div>
    </td>

    <!-- Thành tiền -->
    <td class='qc6'>
    <div class="form-group">
        <label></label>
        <?php 
            echo CHtml::textField('amount',$sum,array('placeholder'=>'Thành tiền','readOnly' => true,'class'=>'inp_price group_amount cal_ans cal_sum autoNum form-control')); 
            echo $form->hiddenField($orderDetail,"[$i]amount",array('class'=>'s_group_amount','value'=>$sum));
        ?>
    </div>
    </td>

<?php
    echo "<td class='qc7'>";
        echo $form->checkBox($orderDetail,"[$i]status",array('class'=>'chk'));
        echo $form->hiddenField($orderDetail,"[$i]quote_old",array('value'=>'0'));
?>
        
        <a href="" data-toggle="tooltip" title="Giảm giá" class="sCDiscount"><img src="<?php echo $baseUrl; ?>/images/icon_sb_left/sale.png" class="sIcon addIDis" alt=""></a>
        <a href="" data-toggle="tooltip" title="Xóa" class="sCDiscount"><img src="<?php echo $baseUrl; ?>/images/icon_sb_left/delete-def.png" class="sIcon remove_field" alt=""></a>
    </td>
</tr>

<script>
    $(function(){
        var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
        $('.autoNum').autoNumeric('init',numberOptions);
    })
</script>