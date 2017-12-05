<?php $sch = new CsSchedule(); ?>

 <div class="appointmentsTabContent tabContentHolder">

	<div id="loadSchCus">
		
	</div>
</div>

<!-- tao lich hen moi -->
<style>
	#CalendarModal .modal-dialog {width: 410px; padding-top: 50px;}
	#CalendarModal .modal-content {border-radius: 0;}
	#CalendarModal .modal-header {background: #e1e1e1; color: black; padding: 7px 25px; height: 60px}
	#CalendarModal .modal-header h3 {font-size: 20px; line-height: 2.5em;; font-weight: normal;}
	#CalendarModal .modal-header .close {font-size: 36px; color: black; opacity: 1; font-weight: lighter; line-height: 1.5em;} 
	#CalendarModal .modal-body {padding: 15px;}
	#CalendarModal .modal-body h4 {font-size: 16px; font-weight: normal;}
	#start_date {
		-webkit-border-top-right-radius: 0;
		-moz-border-top-right-radius: 0;
		border-top-right-radius: 0;

		-webkit-border-bottom-right-radius: 0;
		-moz-border-bottom-right-radius: 0;
		border-bottom-right-radius: 0;
	}

	#start_time {
		-webkit-border-top-left-radius: 0;
		-moz-border-top-left-radius: 0;
		border-top-left-radius: 0;

		-webkit-border-bottom-left-radius: 0;
		-moz-border-bottom-left-radius: 0;
		border-bottom-left-radius: 0;
	}
	#schErr {color: red; font-style: italic; text-align: center;}
</style>

<?php $group_no = Yii::app()->user->getState('group_no'); ?>
<!-- modal -->
<div id="CalendarModal" class="modal">
   	<div class="modal-dialog">
      	<div class="modal-content">
         	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">close</span></button>
            	<h3 id="modalTitle" class="modal-title">TẠO LỊCH HẸN</h3>
         	</div>
   
         	<div id="modalBody" class="modal-body">
        		<form enctype="multipart/form-data" class="form-horizontal" id="frm-next-sch" action="/nhakhoa2000/itemsSchedule/calendar/index" method="post">  
        
		            <!-- Lich hen -->
		            <div id="tab-schedule" class="tab-pane">
		               	<div class="form-group">
		               		<label class="col-xs-7 control-label" for="CsSchedule_status">Trạng thái lịch hẹn</label>
		               		<div class="col-xs-4">
			                   <?php echo CHtml::dropDownList('CsSchedule[status]', '', $sch->st1, array('class'=>'form-control','id'=>'CsSchedule_status')); ?>
			                </div>
		               	</div>

		                <div class="clearfix"></div>

						<input name="CsSchedule[id_customer]" id="CsSchedule_id_customer" type="hidden">
		               	<input name="CsSchedule[id_author]" id="CsSchedule_id_author" type="hidden" value="<?php echo Yii::app()->user->getState('user_id'); ?>">
		               	<input name="CsSchedule[id_chair]" class="chair" id="CsSchedule_id_chair" type="hidden" value="0">
		               	<input name="CsSchedule[id_branch]" class="branch" id="CsSchedule_id_branch" type="hidden" value="<?php echo Yii::app()->user->getState('user_branch'); ?>">
		               	<input name="CsSchedule[end_time]" class="end_time" id="CsSchedule_end_time" type="hidden">

		               	<div class="form-group">
		                    <label class="col-xs-3 control-label" for="CsSchedule_id_dentist">Nha sỹ</label>
		                    <div class="col-xs-8">
		                       <?php if ($group_no == Yii::app()->params['id_group_dentist']): ?>
			                       	<select class="form-control" name="CsSchedule[id_dentist]" id="CsSchedule_id_dentist">
			                       		<option value="<?php echo Yii::app()->user->getState('user_id'); ?>"><?php echo Yii::app()->user->getState('user_name'); ?></option>
			                       	</select>
			                    <?php else: ?>
			                       	<?php 
			                       	$dent = GpUsers::model()->findAllByAttributes(array('group_id'=>Yii::app()->params['id_group_dentist']), 'status_hidden >= 0');
			                       	$listDent = CHtml::listData($dent,'id','name');
			                       	echo CHtml::dropDownList('CsSchedule[id_dentist]', '', $listDent, array('class'=>'form-control','id'=>'CsSchedule_id_dentist')); ?>
			                    <?php endif ?>
		                    </div>
		                </div>

		                <div class="form-group" style="margin-bottom: 5px;">
		                    <label class="col-xs-3 control-label" for="CsSchedule_id_service">Dịch vụ</label>
		                    <div class="col-xs-8">
		                       	<select placeholder="" class="sch_service form-control" name="CsSchedule[id_service]" id="CsSchedule_id_service"></select>
		                    </div>
		                </div>

		                <div class="form-group">
		                    <label class="col-xs-3 control-label" for="CsSchedule_lenght">Thời gian</label>
		                    <div class="col-xs-8">
		                       	<div class="input-group">
		                       		<input type="number" class="len times form-control" name="CsSchedule[lenght]" id="CsSchedule_lenght" value="0" min="0" max="200" step="5">
		                          	<span class="input-group-addon">phút</span>
		                       	</div>
		                    </div>
		                </div>

		                <div class="form-group">
		                    <label class="col-xs-3 control-label" for="CsSchedule_start_time">Ngày giờ</label>
		                    <div class="col-xs-8 times">
		                       	<div class="col-xs-7">
		                       		<div class="row">
		                       			<input class="group_time form-control" id="start_date" type="text" />
		                       		</div>
		                       	</div>

		                       	<div class="col-xs-5">
		                       		<div class="row">
		                       			<select name="" class="form-control" id="start_time">
		                       				<option value="0">00:00</option>
		                       			</select>
		                       		</div>
		                       	</div>

		                       <input name="CsSchedule[start_time]" id="CsSchedule_start_time" type="hidden" />
		                    </div>
		                </div>

		                <div class="form-group">
		                	<label class="col-xs-3 control-label" for="CsSchedule_note">Ghi chú</label>
		                	<div class="col-xs-8">
		                		<textarea class="form-control" placeholder="Note" name="CsSchedule[note]" id="CsSchedule_note"></textarea>
		                		<div class="help-block error" id="CsSchedule_note_em_" style="display:none"></div>
		                	</div>
		                </div>

		                <div class="help-block" id="schErr"></div>

		                <div class="form-group">
		                    <div class="col-xs-11">
		                        <button type="submit" class="btn pull-right" style="color: white; background: #7cc9ac;">Đặt lịch</button>
		                    </div>  
		                </div>
		            </div>
		        </form>
          	</div>
        </div>
    </div>
