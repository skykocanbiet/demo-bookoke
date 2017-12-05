<style>
.autoNum {text-align: right;}
</style>
<?php 
$baseUrl = Yii::app()->request->baseUrl; 
$model->requester_date = date("Y-m-d");  
$model->number = $model->getApNumber(date("Y-m-d"));
$form=$this->beginWidget('CActiveForm', array(
'id'=>'View-Frm-Account-Payable',
'enableClientValidation'=>false,
'enableAjaxValidation'=>false,
'htmlOptions'=>array(   'onsubmit'=>"return false;",
                        'enctype' => 'multipart/form-data',
),
)); ?>
    
    <?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="alert alert-success">
        <button type="button" data-dismiss="alert" class="close">×</button>
        <?php echo Yii::app()->user->getFlash('success')?>
    </div>
    <?php endif?>
    <?php if(Yii::app()->user->hasFlash('error')):?>
    <div class="alert alert-error">
    	<button data-dismiss="alert" class="close">×</button>
        <?php echo Yii::app()->user->getFlash('error')?>
    </div>
    <?php endif?> 
    
    <div class="form-horizontal">
    <?php echo $form->errorSummary($model,'<button type="button" class="close" data-dismiss="alert">&times;</button>','',array('class'=>'alert alert-block')); ?>

        <div class="col-md-6">

            <!-- Receiver -->
            <div class="form-group">
                <label class="col-sm-4 col-md-4 control-label"><span style="color: red;">*</span>Người nhận:</label>
                
                <div class="col-sm-8 col-md-8">
                    <?php echo $form->textField($model,'name',array('value'=>$model->name,'class'=>'form-control','required'=>'required')); ?>
                    <span class="error_message"><?php echo $form->error($model,'name',array('class'=>'alert fade in')); ?></span>
                </div>
            </div>

            <!-- Address -->
            <div class="form-group">
                <label class="col-sm-4 col-md-4 control-label">Địa chỉ:</label>
                <div class="col-sm-8 col-md-8">
                    <?php echo $form->textField($model,'address',array('value'=>$model->address,'class'=>'form-control')); ?>
                    <span class="error_message"><?php echo $form->error($model,'address',array('class'=>'alert fade in')); ?></span>
                </div> 
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label class="col-sm-4 col-md-4 control-label"><span style="color: red;">*</span>Điện thoại:</label>
                <div class="col-sm-8 col-md-8">
                    <?php echo $form->textField($model,'phone',array('value'=>$model->phone,'class'=>'form-control','required'=>'required')); ?>
                    <span class="error_message"><?php echo $form->error($model,'phone',array('class'=>'alert fade in')); ?></span>
                </div>
            </div>

            <!-- Amount -->
            <div class="form-group">
                <label class="col-sm-4 col-md-4 control-label"><span style="color: red;">*</span>Số tiền:</label>
                <div class="col-sm-8 col-md-8">
                    <div class="input-group">
                       <?php echo $form->textField($model,'amount',array('value'=>$model->amount,'class'=>'form-control autoNum','required'=>'required')); ?>
                        <span class="input-group-addon"  id="inp_sel" style="padding: 0;">
                            <?php $curr = Order::model()->getCurrent();?>
                            <select class="chgCurr" id="Curr" style="background: transparent; border: 0; padding: 6px 12px; cursor: pointer;">
                                <option class="selCol" data-sell=0 data-trans=0 data-buy=0 value="VND">VND</option>
                                <?php if ($curr): ?>
                            <?php foreach ($curr as $key => $value):?>
                                <?php if ($key != 'DateTime'):?>
                                    <option class="selCol" data-sell="<?php echo $value['Sell']; ?>" data-buy="<?php echo $value['Buy']; ?>" data-trans="<?php echo $value['Transfer']; ?>" value="<?php echo $value['CurrencyCode']; ?>">
                                    <?php echo $value['CurrencyCode']; ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                                <?php endif ?>
                            </select>
                            <input type="hidden" name="VPayable[currency]" id="currshow" value="">
                        </span>
                    </div>
                    <span class="error_message"><?php echo $form->error($model,'amount',array('class'=>'alert fade in')); ?></span>
                </div>
            </div>

            <!-- In Words -->
            <div class="form-group">
                <label class="col-sm-4 col-md-4 control-label">In words:</label>
                <div class="col-sm-8 col-md-8">
                    <?php echo $form->textField($model,'in_words',array('value'=>$model->in_words,'class'=>'form-control')); ?>
                    <span class="error_message"><?php echo $form->error($model,'in_words',array('class'=>'alert fade in')); ?></span>
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label class="col-sm-4 col-md-4 control-label"><span style="color: red;">*</span>Mô tả:</label>
                <div class="col-sm-8 col-md-8">
                    <?php echo $form->textArea($model,'description',array('value'=>$model->description,'class'=>'form-control','style'=>'height:95px;','required'=>'required')); ?>
                    <span class="error_message"><?php echo $form->error($model,'description',array('class'=>'alert fade in')); ?></span>
                </div>
            </div>

        </div>

        <div class="col-md-6">

            <!-- Number -->
            <div class="form-group">
                <label class="col-sm-4 col-md-4 control-label">Mã phiếu thu:</label>
                <div class="col-sm-8 col-md-8">
                    <?php echo $form->textField($model,'number',array('value'=>$model->number,'class'=>'form-control','required'=>'required',"readonly"=>"readonly")); ?>
                    <span class="error_message"><?php echo $form->error($model,'number',array('class'=>'alert fade in')); ?></span>
                </div>
            </div>

            <!-- Type -->
            <div class="form-group">
                <label class="col-sm-3 col-md-4 control-label"><span style="color: red;">*</span>Loại:</label>
                <div class="col-sm-8 col-md-8">
                    <?php 
                        $listdata      = array();
                        $listdata['']  = "Chọn loại";
                        $listdata['0'] = "Cost of goods sold";
                        $listdata['1'] = "Discount and promotion";
                        $listdata['2'] = "Marketing and PR expenses";
                        $listdata['3'] = "Labor cost";
                        $listdata['4'] = "Instruments and tools";
                        $listdata['5'] = "Outside purchasing service cost";
                        $listdata['6'] = "Tax, Charges & Fee";
                        $listdata['7'] = "Other expenses";
                        echo $form->dropDownList($model,'type',$listdata,array('required'=>'required','class'=>'form-control'));
                    ?>
                    <span class="error_message"><?php echo $form->error($model,'type',array('class'=>'alert fade in')); ?></span>
                </div>
            </div>
            <!-- Payment Status -->
            <div class="form-group">
                <label class="col-sm-3 col-md-4 control-label"><span style="color: red;">*</span>Thanh toán:</label>
                <div class="col-sm-8 col-md-8">
                    <?php 
                        $listdata      = array();
                        $listdata['1'] = "Cash";
                        $listdata['2'] = "Creadit Card";
                        $listdata['3'] = "Check";
                        echo $form->dropDownList($model,'payment_status',$listdata,array('required'=>'required','class'=>'form-control'));
                    ?>
                    <span class="error_message"><?php echo $form->error($model,'payment_status',array('class'=>'alert fade in')); ?></span>
                </div>
            </div>
            <!-- Requester date -->
            <div class="form-group">
                <label class="col-sm-3 col-md-4 control-label">Ngày yêu cầu:</label>
                <div class="col-sm-8 col-md-8">
                    <?php echo $form->textField($model,'requester_date',array('value'=>$model->requester_date,'class'=>'form-control','required'=>'required',"readonly"=>"readonly")); ?>
                    <span class="error_message"><?php echo $form->error($model,'requester_date',array('class'=>'alert fade in')); ?></span>
                </div>
            </div>
            <!-- Approval date -->
            <div class="form-group">
                <label class="col-sm-3 col-md-4 control-label">Ngày phê duyệt:</label>
                <div class="col-sm-8 col-md-8">
                    <?php echo $form->textField($model,'approval_date',array('value'=>$model->approval_date,'class'=>'form-control',"readonly"=>"readonly")); ?>
                    <span class="error_message"><?php echo $form->error($model,'approval_date',array('class'=>'alert fade in')); ?></span>
                </div>
            </div>
            <!-- Requester -->
            <div class="form-group">
                <label class="col-sm-3 col-md-4 control-label">Người yêu cầu:</label>
                <div class="col-sm-8 col-md-8">
                    <input type="hidden" name="VPayable[id_user]" value="<?php echo Yii::app()->user->getState("user_id"); ?>">
                    <input type="text" value="<?php echo Yii::app()->user->getState('user_name'); ?>" class="form-control" readonly> 
                    
                    <span class="error_message"><?php echo $form->error($model,'id_user',array('class'=>'alert fade in')); ?></span>
                </div>
            </div>
            <!-- Notes -->
            <div class="form-group">
                <label class="col-sm-3 col-md-4 control-label">Ghi chú:</label>
                <div class="col-sm-8 col-md-8">
                    <?php echo $form->textArea($model,'note',array('value'=>$model->note,'class'=>'form-control','style'=>'height:50px;')); ?>
                    <span class="error_message"><?php echo $form->error($model,'note',array('class'=>'alert fade in')); ?></span>
                </div>
            </div>
            
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="form-actions text-right">
              <button class="btn sCancel" data-dismiss="modal">Hủy</button>
              <button id="btn-add-payable" type="submit" class="btn btn_bookoke">Xác nhận</button>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
