<div id="book_choose_time">
	<div class="alert">
		Chọn ngày và giờ
	</div>
	    
    <div class="col-xs-4">
        <div class="row">
        	<div id="datetimepickerBook"><input type="hidden" class="form-control" id="datepicker-data"></div>
        </div>
    </div>

    <div class="col-xs-8">
		<div class="panel panel-default">
		  	<div class="panel-body">
		    	<div class="book_time_titile">
		    		Giờ trống ngày <span class="date"> 11/11/2016</span>
		    	</div>
		    	<div class="choose_time">
		    	</div>
		  	</div>
		</div>
    </div>

</div>

<script>
function getTime(date) {
	$('.date').html(date);

	date  = moment(date,'DD/MM/YYYY').format('YYYY-MM-DD');
	today = moment();

	$.ajax({
		url 		: "<?php echo CController::createUrl('fb/getTime'); ?>",
		type 		: 'POST',
		dataType 	: 'json',
		data 		: {
			date 	: 	date,
		},
		success 	: function (data) {
			time = '';
			dt   = moment(date);
			$.each(data, function (key, val) {
				$.each(val.time, function (k, v) {
					t = v.split(' - ');
					if(dt.isSame(today,'day')){
						if(moment(t[0],'HH:mm:ss') < moment().add(4, 'h')){
							return true;
						}
					}
					time += '<div class="col-xs-6 col-sm-4 col-lg-3">' +
		    					'<div class="row time">' +
		    						'<span>'+ moment(t[0],'HH:mm:ss').format('HH:mm') +' - '+ moment(t[1],'HH:mm:ss').format('HH:mm') +'</span>' +
		    					'</div>' +
		    				'</div>';
				})
			})
			if(time == '')
				time = 'Không có thời gian thích hợp. <br/> (Vui lòng chọn vào một ngày khác.)';
			$('.choose_time').empty();
			$('.choose_time').html(time);
		}, 
	})
}

moment.locale('vi');

$('#datetimepickerBook').datetimepicker({
    inline: true,
    format: 'DD/MM/YYYY',
    minDate: moment(),
    locale: 'vi',
});

getTime(moment().format('DD/MM/YYYY'));

$('#datetimepickerBook').on('dp.change',function(){
	var dateData = $('#datepicker-data').val();
   	getTime(dateData);
});

$('.choose_time').on('click', '.time',function (e) {
	e.preventDefault();

	date = $('#datepicker-data').val();
	time = $(this).find('span').text();
	time = time.split(' - ');

	time_start = moment(time[0],'HH:mm').format('HH:mm:ss');
	time_end   = moment(time[1],'HH:mm').format('HH:mm:ss');

	calInfo(date, time_start, time_end);
});
</script>