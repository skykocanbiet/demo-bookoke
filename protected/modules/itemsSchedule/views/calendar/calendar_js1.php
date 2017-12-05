<script src='<?php echo Yii::app()->request->baseUrl; ?>/js/qtip/jquery.qtip.min.js'></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar/fullcalendar.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar/scheduler.js" type="text/javascript"></script>
<script src='<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar/locale/vi.js'></script>
<script src='<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datetimepicker.min.js'></script>

<?php $baseUrl= Yii::app()->getBaseUrl(); ?>

<script>
/*********** button right ***********/
function btnRight()
{
	$('.fc-right').addClass('col-md-4');
	$('.fc-left').addClass('col-md-4');

	right = '<div class="side-right pull-right padding-right-15">' +
					'<select name="cal-view" id="cal-view" class="form-control">' +
						'<option value="1">Ngày</option>'+
						'<option value="2">Tuần</option>'+
						'<option value="3">Tháng</option>'+
					'</select>' +
				'</div>';
	$('.fc-right').append(right);
}
/*********** button center ***********/
function btnCenter() {
	//$('.fc-center').addClass('col-md-4');
	$('.fc-center h2').addClass('col-md-12');
	$('.fc-center h2').attr('id','cal_date');
	datepicker = '<input type="text" style="height: 0px; width: 0; border: 0px;" name="date" id="date">';

	$('.fc-center').append(datepicker);
	$('#date').datepicker({dateFormat: 'dd-mm-yy',numberOfMonths: 2,showButtonPanel: true});

	$('#cal_date').on('mouseover click',function(){
		$('#date').datepicker("show");
	})
	$('#cal_date').mouseleave(function(){
		var hover_date = $('.ui-datepicker').is(':hover');
		if(hover_date == false) {
			$("#date").datepicker('hide').blur();
		}
	})
	$('.ui-datepicker').mouseleave(function(){
		$("#date").datepicker('hide').blur();
	})
	$('#date').change(function(){
		var date = $('#date').datepicker('getDate');
		$('#calendar').fullCalendar('gotoDate',date);
	})
}

/*********** change view ***********/
function changeViews(views,id_source, type) {
	if(views == 1){ // ngày
		$('#calendar').fullCalendar('changeView','agendaDay'); 
	}
	if(views == 2){ //tuần
		if(id_source)
			$('#calendar').fullCalendar('changeView','agendaWeek');
		else 
			$('#calendar').fullCalendar('changeView','timelineOneDays'); 
	}
	if(views == 3){ // tháng
		$('#calendar').fullCalendar('changeView','month');
	}
}

/*********** lấy thông tin lịch hẹn và hiển thị trên lịch ***********/
function showEvents(dentist,patient,branch,chair)
{
  	$('.cal-loading').fadeIn('fast');
  	$.ajax({
		type: "post",
		dataType: 'json',
		url: '<?php echo CController::createUrl('calendar/showEvents'); ?>',
		data: {
		  	dentist: dentist,
		  	patient: patient,
		  	branch: branch,
		  	chair: chair,
		},
		success: function(data) {
			$('#calendar').fullCalendar('removeEventSources');		// xóa tất cả lịch hẹn
			$('#calendar').fullCalendar('addEventSource',data);
			$('.cal-loading').fadeOut('slow');
		},
  });
}

