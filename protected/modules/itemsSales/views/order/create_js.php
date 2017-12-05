<script>
//danh sách khách hàng
function customerList() {
	$('#Order_id_customer').select2({
	    placeholder: 'Khách hàng',
	    width: '100%',
	    ajax: {
	        dataType : "json",
	        url      : '<?php echo CController::createUrl('quotations/getCustomerList'); ?>',
	        type     : "post",
	        delay    : 1000,
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
function dentistList(group) {
	$('.group_dentist').select2({
	    placeholder: '',
	    width: '130px',
	    ajax: {
	        dataType : "json",
	        url      : '<?php echo CController::createUrl('quotations/getDentistList2'); ?>',
	        type     : "post",
	        delay    : 1000,
	        data : function (params) {
				return {
					q    : params.term, // search term
					page : params.page || 1,
					group: group
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
	    width: '247px',
	    ajax: {
	        dataType : "json",
	        url      : '<?php echo CController::createUrl('quotations/getServicesList'); ?>',
	        type     : "post",
	        delay    : 1000,
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
	    width: '247px',
	    ajax: {
	        dataType : "json",
	        url      : '<?php echo CController::createUrl('quotations/getProductList'); ?>',
	        type     : "post",
	        delay    : 1000,
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

function DisVal(type,val,sum) {
	ans = 0;
	switch(type) {
		case 1: 		// phan tram
			ans = (sum*val)/100;
			break;
	}

	return ans*-1;
}

function resizeTable() {
	tableH = $('.sItem tbody').height();
	if(tableH < 190)
		$('.sItem tbody').css('margin-right',0);
	else
		$('.sItem tbody').css('margin-right','-17px');
}

$(document).ready(function(){

resizeTable();

	$('[data-toggle="tooltip"]').tooltip();
	
	$.fn.select2.defaults.set( "theme", "bootstrap" );
	$('.frm_datepicker').datepicker({
		dateFormat: 'dd/mm/yy',
	})

	$('.frm_datepicker').change(function(e){
		create_date = $('#Order_create_date').datepicker( "getDate");
		last_date   = $('#Order_complete_date').datepicker( "getDate");
		if(create_date>=last_date)
			$('#Order_complete_date').datepicker( "setDate", create_date);
	})

	var Item = <?php echo CJSON::encode($this->renderPartial('item_detail',array('orderNew'=>$orderDetail,'form'=>$form,'i'=>'iTemp'),true)); ?>;
	var ItemPro = <?php echo CJSON::encode($this->renderPartial('item_pro',array('orderNew'=>$orderDetail,'form'=>$form,'i'=>'iTemp'),true)); ?>;

	var today = moment().format('DD/MM/YYYY');
	var user_name = '<?php echo $user_name; ?>';
	$('#Order_create_date').val(today);
	$('#Order_complete_date').val(today);

	/*********** Thêm trường dịch vụ mới trong form báo giá ***********/
	var max_fields  = 50; //maximum input boxes allowed
	var wrapper     = $(".sItem tbody"); //Fields wrapper

	<?php if(!$id_customer){ ?>
		customerList();
	<?php } ?>
	
	dentistList(3);
	serviceList();

	var i = <?php echo $x; ?>;
	var x = <?php echo $x; ?>;
	
	$('.sbtnAdd').click(function(e){
		e.preventDefault();
		resizeTable();
		$('#sProduct table tbody').animate({
       			 scrollTop: $('#sProduct table tbody')[0].scrollHeight}, 1000);
	})

	$('#addServices').click(function(e){
	    if(x < max_fields){
	        x++;
	        i++;
	        Item = Item.replace(/group_product/g,'group_services');
	       	Item = Item.replace(/id_product/g,'id_service');

	        $(wrapper).append(Item.replace(/iTemp/g,i));
	    	$('#OrderDetail_'+i+'_id_user').html('');

		    dentistList(3);
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
	// xoa dich vu
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
	    e.preventDefault();
	    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    	$('.autoNum').autoNumeric('init',numberOptions);

	    sum = $(this).parents('tr').find('.cal_sum').autoNumeric('get');
	    total = $('#sum_amount').autoNumeric('get');
	    $('#sum_amount').autoNumeric('set', total - sum);
	    $('#u_sum_amount').autoNumeric('set', total - sum);

	    tax = $(this).parents('tr').find('.group_tax').autoNumeric('get');
	    taxS = $('#sum_tax').autoNumeric('get');
	    $('#sum_tax').autoNumeric('set', taxS - tax);
	    $('#us_sum_tax').autoNumeric('set', taxS - tax);

	    $(this).parents('.currentRow').remove(); x--;
	})

	// them discount tung san pham
	$(wrapper).on('click','.addIDis',function(e){
		e.preventDefault();

		tp = $('.currentRow').height();
		wd = $('.currentRow').width();
		classN = $(this).parents('tr').attr('class').split(' ');
		
		var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    	$('.autoNum').autoNumeric('init',numberOptions);

	    sum = $(this).parents('tr').find('.cal_sum').autoNumeric('get');

	    $('.addIDisPop').css({
	    	top: (e.clientY - tp - 8 -95)+'px',
	    	left: (wd - 350/2 - 24)+'px',
	    });

	    $('.addIDisPop').fadeToggle('fast');

	    $('.choseIDisType').change(function (e) {
			idType = $('.choseIDisType').val();
			
			if(idType && sum > 0) {
				$('.alyIDis').show();
			}
			else
				$('.alyIDis').hide();
		})

	    $('.alyIDis').unbind().click(function (e) {

			x++;
	        i++;
	        $type = $('.choseIDisType').find(':selected');

	        disType = $type.data('type');
	        disDis  = $type.data('dis');
	        
	        ans = DisVal(1,disDis,sum);

	        ItemP = ItemPro.replace(/id_discount_val/g,$type.val());
	       	ItemP = ItemP.replace(/discount_val/g,$type.text());
	       	ItemP = ItemP.replace(/unit_price_val/g,ans);

		    total = $('#sum_amount').autoNumeric('get');
		    $('#sum_amount').autoNumeric('set', parseInt(ans) + parseInt(total));
		    $('#s_sum_amount').val(parseInt(ans) + parseInt(total));

	        $(ItemP.replace(/iTemp/g,i)).insertAfter('tr.'+classN[1]);

		    dentistList();
		    $('.addIDisPop').hide();
		})
	})

	$('.cancelIDis').click(function(e){
		$('.addIDisPop').hide();
	})

	$('.sNote').click(function(e){
	    e.preventDefault();
	    $('.sNote').hide();
	    $('#sAddNote').removeClass('hidden');
	    
	});

	$(wrapper).on('change','.cal',function(e){
		var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    	$('.autoNum').autoNumeric('init',numberOptions);

		select = $(this).parents('tr').find('.group');

		data 		= select.select2('data');
		price 		= parseInt(data[0].price);
		tax 		= parseFloat(data[0].tax);
		text 		= data[0].text;

		$(this).parents('tr').find('.quote_des').val(text);
		qty = $(this).parents('tr').find('.group_qty').val();
		//qty = 1;
		
		if(tax == '' || isNaN(tax))
			tax_qty = 0;
		else
			tax_qty = (tax*qty*price)/100;

		sum_amount = price*qty + tax_qty;

		$(this).parents('tr').find('.group_unit').autoNumeric('set', price);
		$(this).parents('tr').find('.group_tax').autoNumeric('set', tax_qty);
		$(this).parents('tr').find('.group_amount').autoNumeric('set', sum_amount);

		$(this).parents('tr').find('.s_group_unit').val(price);
		$(this).parents('tr').find('.s_group_tax').val(tax_qty);
		$(this).parents('tr').find('.s_group_amount').val(sum_amount);

		var sum = 0;
		$('.cal_sum').each(function(){
			sum += +$(this).autoNumeric('get');
		});

		var tax = 0;
		$('.cal_tax').each(function(){
			tax += +$(this).autoNumeric('get');
		})

		$('#sum_amount').autoNumeric('set', sum);
		$('#s_sum_amount').val(sum);

		$('#sum_tax').autoNumeric('set', tax);
		$('#s_sum_tax').val(tax);
	});

	// add discount 
	$('#addDis').click(function(e){
		$('#addDisPop').fadeToggle('fast');
	})

	// cancel discount 
	$('#cancelDis').click(function(e){
		$('#addDisPop').hide();
	})

	$('#choseDisType').change(function (e) {
		idType = $('#choseDisType').val();
		tolSum = $('#sum_amount').autoNumeric('get');
		
		if(idType && tolSum > 0) {
			$('#alyDis').show();
		}
		else
			$('#alyDis').hide();
	})

	$('#alyDis').click(function (e) {
		x++;
        i++;
        $type = $('#choseDisType').find(':selected');

        disType = $type.data('type');
        disDis  = $type.data('dis');
        tolSum = $('#s_sum_amount').val();

        ans = DisVal(1,disDis,tolSum);

        ItemP = ItemPro.replace(/id_discount_val/g,$type.val());
       	ItemP = ItemP.replace(/discount_val/g,$type.text());
       	ItemP = ItemP.replace(/unit_price_val/g,ans);

	    total = $('#sum_amount').autoNumeric('get');
	    $('#sum_amount').autoNumeric('set', parseInt(ans) + parseInt(total));
	    $('#s_sum_amount').val(parseInt(ans) + parseInt(total));

        $(wrapper).append(ItemP.replace(/iTemp/g,i));

	    dentistList();
	    $('#addDisPop').hide();
	});


	$('form#frm-order').submit(function(e){
		e.preventDefault();
		
		var id_customer= $('#id_customer').val();

        var formData = new FormData($("#frm-order")[0]);

        if (!formData.checkValidity || formData.checkValidity()) {
        	$('.cal-loading').fadeIn('fast');
            jQuery.ajax({ 
				type    :"POST",
				url     :"<?php echo CController::createUrl('order/createOrder')?>",
				data    : formData,
				datatype:'json',

                success:function(data){
					console.log(data);
                    if(data == '1')
                    	location.href = '<?php echo Yii::app()->getBaseUrl(); ?>/itemsSales/order/view';
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