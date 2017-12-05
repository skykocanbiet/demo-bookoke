<div id="book_choose_time">
	<div class="alert">
		Choose a Date and Time (GMT + 00:00)
	</div>
	    
    <div class="col-md-4">
        <div class="row">
        	<div id="datetimepickerBook"><input type="hidden" class="form-control" id="datepicker-data"></div>
        </div>
    </div>

    <div class="col-md-8">
		<div class="panel panel-default">
		  	<div class="panel-body">
		    	<div class="book_time_titile">
		    		Time for <span class="date"> 11/11/2016</span>
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

	date = moment(date,'DD/MM/YYYY').format('YYYY-MM-DD');

	$.ajax({
		url 		: "<?php echo CController::createUrl('book/getTime'); ?>",
		type 		: 'POST',
		dataType 	: 'json',
		data 		: {
			date 	: 	date,
		},
		success 	: function (data) {
			time = '';
			$.each(data, function (key, val) {
				$.each(val.time, function (k, v) {
					time += '<div class="col-xs-6 col-sm-4 col-lg-3">' +
		    					'<div class="row time">' +
		    						'<span>'+ v +'</span>' +
		    					'</div>' +
		    				'</div>';
				})
			})
			if(time == '')
				time = 'Không có thời gian thích hợp!';
			$('.choose_time').empty();
			$('.choose_time').html(time);
		}, 
	})
}

$('#datetimepickerBook').datetimepicker({
    inline: true,
    format: 'DD/MM/YYYY',
    minDate: moment(),
});

getTime(moment().format('DD/MM/YYYY'));

$('#datetimepickerBook').on('dp.change',function(){
	var dateData = $('#datepicker-data').val();
   	getTime(dateData);
});

$('.choose_time').on('click', '.time',function (e) {
	e.preventDefault();
	runProcess('57%');

	date = $('#datepicker-data').val();
	time = $(this).find('span').text();
	time = time.split(' - ');

	$.ajax({
		url: "<?php echo CController::createUrl('book/book_info'); ?>",
		type: 'POST',
		data: {
			date 		: 	date,
			time_start 	: 	time[0],
			time_end	: 	time[1] 
		},
		success: function (data) {
			$('#book_choose').empty();
			$('#book_choose').html(data);
		}, 
	})
});
</script>