/*********** Danh sách khách hàng ***********/
function customerList() {
	$('#CsSchedule_id_customer').select2({
	    placeholder: {
	    	id: -1,
	    	text: 'Khách hàng'
	    },
	    width: '100%',
	    allowClear: true,
	    ajax: {
	        dataType : "json",
	        url      : '<?php echo CController::createUrl('calendar/getCustomersList'); ?>',
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

/*********** Danh sách dịch vụ ***********/
function servicesList(id_dentist) {
	$('.sch_service').select2({
	   	placeholder: {
	    	id: -1,
	    	text: 'Xem tất cả'
	    },
	    width: '100%',
	    allowClear: true,
	    ajax: {
	        dataType : "json",
	        url      : '<?php echo CController::createUrl('calendar/getServiceList'); ?>',
	        type     : "post",
	        delay    : 50,
	        data : function (params) {
				return {
					q: params.term, // search term
					page: params.page || 1,
					id_dentist: id_dentist,
				};
			},
			processResults: function (data, params) {
				params.page = params.page || 1;

				if(data == -1) {
					$('.error_mes').html('Nha sỹ không có dịch vụ!');
				}
				
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

/*********** Danh sách bác sỹ ***********/
function dentistList() {
	$('.search').select2({
	    placeholder: {
	    	id: -1,
	    	text: 'Xem tất cả'
	    },
	    width: '100%',
	    allowClear: true,
	    ajax: {
	        dataType : "json",
	        url      : '<?php echo CController::createUrl('calendar/getDentistList'); ?>',
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
/*********** Danh sách bác sỹ ***********/
function dentistListModal() {
	$('.sch_dentist').select2({
	    placeholder: {
	    	id: -1,
	    	text: 'Xem tất cả'
	    },
	    width: '100%',
	    allowClear: true,
	    ajax: {
	        dataType : "json",
	        url      : '<?php echo CController::createUrl('calendar/getDentistList'); ?>',
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

/*********** Danh sách ghế khám ***********/
function chairList() {
	$('.search').select2({
	    placeholder: {
	    	id: -1,
	    	text: 'Xem tất cả'
	    },
	    width: '100%',
	    allowClear: true,
	    ajax: {
	        dataType : "json",
	        url      : '<?php echo CController::createUrl('calendar/getChairList'); ?>',
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

function checkValue(id_dentist,dow,start,end) {
	if(!id_dentist) {
		$('.error_mes').html('Vui lòng chọn Nha sỹ!');
		return false;
	}
	if(!dow || !start || !end) {
		$('.error_mes').html('Vui lòng chọn ngày giờ!');
		return false;
	}
	return true;
}

function checkTime(id_dentist,dow,start,end,id_schedule) {
	start_time = start.format("YYYY-MM-DD HH:mm:ss");
	end_time = end.format("YYYY-MM-DD HH:mm:ss");

	if(!checkValue(id_dentist, dow, start, end)){
		$('.chkT').val(0);
		return;
	}
	
	$.ajax({ 
     	type:"POST",
        url:"<?php echo CController::createUrl('calendar/checkWorkTime'); ?>",
        dataType:'json',
        data: {
        	id_dentist: id_dentist,
        	start: start_time,
        	end: end_time,
        },
        success:function(data){
           	if(data == 0) {
				$('.datetimepicker').addClass('errors');
		        $('.error_mes').html("Nha sỹ không có lịch làm việc!");
        		$('.chkT').val(0);

        		$('.alert-warning').show();
        		$('#noti_foot').show();
        		$('#noti_submit').hide();
        		$('.alert-success').hide();
           	}
           	else {
           		$('.datetimepicker').removeClass('errors');
           		$('.branch').prop('value',data.id_branch);
           		$('.chair').prop('value',data.id_chair);
           		$('.error_mes').html("");
           		$('.chkT').val(1);

           		$('.alert-warning').hide();
           		$('.success_mes').html("Bạn có muốn dời lịch không?");
           		$('#noti_foot').hide();
        		$('#noti_submit').show();
        		$('.alert-success').show();

           		checkSchedule(id_dentist, start, end,id_schedule);
           	}
        },
        error: function(data) {
            alert("Error occured.Please try again!");
        },
    });
}

function checkSchedule(id_dentist, start, end,id_schedule) {
	start = moment(start).format('YYYY-MM-DD HH:mm:ss');
	end = moment(end).format('YYYY-MM-DD HH:mm:ss');

	if(start == end) {
		$('.datetimepicker').addClass('errors');
		$('.error_mes').html('Vui lòng chọn dịch vụ!');
		$('.chkSch').val(0);

		return;
	}

	$.ajax({ 
     	type:"POST",
        url:"<?php echo CController::createUrl('calendar/checkScheduleEvent'); ?>",
        dataType:'json',
        data: {
        	id_dentist: id_dentist,
        	start: start,
        	end: end,
        	id_schedule: id_schedule,
        },
        success:function(data){
           	if(data == 0) {
           		$('.datetimepicker').addClass('errors');
		        $('.error_mes').html("Đã có lịch hẹn!");
	           	$('.chkSch').val(0);

	           	$('.alert-warning').show();
        		$('#noti_foot').show();
        		$('#noti_submit').hide();
        		$('.alert-success').hide();
           	}
           	else {
           		$('.datetimepicker').removeClass('errors');
           		$('.error_mes').html("");
           		$('.chkSch').val(1);

           		$('.alert-warning').hide();
           		$('.success_mes').html("Bạn có muốn dời lịch không?");
           		$('#noti_foot').hide();
        		$('#noti_submit').show();
        		$('.alert-success').show();
           	}
        },
        error: function(data) {
            alert("Error occured.Please try again!");
        },
    });
}

/*********** Load calendar ***********/
function loadCalendar(height,resources,id_resource,type) {
	var defaultView = id_resource ? 'agendaWeek' : 'agendaDay';
	$('#calendar').fullCalendar({
		schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',

		allDaySlot: false,
		titleFormat: 'DD MMMM - YYYY',
		contentHeight: height,
		nowIndicator: true,
		
		minTime: '08:00',
		maxTime: '20:00',
		scrollTime: '00:00', 
		
		header: {
			left: '',
			center: 'title',
			right: 'today,prev,next',
	  	},

		defaultView: defaultView,
		views: {
			month:{columnFormat: 'dddd', eventLimit: 5, titleFormat: ' MMMM - YYYY',},
			week: {
				columnFormat: 'dddd - DD/MM',
				titleFormat: 'DD MMMM - YYYY',
				slotLabelFormat : 'HH:mm',
				slotDuration: "00:10:00",
				snapDuration: '00:05:00'},
			day:  {
				columnFormat: 'dddd - DD/MM',
				titleFormat: 'dddd, DD/MM/YYYY',
				slotLabelFormat : 'HH:mm',
				slotDuration: "00:10:00",
				snapDuration: '00:05:00',
			},
			timelineOneDays: {
				type: 'timeline',
				duration: { weeks: 1 },
				//slotDuration: {days: 1},
				slotLabelFormat : 'dddd, DD/MM'
			}
		},

		editable: true,
		selectable: true,
		selectHelper: true,
		eventDurationEditable: false,

		resourceLabelText:'Nha sỹ',
	  	resources: resources,
	  	

		/*********** Hiện thị sự kiện ***********/
	  	eventRender: function(calEvent, element,view) {
	  		link = "<?php echo $baseUrl; ?>/itemsCustomers/Accounts/admin?code_number="+calEvent.code_pt;

	  		quote_btn = '<button type="" class="btn btn_view quote pull-right"><img src="<?php echo $baseUrl; ?>/images/icon_sb_left/bill-def.png" alt=""> Báo giá </button>';
	  		invoice_btn = '<button type="" class="btn btn_view invoice pull-right"><img src="<?php echo $baseUrl; ?>/images/icon_sb_left/bill-def.png" alt=""> Hóa đơn </button>';	  		

	  		if(calEvent.order)
	  			sale = invoice_btn;
	  		else
	  			sale = quote_btn;	

			var ct = '<div id="title">'+
						'<span id="pp_date">' + moment(calEvent.start).format('dddd, DD/MM/YYYY') + '</span>' + 
						'<span style="float:right">' + moment(calEvent.start).format('hh:mm') + ' - ' + moment(calEvent.end).format('hh:mm') + '</span>'+
						'</div>'+

						"<div id='qt_content'>"+
							"<table class='table' id='tb1'>"+
								"<tr>"+
									"<td class='text-right'>Bác sỹ:</td>"+
									"<td>" + (calEvent.dentist ? calEvent.dentist:'') + "</td>"+
								"</tr>"+
								"<tr>"+
									"<td class='text-right'>Tên dịch vụ:</td>"+
									"<td>" + (calEvent.services?calEvent.services:'') + "</td>"+
								"</tr>"+
								"<tr>"+
									"<td class='text-right'>Thời gian:</td>"+
									"<td>" + (calEvent.time?calEvent.time:'') + " phút </td>"+
								"</tr>"+
								"<tr>"+
									"<td class='text-right'>Đặt bởi:</td>"+
									"<td>" + (calEvent.setBy?calEvent.setBy:'') + "</td>"+
								"</tr>"+
								"<tr>"+
									"<td class='text-right'>Tình trạng:</td>"+
									"<td>" + (calEvent.status_text?calEvent.status_text:'') + "</td>"+
								"</tr>"+
							"</table>" +

							"<table class='table' id='tb2'>"+
								"<tr>"+
									"<td colspan=2>" + (calEvent.patient?calEvent.patient:'') + "</td>"+
								"</tr>"+
								"<tr>"+
									"<td colspan=2>Mã ID: "+ (calEvent.code_pt?calEvent.code_pt:'') +"</td>"+
								"</tr>"+
								"<tr>"+
									"<td>" + (calEvent.phone?calEvent.phone:'') + "</td>"+
									"<td class='text-right'><a href='"+link+"' style='color: #93c541; font-weight: bold; font-size:1.2em;'>Hồ sơ</a></td>"+
								"</tr>"+
							"</table>"+
						"</div>" +

						'<div id="qtip_button">'+
							'<button type="" class="btn btn_view edit_sch"><img src="<?php echo $baseUrl; ?>/images/icon_sb_left/edit-def.png" alt=""> Chỉnh sửa</button>'+
							sale +
						'</div>';

			var viewport = $(".fc-time-grid-container.fc-scroller");

			element.qtip({
		  		prerender: true,
		  		content: {  text: ct, },	  		
		  		position: {
					my: 'center left',
					at: 'top right',
					container: viewport,
					viewport: viewport,
					target: 'event',
					adjust: { scroll: true, screen: true},
		  		},
		  		show: {event: 'click',solo: true},
		  		hide: {event: 'unfocus'},
		 		style: { 
		 		 	width: 260, classes: 'qtip-bootstrap', tip: { corner: true, mimic: 'center', width: 20, height: 5,}, 
		 		},
			});
	  	},
	  	/*********** Sự kiện khi click chuột ***********/
	  	eventClick: function(calEvent, jsEvent, view) {
	  		type = $('#sr_val').val();
	  		id = calEvent.id;

  			$('#calendar').fullCalendar('clientEvents',id);
	  		
	  		// chỉnh sửa
	  		$('.edit_sch').click(function(e){
	  			$('.cal-loading').fadeIn('fast');
	        	$.ajax({ 
		         	type:"POST",
		            url:"<?php echo CController::createUrl('calendar/updateEvent'); ?>",
		            datatype:'json',
		            data: {
		            	id_schedule: id,
		            },
		            success:function(data){
		                if(data){
		                	$('#update_sch_modal').modal("show");
		                    $("#update_sch_modal").html(data);
		                    $('.cal-loading').fadeOut('slow');
		                }
		            },
		            error: function(data) {
		                alert("Error occured.Please try again!");
		            },
		        });
		        $('.edit_sch').unbind();
	  		})
	  		// tạo báo giá
			$('.quote').click(function(){
				 x = 1;
		        $('.currentRow').nextAll('tr').remove();
		        $('.sNote').show();
		        $('#sAddNote').addClass('hidden');

			  	$.ajax({ 
		            type:"POST",
		            url:"<?php echo Yii::app()->createUrl('itemsSales/quotations/create')?>",
		            datatype:'json',
		            data: {
		            	id_customer 	: calEvent.id_patient,
		            	id_service		: calEvent.id_service,
		            	id_user			: calEvent.id_dentist,
		            	user_name		: calEvent.dentist,
		            },
		            success:function(data){
		                if(data){
		                	$('#quote_modal').modal("show");
		                    $("#quote_modal").html(data);
		                }
		            },
		            error: function(data) {
		                alert("Error occured.Please try again!");
		            },
		        });
		        $('.quote').unbind();
			});

			$('.invoice').click(function(){
			  	$.ajax({ 
		            type:"POST",
		            url:"<?php echo Yii::app()->createUrl('itemsSales/order/viewOrder')?>",
		            datatype:'json',
		            data: {
		            	id_order 		: calEvent.order,
		            	id_invoice		: calEvent.invoice,
		            },
		            success:function(data){
		                if(data){
		                	$('#quote_modal').modal("show");
		                    $("#quote_modal").html(data);
		                }
		            },
		            error: function(data) {
		                alert("Error occured.Please try againsssss!");
		            },
		        });
		        $('.invoice').unbind();
			});
	  	},
	  	/*********** Sự kiện kéo thả ***********/
	  	eventDrop: function(event, delta, revertFunc, jsEvent, ui, view ) {
	  		id_resource = event.resourceId,
			start = event.start;
			end = event.end;
			dow = (event.start).format('d');
			id_schedule = event.id;

			startEditable = event.startEditable;

			if(!startEditable)
				return;

			checkTime(id_resource,dow,start,end,id_schedule);

			$('#noti_modal').modal('show');


			$('#btn_noti').click(function(e){
				e.preventDefault();

				$.ajax({ 
		         	type:"POST",
		            url:"<?php echo CController::createUrl('calendar/updateTimeEvent'); ?>",
		            datatype:'json',
		            data: {
		            	id_resource	: id_resource,
						start 		: start.format('YYYY-MM-DD HH:mm:ss'),
						end 		: end.format('YYYY-MM-DD HH:mm:ss'),
						id_schedule	: id_schedule,
		            },
		            success:function(data){
		               	if(!data)
		               		alert('Có lỗi xảy ra');
		            },
		            error: function(data) {
		                alert("Error occured.Please try again!");
		            },
		        });

				$('#btn_noti').unbind();
			})

			$('.btn_close').click(function(e){
				e.preventDefault();
				revertFunc();
			})
	  	},
	  	/*********** Thay đổi kích thước sự kiện ***********/
	  	/*eventResize: function( event, delta, revertFunc, jsEvent, ui, view ) {
		 	alert("You resizing an event!");
	  	},*/
	  	/*********** Tạo sự kiện mới - nhấp chuột vào thời gian trống ***********/
	  	select: function(start, end, jsEvent, view, resource) {
	  		$('.cal-loading').fadeIn('fast');
	  		type = $('#sr_val').val();
	  		var start_time = moment(start).format('YYYY-MM-DD HH:mm:ss');

	  		if(view.name != 'agendaDay') {
	  			resource_id = $('#at_srch').val();
	  			resource_name = $('#at_srch').select2('data')[0].text;
	  		}
	  		else {
	  			resource_id = resource.id;
	  			resource_name = resource.title;
	  		}
			
        	$.ajax({ 
	         	type:"POST",
	            url:"<?php echo CController::createUrl('calendar/addEvent'); ?>",
	            datatype:'json',
	            data: {
	            	type: type,
	            	resource_id: resource_id,
	            	resources_name: resource_name,
	            	start_time: start_time,
	            },
	            success:function(data){
	                if(data){
                		$('#create_sch_modal').modal("show");
                    	$("#create_sch_modal").html(data);
                    	$('.cal-loading').fadeOut('slow');
	                }
	            },
	            error: function(data) {
	                alert("Error occured.Please try again!");
	            },
	        });
	        $('form#frm-create-sch').unbind();
	  	},
	});

	btnRight();
	btnCenter();
	
	$('#cal-view').change(function(){
		views = $('#cal-view').val();
		changeViews(views,id_resource);
	})
}

function loadResources(id_resource,type){
	var height = $(window).height()-125;
	type = parseInt(type);

	var id_dentist = '';
	var id_patient = '';
	var id_branch = '';
	var id_chair = '';

	switch(type) {
		case 1: // nha sỹ, 
			url = '<?php echo CController::createUrl('calendar/getResourcesDentistList'); ?>';
			id_dentist = id_resource;
			break;
		case 2:
			url = '<?php echo CController::createUrl('calendar/getResourcesChairList'); ?>';
			id_chair = id_resource;
			break;
		default:
			url = '<?php echo CController::createUrl('calendar/getResourcesDentistList'); ?>';
			break;
	}
	$('.cal_loading').fadeIn('fast');
	$.ajax({
		type: "post",
		dataType: 'json',
		url: url,
		data: {
			id_resource : id_resource,
		},
		success: function(data) {
			$('#calendar').fullCalendar('destroy');
			loadCalendar(height,data,id_resource,type);
			showEvents(id_dentist,id_patient,id_branch,id_chair);
			
		},
	});
}
</script>

<script>
$(function () {
	
	$.fn.select2.defaults.set( "theme", "bootstrap" );

	var type = 1;			// bac sy
	var id_dentist = $('#at_srch').val();

	dentistList();
	loadResources(id_dentist);

	$('#sr_val').change(function(){
		var type = $('#sr_val').val();
		type = parseInt(type);
		
		switch(type) {
			case 1: 				// nha sy
				dentistList();
				loadResources();
				break;
			case 2:
				chairList();
				loadResources('',2);
				break;
		}

		$('#at_srch').val('').trigger('change');
	})

	$('.search').change(function(){
		var type = $('#sr_val').val();
		var id_resource = $('#at_srch').val();

		loadResources(id_resource,type);
	})
})
</script>