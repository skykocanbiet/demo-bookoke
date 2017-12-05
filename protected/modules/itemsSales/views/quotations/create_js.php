<script>
/*********** Lay danh sach khach hang ***********/
	function customerList() {
		$('#Quotation_id_customer').select2({
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
		$id_prB = $('#priceBook').val();
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
		    width: '248px',
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
		tableH = $('#sProduct tbody').height();
		if(tableH < 198)
			$('#sProduct tbody').css('margin-right',0);
		else
			$('#sProduct tbody').css('margin-right','-17px');
	}
/*********** Tinh tong gia tri san pham dich vu ***********/
	function calSumN() {
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
	        		$('.choseDisType').html(opPro);
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
	function showPro(ItemPro, x, i, sum, oneI = '', clsN = '', wrapper) {
		x++;
        i++;
		$type    = $('.choseDisType').find(':selected');
		
		disType  = $type.data('type');
		disValue = $type.data('value');

        ans = DisVal(disType,disValue,sum);

        ItemP = ItemPro.replace(/id_discount_val/g,$type.val());
       	ItemP = ItemP.replace(/discount_val/g,$type.text());
       	ItemP = ItemP.replace(/unit_price_val/g,parseInt(ans));

	    total = $('#sum_amount').autoNumeric('get');
	    $('#sum_amount').autoNumeric('set', parseInt(ans) + parseInt(total));
	    $('#s_sum_amount').val(parseInt(ans) + parseInt(total));
	   
	    if(oneI == 1)
	    	$(ItemP.replace(/iTemp/g,i)).insertAfter('tr.'+clsN);
	    else
	    	$(wrapper).append(ItemP.replace(/iTemp/g,i));

	    dentistList();
	    $('.addDisPop').hide();
	    resizeTable();
	}
/*********** Lay danh sach nhom khach hang ***********/
	function choseSeg(id_customer) {
		$.ajax({ 
			type    :"POST",
			url     :"<?php echo CController::createUrl('quotations/getCustomerSegment')?>",
			data    : {id_customer: id_customer},
			dataType:'json',
			
			success :function(data){
				opSeg = '';
				$f    = true;
				$sv = '';
                if(data.length > 0) {
                	$.each(data, function (k,v) {
                		if($f == true) {
							$sv   = v.id_segment;
							$svDe = v.name;
							$f    = false;
                		}
                		opSeg = opSeg+ '<option value="'+v.id_segment+'">'+v.name+'</option>';
                	});

                	$('.choseSeg').html(opSeg);
                	$('.segTxt').val($svDe);
                	$('.showSeg').show();
                }
                else {
                	$('.showSeg').hide();
                }

                getPricBooke($sv);
            },
            error: function(data) {
                alert("Error occured.Please try again!");
            },
        });
	}
/*********** Lay mang danh sach SP DV (nhom khach hang)  ***********/
	function getArrSVPD(id_seg) {
		$svA = [];
		$svL = $('select.group_services');
		$.each($svL, function (k, v) {
			if(v.value)
				$svA.push(v.value);
		});

		if($svA.length == 0)
			return;

		$.ajax({ 
			type    :"POST",
			url     :"<?php echo CController::createUrl('quotations/checkSVPD')?>",
			dataType:'json',
			data: {
				data  :$svA,
				id_seg: id_seg
			},
			
			success :function(data){
               	if(data == -1){

               	}
               	else {
	               	if(data.length > 0 ) {
	               		$.each($svL, function (k, v) {
							if(v.value != '') {
								id = $('#'+ v.id).parents('tr').find('.group_services').val();
								sv = $.grep(data, function (k1, v) {
									return k1.id == id;
								})

								if(sv.length == 1) {
									qty = $('#'+ v.id).parents('tr').find('.group_qty').val();
									if(!qty)
										qty = 1;

									price = parseInt(sv[0].price);
									tax   = parseFloat(sv[0].tax);
									
									if(tax == '' || isNaN(tax))
										tax_qty = 0;
									else
										tax_qty = ((tax)*qty*(price))/100;
									sum_amount = price*qty + tax_qty;

									$('#'+ v.id).parents('tr').find('.group_unit').autoNumeric('set',price);
									$('#'+ v.id).parents('tr').find('.group_tax').autoNumeric('set',tax_qty);

									$('#'+ v.id).parents('tr').find('.group_amount').autoNumeric('set',sum_amount);
									$('#'+ v.id).parents('tr').find('.errSegIt').val(0);
									$('.errorSeg').hide();
								}
								else {
									$($('#'+ v.id).data('select2').$container).addClass('errors');
									$('#'+ v.id).parents('tr').find('.errSegIt').val(1);
									$('#'+ v.id).parents('tr').find('.group_unit').autoNumeric('set',0);
									$('#'+ v.id).parents('tr').find('.group_tax').autoNumeric('set',0);
									$('#'+ v.id).parents('tr').find('.group_amount').autoNumeric('set',0);
									$('.errorSeg').show();
								}
							}
						});
						calSumN();
	               	}
	               	else {
	               		$.each($svL, function (k, v) {
	               			$($('#'+ v.id).data('select2').$container).addClass('errors');
	               			$('#'+ v.id).parents('tr').find('.errSegIt').val(1);
	               			$('#'+ v.id).parents('tr').find('.group_unit').autoNumeric('set',0);
							$('#'+ v.id).parents('tr').find('.group_tax').autoNumeric('set',0);
							$('#'+ v.id).parents('tr').find('.group_amount').autoNumeric('set',0);
							$('.errorSeg').show();
	               		})
	               	}
               	}
            },
            error: function(data) {
                alert("Error occured.Please try again!");
            },
        });

		return $svA;
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
				console.log(id_prB);
				if(data != 0){
					$('#priceBook').val(data.id);
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
/*********** Reset input trong tr  ***********/
	function resetTr() {
		$('.currentRow').not('.t1').remove();
		$('.t1 input[type="text"]').val('');
		$('.group').empty();
		$('.t1 .group, .t1 .group_dentist').val(0).trigger('change');
		$('#sum_tax, #sum_amount').val(0);
		i = 2;
		$('.cal_qty').val(1);
		$('.newbtnAdd').addClass('btn_unactive').removeClass('btn_bookoke');
	}
$(document).ready(function(){
/*********** Khoi tao gia tri ***********/
	$.fn.select2.defaults.set( "theme", "bootstrap" );
	$('[data-toggle="tooltip"]').tooltip();
	$('.frm_datepicker').datepicker({
		dateFormat: 'dd/mm/yy',
	})
	$('#Quotation_id_branch').val(<?php echo Yii::app()->user->getState('user_branch'); ?>);
	
	var today = moment().format('DD/MM/YYYY');
	var user_name = '<?php echo $user_name; ?>';

	$('.frm_datepicker').change(function(e){
		create_date = $('#Quotation_create_date').datepicker( "getDate");
		last_date   = $('#Quotation_complete_date').datepicker( "getDate");
		if(create_date>=last_date)
			$('#Quotation_complete_date').datepicker( "setDate", create_date);
	})
	$('#Quotation_create_date').val(today);
	$('#Quotation_complete_date').val(today);

	var Item = <?php echo CJSON::encode($this->renderPartial('item_detail',array('quote_services'=>$quote_services,'form'=>$form,'i'=>'iTemp'),true)); ?>;
	var ItemPro = <?php echo CJSON::encode($this->renderPartial('item_pro',array('quote_services'=>$quote_services,'form'=>$form,'i'=>'iTemp'),true)); ?>;

	<?php if(empty($user_dt)): ?>
		$('#QuotationService_1_id_user').html('');
	<?php endif; ?>

	<?php if(!$id_customer){ ?>
		customerList();
	<?php } ?>

	dentistList(3);

	seg = $('.choseSeg').val();

	if(seg){
		getPricBooke(seg);
	}
	else
		serviceList();
/*********** Thêm trường dịch vụ mới trong form báo giá ***********/
	var max_fields  = 50; //maximum input boxes allowed
	var wrapper     = $(".sItem tbody"); //Fields wrapper

	var i = 1;
	var x = 1;
	
	$('.sbtnAdd').click(function(e){
		e.preventDefault();
		$('#sProduct table tbody').animate({
       		scrollTop: $('#sProduct table tbody')[0].scrollHeight}, 1000);
	})

	$('#addServices').click(function(e){
		btnActive = $('.newbtnAdd').hasClass('btn_unactive');
		if(btnActive)
			return;

	    if(x < max_fields){
	        x++;
	        i++;
	        Item = Item.replace(/group_product/g,'group_services');
	       	Item = Item.replace(/id_product/g,'id_service');

	        $(wrapper).append(Item.replace(/iTemp/g,i));
	    	id = 'QuotationService_'+i+'_id_service';
	    	$('#QuotationService_'+i+'_id_user').html('');

	    	seg = $('#priceBook').val();

		    dentistList(3);
			serviceList(seg, id);
			resizeTable();
			$('.newbtnAdd').addClass('btn_unactive').removeClass('btn_bookoke');
		}
	});
	$('#addProduct').click(function(e){
	   btnActive = $('.newbtnAdd').hasClass('btn_unactive');
		if(btnActive)
			return;

	    if(x < max_fields){ 
	        x++;
	        i++;
	        Item = Item.replace(/group_services/g,'group_product');
	       	Item = Item.replace(/id_service/g,'id_product');
		
	        $(wrapper).append(Item.replace(/iTemp/g,i)); 
			
		    dentistList();
			productList();
			resizeTable();
			$('.newbtnAdd').addClass('btn_unactive').removeClass('btn_bookoke');
		}
	});
/*********** Xóa dịch vụ ***********/
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
	    resizeTable();

	    if(x == 0){
	    	$('.newbtnAdd').removeClass('btn_unactive').addClass('btn_bookoke');
	    }
	    else {
			itemValue = $('.sItem tr:last').find('.group').val();

			if(itemValue)
				$('.newbtnAdd').removeClass('btn_unactive').addClass('btn_bookoke');
			else
				$('.newbtnAdd').addClass('btn_unactive').removeClass('btn_bookoke');
	    }
	})
/*********** Ghi chu ***********/
	$('.sNote').click(function(e){
	    e.preventDefault();
	    $('.sNote').hide();
	    $('#sAddNote').removeClass('hidden'); 
	});
/*********** So luong rang ***********/
	$('.cal_teeth').on('keypress',function(e){
		/*k = e.keyCode;
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
		}*/
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

		data 		= select.select2('data');
		if(data.length == 0)
			return;
		price 		= parseInt(data[0].price);
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

		calSumN();
	});
/*********** tinh toan gia tri san pham ***********/	
	$(wrapper).on('change','.cal',function(e){
		var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    	$('.autoNum').autoNumeric('init',numberOptions);

    	itemValue = $('#sProduct tr:last .group').val();

		if(itemValue)
			$('.newbtnAdd').removeClass('btn_unactive').addClass('btn_bookoke');
		else
			$('.newbtnAdd').addClass('btn_unactive').removeClass('btn_bookoke');

		select = $(this).parents('tr').find('.group');
		data  = select.select2('data');
		if(data.length == 0)
			return;

		price = (data[0].price) ? parseInt(data[0].price) : 0;
		tax   = parseFloat(data[0].tax);
		text  = data[0].text;

		$(select.data('select2').$container).removeClass('errors');
		$('.errorSeg').hide();

		$(this).parents('tr').find('.quote_des').val(text);
		qty = $(this).parents('tr').find('.group_qty').val();
		
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

		calSumN();
	});
/*********** Thêm khuyen mai tung dich vu ***********/
	// pop up khuyen mai tung dich vu
	$(wrapper).on('click','.addIDis',function(e){
		e.preventDefault();

		$('.alyDis').addClass('IDis');
		
		tp = $('.currentRow').height();
		wd = $('#sProduct').width();
		classN = $(this).parents('tr').attr('class').split(' ');

	    $('.addDisPop').css({
	    	top: (e.clientY - tp - 120)+'px',
	    	left: (wd - 350/2 + 12.5)+'px',
	    });

	    sum = $(this).parents('tr').find('.cal_sum').autoNumeric('get');

	    if(sum > 0)
			getPromotionList();

	    $('.helpPro').hide();
	    $('.addDisPop').show();

		// xac nhan khuyen mai
		$('.alyDis').unbind().click(function (e) {
			if($('.alyDis').hasClass('IDis')){
				showPro(ItemPro, x, i, sum, 1, classN[1], wrapper);
			}
			else {
				tolSum   = $('#sum_amount').autoNumeric('get');
				showPro(ItemPro, x, i, tolSum, 0, '', wrapper);
			}
		});
		resizeTable();
	})
/*********** Khuyen mai tong don hang****************/
	// add discount - them khuyen mai cho tong bao gia
	$('.addDis').click(function(e){
		$('.alyDis').removeClass('IDis');

		sum_amount = $('#sum_amount').autoNumeric('get');
		popW       =  $('#sProduct').width();

		$('.addDisPop').css({
			'top' : parseInt(e.clientY - 170),
			'left' : parseInt(popW - 171.5),
		});

		$('.helpPro').hide();

		if(sum_amount > 0)
			getPromotionList();

		$('.addDisPop').show();
	})

	// choose discount - chon loai khuyen mai
	$('.choseDisType').change(function (e) {
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
		if(!$('.alyDis').hasClass('IDis')){
			tolSum   = $('#sum_amount').autoNumeric('get');
			showPro(ItemPro, x, i, tolSum, 0, '', wrapper);
			resizeTable();
		}
	});
/*********** chon khach hang ***********/
	$('#Quotation_id_customer').change(function (e) {
		id_cus = $('#Quotation_id_customer').val();

		resetTr();

		if(id_cus)
			choseSeg(id_cus);
	})	
/*********** chon nhom khach hang ***********/
	$('.choseSeg').change(function (e) {
		seg = $('.choseSeg').val();
		seg_text = $('.choseSeg option:selected').text();

		resetTr();

		if(seg) {
			getPricBooke(seg);
		}
	})
/*********** submit ***********/
	$('form#frm-quote').submit(function(e){
		e.preventDefault();
		
		var id_customer= $('#id_customer').val();

        var formData = new FormData($("#frm-quote")[0]);

        if (!formData.checkValidity || formData.checkValidity()) {
        	$('.cal-loading').fadeIn('fast');
            jQuery.ajax({ 
				type    :"POST",
				url     :"<?php echo CController::createUrl('quotations/create')?>",
				data    : formData,
				datatype:'json',

                success:function(data){
					
					if(id_customer){
                		$("#quote_modal").modal('hide');
                		detailCustomer(id_customer);
                		return false;
                	} 
					
                    if(data == '1')
                        location.href = '<?php echo Yii::app()->getBaseUrl(); ?>/itemsSales/quotations/view';
                    return false;
                },
                error: function(data) {
                    alert("Access Denied. Please contact to administrator.!");
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