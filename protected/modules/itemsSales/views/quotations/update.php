<?php $baseUrl = Yii::app()->getBaseUrl(); 
    $user_name =  Yii::app()->user->user_name;
    $user_id = Yii::app()->user->user_id;?>

<style>
/*table*/
.tableQuote thead tr th{
  background  : #8ca7ae;
  border-right: 1px solid #fff;
  color       : #fff;
  font-weight : 300;
}
.tableQuote tbody tr td {
  background: #f1f5f6;
}
.tableQuote tbody .form-group {
  margin: -9px 0 5px;
}
.tableQuote tbody input {
  background: #f1f5f6;
}

.select2-container--disabled.select2-container--bootstrap .select2-selection--single {
    background: transparent;
}
.select2-container--disabled .select2-selection__arrow{
    display: none;
}

.sbtnAdd {padding: 1px 25px;}
#sCheck {padding-top: 20px;}

.cal_ans {
background: transparent !important;
  border: 0; 
  box-shadow: none; 
  cursor: default;
}
.tableQuote .select2-container--bootstrap .select2-selection--single {
  border: 0;
}

.inp_price {padding: 6px 4px;text-align: right;}

.sIcon {width: 14px;margin-top: -6px;}
.addIDis {width: 19px;}

/** Bang chi tiet dich vu bao gia **/
.inputW {
    background: white !important;
    border    : 0;
}
#usProduct {padding: 0 18px;}
#frm-update-quote table thead {
    display     : table;
    width       : 100%;
    table-layout: fixed;
}
#usProduct table th {padding: 10px 5px !important;vertical-align: middle;}
#usProduct table td {padding: 0px !important; border: 0;}
#frm-update-quote table tbody {
    display   : block;
    overflow  : auto;
    max-height: 198px;
    height    : 100%;
}
#frm-update-quote table tbody tr{
    display      : table;
    width        : 100%;
    table-layout : fixed;
}
.tableQuote tbody .form-group {
    margin: -13px 1px 5px;
}
#frm-update-quote input[type=checkbox] {
    margin-top: 16px;
}
.sIcon {width: 14px; margin-top: -8px;}
/*.qc1{width: 250px;}*/     /*Chuan doan*/
.qc2{width: 250px;}         /*Dich vu va san pham*/
.qc3{width: 151px;}         /*nguoi thuc hien*/
.qc4{width: 110px;}         /*So rang*/
.qc5{width: 101px;}          /*don gia*/
.qc6{width: 90px;}         /*Thue*/
.qc7{width: 105px;}         /*Thanh tien*/
.qc8{width: 90px;}          /*ap dung*/
td.qc8 {text-align: left;}

   
    #frm-update-quote #sAddNote {margin-bottom: 15px;}
   
    #frm-update-quote .cal_ans {background: white; border: 0; box-shadow: none; cursor: default;}
    #frm-update-quote .select2-container--disabled .select2-selection{cursor: default;}

    #sSumo {padding-top: 10px;  margin-top: 10px;}
    #sInvoice {padding-bottom: 10px;}
    #sIFax {border-bottom: 1px solid #ddd;padding-bottom: 8px;margin-bottom: 8px;}
   
    #upAddDis {
        cursor: pointer;
    }

    #upAddDisPop {
        top      : 2.4em;
        left     : -10.5em;
        z-index  : 1000;
        max-width: 350px;
        width    : 350px;
    }

    .uppIDisPop {
        width: 350px;
    }
</style>

<div class="modal-dialog pop_bookoke modal-lg" style="width: 1170px; padding-top: 95px;">
    <div class="modal-content quote-edit-container">

    <div class="modal-header popHead">
        <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
        <h5>Cập Nhật Báo Giá </h5>
    </div>

    <div class="modal-body">
        <div class="row">

<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	 array(
        'id' => 'frm-update-quote',
        'enableAjaxValidation'=>false,
        'clientOptions' => array(
            'validateOnSubmit'=>true,
            'validateOnChange'=>true,
            'validateOnType'=>true,
        ),
        'htmlOptions'=>array(  
            'enctype'   => 'multipart/form-data'                        
        ),
    )
); ?>
 <?php echo CHtml::errorSummary($quote) ?> 
<?php
    echo $form->hiddenField($quote,'id');
	echo "<div class='col-md-4'>";		// văn phòng
	echo $form->dropDownListGroup($quote, 'id_branch',
		array(
			'widgetOptions' => array(
				'data' => $branchList,
				'htmlOptions' => array(),
	)));
	echo "</div>";

	echo "<div class='col-md-2'>";     // ngày tạo
    echo $form->textFieldGroup($quote, 'create_date',
        array('widgetOptions' => array(
                'htmlOptions'=>array(
                    'class'=>'',
                    'value'=>date_format(date_create($quote['create_date']),'d/m/Y'),
                    'readOnly'=>true)
        )));
    echo "</div>";

    echo "<div class='col-md-2'>";      // ngày hạch toán
    echo $form->textFieldGroup($quote, 'complete_date',
        array('widgetOptions' => array(
                'htmlOptions'=>array('class'=>'frm_datepicker',
                    'value'=>date_format(date_create($quote['complete_date']),'d/m/Y'),
                )
        )));
    echo "</div>";

	echo "<div class='col-md-3'>";		// Người tạo
	echo $form->labelEx($quote,'id_author');
	echo $form->hiddenField($quote,'id_author',array('value'=>$user_id));
	echo CHtml::textField('author',$quote['author_name'],
		array('class'=>'form-control', 'readOnly'=>true
	));
	echo "</div>";
	echo "<div class='clearfix'></div>";

	echo "<div class='col-md-4'>";		// Khách hàng
	echo $form->textFieldGroup($quote, 'customer_name',
        array('widgetOptions' => array(
                'htmlOptions'=>array('readOnly'=>true)
        )));
	echo "</div>";
    echo $form->hiddenField($quote,'id_customer',array('value'=>$quote['id_customer']));

    if($quote['id_segment']) {
        echo "<div class='col-md-3'>";      // Nhóm khách hàng
        echo $form->dropDownListGroup($quote, 'id_segment',
            array(
                'widgetOptions' => array(
                    'data'        => array($quote['id_segment']=>$quote['segment_description']),
                    'htmlOptions' => array('readOnly'=>true, 'class' => 'choseSegUp'),
                ),
                'labelOptions'  => array('label' => 'Nhóm khách hàng')
                ));
        echo "</div>";
    }
