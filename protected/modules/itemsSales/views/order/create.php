
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
.tableQuote tbody tr td {
  background: #f1f5f6;
}
.tableQuote tbody .form-group {
  margin: -9px 0 5px;
}
.tableQuote tbody input {
  background: #f1f5f6;
}

#frm-order input[type=checkbox] {
    margin: 19px 5px 0 0;
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
.inputW {
  background: white !important;
  border: 0;
}

#sProduct table td {padding: 0 2px; border: 0;}
.inp_price {padding: 6px 4px;text-align: right;}

#addDisPop {
    top: 4.5em;
    left: -10.5em;
    z-index: 1000;
    max-width: 350px;
    width: 350px;
}

.addIDisPop {
    top: 5.1em;
    left: 14.5em;
    z-index: 99999;
    max-width: 350px;
    width: 350px;
}
.qc7 .sCDiscount{
    padding-left: 6px;
}
.addIDis {width: 19px !important;}
/***/

    #frm-order #sAddNote {margin-bottom: 15px;}
    .sIcon {width: 14px; margin-top: -6px;}
    #frm-order .form-control[disabled] {background: white; border: 0; box-shadow: none; cursor: default;}
    #sProduct {max-height: 250px; overflow: auto; padding: 0 18px;}

    #sSumo {padding-top: 10px; margin-top: 10px;}

    .q_label {margin-top: 8px;}
    select.select2-hidden-accessible {bottom: 1%;}

    
    .sNote {color: #48b64e;}

    #frm-order table thead {
        display: table;
        width: 100%;
        table-layout: fixed;
    }
    #frm-order table tbody {
        display: block;
        overflow: auto;
        max-height: 200px;
        margin-right: -17px;
    }
    #frm-order table tbody tr{
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    .qc1{width: 250px;}
    .qc2{width: 150px;}
    /*.qc3{width: 67px;}*/
    .qc4{width: 110px;}
    .qc5{width: 90px;}
    .qc6{width: 115px;}
    .qc7{width: 75px; text-align: left;}

    #addDis {
        cursor: pointer;
    }

</style>

<div class="modal-dialog pop_bookoke modal-lg" style="width: 930px; padding-top: 95px;">
    <div class="modal-content quote-container">

    <div class="modal-header popHead">
        <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
        <h5>Lập Đơn hàng</h5>
    </div>

    <div class="modal-body">
        <div class="row">

