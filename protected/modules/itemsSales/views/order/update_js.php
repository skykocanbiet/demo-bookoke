<script>
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

$(function() {
    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    $('.autoNum').autoNumeric('init',numberOptions);

    $('[data-toggle="tooltip"]').tooltip();

	$.fn.select2.defaults.set( "theme", "bootstrap" );

	$('.frm_datepicker').datepicker({
		dateFormat: 'dd/mm/yy',
	})

	dentistList(3);
	serviceList();

	var uItem = <?php echo CJSON::encode($this->renderPartial('item_detail',array('orderNew'=>$orderNew,'form'=>$form,'i'=>'iTemp'),true)); ?>;
	var ItemPro = <?php echo CJSON::encode($this->renderPartial('item_pro',array('orderNew'=>$orderNew,'form'=>$form,'i'=>'iTemp'),true)); ?>;

	/*********** Thêm trường dịch vụ mới trong form báo giá ***********/
	var max_fields  = 10; //maximum input boxes allowed
	var wrapper     = $(".sItem tbody"); //Fields wrapper

	var i= <?php echo $i; ?>;
	var x = <?php echo $i; ?>;

	$('.sbtnAdd').click(function(e){
		e.preventDefault();
		$('#usProduct table tbody').animate({
       			 scrollTop: $('#usProduct  table tbody')[0].scrollHeight}, 1000);
	})

	$('#upAddServices').click(function(e){
	    if(x < max_fields){ 
	        x++;
	        i++;
	        uItem = uItem.replace(/group_product/g,'group_services');
	       	uItem = uItem.replace(/id_product/g,'id_service');

	        $(wrapper).append(uItem.replace(/iTemp/g,i));
	        $('.quote_id_user_'+i).html('');
	        console.log($('.quote_id_user_'+i).html(''));

		    dentistList(3);
			productList();
			serviceList();
		}
	});
	$('#upAddProduct').click(function(e){
	    if(x < max_fields){ 
	        x++;
	        i++;
	        uItem = uItem.replace(/group_services/g,'group_product');
	       	uItem = uItem.replace(/id_service/g,'id_product');
		
	        $(wrapper).append(uItem.replace(/iTemp/g,i)); 
			
		    dentistList();
			productList();
			serviceList();
		}
	});

	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
	    e.preventDefault();

	    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    	$('.autoNum').autoNumeric('init',numberOptions);
	    
	    sum = $(this).parents('tr').find('.cal_sum').autoNumeric('get');
	    total = $('#u_sum_amount').autoNumeric('get');
	    $('#u_sum_amount').autoNumeric('set', total - sum);

	    tax = $(this).parents('tr').find('.group_tax').autoNumeric('get');
	    taxS = $('#u_sum_tax').autoNumeric('get');
	    $('#u_sum_tax').autoNumeric('set', taxS - tax);

	    $(this).parents('.currentRow').addClass('hidden');
	    $(this).parents('.currentRow').find('.quote_del').val(1);
	    x--;
	})

	$(wrapper).on('click','.addIDis',function(e){
		e.preventDefault();

		// reset pop
		$('.alyUppIDis').hide();	
		$('.choseUppIDisType').val(0);

		tp = $(this).parents('tr').height();
		wd = $(this).parents('tr').width();
		classN = $(this).parents('tr').attr('class').split(' ');
		
		var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    	$('.autoNum').autoNumeric('init',numberOptions);

	    sum = $(this).parents('tr').find('.cal_sum').autoNumeric('get');

	    $('.uppIDisPop').css({
	    	top: (e.clientY - tp - 8 -95)+'px',
	    	left: (wd - 350/2 + 13 )+'px',
	    });

	    $('.uppIDisPop').fadeToggle('fast');

	    $('.choseUppIDisType').change(function (e) {
			idType = $('.choseUppIDisType').val();
			
			if(idType && sum > 0) {
				$('.alyUppIDis').show();
			}
			else
				$('.alyUppIDis').hide();
		})

	    $('.alyUppIDis').unbind().click(function (e) {

			x++;
	        i++;
	        $type = $('.choseUppIDisType').find(':selected');

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
		    $('.uppIDisPop').hide();
		})
	})

	$('.cancelUppIDis').click(function(e){
		$('.uppIDisPop').hide();
	})

	$('.sNote').click(function(e){
	    e.preventDefault();
	    $('.sNote').hide();
	    $('#usAddNote').removeClass('hidden');
	})

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
		if(tax == ''|| isNaN(tax))
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
		})

		var tax = 0;
		$('.cal_tax').each(function(){
			tax += +$(this).autoNumeric('get');
		})

		$('#u_sum_tax').autoNumeric('set', tax);
		$('#us_sum_tax').val(tax);

		$('#u_sum_amount').autoNumeric('set', sum);
		$('#us_sum_amount').val(sum);
		
	});

	// add discount 
	$('#upAddDis').click(function(e){
		$('#upAddDisPop').fadeToggle('fast');
	})

	// cancel discount 
	$('#upCancelDis').click(function(e){
		$('#upAddDisPop').hide();
	})

	$('#upChoseDisType').change(function (e) {
		idType = $('#upChoseDisType').val();
		if(idType) {
			$('#upAlyDis').show();
		}
		else
			$('#upAlyDis').hide();
	})

	$('#upAlyDis').click(function (e) {
		x++;
        i++;
        $type = $('#upChoseDisType').find(':selected');

        disType = $type.data('type');
        disDis  = $type.data('dis');
        tolSum = $('#us_sum_amount').val();

        ans = DisVal(1,disDis,tolSum);

        ItemP = ItemPro.replace(/id_discount_val/g,$type.val());
       	ItemP = ItemP.replace(/discount_val/g,$type.text());
       	ItemP = ItemP.replace(/unit_price_val/g,ans);

	    total = $('#u_sum_amount').autoNumeric('get');
	    $('#u_sum_amount').autoNumeric('set', parseInt(ans) + parseInt(total));
	    $('#us_sum_amount').val(parseInt(ans) + parseInt(total));

        $(wrapper).append(ItemP.replace(/iTemp/g,i));

	    dentistList();
	    $('#upAddDisPop').hide();
	});

	$('form#frm-update-order').submit(function(e){
		e.preventDefault();	
		
		var id_customer= $('#id_customer').val();

        var formData = new FormData($("#frm-update-order")[0]);

        if (!formData.checkValidity || formData.checkValidity()) {
        	//$('.cal-loading').fadeIn('fast');
            jQuery.ajax({ type:"POST",
                url:"<?php echo CController::createUrl('order/updateOrder')?>",
                data: formData,
                datatype:'json',

                success:function(data){
					
                    if(data == '1')
                    	location.href = '<?php echo Yii::app()->getBaseUrl(); ?>/itemsSales/order/view';
                    return false;
                    
					$("#frm-update-quote").html(data);
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