<?php $this->endWidget(); ?>

<!-- BG POPUP -->

<script>
$(document).ready(function(){
    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    $('.autoNum').autoNumeric('init',numberOptions);

    $('#View-Frm-Account-Payable').submit(function(e) {
		//Prevent the default action, which in this case is the form submission.
		e.preventDefault();
        num = $('#VPayable_amount').autoNumeric("get");
        $('#VPayable_amount').val(num);
        curr = $('#Curr option:selected').text();
        $('#currshow').val(curr);

		//Serialize the form data and store to a variable.
		var formData = new FormData($("#View-Frm-Account-Payable")[0]);
        
        if (!formData.checkValidity || formData.checkValidity()) {

            jQuery.ajax({ 
                type:"POST",
                url:"<?php echo CController::createUrl('Payable/addnew_'.$model->tableName().'')?>",
                data:formData,
                datatype:'json',
                beforeSend: function() {
                    jQuery("#view_payment_voucher").slideUp();
                    $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                },
                success:function(data){
                    
                    if(data!='-1' || data != "" ){
						$('#Frm-AddnewAP').modal("hide");
                        
                        var cur_page = $("#id_text_page").val();
                        search_cus(cur_page);
					}
                },
                error: function(data) { 
                    jQuery("#view_payment_voucher").slideDown();
                    $('#idwaiting_main').html('');
                    alert("Error occured.Please try again!");
                },
                cache: false,
                contentType: false,
                processData: false
              });
          }
          return false;

	});
    
    $(function(){
    	$( "#VPayable_requester_date" ).datepicker({
    		changeMonth: true,
    		changeYear: true,
            dateFormat: 'yy-mm-dd'
    	});
    });
    
});
</script>