<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	 array(
        'id' => 'frm-order',
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
    $branch     =   Branch::model()->findAll();
    $branchList =   CHtml::listData($branch, 'id', 'name');
    
    echo "<div class='col-md-4'>";      // văn phòng
    echo $form->dropDownListGroup($order, 'id_branch',
        array(
            'widgetOptions' => array(
                'required'    =>true,
                'data'        => $branchList,
                'htmlOptions' => array('required'=>true),
            ),
            'labelOptions'=>array('label'=>'Văn phòng'),
        ));
    echo "</div>";

    echo "<div class='col-md-2'>";      // ngày tạo
    echo $form->textFieldGroup($order, 'create_date',
        array('widgetOptions' => array(
                'htmlOptions'=>array('class'=>'frm_datepicker','required'=>true)
        ),
            'labelOptions'=>array('label'=>'Ngày tạo'),
        ));
    echo "</div>";

    echo "<div class='col-md-2'>";      // ngày hạch toán
    echo $form->textFieldGroup($order, 'complete_date',
        array('widgetOptions' => array(
                'htmlOptions'=>array('class'=>'frm_datepicker','required'=>true)
        ),
            'labelOptions'=>array('label'=>'Ngày hoàn tất'),
        ));
    echo "</div>";

    echo "<div class='col-md-3'>";      // Người tạo
    echo $form->labelEx($order,'Người tạo');
    echo $form->hiddenField($order,'id_author',array('value'=>$user_id));
    echo CHtml::textField('author',$user_name,
        array('class'=>'form-control', 'readOnly'=>true,'required'=>true
    ));
    echo "</div>";
    echo "<div class='clearfix'></div>";

    echo "<div class='col-md-4'>";      // Khách hàng
    if($id_customer){
        $order->id_customer = $id_customer;
        $defaulCustomer = "id=".$id_customer."";
        echo $form->dropDownListGroup($order,
        'id_customer',
        array('widgetOptions'=>array('data'=>CHtml::listData(Customer::model()->findAll($defaulCustomer),'id', 'fullname'),
            'htmlOptions'=>array('required'=>'required','readonly'=>'readonly','options'=>array($id_customer=>array('selected'=>'selected')) ))));
    }else{
    echo $form->dropDownListGroup($order, 'id_customer',
        array('widgetOptions' => array(
                'htmlOptions'=>array('class'=>'frm_datepicker','required'=>true)
        )));
    }   
    if($id_group_history){
        echo $form->hiddenField($order,'id_group_history',array('value'=>$id_group_history));
    }
    echo "</div>";
?>

<input type="hidden" name="Order[id_schedule]" value="<?php echo $id_schedule; ?>">
        
<div id="sProduct" class="col-md-12">
    <table class="table tableQuote sItem">
        <thead>
            <tr>
                <th class="qc1">Sản phẩm và Dịch vụ</th>
                <th class="qc2">Người thực hiện</th>
                <th class="qc3">Số lượng</th>
                <th class="qc4">Đơn giá</th>
                <th class="qc5">Thuế</th>
                <th class="qc6">Thành tiền</th>
                <th class="qc7">Áp dụng</th>
            </tr>
        </thead>
        <tbody>
            <?php   
                $dataService = array();
                $unit = 0;
                $tax = 0;
                $sum = 0;
                $sv = '';
                if($service) {
                    $dataService = array($service['id']=>$service['name']);
                    $unit = (int)$service['price'];
                    $tax = ((int)$service['price'] * (int)$service['tax'])/100;
                    $sum = $unit + $tax;
                    $sv = $service['name'];
             } ?>
            <?php $this->renderPartial('create_item',array(
                    'orderDetail' =>  $orderDetail,
                    'form'           =>  $form,
                    'dataService'    =>  $dataService,
                    'des'            =>  $sv,
                    'user'           =>  $user,
                    'unit'           =>  $unit,
                    'tax'            =>  $tax,
                    'sum'            =>  $sum,
                    'i'              =>  1,
                )); ?>
        </tbody>
    </table>
</div>

<div id="sSumo" class="col-md-12">
    <div class="row">
        <div id="sMore" class="col-md-5">
            <button id="addProduct" class="btn sbtnAdd btn_bookoke"><span class="glyphicon glyphicon-plus"></span> Sản phẩm</button>
            <button id="addServices" class="btn sbtnAdd btn_bookoke"><span class="glyphicon glyphicon-plus"></span> Dịch vụ</button>
            <!-- <button id="" class="btn sbtnAdd"><span class="glyphicon glyphicon-plus"></span> Lịch hẹn</button> -->
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
                                echo $form->hiddenField($order,'sum_tax',array('id'=>'s_sum_tax','value'=>$tax));
                            ?>
                        </div>
                        <label class="q_label" for="sum_tax">VNĐ</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <label class="col-md-6 text-right q_label control-label" for="sum_amount">Tổng cộng</label>
                        <div class='col-md-5'>
                            <?php 
                                echo CHtml::textField('sum_amount',$sum,array('required'=>'required','placeholder'=>'N/A','readOnly'=>true,'class'=>'cal_ans autoNum form-control text-right'));
                                echo $form->hiddenField($order,'sum_amount',array('id'=>'s_sum_amount','value'=>$sum));
                            ?>
                        </div>
                        <label class="q_label">VNĐ</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1">
            <span data-toggle="tooltip" title="Giảm giá" id="addDis"><img style="margin: 0; padding-top: 37px; width: 22px;" src="<?php echo $baseUrl; ?>/images/icon_sb_left/sale.png" class="" alt=""></span>

            <div id="addDisPop" class="popover bottom DisPop" style="display: none;">
                <div class="arrow"></div>
                <h3 class="popover-title popHead"><span>Nhập giảm giá</span></h3>
                <div class="popover-content">
                    <div class="row">
                        <div class="col-xs-9">
                            <select name="" class="form-control" id="choseDisType">
                                <option value="0">Chọn giảm giá</option>
                                <option value="1" data-dis='10' data-type='%'>Giảm giá 1</option>
                                <option value="2" data-dis='15' data-type='%'>Giảm giá 2</option>
                            </select>
                        </div>
                        <div class="col-xs-12" style="padding-top: 15px;">
                            
                        </div>
                        <span class="help-block" id="parsley" style="color: #c72f29;font-weight:bold;"></span>    
                    </div>
                    <button id="cancelDis" type="button" class="cacelPop btn btn_cancel" style="min-width: 94px;margin-right: 0px;">Hủy</button>
                    <button type="button" id="alyDis" class="btn btn_bookoke" style="display: none;">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="sCheck" class="col-md-12">
    <div class="col-md-6">
      <a href="#" class="sNote">Thêm ghi chú</a>
    </div>
</div>

<div id="sAddNote" class="col-md-12 hidden">
    <?php //echo $form->textAreaGroup($order,'note',array('widgetOptions'=>array('htmlOptions'=>array()),'labelOptions' => array("label" => 'Ghi chú'))); ?>
</div>

<div id="sFooter" class="col-md-12 text-right"> 
    <button class="btn sCancel btn_cancel" data-dismiss="modal">Hủy</button>
    <button class="btn Submit btn_bookoke" id="sSubmit" type="submit">Xác nhận</button>
</div>

<!-- discount item -->
<div id="" class="popover bottom addIDisPop DisPop" style="display: none;">
    <div class="arrow"></div>
    <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;color:black;">Nhập giảm giá</h3>
    <div class="popover-content">
        <div class="row">
            <div class="col-xs-9">
                <select name="" class="form-control choseIDisType" id="">
                    <option value="0">Chọn giảm giá</option>
                    <option value="1" data-dis='10' data-type='%'>Giảm giá 1</option>
                    <option value="2" data-dis='15' data-type='%'>Giảm giá 2</option>
                </select>
            </div>
            <div class="col-xs-12" style="padding-top: 15px;">
                
            </div>
            <span class="help-block" id="parsley" style="color: #c72f29;font-weight:bold;"></span>    
        </div>
        <button id="" type="button" class="cancelIDis cacelPop btn btn_cancel" style="min-width: 94px;margin-right: 0px;">Hủy</button>
        <button type="button" id="" class="alyIDis btn btn_bookoke" style="display: none;">Xác nhận</button>
    </div>
</div>

</div>
</div>
</div>

<?php $this->renderPartial('create_js',array(
        'x'           =>1,
        'user_name'   =>$user_name,
        'orderDetail' =>$orderDetail,
        'form'        =>$form,
        'id_customer' =>$id_customer,
    )); ?>
<?php
$this->endWidget();
unset($form);?>