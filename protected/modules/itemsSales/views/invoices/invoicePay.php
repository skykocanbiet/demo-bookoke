<style>
	.alert{margin-bottom: 0px; padding: 10px;}
	.pay_info .form-group {margin-bottom: 0px;}
	.Submit { background: #94c63f;color: white;}

	.pay_date {padding: 10px;}

	#crCard {
		display: table;
	}
	#crCard label {
		display: table-cell;
	}	
	.input-group-addon {
		cursor: default;
	}
	select {
		-webkit-appearance: none;
		-moz-appearance   : none;
		text-indent       : 1px;
		text-overflow     : '';
	}
	#inp_sel {
		background: #7cc9ac;
		color: white;
	}
	#inp_sel:hover, #inp_sel:focus {background: #48b64e !important; color: white !important;}
	.selCol {color: black !important;}

	.dVAT .form-group {margin-bottom: 5px;}

	.text input,.text textarea, .text .input-group-addon {border: 0; background: transparent !important; box-shadow: none;}
	.red {color: red;}
</style>
<div class="modal-dialog modal-lg pop_bookoke">
    <div class="modal-content quote-edit-container">
    	<div class="modal-header popHead">
	        <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
	        <h5>Thanh toán hóa đơn số <?php echo $inv['code']; ?></h5>
	    </div>

