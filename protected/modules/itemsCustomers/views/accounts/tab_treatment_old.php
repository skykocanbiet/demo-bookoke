<style type="text/css">
	.quantrong td{
		background-color: #fdc4c9 !important;
	}
	.sss td a{
		display: none;
	}
	.sss:hover td a{
		display: block;
	}
	.tbl_tm th, .tbl_tm th {vertical-align: middle;}
	.tmo1{width: 7%}
	.tmo2{width: 11%}
	.tmo3{width: 13%}
	/*.tmo4{width: 10%}
	.tmo5{width: 10%}*/
	.tmo6{width: 10%; text-align: right !important;}
	.tmo7{width: 11%; text-align: right !important;}
	.tmo8{width: 9%; text-align: right !important;}
</style>
<?php $baseUrl = Yii::app()->baseUrl;?>

<div class="customerProfileContainer">
	<div id="customerProfileDetail" class="customerProfileHolder" style="display: block;margin:20px auto;">
		<div class="form-inline" style=" margin: 0px -15px 20px -15px;">
			<div class="form-group">
				<label for="tm_dentist">Nha sỹ: </label>
				<input type="text" class="form-control" id="tm_dentist" style="border-color: #ccc;">
			</div>
			<div class="form-group">
				<label for="tm_service">Dịch vụ:</label>
				<input type="text" class="form-control" id="tm_service" style="border-color: #ccc;">
			</div>
			<!-- <div class="form-group">
				<label for="tm_date">Ngày: </label>
				<input type="text" name="date" id="tm_date" value="" style="height:34px; border-radius:4px; width: 150px;border-color: #ccc;text-align: center;"  onchange="searchTreatmentOld(1);" />
			</div> -->
		</div>
	</div>

	<div class="table_content" id="tm_table">
		
	</div>
</div>

<script type="text/javascript">
/*********** Danh sách bác sỹ ***********/
	function dentist_treatment(id_branch) {
		$('#tm_dentist').select2({
		    placeholder: {
		    	id: -1,
		    	text: 'Xem tất cả'
		    },
		    //width: '%',
		    ajax: {
		        dataType : "json",
		        url      : '<?php echo Yii::app()->createUrl('itemsSchedule/calendar/getDentistList'); ?>',
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
					return {
						results: data,
					};
				},
				cache: true,
		    },
		});
	}
/*********** Lay danh sach dich vu ***********/
	function serviceList() {
		$('#tm_service').select2({
			placeholder: {
		    	id: -1,
		    	text: 'Xem tất cả'
		    },
			//width      : '248px',
			ajax       : {
		        dataType : "json",
		        url      : '<?php echo Yii::app()->createUrl('itemsSales/quotations/getServicesList'); ?>',
		        type     : "post",
		        delay    : 1000,
		        data : function (params) {
					return {
						q   : params.term, // search term
						page: params.page || 1,
						seg :seg,
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
/*********** Loc dieu tri theo bac sy, dich vu, ngay ***********/
function searchTreatmentOld(curpage,code_number,tm_dentist,tm_service,tm_date){
	var tm_dentist  = $('#tm_dentist').val();
	var tm_service  = $('#tm_service').val();
	var tm_date     = $('#tm_date').val();
	var code_number = '<?php echo $model->code_number_old; ?>';
	var curpage     = 1;
	var lpp         = 20;

	//$('.cal-loading').fadeIn('fast');

	if(!code_number)
		return;

	$.ajax({
		type: 'POST',
		url : baseUrl+"/itemsCustomers/Accounts/searchTreatmentOld",
		data: {
			'curpage'    : curpage,
			'lpp'        : lpp,
			'code_number': code_number,
			'tm_dentist' : tm_dentist,
			'tm_service' : tm_service,
			'tm_date'    : tm_date,
		},
		success:function(data){
			$('#tm_table').html(data);
			$('.cal-loading').fadeOut('fast');
			var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
   			$('.autoNum').autoNumeric('init',numberOptions);
		},
		error: function(data){
        	console.log("error");
        	console.log(data);
        }
	});

}

$(function() {
	$.fn.select2.defaults.set( "theme", "bootstrap");
	id_branch = '<?php echo Yii::app()->user->getState('user_branch'); ?>';
	//dentist_treatment(id_branch);
	//serviceList();

	$('#tm_dentist').change(function (e) {
		var tm_dentist  = $('#tm_dentist').val();
		var tm_service  = $('#tm_service').val();
		var tm_date     = $('#tm_date').val();
		var code_number = '<?php echo $model->code_number_old; ?>';

		searchTreatmentOld(1,code_number,tm_dentist,tm_service,tm_date);
	});

	$('#tm_service').change(function (e) {
		var tm_dentist  = $('#tm_dentist').val();
		var tm_service  = $('#tm_service').val();
		var tm_date     = $('#tm_date').val();
		var code_number = '<?php echo $model->code_number_old; ?>';
		searchTreatmentOld(1,code_number,tm_dentist,tm_service,tm_date);
	});
});
</script>
