<?php $baseUrl = Yii::app()->getBaseUrl(); 
    $user_name =  Yii::app()->user->user_name;
    $user_id = Yii::app()->user->user_id;?>

<style>
/*table*/
.tableQuote thead tr th{
  background: #8ca7ae;
  border-right: 1px solid #fff;
  color: #fff;
  font-weight: 300;
}
.errors {border: 1px solid red;}
.tableQuote tbody tr td {
  background: #f1f5f6;
}

.tableQuote tbody input {
  background: #f1f5f6;
}

.sbtnAdd {padding: 1px 25px;}

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
.qc7 .sCDiscount{
    padding-right: 6px;
}
.addIDis {width: 19px !important;}
.DisPop {
    width: 300px;
}

/** Bang chi tiet dich vu bao gia **/
.inputW {
    background: white !important;
    border    : 0;
}
#sProduct {padding: 0 18px;}
#frm-quote table thead {
    display     : table;
    width       : 100%;
    table-layout: fixed;
}
#sProduct table th {padding: 10px 5px !important;vertical-align: middle;}
#sProduct table td {padding: 0px !important; border: 0;}
#frm-quote table tbody {
    display   : block;
    overflow  : auto;
    max-height: 198px;
    height    : 100%;
}
#frm-quote table tbody tr{
    display      : table;
    width        : 100%;
    table-layout : fixed;
}
.tableQuote tbody .form-group {
    margin: -13px 1px 5px;
}
#frm-quote input[type=checkbox] {
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

    #frm-quote #sAddNote {margin-bottom: 15px;}
    #frm-quote .form-control[disabled] {background: white; border: 0; box-shadow: none; cursor: default;}

    #sSumo {padding-top: 10px; margin-top: 10px;}

    .q_label {margin-top: 8px;}
    select.select2-hidden-accessible {bottom: 1%;}
    
    .sNote {color: #48b64e;}

    #addDis {
        cursor: pointer;
    }

</style>

<div class="modal-dialog pop_bookoke modal-lg" style="width: 1170px; padding-top: 95px;">
    <div class="modal-content quote-container">

        <div class="modal-header popHead">
            <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
            <h5>Lập Báo Giá</h5>
        </div> <!-- modal-header -->

    <div class="modal-body">
        <div class="row">

<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
     array(
        'id' => 'frm-quote',
        'enableAjaxValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit'=>true,
            'validateOnChange'=>true,
            'validateOnType'=>true,
        ),
        'enableClientValidation'=>true,
        'htmlOptions'=>array(  
            'enctype'   => 'multipart/form-data'                        
        ),
    )
); ?>

<?php
    $branch             =   Branch::model()->findAll();
    $branchList         =   CHtml::listData($branch, 'id', 'name');
    
    echo "<div class='col-md-4'>";      // văn phòng
    echo $form->dropDownListGroup($quote, 'id_branch',
        array(
            'widgetOptions' => array(
                'required'=>true,
                'data' => $branchList,
                'htmlOptions' => array('required'=>true),
    )));
    echo "</div>";

    echo "<div class='col-md-2'>";      // ngày tạo
    echo $form->textFieldGroup($quote, 'create_date',
        array('widgetOptions' => array(
                'htmlOptions'=>array('class'=>'frm_datepicker','required'=>true)
        )));
    echo "</div>";

    echo "<div class='col-md-2'>";      // ngày hạch toán
    echo $form->textFieldGroup($quote, 'complete_date',
        array('widgetOptions' => array(
                'htmlOptions'=>array('class'=>'frm_datepicker','required'=>true)
        )));
    echo "</div>";

    echo "<div class='col-md-3'>";      // Người tạo
    echo $form->labelEx($quote,'id_author');
    echo $form->hiddenField($quote,'id_author',array('value'=>$user_id));
    echo CHtml::textField('author',$user_name,
        array('class'=>'form-control', 'readOnly'=>true,'required'=>true
    ));
    echo "</div>";
    echo "<div class='clearfix'></div>";

    echo "<div class='col-md-4'>";      // Khách hàng
    if($id_customer){
        $quote->id_customer = $id_customer;
        $defaulCustomer = "id=".$id_customer."";
        echo $form->dropDownListGroup($quote,
        'id_customer',
        array('widgetOptions'=>array('data'=>CHtml::listData(Customer::model()->findAll($defaulCustomer),'id', 'fullname'),
            'htmlOptions'=>array('required'=>'required','readonly'=>'readonly','options'=>array($id_customer=>array('selected'=>'selected')) ))));
    }else{
    echo $form->dropDownListGroup($quote, 'id_customer',
        array('widgetOptions' => array(
                'htmlOptions'=>array('class'=>'frm_datepicker','required'=>true)
        )));
    }   
    if($id_group_history){
        echo $form->hiddenField($quote,'id_group_history',array('value'=>$id_group_history));
    }
    echo "</div>";

    $disCusSeg = (!empty($cus_Seg)) ? "" : "style='display:none;'";
    echo "<div class='col-md-3 showSeg' $disCusSeg>";      // Nhóm khách hàng
    echo $form->dropDownListGroup($quote, 'id_segment',
        array(
            'widgetOptions' => array(
                'data'        => CHtml::listData($cus_Seg,'id_segment','name'),
                'htmlOptions' => array('class'=>'choseSeg'),
            ),
            'labelOptions'  => array('label' => 'Nhóm khách hàng')
            ));
    echo $form->hiddenField($quote,'segment_description', array('class' => 'segTxt'));
    echo "</div>";
