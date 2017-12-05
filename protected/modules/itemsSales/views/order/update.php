<?php $baseUrl = Yii::app()->getBaseUrl(); 
    $user_name =  Yii::app()->user->user_name;
    $user_id = Yii::app()->user->user_id;?>

<style>
#usProduct {
    max-height: 250px;
    overflow: auto;
    padding: 0 19px;
}
#frm-update-order table tbody {
    display: block;
    overflow: auto;
    max-height: 200px;
    margin-right: 0px;
}
/*table*/
.tableorder thead tr th{
  background  : #8ca7ae;
  border-right: 1px solid #fff;
  color       : #fff;
  font-weight : 300;
}
.tableorder tbody tr td {
  background: #f1f5f6;
}
.tableorder tbody .form-group {
  margin: -9px 0 5px;
}
.tableorder tbody input {
  background: #f1f5f6;
}

#frm-update-order input[type=checkbox] {
    margin: 19px 5px 0 0;
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
  text-align: left;
}
.tableorder .select2-container--bootstrap .select2-selection--single {
  border: 0;
}
.inputW {
  background: white !important;
  border: 0;
}

.inp_price {padding: 6px 4px;text-align: right;}

#usProduct table td {padding: 0 2px; border: 0;}
.sIcon {width: 14px;margin-top: -6px;}
.qc7 .sCDiscount{
    padding-left: 6px;
}
.addIDis {width: 19px !important;}
/***/

   
    #frm-update-order #sAddNote {margin-bottom: 15px;}
   
    #frm-update-order .cal_ans {background: white; border: 0; box-shadow: none; cursor: default;}
    #frm-update-order .select2-container--disabled .select2-selection{cursor: default;}

    #sSumo {padding-top: 10px;  margin-top: 10px;}
    #sInvoice {padding-bottom: 10px;}
    #sIFax {border-bottom: 1px solid #ddd;padding-bottom: 8px;margin-bottom: 8px;}

    #frm-update-order table thead {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    #frm-update-order table tbody tr{
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

<div class="modal-dialog pop_bookoke modal-lg" style="width: 930px; padding-top: 95px;">
    <div class="modal-content order-edit-container">

    <div class="modal-header popHead">
        <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
        <h5>Cập Nhật Đơn hàng </h5>
    </div>

    <div class="modal-body">
        <div class="row">   

