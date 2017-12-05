<script>
function checkNum() {
	var balance = $('.balance').autoNumeric('get');
	var refund = $('#pay_refund').autoNumeric('get');

	if($('.pay_amount').autoNumeric('get') <= 0 || balance < 0 || refund < 0) {
		$('.pay_amount').css('border','1px solid red');
		$('.pay_insurance').css('border','1px solid red');
		$('#pay_receive').css('border','1px solid red');
		return 0;
	}
	else 
	{
		$('.pay_amount').css('border','1px solid #ccc');
		$('.pay_insurance').css('border','1px solid #ccc');
		$('#pay_receive').css('border','1px solid #ccc');
		return 1;
	}
}

// tinh tien con no
function getBalance(balance ='') {
	if(!balance) {
		balance = $('#sumWOwe').autoNumeric('get');
	}
	amount    = $('.pay_amount').autoNumeric('get');
	if(amount == '')
		amount = 0;
	insurance = $('.pay_insurance').autoNumeric('get');
	promotion = $('.pay_promotion').autoNumeric('get');
	minus     = balance - (parseInt(amount) + parseInt(insurance) + parseInt(promotion));
	$('.balance').autoNumeric('set',minus);
}

// phi thanh toan bang the tin dung
function cardFee(feePercent, feeType, feePay) {
	feeTrans = (feePay * feePercent)/100;
	$('.transFee').autoNumeric('set',feeTrans);
	$('.feeSumCard').autoNumeric('set',parseInt(feePay)+feeTrans);
	$('#card_percent').val(feePercent);
	$('#pay_refund').val(0);
	$('#pay_receive').autoNumeric('set',parseInt(feePay)+feeTrans);
	/*$('#reCurr').autoNumeric('set',parseInt(feePay)+feeTrans);*/
}

function getRefund() {
	amount  = $('.pay_amount').autoNumeric('get');
	receive = $('#pay_receive').autoNumeric('get');

	refund = receive - amount;

	$('#pay_refund').autoNumeric('set',refund);
}

$(function(){
	var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
	$('.autoNum').autoNumeric('init',numberOptions);

	var today = moment().format('YYYY-MM-DD HH:mm:ss');
	$('.today').text(today);

	// so tien con no
	$('.pay').keyup(function(e){
		balance   = parseInt($('#sumWOwe').autoNumeric('get'));
		getBalance(balance);
	})

	// tinh tien hoan lai
	$('.refund').keyup(function(e){
		getRefund();
	})

	$('.pay_type').val(1);
	$('.transFee').val('');
	$('#card_percent').val('');

/*********** thanh toan bang the tin dung ***********/
	$('.feeCard').on('change', function () {
		cardType   = $(this).val();
		feePercent = $(this).data('fee');
		feePay     = $('.pay_amount').autoNumeric('get');
		cardFee(feePercent, cardType, feePay);
	})

	$('.feeCardInp').on('keyup keypress', function () {
		cardType   = $('.feeCard').val();
		feePercent = $('.feeCard').data('fee');
		feePay     = $('.pay_amount').autoNumeric('get');
		cardFee(feePercent, cardType, feePay);
	})

/*********** chon hinh thuc thanh toan ***********/
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		pay_type = $(e.target).attr('id');
		feePay   = $('.pay_amount').autoNumeric('get');
		$('.pay_type').val(pay_type);

		$('#ckCurr').attr('checked',false);
		$('.dCurr').hide();
		$('#selCurr').val('VND');
		owe = $('#sumWOwe').autoNumeric('get');
		$('.pay_amount').autoNumeric('set',owe);

		// the tin dung
		if(pay_type == 2){
			cardType   = $('.cardType').val();
			feePercent = $('.cardType').data('fee');
			
			cardFee(feePercent, cardType, feePay);
			$('.creditType').show();
			$('.cashType').hide();
			$('.transFee').val();
			$('.CurrType').hide();
		}
		else {
			$('.creditType').hide();
			$('.cashType').show();	
			$('.transFee').val('');
			$('#card_percent').val('');
			$('.feeSumCard').val(0);
		}
	});
/*********** thanh toan ngoai te ***********/
	$('.chgCurr').on('change keyup keypress',function(e) {
		pay_type = $('.pay_type').val();
		cur      = $('#selCurr').val();
		bl       = $('#sumWOwe').autoNumeric('get');

		if(pay_type == 1)
			curBuy  = $('#selCurr').find(':selected').data('buy');
		else if(pay_type == 2) {
			curBuy  = $('#selCurr').find(':selected').data('trans');
			$('#pay_refund').val(0);
		}

		reCurr = $('#reCurr').autoNumeric('get');
		vnd    = parseFloat(reCurr) * curBuy;
		$('#pay_receive').autoNumeric('set',reCurr);

		if(cur != 'VND') {
			$('.CurrType').show();
			if(pay_type == 2) {
				//$('.pay_amount').autoNumeric('set',vnd);
				
			}
			else {
				$('#pay_receive').autoNumeric('set',vnd);

				/*if(vnd > bl || reCurr == 0) 
					$('.pay_amount').autoNumeric('set',bl);
				else 
					$('.pay_amount').autoNumeric('set',vnd);*/
			}
		}
		else {
			$('.CurrType').hide();
		}
		getRefund();
		getBalance();
	});

/*********** hoa don gia tri gia tang ***********/
	$('#vat_date').datepicker();
	day = moment().format('DD/MM/YYYY');

	$('#ck_VAT').change(function (e) {
		ck = $('#ck_VAT').is(':checked');
		if(ck == true) {
			$('.dVAT').show();
			$('#dvTaxVat').show();
			$('#vat_date').val(day);
			$('#vat_place').val('<?php echo $adr; ?>');

			sum     = $('#sumWTax').autoNumeric('get');
			owe     = parseFloat($('#sumWOwe').autoNumeric('get'));
			tax     = parseFloat(sum*10/100);
			sumWTax = parseInt(sum) + tax;

			$('#taxVat').autoNumeric('set',tax);
			$('#sumWTax').autoNumeric('set',sumWTax);
			$('#sumWOwe').autoNumeric('set',tax + owe);

			getBalance(tax+owe);
		}
		else {
			$('.dVAT').hide();
			$('#dvTaxVat').hide();
			$('#sumWTax').autoNumeric('set',<?php echo $orderPay['sum_amount']; ?>);
			$('#sumWOwe').autoNumeric('set',<?php  echo $balance; ?>);
			$('#taxVat').autoNumeric('set',0);
			//$('.pay_amount').autoNumeric('set',<?php  //echo $balance; ?>);

			balance = parseInt(<?php  echo $balance; ?>);
			getBalance(balance);
		}
	})

/*********** submit form ***********/
	$('form#frm-pay-invoice').submit(function(e){
		e.preventDefault();
		
		if(!checkNum())
			return false;

		date_vat = $('#vat_date').val();
		ch = moment(date_vat,'DD/MM/YYYY').format('YYYY-MM-DD HH:mm:ss');
		$('#vat_date').val(ch);

        var formData = new FormData($("#frm-pay-invoice")[0]);

        if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({ type:"POST",
                url:"<?php echo CController::createUrl('order/orderPay')?>",
                data: formData,
                datatype:'json',

                success:function(data){
                    if(data > 0)
                    	location.href = '<?php echo Yii::app()->getBaseUrl(); ?>/itemsSales/invoices/View?id='+data;
                    return false;
                    
					$("#login-customer-modal").html(data);
                },
                error: function(data) {
                    alert("Error occured.Please try again!");
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
       
        return false;
	})
})
</script>