?>

<input type="hidden" name="Quotation[id_schedule]" value="<?php echo $id_schedule; ?>">
<input type="hidden" name="Quotation[currency_use]" id="currency_user" value="VND">
<input type="hidden" name="Quotation[priceBook]" id="priceBook" value="">
        
<div id="sProduct" class="col-md-12">
    <table class="table tableQuote sItem">
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
            <?php   
                $dataService = array();
                $unit = 0;
                $tax = 0;
                $sum = 0;
                $serName = '';
                if($service) {
                    $dataService = array($service['id']=>$service['name']);
                    $serName = $service['name'];
                    $unit = (int)$service['price'];
                    $tax = ((int)$service['price'] * (int)$service['tax'])/100;
                    $sum = $unit + $tax;
             } ?>
            <?php $this->renderPartial('create_item',array(
                    'quote_services' =>  $quote_services,
                    'form'           =>  $form,
                    'dataService'    =>  $dataService,
                    'user'           =>  array($user_id=>$user_name),
                    'serName'        =>  $serName,
                    'user_dt'        =>  $user_dt,
                    'unit'           =>  $unit,
                    'tax'            =>  $tax,
                    'sum'            =>  $sum,
                    'i'              =>  $i,
                    'teeth'          =>  $teeth
                )); ?>
        </tbody>
    </table>
</div>

<div class="col-md-12 errorSeg error" style="display: none;">Dịch vụ này chưa được tạo trong nhóm!</div>

<div id="sSumo" class="col-md-12">
    <div class="row">
        <div id="sMore" class="col-md-5">
            <button id="addProduct" class="btn sbtnAdd newbtnAdd btn_unactive"><span class="glyphicon glyphicon-plus"></span> Sản phẩm</button>
            <button id="addServices" class="btn sbtnAdd newbtnAdd btn_unactive"><span class="glyphicon glyphicon-plus"></span> Dịch vụ</button>
        </div>
        <div id="sInvoice" class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <label class="col-md-6 text-right q_label control-label" for="sum_tax">Bao gồm thuế</label>
                        <div class='col-md-5'>
                            <?php 
                                echo CHtml::textField('sum_tax',$tax,array(
                                    'required'      =>'required',
                                    'placeholder'   =>'N/A',
                                    'readOnly'      =>true,
                                    'class'         =>'cal_ans autoNum form-control text-right pop_quote')); 
                                echo $form->hiddenField($quote,'sum_tax',array('id'=>'s_sum_tax','value'=>$tax));
                            ?>
                        </div>
                        <label class="q_label curUnit" for="sum_tax">VND</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <label class="col-md-6 text-right q_label control-label" for="sum_amount">Tổng cộng</label>
                        <div class='col-md-5'>
                            <?php 
                                echo CHtml::textField('sum_amount',$sum,array('required'=>'required','placeholder'=>'N/A','readOnly'=>true,'class'=>'cal_ans autoNum form-control text-right'));
                                echo $form->hiddenField($quote,'sum_amount',array('id'=>'s_sum_amount','value'=>$sum));
                            ?>
                        </div>
                        <label class="q_label curUnit">VND</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1">
            <a data-toggle="tooltip" title="Khuyến mãi" class="addDis" style="cursor: pointer;"><img style="margin: 0; padding-top: 39.5px; width: 22px;" src="<?php echo $baseUrl; ?>/images/icon_sb_left/sale.png" alt=""></a>
        </div>
    </div>
</div>

<div id="sCheck" class="col-md-12">
    <div class="col-md-6">
      <a href="#" class="sNote">Thêm ghi chú</a>
    </div>
</div>

<div id="sAddNote" class="col-md-12 hidden">
    <?php echo $form->textAreaGroup($quote,'note',array('widgetOptions'=>array('htmlOptions'=>array()),'labelOptions' => array("label" => 'Ghi chú'))); ?>
</div>
<?php $group_id =Yii::app()->user->getState('group_id'); ?>
<div id="sFooter" class="col-md-12 text-right"> 
    <button class="btn sCancel btn_cancel" data-dismiss="modal">Hủy</button>
    <?php if ($roleNew == 1): ?>
        <button class="btn Submit btn_bookoke" id="sSubmit" type="submit">Xác nhận</button>
    <?php endif ?>
</div>
<?php include 'newPromotion.php';?>
</div>
</div>
</div>
</div>

<?php include 'create_js.php'; ?>
<?php
$this->endWidget();
unset($form);?>