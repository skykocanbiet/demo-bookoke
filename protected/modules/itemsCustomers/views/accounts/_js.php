<script>

function isValidEmailAddress(emailAddress){var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;return pattern.test(emailAddress);};
function isValidPhoneNumber(phoneNumber){var pattern = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;return pattern.test(phoneNumber);}

var baseUrl = $('#baseUrl').val();

// Biến dùng kiểm tra nếu đang gửi ajax thì ko thực hiện gửi thêm
var is_ajax = false;
// Biến dùng kiểm tra nếu đang gửi ajax thì ko thực hiện gửi thêm
var is_busy = false;  
// Biến lưu trữ trang hiện tại
var page = 1;
// Biến lưu trữ rạng thái phân trang 
var stopped = false;

function searchCustomers(id=''){

    // Nếu đang gửi ajax thì ngưng
    if (is_ajax == true){        
        return false;
    } 
    // Thiết lập đang gửi ajax
    is_ajax = true;       
    
	var value                       = $('#searchNameCustomer').val();	
    var email                       = $('#iptSearchEmail').val(); 
    var phone                       = $('#iptSearchPhone').val(); 
    var birthdate                   = $('#iptSearchBirthdate').val(); 
    var identity_card_number        = $('#iptSearchIdentityCardNumber').val(); 
	var type                        = $("#searchSortCustomer").val();
   
    //$('.cal-loading').fadeOut('slow');
    //$('.cal-loading').fadeIn('fast');
    
    $.ajax({
	    type:'POST',
	    url: baseUrl+'/itemsCustomers/Accounts/searchCustomers',	
	    data: {"value":value,"email":email,"phone":phone,"birthdate":birthdate,"identity_card_number":identity_card_number,"type":type},   
	    success:function(data){
            page = 1;
            stopped = false;
	    	$('#customerList').html(data);
	        detailCustomer(id);

            is_ajax = false;  
            
	    },
	    error: function(data){
	    console.log("error");
	    console.log(data);
	    }
    });
    //$('.cal-loading').fadeOut('slow'); 
}
function detailCustomer(id){ 

    var dental_status_change = $('#dental_status_change').val();
  
     $('.cal-loading').fadeIn('fast');
    if (dental_status_change == 1) {

            if (confirm("Bạn có muốn lưu tình trạng răng của khách hàng này không?")) { 

                $('#save').click();

            }else{

               

                if(id == null || id == '') 
                {
                    var id = $("#customerList li:first-child").find('input').val();
                }
                
                $('.n').removeClass("active"); 
                $("#c"+id).addClass("active");
                $("#c"+id).find('code').removeClass("hide");

                $.ajax({
                    type:'POST',
                    url: baseUrl+'/itemsCustomers/Accounts/detailCustomer', 
                    data: {"id":id},   
                    success:function(data){     

                        $('#detailCustomer').html(data);
                        $('.cal-loading').fadeOut('fast');  
                       
                    },
                    error: function(data){
                    console.log("error");
                    console.log(data);
                    }
                });

            }     	

    }else{

        //$('.cal-loading').fadeIn('fast');

        if(id == null || id == '') 
        {
            var id = $("#customerList li:first-child").find('input').val();
        }
        
        $('.n').removeClass("active"); 
        $("#c"+id).addClass("active");
        $("#c"+id).find('code').removeClass("hide");

        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsCustomers/Accounts/detailCustomer', 
            data: {"id":id},   
            success:function(data){     

                $('#detailCustomer').html(data);
                $('.cal-loading').fadeOut('fast');  
               
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });    

    }    
}

//** jQuery Ajax scrolling pagination **//

$(document).ready(function()
{    
    // Khi kéo scroll thì xử lý

    $('#customerList').on('scroll', function()     
    {       
        // Nếu màn hình đang ở dưới cuối thẻ thì thực hiện ajax
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) 
        {
            // Nếu đang gửi ajax thì ngưng
            if (is_busy == true){
                return false;
            } 
            // Nếu hết dữ liệu thì ngưng
            if (stopped == true){
                return false;
            }
            // Thiết lập đang gửi ajax
            is_busy = true;             
            // Tăng số trang lên 1
            page++;  
            // Hiển thị loadding
            $('#loadding').removeClass('hidden');
            // Gửi Ajax  
            var value                       = $('#searchNameCustomer').val(); 
            var email                       = $('#iptSearchEmail').val(); 
            var phone                       = $('#iptSearchPhone').val(); 
            var birthdate                   = $('#iptSearchBirthdate').val(); 
            var identity_card_number        = $('#iptSearchIdentityCardNumber').val(); 
            var type                        = $("#searchSortCustomer").val();
            $.ajax(
            {
                type        : 'POST',              
                url         : baseUrl+'/itemsCustomers/Accounts/searchCustomers', 
                data        : {"value":value,"email":email,"phone":phone,"birthdate":birthdate,"identity_card_number":identity_card_number,"type":type,"cur_page": page},
                success     : function (result)
                {    
                                         
                    $('#customerList').append(result);                    
                }
            })
            .always(function()
            {
                // Sau khi thực hiện xong ajax thì ẩn hidden và cho trạng thái gửi ajax = false  
                $('#loadding').addClass('hidden');             
                is_busy = false;
            });
            return false;
        }
    });
});

