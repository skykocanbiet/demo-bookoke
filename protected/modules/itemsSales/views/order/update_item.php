<?php $baseUrl = Yii::app()->getBaseUrl(); ?>

<?php foreach ($orderDetailOld as $key => $value): ?>
<tr class="currentRow t<?php echo $key; ?>">

<?php 
    $readOnly = $value['status']    ?   'readOnly' : '';
    $disabled = $value['status']    ?   true       : false;
    $key      = $key + 1;
    $clsRea = ($value['status'])   ?   'cal_ans'   : '';

    // service
    echo "<td class='padding_left_0 qc1'>";
     if ($value['id_service'] != '' && $value['id_service'] != 0) {
        echo $form->dropDownListGroup($value, "[$key]id_service",array('widgetOptions'=>array('data'=>array($value['id_service']=>$value['description']),'htmlOptions'=>array('required'=>false,'placeholder'=>'Số lượng','class'=>"group_services cal group $clsRea",'disabled'=>$disabled)),'labelOptions' => array("label" => ''))); 
    }
    elseif ($value['id_product'] != '' && $value['id_product'] != 0) {
        echo $form->dropDownListGroup($value, "[$key]id_product",array('widgetOptions'=>array('data'=>array($value['id_product']=>$value['description']),'htmlOptions'=>array('required'=>false,'placeholder'=>'Số lượng','class'=>'group_product cal group '.$clsRea,'disabled'=>$disabled)),'labelOptions' => array("label" => ''))); 
    }
    elseif ($value['id_discount'] != '' && $value['id_discount'] !=0) {
        echo $form->hiddenField($value,"[$i]id_discount",array('value'=>$value['id_discount']));
        echo $form->textFieldGroup($value,"[$i]description",array('widgetOptions'=>array('htmlOptions'=>array('required'=>false,'class'=>'cal_ans','readonly'=>true, 'value'=>$value['description'])),'labelOptions' => array("label" => '')));
    }
    echo $form->hiddenField($value,"[$i]description",array('class'=>'quote_des'));
    echo "</td>";

    // dentist
    echo "<td class='qc2'>";
    echo $form->dropDownListGroup($value, "[$key]id_user",array('widgetOptions'=>array('data'=>array($value['id_user']=>$value['user_name']),'htmlOptions'=>array('required'=>false,'placeholder'=>'Số lượng','class'=>'group_dentist '.$clsRea,'disabled'=>$disabled)),'labelOptions' => array("label" => ''))); 
    echo "</td>";

    // so rang
    echo "<td class='qc3'>";
    if ($value['id_discount'] != '' || $value['id_voucher'] != '') {
        echo $form->textFieldGroup($value,"[$key]qty",array('widgetOptions'=>array('htmlOptions'=>array('required'=>false,'placeholder'=>'Số lượng','class'=>'cal_ans','readonly'=>true)),'labelOptions' => array("label" => '')));
    }
    else {
        $w = (!$clsRea) ? 'inputW' : '';
        echo $form->textFieldGroup($value,"[$key]qty",array('widgetOptions'=>array('htmlOptions'=>array('required'=>false,'placeholder'=>'Số lượng','class'=>"cal group_qty $clsRea $w",$readOnly=>$readOnly)),'labelOptions' => array("label" => '')));
    }
    echo "</td>"; ?>

    <!-- đơn giá -->
    <td class='qc4'>
    <div class="form-group">
        <label></label>
        <?php 
            echo CHtml::textField('unit_price',$value['unit_price'],array('placeholder'=>'Đơn giá','readOnly' => true,'class'=>'inp_price group_unit cal_ans autoNum form-control')); 
            echo $form->hiddenField($value,"[$key]unit_price",array('class'=>'s_group_unit'));
       ?>
    </div>
    </td>

     <!-- Thuế -->
    <td class='qc5'>
    <div class="form-group">
        <label></label>
        <?php 
            echo CHtml::textField('tax',$value['tax'],array('placeholder'=>'Thuế','readOnly' => true,'class'=>'inp_price group_tax cal_tax cal_ans autoNum form-control')); 
            echo $form->hiddenField($value,"[$key]tax",array('class'=>'s_group_tax'));
        ?>
    </div>
    </td>

    <!-- Thành tiền -->
    <td class='qc6'>
    <div class="form-group">
        <label></label>
        <?php 
            echo CHtml::textField('amount',$value['amount'],array('placeholder'=>'Thành tiền','readOnly' => true,'class'=>'inp_price group_amount cal_ans cal_sum autoNum form-control')); 
            echo $form->hiddenField($value,"[$key]amount",array('class'=>'s_group_amount'));
        ?>
    </div>
    </td>

<?php 
    echo "<td class='qc7'>";
    echo $form->checkBox($value,"[$key]status",array('class'=>'chk chk_remove','disabled'=>$disabled));
    $status = $value['status'];
    echo $form->hiddenField($value,"[$key]order_old",array('value'=>$status));
    echo $form->hiddenField($value,"[$key]id");
    echo $form->hiddenField($value,"[$key]del",array('value'=>0, 'class'=>'quote_del'));
?>

    <?php if ($value['amount'] >0): ?>
        <a href="" data-toggle="tooltip" title="Giảm giá" class="sCDiscount"><img src="<?php echo $baseUrl; ?>/images/icon_sb_left/sale.png" class="sIcon addIDis" alt=""></a>
    <?php endif ?>
    <?php if ($status == 0): ?>
        <a href="" title="Xóa" class="sCDiscount"><img src="<?php echo $baseUrl; ?>/images/icon_sb_left/delete-def.png" class="sIcon remove_field" alt=""></a>
    <?php endif ?>
</td>

</tr>
<?php endforeach ?>