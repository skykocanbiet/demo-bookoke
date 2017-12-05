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

function searchBranchs(id=''){

    // Nếu đang gửi ajax thì ngưng
    if (is_ajax == true){        
        return false;
    } 
    // Thiết lập đang gửi ajax
    is_ajax = true;       
    
    var value = $('#searchNameCustomer').val(); 
    var type  = $("#searchSortCustomer").val();
    
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsSetting/SettingLocations/searchBranchs',    
        data: {"value":value,"type":type},   
        success:function(data){
            page = 1;
            stopped = false;
            $('#customerList').html(data);
            detailBranch(id);

            is_ajax = false;  
            
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });
    
}


function detailBranch(id){

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
        url: baseUrl+'/itemsSetting/SettingLocations/detailBranch', 	
	    data: {"id":id},   
	    success:function(data){   	
	    	$('#detailContent').html(data);  
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
       searchBranchs();
    }
}

$('#newCustomer').click(function(){ 
	$('#addnewCustomerPopup').fadeToggle('fast');
});
$('#cancelNewCustomer').click(function(){ 
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
            url: baseUrl+'/itemsSetting/SettingLocations/addNewBranch',    
            data:formData,
            datatype:'json',
            success:function(data){
          
                $('#frm-add-customer')[0].reset();    
                $('#addnewCustomerPopup').hide();               
                e.stopPropagation();      
               
                $('#searchNameCustomer').val(data);
                searchBranchs();             
                
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
	searchBranchs();
});


var timeout;
$('#searchNameCustomer').on('onchange',function(){
  //if you already have a timout, clear it
  if(timeout){ clearTimeout(timeout);}

  //start new time, to perform ajax stuff in 500ms
  timeout = setTimeout(function() {
    searchBranchs();
   //your ajax stuff
  },500);
})
</script>
