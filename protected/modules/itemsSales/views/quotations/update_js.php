<script>
/*********** Lay danh sach nha sy ***********/
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
/*********** Lay danh sach dich vu ***********/
	function serviceList(id_prB, id = '') {
		$id_prB = $('#priceBookUp').val();
		if(id == '') {
			$('.group_services').select2({
			    placeholder: 'Dịch vụ',
			    width: '248px',
			    ajax: {
			        dataType : "json",
			        url      : '<?php echo CController::createUrl('quotations/getServicesList'); ?>',
			        type     : "post",
			        delay    : 1000,
			        data : function (params) {
						return {
							q     : params.term, // search term
							page  : params.page || 1,
							id_prB: id_prB,
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
			    },
			});
		}
		else {
			$('#'+id).select2({
			    placeholder: 'Dịch vụ',
			    width: '248px',
			    ajax: {
			        dataType : "json",
			        url      : '<?php echo CController::createUrl('quotations/getServicesList'); ?>',
			        type     : "post",
			        delay    : 1000,
			        data : function (params) {
						return {
							q   : params.term, // search term
							page: params.page || 1,
							id_prB: id_prB,
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
	}
/*********** Lay danh sach san pham ***********/
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
/*********** Chinh kich thuoc bang ***********/
	function resizeTable() {
		tableH = $('#usProduct .sItem tbody').height();
		if(tableH < 190)
			$('#usProduct .sItem tbody').css('margin-right',0);
		else
			$('#usProduct .sItem tbody').css('margin-right','-17px');
	}
/*********** Tinh tong gia tri san pham dich vu ***********/
	function calSum() {
		var sum = 0;
		$('.cal_sum').each(function(){
			sum += +$(this).autoNumeric('get');
		});

		var tax = 0;
		$('.cal_tax').each(function(){
			tax += +$(this).autoNumeric('get');
		})

		$('#u_sum_amount').autoNumeric('set', sum);
		$('#us_sum_amount').val(sum);

		$('#u_sum_tax').autoNumeric('set', tax);
		$('#us_sum_tax').val(tax);
	}
/*********** Tinh gia tri giam gia ***********/
	function DisVal(type,val,sum) {
		ans = 0;
		switch(type) {
			case 1: 		// phan tram
				ans = (sum*val)/100;
				break;
			case 2: 		// giam gia theo so tien
				ans = val;
		}
		return ans*-1;
	}
/*********** Lay danh sach khuyen mai ***********/
	function getPromotionList() {
		$('.proNo').show();
		$('.proCt').hide();
		$.ajax({ 
			type    :"POST",
			url     :"<?php echo CController::createUrl('quotations/getPromotionList')?>",
			dataType:'json',

	        success:function(data){
	        	if(data.length == 0) {
	        		$('.proNo').show();
					$('.proCt').hide();
	        	}
	        	else {
	        		opPro = '<option value="0">Chọn khuyến mãi</option>';
	        		$.each(data, function (k, v) {
	        			opPro = opPro + '<option value="'+v.id+'" data-type="'+v.type_price+'" data-value="'+v.price+'">'+v.name+'</option>';
	        		});
	        		$('.upChoseDisType').html(opPro);
	        		$('.proNo').hide();
					$('.proCt').show();
	        	}
	        },
	        error: function(data) {
	            alert("Error occured.Please try again!");
	        },
	    });
	}
/*********** Hien item khuyen mai ***********/
	function showPro(ItemPro, x, i, sum, oneI = '', clsN = '', wrapper, $type) {
		x++;
        i++;

        if($type == '') {
        	$type = $('.upChoseDisType').find(':selected');
        }

		disType  = $type.data('type');
		disValue = $type.data('value');

        ans = DisVal(disType,disValue,sum);

        ItemP = ItemPro.replace(/id_discount_val/g,$type.val());
       	ItemP = ItemP.replace(/discount_val/g,$type.text());
       	ItemP = ItemP.replace(/unit_price_val/g,ans);

	    total = $('#u_sum_amount').autoNumeric('get');
	    $('#u_sum_amount').autoNumeric('set', parseInt(ans) + parseInt(total));
	    $('#us_sum_amount').val(parseInt(ans) + parseInt(total));
	   
	    if(oneI == 1)
	    	$(ItemP.replace(/iTemp/g,i)).insertAfter('tr.'+clsN);
	    else
	    	$(wrapper).append(ItemP.replace(/iTemp/g,i));

	    resizeTable();

	    dentistList();
	    $('.addDisPop').hide();
	}
/*********** Lay thong tin bang gia  ***********/
	function getPricBooke(id_seg) {
		$.ajax({
			type    :"POST",
			url     :"<?php echo CController::createUrl('quotations/getPriceBook')?>",
			data    : {id_seg: id_seg},
			dataType:'json',
			success: function (data) {
				id_prB = data.id;
				if(data != 0){
					$('#priceBookUp').val(data.id);
					$('#currency_user').val(data.currency_code);
					$('.curUnit').text(data.currency_code);
				}
				else {
					$('#priceBook').val('');
					$('#currency_user').val('VND');	
					$('.curUnit').text('VND');
				}
				serviceList(id_prB);
			}
		});
		
	}
$(function() {
/*********** Khoi tao gia tri ***********/
	$('.chosType').attr('class','form-control chosType upChoseDisType');
    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    $('.autoNum').autoNumeric('init',numberOptions);

    $('[data-toggle="tooltip"]').tooltip();

	$.fn.select2.defaults.set( "theme", "bootstrap" );

	$('.frm_datepicker').datepicker({
		dateFormat: 'dd/mm/yy',
	})

	dentistList(3);

	var id_seg = "<?php echo $quote['id_segment']; ?>";

	if(id_seg)
		getPricBooke(id_seg);
	else
		serviceList();

	var uItem = <?php echo CJSON::encode($this->renderPartial('item_detail',array('quote_services'=>$quote_up,'form'=>$form,'i'=>'iTemp'),true)); ?>;
	var ItemPro = <?php echo CJSON::encode($this->renderPartial('item_pro',array('quote_services'=>$quote_up,'form'=>$form,'i'=>'iTemp'),true)); ?>;
/*********** Thêm trường dịch vụ mới trong form báo giá ***********/
	var max_fields  = 50; //maximum input boxes allowed
	var wrapper     = $(".sItem tbody"); //Fields wrapper

	var i= <?php echo $i; ?>;
	var x = <?php echo $i; ?>;

	$('.sbtnAdd').click(function(e){
		e.preventDefault();
		resizeTable();
		$('#usProduct table tbody').animate({
       		scrollTop: $('#usProduct  table tbody')[0].scrollHeight}, 1000);
	})

	$('#upAddServices').click(function(e){
	    btnActive = $('.upsbtnAdd').hasClass('btn_unactive');
		if(btnActive)
			return;

	    if(x < max_fields){ 
	        x++;
	        i++;
	        uItem = uItem.replace(/group_product/g,'group_services');
	       	uItem = uItem.replace(/id_product/g,'id_service');

	        $(wrapper).append(uItem.replace(/iTemp/g,i));
	        $('.quote_id_user_'+i).html('');

	        seg = $('#priceBookUp').val();

		    dentistList(3);
			serviceList(seg);
			resizeTable();
			$('.upsbtnAdd').addClass('btn_unactive').removeClass('btn_bookoke');
		}
	});
	$('#upAddProduct').click(function(e){
	    btnActive = $('.upsbtnAdd').hasClass('btn_unactive');
		if(btnActive)
			return;

	    if(x < max_fields){ 
	        x++;
	        i++;
	        uItem = uItem.replace(/group_services/g,'group_product');
	       	uItem = uItem.replace(/id_service/g,'id_product');
		
	        $(wrapper).append(uItem.replace(/iTemp/g,i)); 
			
			dentistList();
			productList();
			resizeTable();
			$('.upsbtnAdd').addClass('btn_unactive').removeClass('btn_bookoke');
		}
	});
/*********** Xóa dịch vụ ***********/
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

	    old = $(this).parents('.currentRow').find('.idupQuote').val();
	    
	    if(old){
		    $(this).parents('.currentRow').addClass('hidden');
		    $(this).parents('.currentRow').find('.quote_del').val(1);
	    }
	    else {
	    	$(this).parents('.currentRow').remove();
	    }
	    x--;

	    if(x == 0){
	    	$('.upsbtnAdd').removeClass('btn_unactive').addClass('btn_bookoke');
	    }
	    else {
			itemValue = $('.tableQuote tr:last').find('.group').val();

			if(itemValue)
				$('.upsbtnAdd').removeClass('btn_unactive').addClass('btn_bookoke');
			else
				$('.upsbtnAdd').addClass('btn_unactive').removeClass('btn_bookoke');
	    }
	})
/*********** Ghi chu ****************/
	$('.sNote').click(function(e){
	    e.preventDefault();
	    $('.sNote').hide();
	    $('#usAddNote').removeClass('hidden');
	})
/*********** So luong rang ***********/
	$('.cal_teeth').on('keypress',function(e){
		k = e.keyCode;
		valid = false;
		if(k == 32){
			valid = false;
		}
		else if(k == 188 || k == 44 || k == 116 || (k<=35 && k<=40)) {
			valid = true;
		}
		else if(48 <= k && k <= 57) {
			valid = true;
		}

		if(valid == false){
			e.preventDefault();
		}
	})
	$(wrapper).on('keyup','.cal_teeth',function(e){
		teeth    = $(this).val();
		numT     = teeth.split(',');
		qty      = numT.length;
		lastChar = teeth.substr(teeth.length - 1);
		
		if(lastChar == ','){
			qty = qty - 1;
		}
		$(this).parents('tr').find('.cal_qty').val(qty);

		select = $(this).parents('tr').find('.group');
		price = $(this).parents('tr').find('.group_unit').autoNumeric('get');

		data 		= select.select2('data');
		if(data.length == 0)
			return;
		
		tax 		= parseFloat(data[0].tax);

		if(tax == '' || isNaN(tax))
			tax_qty = 0;
		else
			tax_qty = (tax*qty*price)/100;

		sum_amount = parseInt(price)*parseInt(qty) + parseInt(tax_qty);

		$(this).parents('tr').find('.group_tax').autoNumeric('set', tax_qty);
		$(this).parents('tr').find('.group_amount').autoNumeric('set', sum_amount);

		$(this).parents('tr').find('.s_group_tax').val(tax_qty);
		$(this).parents('tr').find('.s_group_amount').val(sum_amount);

		calSum();
	});
/*********** tinh toan gia tri san pham ***********/
	$(wrapper).on('change','.cal',function(e){
		var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    	$('.autoNum').autoNumeric('init',numberOptions);

    	itemValue = $('.sItem tr:last .group').val();

    	if(itemValue)
			$('.upsbtnAdd').removeClass('btn_unactive').addClass('btn_bookoke');
		else
			$('.upsbtnAdd').addClass('btn_unactive').removeClass('btn_bookoke');

    	select = $(this).parents('tr').find('.group');
		data  = select.select2('data');
		if(data.length == 0)
			return;

		price 		= (data[0].price) ? parseInt(data[0].price) : 0;
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
/*********** Thêm khuyen mai tung dich vu ***********/
	// pop up khuyen mai tung dich vu
	$(wrapper).on('click','.addIDis',function(e){
		e.preventDefault();
		var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    	$('.autoNum').autoNumeric('init',numberOptions);
		

		$('.alyDis').addClass('upIDis');
		
		tp = $('.currentRow').height();
		wd = $('#usProduct').width();
		classN = $(this).parents('tr').attr('class').split(' ');

	    $('.addDisPop').css({
	    	top: (e.clientY - tp - 169)+'px',
	    	left: (wd - 164)+'px',
	    });

	    sumItem = $(this).parents('tr').find('.cal_sum').autoNumeric('get');
	    if(sumItem > 0)
			getPromotionList();

	    $('.helpPro').hide();
	    $('.addDisPop').show();

		// xac nhan khuyen mai
		$('.alyDis').unbind().click(function (e) {
			if($('.upIDis').hasClass('upIDis')){
				showPro(ItemPro, x, i, sumItem, 1, classN[1], wrapper, $type);
			}
			else {
				tolSum   = $('#u_sum_amount').autoNumeric('get');
				showPro(ItemPro, x, i, tolSum, 0, '', wrapper, $type);
			}
		});
	})
/*********** Khuyen mai tong don hang****************/
	// add discount - them khuyen mai cho tong bao gia
	$('.upAddDis').click(function(e){
		$('.alyDis').removeClass('upIDis');

		sum_amount = $('#u_sum_amount').autoNumeric('get');
		popW       =  $('#usProduct').width();

		$('.addDisPop').css({
			'top' : parseInt(e.clientY - 170),
			'left' : parseInt(popW - 193 + 34),
		});

		$('.helpPro').hide();

		if(sum_amount > 0)
			getPromotionList();

		$('.addDisPop').fadeToggle('fast');
	})

	// choose discount - chon loai khuyen mai
	$('.upChoseDisType').change(function (e) {
		idType = $(this).val();

		$type    = $(this).find(':selected');
		
		disType  = $type.data('type');
		disValue = $type.data('value');
		
		if(idType > 0) {
			$('.proName').text($type.text());
			$('.proVal').autoNumeric('set',parseInt(disValue));
			switch(disType){
				case 1:
					type = '%';
					break;
				case 2:
					type = 'VND';
					break;
			}
			$('.proType').text(type);
			$('.helpPro').show();
		}
		else {
			$('.helpPro').hide();
		}
	})
	// xac nhan khuyen mai
	$('.alyDis').unbind().click(function (e) {
		if(!$('.alyDis').hasClass('upIDis')){
			tolSum   = $('#u_sum_amount').autoNumeric('get');
			showPro(ItemPro, x, i, tolSum, 0, '', wrapper, $type);
		}
		
	});
/*********** submit ***********/
	$('form#frm-update-quote').submit(function(e){
		e.preventDefault();	
		
		var id_customer= $('#id_customer').val();

        var formData = new FormData($("#frm-update-quote")[0]);

        if (!formData.checkValidity || formData.checkValidity()) {
        	$('.cal-loading').fadeIn('fast');
            jQuery.ajax({ type:"POST",
                url:"<?php echo CController::createUrl('quotations/updateQuotation')?>",
                data: formData,
                datatype:'json',

                success:function(data){

                	console.log(data);
					
					if(id_customer){
						$("#update_quote_modal").modal('hide');
						detailCustomer(id_customer);
						return false;
					} 
					
                    if(data == '1')
                        location.href = '<?php echo Yii::app()->getBaseUrl(); ?>/itemsSales/quotations/view';
                    else if(data == '2')
                    	location.href = '<?php echo Yii::app()->getBaseUrl(); ?>/itemsSales/order/view';
                    return false;
                    
					$("#frm-update-quote").html(data);
                },
                error: function(data) {
                    alert("Access Denied. Please contact to administrator.");
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