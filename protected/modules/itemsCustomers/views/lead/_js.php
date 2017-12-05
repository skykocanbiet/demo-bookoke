<script>

function isValidEmailAddress(emailAddress){var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;return pattern.test(emailAddress);};
function isValidPhoneNumber(phoneNumber){var pattern = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;return pattern.test(phoneNumber);}

var baseUrl = $('#baseUrl').val();

function searchLeadCustomers(id=''){
    
	var value = $('#searchNameCustomer').val();	
	var type  = $("#searchSortCustomer").val();
    //$('.cal-loading').fadeOut('slow');
    //$('.cal-loading').fadeIn('fast');
    
    $.ajax({
	    type:'POST',
	    url: baseUrl+'/itemsCustomers/Lead/SearchLeadCustomers',	
	    data: {"value":value,"type":type},   
	    success:function(data){

	    	$('#customerListHolder').html(data);
	        DetailLeadCustomers(id);
            
	    },
	    error: function(data){
	    console.log("error");
	    console.log(data);
	    }
    });
    //$('.cal-loading').fadeOut('slow'); 
}
function detailLeadCustomers(id){

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
	    url: baseUrl+'/itemsCustomers/Lead/DetailLeadCustomers',	
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
       searchLeadCustomers();
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
            	searchLeadCustomers(id);            	
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
		    	searchLeadCustomers(id);		    	
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
	$('#addnewCustomerPopup').hide(); 
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
                if(data == '1'){ 
                $('#addnewCustomerPopup').hide();               
                e.stopPropagation();
                searchLeadCustomers();
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
	searchLeadCustomers();
});


var timeout;
$('#searchNameCustomer').on('onchange',function(){
  //if you already have a timout, clear it
  if(timeout){ clearTimeout(timeout);}

  //start new time, to perform ajax stuff in 500ms
  timeout = setTimeout(function() {
    searchLeadCustomers();
   //your ajax stuff
  },500);
})


</script>