</div>

<script>
// lay danh sch dich vu
	function getServiceForCus(id_den) {
		if(!id_den)
			id_den 	= $('#CsSchedule_id_dentist').val();

		$('#CsSchedule_id_service').select2({
	        language: 'vi',
	        placeholder: {
	            id: -1,
	            text: 'Xem tất cả'
	        },
	        width: '100%',
	        ajax: {
	            dataType : "json",
	            url      : "<?php echo Yii::app()->createUrl('itemsSchedule/calendar/getServiceList'); ?>",
	            type     : "post",
	            delay    : 1000,
	            data : function (params) {
	               	return {
						q         : params.term, // search term
						page      : params.page || 1,
						up        : 1,
						id_dentist: id_den,
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
// lay thoi gian trong
	function getTimeForDent(id_den, id_ser, time, len) {
		$.ajax({ 
	       	type     :"POST",
	       	url      :"<?php echo Yii::app()->createUrl('itemsSchedule/calendar/getTimeForDent'); ?>",
	       	dataType :'json',
	       	data: {
	          	id_den 	: 	id_den,
	          	id_ser	: 	id_ser,
	          	time 	: 	time,
	          	len 	: 	len,
	       	},
	       	success: function (data) {	    
	       		if(data[0].time != 0)
	       			showTime(data[0]);
	       		else 
	       			$('#start_time').html('<option value="0" data-chr="0">00:00</option>');
	       	},
	    });
	}
// show thoi gian trong
	function showTime(data) {
		ti   =	$('#start_time');
		opt  =	'';
		fchr = '';

		time = data.time;
		date = moment(data.day);
		
		$.each(time, function (k, v) {
			str = v.split(" - ");

			if(date.isSame(moment(),'day')){
				if(moment(str[0],'HH:mm:ss') < moment()){
					opt = '<option value="0" data-chr="0">00:00</option>';
					return true;
				}
			}

			opt = opt + '<option value="'+str[0]+'" data-chr="0" data-br="'+str[2]+'">'+moment(str[0], "HH:mm:ss").format("HH:mm")+'</option>';
		})

		ti.html(opt);
	}
// load danh sach lich hen + phan trang
	function loadSchCus(page, id_cus) {
		$.ajax({ 
	       	type     :"POST",
	       	url      :baseUrl+"/itemsCustomers/Accounts/getListSchCus",
	       	data: {
					id_customer: 	id_cus,
					page       : 	page,
	       	},
	       	success: function (data) {
	       		$('#loadSchCus').html(data);
	       	},
	    });
	}
/*********** thong bao ***********/
	function getNoti(dataSch, action, author) {
		console.log(dataSch);
	    $.ajax({
			url     : '<?php echo Yii::app()->createUrl('itemsSchedule/calendar/getNoti'); ?>',
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
// reset form 
	function resetForm() {
		$('#CsSchedule_status').val(1);
		$("#CsSchedule_id_dentist").val($("#CsSchedule_id_dentist option:first").val());
		$('#CsSchedule_id_service').html("");
		$('#CsSchedule_lenght').val(0);
		$('#start_date').val(moment().format('YYYY-MM-DD'));
		$('#start_time').html('<option value="0" data-chr="0">00:00</option>');
		$('#CsSchedule_note').val('');
	}
</script>

<script>
today 	= 	moment();

$('#start_date').datetimepicker({
	minDate 	: today,
	format 		: 'YYYY-MM-DD',
});

// change dentist
$('#CsSchedule_id_dentist').change(function(e){
	id_den 	= $('#CsSchedule_id_dentist').val();
	id_ser 	= $('#CsSchedule_id_service').val();
	time 	= $('#start_date').val();
	len     = $('#CsSchedule_lenght').val();

	getTimeForDent(id_den, id_ser, time, len);
})

// change service
$('#CsSchedule_id_service').change(function(e){
	id_den 	= $('#CsSchedule_id_dentist').val();
	id_ser 	= $('#CsSchedule_id_service').val();
	time 	= $('#start_date').val();

	ser_data =  $('#CsSchedule_id_service').select2('data');
	len = 0;
	if(ser_data){
		len = ser_data[0].len;
		$('#CsSchedule_lenght').val(len);
	}

	getTimeForDent(id_den, id_ser, time, len);
})

// change length services
$('#CsSchedule_lenght').change(function(e){
  	id_den 	= $('#CsSchedule_id_dentist').val();
  	id_ser 	= $('#CsSchedule_id_service').val();
  	time 	= $('#start_date').val();
  	len     = $('#CsSchedule_lenght').val();

  	getTimeForDent(id_den, id_ser, time, len);
})

// change start_time
$('#start_date').on('dp.change',function(){
  	id_den 	= $('#CsSchedule_id_dentist').val();
  	id_ser 	= $('#CsSchedule_id_service').val();
  	time 	= $('#start_date').val();
  	len     = $('#CsSchedule_lenght').val();
  
  	getTimeForDent(id_den, id_ser, time, len);
})

// submit schedule
$('#frm-next-sch').submit(function (e) {
  	e.preventDefault();

  	date = $('#start_date').val();
  	time = $('#start_time').val();
  	len  = $('#CsSchedule_lenght').val();

  	if(time == 0){
  		$('#schErr').text("Ngày giờ không hợp lệ!");
  		return;
  	}

  	start_date 	= moment(date, 'YYYY-MM-DD').format('YYYY-MM-DD');
  	start_time	= moment(time, 'HH:mm:ss').format('HH:mm:ss');
  	start 		= start_date + ' ' + start_time;
  	end 		= moment(start).add(len,'m').format('YYYY-MM-DD HH:mm:ss');
  	id_branch = $('#start_time option:selected').data('br');
  	console.log(id_branch);

  	id_service = $('#CsSchedule_id_service').val();

  	$('#CsSchedule_id_customer').val($('#id_customer').val());
  	$('#CsSchedule_start_time').val(start);
  	$('#CsSchedule_end_time').val(end);
	$('#CsSchedule_id_branch').val(id_branch);

  	if(!id_service){
  		$('#schErr').text("Dịch vụ không hợp lệ");
  		return;
  	}
  	if(!len){
  		$('#schErr').text("Thời gian dịch vụ không hợp lệ!");
  		return;
  	}

  	var formData   = new FormData($("#frm-next-sch")[0]);
  
    if (!formData.checkValidity || formData.checkValidity()) {
           	jQuery.ajax({ 
              	type  	:  "POST",
               	url  	:  "<?php echo Yii::app()->createUrl('itemsSchedule/calendar/addNextSch')?>",
               	data    :  formData,
               	dataType:  'json',

               	success	:function(data){
               		$('#schErr').text("");
               		if(data.status == 1){
               			$('#CalendarModal').modal('hide');
               			loadSchCus(1, $('#id_customer').val());
               			getNoti(data.success, 'add', <?php echo Yii::app()->user->getState('user_id'); ?>);
               			resetForm();
               		}

                 	else {
                 		$('#schErr').text(data["error-message"]);
                 	}
               	},
               	error: function(data) {
                   alert("Error occured.Please try again!");
               	},
					cache      : false,
					contentType: false,
					processData: false
           });
       }
   
    return false;
})
</script>