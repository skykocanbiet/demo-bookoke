<script>
function hideE(e) {
	$('.pay_amount').css('border','1px solid #ccc');
	$('#reCurr').css('border','1px solid #ccc');
}
function showE(e) {
	$('.pay_amount').css('border','1px solid red');
	$('#reCurr').css('border','1px solid red');
}
// kiem tra gia tri nhap
	function checkNum() {
		pay_type   = $('.pay_type').val();
		balance    = parseFloat($('.balance').autoNumeric('get'));			// con no
		pay_amount = parseFloat($('.pay_amount').autoNumeric('get'));			// tien tra
		reCurr     = parseFloat($('#reCurr').autoNumeric('get'));			// tien nhan
		promotion  = parseFloat($('.pay_promotion').autoNumeric('get'));		// khuyen mai
		insurance  = parseFloat($('.pay_insurance').autoNumeric('get'));		// bao hiem
		currExchange = parseFloat($('#pay_receive').autoNumeric('get'));

		cur      = $('#selCurr').val();					// don vi tien nhan tu khach
		invCurr  = '<?php echo $inv['currency_use']; ?>';	// don vi tien cua hoa don

		if(pay_type != 1)
			refund = 0;
		else
			refund = $('#pay_refund').autoNumeric('get');
		
		if(balance < 0 || pay_amount <= 0) {
			showE();
			return 0;
		}
		if(pay_type == 1) {			// tien mat
			if(invCurr == 'VND' && cur != 'VND'){
				if((promotion + insurance + currExchange) < pay_amount || reCurr < 0) {
					showE();
					return 0;
				}
			}
			else if((promotion + insurance + reCurr) < pay_amount || reCurr < 0) {
				showE();
				return 0;
			}
		}

		hideE();
		return 1;	
	}
// tinh tien con no
	function getBalance(balance) {
		if(!balance) {
			balance = $('#sumWOwe').autoNumeric('get');
		}

		amount    = $('.pay_amount').autoNumeric('get');
		if(amount == '')
			amount = 0;

		pay_amount = $('.pay_amount').autoNumeric('get');
		insurance  = $('.pay_insurance').autoNumeric('get');
		promotion  = $('.pay_promotion').autoNumeric('get');
		reCurr     = $('#reCurr').autoNumeric('get');
		pay_type   = $('.pay_type').val();

		minus = balance - pay_amount;

		$('.balance').autoNumeric('set',minus);
	}
// tinh diem
	function getPoint(pay_amount) {
		pointValue = $('#pointValue').val();

		point =  parseInt(parseInt(pay_amount) / parseInt(pointValue));

		$('#receiptPoint').val(point);
	}
// phi thanh toan bang the tin dung
	function cardFee(feePercent, feeType, feePay) {
		//feeTrans = (feePay * feePercent)/100;
		feePercent = 0;
		feeTrans = $('.transFee').autoNumeric('get');
		$('.feeSumCard').autoNumeric('set',parseInt(feePay)+parseInt(feeTrans));
		$('#card_percent').val(feePercent);
		$('#pay_receive').autoNumeric('set',parseInt(feePay)+feeTrans);
	}
// tinh tien hoan lai
	function getRefund(valExchange, invCurr, curr) {
		amount  = parseFloat($('.pay_amount').autoNumeric('get'));		// tien tra
		receive = parseFloat($('#reCurr').autoNumeric('get'));			// tien nhan
		currEx = parseFloat($('#pay_receive').autoNumeric('get'));		// so tien quy doi

		insurance  = parseFloat($('.pay_insurance').autoNumeric('get'));	// bh
		promotion  = parseFloat($('.pay_promotion').autoNumeric('get'));	// km

		refund   = receive - (amount - insurance - promotion);
		pay_sum  = amount - insurance - promotion;
		curr_sum = pay_sum;

		if(invCurr != 'VND'){
			curr_sum = pay_sum * valExchange;
		}

		// hoa don ngoai te - thanh toan tien VND
		if(curr == 'VND' && invCurr != 'VND'){
			refund   = ((currEx + insurance + promotion) - amount) * valExchange;
		}
		// hoa don VND - tien khach dua USD
		else if(invCurr == 'VND' && valExchange){
			refund = currEx - (amount - insurance - promotion);	
		}

		if(refund < 0)
			refund = 0;

		$('#pay_sum').val(pay_sum);
		$('#curr_sum').val(curr_sum);
		$('#pay_refund').autoNumeric('set',parseInt(refund));

		getPoint(curr_sum);
	}

