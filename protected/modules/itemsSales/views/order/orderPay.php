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
	    -moz-appearance: none;
	    text-indent: 1px;
	    text-overflow: '';
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
	        <h5>Thanh toán đơn hàng số <?php echo $orderPay['code']; ?></h5>
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
				<input type="hidden" name="hidden_balance" value="<?php echo $balance; ?>">
				<div class="row pay_info">
					<div class="col-sm-6">
						<div class="form-group">
			    			<label for="sumWTax" class="col-sm-5 control-label">Tổng tiền đơn hàng:</label>
						    <div class="col-sm-6 text">
						    	<div class="input-group">
								  	<input type="text" name="Order[sum_amount]" class="autoNum form-control text-right" id="sumWTax" value="<?php echo $orderPay['sum_amount']; ?>" aria-describedby="basic-addon1">
								  	<span class="input-group-addon">VND</span>
								</div>
						    </div>
						</div>
					</div>
					<div class="col-sm-6" id="dvTaxVat" <?php if (!$orderPay['vat']) {
						echo 'style="display: none;"';
					} ?> >
						<div class="form-group">
			    			<label for="sumWTax" class="col-sm-5 control-label">Thuế hóa đơn GTGT:</label>
						    <div class="col-sm-6 text">
						    	<div class="input-group">
								  	<input type="text" <?php if($orderPay['vat']) echo "disabled"; ?> name="Order[vat]" class="autoNum form-control text-right" id="taxVat" value="<?php echo $orderPay['vat']; ?>" aria-describedby="basic-addon1">
								  	<span class="input-group-addon">VND</span>
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
								  	<input type="text" class="autoNum form-control text-right" id="sumWOwe" value="<?php echo $balance; ?>" aria-describedby="basic-addon1">
								  	<span class="input-group-addon">VND</span>
								</div>
						    </div>
						</div>
					</div>
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
		<div class="alert">
			
		</div>
	</div>

	<div id="credit" class="tab-pane fade">
	<div class="alert col-sm-12">
		<div class="col-sm-3 text-right">
			<h5>Loại thẻ tín dụng:</h5>
		</div>
		<div class="col-sm-9" id="crCard">
			<input type="hidden" name="InvoicePayment[card_percent]" id="card_percent">
			<label class="radio-inline"><input type="radio" value="1" data-fee='1.7' class="cardType feeCard" name="InvoicePayment[card_type]" checked>Visa</label>
			<label class="radio-inline"><input type="radio" value="2" data-fee='1.7' class="cardType feeCard" name="InvoicePayment[card_type]">Master</label>
			<label class="radio-inline"><input type="radio" value="3" data-fee='3.3' class="cardType feeCard" name="InvoicePayment[card_type]">American Express</label>
		</div>
	</div>
	</div>

	<div id="transfer" class="tab-pane fade">
		<div class="alert">
			
		</div>
	</div>

	<?php 
		$brAdrs = Branch::model()->findByPk(Yii::app()->user->getState('user_branch'));
		$adr    = $brAdrs['name'] .'-'.$brAdrs['address'];
		echo $form->hiddenField($orderPay,'id');
		echo $form->hiddenField($invoice_pay,'pay_type',array('class'=>'pay_type'));

		echo "<div class='col-sm-6'>";		// số tiền thanh toán
		echo $form->textFieldGroup($invoice_pay, 'pay_amount',
			array(
				'wrapperHtmlOptions' 	=> array('class' => 'col-sm-7',),
				'append' 				=> 'VND',
				'widgetOptions' 		=> array(
					'htmlOptions' 		=> array(
						'value'	=>	$balance,
						'placeholder'=>0,
						'class'	=>	'autoNum text-right pay_amount chgCurr pay refund feeCardInp'),),
				'labelOptions' =>array('class'=>"col-sm-5",'label'=>'Số tiền trả'),
		));
		echo "</div>";

		echo "<div class='col-sm-6'>";		// bảo hiểm trả
		echo $form->textFieldGroup($invoice_pay, 'pay_insurance',
			array(
				'wrapperHtmlOptions' 	=> array('class' => 'col-sm-7',),
				'append' 				=> 'VND',
				'widgetOptions' 		=> array(
					'htmlOptions' 		=> array(
						'value'	=>	'0',
						'placeholder'=>0,
						'class'	=>	'autoNum text-right pay_insurance pay'),),
				'labelOptions' =>array('class'=>"col-sm-4", 'label' => 'Bảo hiểm trả'),
		));
		echo "</div>"; ?>

		<div class="clearfix"></div>

		<!-- tien nhan tu khach -->
		<div class="col-sm-6 cashType">
			<div class="form-group">
    			<label class="col-sm-5 control-label">Số tiền nhận</label>
			    <div class="col-sm-7">
			    	<div class="input-group">
					  	<input type="text" name="InvoicePayment[curr_amount]" class="autoNum form-control text-right chgCurr" id="reCurr" value="0" aria-describedby="basic-addon1">
					  	<span class="input-group-addon"  id="inp_sel" style="padding: 0;">
						  	<?php $curr = Order::model()->getCurrent();?>
					  		<select class="chgCurr" id="selCurr" name="InvoicePayment[curr_unit]" style="background: transparent; border: 0; padding: 6px 12px; cursor: pointer;">
					  			<option class="selCol" data-sell=0 data-trans=0 data-buy=0 value="VND">VND</option>
							<?php foreach ($curr as $key => $value):?>
					  			<?php if ($key != 'DateTime'):?>
					  				<option class="selCol" data-sell="<?php echo $value['Sell']; ?>" data-buy="<?php echo $value['Buy']; ?>" data-trans="<?php echo $value['Transfer']; ?>" value="<?php echo $value['CurrencyCode']; ?>"><?php echo $value['CurrencyCode']; ?></option>
					  			<?php endif ?>
					  		<?php endforeach ?>
					  		</select>
					  	</span>
					</div>
			    </div>
			</div>
		</div>

		<!-- Phí giao dịch -->
		<div class="col-sm-6 text creditType" style="display: none;">
			<div class="form-group">
    			<label class="col-sm-5 control-label">Phí giao dịch</label>
			    <div class="col-sm-7">
			    	<div class="input-group">
					  	<input type="text" name="InvoicePayment[card_val]" class="autoNum form-control text-right transFee" value="0" aria-describedby="basic-addon1">
					  	<span class="input-group-addon">VND</span>
					</div>
			    </div>
			</div>
		</div>

		<?php 
			echo "<div class='col-sm-6'>";		// khuyến mãi
			echo $form->textFieldGroup($invoice_pay, 'pay_promotion',
				array(
					'wrapperHtmlOptions' 	=> array('class' => 'col-sm-7',),
					'append' 				=> 'VND',
					'widgetOptions' 		=> array(
						'htmlOptions' 		=> array(
							'value'	=>	'0',
							'class'	=>	'autoNum text-right pay_promotion pay'),),
					'labelOptions' =>array('label'=>'Khuyến mãi','class'=>"col-sm-4"),
			));
			echo "</div>";
		?>

		<!-- số tiền quy đổi -->
		<div class="col-sm-6 text CurrType" style="display: none;">
			<div class="form-group">
    			<label for="pay_receive" class="col-sm-5 control-label">Số tiền quy đổi</label>
			    <div class="col-sm-7">
			    	<div class="input-group">
					  	<input name="InvoicePayment[curr_change]" type="text" class="autoNum form-control text-right refund" id="pay_receive" value="0" aria-describedby="basic-addon1">
					  	<span class="input-group-addon">VND</span>
					</div>
			    </div>
			</div>
		</div>
	
		<div class="clearfix"></div>

		<!-- tien trả cho khach -->
		<div class="col-sm-6 text cashType">
			<div class="form-group">
    			<label for="pay_refund" class="col-sm-5 control-label">Số tiền hoàn lại</label>
			    <div class="col-sm-7">
			    	<div class="input-group">
					  	<input type="text" class="form-control text-right refund autoNum" id="pay_refund" value="<?php echo "-$balance"; ?>" aria-describedby="basic-addon1">
					  	<span class="input-group-addon">VND</span>
					</div>
			    </div>
			</div>
		</div>

		<!-- Tổng tiền thanh toán -->
		<div class="col-sm-6 text creditType" style="display: none;">
			<div class="form-group">
    			<label class="col-sm-5 control-label">Tổng tiền thanh toán</label>
			    <div class="col-sm-7">
			    	<div class="input-group">
					  	<input type="text" name="InvoicePayment[pay_sum]" class="autoNum form-control text-right feeSumCard" value="0" aria-describedby="basic-addon1">
					  	<span class="input-group-addon">VND</span>
					</div>
			    </div>
			</div>
		</div>

		<?php echo "<div class='col-sm-6 text'>";		// còn nợ
		echo $form->textFieldGroup($invoice, 'balance',
			array(
				'wrapperHtmlOptions' => array('class' => 'col-sm-7',),
				'append' => 'VND',
				'widgetOptions' => array(
					'htmlOptions' => array('readOnly'=>true,'class'	=>'autoNum text-right balance red','value'=>'0'),),
				'labelOptions' =>array('class'=>"col-sm-4"),
		));
		echo "</div>"; ?>

		<div class="clearfix"></div>

		<?php 
			$vatRO = '';
			$vatCk = '';
			$vatCls = '';
			$vatStyle = 'style="display: none"';
			if ($orderPay['vat']){
				$vatRO = 'disabled';
				$vatCk = 'checked';
				$vatCls = 'text';
				$vatStyle = '';
		}?>

		<div class="checkbox col-sm-offset-1">
		  	<label><input type="checkbox" value="" id="ck_VAT" <?php echo $vatRO . ' ' . $vatCk; ?>>Hóa đơn GTGT</label>
		</div>

		<div class="dVAT <?php echo $vatCls; ?>" <?php echo $vatStyle; ?>>
			<div class="form-group">
				<label for="vat_date" class="col-sm-3 control-label">Ngày xuất hóa đơn</label>
			    <div class="col-sm-3">
			    	<input name="Order[date_vat]" value="<?php echo date_format(date_create($orderPay['date_vat']), 'd/m/Y'); ?>" type="text" class="form-control" id="vat_date" <?php echo $vatRO; ?>>
			    </div>
			</div>

			<div class="form-group">
				<label for="vat_place" class="col-sm-3 control-label">Nơi nhận hóa đơn</label>
			    <div class="col-sm-5">
			    	<textarea name="Order[place_vat]" class="form-control" id="vat_place" <?php echo $vatRO; ?>><?php echo $orderPay['place_vat'] ?></textarea>
			    </div>
			</div>
		</div>
		
		<div class="clearfix"></div>

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

<?php include 'orderPay_js.php'; ?>