<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar/fullcalendar.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar/scheduler.js" type="text/javascript"></script>
<script src='<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar/locale/vi.js'></script>

<?php $baseUrl= Yii::app()->getBaseUrl();?>
<style type="text/css">
	.changeW {
	     margin-left: -250px;
	    border-top: 1px solid rgb(102, 175, 233) !important;
	    width: 800px !important;
	}
</style>
<input type="hidden" id="LayoutCalendar" value="1">
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
		$('.fc-center h2').addClass('col-md-12');
		$('.fc-center h2').attr('id','cal_date');
		datepicker = '<input type="text" style="height: 0px; width: 0; border: 0px;" name="date" id="date">';

		$('.fc-center').append(datepicker);

		$('#date').datepicker({
			dateFormat: 'dd-mm-yy',
			showButtonPanel: true,
		});

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
			if(id_source){
				$('#calendar').fullCalendar('changeView','agendaWeek');
				$('#cal-view').val(2);
			}
			else 
				$('#calendar').fullCalendar('changeView','timelineOneDays'); 
		}
		if(views == 3){ // tháng
			$('#calendar').fullCalendar('changeView','month');
		}
	}
/*********** Change country ***********/
   function countryList() {
      $('#Customer_id_country').select2({
         language: 'vi',
         placeholder: {
            id: -1,
            text: 'Xem tất cả'
         },
         width: '100%',
         allowClear: true,
         ajax: {
            dataType : "json",
            url      : '<?php echo CController::createUrl('calendar/getCountryList'); ?>',
            type     : "post",
            delay    : 1000,
            data : function (params) {
               return {
                  q        : params.term, // search term
                  page     : params.page || 1,
               };
            },
            processResults: function (data, params) {
               params.page = params.page || 1;
               return {
                  results: data,
               };
            },
            cache: true,
          },
      });
   }
/*********** lấy thông tin lịch hẹn và hiển thị trên lịch ***********/
	function showEvents(dentist,patient,branch)
	{
	  	$.ajax({
			type    : "post",
			dataType: 'json',
			url     : '<?php echo CController::createUrl('calendar/showEvents'); ?>',
			data    : {
					dentist: dentist,
					patient: patient,
					branch : branch,
			},
			success: function(data) {
				$('#calendar').fullCalendar( 'removeEvents', function (e) {
					return e.className == 'schTime';
				});
				$('#calendar').fullCalendar('addEventSource',data);
				$('.cal-loading').fadeOut('fast');
			},
	    });
	}
/*********** hien thi lich moi ***********/
	function getNewSch(data) {
		if(typeof data == 'string') {
			dt = $.parseJSON(data);
			id = dt['id'];
			active = dt['status_active'];
		}
		else if(typeof data == 'object') {
			id = data['id'];
			active = data['status_active'];
		}
		else {
			return;
		}

		if(active < 0 && id){
			$('#calendar').fullCalendar( 'removeEvents', id);
			return;
		}

		$.ajax({
			type    : "post",
			dataType: 'json',
			url     : '<?php echo CController::createUrl('calendar/getNewSch'); ?>',
			data    : {
					sch:data,
			},
			success: function(data) {
				$('#calendar').fullCalendar( 'removeEvents', data.id);
				$('#calendar').fullCalendar('renderEvent',data,true);

			},
	  });
	}
/*********** thoi gian tu dong ***********/
	function changeStatus() {
		ev = $('#calendar').fullCalendar('clientEvents', function (ev) {
			if(ev.className == 'schTime' && moment().format('YYYY-MM-DD HH:mm:ss') > ev['start'].format('YYYY-MM-DD HH:mm:ss'))
				if(ev.status == 1 || ev.status == 2)
					return true;
		});

		ev1 = $('#calendar').fullCalendar('clientEvents', function (ev) {
			if(ev.className == 'schTime' && moment().format('YYYY-MM-DD HH:mm:ss') > ev['end'].format('YYYY-MM-DD HH:mm:ss'))
				if(ev.status == 3)
					return true;
		});

		if(ev.length == 1){
			if(typeof ev[0] != 'object' || ev[0].id == 'calendar')
				return;
		}

		idEv = [];
		$.each(ev, function (k,e) {
			idEv.push({
				id    : e.id,
				status: e.status,
			});
		})
		$.each(ev1, function (k,e) {
			idEv.push({
				id    : e.id,
				status: e.status,
			});
		})

	    $.ajax({
			url     : '<?php echo CController::createUrl('calendar/changeStatus'); ?>',
			type    : "post",
			data    : {idEv:idEv},
			dataType: 'json',
			success : function (data) {
				
				$.each(data, function (k,v) {
					$('#calendar').fullCalendar('removeEvents', v['ev']['id']);
					$('#calendar').fullCalendar('renderEvent',v['ev'], true);
					setTimeout(function () {
						getNoti(v['ev'],'update', userLog);
					}, 1000);
				})
			}
	    })
	}
/*********** thong bao ***********/
	function getNoti(dataSch, action, author) {
	    $.ajax({
			url     : '<?php echo CController::createUrl('calendar/getNoti'); ?>',
			type    : "post",
			dataType: 'json',
			data    : {
				dataSch  : dataSch,
				action   : action,
				id_author: author,
			},
			success : function (data) {
			}
	    })
	}
