

<script>

function isValidEmailAddress(emailAddress){var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;return pattern.test(emailAddress);};
function isValidPhoneNumber(phoneNumber){var pattern = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;return pattern.test(phoneNumber);}

var baseUrl = $('#baseUrl').val();

var is_busy = false;  
// Biến lưu trữ trang hiện tại
var page = 1;
// Biến lưu trữ rạng thái phân trang 
var stopped = false;
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
                url         : baseUrl+'/itemsPartner/Provider/SearchProvider', 
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
function EditURL(){
    $('.URL').css('display', 'none');
    $('#link').css('display',"inline");
}
function EditSub(){
    $('.Sub').css('display', 'none');
    
}
function updateSubdomain(id){
    if(err()){
        subdomain = $('#sub_domain').val();
        $.ajax({
            type:'POST',
            url:baseUrl+'/itemsPartner/Provider/updatesubmain',
            data:{'id':id, 'subdomain':subdomain},
            success:function(data){
                detailprovider(id);
                $("#voice-box").removeClass("noDisplay").delay(1000).queue(function(){
                $(this).addClass("noDisplay").dequeue();
            });
        }
        });
     }
   }
function searchCustomers(id=''){
    
    var value = $('#searchNameCustomer').val(); 
    var type  = $("#searchSortCustomer").val();
    //$('.cal-loading').fadeOut('slow');
    //$('.cal-loading').fadeIn('fast');
    
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsPartner/Provider/SearchProvider',   
        data: {"value":value,"type":type},  

        success:function(data){
                console.log(data);
            $('#customerList').html(data);
            detailprovider(id);
            
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });
    //$('.cal-loading').fadeOut('slow'); 
}
function detailprovider(id){
   
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
        url: baseUrl+'/itemsPartner/Provider/DetailProvider',   
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
function delete_provider(id){
 
   var evt = window.event || arguments.callee.caller.arguments[0];

     evt.preventDefault();
     $('#deleteProvider'+id).fadeToggle('fast');
     evt.stopPropagation();
    $("#yes_delete"+id).click(function(e){
        e.preventDefault();
         $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/deleteProvider',   
            data: {"id":id},   

            success:function(data){ 

                   if(data == "1")
                   {
                    $('#deleteProvider'+id).hide();
                    searchCustomers();
                   }       
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });
         e.stopPropagation();
    });

    $('.cancelNewStaff').click(function(e){ 
    e.preventDefault();
    $('#deleteProvider'+id).hide();
     e.stopPropagation();
});

}
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
            url: baseUrl+'/itemsPartner/Provider/UpdateproviderImage',  
            data:formData,
            datatype:'json',
            success:function(data){             
                $("#imageUploader").html(data);
                              
                $("#voice-box").removeClass("noDisplay").delay(1000).queue(function(){
                $(this).addClass("noDisplay").dequeue();
                 
                });
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
function updateProvider(id){

    if(err()){
        Name=$('#fullname').val();
        Email=$('#email').val();
        Phone=$('#phone').val();
        Home_Phone=$('#homephone').val();
        Address=$('#address').val();
        X = $('#X').val();
        Y = $('#Y').val();
        link = $('#link').val();
      

        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/updateProvider',   
            data: {"id":id,"Name":Name,"Email":Email,"Phone":Phone,"Home_Phone":Home_Phone,"Address":Address,"X":X, "Y":Y, "link":link},   

            success:function(data){ 
                 detailprovider(id);  
                $('#name'+id).html(data);            
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
function updateProviderCountry(id, id_country){

    var code = $('#Id_Country').val();
    Country_city(code, id);
    country_state(code, id);
    if(err()){
      
        Id_Country = $('#Id_Country').val();
        
         $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/updateProviderCountry',   
            data: {"id":id,"Id_Country":Id_Country},   

            success:function(data){ 
              
                savecity(id);
               
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


 function Country_city(code, id){
    
      var code =  $('#Id_Country').val();

//var id = document.getElementById("providerCountry").val();

        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/CityCoutry1',   
            data: {"code":code, "id":id},  
            success:function(data){   
                       
               
               // document.getElementById("city").innerHTML = this.responseText;
                $("#city1").html(data);
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
    });

}
function country_state(code, id){
      var code =  $('#Id_Country').val();

//var id = document.getElementById("providerCountry").val();

        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/StateCountry1',   
            data: {"code":code, "id":id},  
          
            success:function(data){   
           
             
               // document.getElementById("city").innerHTML = this.responseText;
                
                $("#state1").html(data);
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
    });
    }
    function savecity(id){
     Id_City = $('#providerCity1').val();

     $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/updateProviderSave',   
            data: {"id":id,"Id_City":Id_City},   

            success:function(data){ 
                
              savestate(id);
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
function savestate(id){
     Id_State = $('#providerState1').val();
     $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/updateProviderSaveState',   
            data: {"id":id,"Id_State":Id_State},   

            success:function(data){ 
                
             
                $("#voice-box").removeClass("noDisplay").delay(1000).queue(function(){
                    $(this).addClass("noDisplay").dequeue();
                });    
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });
}function updateProviderCountry(id, id_country){
    var code = $('#Id_Country').val();
    Country_city(code, id);
    country_state(code);
    if(err()){
      
        Id_Country = $('#Id_Country').val();
        
         $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/updateProviderCountry',   
            data: {"id":id,"Id_Country":Id_Country},   

            success:function(data){ 
              
                savecity(id);
                
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


  function Country_city(code, id){
    
      var code =  $('#Id_Country').val();

//var id = document.getElementById("providerCountry").val();

        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/CityCoutry1',   
            data: {"code":code, "id":id},  
            success:function(data){   
                       
               
               // document.getElementById("city").innerHTML = this.responseText;
                $("#city1").html(data);
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
    });

}function updateProviderCountry(id, id_country){

    var code = $('#Id_Country').val();
    Country_city(code, id);
    country_state(code, id);
    if(err()){
      
        Id_Country = $('#Id_Country').val();
        
         $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/updateProviderCountry',   
            data: {"id":id,"Id_Country":Id_Country},   

            success:function(data){ 
              
                savecity(id);
               
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


 function Country_city(code, id){
    
      var code =  $('#Id_Country').val();

//var id = document.getElementById("providerCountry").val();

        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/CityCoutry1',   
            data: {"code":code, "id":id},  
            success:function(data){   
                       
               
               // document.getElementById("city").innerHTML = this.responseText;
                $("#city1").html(data);
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
    });

}
function country_state(code, id){
      var code =  $('#Id_Country').val();

//var id = document.getElementById("providerCountry").val();

        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/StateCountry1',   
            data: {"code":code, "id":id},  
          
            success:function(data){   
           
             
               // document.getElementById("city").innerHTML = this.responseText;
                
                $("#state1").html(data);
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
    });
    }
    function savecity(id){
     Id_City = $('#providerCity1').val();

     $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/updateProviderSave',   
            data: {"id":id,"Id_City":Id_City},   

            success:function(data){ 
                
              savestate(id);
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
function savestate(id){
     Id_State = $('#providerState1').val();
     $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/updateProviderSaveState',   
            data: {"id":id,"Id_State":Id_State},   

            success:function(data){ 
                
             
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
 detailprovider();
});
/*$('#newCustomer').click(function(){ 
    $('#addnewCustomerPopup').fadeToggle('fast');
});*/


$('#frm-add-provider').submit(function(e) {
    e.preventDefault();    
    var formData = new FormData($("#frm-add-provider")[0]); 
      
    if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({           
            type:"POST",
            url: baseUrl+'/itemsPartner/Provider/addprovider',  
            data:formData,
            datatype:'json',
            success:function(data){
               
                if(data > '1'){ 
                $('#myModal').hide(); 
                searchCustomers(data);
                e.stopPropagation();
                
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
function updateStatus(id){
   
    if(err()){
        status = $('#stt0')
        
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/updateStatusOn',   
            data: {"id":id, "status":status},   

            success:function(data){ 
              
                               
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
function updateStatusOff(id){
   
    if(err()){
        status = $('#stt1')
        
        
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/updateStatusOff',   
            data: {"id":id, "status":status},   

            success:function(data){ 

                                
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

var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("newCustomer");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}
$('#cancelNewCustomer').click(function(){ 
    $('#myModal').hide(); 
});
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function updateStatusDistance(id){
   
    if(err()){
        
        
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/Distance',   
            data: {"id":id},   

            success:function(data){ 
              
                     detailprovider(id);          
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
function updateStatusFeatured(id){
   
    if(err()){
        
        
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/Featured',   
            data: {"id":id},   

            success:function(data){ 
              
                        detailprovider(id);       
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
function updateStatusMost(id){
   
    if(err()){
        
        
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/Most',   
            data: {"id":id},   

            success:function(data){ 
              
                    detailprovider(id);           
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
</script>