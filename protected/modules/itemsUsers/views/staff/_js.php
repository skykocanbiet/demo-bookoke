<script>

function isValidEmailAddress(emailAddress){var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;return pattern.test(emailAddress);};
function isValidPhoneNumber(phoneNumber){var pattern = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;return pattern.test(phoneNumber);}

var baseUrl = $('#baseUrl').val();

function searchListStaffs(id=''){
    
	var value = $('#searchNameCustomer').val();	
	var type  = $("#searchSortCustomer").val();
    var group_id = <?php  echo Yii::app()->user->getState('group_id'); ?>;
    var id_user = <?php echo Yii::app()->user->getState('user_id'); ?>;
    $('.cal-loading').fadeIn('fast');

    $.ajax({
	    type:'POST',
	    url: baseUrl+'/itemsUsers/Staff/SearchListStaffs',	
	    data: {"value":value,"type":type,"group_id":group_id,'id_user':id_user},   
	    success:function(data){
	    	$('#customerListHolder').html(data);
	    	detailCustomer(id);
            $('.cal-loading').fadeOut('slow');
	    },
	    error: function(data){
	    console.log("error");
	    console.log(data);
	    }
    });
}
function detailCustomer(id){

	$('.cal-loading').fadeIn('fast');
    
	if(id == null || id == '') 
	{
		var id = $("#customerList li:first-child").find('input').val();
	}
	$('.n').removeClass("active"); 
	$("#c"+id).addClass("active");
	$("#c"+id).find('code').removeClass("hide");
	$.ajax({
	    type:'POST',
	    url: baseUrl+'/itemsUsers/Staff/DetailStaff',	
	    data: {"id":id},   
	    success:function(data){   	
	    	$('#detailCustomer').html(data);  
            $('.cal-loading').fadeOut('slow');         
	    },
	    error: function(data){
	    console.log("error");
	    console.log(data);
	    }
    });

}
function runScript_search(e){
    
	if (e.keyCode == 13) {
        e.preventDefault();
       searchListStaffs();
    }
}
function err(){
	var status = true;	
	if($('#fullname').val() == ''){        
        status = false;
        $('#fullname').addClass('invalid'); 
    }
    else{
    	$('#fullname').removeClass('invalid');
    }

    if($('#fullname').val() != ''){
        if(!isNaN($('#fullname').val())){
            status = false;
            $('#fullname').addClass('invalid');
        }
        else{
        	$('#fullname').removeClass('invalid');
        }
    }     

	if($('#email').val() != ''){
        if(!isValidEmailAddress($('#email').val())){
            status = false;
            $('#email').addClass('invalid');            
        }
        else{
        	$('#email').removeClass('invalid');
        }
    }
    else{
    	$('#email').removeClass('invalid');
    }

    if($('#phone').val() != ''){
        if(!isValidPhoneNumber($('#phone').val())){
            status = false;
            $('#phone').addClass('invalid');
        }
        else{
        	$('#phone').removeClass('invalid');
        }
    }
    else{
    	$('#phone').removeClass('invalid');
    }

    if($('#identity_card_number').val() != ''){
        if(isNaN($('#identity_card_number').val())){
            status = false;
            $('#identity_card_number').addClass('invalid');
        }
        else{
        	$('#identity_card_number').removeClass('invalid');
        }
    } 
    else{
    	$('#identity_card_number').removeClass('invalid');
    }    
    return status;
}
function err_insurrance(){
	var status = true;

    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    var date = d.getFullYear() + '-' +
        (month<10 ? '0' : '') + month + '-' +
        (day<10 ? '0' : '') + day;

	if($('#code_insurrance').val() == ''){        
        status = false;
        $('#code_insurrance').addClass('invalid'); 
    }
    else{
    	$('#code_insurrance').removeClass('invalid');
    }  

	if($('#type_insurrance').val() == ''){        
        status = false;
        $('#type_insurrance').addClass('invalid'); 
    }
    else{
        $('#type_insurrance').removeClass('invalid');
    } 	

    if($('#startdate').val() == ''){        
        status = false;
        $('#startdate').addClass('invalid'); 
    }
    else{
    	$('#startdate').removeClass('invalid');
    }

    if($('#enddate').val() == ''){        
        status = false;
        $('#enddate').addClass('invalid'); 
    }
    else{
    	$('#enddate').removeClass('invalid');
    }    

    if($('#startdate').val() != '' && $('#enddate').val() != ''){
        if($('#enddate').val() < $('#startdate').val()){
            status = false;
            $('#startdate').addClass('invalid'); 
            $('#enddate').addClass('invalid');
        }
        else{
        	$('#enddate').removeClass('invalid');
        	$('#startdate').removeClass('invalid'); 
        }
    }

    if($('#startdate').val() != ''){
        if($('#startdate').val() < date){
            status = false;
            $('#startdate').addClass('invalid');
        }
        else{
            $('#startdate').removeClass('invalid');
        }
    }    

	return status;	
}
function updateCustomerImage(id){
    var formData = new FormData($("#imageUploader")[0]);   
    formData.append('id',id);    
    if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({        	
            type:"POST",
            url: baseUrl+'/itemsCustomers/Accounts/updateCustomerImage',	
            data:formData,
            datatype:'json',
            success:function(data){            	
            	$("#imageUploader").html(data);
            	searchListStaffs(id);            	
              	$("#voice-box").removeClass("noDisplay").delay(1000).queue(function(){
				    $(this).addClass("noDisplay").dequeue();
				});	
            },
            error: function(data) {
                alert("Error occured. Please try again!");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
    return false;
}
function updateCustomer(id){	
	if(err()){
		fullname=$('#fullname').val();
		email=$('#email').val();
		phone=$('#phone').val();
		gender=$('#gender').val();
		birthdate=$('#birthdate').val();
		identity_card_number=$('#identity_card_number').val();
		id_country=$('#id_country').val();
		id_job=$('#id_job').val();
		position=$('#position').val();
		organization=$('#organization').val();
		address=$('#address').val();
		$.ajax({
		    type:'POST',
		    url: baseUrl+'/itemsCustomers/Accounts/updateCustomer',	
		    data: {"id":id,"fullname":fullname,"email":email,"phone":phone,"gender":gender,"birthdate":birthdate,"identity_card_number":identity_card_number,"id_country":id_country,"id_job":id_job,"position":position,"organization":organization,"address":address},   
		    success:function(data){	
		    	searchListStaffs(id);		    	
		    	$("#voice-box").removeClass("noDisplay").delay(1000).queue(function(){
				    $(this).addClass("noDisplay").dequeue();
				});    
		    },
		    error: function(data){
		    console.log("error");
		    console.log(data);
		    }
	    });
	}	
}

function insertUpdateCustomerInsurrance(id,id_customer){	
    if(id){
        id = 0;
    }
	if(err_insurrance()){		
		code_insurrance=$('#code_insurrance').val();
		type_insurrance=$('#type_insurrance').val();
		startdate=$('#startdate').val();
		enddate=$('#enddate').val();	
		$.ajax({
		    type:'POST',
		    url: baseUrl+'/itemsCustomers/Accounts/insertUpdateCustomerInsurrance',	
		    data: {"id":id,"id_customer":id_customer,"code_insurrance":code_insurrance,"type_insurrance":type_insurrance,"startdate":startdate,"enddate":enddate},   
		    success:function(data){		    	
		    	searchListStaffs(id_customer);		    	
		    	$("#voice-box").removeClass("noDisplay").delay(1000).queue(function(){
				    $(this).addClass("noDisplay").dequeue();
				});    
		    },
		    error: function(data){
		    console.log("error");
		    console.log(data);
		    }
	    });	
	}    	
}

$('#newCustomer').click(function(){ 
	$('#addnewCustomerPopup').fadeToggle('fast');
});
$('#cancelNewCustomer').click(function(){ 
	$('#addnewCustomerPopup').hide(); 
});
$('#frm-add-denntist').submit(function(e) {
    e.preventDefault();  

    var formData = new FormData($("#frm-add-denntist")[0]);    
    if (!formData.checkValidity || formData.checkValidity()) {
    // alert("asdasadad");
    // return false;  
        jQuery.ajax({        	
            type:"POST",
            url: baseUrl+'/itemsUsers/Staff/add',	
            data:formData,
            datatype:'json',
            success:function(data){
                // alert(data);
                // return false;
                if(data == '0'){
                    $.jAlert({
                        'title': "Thông báo !",
                        'content': "Xác nhận mật khẩu không chính xác"
                    });
                }else if(data == '-1' ){
                    $.jAlert({
                        'title': "Thông báo !",
                        'content': "Thất bại"
                    });
                }else{

                    $.jAlert({
                        'title': "Thông báo !",
                        'content': "Thành công"
                    });
                    $('#addnewDentistPopup').hide();
                    e.stopPropagation();

                    $('#searchNameCustomer').val(data);
                    searchListStaffs();

                }
                
            },
            error: function(data) {
                alert("Error occured. Please try again!");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
    return false;
});

$('#sortLabel').click(function(){
    var position = $( this ).position(); 
    $('#searchCustomerPopup').css({"top": position.top+105, "left": position.left-175}).fadeToggle('fast'); 
	// $('#sortOptionList').fadeToggle('fast');
});

$(document).mouseup(function (e)
{
    var container = $("#addnewCustomerPopup");
    if (!container.is(e.target) 
        && container.has(e.target).length === 0) 
    {      	
        container.hide();        
    }     
});
$(document).mouseup(function (e)
{
    var container = $("#sortOptionList");
    if (!container.is(e.target) 
        && container.has(e.target).length === 0) 
    {       
        container.hide();        
    }     
});
$('.SortBy').click(function(){
	$("#searchSortCustomer").val($(this).find('input').val());
	searchListStaffs();
});


var timeout;
$('#searchNameCustomer').on('onchange',function(){
  //if you already have a timout, clear it
  if(timeout){ clearTimeout(timeout);}

  //start new time, to perform ajax stuff in 500ms
  timeout = setTimeout(function() {
    searchListStaffs();
   //your ajax stuff
  },500);
})

$( document ).ready(function() {
    var group_id = <?php  echo Yii::app()->user->getState('group_id'); ?>;
    var id_user = <?php echo Yii::app()->user->getState('user_id'); ?>;
    if (group_id == 3) {
        searchListStaffs(id_user);
    }
    else {
        searchListStaffs();
    } 
    
});


</script>
<script type="text/javascript">
    function add_new_time(i,id,j)
    {
        // $('#row_new'+id).add(this).css({'display':'block'});
        var id_dentist = id;
        var dow = i;
        var time_start = "13:00:00";
        // alert(time_start);
        var time_end = "20:00:00";
        var branch = "1";
        jQuery.ajax({
            type: "POST",
            url: "<?php echo CController::createUrl('Staff/AddNewTime')?>",
            data:{
                'id_dentist' : id_dentist,
                'dow' : dow,
                'time_start' : time_start,
                'time_end' : time_end,
                'branch' : branch,
            },
            success:function(data)
            {
                $('#list_work_'+i).append(data);
            },
            error: function (data) {
                alert("Error occured.Please try again!");
            },
        });
        $('#btn_add_job'+i).css({'background':'#ccc'});
        $('#btn_add_job'+i).removeAttr("onclick");
    }
    function change_status(i,id_dentist,dow)
    {
        var $status= $('#slider_holder_'+i+' input').val();
        // alert($status);
        jQuery.ajax({
            type: "POST",
            url: "<?php echo CController::createUrl('Staff/ChangeStatus')?>",
            data:{
                'id_dentist' : id_dentist,
                'dow' : dow,
                'status' : $status,
            },
            success:function(data)
            {
                $.jAlert({
                    'title': "Thông báo !",
                    'content': "Thành công"
                });
                // alert("success !");
            },
            error: function (data) {
                alert("Error occured.Please try again!");
            },
        });
    }
    function remove_time(id1,id2,id_dentist,j){
        $.alertOnClick('#btn_remove_job'+id2, {
                'title':'Xóa thời gian !',
                'content':'Bạn chắc chắn muốn xóa thời gian này không ?',
                'btns': [
                    {'text':'Hủy', 'closeAlert':true},
                    {'text':'Đồng ý', 'closeAlert':true, 'onClick': function(){
                        var id_row = id2;
                        jQuery.ajax({
                            type: "POST",
                            url: "<?php echo CController::createUrl('Staff/DeleteTime')?>",
                            data:{
                                'id' : id_row,
                            },
                            success:function(data)
                            {
                                $.jAlert({
                                'title': "Thông báo !",
                                'content': "Thành công"
                                });
                                $('#btn_add_job'+id1).removeAttr("style");
                                $('#btn_add_job'+id1).attr('onclick','add_new_time('+id1+','+id_dentist+','+j+')');
                            },
                            error: function (data) {
                                alert("Error occured.Please try again!");
                            },
                        });
                        $('li#row_'+id1+'_'+id2).remove();}}
                ]
        });
        // return false;
        // var checkstr =  confirm('are you sure you want to delete this?');
        // if(checkstr == true)
        // {
            
        // }else{
        //     return false;
        // }
        
    }
    function change_chair(id_dentist,i,id)
    {
        var $value =$('#chair_'+id).val();
        // alert($value);
        var $time_start = $('#time_start_'+id).val();
        var $time_end = $('#time_end_'+id).val();
        var $dow = i;
        var $branch = $('#address_'+id).val();
        var $dentist = $('input#'+id_dentist).val();
        // alert($time_end);
        jQuery.ajax({
            type: "POST",
            url: "<?php echo CController::createUrl('Staff/GetListChair')?>",
            data:{
                'chair' : $value,
                'id' : id,
                'start' : $time_start,
                'end' : $time_end,
                'dow' : i,
                'dentist' : $dentist,
                'branch' : $branch,
            },
            success:function(data)
            {
                // alert(data);
               if(data==1)
               {
                    $.jAlert({
                    'title': "Thông báo !",
                    'content': "Ghế này đã được đặt lịch ! Vui lòng kiểm tra và chọn lại"
                    });
                    // alert("Ghế này đã được đặt lịch ! Vui lòng kiểm tra và chọn lại");
               }
               else if(data==-1)
               {
                    $.jAlert({
                    'title': "Thông báo !",
                    'content': "Bác sĩ không thể đặt 2 ghế trong 1 giờ làm việc! Vui lòng kiểm tra và chọn lại"
                    });
                    //alert("Bác sĩ không thể đặt 2 ghế trong 1 giờ làm việc! Vui lòng kiểm tra và chọn lại");
               }
               else if (data == 0)
               {
                    $.jAlert({
                    'title': "Thông báo !",
                    'content': "Hoàn tất! Khách hàng có thể đặt lịch"
                    });
                    //alert("Hoàn tất! Khách hàng có thể đặt lịch");
               }
                // $('#stacked-list').html(data);
            },
            error: function (data) {
                alert("Error occured.Please try again!");
            },
        });

    }
    function change_branch(id)
    {
        var value =$('#address_'+id).val();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo CController::createUrl('Staff/UpdateBranch')?>",
            data:{
                'value' : value,
                'id' : id,
            },
            success:function(data)
            {

                $('#chair_'+id).html(data);
                $.jAlert({
                'title': "Thông báo !",
                'content': "Thành công"
                });
            },
            error: function (data) {
                alert("Error occured.Please try again!");
            },
        });
    }
    function change_time_start(j,dow,id,id_dentist)
    {
        var $id_j = j-1;
        var $value =$('#time_start_'+id).val();
        var $time_end = $('#time_end_'+id).val();
        var $dow = dow;
        // var $chair = $('#chair_'+id).val();
        var $branch = $('#address_'+id).val();
        var $dentist = $('input#'+id_dentist).val();

        var $time_end_before = $('select[name="time_end_'+$id_j+'"] option:selected').val();
        var $kq1 = $value > $time_end_before;
        // alert($time_end_before);
        // return false;
        if($kq1 || $time_end_before === undefined)
        {
            var $kq = $value < $time_end;
            if($kq){
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo CController::createUrl('Staff/ChangeTimeStart')?>",
                    data:{
                        'time_start' : $value,
                        'time_end' : $time_end,
                        'dow' : $dow,
                        // 'chair' : $chair,
                        'branch' : $branch,
                        'dentist' : $dentist,
                        'id_start' : id,
                    },
                    success:function(data)
                    {
                        $.jAlert({
                        'title': "Thông báo !",
                        'content': data
                        });
                        //alert(data);
                        // $('#chair_'+id).html(data);
                    },
                    error: function (data) {
                        alert("Error occured.Please try again!");
                    },
                });
            }
            else{
                $.jAlert({
                'title': "Thông báo !",
                'content': "Thời gian bắt đầu luôn phải nhỏ hơn thời gian kết thúc"
                });
                //alert("Thời gian bắt đầu luôn phải nhỏ hơn thời gian kết thúc");
                $('#time_start_'+id+' option[value=""]').prop("selected", true);
            }
        }
        else {
            $.jAlert({
            'title': "Thông báo !",
            'content': "Thời gian bắt đầu ca "+j+" phải lớn hơn thời gian bắt đầu ca "+$id_j
            });
            //alert("Thời gian bắt đầu ca "+j+" phải lớn hơn thời gian bắt đầu ca "+$id_j);
            $('#time_start_'+id+' option[value=""]').prop("selected", true);
        }
        
        
    }
    function change_time_end(j,dow,id,id_dentist)
    {
        var $j_next = j+1;
        var $start_next = $('select[name="time_start_'+$j_next+'"] option:selected').val();

        var $count_sum_record = $('#count_list_time_'+dow).val();
        var $time_end_last = $('select[name="time_end_'+$count_sum_record+'"] option:selected').val();
        
        var $value =$('#time_end_'+id).val();
        var $time_start = $('#time_start_'+id).val();
        // var $chair = $('#chair_'+id).val();
        var $dow = dow;
        var $branch = $('#address_'+id).val();
        var $dentist = $('input#'+id_dentist).val();

        var $value_defaulf= "20:00:00";
        var $search_end_start = $value > $start_next;//so sanh end ca trước với start ca sau
        // alert($search_end_start);
        // return false;
        var $kq = $value > $value_defaulf;
        var $so_sanh = $value <= $time_start; //so sanh thời gian start  vs end ca trong 1 ca làm việc
        if( !$so_sanh )
        {
            if( !$search_end_start)
            {
                // alert("yes");
                if($time_end_last !== "20:00:00")
                {

                    $('#btn_add_job'+dow).removeAttr("style");
                    $('#btn_add_job'+dow).attr('onclick','add_new_time('+dow+','+id_dentist+','+j+')');
                    
                }
                else if ($time_end_last == "20:00:00"){
                    alert($time_end_last);
                        
                    $('#btn_add_job'+dow).css({'background':'#ccc'});
                    $('#btn_add_job'+dow).removeAttr("onclick");
                }
                
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo CController::createUrl('Staff/ChangeTimeEnd')?>",
                    data:{
                        'time_start_end' : $time_start,
                        'time_end_end' : $value,
                        'id_end' : id,
                        // 'chair' : $chair,
                        'dow' : $dow,
                        'branch' : $branch,
                        'dentist' : $dentist,
                    },
                    success:function(data)
                    {
                        $.jAlert({
                        'title': "Thông báo !",
                        'content': data
                        });
                        //alert(data);
                        // $('#chair_'+id).html(data);
                    },
                    error: function (data) {
                        alert("Error occured.Please try again!");
                    },
                });
            }
            else{
                // $('#btn_add_job'+dow).css({'background':'#ccc'});
                // $('#btn_add_job'+dow).removeAttr("onclick");
                $.jAlert({
                'title': "Thông báo !",
                'content': "Thời gian không hợp lệ! Vui lòng kiểm tra lại"
                });
                //alert("Thời gian không hợp lệ! Vui lòng kiểm tra lại");
            }
        }
        else {
            $.jAlert({
                'title': "Thông báo !",
                'content': "Thời gian không hợp lệ! Vui lòng kiểm tra lại"
                });
            //alert("Thời gian không hợp lệ! Vui lòng kiểm tra lại");
        }
        
    }
    function add_break(i,id_dentist,status)
    {
        // alert(id_dentist);
        // return false;
        var $id_dentist = id_dentist;
        var $dow = i;
        var status = $('#btn_add_break_'+i+' input').val();
        // alert(status);
        // return false;
        jQuery.ajax({
            type: "POST",
            url: "<?php echo CController::createUrl('Staff/AddNewBreak')?>",
            data:{
                'id_dentist' : $id_dentist,
                'dow' : $dow,
                'status' :status,
            },
            success:function(data)
            {
                // alert(data);
                // return false;
                if(data ==1)
                {
                    $.jAlert({
                    'title': "Thông báo !",
                    'content': "Không thể thêm"
                    });
                    //alert("Không thể thêm");
                }else{
                     $('#time_relax_'+i).append(data);
                     $.jAlert({
                    'title': "Thông báo !",
                    'content': "Thành công"
                    });
                     //alert("Success !");
                }
                // $('#chair_'+id).html(data);
            },
            error: function (data) {
                alert("Error occured.Please try again!");
            },
        });
    }
    function remove_relax(id)
    {
        var checkstr =  confirm('are you sure you want to delete this?');
        if(checkstr == true)
        {
            jQuery.ajax({
                type: "POST",
                url: "<?php echo CController::createUrl('Staff/RemoveTimeRelax')?>",
                data:{
                    'id' : id,
                },
                success:function(data)
                {
                    if(data)
                    {
                        $.jAlert({
                        'title': "Thông báo !",
                        'content': data
                        });
                        //alert(data);
                    }
                    else{
                         $.jAlert({
                        'title': "Thông báo !",
                        'content': "Không xóa được"
                        });
                        //alert("Không xóa được");
                    }
                },
                error: function (data) {
                    alert("Error occured.Please try again!");
                },
            });
            $('#row_relax_'+id).remove();
        }else{
        return false;
        }
        
    }
    $(document).ready(function() {

    });
</script>