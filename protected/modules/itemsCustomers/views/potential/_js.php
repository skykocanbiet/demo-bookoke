<script>

function isValidEmailAddress(emailAddress){var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;return pattern.test(emailAddress);};
function isValidPhoneNumber(phoneNumber){var pattern = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;return pattern.test(phoneNumber);}

var baseUrl = $('#baseUrl').val();

// Biến dùng kiểm tra nếu đang gửi ajax thì ko thực hiện gửi thêm
var is_busy = false;  
// Biến lưu trữ trang hiện tại
var page = 1;
// Biến lưu trữ rạng thái phân trang 
var stopped = false;

function searchCustomers(id){
    
	var value = $('#searchNameCustomer').val();	
	var type  = $("#searchSortCustomer").val();
   
    //$('.cal-loading').fadeOut('slow');
    //$('.cal-loading').fadeIn('fast');
    
    $.ajax({
	    type:'POST',
	    url: baseUrl+'/itemsCustomers/Potential/searchCustomers',	
	    data: {"value":value,"type":type},   
	    success:function(data){
            page = 1;
            stopped = false;
	    	$('#customerList').html(data);
	        detailCustomer(id);
            
	    },
	    error: function(data){
	    console.log("error");
	    console.log(data);
	    }
    });
    //$('.cal-loading').fadeOut('slow'); 
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
	    url: baseUrl+'/itemsCustomers/Potential/detailCustomer',	
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
            var value = $('#searchNameCustomer').val(); 
            var type  = $("#searchSortCustomer").val();
            $.ajax(
            {
                type        : 'POST',              
                url         : baseUrl+'/itemsCustomers/Potential/searchCustomers', 
                data        : {"value":value,"type":type,"cur_page": page},
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

function updateCustomerImage(id){
    var formData = new FormData($("#imageUploader")[0]);   
    formData.append('id',id);    
    if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({        	
            type:"POST",
            url: baseUrl+'/itemsCustomers/Potential/updateCustomerImage',	
            data:formData,
            datatype:'json',
            success:function(data){            	
            	$("#imageUploader").html(data);
            	searchCustomers(id);            	
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
		/*id_job=$('#id_job').val();
		position=$('#position').val();*/
		organization=$('#organization').val();
		address=$('#address').val();
        id_source = $('#id_source').val();
        id_city = $('#id_city').val();
        id_state = $('#id_state').val();
        //id_segment = $('#id_segment').val();
		$.ajax({
		    type:'POST',
		    url: baseUrl+'/itemsCustomers/Potential/updateCustomer',	
		    data: {"id":id,"fullname":fullname,"email":email,"phone":phone,"gender":gender,"birthdate":birthdate,"identity_card_number":identity_card_number,"id_country":id_country,'id_city':id_city,'id_state':id_state,/*"id_job":id_job,"position":position,*/"organization":organization,"address":address,"id_source":id_source},   
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
$('#frm-add-customer').submit(function(e) {
    e.preventDefault();    
    var formData = new FormData($("#frm-add-customer")[0]);    
    if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({        	
            type:"POST",
            url: baseUrl+'/itemsCustomers/Potential/add',	
            data:formData,
            datatype:'json',
            success:function(data){
                if(data == '-1'){                
                $('#parsley').html('Số điện thoại đã tồn tại.');                
                e.stopPropagation();               
                }
                if(data > '0'){ 
                $('#frm-add-customer')[0].reset();    
                $('#addnewCustomerPopup').hide();               
                e.stopPropagation();
                searchCustomers();
                //detailCustomer(data);
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
	$('#sortOptionList').fadeToggle('fast');
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
	searchCustomers();
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
/*frm-add-schedule*/

// $('#btnsave_schedule').click(function(e){
//         alert('ccc');
//         return false;
//     })
function detaildoatdong(id){

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
        url: baseUrl+'/itemsCustomers/Potential/detailhoatdong',    
        data: {"id":id},   
        success:function(data){     

            $('#t_bd').html(data);
            $('.cal-loading').fadeOut('slow');    
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });
}
</script>