//** end jQuery Ajax scrolling pagination **//

function runScript_search(e){
    
	if (e.keyCode == 13) {
        e.preventDefault();
       searchCustomers();
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

/*
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
}*/

function updateCustomerImage(id){

    $("#webcamModal").removeClass("in");
    $(".modal-backdrop").remove();
    $('#webcamModal').modal('hide'); 
       
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
                searchCustomers(id);        
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
function updateCustomerImageDefault(id){

    $("#webcamModal").removeClass("in");
    $(".modal-backdrop").remove();
    $('#webcamModal').modal('hide');  

    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsCustomers/Accounts/updateCustomerImageDefault',  
        data: {"id":id},   
        success:function(data){          
            $("#imageUploader").html(data);                
            searchCustomers(id);             
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });

}
function updateCustomer(id){	
	if(err()){
        membership_card=$('#membership_card').val();
		fullname=$('#fullname').val();		
		email=$('#email').val();
		phone=$('#phone').val();
        phone_sms=$('#phone_sms').val();
		gender=$('#gender').val();
		birthdate=$('#birthdate').val();
		identity_card_number=$('#identity_card_number').val();
		id_country=$('#id_country').val();
        id_source=$('#id_source').val();
		id_job=$('#id_job').val();
		position=$('#position').val();	
		address=$('#address').val();
        id_company=$('#id_company').val(); 
		$.ajax({
		    type:'POST',
		    url: baseUrl+'/itemsCustomers/Accounts/updateCustomer',	
		    data: {"id":id,"membership_card":membership_card,"fullname":fullname,"email":email,"phone":phone,"phone_sms":phone_sms,"gender":gender,"birthdate":birthdate,"identity_card_number":identity_card_number,"id_country":id_country,"id_source":id_source,"id_job":id_job,"position":position,"address":address,"id_company":id_company},   
		    success:function(data){	         
		    	if(data) {
                    $('#alert-success').append(data);
                    var element = $('.alert-success');
                    for (var i = element.length; i >= 0; i--) {
                        $(element[i]).fadeTo(2000, 500).slideUp(500, function(){
                            $(this).remove();
                        });
                    }
                }   
		    },
		    error: function(data){
		    console.log("error");
		    console.log(data);
		    }
	    });
	}	
}
function updateFlag(id)
{
    if(err()){
        flag=$('#hidden_flag').val();
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsCustomers/Accounts/updateFlag', 
            data: {"id":id,'flag':flag},   
            success:function(data){          
                searchCustomers(id);                
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
function randomString(length, chars) {
    var result = '';
    for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
    return result;
}
function sendEmail(id){
    var fullname=$('#fullname').val();
    var email=$('#email').val();
    var username=$('#username').val();
    var pass = randomString(6, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    if (email && !username) {
        $.jAlert({
            'title': "Thông báo !",
            'content': "Bạn muốn gửi mail xác nhận tới địa chỉ này không ? ",
            'btns': [
                {'text':'Hủy', 'closeAlert':true},
                {'text':'Đồng ý', 'closeAlert':true, 'onClick': function(){
                    $.ajax({
                        type:'POST',
                        url: baseUrl+'/itemsCustomers/Accounts/SendMailCreateUser',
                        data:{'email':email,'fullname':fullname,'pass':pass,'id':id}, 
                        success:function(data)
                        {
                            $.jAlert({
                            'title': "Thông báo !",
                            'content': data
                            });
                            // alert(data);
                            $('#username').val(email);
                            $('#password').val(pass);
                        },
                        error: function(data){
                        console.log("error");
                        console.log(data);
                        }
                    });
                }}
            ]
        });
        // var resufl_confirm = confirm("Bạn muốn gửi mail xác nhận tới địa chỉ này không ? ");
        // if (resufl_confirm) {
        //     $.ajax({
        //         type:'POST',
        //         url: baseUrl+'/itemsCustomers/Accounts/SendMailCreateUser',
        //         data:{'email':email,'fullname':fullname,'pass':pass,'id':id}, 
        //         success:function(data)
        //         {
        //             $.jAlert({
        //             'title': "Thông báo !",
        //             'content': data
        //             });
        //             // alert(data);
        //             $('#username').val(email);
        //             $('#password').val(pass);
        //         },
        //         error: function(data){
        //         console.log("error");
        //         console.log(data);
        //         }
        //     });
        // } 
    }
    
}
function updateMember(id){
    if(err()){
        code_member= $('#membership_card').val();
        status_member = $('#hidden_flag_member').val();
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsCustomers/Accounts/updateMember', 
            data: {"id":id,"code_member":code_member,"status_member":status_member},   
            success:function(data){          
                searchCustomers(id);                
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
function updateCustomerSegment(id){ 
        
    var id_segment=$('#id_segment').val();
  
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsCustomers/Accounts/updateCustomerSegment', 
        data: {"id":id,"id_segment":id_segment},   
        success:function(data){ 
            searchCustomers(id);  
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });
   
}

function updateStatusSchedule(id,id_customer){  

    var id_quotation    = $("#id_quotation").val();
    var status_schedule = $("#status_schedule"+id).val();

    $.ajax({
        type    :'POST',
        url     : baseUrl+'/itemsCustomers/Accounts/updateStatusSchedule', 
        data    : {"id":id,"id_quotation":id_quotation,"id_customer":id_customer,"status_schedule":status_schedule},
        dataType:'json',
        success:function(data){   
              
            loadSchCus(1, $('#id_customer').val());
            getNoti(data.data, 'update', <?php echo Yii::app()->user->getState('user_id'); ?>);
        },
        error: function(data){
            console.log("error");
        }
    }); 
}
function insertUpdateCustomerInsurrance(id,id_customer){	

    if(id){
        id = 0;

    }

    code_insurrance   = $('#code_insurrance').val();
    type_insurrance   = $('#type_insurrance').val();
    startdate         = $('#startdate').val();
    enddate           = $('#enddate').val();    

    alert(id);

	if(startdate && enddate){	

		$.ajax({
		    type:'POST',
		    url: baseUrl+'/itemsCustomers/Accounts/insertUpdateCustomerInsurrance',	
		    data: {"id":id,"id_customer":id_customer,"code_insurrance":code_insurrance,"type_insurrance":type_insurrance,"startdate":startdate,"enddate":enddate},   
		    success:function(data){		    
                console.log(data);	
		    	searchCustomers(id_customer);		    	
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

$(document).ready(function(){	
  // $('.fancybox').fancybox(); 
});
$('#newCustomer').click(function(){ 
	$('#addnewCustomerPopup').fadeToggle('fast');
});
$('#cancelNewCustomer').click(function(){ 
    $('#parsley').html('');
	$('#addnewCustomerPopup').hide(); 
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
$('#frm-add-customer').submit(function(e) {
    e.preventDefault();    
    var formData = new FormData($("#frm-add-customer")[0]);    
    if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({        	
            type:"POST",
            url: baseUrl+'/itemsCustomers/Accounts/add',	
            data:formData,
            datatype:'json',
            success:function(data){                              
                if(data == -1){                
                    $('#parsley').html('Bạn chưa nhập họ và tên.');   
                }else if(data == -2){                
                    $('#parsley').html('Bạn chưa nhập số điện thoại.');   
                }else if(data >= 1){ 
                    $('#frm-add-customer')[0].reset();    
                    $('#addnewCustomerPopup').hide(); 
                    $('#searchNameCustomer').val(data);
                    searchCustomers(); 
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
});

$(document).mouseup(function (e)
{
    var container = $("#searchCustomerPopup");
    if (!container.is(e.target) 
        && container.has(e.target).length === 0 && $(e.target).closest($('#ui-datepicker-div')).length === 0) 
    {       
        container.hide();        
    }     
});

$('.SortBy').click(function(){
	$("#searchSortCustomer").val($(this).find('input').val());
});

var timeout;
$('#searchNameCustomer').on('onchange',function(){
  //if you already have a timout, clear it
  if(timeout){ clearTimeout(timeout);}

  //start new time, to perform ajax stuff in 500ms
  timeout = setTimeout(function() {
    searchCustomers();
   //your ajax stuff
  },500);
})

/*** edit_cam ***/

function showUpdateCustomer(id){    
    var evt = window.event || arguments.callee.caller.arguments[0];
    evt.preventDefault();
    var position = $('#ltn'+id).position();    
    $('#updateCustomerPopup'+id).css({"top": position.top-50, "left": position.left+50});
    $('#updateCustomerPopup'+id).fadeToggle('fast');
    evt.stopPropagation();
}

$(document).mouseup(function (e)
{
    var container = $(".popover.bottom.customer");
    if (!container.is(e.target) 
        && container.has(e.target).length === 0) 
    {        
        container.hide();
    } 
});

function deleteCustomer(id){
    if (confirm("Bạn có thật sự muốn xóa?")) {  
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsCustomers/Accounts/deleteCustomer',    
            data: {"id":id},   
            success:function(data){
                if (data == 1) {
                   searchCustomers();  
                }                               
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });
    }      
}

function updateCustomerName(id){ 
    if($('#customerName'+id).val()!=""){
        var formData = new FormData($('#frm-update-customer-'+id)[0]);  
        formData.append('id_customer',id);     
        if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({
                type:'POST',
                url: baseUrl+'/itemsCustomers/Accounts/updateCustomerName',   
                data:formData,
                datatype:'json',
                success:function(data){             
                    if(data == 1){ 
                        searchCustomers(id);                          
                    }
                },
                error: function(data){
                    console.log("error");
                    console.log(data);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    }
}

/*** end edit_cam ***/

</script>