<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	 array(
        'id' => 'frm-update-order',
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
 <?php echo CHtml::errorSummary($order) ?> 
<?php
    echo $form->hiddenField($order,'id');
	echo "<div class='col-md-4'>";		// văn phòng
	echo $form->dropDownListGroup($order, 'id_branch',
		array(
			'widgetOptions' => array(
				'data' => $branchList,
				'htmlOptions' => array(),
	       ),
            'labelOptions'=>array('label'=>'Văn phòng'),
        ));
	echo "</div>";

	echo "<div class='col-md-2'>";     // ngày tạo
    echo $form->textFieldGroup($order, 'create_date',
        array('widgetOptions' => array(
                'htmlOptions'=>array(
                    'class'=>'',
                    'value'=>date_format(date_create($order['create_date']),'d/m/Y'),
                    'readOnly'=>true)
            ),
            'labelOptions'=>array('label'=>'Ngày tạo'),
        ));
    echo "</div>";

    echo "<div class='col-md-2'>";      // ngày hạch toán
    echo $form->textFieldGroup($order, 'complete_date',
        array('widgetOptions' => array(
                'htmlOptions'=>array('class'=>'frm_datepicker',
                    'value'=>date_format(date_create($order['complete_date']),'d/m/Y'),
                )),
                'labelOptions'=>array('label'=>'Ngày hoàn tất'),
        ));
    echo "</div>";

	echo "<div class='col-md-3'>";		// Người tạo
	echo $form->labelEx($order,'Người tạo');
	echo $form->hiddenField($order,'id_author',array('value'=>$user_id));
	echo CHtml::textField('author',$order['author_name'],
		array('class'=>'form-control', 'readOnly'=>true
	));
	echo "</div>";
	echo "<div class='clearfix'></div>";

	echo "<div class='col-md-4'>";		// Khách hàng
	echo $form->textFieldGroup($order, 'customer_name',
        array('widgetOptions' => array(
                'htmlOptions'=>array('readOnly'=>true)
        ),
        'labelOptions'=>array('label'=>'Khách hàng'),
        ));
	echo "</div>";
?>
		
<div id="usProduct" class="col-md-12 product">
    <table class="table sItem tableorder">
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
            <?php include 'update_item.php';
            ?>
        </tbody>
    </table>
</div>

<div id="sSumo" class="col-md-12">
    <div class="row">
        <div id="sMore" class="col-md-5">
            <button id="upAddProduct" class="btn sbtnAdd btn_bookoke"><span class="glyphicon glyphicon-plus"></span> Sản phẩm</button>
            <button id="upAddServices" class="btn sbtnAdd btn_bookoke"><span class="glyphicon glyphicon-plus"></span> Dịch vụ</button>
            <!-- <button id="" class="btn sbtnAdd"><span class="glyphicon glyphicon-plus"></span> Lịch hẹn</button> -->
        </div>
        <div id="sInvoice" class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <label class="col-md-6 text-right q_label control-label" for="sum_tax">Bao gồm thuế</label>
                        <div class='col-md-5'>
                            <?php 
                                echo CHtml::textField('u_sum_tax',$order['sum_tax'],array('required'=>'required','placeholder'=>'N/A','readOnly'=>true,'class'=>'cal_ans autoNum form-control')); 
                                echo $form->hiddenField($order,'sum_tax',array('id'=>'us_sum_tax'));
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
                            echo CHtml::textField('u_sum_amount',$order['sum_amount'],array('required'=>'required','placeholder'=>'N/A','readOnly'=>true,'class'=>'cal_ans autoNum form-control'));
                            echo $form->hiddenField($order,'sum_amount',array('id'=>'us_sum_amount'));
                        ?>
                        </div>
                        <label class="q_label">VNĐ</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1">
            <span data-toggle="tooltip" title="Giảm giá" id="upAddDis"><img style="margin: 0; padding-top: 37px; width: 22px;" src="<?php echo $baseUrl; ?>/images/icon_sb_left/sale.png" class="sIcon" alt=""></span>
               
            <div id="upAddDisPop" class="popover bottom DisPop" style="display: none;">
                <div class="arrow"></div>
                <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;color:black;">Nhập giảm giá</h3>
                <div class="popover-content">
                    <div class="row">
                        <div class="col-xs-9">
                            <select name="" class="form-control" id="upChoseDisType">
                                <option value="0">Chọn giảm giá</option>
                                <option value="1" data-dis='10' data-type='%'>Giảm giá 1</option>
                                <option value="2" data-dis='15' data-type='%'>Giảm giá 2</option>
                            </select>
                        </div>
                        <div class="col-xs-12" style="padding-top: 15px;">
                            
                        </div>
                        <span class="help-block" id="parsley" style="color: #c72f29;font-weight:bold;"></span>    
                    </div>
                    <button id="upCancelDis" type="button" class="btn cacelPop btn_cancel" style="min-width: 94px;margin-right: 0px;">Hủy</button>
                    <button type="button" id="upAlyDis" class="btn btn_bookoke" style="display: none;">Xác nhận</button>
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

<div id="usAddNote" class="col-md-12 hidden">
    <?php echo $form->textAreaGroup($order,'note',array('widgetOptions'=>array('htmlOptions'=>array()),'labelOptions' => array("label" => 'Ghi chú'))); ?>
</div>
<div id="sFooter" class="col-md-12 text-right"> 
    <button class="btn sCancel btn_cancel" data-dismiss="modal">Hủy</button>
    <button class="btn Submit btn_bookoke" id="sSubmit" type="submit">Xác nhận</button>
</div>

<!-- discount item -->
<div id="" class="popover bottom uppIDisPop DisPop" style="display: none;">
    <div class="arrow"></div>
    <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;color:black;">Nhập giảm giá</h3>
    <div class="popover-content">
        <div class="row">
            <div class="col-xs-9">
                <select name="" class="form-control choseUppIDisType" id="">
                    <option value="0">Chọn giảm giá</option>
                    <option value="1" data-dis='10' data-type='%'>Giảm giá 1</option>
                    <option value="2" data-dis='15' data-type='%'>Giảm giá 2</option>
                </select>
            </div>
            <div class="col-xs-12" style="padding-top: 15px;">
                
            </div>
            <span class="help-block" id="parsley" style="color: #c72f29;font-weight:bold;"></span>    
        </div>
        <button id="" type="button" class="cancelUppIDis cacelPop btn btn_cancel" style="min-width: 94px;margin-right: 0px;">Hủy</button>
        <button type="button" id="" class="alyUppIDis btn btn_bookoke" style="display: none;">Xác nhận</button>
    </div>
</div>

</div>
</div>
</div>
<?php include 'update_js.php'; ?>
<?php
$this->endWidget();
unset($form);?>