/*********** Thời gian ko làm việc của bác sỹ ***********/
	function breakTime(view, id_resource) {
		$.ajax({
			type    : "post",
			dataType: 'json',
			url     : '<?php echo Yii::app()->getBaseUrl(); ?>/time.json',
			success: function (data) {
				getBreakTime(data, view, id_resource);
			}
		})
	}

	function getBreakTime(data, view, id_resource) {
		time  = [];
		br    = $('#id_branch').val();
		today = $('#calendar').fullCalendar('getDate');
		today = moment(today);

		if(br == 0){
			$.each(data['time'], function (v,k) {
				id_den = k['id_den'];
			// lich hen theo ngay
				if(view == 'agendaDay' && !id_resource) {
					day   = today.format('YYYY-MM-DD');
					dowN  = today.format('d');
					$.each(k.time, function (ke, va) {
						ti  = va.split('-')
						dow = ti[0];
						st  = ti[1];
						en  = ti[2];
						if(dowN == dow){
							time.push({
								resourceId: id_den,
								id        : 'breakTime',
								className : 'breakTime',
								start     : day + ' ' + st,
								end       : day + ' ' + en,
								rendering : "background",
							});
						}
					})
				}
			// lich hen theo tuan va bac sy
				else if(view == 'agendaWeek' && id_resource) {
					if(id_den == id_resource ){
						day  = today.startOf('isoWeek');
						nDay = 1;
						date  = [];
						while(nDay <= 6) {
							date[nDay] = day.format('YYYY-MM-DD');
							day.add(1,'day');
							nDay ++;
						}

						$.each(k.time, function (ke, va) {
							ti  = va.split('-');
							dow = ti[0];
							st  = ti[1];
							en  = ti[2];

							if(dow == 0) {
								day  = today.endOf('isoWeek');
								time.push({
									resourceId: id_den,
									id        : 'breakTime',
									className : 'breakTime',
									start     : day.format('YYYY-MM-DD') + ' ' + st,
									end       : day.format('YYYY-MM-DD') + ' ' + en,
									rendering : "background",
								});
							}
							else {
								time.push({
									resourceId: id_den,
									id        : 'breakTime',
									className : 'breakTime',
									start     : date[dow] + ' ' + st,
									end       : date[dow] + ' ' + en,
									rendering : "background",
								});
							}
						})
					}
				}
			})
		}
		else {
			$.each(data['branch'], function (v,k) {
				id_den = k['id_den'];
			// lich hen theo ngay va chi nhanh
				if(view == 'agendaDay' && !id_resource && br == k['id_branch']) {
					day   = today.format('YYYY-MM-DD');
					dowN  = today.format('d');
					$.each(k.time, function (ke, va) {
						ti  = va.split('-')
						dow = ti[0];
						st  = ti[1];
						en  = ti[2];
						if(dowN == dow){
							time.push({
								resourceId: id_den,
								id        : 'breakTime',
								className : 'breakTime',
								start     : day + ' ' + st,
								end       : day + ' ' + en,
								rendering : "background",
							});
						}
					})
				}
			// lich hen theo tuan va bac sy
				else if(view == 'agendaWeek' && id_resource && br == k['id_branch']) {
					if(id_den == id_resource ){
						day  = today.startOf('isoWeek');
						nDay = 1;
						date  = [];
						while(nDay <= 6) {
							date[nDay] = day.format('YYYY-MM-DD');
							day.add(1,'day');
							nDay ++;
						}

						$.each(k.time, function (ke, va) {
							ti  = va.split('-');
							dow = ti[0];
							st  = ti[1];
							en  = ti[2];

							if(dow == 0) {
								day  = today.endOf('isoWeek');
								time.push({
									resourceId: id_den,
									id        : 'breakTime',
									className : 'breakTime',
									start     : day.format('YYYY-MM-DD') + ' ' + st,
									end       : day.format('YYYY-MM-DD') + ' ' + en,
									rendering : "background",
								});
							}
							else {
								time.push({
									resourceId: id_den,
									id        : 'breakTime',
									className : 'breakTime',
									start     : date[dow] + ' ' + st,
									end       : date[dow] + ' ' + en,
									rendering : "background",
								});
							}
						})
					}
				}
			})
		}


		if(time.length > 0) {
			setTimeout(function(){
				$('#calendar').fullCalendar('addEventSource',time);
			}, 100);
		}
	}
/*********** Danh sách bác sỹ ***********/
	function dentistList(id_branch,role) {
		if(!role){
			role = 1;
		}

		$('.search').select2({
			language: 'vi',
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
		        delay    : 1000,
		        data : function (params) {
					return {
						q        : params.term, // search term
						page     : params.page || 1,
						id_branch: id_branch,
					};
				},
				processResults: function (data, params) {
					params.page = params.page || 1;
					
					return {
						results: data,
					};
				},
				cache: true,
		    },
		});
	}
/*********** Danh sách bác sỹ dat lich hen ***********/
	function dentistListModal(id_branch) {
		$('.sch_dentist').select2({
		    placeholder: {
		    	id: -1,
		    	text: 'Xem tất cả'
		    },
		    width: '100%',
		    ajax: {
		        dataType : "json",
		        url      : '<?php echo CController::createUrl('calendar/getDentistList'); ?>',
		        type     : "post",
		        delay    : 1000,
		        data : function (params) {
					return {
						q: params.term, // search term
						page: params.page || 1,
						id_branch: id_branch,
					};
				},
				processResults: function (data, params) {
					 
					return {
						results: data,
					};
				},
				cache: true,
		    },
		});
	}