$(function(){
	var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false, vMin: 0, wEmpty: 'allow'};
	$('.autoNum').autoNumeric('init',numberOptions);

	var today = moment().format('YYYY-MM-DD HH:mm:ss');
	$('.today').text(today);

	$('.pay_type').val(1);
	$('#card_percent').val('');

/*********** thanh toan bang the tin dung ***********/
	$('.transFee').on('keyup keypress', function () {
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
		$('#pay_refund').autoNumeric('set',0);

		// the tin dung
		if(pay_type == 2){
			cardType   = $('.cardType').val();
			feePercent = $('.cardType').data('fee');
			
			//cardFee(feePercent, cardType, feePay);
			$('.creditType').show();
			$('.cashType').hide();
			$('.transFee').val();
			$('.CurrType').hide();
		}
		else {
			$('.creditType').hide();
			$('.cashType').show();	
			$('.transFee').val('0');
			$('#card_percent').val('');
			$('.feeSumCard').val(0);
		}
	});
/*********** thanh toan ngoai te ***********/
	$('#selCurr').click(function (e) {
		e.preventDefault();
		pay_type = $('.pay_type').val();
		numCurr = $('#selCurr option').length;
		
		if(numCurr == 1 && pay_type == 1) {
			$('#info_content').text("Không lấy được dữ liệu tỷ giá. Vui lòng thử lại sau!");
			$('#info').modal();
			return;
		}
	});

	$('.chgCurr, .pay').on('change keyup keypress',function(e) {
		pay_type = $('.pay_type').val();				// hinh thuc thanh toan
		cur      = $('#selCurr').val();					// don vi tien nhan tu khach
		bl       = $('#sumWOwe').autoNumeric('get');	// so tien còn nợ
		invCurr  = '<?php echo $inv['currency_use']; ?>';	// don vi tien cua hoa don
		reCurr = $('#reCurr').autoNumeric('get');		// so tien nhan tu khach
		//balance   = parseInt($('#sumWOwe').autoNumeric('get'));

		if(pay_type == 1)
			curBuy  = $('#selCurr').find(':selected').data('buy');
		else if(pay_type == 2) {
			curBuy  = $('#selCurr').find(':selected').data('trans');
			$('#pay_refund').val(0);
		}

		currExchange    = parseFloat(reCurr) * curBuy;

		// hoa don tien USD - tien nhan tu khach VND
		if(invCurr != 'VND' && cur == 'VND'){
			curBuy = parseInt($('#selCurr option:selected').next().data('buy'));
			currExchange    = parseFloat(reCurr) / curBuy;
		}

		$('#pay_receive').autoNumeric('set',currExchange);

		if(cur != invCurr) {
			$('.CurrType').show();
			$('#reType').text("VND");
		}
		else {
			$('.CurrType').hide();
			$('#reType').text(invCurr);
		}
		
		getRefund(curBuy,invCurr, cur);
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

			/*sum     = $('#sumWTax').autoNumeric('get');
			owe     = parseFloat($('#sumWOwe').autoNumeric('get'));
			tax     = parseFloat(sum*10/100);
			sumWTax = parseInt(sum) + tax;

			$('#taxVat').autoNumeric('set',tax);
			$('#sumWTax').autoNumeric('set',sumWTax);
			$('#sumWOwe').autoNumeric('set',tax + owe);

			getBalance(tax+owe);*/
		}
		else {
			$('.dVAT').hide();
			$('#dvTaxVat').hide();
			$('#sumWTax').autoNumeric('set',<?php echo $inv['sum_amount']; ?>);
			$('#sumWOwe').autoNumeric('set',<?php  echo $inv['balance']; ?>);
			$('#taxVat').autoNumeric('set',0);
			$('.pay_amount').autoNumeric('set', <?php  echo $inv['balance']; ?>);
			$('#vat_value').val(0);

			balance = parseInt(<?php  echo $inv['balance']; ?>);
			getBalance(balance);
		}
	})

	$('#vat_value').keyup(function (e) {
		taxValue = $('#vat_value').val();
		if(taxValue == ''){
			taxValue = 0;
			$('#vat_value').val(0);
		}
		sum     = <?php echo $inv['sum_amount']; ?>;		// tong tien don hang
		priceDefaul = <?php echo $inv['balance']; ?>;		// so tien con no
		taxVat = (parseInt(sum) * parseInt(taxValue))/100;		// thue

		newPrice = parseInt(priceDefaul) + parseInt(taxVat);		// tien + thue

		sumWTax = parseInt(sum) + parseInt(taxVat);

		$('#taxVat').autoNumeric('set',taxVat);
		$('#sumWTax').autoNumeric('set',sumWTax);
		$('#sumWOwe').autoNumeric('set',newPrice);
		$('.pay_amount').autoNumeric('set', newPrice);

		getBalance(newPrice);
	})
/*********** submit form ***********/
	$('form#frm-pay-invoice').submit(function(e){
		e.preventDefault();
		
		if(!checkNum())
			return false;

		dis = $('#ck_VAT').is('[disabled]');
		
		if(dis == false) {
			date_vat = $('#vat_date').val();
			ch = moment(date_vat,'DD/MM/YYYY').format('YYYY-MM-DD HH:mm:ss');
			$('#vat_date').val(ch);
		}

		$('form#frm-pay-invoice input.autoNum').each(function(i){
	        var self = $(this);
            var v = self.autoNumeric('get');
            self.autoNumeric('destroy');
            self.val(v);
	    });

        var formData = new FormData($("#frm-pay-invoice")[0]);

        if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({ 
				type    :"POST",
				url     :"<?php echo CController::createUrl('invoices/invoicesPay')?>",
				data    : formData,
				datatype:'json',

                success:function(data){
                	console.log(data);
                    if(data > 0)
                    	location.href = '<?php echo Yii::app()->getBaseUrl(); ?>/itemsSales/invoices/View?id='+data;
                    return false;
                    
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