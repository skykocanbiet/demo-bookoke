<?php
	$waitingSchedule = $model->checkWaitingSchedule($model->id);
?>
<!-- Customer Information -->

<div class="customerDetailsContainer">
    
	<!-- tabs -->
	<div id="tabcontent" class="tabbable">

		<ul class="nav nav-tabs menuTabDetail">
			<li class="active"><a href="#tab_medical_record" data-toggle="tab">Hồ sơ</a></li>
			<li><a href="#appointment_schedule" data-toggle="tab">Lịch hẹn</a></li>
			<li><a href="#tab_medical_report" data-toggle="tab">Bệnh án</a></li>

		    
		    <li><a href="#tab_treatment_history" data-toggle="tab">Giao dịch</a></li>
		    <!--  <li><a href="#tab_insurance_information" data-toggle="tab">Bảo hiểm</a></li> -->
		    <li><a href="#tab_member" data-toggle="tab">Hội viên</a></li>
		    <li><a href="#tab_note" data-toggle="tab">Ghi chú</a></li>
		    <li><a href="#tab_statistical" data-toggle="tab">Thống kê</a></li>
		    <li><a href="#tab_treatment" data-toggle="tab">Điều trị</a></li>
		</ul>

		<div class="tab-content">
		  
			<div class="tab-pane active" id="tab_medical_record">
		    	<div class="statsTabContent tabContentHolder scrollbox">
					<div class="scrollbox-content">
						<?php include('tab_medical_record.php'); //Hồ SƠ ?>
					</div>
		        </div>
		    </div>
				
			<div class="tab-pane" id="appointment_schedule">
				<div class="statsTabContent tabContentHolder" >
					<?php include('tab_appointment_schedule.php'); //LICH HẸN ?>
				</div>
			</div>	  	

		    <div class="tab-pane" id="tab_medical_report">
		    	<div class="statsTabContent tabContentHolder" >
		    		<div id="medical_record"> 
	
					</div>
					
		        </div>
		    </div>
			
		    <div class="tab-pane" id="tab_treatment_history">
		        <?php  //include('tab_treatment_history.php') ?>
		        
		    </div>

		    <div class="tab-pane " id="tab_member">
		    	<div class="statsTabContent tabContentHolder" >
		        	<?php //include('tab_member.php') ?>
		        </div>
		    </div>

		    <div class="tab-pane" id="tab_note">
		    	<div class="statsTabContent tabContentHolder"  id="note_cus">		 
			        <?php //include('tab_activity_history.php') ?>
		        </div>
		    </div>

		    <div class="tab-pane" id="tab_statistical">
		    	<div class="statsTabContent tabContentHolder" >	
			        <?php  //include('tab_statistical.php') ?>
		        </div>
		    </div>

		    <div class="tab-pane" id="tab_treatment">
		    	<div class="statsTabContent tabContentHolder" >		
			        <?php // include('tab_treatment_old.php') ?>
		        </div>
		    </div>
		</div>
	</div>
<!-- /tabs -->
</div>


<script type="text/javascript">
// load danh sach hoa don + phan trang
	function loadInvoice(page, id_cus) {
		$.ajax({ 
	       	type     :"POST",
	       	url      :baseUrl+"/itemsCustomers/Accounts/getListInvoice",
	       	data: {
					id_customer: 	id_cus,
					page       : 	page,
	       	},
	       	success: function (data) {
	       		$('#tab_treatment_history').html(data);
	       	},
	    });
	}
	function loadStatistical(id_cus) {
		$.ajax({ 
	       	type     :"POST",
	       	url      :baseUrl+"/itemsCustomers/Accounts/getStatistical",
	       	data: {
					id_customer: 	id_cus,
	       	},
	       	success: function (data) {
	       		$('#tab_statistical').html(data);
	       	},
	    });
	}
	function loadMember(id_cus) {
		$.ajax({ 
	       	type     :"POST",
	       	url      :baseUrl+"/itemsCustomers/Accounts/getMember",
	       	data: {
					id_customer: 	id_cus,
	       	},
	       	success: function (data) {
	       		$('#tab_member').html(data);
	       	},
	    });
	}
	function activetabnote(id)
	{
		$.ajax({
			type 		:'POST',
			url 		:baseUrl+'/itemsCustomers/Accounts/getActiveTabNote',
			data 		:{id:id},
			success: function(data){
				$('#note_cus').html(data);
			},
		});
	}

	function outgoing_calls()
	{
		var phone = $('#phone').val();
		var phoneuser ="0"+phone.slice(2, 15);
		var id_user = <?php echo Yii::app()->user->getState('user_id') ?>;
		$.ajax({
			type:'POST',
			url:'<?php echo CController::createUrl('Accounts/GetCall')?>',
			data:{
                'phone' : phoneuser,
                'id_user': id_user,
            },
            success:function(dataString)
            {
            	if (dataString =="Success") {
            		$.jAlert({
	                    'title': "Thông báo !",
	                    'content': "Bắt đầu cuộc gọi"
	                });
            	}
            	else{
            		$.jAlert({
	                    'title': "Thông báo !",
	                    'content': "Không bắt máy"
	                });
            	}
            	
            },
		});
	}

	function loadMedicalReport(id_cus,treatment) {
	
		$.ajax({ 
	       	type     :"POST",
	       	url      :baseUrl+"/itemsCustomers/Accounts/loadMedicalReport",
	       	data: {
					id_customer: 	id_cus,		
					treatment  : 	treatment,				
	       	},
	       	success: function (data) {
	       		$('#medical_record').html(data);
	       	},
	    });

	}

$(window).resize(function() {
    var w_ct  = $("#tabcontent").width();
    var h_ct  = $(".statsTabContent").height();
    
    $('#tabcontent .no-data').css('width',w_ct); 
    $('#tabcontent .no-data').css('height',h_ct-90);

    $('#invDetail').css('height', h_ct-10);
});

$( document ).ready(function() {
    var w_ct  = $("#tabcontent").width();
    var h_ct  = $(".statsTabContent").height();

    $('#tabcontent .no-data').css('width',w_ct);
    $('#tabcontent .no-data').css('height',h_ct-90);
   
    // click chon tab
    $('.tabbable').on('click','a',function(e){
    	idTab = $(this).attr('href');
    	idCus = '<?php echo $model->id; ?>';
    	
    	switch(idTab)
    	{
    		case '#appointment_schedule': 		// lich hen
    			loadSchCus(1,idCus);	// file listScheduleCustomer
    		break;
    		case '#tab_medical_report': 		// benh an
    			loadMedicalReport(<?php echo $model->id;?>);	
    		break;
    		case '#tab_treatment_history': 		// giao dich
    			loadInvoice(1,idCus);	// file listScheduleCustomer
    			$('#invDetail').css('height', h_ct-500);
    			 console.log(h_ct-500);
    		break;
    		case '#tab_treatment': 			// dieu tri
    			searchTreatmentOld(1);			// file treatmentOldlist
    		break;
    		case '#tab_note': 		//ghi chu
    			activetabnote(idCus);	// file listScheduleCustomer
    		break;
    		case '#tab_statistical': 		//thống kê
    			loadStatistical(idCus);	
    		break;
    		case '#tab_member': 		//hội viên
    			loadMember(idCus);	
    		break;

    	}
    });
});
</script>

