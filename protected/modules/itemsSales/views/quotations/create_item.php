<?php $baseUrl = Yii::app()->getBaseUrl(); ?>
<tr class="currentRow t<?php echo $i; ?>" id="">
 <?php 
    echo $form->hiddenField($quote_services,"[$i]id_author",array('value'=>Yii::app()->user->getState('user_id')));
    // chuan doan
    echo "<td class='qc1'>";
    echo $form->textFieldGroup($quote_services, "[$i]diagnose",array('widgetOptions'=>array(
        'htmlOptions'  => array('required'=>false,'placeholder'=>'Chuẩn đoán','class'=>'diagnose inputW')),
        'labelOptions' => array("label" => '')));
    echo "</td>";

    // service
    echo "<td class='qc2'>";
    echo $form->dropDownListGroup($quote_services, "[$i]id_service",array('widgetOptions'=>array('data'=>$dataService,'htmlOptions'=>array('required'=>true,'placeholder'=>'Số lượng','class'=>'group_services cal group')),'labelOptions' => array("label" => '')));
    echo $form->hiddenField($quote_services,"[$i]description",array('class'=>'quote_des','value'=>$serName));
    echo $form->hiddenField($quote_services,"[$i]errSegIt",array('class'=>'errSegIt', 'value' => 0));
    echo "</td>";

    // dentist
    if(!empty($user_dt))
        $usr = $user_dt;
    else
        $usr = $user;
    echo "<td class='qc3'>";
    echo $form->dropDownListGroup($quote_services, "[$i]id_user",array('widgetOptions'=>array('data'=>$usr,'htmlOptions'=>array('required'=>false,'class'=>'group_dentist')),'labelOptions' => array("label" => ''))); 
    echo "</td>";

    // so rang
    echo "<td class='qc4'>";
    echo $form->textFieldGroup($quote_services,"[$i]teeth",array('widgetOptions'=>array('htmlOptions'=>array('required'=>false,'placeholder'=>'Số răng','value'=>$teeth,'class'=>'cal_teeth inputW')),'labelOptions' => array("label" => '')));
    echo $form->hiddenField($quote_services,"[$i]qty",array('class'=>'cal_qty cal group_qty','value'=>1));
    echo "</td>"; ?>

    <!-- đơn giá -->
    <td class='qc5'>
    <div class="form-group">
        <label></label>
        <?php 
            echo CHtml::textField('unit_price',$unit,array('placeholder'=>'Đơn giá','readOnly' => true,'class'=>'inp_price group_unit cal_ans autoNum form-control')); 
            echo $form->hiddenField($quote_services,"[$i]unit_price",array('class'=>'s_group_unit','value'=>$unit));
        ?>
    </div>
    </td>

    <!-- Thuế -->
    <td class='qc6'>
    <div class="form-group">
        <label></label>
        <?php 
            echo CHtml::textField('tax',$tax,array('placeholder'=>'Thuế','readOnly' => true,'class'=>'inp_price group_tax cal_tax cal_ans autoNum form-control')); 
            echo $form->hiddenField($quote_services,"[$i]tax",array('class'=>'s_group_tax','value'=>$tax));
        ?>
    </div>
    </td>

    <!-- Thành tiền -->
    <td class='qc7'>
    <div class="form-group">
        <label></label>
        <?php 
            echo CHtml::textField('amount',$sum,array('placeholder'=>'Thành tiền','readOnly' => true,'class'=>'inp_price group_amount cal_ans cal_sum autoNum form-control')); 
            echo $form->hiddenField($quote_services,"[$i]amount",array('class'=>'s_group_amount','value'=>$sum));
        ?>
    </div>
    </td>

    <td class="qc8">
        <span data-toggle="tooltip" title="Điều trị" style="padding-left: 10px;">
            <?php
                echo $form->checkBox($quote_services,"[$i]status",array('class'=>'chk'));
                echo $form->hiddenField($quote_services,"[$i]quote_old",array('value'=>'0'));
            ?>
        </span>
        <span style="padding: 5px;">
            <a href="" data-toggle="tooltip" title="Khuyến mãi" class="sCDiscount"><img src="<?php echo $baseUrl; ?>/images/icon_sb_left/sale.png" class="sIcon addIDis" alt=""></a>
        </span>
        <span>
            <a href="" data-toggle="tooltip" title="Xóa" class="sCDiscount"><img src="<?php echo $baseUrl; ?>/images/icon_sb_left/delete-def.png" class="sIcon remove_field" alt=""></a>
        </span>
    </td>
</tr>

<script>
    $(function(){
        var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
        $('.autoNum').autoNumeric('init',numberOptions);
    })
</script>