/*********** Danh sách dịch vụ ***********/
	function servicesList(id_dentist,id_service,up) {
		if(id_service == 0) {
			$('.sch_service').select2({
				language: 'vi',
			   	placeholder: {
			    	id: -1,
			    	text: 'Xem tất cả'
			    },
			    width: '100%',
			    data: [{'id':0,'title':'Không làm việc'}],
			});
			return;
		}
		$('.sch_service').select2({
			language: 'vi',
		   	placeholder: {
		    	id: -1,
		    	text: 'Xem tất cả'
		    },
		    width: '100%',
		    ajax: {
		        dataType : "json",
		        url      : '<?php echo CController::createUrl('calendar/getServiceList'); ?>',
		        type     : "post",
		        delay    : 1000,
		        data : function (params) {
					return {
						q         : params.term, // search term
						page      : params.page || 1,
						id_dentist: id_dentist,
						up        : up,
					};
				},
				processResults: function (data, params) {
					return {
						results: data,
					};
				},
				cache: true,
		    },
		});
	}
/*********** Danh sách khách hàng ***********/
	function formatState (data) {
	  if (!data.id) { return data.text; }

	  datas = '<div class="col-xs-4">' + data.text + '</div>';
	  if(moment(data.birthdate).isValid())
	  	datas = datas + '<div class="col-xs-2">' + moment(data.birthdate).format("DD/MM/YYYY") + '</div>';
	  else
	  	datas += '<div class="col-xs-2"> &nbsp </div>';
	  
	  	datas +=  '<div class="col-xs-2">' + data.phone + '</div>';
	  
	  	datas += '<div class="col-xs-4" style="font-size:12px; padding-right: 0;">' + data.adr + '</div>';
	  datas += '<div class="clearfix"></div>';
	  var $data = $(datas);
	  return $data;
	};

	function customerList() {
		$('#CsSchedule_id_customer').select2({
			language: 'vi',
			templateResult: formatState,
			dropdownCssClass: "changeW",
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
/*********** Cap nhat lich hen keo tha ***********/
	function updateDrop(id_dentist, start_time, end_time, id_schedule) {
		return $.ajax({ 
			type    :"POST",
			url     :"<?php echo CController::createUrl('calendar/eventDrop'); ?>",
			dataType:'json',
			data    : {
				id_dentist: id_dentist,
				start     : start_time,
				end       : end_time,
				id        : id_schedule
	        },
	    });
	}
/*********** Kiểm tra thời gian lich hen ***********/
	function checkTimeAjax(id_dentist, start_time, end_time, id_schedule) {
	   $('.load-at').fadeIn('fast');
	   id_branch = $('#id_branch').val();
	   return $.ajax({ 
			type    :"POST",
			url     :"<?php echo CController::createUrl('calendar/checkTime'); ?>",
			dataType:'json',
			data    : {
				id_dentist : id_dentist,
				start      : start_time,
				end        : end_time,
				id_schedule: id_schedule,
				id_branch  : id_branch,
	        },
	    });
	}

	function checkTime(data) {
	   $('.load-at').fadeOut('slow');
	   // dinh dang thoi gian khong dung
	   if(data.status == -1) {
	      $('.group_time').addClass('errors');
	      $('.chkT').val(0);
	   }
	   // nha sy khong lam viec
	   if(data.status == -2) {
	      $('.group_time').addClass('errors');
	      $($('.sch_dentist').data('select2').$container).addClass('errors');
	      $('.chkT').val(0);
	   }
	   // lich hen trung
	   if(data.status == -3) {
	      $('.group_time').addClass('errors');
	      $('.chkT').val(0);
	   }
	   if(data.status == 1) {
	   		$id_br = data.data['id_branch'];
	   		$('#step-1').removeClass('btn_unactive').addClass('btn_bookoke');
	   		$('.up-sch').removeClass('btn_unactive');
	   		$('.up-sch').addClass('btn_bookoke');

	     	$('.branch').val($id_br);
	      	$('.chair').val(0);

	      	$('.chkT').val(1);
	      	$('.group_time').removeClass('errors');
	   }
	}
/*********** Delete Schedule ***********/
	function delSch(id) {
	   return  $.ajax({ 
	      type       :  "POST",
	      url        :  "<?php echo CController::createUrl('calendar/delSch')?>",
	      data       :  {id_sch:id},
	      dataType   :  'json',
	   });
	}

	function delEv(id) {
		$('#cf_content').text('Bạn có muốn xóa lịch hẹn này không?');
		$('.cf_submit').addClass('cfDel');

		$('#confirm').modal();
		$('.cfDel').click(function (e) {
			$.when(delSch(id)).done(function (data) {
				$('#confirm').modal('hide');
				if(data == 0) {
	               $('#info_content').text('Có lỗi xảy ra! Xin vui lòng thử lại sau!');
	            }
	            else if(data == -1) {
	               $('#info_content').text('Dữ liệu không hợp lệ!');
	            }
	            else if(data == 1) {
	               $('#info_content').text('Lịch hẹn đã xóa thành công!');
	               $('#calendar').fullCalendar( 'removeEvents', id );
	            }
	            $('#update_sch_modal').modal("hide");
	            $("#info").modal();
			})
		})
	}
/*********** Load calendar ***********/
	function loadCalendar(height,resources,id_resource,businessHours) {

		defaultView = id_resource ? 'agendaWeek' : 'agendaDay';
		current     = moment().format('HH:mm:ss');
		grId        = '<?php echo $group_id; ?>';

		$('#calendar').fullCalendar({
			schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',

			allDaySlot   : false,
			titleFormat  : 'DD MMMM - YYYY',
			contentHeight: height,
			nowIndicator : true,
			
			minTime      : '08:00',
			maxTime      : '20:00',
			scrollTime   : current, 
			
			header: {
				left  : '',
				center: 'title',
				right : 'today,prev,next',
		  	},

			defaultView: defaultView,
			views: {
				month:{columnFormat: 'dddd', eventLimit: 5, titleFormat: ' MMMM - YYYY',},
				week: {
					columnFormat   : 'dddd - DD/MM',
					titleFormat    : 'DD MMMM - YYYY',
					slotLabelFormat: 'HH:mm',
					slotDuration   : "00:10:00",
					snapDuration   : '00:05:00'},
				day:  {
					columnFormat   : 'dddd - DD/MM',
					titleFormat    : 'dddd, DD/MM/YYYY',
					slotLabelFormat: 'HH:mm',
					slotDuration   : "00:10:00",
					snapDuration   : '00:05:00',
				},
				timelineOneDays: {
					type           : 'timeline',
					duration       : { weeks: 1 },
					slotDuration   : {days: 1},
					slotLabelFormat: 'dddd, DD/MM'
				}
			},

			editable    : true,
			selectable  : true,
			selectHelper: true,

			resourceLabelText:'Nha sỹ',
			resources        : resources,

		  	viewRender: function( view, element ) {
		  		if(view.type == 'agendaDay' || view.type == 'agendaWeek'){
		  			breakTime(view.type, id_resource);
		  		}

		  		if(view.type == 'agendaWeek') {
		  			now = moment().format('YYYY-MM-DD');
		  			$(".fc-day-header.fc-widget-header[data-date='"+now+"']").css('border','1px solid red');
		  		}

		  		$(".fc-view-container").css('min-width',$('th.fc-resource-cell').length*110);

		  		width = ($('.fc-resource-cell').outerWidth()) ? $('.fc-resource-cell').outerWidth() : $('.fc-day-header').outerWidth();
		  		$(".text-time").css('width',width);
		  	},
		  	eventRender: function(event, element) { 
		  		element.find('.fc-content').prepend("<div class='evBranch'>" + event.branch_name + "<div>");
	            element.find('.fc-title').append("<br/>" + event.services); 
	        },
		  	eventAfterAllRender: function( view ) {

		  		$('.fc-agendaDay-button').click(function(){$("#calendar").css('min-width',$('.fc-resource-cell').length*110);});
		  		
		  		if(view.name == 'agendaWeek') {
		  			$('#cal-view').val(2);
		  		}
		  	},
		  	eventAfterRender: function( event, element, view ) {

		  	},
		  	eventOverlap: function(stillEvent, movingEvent) {
		        if(stillEvent.className == 'breakTime')
		        	return true;
		    },
		  	/*********** Sự kiện khi click chuột ***********/
		  	eventClick: function(calEvent, jsEvent, view) {

		  		$('.cf_submit').attr('class',"btn btn_bookoke cf_submit");

		  		link = "<?php echo $baseUrl; ?>/itemsCustomers/Accounts/admin?code_number="+calEvent.code_pt;

				if(calEvent.id_quotation) {		// xem báo giá
					quote_at = 'view_quote';
				}
				else {		// tạo báo giá
					quote_at = 'quote';
				}

				del = '';
				if(grId == 1 || grId == 2) {
					del = '<button type="button" class="btn delSch btn_cancel" onclick="delEv('+calEvent.id+')" id="">Xóa lịch</button>';
				}

				quote_btn = '<button type="" class="btn btn_bookoke pull-right '+quote_at+'" id=""> Báo giá</button>';

				if(calEvent.id_invoice)
				{
					var invoice_btn = "<a href='"+"<?php echo $baseUrl; ?>/itemsSales/invoices/View?id="+calEvent.id_invoice+"'  class='btn btn_bookoke pull-right'>Hóa đơn</a>";
					sale = invoice_btn;
				}
				else
					sale = quote_btn;

	    		if(calEvent.status == 0) {
	    			title = '<div id="title"><span id="pop-date">'+moment(calEvent.start).format('dddd, DD/MM/YYYY')+'</span><span style="float:right">'+moment(calEvent.start).format('hh:mm') + ' - ' + moment(calEvent.end).format('hh:mm')+'</span></div>';
	    			content = 	'<div id="pop-content">' +
	    						'<table class="table" id="pop-tb1">' +
		    						'<tbody>' +
		    							'<tr>' +
		    								'<td class="text-right">Bác sỹ:</td><td>'+ (calEvent.dentist ? calEvent.dentist:'') +'</td>' +
		    							'</tr>' +
		    							'<tr>' +
		    								'<td class="text-right">Thời gian:</td><td>'+(calEvent.time?calEvent.time:'') +' phút </td>' +
		    							'</tr>' +
		    							'<tr>' +
		    								'<td class="text-right">Đặt bởi:</td><td>'+(calEvent.setBy?calEvent.setBy:'')+'</td>' +
		    							'</tr>' +
		    							'<tr>' +
		    								'<td class="text-right">Trạng thái:</td><td>'+(calEvent.status_text?calEvent.status_text:'')+'</td>' +
		    							'</tr>' +
		    						'</tbody>' +
	    						'</table>' +
		    				'</div>' +
	    					'<div id="pop-footer">' +
	    						del+
	    						'<button type="button" class="btn btn_bookoke edit_sch pull-right" id="">Chỉnh sửa</button>'+
	    					'</div>';
	    		}
	    		else {
	    			title = '<div id="title"><span id="pop-date">'+moment(calEvent.start).format('dddd, DD/MM/YYYY')+'</span><span style="float:right">'+moment(calEvent.start).format('hh:mm') + ' - ' + moment(calEvent.end).format('hh:mm')+'</span></div>';
		    		content = 	'<div id="pop-content">' +
	    						'<table class="table" id="pop-tb1">' +
		    						'<tbody>' +
		    							'<tr>' +
		    								'<td class="text-right">Bác sỹ:</td><td>'+ (calEvent.dentist ? calEvent.dentist:'') +'</td>' +
		    							'</tr>' +
		    							'<tr>' +
		    								'<td class="text-right">Tên dịch vụ:</td><td style="white-space: pre-line;">'+(calEvent.services?calEvent.services:'')+'</td>' +
		    							'</tr>' +
		    							'<tr>' +
		    								'<td class="text-right">Thời gian:</td><td>'+(calEvent.time?calEvent.time:'') +' phút </td>' +
		    							'</tr>' +
		    							'<tr>' +
		    								'<td class="text-right">Đặt bởi:</td><td>'+(calEvent.setBy?calEvent.setBy:'')+'</td>' +
		    							'</tr>' +
		    							'<tr>' +
		    								'<td class="text-right">Trạng thái:</td><td>'+(calEvent.status_text?calEvent.status_text:'')+'</td>' +
		    							'</tr>' +
		    						'</tbody>' +
	    						'</table>' +
	    						'<table class="table" id="pop-tb2">' +
		    						'<tbody>' +
		    							'<tr>' +
		    								'<td>'+(calEvent.patient?calEvent.patient:'')+'</td>' +
		    								"<td class='text-right' style='width: 21%; padding-right: 15px;'><a href='"+link+"' style='color: #93c541; font-weight: bold; font-size:1.2em;'><img style='width: 23px;' src='<?php echo $baseUrl; ?>/images/icon_sb_left/Hoso.png'></a></td>"+
		    							'</tr>' +
		    							'<tr>' +
		    								'<td colspan="2">Mã ID:'+(calEvent.code_pt?calEvent.code_pt:'')+'</td>' +
		    							'</tr>' +
		    							'<tr>' +
		    								'<td>'+(calEvent.phone?calEvent.phone:'')+'</td>' +
		    								"<td class='text-right' style='width: 21%; padding-right: 15px;'><a href='' style='color: #93c541; font-weight: bold; font-size:1.2em;' id='calSms' data-toggle='modal' data-target='#sendsSmsPop'><img style='width: 23px;' src='<?php echo $baseUrl; ?>/images/medical_record/more_icon/phone_sms.jpg'></a></td>"+
		    							'</tr>' +
		    						'</tbody>' +
		    					'</table>' +
		    				'</div>' +
	    					'<div id="pop-footer">' +
	    						'<button type="button" class="btn btn_bookoke edit_sch" id="">Chỉnh sửa</button>'+
	    						sale +
	    					'</div>';
	    		}

	    		id_resource = $('#at_srch').val();
			 
		    	placement = "auto right";
		    	if(view.name == 'agendaDay' && id_resource){
		    		placement = "auto bottom";
		    	}
		    	if(view.name == 'agendaDay'){
		    		container = ".fc-time-grid-container.fc-scroller";
		    	}
		    	else if(view.name == 'timelineOneDays'){
		    		container = ".fc-scroller";
		    	}
		    	else if(view.name == 'month'){
		    		container = "#calendar";
		    	}
		    	else {
		    		container = ".fc-time-grid-container.fc-scroller";
		    	}

		  		$(jsEvent.target).popover({
					html 		: true,
					title 		: title,
					content 	: content,
					container 	: container,
					placement 	: placement,
	                trigger 	: 'focus',
	            }).popover("show");

	            maxH 		= $('#headerMenu').outerHeight(true) + $('.fc-toolbar').outerHeight(true) + $('.fc-head').outerHeight(true) + 2;

	            evOffset 	= $(this).offset();
	            evOffsetT	= parseInt(evOffset['top']);
	            evTop 		= parseInt($(this).css('top'));
	            evHg		= parseInt($(this).height());
	            poTop 		= parseInt($('.popover').css('top'));
	            poWd		= parseInt($('.popover').width());
	            hiddenCal 	= parseInt(evOffset['top']) - maxH;
	            hiddenCalAbs= Math.abs(hiddenCal);
	            halfPo 		= Math.ceil(poWd/2);
	            arrow 		= Math.ceil(evHg/2) + hiddenCalAbs;

	            poW = parseInt($('.popover').css('left'));
		        left= parseInt($('.popover').css('left')) - 7;
	            
	            if(view.name != 'month'){
		            if(hiddenCal == -1) {
		            	$('.popover').css({top: '0px'});
		            	$('.arrow').css('top','13%');
		            }
		            else if(hiddenCal < 0) {
		            	$('.popover').css({top: (hiddenCalAbs + evTop) + 'px'});
		            	$('.arrow').css({top: '15px'});
		            }
		            else if(view.name == 'timelineOneDays'){
		            	if((hiddenCal - halfPo) < -1){
		            		console.log(hiddenCalAbs - halfPo);
							$('.popover').css({top: '0px'});
							$('.arrow').css({top: arrow + 'px'});
		            	}
		            }
		            else if(hiddenCalAbs < (halfPo + 10)) {
		            	$('.popover').css({top: (evTop - hiddenCalAbs) + 'px'});
		            	$('.arrow').css({top: arrow + 'px'});
		            }
		        }

	            $('.popover-title').addClass('popHead');

	            $(document).on('click', function (e) {
	                if (!$(jsEvent.target).is(e.target) && $(jsEvent.target).has(e.target).length === 0 && $('.popover').has(e.target).length === 0)
	                    $(jsEvent.target).popover('hide');
	            });

		  		type 		= 	$('#sr_val').val();
		  		id 			= 	calEvent.id;
		  		start 		=	calEvent.start;

		  		// gửi tin nhắn
		  		$('#calSms').unbind().click(function (e) {
		  			e.preventDefault();
		  			$('#Sms_phone').val(calEvent.phone);
		  			$('#Sms_id_cus').val(calEvent.id_patient);
		  			$("#Sms_cus").val(calEvent.patient);
		  			$("#Sms_id_sch").val(calEvent.codeSch);
		  			$('#sendSMSBtn').removeClass('btn_bookoke').addClass('btn_unactive');
		  		})
		  		
		  		// chỉnh sửa
		  		$('.edit_sch').unbind().click(function(e){

		  			if($('.popover').length) {
			  			$('.popover').popover('hide');	
			  		}

		  			$('.load-up-at').fadeIn('fast');
		  			$('.load-up-cus').fadeIn('fast');

		  			$('#CsSchedule_up_lenght').removeClass('errors');
	   				$('#CsSchedule_up_start_time').removeClass('errors');

		  			$('.nav-tabs a[href="#up-schedule"]').tab('show');
		  			$('.nav-tabs a[href="#up-info"]').tab('show');

		  			if(calEvent.status == 0) {
		  				$('#up-cus').hide();
		  			}

		  			$('.up-sch').attr('class','btn btn_unactive pull-right up-sch up_sch_cus');

		  			dentistListModal(id_branch,2);

		  			$('#update_sch_modal').modal("show");

		        	$.when(getInfoUp(id)).done(function (data) {
		        		infoUpSch(data['sch']);
		        		infoUpCus(data['cus']);
		        		infoUpAl(data['als']);
		        	})
		  		})     

		  		// tạo báo giá
				$('.quote').unbind().click(function(){
					if($('.popover').length) {
			  			$('.popover').popover('hide');	
			  		}
					 x = 1;
			        $('.currentRow').nextAll('tr').remove();
			        $('.sNote').show();
			        $('#sAddNote').addClass('hidden');

			        $('.cal-loading').fadeIn('fast');

				  	$.ajax({ 
			            type:"POST",
			            url:"<?php echo Yii::app()->createUrl('itemsSales/quotations/create')?>",
			            datatype:'json',
			            data: {
			            	id_customer 	: calEvent.id_patient,
			            	id_service		: calEvent.id_service,
			            	id_user			: calEvent.id_dentist,
			            	user_name		: calEvent.dentist,
			            	id_schedule		: calEvent.id,
			            },
			            success:function(data){
			            	 if(data){
			                    $("#quote_modal").html(data);
			                	$('#quote_modal').modal("show");
			                	$('.cal-loading').fadeOut('fast');

			                	itemValue = $('.sItem tr:last').find('.group').val();

								if(itemValue)
									$('.newbtnAdd').removeClass('btn_unactive').addClass('btn_bookoke');
								else
									$('.newbtnAdd').addClass('btn_unactive').removeClass('btn_bookoke');

			                }
			            },
			            error: function(data) {
			                alert("Error occured.Please try again!");
			            },
			        });
			        $('.quote').unbind();
				});

				// cập nhật báo giá
				$('.view_quote').unbind().click(function(){
					if($('.popover').length) {
			  			$('.popover').popover('hide');	
			  		}
					var id_quotation = calEvent.id_quotation;

			        if(!id_quotation)
			            return;
			        $('.cal-loading').fadeIn('fast');
			        $.ajax({ 
			            type:"POST",
			            url:"<?php echo Yii::app()->createUrl('itemsSales/quotations/updateQuotation')?>",
			            datatype:'json',
			            data: {
			                id_quotation: id_quotation,
			            },
			            success:function(data){
			                if(data){
			                     $("#quote_modal").html(data);
			                	$('#quote_modal').modal("show");
			                    $('.cal-loading').fadeOut('fast');
			                }
			            },
			            error: function(data) {
			                alert("Error occured.Please try again!");
			            },
			           
			        });
				});

				$('.invoice').unbind().click(function(){
					$('.cal-loading').fadeIn('fast');
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
			                    $("#quote_modal").html(data);
			                	$('#quote_modal').modal("show");
			                    $('.cal-loading').fadeOut('fast');
			                }
			            },
			            error: function(data) {
			                alert("Error occured.Please try againsssss!");
			            },
			        });
			        $('.invoice').unbind();
				});
		  	},

		  	/* Sự kiện kéo thả 
		  	*  thay đổi thời gian lịch 
		  	*  thay đổi nha sỹ
		  	*  -> kiem tra thoi gian lam viec cua nha sy + lich hen trung
		  	*/
		  	eventDrop: function(event, delta, revertFunc, jsEvent, ui, view ) {
		  		if($('.popover').length) {
		  			$('.popover').popover('hide');	
		  		}

				start 			= event.start;
				end 			= event.end;
				dow 			= (event.start).format('d');
				id_schedule 	= event.id;
				id_resource 	= event.resourceId;
				type 			= $('#sr_val').val();

				// kiem tra thoi gian hien tai
				if(start.format('YYYY-MM-DD HH:mm:ss') <= moment().format('YYYY-MM-DD HH:mm:ss')) {
		  			$('#info_content').text('Chọn thời gian không hợp lệ!');
		  			$("#info").modal();
			   		revertFunc();
			   		return;
				}

				// them class cho action submit
				$('.cf_submit').attr('class',"btn btn_bookoke cf_submit");

				// lich vao kham
				if(event.status == 3 ||event.status == 4) {
		  			$('#info_content').text('Bạn không có quyền dời lịch hẹn này!');
		  			$("#info").modal();
		  			revertFunc();
			   		return;
				}

				// lich hoan tat
				if(event.status == 4) {
		  			/*$('#cf_content').text('Bạn có muốn nhân đôi lịch hẹn này không?');
		  			$("#confirm").modal();
		  			$('.cf_submit').addClass('evDup');*/
				}
				// doi lich
				else {
					$('.cf_submit').addClass('evDro');
		  			$('#cf_content').text('Bạn có muốn dời lịch không?');
		  			$("#confirm").modal();
				}

				$(document).click(function (e) {
					if(!$('#confirm').hasClass('in') && !$('#update_sch_modal').hasClass('in')) {
						revertFunc();
					}
				})

				// sao chep lich
				$('.evDup').unbind().click(function (e) {
					e.preventDefault();

					$('.up-sch').attr('class','btn btn_bookoke pull-right up-sch btn_unactive up_next');

					$("#confirm").modal('hide');
					$('#update_sch_modal').modal('show');

					$.when(getInfoUp(id_schedule)).done(function (data) {
		        		infoUpSch(data['sch'], 1);
		        		infoUpCus(data['cus']);
		        		infoUpAl(data['als']);

						start_time = moment(start).format('YYYY-MM-DD HH:mm:ss');
						$('#CsSchedule_up_start_time').val(start_time);
						$('#CsSchedule_up_status').val(2);
						$('#CsSchedule_up_id_service').val(-1).trigger('change');
						$('#CsSchedule_up_lenght').removeClass('errors');
						$('#CsSchedule_up_id').val(0);
						
			        	resourceText = $('#calendar').fullCalendar('getResourceById', id_resource);
			
					  	$('#CsSchedule_up_id_dentist').html("<option value='"+id_resource+"'>"+resourceText.title+"</option>");
					  	dentistListModal(id_branch);

		        	});

					revertFunc();
				})

	  			// doi lich
				$('.evDro').unbind().click(function(e){
					e.preventDefault();

					// kiem tra thoi gian lich hen
					$.when(checkTimeAjax(event.resourceId, start.format('YYYY-MM-DD HH:mm:ss'), end.format('YYYY-MM-DD HH:mm:ss'), id_schedule)).done(function (data){
						
						$("#confirm").modal('hide');
						if(data.status == 1){
							$.when(updateDrop(event.resourceId, start.format('YYYY-MM-DD HH:mm:ss'), end.format('YYYY-MM-DD HH:mm:ss'), id_schedule)).done(function (data) {
								
								if(data){
									$('#calendar').fullCalendar( 'removeEvents', data['ev'].id );
				               		$('#calendar').fullCalendar( 'renderEvent', data['ev'], true );
				               		$('#info_content').text('Dời lịch thành công!');
									$("#info").modal('show');

				               		getNoti(data['dt'],'update',userLog);
								}
								else {
						  			$('#info_content').text('Có lỗi xảy ra! Xin vui lòng thử lại sau!');
									$("#info").modal('show');
								}
							});
						}
						else {
							$('#info_content').text(data.ms);
							$("#info").modal('show');
							revertFunc();
						}
					});
				})

				$('.btn_close').click(function(e){
					e.preventDefault();
					revertFunc();
				})
		  	},
		  	/*********** Thay đổi kích thước sự kiện ***********/
		  	eventResize: function( event, delta, revertFunc, jsEvent, ui, view ) {
		  		if($('.popover').length) {
		  			$('.popover').popover('hide');	
		  		}

	  			$('#cf_content').text('Bạn có muốn thay đổi thời gian không?');
	  			$("#confirm").modal();
	  			$('.cf_submit').attr('class',"btn btn_bookoke cf_submit");
	  			$('.cf_submit').addClass('evRe');

	  			$('.btn_close').click(function (e) {
	  				e.preventDefault();
	  				revertFunc();
	  			})

	  			$('.evRe').unbind().click(function (e) {
	  				e.preventDefault();
	  				
	  				$.ajax({
						type 	 	: "post",
						dataType 	: 'json',
						url 		: '<?php echo CController::createUrl('calendar/eventResize'); ?>',
						data 		: {
							id 		: event.id,
							end 	: event.end.format('YYYY-MM-DD HH:mm:ss'),
							len 	: event['end'].diff(event['start'],'m'),
						},
						success: function(data) {
							$("#confirm").modal('hide');
							if(data) {
								$('#calendar').fullCalendar( 'removeEvents', data['ev'].id );
				               	$('#calendar').fullCalendar( 'renderEvent', data['ev'], true );
				               	getNoti(data['dt'],'update',userLog);
							}
							if(!data) {
					  			$('#info_content').text('Cập nhật thất bại!');
					  			$("#info").modal();
					  			revertFunc();
							}
						},
					});
	  			})
		  	},
		  	/*********** Tạo sự kiện mới - nhấp chuột vào thời gian trống ***********/
		  	select: function(start, end, jsEvent, view, resource) {
		  		if($('.popover').length) {
		  			$('.popover').popover('hide');	
		  		}

		  		if(view.name == 'month')
		  			return;

		  		var start_time = moment(start).format('YYYY-MM-DD HH:mm:ss');

		  		if(moment().format('YYYY-MM-DD HH:mm:ss') > start_time) {
		  			$('#info_content').text('Chọn thời gian không hợp lệ!');
		  			$("#info").modal();
					return false;
				}

				$('.help-block.error').text("");

		  		$('.nav-tabs a[href="#tab-schedule"]').tab('show');
		  		$('#step-1').addClass('btn_unactive');

		  		$('#CsSchedule_id_service').html('');
		  		$('#CsSchedule_id_customer').html('');
		  		$('#CsSchedule_lenght').val(0);
		  		$('#CsSchedule_lenght').removeClass('errors');
	   			$('#CsSchedule_start_time').removeClass('errors');

		  		if(view.name == 'agendaWeek') {
					id_dentist = $('#at_srch').val();
					dentist    = $('#at_srch').select2('data');

		  			$('#CsSchedule_id_dentist').html("<option value='"+id_dentist+"'>"+dentist[0].text+"</option>");
		  			servicesList(id_dentist);
		  		}
		  		else {
		  			$('#CsSchedule_id_dentist').html("<option value='"+resource.id+"'>"+resource.title+"</option>");
		  			servicesList(resource.id);
			  	}

			  	if(view.name == 'timelineOneDays'){
			  		start_time = moment(start).format('YYYY-MM-DD') + ' ' + moment().format('HH:mm:ss');
			  	}

			  	dentistListModal(id_branch);

			  	$('#create_sch_modal').modal('show');

				$('#CsSchedule_start_time').val(start_time);
				$('.load-at').fadeOut('slow');
		  	},
		});

		btnRight();
		btnCenter();
		
		$('#cal-view').change(function(){
			views = $('#cal-view').val();
			changeViews(views,id_resource);
		});

		changeStatus();
	}
