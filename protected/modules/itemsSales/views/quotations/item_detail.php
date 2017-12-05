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

    echo "<td class='qc2'>";
    echo $form->dropDownListGroup($quote_services, "[$i]id_service",array('widgetOptions'=>array('htmlOptions'=>array('required'=>true,'placeholder'=>'Số lượng','class'=>'group_services cal group')),'labelOptions' => array("label" => '')));
    echo $form->hiddenField($quote_services,"[$i]description",array('class'=>'quote_des'));
    echo $form->hiddenField($quote_services,"[$i]errSegIt",array('class'=>'errSegIt', 'value' => 0));
    echo "</td>";

    // dentist
    $arrUser = array(Yii::app()->user->getState('user_id')=>Yii::app()->user->getState('user_name')); 
    echo "<td class='qc3'>";
    echo $form->dropDownListGroup($quote_services, "[$i]id_user",array('widgetOptions'=>array('data'=>$arrUser,'htmlOptions'=>array('required'=>false,'placeholder'=>'Số lượng','class'=>'group_dentist quote_id_user_'.$i)),'labelOptions' => array("label" => ''))); 
    echo "</td>";

    // so rang
    echo "<td class='qc4'>";
    echo $form->textFieldGroup($quote_services,"[$i]teeth",array('widgetOptions'=>array('htmlOptions'=>array('required'=>false,'placeholder'=>'Số răng','class'=>'cal_teeth inputW')),'labelOptions' => array("label" => '')));
    echo $form->hiddenField($quote_services,"[$i]qty",array('class'=>'cal_qty cal group_qty','value'=>1));
    echo "</td>"; ?>

    <!-- đơn giá -->
    <td class='qc5'>
    <div class="form-group">
        <label></label>
        <?php 
            echo CHtml::textField('unit_price','0',array('placeholder'=>'Đơn giá','readOnly' => true,'class'=>'inp_price group_unit cal_ans autoNum form-control',)); 
            echo $form->hiddenField($quote_services,"[$i]unit_price",array('class'=>'s_group_unit'));
        ?>
    </div>
    </td>

    <!-- Thuế -->
    <td class='qc6'>
    <div class="form-group">
        <label></label>
        <?php 
            echo CHtml::textField('tax','0',array('placeholder'=>'Thuế','readOnly' => true,'class'=>'inp_price group_tax cal_ans cal_tax autoNum form-control')); 
            echo $form->hiddenField($quote_services,"[$i]tax",array('class'=>'s_group_tax'));
        ?>
    </div>
    </td>

    <!-- Thành tiền -->
    <td class='qc7'>
    <div class="form-group">
        <label></label>
        <?php 
            echo CHtml::textField('amount','0',array('placeholder'=>'Thành tiền','readOnly' => true,'class'=>'inp_price group_amount cal_ans cal_sum autoNum form-control')); 
            echo $form->hiddenField($quote_services,"[$i]amount",array('class'=>'s_group_amount'));
        ?>
    </div>
    </td>

    <td class='qc8'>
        <span data-toggle="tooltip" title="Điều trị" style="padding-left: 10px;">
            <?php
                echo $form->checkBox($quote_services,"[$i]status",array('class'=>'chk'));
                echo $form->hiddenField($quote_services,"[$i]quote_old",array('value'=>'0'));
                echo $form->hiddenField($quote_services,"[$i]id");
            ?>
        </span>
        <span style="padding: 5px;">
            <a href="" data-toggle="tooltip" title="Giảm giá" class="sCDiscount"><img src="<?php echo $baseUrl; ?>/images/icon_sb_left/sale.png" class="sIcon addIDis" alt=""></a>
        </span>
        <span>
            <a href="" data-toggle="tooltip" title="Xóa" class="sCDiscount"><img src="<?php echo $baseUrl; ?>/images/icon_sb_left/delete-def.png" class="sIcon remove_field" alt=""></a>
        </span>
    </td>
</tr>

<script>
$('[data-toggle="tooltip"]').tooltip();
</script>