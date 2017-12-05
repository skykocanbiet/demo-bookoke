<?php $baseUrl = Yii::app()->getBaseUrl(); ?>
<tr class="currentRow t<?php echo $i; ?>" id="">
 <?php 

    echo "<td class='padding_left_0 qc1'>";
    echo $form->dropDownListGroup($orderNew, "[$i]id_service",array('widgetOptions'=>array('htmlOptions'=>array('required'=>false,'placeholder'=>'Số lượng','class'=>'group_services cal group')),'labelOptions' => array("label" => '')));
    echo $form->hiddenField($orderNew,"[$i]description",array('class'=>'quote_des'));
    echo "</td>";

    // dentist
    $arrUser = array(Yii::app()->user->getState('user_id')=>Yii::app()->user->getState('user_name')); 
    echo "<td class='qc2'>";
    echo $form->dropDownListGroup($orderNew, "[$i]id_user",array('widgetOptions'=>array('data'=>$arrUser,'htmlOptions'=>array('required'=>false,'placeholder'=>'Số lượng','class'=>'group_dentist quote_id_user_'.$i)),'labelOptions' => array("label" => ''))); 
    echo "</td>";

    // so rang
    echo "<td class='qc3'>";
    echo $form->textFieldGroup($orderNew,"[$i]pty",array('widgetOptions'=>array('htmlOptions'=>array('required'=>false,'placeholder'=>'Số lượng','value'=>1,'class'=>'inputW cal group_qty')),'labelOptions' => array("label" => '')));
    echo "</td>"; ?>

    <!-- đơn giá -->
    <td class='qc4'>
    <div class="form-group">
        <label></label>
        <?php 
            echo CHtml::textField('unit_price','',array('placeholder'=>'Đơn giá','readOnly' => true,'class'=>'inp_price group_unit cal_ans autoNum form-control')); 
            echo $form->hiddenField($orderNew,"[$i]unit_price",array('class'=>'s_group_unit'));
        ?>
    </div>
    </td>

    <!-- Thuế -->
    <td class='qc5'>
    <div class="form-group">
        <label></label>
        <?php 
            echo CHtml::textField('tax','',array('placeholder'=>'Thuế','readOnly' => true,'class'=>'inp_price group_tax cal_ans cal_tax autoNum form-control')); 
            echo $form->hiddenField($orderNew,"[$i]tax",array('class'=>'s_group_tax'));
        ?>
    </div>
    </td>

    <!-- Thành tiền -->
    <td class='qc6'>
    <div class="form-group">
        <label></label>
        <?php 
            echo CHtml::textField('amount','',array('placeholder'=>'Thành tiền','readOnly' => true,'class'=>'inp_price group_amount cal_ans cal_sum autoNum form-control')); 
            echo $form->hiddenField($orderNew,"[$i]amount",array('class'=>'s_group_amount'));
        ?>
    </div>
    </td>

<?php
    echo "<td class='qc7'>";
    echo $form->checkBox($orderNew,"[$i]status",array('class'=>'chk'));

    echo $form->hiddenField($orderNew,"[$i]order_old",array('value'=>'0'));
    echo $form->hiddenField($orderNew,"[$i]id");
?>

            <a href="" data-toggle="tooltip" title="Giảm giá" class="sCDiscount"><img src="<?php echo $baseUrl; ?>/images/icon_sb_left/sale.png" class="sIcon addIDis" alt=""></a>
            <a href="" data-toggle="tooltip" title="Xóa" class="sCDiscount"><img src="<?php echo $baseUrl; ?>/images/icon_sb_left/delete-def.png" class="sIcon remove_field" alt=""></a>
     
    </td>
</tr>

<script>
$('[data-toggle="tooltip"]').tooltip();
</script>