/*********** load resources ***********/
	function loadResources(id_branch,id_resource){
		height     = 	$(window).height()-150;
		
		id_patient = '';
		url        = '<?php echo CController::createUrl('calendar/getDentistList'); ?>';
			
		$('.cal_loading').fadeIn('fast');
		$.ajax({
			type    : "post",
			dataType: 'json',
			url     : url,
			data: {
				id_resource: id_resource,
				id_branch  : id_branch,
			},
			success: function(data) {
				if(data.length == 0){
					$('.cal-loading').fadeOut('fast');
					return;
				}
				if(data == -1) {
					loadResources(id_branch,'');
					return;
				}
				data = $.grep(data, function(k) {
					return k['id']  != 0;
				});

				$('#calendar').fullCalendar('destroy');
				loadCalendar(height,data,id_resource,'');
				showEvents(id_resource,id_patient,id_branch);
				getNewSch();
			},
		});
	}
</script>

<script>
$(document).ready(function () {
	$.fn.select2.defaults.set( "theme", "bootstrap");
	$('#id_branch').val(<?php echo Yii::app()->user->getState('user_branch'); ?>);
	id_branch = $('#id_branch').val();
	userLog   = $('#idUserLog').val();
	// nha sy = 1
	$('.Csh_type').val(1);

	setInterval(function(){ 
		changeStatus();
	}, 1000*60*5);

	var id_dentist 	= 	$('#at_srch').val();
	var role 		= 	'<?php echo $role; ?>';

	if(role == 0) {
		id_dentist 		= '<?php echo $id_user; ?>';
		name_dentist 	= '<?php echo $name_user; ?>';
	}

	today 	= 	moment();
	$('.datetimepicker').datetimepicker({
		sideBySide 	: true,
		minDate 	: today.startOf('hour'),
		format 		: 'YYYY-MM-DD HH:mm:ss',
		stepping 	: 5,
	});

	$('.sch_dentist').change(function (e) {
		e.preventDefault();
		$('.sch_service').val(-1).trigger('change');
	})

	loadResources(id_branch,id_dentist);
	dentistList(id_branch);

	$('#id_branch').change(function (e) {
		id_branch 	= $('#id_branch').val();
		
		dentistList(id_branch);
		loadResources(id_branch,'');
		$('#at_srch').val("").trigger('change');
	})

	$('.search').change(function(){
		id_branch   = $('#id_branch').val();
		id_resource = $('#at_srch').val();

		loadResources(id_branch,id_resource);
	})

	customerList();
})
</script>