<?php /** @var TbActiveForm $form */ 
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		 array(
	        'id' => 'frm-pay-invoice',
	        'type' => 'horizontal',
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

		<div class="modal-body">
			<div class="alert alert-success"">
				<input type="hidden" name="hidden_balance" value="<?php echo $inv['balance']; ?>">
				<input type="hidden" name="Invoice[id]" value="<?php echo $inv['id']; ?>">
				<input type="hidden" id="pointValue" value="<?php echo Yii::app()->params['member_unit_point']; ?>">
				<input type="hidden" id="cusMem" value="<?php echo $cusMem; ?>">

				<div class="row pay_info">
					<div class="col-sm-6">
						<div class="form-group">
			    			<label for="sumWTax" class="col-sm-5 control-label">Tổng tiền đơn hàng:</label>
						    <div class="col-sm-6 text">
						    	<div class="input-group">
								  	<input type="text" name="Invoice[sum_amount]" class="autoNum form-control text-right" id="sumWTax" value="<?php echo $inv['sum_amount']; ?>" aria-describedby="basic-addon1">
								  	<span class="input-group-addon"><?php echo $inv['currency_use']; ?></span>
								</div>
						    </div>
						</div>
					</div>
					<div class="col-sm-6" id="dvTaxVat" <?php if (!$inv['vat']) {
						echo 'style="display: none;"';
					} ?> >
						<div class="form-group">
			    			<label for="sumWTax" class="col-sm-5 control-label">Thuế hóa đơn GTGT:</label>
						    <div class="col-sm-6 text">
						    	<div class="input-group">
								  	<input type="text" <?php if($inv['vat']) echo "disabled"; ?> name="Invoice[vat]" class="autoNum form-control text-right" id="taxVat" value="<?php echo $inv['sum_amount'] - $inv['sum_no_vat']; ?>" aria-describedby="basic-addon1">
								  	<span class="input-group-addon"><?php echo $inv['currency_use']; ?></span>
								</div>
						    </div>
						</div>
					</div>

					<div class="clearfix"></div>
					<div class="col-sm-6">
						<div class="form-group">
			    			<label for="sumWTax" class="col-sm-5 control-label">Số tiền còn nợ:</label>
						    <div class="col-sm-6 text">
						    	<div class="input-group">
								  	<input type="text" class="autoNum form-control text-right" id="sumWOwe" value="<?php echo $inv['balance']; ?>" aria-describedby="basic-addon1">
								  	<span class="input-group-addon"><?php echo $inv['currency_use']; ?></span>
								</div>
						    </div>
						</div>
					</div>
					<?php $point = ($cusMem) ? floor((int)$inv['balance'] / (int)Yii::app()->params['member_unit_point']) : 0;
						if ($cusMem): 
					?>

					<div class="col-sm-6">
						<div class="form-group">
			    			<label for="sumWTax" class="col-sm-5 control-label">Điểm thưởng:</label>
						    <div class="col-sm-6 text">
						    	<div class="input-group">
								  	<input type="text" name="Receipt[point]" class="autoNum form-control text-right" id="receiptPoint" value="<?php echo floor((int)$inv['balance'] / (int)Yii::app()->params['member_unit_point']); ?>" aria-describedby="basic-addon1">
								  	<span class="input-group-addon">Điểm</span>
								</div>
						    </div>
						</div>
					</div>
					<?php endif ?>
				</div>
			</div>

			<div class="alert">
		
				<h3>Hình thức thanh toán</h3>
				<ul class="nav nav-tabs">
				  	<li class="active"><a data-toggle="tab" id="1" href="#cash">Tiền mặt</a></li>
				  	<li><a data-toggle="tab" id="2" href="#credit">Thẻ tín dụng</a></li>
				  	<li><a data-toggle="tab" id="3" href="#transfer">Chuyển khoản</a></li>
				  	<li class="pull-right pay_date">Ngày thanh toán: <span class="today"></span></li>
				</ul>

				<div class="tab-content">
					<div id="cash" class="tab-pane fade in active">
						<div class="alert"></div>
					</div>

					<div id="credit" class="tab-pane fade">
						<div class="alert col-sm-12">
							<div class="col-sm-3 text-right">
								<h5>Loại thẻ tín dụng:</h5>
							</div>
							<div class="col-sm-9" id="crCard">
								<input type="hidden" name="Receipt[card_percent]" id="card_percent">
								<label class="radio-inline"><input type="radio" value="1" data-fee='1.7' class="cardType feeCard" name="Receipt[card_type]" checked>Visa</label>
								<label class="radio-inline"><input type="radio" value="2" data-fee='1.7' class="cardType feeCard" name="Receipt[card_type]">Master</label>
								<label class="radio-inline"><input type="radio" value="3" data-fee='3.3' class="cardType feeCard" name="Receipt[card_type]">American Express</label>
							</div>
						</div>
					</div>

					<div id="transfer" class="tab-pane fade">
						<div class="alert"></div>
					</div>

					<?php 
						$brAdrs = Branch::model()->findByPk(Yii::app()->user->getState('user_branch'));
						$adr    = $brAdrs['name'] .'-'.$brAdrs['address'];
						echo $form->hiddenField($rpt,'id');
						echo $form->hiddenField($rpt,'pay_type',array('class'=>'pay_type'));
					?>

					<div class="col-sm-7">
						<?php 
							echo $form->textFieldGroup($rpt, 'pay_promotion', array(		// khuyến mãi
									'wrapperHtmlOptions' 	=> array('class' => 'col-sm-7',),
									'append' 				=> $inv['currency_use'],
									'widgetOptions' 		=> array(
										'htmlOptions' 		=> array(
											'value'       => '0',
											'placeholder' => 0,
											'class'       => 'autoNum text-right pay_promotion pay'),),
									'labelOptions' =>array('label'=>'Khuyến mãi','class'=>"col-sm-4"),
							));

							echo $form->textFieldGroup($rpt, 'pay_insurance', array(		// bảo hiểm trả
									'wrapperHtmlOptions' 	=> array('class' => 'col-sm-7',),
									'append' 				=> $inv['currency_use'],
									'widgetOptions' 		=> array(
										'htmlOptions' 		=> array(
											'value'	=>	'0',
											'placeholder'=>0,
											'class'	=>	'autoNum text-right pay_insurance pay'),),
									'labelOptions' =>array('class'=>"col-sm-4", 'label' => 'Bảo hiểm trả'),
							));

							echo $form->textFieldGroup($rpt, 'pay_amount', array(			// số tiền thanh toán
									'wrapperHtmlOptions' 	=> array('class' => 'col-sm-7',),
									'append' 				=> $inv['currency_use'],
									'widgetOptions' 		=> array(
										'htmlOptions' 		=> array(
											'value'       => $inv['balance'],
											'placeholder' => 0,
											'class'       => 'autoNum text-right pay_amount chgCurr pay refund feeCardInp'),),
									'labelOptions' =>array('class'=>"col-sm-4",'label'=>'Số tiền trả'),
							));
						?>

						<!-- tien nhan tu khach -->
						<div class="form-group cashType">
			    			<label class="col-sm-4 control-label">Số tiền nhận</label>
						    <div class="col-sm-7">
						    	<div class="input-group">
								  	<input type="text" name="Receipt[curr_amount]" class="autoNum form-control text-right chgCurr" id="reCurr" value="0" aria-describedby="basic-addon1">
									  	<?php $curr = Order::model()->getCurrent();?>
								  	<span class="input-group-addon"  id="inp_sel" style="padding: 0;">

								  		<select class="chgCurr" id="selCurr" name="Receipt[curr_unit]" style="background: transparent; border: 0; padding: 6px 12px; cursor: pointer;">
								  			<option class="selCol" data-sell=0 data-trans=0 data-buy=0 value="VND">VND</option>

								  			<?php if ($curr): ?>
										<?php foreach ($curr as $key => $value):?>
								  			<?php if ($key != 'DateTime'):?>
								  				<?php if ($inv['currency_use'] != 'VND'): ?>
								  				 	<?php if ($value['CurrencyCode'] == $inv['currency_use']): ?>
								  						<option selected class="selCol" data-sell="<?php echo $value['Sell']; ?>" data-buy="<?php echo $value['Buy']; ?>" data-trans="<?php echo $value['Transfer']; ?>" value="<?php echo $value['CurrencyCode']; ?>"><?php echo $value['CurrencyCode']; ?></option>
								  					<?php endif ?>
								  				<?php else: ?>
								  					<option class="selCol" data-sell="<?php echo $value['Sell']; ?>" data-buy="<?php echo $value['Buy']; ?>" data-trans="<?php echo $value['Transfer']; ?>" value="<?php echo $value['CurrencyCode']; ?>"><?php echo $value['CurrencyCode']; ?></option>
								  				 <?php endif ?>
								  			<?php endif ?>
								  		<?php endforeach ?>
								  			<?php endif ?>
								  		</select>
								  	</span>
								</div>
						    </div>
						</div>

						<!-- Phí giao dịch -->
						<div class="form-group creditType" style="display: none;">
			    			<label class="col-sm-4 control-label">Phí giao dịch</label>
						    <div class="col-sm-7">
						    	<div class="input-group">
								  	<input type="text" name="Receipt[card_val]" class="autoNum form-control text-right transFee" value="0" aria-describedby="basic-addon1">
								  	<span class="input-group-addon">VND</span>
								</div>
						    </div>
						</div>

						<!-- số tiền quy đổi -->
						<div class="form-group text CurrType" style="display: none;">
			    			<label for="pay_receive" class="col-sm-4 control-label">Số tiền quy đổi</label>
						    <div class="col-sm-7">
						    	<div class="input-group">
								  	<input name="Receipt[curr_change]" type="text" class="autoNum form-control text-right refund" id="pay_receive" value="0" aria-describedby="basic-addon1">
								  	<span class="input-group-addon" id="changeType"><?php echo $inv['currency_use']; ?></span>
								</div>
						    </div>
						</div>

						<!-- tien trả cho khach -->
						<div class="form-group text cashType">
			    			<label for="pay_refund" class="col-sm-4 control-label">Số tiền hoàn lại</label>
						    <div class="col-sm-7">
						    	<div class="input-group">
								  	<input type="text" class="form-control text-right refund autoNum" id="pay_refund" value="0" aria-describedby="basic-addon1">
								  	<span class="input-group-addon" id="reType"><?php echo $inv['currency_use']; ?></span>
								</div>
						    </div>
						</div>

						<!-- Tổng tiền thanh toán -->
						<div class="form-group text creditType" style="display: none;">
			    			<label class="col-sm-4 control-label">Tổng tiền thanh toán</label>
						    <div class="col-sm-7">
						    	<div class="input-group">
								  	<input type="text" class="autoNum form-control text-right feeSumCard" value="0" aria-describedby="basic-addon1">
								  	<span class="input-group-addon">VND</span>
								</div>
						    </div>
						</div>

						<?php 
							echo $form->textFieldGroup($inv, 'balance', array(			// còn nợ
									'wrapperHtmlOptions' => array('class' => 'col-sm-7 text',),
									'append' => $inv['currency_use'],
									'widgetOptions' => array(
										'htmlOptions' => array('readOnly'=>true,'class'	=>'autoNum text-right balance red','value'=>'0'),),
									'labelOptions' =>array('class'=>"col-sm-4",'label'=>'Còn nợ'),
							));
						?>
					</div>

					<div class="col-sm-5">
						<?php
							echo $form->textAreaGroup($inv, 'note',
								array(
									'wrapperHtmlOptions' 	=> array('class' => 'col-sm-12',),
									'widgetOptions' 		=> array(
										'htmlOptions' 		=> array('class' =>	'text-left', 'rows'=>10)),
									'labelOptions' =>array('label'=>'Ghi chú','class'=>"col-sm-12", 'style'=>'text-align:left'),
							)); 
						?>
					</div>

					<div class="clearfix">
						
					</div>

		<?php 
			$vatRO = '';
			$vatCk = '';
			$vatCls = '';
			$vatStyle = 'style="display: none"';
			if ($inv['vat']){
				$vatRO = 'disabled';
				$vatCk = 'checked';
				$vatCls = 'text';
				$vatStyle = '';
		}?>

		<div class="checkbox col-sm-offset-1">
		  	<label><input type="checkbox" style="margin-top: 2px;" value="" id="ck_VAT" <?php echo $vatRO . ' ' . $vatCk; ?>>Hóa đơn GTGT</label>
		</div>

		<div class="dVAT <?php echo $vatCls; ?>" <?php echo $vatStyle; ?>>
			<div class="form-group">
				<label for="vat_date" class="col-sm-3 control-label">Ngày xuất hóa đơn</label>
			    <div class="col-sm-3">
			    	<input name="Invoice[date_vat]" value="<?php echo date_format(date_create($inv['date_vat']), 'd/m/Y'); ?>" type="text" class="form-control" id="vat_date" <?php echo $vatRO; ?>>
			    </div>

			    <label for="vat_value" class="col-sm-1 control-label">Giá trị</label>
			    <div class="col-sm-1">
			    	<input name="Invoice[vat]" value="<?php echo $inv['vat']; ?>" type="text" class="form-control" id="vat_value" <?php echo $vatRO; ?>>
			    </div>
			    <label for="vat_value" class="control-label">%</label>
			</div>

			<div class="form-group">
				<label for="vat_place" class="col-sm-3 control-label">Thông tin xuất hóa đơn đỏ</label>
			    <div class="col-sm-5">
			    	<textarea name="Invoice[place_vat]" class="form-control" id="vat_place" <?php echo $vatRO; ?>><?php echo $inv['place_vat'] ?></textarea>
			    </div>
			</div>
		</div>
		
		<div class="clearfix"></div>

		<input type="hidden" name="Receipt[pay_sum]" id="pay_sum">
		<input type="hidden" name="Receipt[curr_sum]" id="curr_sum">

	<div class="ocf text-right" >
		<button type="button" class="btn btn_cancel" data-dismiss="modal">Hủy</button>
		<button type="submit" class="btn btn_bookoke">Xác nhận</button>
	</div>

<?php
$this->endWidget();
unset($form);?>
				</div>
			</div>
	    </div>
    </div>
</div>

<!-- pop up information -->
<div class="modal pop_bookoke" id="info" role="dialog">
    <div class="modal-dialog" style="width: 350px;">
        <div class="modal-content">

            <div class="modal-header popHead">
                <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
                <h5 id="info_head">THÔNG BÁO</h5>
            </div>
            <div class="modal-body text-center">
                <p id="info_content">Some text in the modal.</p>
            </div>

        </div>
    </div>
</div>

<?php include 'invoicePay_js.php'; ?>