?>

<?php if (isset($NowCusSeg[0]['id_segment']) && $NowCusSeg[0]['id_segment'] != $quote->id_segment): ?>
    <div class="col-md-12 text-center" style="margin-bottom: 5px; font-style: italic; color: red;">Khách hàng <?php echo $quote->customer_name; ?> hiện đang thuộc nhóm <?php echo $NowCusSeg[0]['name']; ?></div>
<?php endif ?>
<input type="hidden" name="VQuotations[id_schedule]" value="<?php echo $id_schedule; ?>">
<input type="hidden" name="VQuotations[priceBook]" id="priceBookUp" value="">
<input type="hidden" name="VQuotations[currency_use]" value="<?php echo $quote['currency_use']; ?>">

<div id="usProduct" class="col-md-12 product">
    <table class="table sItem tableQuote">
        <thead>
            <tr>
                <th class="qc1">Chuẩn đoán</th>
                <th class="qc2">Sản phẩm và Dịch vụ</th>
                <th class="qc3">Người thực hiện</th>
                <th class="qc4">Răng số</th>
                <th class="qc5">Đơn giá</th>
                <th class="qc6">Thuế</th>
                <th class="qc7">Thành tiền</th>
                <th class="qc8">Áp dụng</th>
            </tr>
        </thead>
        <tbody>
            <?php $this->renderPartial('update_item',array(
                'quote_services'=>$quote_services,
                'form'          =>$form,
                'i'             =>$i,
            ));?>
        </tbody>
    </table>
</div>

<div id="sSumo" class="col-md-12">
    <div class="row">
        <div id="sMore" class="col-md-5">
            <button id="upAddProduct" class="btn sbtnAdd upsbtnAdd btn_bookoke"><span class="glyphicon glyphicon-plus"></span> Sản phẩm</button>
            <button id="upAddServices" class="btn sbtnAdd upsbtnAdd btn_bookoke"><span class="glyphicon glyphicon-plus"></span> Dịch vụ</button>
            <!-- <button id="" class="btn sbtnAdd"><span class="glyphicon glyphicon-plus"></span> Lịch hẹn</button> -->
        </div>
        <div id="sInvoice" class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <label class="col-md-6 text-right q_label control-label" for="sum_tax">Bao gồm thuế</label>
                        <div class='col-md-5'>
                            <?php 
                                echo CHtml::textField('u_sum_tax',$quote['sum_tax'],array('required'=>'required','placeholder'=>'N/A','readOnly'=>true,'class'=>'cal_ans text-right autoNum form-control')); 
                                echo $form->hiddenField($quote,'sum_tax',array('id'=>'us_sum_tax'));
                            ?>
                        </div>
                        <label class="q_label" for="sum_tax"><?php echo $quote['currency_use']; ?></label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <label class="col-md-6 text-right q_label control-label" for="sum_amount">Tổng cộng</label>
                        <div class='col-md-5'>
                            <?php 
                            echo CHtml::textField('u_sum_amount',$quote['sum_amount'],array('required'=>'required','placeholder'=>'N/A','readOnly'=>true,'class'=>'cal_ans text-right autoNum form-control'));
                            echo $form->hiddenField($quote,'sum_amount',array('id'=>'us_sum_amount'));
                        ?>
                        </div>
                        <label class="q_label"><?php echo $quote['currency_use']; ?></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1">
            <a data-toggle="tooltip" title="Giảm giá" class="upAddDis" style="cursor: pointer;"><img style="margin: 0; padding-top: 37px; width: 22px;" src="<?php echo $baseUrl; ?>/images/icon_sb_left/sale.png" class="" alt=""></a>
        </div>
    </div>
</div>

<div id="sCheck" class="col-md-12">
    <div class="col-md-6">
      <a href="#" class="sNote">Thêm ghi chú</a>
    </div>
</div>

<div id="usAddNote" class="col-md-12 hidden">
    <?php echo $form->textAreaGroup($quote,'note',array('widgetOptions'=>array('htmlOptions'=>array()),'labelOptions' => array("label" => 'Ghi chú'))); 
        echo $form->hiddenField($quote,'id_note');
    ?>
</div>

<div id="sFooter" class="col-md-12 text-right"> 
    <button class="btn sCancel btn_cancel" data-dismiss="modal">Hủy</button>
     <?php if ($roleUp == 1): ?>
        <button class="btn Submit btn_bookoke qsub" id="sSubmit" type="submit">Xác nhận</button>
    <?php endif ?>
</div>
<?php include 'newPromotion.php';?>
</div>
</div>
</div>
<?php include 'update_js.php';?>
<?php
$this->endWidget();
unset($form);?>