<script>
//danh sách khách hàng
function customerList() {
	$('#Quotation_id_customer').select2({
	    placeholder: 'Khách hàng',
	    width: '100%',
	    ajax: {
	        dataType : "json",
	        url      : '<?php echo CController::createUrl('quotations/getCustomerList'); ?>',
	        type     : "post",
	        delay    : 50,
	        data : function (params) {
				return {
					q: params.term, // search term
					page: params.page || 1
				};
			},
			processResults: function (data, params) {
				params.page = params.page || 1;
				
				return {
					results: data,
					pagination: {
						more:true
					}
				};
			},
			cache: true,
	    },
	});
}
// danh sách bác sỹ
function dentistList() {
	$('.group_dentist').select2({
	    placeholder: 'Người thực hiện',
	    width: '130px',
	    ajax: {
	        dataType : "json",
	        url      : '<?php echo CController::createUrl('quotations/getDentistList2'); ?>',
	        type     : "post",
	        delay    : 50,
	        data : function (params) {
				return {
					q: params.term, // search term
					page: params.page || 1
				};
			},
			processResults: function (data, params) {
				params.page = params.page || 1;
				
				return {
					results: data,
					pagination: {
						more:true
					}
				};
			},
			cache: true,
	    },
	});
}
// danh sách dịch vụ
function serviceList(id,text) {
	$('.group_services').select2({
	    placeholder: 'Dịch vụ',
	    width: '270px',
	    ajax: {
	        dataType : "json",
	        url      : '<?php echo CController::createUrl('quotations/getServicesList'); ?>',
	        type     : "post",
	        delay    : 50,
	        data : function (params) {
				return {
					q: params.term, // search term
					page: params.page || 1
				};
			},
			processResults: function (data, params) {
				params.page = params.page || 1;
				return {
					results: data,
					pagination: {
						more:true
					}
				};
			},
			cache: true,
	    },
	});
}
// danh sách sản phẩm
function productList() {
	$('.group_product').select2({
	    placeholder: 'Sản phẩm',
	    width: '100%',
	    ajax: {
	        dataType : "json",
	        url      : '<?php echo CController::createUrl('quotations/getProductList'); ?>',
	        type     : "post",
	        delay    : 50,
	        data : function (params) {
				return {
					q: params.term, // search term
					page: params.page || 1
				};
			},
			processResults: function (data, params) {
				params.page = params.page || 1;
				return {
					results: data,
					pagination: {
						more:true
					}
				};
			},
			cache: true,
	    },
	});
}

$(document).ready(function(){
	$.fn.select2.defaults.set( "theme", "bootstrap" );
	$('.frm_datepicker').datepicker({
		dateFormat: 'dd/mm/yy',
	})

	$('.frm_datepicker').change(function(e){
		create_date = $('#Quotation_create_date').datepicker( "getDate");
		last_date = $('#Quotation_payment_date').datepicker( "getDate");
		if(create_date>=last_date)
			$('#Quotation_payment_date').datepicker( "setDate", create_date);
	})

	var Item = <?php echo CJSON::encode($this->renderPartial('create_item',array('quote_services'=>$quote_services,'form'=>$form,'i'=>'iTemp'),true)); ?>;

	var today = moment().format('DD/MM/YYYY');
	var user_name = '<?php echo $user_name; ?>';
	$('#Quotation_create_date').val(today);
	$('#Quotation_payment_date').val(today);

	/*********** Thêm trường dịch vụ mới trong form báo giá ***********/
	var max_fields  = 10; //maximum input boxes allowed
	var wrapper     = $(".sItem tbody"); //Fields wrapper

	<?php if(!$id_customer){ ?>
		customerList();
	<?php } ?>
	dentistList();
	serviceList();

	var i= <?php echo $x; ?>;
	var y = <?php echo $x; ?>;
	$('.sbtnAdd').click(function(e){
		e.preventDefault();
		$('#sProduct').animate({
       			 scrollTop: $('#sProduct')[0].scrollHeight}, 1000);
	})

	$('#addServices').click(function(e){
	    if(x < max_fields){ 
	        x++;
	        i++;
	        Item = Item.replace(/group_product/g,'group_services');
	       	Item = Item.replace(/id_product/g,'id_service');

	        $(wrapper).append(Item.replace(/iTemp/g,i)); 

		    dentistList();
			productList();
			serviceList();
		}
	});
	$('#addProduct').click(function(e){
	    if(x < max_fields){ 
	        x++;
	        i++;
	        Item = Item.replace(/group_services/g,'group_product');
	       	Item = Item.replace(/id_service/g,'id_product');
		
	        $(wrapper).append(Item.replace(/iTemp/g,i)); 
			
		    dentistList();
			productList();
			serviceList();
		}
	});
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
	    e.preventDefault(); $(this).parents('.currentRow').remove(); x--;
	})

	$('.sNote').click(function(e){
	    e.preventDefault();
	    $('.sNote').hide();
	    $('#sAddNote').removeClass('hidden');
	    
	})
	
	$(wrapper).on('change','.cal',function(e){
		var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    	$('.autoNum').autoNumeric('init',numberOptions);

		data = $('.group').select2('data');
		price = data[0].price * 1000;
		tax = data[0].tax;
		console.log(data);
	
		qty = $(this).parents('tr').find('.group_qty').val();
		if(tax == '')
			tax_qty = '0';
		else
			tax_qty = (tax*qty)/100;

		sum_amount = price * qty;

		$(this).parents('tr').find('.group_unit').autoNumeric('set', price);
		$(this).parents('tr').find('.group_tax').autoNumeric('set', tax_qty);
		$(this).parents('tr').find('.group_amount').autoNumeric('set', sum_amount);

		$(this).parents('tr').find('.s_group_unit').val(price/1000);
		$(this).parents('tr').find('.s_group_tax').val(tax_qty/1000);
		$(this).parents('tr').find('.s_group_amount').val(sum_amount/1000);

		var sum = 0;
		$('.cal_sum').each(function(){
			sum += +$(this).autoNumeric('get');
		})

		$('#sum_amount').autoNumeric('set', sum);
		$('#s_sum_amount').val(sum/1000);
		
	});



	$('form#frm-quote').submit(function(e){
		e.preventDefault();
		

        var formData = new FormData($("#frm-quote")[0]);

        var urlProfile = "<?php echo Yii::app()->getBaseUrl(); ?>";

        if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({ type:"POST",
                url:"<?php echo CController::createUrl('quotations/create')?>",
                data: formData,
                datatype:'json',

                success:function(data){
                    if(data == '1')
                        location.href = '<?php echo Yii::app()->getBaseUrl(); ?>/itemsSales/quotations/view';
                    else if(data == '2')
                    	location.href = '<?php echo Yii::app()->getBaseUrl(); ?>/itemsSales/order/view';
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