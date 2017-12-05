<?php $baseUrl = Yii::app()->baseUrl;?>

<?php 

if(yii::app()->user->getState('group_id') == 1 || yii::app()->user->getState('group_id') == 2 || yii::app()->user->getState('group_id') == 3 || yii::app()->user->getState('group_id') == 9) {  

    // THÔNG TIN ĐỢT ĐIỀU TRỊ
    include('mr_alert_medical.php');

    // BỆNH SỬ Y KHOA 
    include('mr_group_history.php'); 

    if(isset($id_mhg) &&  $id_mhg) {     

        // TÌNH TRẠNG RĂNG
        include('mr_teeth_status.php');

        $existQuotation = $model->existQuotation($model->id,$id_mhg);
        
        if($model->checkToothData($id_mhg) || $existQuotation) { 

            // QUÁ TRÌNH ĐIỀU TRỊ  
            include('mr_treatment_process.php');

        }else{
            
            // QUÁ TRÌNH ĐIỀU TRỊ  
            echo "<div style='display: none;'>";
                include('mr_treatment_process.php');
            echo "</div>";

        }  


    } 

}

?>

<script>
// HỒ SƠ BỆNH ÁN    
var templock = 0;   
var aClone   = $("#action-prescription").clone();   
var aLabClone   = $("#action-lab").clone();  
var divClone = $("#dntd").clone();

$('#showFamilyPopover').click(function(){ 
    $('#familyPopover').fadeToggle('fast');
});
$('#hideFamilyPopover').click(function(){    
    $('#familyPopover').hide(); 
});
$('#showSocietyPopover').click(function(){ 
    $('#societyPopover').fadeToggle('fast');
});
$('#hideSocietyPopover').click(function(){    
    $('#societyPopover').hide(); 
});
$("#id_family").select2();
$("#id_society").select2();

function detailTreatment(id){
    
    $('.cal-loading').fadeIn('fast');

    var id_customer = $('#id_customer').val();

    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsCustomers/Accounts/detailTreatment',    
        data: {"id":id,"id_customer":id_customer},   
        success:function(data){         

            $('#medical_record').html(data); 

            $('.cal-loading').fadeOut('slow');

        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });

}

$(".uT").click(function(e) {
   e.stopPropagation();
})

function updateTreatment(id){  

    var check_change_status_process =  $('#check_change_status_process').html();

    if(check_change_status_process != 0){

        $('.cal-loading').fadeIn('fast');
   
        var evt = window.event || arguments.callee.caller.arguments[0];   
        evt.stopPropagation();

        var id_customer = $('#id_customer').val();

        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsCustomers/Accounts/updateTreatment',    
            data: {"id":id,"id_customer":id_customer},   
            success:function(data){      

                $('#medical_record').html(data); 

                $('.cal-loading').fadeOut('slow');             
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });

    }else{

        var evt = window.event || arguments.callee.caller.arguments[0];   
        evt.stopPropagation();
        return false;
    } 
    
}

/*Note Medical History*/
$("input[name='chk[]']").change(function() {
    if(this.checked) {
        var id = $(this).val();
        $(this).parents(".col-md-4.col-md-offset-2.col-sm-4.col-sm-offset-2").append("<label data-toggle='modal' data-target='#noteModal"+id+"' class='note_medical_history'><i id='i-note"+id+"'>(Thêm ghi chú)</i><input type='hidden' name='ipt[]' id='ipt"+id+"'></label");
    }
    else{
        $(this).parents(".checkbox").next().remove();
    }
});
function noteMedicalHistory(id){

    var ipt_note =  $('#ipt-note'+id).val();  

    $('#ipt'+id).val(ipt_note);
    $('#i-note'+id).html(ipt_note);
    $('#noteModal'+id).modal('hide');

}
/* End Note Medical History*/
function getUniversal(number){    

    var universal_number;

    switch(number) {
        case 11:
            universal_number = 8; 
            break;          
        case 12:
            universal_number = 7; 
            break; 
        case 13:
            universal_number = 6; 
            break; 
        case 14:
            universal_number = 5; 
            break; 
        case 15:
            universal_number = 4; 
            break; 
        case 16:
            universal_number = 3; 
            break; 
        case 17:
            universal_number = 2; 
            break; 
        case 18:
            universal_number = 1; 
            break; 
        case 21:
            universal_number = 9; 
            break; 
        case 22:
            universal_number = 10;
            break;  
        case 23:
            universal_number = 11;
            break;  
        case 24:
            universal_number = 12;
            break;  
        case 25:
            universal_number = 13;
            break;  
        case 26:
            universal_number = 14;
            break;  
        case 27:
            universal_number = 15;
            break;  
        case 28:
            universal_number = 16;
            break;  
        case 31:
            universal_number = 24;
            break;  
        case 32:
            universal_number = 23;
            break;  
        case 33:
            universal_number = 22;
            break;  
        case 34:
            universal_number = 21;
            break;  
        case 35:
            universal_number = 20;
            break;  
        case 36:
            universal_number = 19;
            break;  
        case 37:
            universal_number = 18;
            break;  
        case 38:
            universal_number = 17;
            break;  
        case 41:
            universal_number = 25;
            break;  
        case 42:
            universal_number = 26;
            break;  
        case 43:
            universal_number = 27;
            break;  
        case 44:
            universal_number = 28;
            break;  
        case 45:
            universal_number = 29;
            break;  
        case 46:
            universal_number = 30;
            break; 
        case 47:
            universal_number = 31;
            break; 
        case 48:
            universal_number = 32;
            break;   
        case 51:
            universal_number = 51;
            break; 
        case 52:
            universal_number = 52;
            break; 
        case 53:
            universal_number = 53;
            break; 
        case 54:
            universal_number = 54;
            break; 
        case 55:
            universal_number = 55;
            break; 
        case 61:
            universal_number = 61;
            break; 
        case 62:
            universal_number = 62;
            break; 
        case 63:
            universal_number = 63;
            break; 
        case 64:
            universal_number = 64;
            break; 
        case 65:
            universal_number = 65;
            break; 
        case 71:
            universal_number = 71;
            break; 
        case 72:
            universal_number = 72;
            break; 
        case 73:
            universal_number = 73;
            break; 
        case 74:
            universal_number = 74;
            break; 
        case 75:
            universal_number = 75;
            break; 
        case 81:
            universal_number = 81;
            break; 
        case 82:
            universal_number = 82;
            break; 
        case 83:
            universal_number = 83;
            break; 
        case 84:
            universal_number = 84;
            break; 
        case 85:
            universal_number = 85;
            break;     
    }

    return universal_number;

}

function getStringUniversal(string){   

    var data_array = JSON.parse("[" + string + "]");   
    var universal_string='';    

    for (var i = 0; i < data_array.length; i++) {
        
        if (universal_string) {
            universal_string = universal_string+','+getUniversal(data_array[i]);        
        }else {
            universal_string = universal_string+getUniversal(data_array[i]);  
        } 

    }

    return universal_string;
}

function getFDI(number){    

    var fdi_number;

    switch(number) {
        case 8:
            fdi_number = 11; 
            break;          
        case 7:
            fdi_number = 12; 
            break; 
        case 6:
            fdi_number = 13; 
            break; 
        case 5:
            fdi_number = 14; 
            break; 
        case 4:
            fdi_number = 15; 
            break; 
        case 3:
            fdi_number = 16; 
            break; 
        case 2:
            fdi_number = 17; 
            break; 
        case 1:
            fdi_number = 18; 
            break; 
        case 9:
            fdi_number = 21; 
            break; 
        case 10:
            fdi_number = 22;
            break;  
        case 11:
            fdi_number = 23;
            break;  
        case 12:
            fdi_number = 24;
            break;  
        case 13:
            fdi_number = 25;
            break;  
        case 14:
            fdi_number = 26;
            break;  
        case 15:
            fdi_number = 27;
            break;  
        case 16:
            fdi_number = 28;
            break;  
        case 24:
            fdi_number = 31;
            break;  
        case 23:
            fdi_number = 32;
            break;  
        case 22:
            fdi_number = 33;
            break;  
        case 21:
            fdi_number = 34;
            break;  
        case 20:
            fdi_number = 35;
            break;  
        case 19:
            fdi_number = 36;
            break;  
        case 18:
            fdi_number = 37;
            break;  
        case 17:
            fdi_number = 38;
            break;  
        case 25:
            fdi_number = 41;
            break;  
        case 26:
            fdi_number = 42;
            break;  
        case 27:
            fdi_number = 43;
            break;  
        case 28:
            fdi_number = 44;
            break;  
        case 29:
            fdi_number = 45;
            break;  
        case 30:
            fdi_number = 46;
            break; 
        case 31:
            fdi_number = 47;
            break; 
        case 32:
            fdi_number = 48;
            break; 
        case 51:
            fdi_number = 51;
            break; 
        case 52:
            fdi_number = 52;
            break; 
        case 53:
            fdi_number = 53;
            break; 
        case 54:
            fdi_number = 54;
            break; 
        case 55:
            fdi_number = 55;
            break; 
        case 61:
            fdi_number = 61;
            break; 
        case 62:
            fdi_number = 62;
            break; 
        case 63:
            fdi_number = 63;
            break; 
        case 64:
            fdi_number = 64;
            break; 
        case 65:
            fdi_number = 65;
            break; 
        case 71:
            fdi_number = 71;
            break; 
        case 72:
            fdi_number = 72;
            break; 
        case 73:
            fdi_number = 73;
            break; 
        case 74:
            fdi_number = 74;
            break; 
        case 75:
            fdi_number = 75;
            break; 
        case 81:
            fdi_number = 81;
            break; 
        case 82:
            fdi_number = 82;
            break; 
        case 83:
            fdi_number = 83;
            break; 
        case 84:
            fdi_number = 84;
            break; 
        case 85:
            fdi_number = 85;
            break;     
        
    }

    return fdi_number;

}

$(function(){
  
    $(".dropdown-menu li a").click(function(){

        var typeTooth = $('#typeTooth').val();        
              
        $('#typeTooth').text($(this).text());
        $('#typeTooth').val($(this).text());

        if ($(this).text() == "Universal" && typeTooth == "FDI") {
            
            $('#hidden_number').removeAttr("value");

            $('#hidden_string_number').removeAttr("value");
            
            $(".tooth").each(function() {  

                var title  = $(this).attr("title");  
                var split  = title.split(" ");
                var number = split[1]; 
                var universal_number = getUniversal(parseInt(number));                  

                if($(this).attr("src").indexOf("/rangACTIVE/") !== -1) {                    
                    var rang = $(this).attr("src").replace("/rangACTIVE/","/rang/"); 
                    $(this).attr("src", rang);
                }

                var src = $(this).attr("src").replace("/medical/","/universal/").replace('/'+number+'.png','/'+universal_number+'.png');

                $(this).attr("src", src); 
            }); 

            $('#row_opacity').addClass('opacity-0');

            $(".ket i").each(function() {   
                if(!$(this).attr("id")) {       
                     
                    var str              = $(this).html();   
                    var res              = str.split(" ");  
                    var number           = res[1];     
                    var universal_number = getUniversal(parseInt(number)); 
                    var html             = $(this).html().replace(number,universal_number+":");    
                    $(this).html(html);     
                   
                    
                }          
            }); 

            convertDentalStatus();

        }else if ($(this).text() == "Universal Kid" && typeTooth == "FDI") {

            $('#universal_kid').removeClass('hide');

        }else if ($(this).text() == "FDI" && typeTooth == "Universal") {

            $('#hidden_number').removeAttr("value");

            $('#hidden_string_number').removeAttr("value");
            
            $(".tooth").each(function() {  

                var title  = $(this).attr("title");  
                var split  = title.split(" ");
                var number = split[1]; 
                var universal_number = getUniversal(parseInt(number));  

                if($(this).attr("src").indexOf("/rangACTIVE/") !== -1) {                    
                    var rang = $(this).attr("src").replace("/rangACTIVE/", "/rang/"); 
                    $(this).attr("src", rang);
                }

                var src = $(this).attr("src").replace("/universal/", "/medical/").replace('/'+universal_number+'.png','/'+number+'.png');

                $(this).attr("src", src); 
            });  

            $('#row_opacity').addClass('opacity-0'); 

            $(".ket i").each(function() {   
                if(!$(this).attr("id")) {       
                     
                    var str              = $(this).html();   
                    var res              = str.split(" ");  
                    var number           = res[1];     
                    var fdi_number = getFDI(parseInt(number)); 
                    var html             = $(this).html().replace(number,fdi_number+":");    
                    $(this).html(html);     
                   
                    
                }          
            }); 

            convertDentalStatus();

        }else if ($(this).text() == "Universal Kid" && typeTooth == "Universal") {

            $('#hidden_number').removeAttr("value");

            $('#hidden_string_number').removeAttr("value");

            $('#universal_kid').removeClass('hide');
            
            $(".tooth").each(function() {  

                var title  = $(this).attr("title");  
                var split  = title.split(" ");
                var number = split[1]; 
                var universal_number = getUniversal(parseInt(number));  

                if($(this).attr("src").indexOf("/rangACTIVE/") !== -1) {                    
                    var rang = $(this).attr("src").replace("/rangACTIVE/", "/rang/"); 
                    $(this).attr("src", rang);
                }

                var src = $(this).attr("src").replace("/universal/", "/medical/").replace('/'+universal_number+'.png','/'+number+'.png');

                $(this).attr("src", src); 
            });  

            $('#row_opacity').addClass('opacity-0'); 

            $(".ket i").each(function() {   
                if(!$(this).attr("id")) {       
                     
                    var str              = $(this).html();   
                    var res              = str.split(" ");  
                    var number           = res[1];     
                    var fdi_number = getFDI(parseInt(number)); 
                    var html             = $(this).html().replace(number,fdi_number+":");    
                    $(this).html(html);     
                   
                    
                }          
            }); 

            convertDentalStatus();

        }else if ($(this).text() == "FDI" && typeTooth == "Universal Kid") {

            $('#universal_kid').addClass('hide');

        }else if ($(this).text() == "Universal" && typeTooth == "Universal Kid") {
            
            $('#hidden_number').removeAttr("value");

            $('#hidden_string_number').removeAttr("value");

            $('#universal_kid').addClass('hide');
            
            $(".tooth").each(function() {  

                var title  = $(this).attr("title");  
                var split  = title.split(" ");
                var number = split[1]; 
                var universal_number = getUniversal(parseInt(number));                  

                if($(this).attr("src").indexOf("/rangACTIVE/") !== -1) {                    
                    var rang = $(this).attr("src").replace("/rangACTIVE/","/rang/"); 
                    $(this).attr("src", rang);
                }

                var src = $(this).attr("src").replace("/medical/","/universal/").replace('/'+number+'.png','/'+universal_number+'.png');

                $(this).attr("src", src); 
            }); 

            $('#row_opacity').addClass('opacity-0');

            $(".ket i").each(function() {   
                if(!$(this).attr("id")) {       
                     
                    var str              = $(this).html();   
                    var res              = str.split(" ");  
                    var number           = res[1];     
                    var universal_number = getUniversal(parseInt(number)); 
                    var html             = $(this).html().replace(number,universal_number+":");    
                    $(this).html(html);     
                   
                    
                }          
            }); 

            convertDentalStatus();

        }      

    });

});
/*Sidenav*/
function onOpacityZero() {   
    $('#mat-nhai').addClass('opacity-0');
    $('#mat-ngoai').addClass('opacity-0');
    $('#mat-trong').addClass('opacity-0');
    $('#mat-gan').addClass('opacity-0');
    $('#mat-xa').addClass('opacity-0');
}
function offOpacityZero() {    
    $('#mat-nhai').removeClass('opacity-0');
    $('#mat-ngoai').removeClass('opacity-0');
    $('#mat-trong').removeClass('opacity-0');
    $('#mat-gan').removeClass('opacity-0');
    $('#mat-xa').removeClass('opacity-0');
}
function onOpacityZeroType1() {    
    $('#mat-ngoai').addClass('opacity-0');
    $('#mat-trong').addClass('opacity-0');
    $('#mat-gan').addClass('opacity-0');
    $('#mat-xa').addClass('opacity-0');
}

function unlockAll() {

    $(".restoration").each(function() {              
        $(this).attr('onclick',$(this).attr("onclick")).unbind('click');   
    });
    $(".decay").each(function() {              
        $(this).attr('onclick',$(this).attr("onclick")).unbind('click');   
    });
    $(".toothache").each(function() {              
        $(this).attr('onclick',$(this).attr("onclick")).unbind('click');   
    });
    $(".fractured").each(function() {              
        $(this).attr('onclick',$(this).attr("onclick")).unbind('click');   
    });
    $(".calculus").each(function() {              
        $(this).attr('onclick',$(this).attr("onclick")).unbind('click');   
    });
    $(".mobility").each(function() {              
        $(this).attr('onclick',$(this).attr("onclick")).unbind('click');   
    }); 
    $(".crown").each(function() {              
        $(this).attr('onclick',$(this).attr("onclick")).unbind('click');   
    }); 
    $(".veneer").each(function() {              
        $(this).attr('onclick',$(this).attr("onclick")).unbind('click');   
    }); 
    $(".implant").each(function() {              
        $(this).attr('onclick',$(this).attr("onclick")).unbind('click');   
    });
    $(".pontic").each(function() {              
        $(this).attr('onclick',$(this).attr("onclick")).unbind('click');   
    });
    $(".missing").each(function() {              
        $(this).attr('onclick',$(this).attr("onclick")).unbind('click');   
    });
    $(".residual_crown").each(function() {              
        $(this).attr('onclick',$(this).attr("onclick")).unbind('click');   
    });
    $(".residual_root").each(function() {              
        $(this).attr('onclick',$(this).attr("onclick")).unbind('click');   
    });    
   
}
function lockOfCrown() {    
    $('.missing').prop('onclick',null).off('click');
    $('.residual_crown').prop('onclick',null).off('click'); 
    $('.restoration').prop('onclick',null).off('click');  
    $('.veneer').prop('onclick',null).off('click');     
    $('.pontic').prop('onclick',null).off('click');
    $('.residual_root').prop('onclick',null).off('click');
    $('.implant').prop('onclick',null).off('click');
}
function lockOfVeneer() {  
    $('.crown').prop('onclick',null).off('click');
    $('.pontic').prop('onclick',null).off('click');
    $('.residual_crown').prop('onclick',null).off('click');
    $('.missing').prop('onclick',null).off('click'); 
    $('.residual_root').prop('onclick',null).off('click');
    $('.implant').prop('onclick',null).off('click');
}
function lockOfPontic() {
    $('.missing').prop('onclick',null).off('click');    
    $('.residual_root').prop('onclick',null).off('click');
    $('.implant').prop('onclick',null).off('click');
    $('.residual_crown').prop('onclick',null).off('click');    
    $('.restoration').prop('onclick',null).off('click');
    $('.decay').prop('onclick',null).off('click');
    $('.toothache').prop('onclick',null).off('click');
    $(".fractured:nth-child(2)").prop('onclick',null).off('click');
    $(".fractured:nth-child(3)").prop('onclick',null).off('click');
    $('.calculus').prop('onclick',null).off('click');
    $('.crown').prop('onclick',null).off('click');
    $('.veneer').prop('onclick',null).off('click');   
}
function lockOfResidualCrown() {
    $('.missing').prop('onclick',null).off('click');
    $('.crown').prop('onclick',null).off('click');
    $('.pontic').prop('onclick',null).off('click');
    $('.implant').prop('onclick',null).off('click');
    $('.residual_root').prop('onclick',null).off('click');
    $('.veneer').prop('onclick',null).off('click');   
    $('.restoration').prop('onclick',null).off('click');
    $('.decay').prop('onclick',null).off('click'); 
    $(".fractured:nth-child(1)").prop('onclick',null).off('click');
    $(".fractured:nth-child(3)").prop('onclick',null).off('click');    
}
function lockOfResidualRoot() {
    $('.missing').prop('onclick',null).off('click');
    $('.crown').prop('onclick',null).off('click');
    $('.pontic').prop('onclick',null).off('click');
    $('.implant').prop('onclick',null).off('click');
    $('.residual_crown').prop('onclick',null).off('click');  
    $('.veneer').prop('onclick',null).off('click');   
    $('.restoration').prop('onclick',null).off('click');
    $('.decay').prop('onclick',null).off('click'); 
    $('.fractured').prop('onclick',null).off('click');   
}
function lockOfMissing() {
    $('.restoration').prop('onclick',null).off('click');
    $('.decay').prop('onclick',null).off('click'); 
    $('.toothache').prop('onclick',null).off('click');
    $('.fractured').prop('onclick',null).off('click');   
    $('.calculus').prop('onclick',null).off('click');
    $('.mobility').prop('onclick',null).off('click');
    $('.veneer').prop('onclick',null).off('click');   
    $('.residual_crown').prop('onclick',null).off('click');
    $('.restoration').prop('onclick',null).off('click');
    $('.crown').prop('onclick',null).off('click');
    $('.pontic').prop('onclick',null).off('click');
    $('.residual_root').prop('onclick',null).off('click');
    $('.implant').prop('onclick',null).off('click');
}
function lockOfImplant() {
    $('.missing').prop('onclick',null).off('click');
    $('.crown').prop('onclick',null).off('click');
    $('.pontic').prop('onclick',null).off('click');    
    $('.residual_root').prop('onclick',null).off('click');
    $('.residual_crown').prop('onclick',null).off('click');
    $('.veneer').prop('onclick',null).off('click');   
    $('.restoration').prop('onclick',null).off('click');
    $('.decay').prop('onclick',null).off('click'); 
    $('.toothache').prop('onclick',null).off('click');
    $(".fractured:nth-child(2)").prop('onclick',null).off('click');
    $(".fractured:nth-child(3)").prop('onclick',null).off('click');   
    $('.calculus').prop('onclick',null).off('click');  
}
function openNav() {       

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");       

    for (var i = 0; i < data_array.length; i++) { 

        var number = data_array[i];  

        if (checkSick(number) == 1){  

        	if ($('#typeTooth').val() == "Universal Kid") {
		        openNav4();
		    }else {
		        openNav2();
		    } 

        }else{

        	if ($('#typeTooth').val() == "Universal Kid") {
		        openNav3();
		    }else {
		        openNav1();
		    } 
           
        }

    }
    
}

function openNav1() {     

    $("#toggle-dental").hide();

    $('#mySidenav1').css("width",$("#teeth_model").width());
       
}

function openNav2() {     

    $("#toggle-dental").hide(); 

    $('#mySidenav2').css("width",$("#teeth_model").width());
       
}

function openNav3() {     

    $("#toggle-dental").hide();

    $('#mySidenav3').css("width",$("#teeth_model").width());
       
}

function openNav4() {     

    $("#toggle-dental").hide(); 

    $('#mySidenav4').css("width",$("#teeth_model").width());
       
}

$('#frmNoteTooth').submit(function(e) {
    
    var formData = new FormData($("#frmAssign")[0]);
    var number = $('#hidden_number').val();
    var note   = $('#txtNoteTooth').val();

    if ($('#typeTooth').val() == "Universal") {
        var no = getUniversal(parseInt(number));
    }else {
        var no = number;
    } 

    if (!formData.checkValidity || formData.checkValidity()) {

        if( $("#ket_luan_"+number).is(':empty') ) {      
            $("#ket_luan_"+number).html('<i>Răng '+no+':</i>');
            $("#ghi_chu_"+number).html('Ghi chú: '+note);
        }else{   
            $("#ghi_chu_"+number).html('Ghi chú: '+note);
        }  

        $('#noteToothModal').modal('hide'); 

    }
  
    return false;

});

$('#noteToothModal').on('hidden.bs.modal', function (e) {
    $('#txtNoteTooth').val('');
});

function retype() {

    var number = $('#hidden_number').val();    

    if ($('#typeTooth').val() == "Universal") {
        var type   = "universal";
        var no     = getUniversal(parseInt(number));
    }else {
        var type   = "medical";
        var no     = number;
    } 

    offOpacityZero();

    if(($("#mat_nhai_"+number).length > 0)){
        $("#mat_nhai_"+number).empty(); 
    }
    if(($("#mat_ngoai_"+number).length > 0)){
        $("#mat_ngoai_"+number).empty(); 
    }
    if(($("#mat_trong_"+number).length > 0)){
        $("#mat_trong_"+number).empty(); 
    }
    if(($("#mat_gan_"+number).length > 0)){
        $("#mat_gan_"+number).empty(); 
    }  
    if(($("#mat_xa_"+number).length > 0)){
        $("#mat_xa_"+number).empty(); 
    } 
    if(($("#ket_luan_"+number).length > 0)){
        $("#ket_luan_"+number).empty(); 
    } 
    if(($("#ghi_chu_"+number).length > 0)){
        $("#ghi_chu_"+number).empty(); 
    }        

    $('#rang-nguoi-lon-'+number).attr("src", "<?php echo Yii::app()->baseUrl; ?>/images/medical_record/"+type+"/rangACTIVE/"+no+".png").removeAttr("data-tooth");;
   
    $("#toggle-dental").hide();      

}

$(document).ready(function(){   
  $(".tooth").each(function() {  
        if($(this).attr("data-tooth")) {

            if($(this).attr("data-tooth")=='1') {               
                var src = $(this).attr("src").replace("rang", "rangbenh");
                $(this).attr("src", src);                
            }
            else if($(this).attr("data-tooth")=='2') {               
                var src = $(this).attr("src").replace("rang", "ranggiacodinh");
                $(this).attr("src", src);                
            }
            else if($(this).attr("data-tooth")=='3') {               
                var src = $(this).attr("src").replace("rang", "Veneer");
                $(this).attr("src", src);                
            }
            else if($(this).attr("data-tooth")=='4') {               
                var src = $(this).attr("src").replace("rang", "vitricauranggia");
                $(this).attr("src", src);                
            }
            else if($(this).attr("data-tooth")=='5') {               
                var src = $(this).attr("src").replace("rang", "rangbenh");
                $(this).attr("src", src);                
            }
            else if($(this).attr("data-tooth")=='6') {               
                var src = $(this).attr("src").replace("rang", "rangmat");
                $(this).attr("src", src);                
            }
            else if($(this).attr("data-tooth")=='7') {               
                var src = $(this).attr("src").replace("rang", "rangbenh");
                $(this).attr("src", src);                
            }
            else if($(this).attr("data-tooth")=='8') {               
                var src = $(this).attr("src").replace("rang", "rangphuchoiIMPLANT");
                $(this).attr("src", src);                
            }
            else if($(this).attr("data-tooth")=='9') {               
                var src = $(this).attr("src").replace("rang", "rangtramA");
                $(this).attr("src", src);                
            }
           
        }
    });  
});

function closeNav() {
    $('.sidenav').css("width","0");   
}

$('.collapse').on('show.bs.collapse', function () {    
    $('.collapse.in').collapse('hide');
});

function checkElementExist(number){

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");
    
    for (var i = 0; i < data_array.length; i++) {
          
        if (data_array[i] == number){  
            return false;
        }
      
    } 

    return true;

}

function checkSick(number){

    var faces = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];   
    var types =    [107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 131, 132, 133, 134, 135, 136, 137, 138];

    for (var i = 0; i < faces.length; i++) {
        for (var j = 0; j < types.length; j++) {          
            if ($("#"+faces[i]+"-"+types[j]+"-"+number).length > 0){  
                return 1;
            }
        }
    } 

    return 0;   

}

function checkStatus(number){

    var faces = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];   
    var types =    [5, 6, 7, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];

    for (var i = 0; i < faces.length; i++) {
        for (var j = 0; j < types.length; j++) {          
            if ($("#"+faces[i]+"-"+types[j]+"-"+number).length > 0){  
                return 1;
            }
        }
    } 

    return 0;   

}

function checkResidualCrownRoot(type,number){ 

    if ($("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0){    

        if ($("#matngoai-"+type+"-"+number).attr('src').indexOf('residualcrownroot') != -1 && $("#mattrong-"+type+"-"+number).attr('src').indexOf('residualcrownroot') != -1){           
            
            return 1;
        }

        return 0;
    }

    return 0;
}

function checkResidualCrownStatus(number){

    var faces = ['matngoai', 'mattrong', 'matgan', 'matxa'];    
    var type  = 5;

    for (var i = 0; i < faces.length; i++) {                 
        if ($("#"+faces[i]+"-"+type+"-"+number).length > 0){  
            return 1;
        }        
    } 

    return 0;   

}

function checkVeneerComposite(number) {

    var faces = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];    
    var type  = 12;

    for (var i = 0; i < faces.length; i++) {                 
        if ($("#"+faces[i]+"-"+type+"-"+number).length > 0){  
            return 1;
        }        
    } 

    return 0;  
   
}

function checkVeneerSu(number) {

    var faces = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];    
    var type  = 13;

    for (var i = 0; i < faces.length; i++) {                 
        if ($("#"+faces[i]+"-"+type+"-"+number).length > 0){  
            return 1;
        }        
    } 

    return 0;  
   
}

function checkMaoKimLoai(number) {

    var faces = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];    
    var type  = 9;

    for (var i = 0; i < faces.length; i++) {                 
        if ($("#"+faces[i]+"-"+type+"-"+number).length > 0){  
            return 1;
        }        
    } 

    return 0;  
   
}

function checkMaoSuKimLoai(number) {

    var faces = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];    
    var type  = 10;

    for (var i = 0; i < faces.length; i++) {                 
        if ($("#"+faces[i]+"-"+type+"-"+number).length > 0){  
            return 1;
        }        
    } 

    return 0;  
   
}

function checkMaoToanSu(number) {

    var faces = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];    
    var type  = 11;

    for (var i = 0; i < faces.length; i++) {                 
        if ($("#"+faces[i]+"-"+type+"-"+number).length > 0){  
            return 1;
        }        
    } 

    return 0;  
   
}

function checkCrown(number){

    var face = 'matnhai';    
    var type = 129;
                   
    if ($("#"+face+"-"+type+"-"+number).length > 0){  
        return 1;
    }  

    return 0;   

}

function checkCrownStatus(number){

    var faces  = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];    
    var types  = [9, 10, 11];    

    for (var i = 0; i < faces.length; i++) {
        for (var j = 0; j < types.length; j++) {          
            if ($("#"+faces[i]+"-"+types[j]+"-"+number).length > 0){  
                return 1;
            }
        }
    }

    return 0;  

}

function checkVeneerStatus(number){

    var faces  = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];    
    var types  = [12, 13];    

    for (var i = 0; i < faces.length; i++) {
        for (var j = 0; j < types.length; j++) {          
            if ($("#"+faces[i]+"-"+types[j]+"-"+number).length > 0){  
                return 1;
            }
        }
    }

    return 0;  

}

function checkPonticStatus(number){

    var faces = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];    
    var types  = [14, 15, 16];    

    for (var i = 0; i < faces.length; i++) {
        for (var j = 0; j < types.length; j++) {          
            if ($("#"+faces[i]+"-"+types[j]+"-"+number).length > 0){  
                return 1;
            }
        }
    }

    return 0;   

}

function checkPonticKimLoai(number){

    var faces = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];    
    var type  = 14;

    for (var i = 0; i < faces.length; i++) {                 
        if ($("#"+faces[i]+"-"+type+"-"+number).length > 0){  
            return 1;
        }        
    } 

    return 0;    

}

function checkPonticSuKimLoai(number){

    var faces = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];    
    var type  = 15;

    for (var i = 0; i < faces.length; i++) {                 
        if ($("#"+faces[i]+"-"+type+"-"+number).length > 0){  
            return 1;
        }        
    } 

    return 0;    

}

function checkPonticToanSu(number){

    var faces = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];    
    var type  = 16;

    for (var i = 0; i < faces.length; i++) {                 
        if ($("#"+faces[i]+"-"+type+"-"+number).length > 0){  
            return 1;
        }        
    } 

    return 0;    

}

function checkResidualRootStatus(number){

    var faces = ['matngoai', 'mattrong', 'matgan', 'matxa'];    
    var type  = 7;

    for (var i = 0; i < faces.length; i++) {                 
        if ($("#"+faces[i]+"-"+type+"-"+number).length > 0){  
            return 1;
        }        
    } 

    return 0;  

}

function checkMissingStatus(number){

    var faces = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];    
    var type  = 6;

    for (var i = 0; i < faces.length; i++) {                 
        if ($("#"+faces[i]+"-"+type+"-"+number).length > 0){  
            return 1;
        }        
    } 

    return 0;  

}

function checkImplantStatus(number){

    var faces = ['matngoai', 'mattrong', 'matgan', 'matxa'];    
    var types  = [17, 18, 19];    

    for (var i = 0; i < faces.length; i++) {
        for (var j = 0; j < types.length; j++) {          
            if ($("#"+faces[i]+"-"+types[j]+"-"+number).length > 0){  
                return 1;
            }
        }
    } 

    return 0;  

}

function checkImplantMao(number){

    var faces = ['matngoai', 'mattrong', 'matgan', 'matxa'];    
    var type  = 17;

    for (var i = 0; i < faces.length; i++) {                 
        if ($("#"+faces[i]+"-"+type+"-"+number).length > 0){  
            return 1;
        }        
    } 

    return 0;  

}


function checkImplantHealing(number){

    var faces = ['matngoai', 'mattrong', 'matgan', 'matxa'];    
    var type  = 18;

    for (var i = 0; i < faces.length; i++) {                 
        if ($("#"+faces[i]+"-"+type+"-"+number).length > 0){  
            return 1;
        }        
    } 

    return 0;  

}


function checkImplant(number){

    var faces = ['matngoai', 'mattrong', 'matgan', 'matxa'];    
    var type  = 19;

    for (var i = 0; i < faces.length; i++) {                 
        if ($("#"+faces[i]+"-"+type+"-"+number).length > 0){  
            return 1;
        }        
    } 

    return 0;  

}

function checkRoot(number){

    var faces = ['matngoai', 'mattrong'];      
    var type = 130;  

    for (var i = 0; i < faces.length; i++) {                 
        if ($("#"+faces[i]+"-"+type+"-"+number).length > 0){  
            return 1;
        }        
    }

    return 0;   

}

function checkCrownRoot(number){

    var faces = ['matngoai', 'mattrong'];      
    var type = 131;  

    for (var i = 0; i < faces.length; i++) {                 
        if ($("#"+faces[i]+"-"+type+"-"+number).length > 0){  
            return 1;
        }        
    }

    return 0;   

}

function getLastRestorationStatus(number){

    
    var types = [108, 109, 110, 111, 112, 113, 114, 115, 116];
    var last  = 0;
    for (var i = 0; i < types.length; i++) {          
        if ($("#ketluan-"+types[i]+"-"+number).length > 0){  
            last = types[i];
        }
    }

    return last; 

}

function getLastDecay(number){

    var types = [117, 118, 119, 120, 121, 122, 123, 124, 125];
    var last  = 0;
    for (var i = 0; i < types.length; i++) {          
        if ($("#ketluan-"+types[i]+"-"+number).length > 0){  
            last = types[i];
        }
    }

    return last; 

}

function getLastToothache(number){

    var types = [126, 127, 128];
    var last  = 0;
    for (var i = 0; i < types.length; i++) {          
        if ($("#ketluan-"+types[i]+"-"+number).length > 0){  
            last = types[i];
        }
    }

    return last; 

}

function getLastFractured(number){

    var types = [129, 130, 131];
    var last  = 0;
    for (var i = 0; i < types.length; i++) {          
        if ($("#ketluan-"+types[i]+"-"+number).length > 0){  
            last = types[i];
        }
    }

    return last; 

}

function getLastCalculus(number){

    var types = [132, 133, 134, 135];
    var last  = 0;
    for (var i = 0; i < types.length; i++) {          
        if ($("#ketluan-"+types[i]+"-"+number).length > 0){  
            last = types[i];
        }
    }

    return last; 

}

function getLastMobility(number){

    var types = [136, 137, 138];
    var last  = 0;
    for (var i = 0; i < types.length; i++) {          
        if ($("#ketluan-"+types[i]+"-"+number).length > 0){  
            last = types[i];
        }
    }

    return last; 

}

function checkSickExceptGrade1(number){

    var faces = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];   
    var types =    [107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 131, 133, 134, 135, 136, 137, 138];

    for (var i = 0; i < faces.length; i++) {
        for (var j = 0; j < types.length; j++) {          
            if ($("#"+faces[i]+"-"+types[j]+"-"+number).length > 0){  
                return 1;
            }
        }
    } 

    return 0;   

}

function checkSickExceptGrade2(number){

    var faces = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];   
    var types =    [107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 131, 132, 134, 135, 136, 137, 138];

    for (var i = 0; i < faces.length; i++) {
        for (var j = 0; j < types.length; j++) {          
            if ($("#"+faces[i]+"-"+types[j]+"-"+number).length > 0){  
                return 1;
            }
        }
    } 

    return 0;   

}

function checkSickExceptGrade3(number){

    var faces = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];   
    var types =    [107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 131, 132, 133, 135, 136, 137, 138];

    for (var i = 0; i < faces.length; i++) {
        for (var j = 0; j < types.length; j++) {          
            if ($("#"+faces[i]+"-"+types[j]+"-"+number).length > 0){  
                return 1;
            }
        }
    } 

    return 0;   

}

function checkStatusExceptMissing(number){

    var faces = ['matnhai', 'matngoai', 'mattrong', 'matgan', 'matxa'];   
    var types =    [5, 7, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];

    for (var i = 0; i < faces.length; i++) {
        for (var j = 0; j < types.length; j++) {          
            if ($("#"+faces[i]+"-"+types[j]+"-"+number).length > 0){  
                return 1;
            }
        }
    } 

    return 0;   

}

function convertDentalStatus(){  

    var face   = 'matngoai';   

    var grade1   = 132;    

    var grade2   = 133;   

    var grade3   = 134;  

    var missing  = 6;   

    var number = [11, 12, 13, 14, 15, 16, 17, 18, 21, 22, 23, 24, 25, 26, 27, 28, 31, 32, 33, 34, 35, 36, 37, 38, 41, 42, 43, 44, 45, 46, 47, 48];

    var str_number_grade1 = "";  

    var str_number_grade2 = "";    

    var str_number_grade3 = "";  

    var str_number_missing = "";    

    $('#voi_rang_do_1').addClass("hide");  

    $('#voi_rang_do_2').addClass("hide"); 

    $('#voi_rang_do_3').addClass("hide"); 

    $('#rang_mat').addClass("hide"); 

    for (var i = 0; i < number.length; i++) {

        $("#ket_luan_"+number[i]).removeClass("hide"); 

        $("#ghi_chu_"+number[i]).removeClass("hide"); 
        
        if ($("#"+face+"-"+grade1+"-"+number[i]).length > 0) {  

            if (checkSickExceptGrade1(number[i]) == 0 && checkStatus(number[i]) == 0) {    

                if ($('#typeTooth').val() == "Universal") {

                    var no = getUniversal(parseInt(number[i]));

                } else {

                    var no = number[i];

                }

                if(str_number_grade1) {   

                    str_number_grade1 = str_number_grade1+','+no;      

                    $('#voi_rang_do_1 .tooth_numbers').html(str_number_grade1);

                } else {

                    str_number_grade1 = str_number_grade1+no;

                    $('#voi_rang_do_1 .tooth_numbers').html(str_number_grade1);                      

                }   

                $("#ket_luan_"+number[i]).addClass("hide"); 

                $("#ghi_chu_"+number[i]).addClass("hide"); 

                $('#voi_rang_do_1').removeClass("hide");  
                
            }              

        } else if ($("#"+face+"-"+grade2+"-"+number[i]).length > 0) {        

            if (checkSickExceptGrade2(number[i]) == 0 && checkStatus(number[i]) == 0) {  

                if ($('#typeTooth').val() == "Universal") {

                    var no = getUniversal(parseInt(number[i]));

                } else {

                    var no = number[i];

                }

                if(str_number_grade2) {   

                    str_number_grade2 = str_number_grade2+','+no;      

                    $('#voi_rang_do_2 .tooth_numbers').html(str_number_grade2);

                } else {

                    str_number_grade2 = str_number_grade2+no;

                    $('#voi_rang_do_2 .tooth_numbers').html(str_number_grade2);                      

                }   

                $("#ket_luan_"+number[i]).addClass("hide"); 

                $("#ghi_chu_"+number[i]).addClass("hide"); 

                $('#voi_rang_do_2').removeClass("hide");  
                
            }              

        } else if ($("#"+face+"-"+grade3+"-"+number[i]).length > 0) {        

            if (checkSickExceptGrade3(number[i]) == 0 && checkStatus(number[i]) == 0) {  

                if ($('#typeTooth').val() == "Universal") {

                    var no = getUniversal(parseInt(number[i]));

                } else {

                    var no = number[i];

                }

                if(str_number_grade3) {   

                    str_number_grade3 = str_number_grade3+','+no;      

                    $('#voi_rang_do_3 .tooth_numbers').html(str_number_grade3);

                } else {

                    str_number_grade3 = str_number_grade3+no;

                    $('#voi_rang_do_3 .tooth_numbers').html(str_number_grade3);                      

                }   

                $("#ket_luan_"+number[i]).addClass("hide"); 

                $("#ghi_chu_"+number[i]).addClass("hide"); 

                $('#voi_rang_do_3').removeClass("hide");  
                
            }              

        } else if ($("#"+face+"-"+missing+"-"+number[i]).length > 0) {        

            if (checkSick(number[i]) == 0 && checkStatusExceptMissing(number[i]) == 0) {  

                if ($('#typeTooth').val() == "Universal") {

                    var no = getUniversal(parseInt(number[i]));

                } else {

                    var no = number[i];

                }

                if(str_number_missing) {   

                    str_number_missing = str_number_missing+','+no;      

                    $('#rang_mat .tooth_numbers').html(str_number_missing);

                } else {

                    str_number_missing = str_number_missing+no;

                    $('#rang_mat .tooth_numbers').html(str_number_missing);                      

                }   

                $("#ket_luan_"+number[i]).addClass("hide"); 

                $("#ghi_chu_"+number[i]).addClass("hide"); 

                $('#rang_mat').removeClass("hide");  
                
            }              

        }  

    } 

}

convertDentalStatus();

function incisalUsal(status){  

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");


    if(status==1){  
        
        for (var i = 0; i < data_array.length; i++) { 

            var number = data_array[i]; 
            var type=108;  
            var flag=101;      
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangtramA/", "/rangACTIVE/");
            var rangtramA = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangtramA/");  

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){                
                $('#rang-nguoi-lon-'+number).attr("data-tooth","9").attr("src", rangtramA); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');               
            }      

            if (($("#matnhai-"+type+"-"+number).length > 0)){   

                $("#matnhai-"+type+"-"+number).remove(); 

                $("#ketluan-"+type+"-"+number).remove();

                if (getLastRestorationStatus(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }

            }else{                          

                $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matnhai'+number+'-trongtrai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');

                if (getLastRestorationStatus(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Phục hồi miếng trám</i>');                            
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt nhai (X)</i>');  
                }else {
                    var last = getLastRestorationStatus(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt nhai (X)</i>');            
                } 
                
            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }      
            }

        }

    } 
    else if(status==2){  
        
        for (var i = 0; i < data_array.length; i++) { 

            var number = data_array[i];  
            var type     = 117;
            var flag=102;  
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
            var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/");

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){                
                $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');               
            }       

            if($("#matnhai-"+type+"-"+number).length > 0){    
                $("#matnhai-"+type+"-"+number).remove();
                $("#ketluan-"+type+"-"+number).remove();   

                if (getLastDecay(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }

            }else{   
                $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/decay-matnhai'+number+'-trongtrai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');        
                
                if (getLastDecay(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Sâu răng</i>');             
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt nhai (X)</i>');  
                }else {
                    var last = getLastDecay(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt nhai (X)</i>');            
                }

            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }      
            }

        }

    }

    convertDentalStatus();   

}

function incisalSal(status){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");   

    if(status==1){

        for (var i = 0; i < data_array.length; i++) { 

            var number = data_array[i];
            var type=109;  
            var flag=101;     
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangtramA/", "/rangACTIVE/");
            var rangtramA = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangtramA/");  

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }  

            if (checkSick(number) == 0 && checkStatus(number) == 0){                
                $('#rang-nguoi-lon-'+number).attr("data-tooth","9").attr("src", rangtramA); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');               
            }  

            if (($("#matnhai-"+type+"-"+number+"").length > 0)){    

                $("#matnhai-"+type+"-"+number+"").remove(); 

                $("#ketluan-"+type+"-"+number+"").remove();

                if (getLastRestorationStatus(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }


            }else{                     

                $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matnhai'+number+'-trongphai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');

                if (getLastRestorationStatus(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Phục hồi miếng trám</i>');       
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt nhai (G)</i>');  
                }else {
                    var last = getLastRestorationStatus(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt nhai (G)</i>');            
                }                  

            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }      
            }

        }
    }   
    else if(status==2){        
        
        for (var i = 0; i < data_array.length; i++) { 

            var number = data_array[i];  
            var type=118;
            var flag=102;   
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
            var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/");

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');  
            } 

            if ($("#matnhai-"+type+"-"+number).length > 0){    
                $("#matnhai-"+type+"-"+number).remove(); 
                $("#ketluan-"+type+"-"+number).remove();  

                if (getLastDecay(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }

            }else{
                $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/decay-matnhai'+number+'-trongphai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');   

                if (getLastDecay(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Sâu răng</i>');             
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt nhai (G)</i>');  
                }else {
                    var last = getLastDecay(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt nhai (G)</i>');            
                }      
        
            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }   
            }

        }

    }    

    convertDentalStatus();

}

function distal(status){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");    

    if(status==1){

        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i];
            var type=110;
            var flag=101;   
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangtramA/", "/rangACTIVE/");
            var rangtramA = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangtramA/");   

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){                
                $('#rang-nguoi-lon-'+number).attr("data-tooth","9").attr("src", rangtramA); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');               
            }         

            if (($("#matnhai-"+type+"-"+number+"").length > 0)){   

                $("#matnhai-"+type+"-"+number+"").remove();  

                $("#ketluan-"+type+"-"+number+"").remove();

                if (getLastRestorationStatus(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }

            }
            else{                   

                $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matnhai'+number+'-trai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');

                if (getLastRestorationStatus(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Phục hồi miếng trám</i>');       
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt xa</i>');  
                }else {
                    var last = getLastRestorationStatus(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt xa</i>');            
                }

            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }   
            }
        }
    }  
    else if(status==2){        
        
        for (var i = 0; i < data_array.length; i++) { 

            var number = data_array[i];  
            var type=119;
            var flag=102;   
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
            var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/");

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');  
            } 

            if ($("#matnhai-"+type+"-"+number).length > 0){    
                $("#matnhai-"+type+"-"+number).remove(); 
                $("#ketluan-"+type+"-"+number).remove(); 

                if (getLastDecay(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }

            }else{
                $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/decay-matnhai'+number+'-trai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">'); 

                if (getLastDecay(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Sâu răng</i>');             
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt xa</i>');  
                }else {
                    var last = getLastDecay(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt xa</i>');            
                } 

            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }       
            }

        }

    }    
    
    convertDentalStatus();
       
}

function mesial(status){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");    

    if(status==1){

        for (var i = 0; i < data_array.length; i++) { 

            var number = data_array[i];  
            var type=111;  
            var flag=101;      
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangtramA/", "/rangACTIVE/");
            var rangtramA = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangtramA/");  

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }  

            if (checkSick(number) == 0 && checkStatus(number) == 0){                
                $('#rang-nguoi-lon-'+number).attr("data-tooth","9").attr("src", rangtramA); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');               
            }    

            if (($("#matnhai-"+type+"-"+number+"").length > 0)){   

                $("#matnhai-"+type+"-"+number+"").remove(); 

                $("#ketluan-"+type+"-"+number+"").remove();

                if (getLastRestorationStatus(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }

            }else{                   

                $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matnhai'+number+'-phai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');

                if (getLastRestorationStatus(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Phục hồi miếng trám</i>');       
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt gần</i>');  
                }else {
                    var last = getLastRestorationStatus(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt gần</i>');            
                }   

            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }       
            }

        }
    }  
    else if(status==2){        
        
        for (var i = 0; i < data_array.length; i++) { 

            var number = data_array[i];  
            var type=120;
            var flag=102;   
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
            var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/");

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            }

            if ($("#matnhai-"+type+"-"+number).length > 0){    
                $("#matnhai-"+type+"-"+number).remove(); 
                $("#ketluan-"+type+"-"+number).remove();

                if (getLastDecay(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }

            }else{
                $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/decay-matnhai'+number+'-phai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');        

                if (getLastDecay(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Sâu răng</i>');             
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt gần</i>');  
                }else {
                    var last = getLastDecay(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt gần</i>');            
                }

            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }           
            }

        }

    }    
    
    convertDentalStatus();
       

}

function proximalD(status){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");    

    if(status==1){

        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i]; 

            var type=112;  
            var flag=101;  
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangtramA/", "/rangACTIVE/");
            var rangtramA = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangtramA/");    

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){                
                $('#rang-nguoi-lon-'+number).attr("data-tooth","9").attr("src", rangtramA); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');               
            }          

            if (($("#matngoai-"+type+"-"+number+"").length > 0) && ($("#mattrong-"+type+"-"+number+"").length > 0)){    
                $("#matngoai-"+type+"-"+number+"").remove();   
                $("#mattrong-"+type+"-"+number+"").remove(); 

                $("#ketluan-"+type+"-"+number+"").remove();

                if (getLastRestorationStatus(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }

            }
            else{                         

                $('#mat_ngoai_'+number).append('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matngoai'+number+'-trai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_trong_'+number).append('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/mattrong'+number+'-phai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');

                if (getLastRestorationStatus(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Phục hồi miếng trám</i>');       
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt bên xa</i>');  
                }else {
                    var last = getLastRestorationStatus(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt bên xa</i>');            
                }  
            
                
            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }           
            }

        }
    }  
    else if(status==2){        
        
        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i];  
            var type=121;   
            var flag=102;    
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
            var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/");  

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');            
            } 

            if ($("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0){    
                $("#matngoai-"+type+"-"+number).remove();   
                $("#mattrong-"+type+"-"+number).remove();
                $("#ketluan-"+type+"-"+number).remove(); 

                if (getLastDecay(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }

            }else{
                $('#mat_ngoai_'+number).append('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/decay-matngoai'+number+'-trai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_trong_'+number).append('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/decay-mattrong'+number+'-phai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');     

                if (getLastDecay(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Sâu răng</i>');             
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt bên (X)</i>');  
                }else {
                    var last = getLastDecay(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt bên (X)</i>');            
                } 

            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }   
            }

        }

    }    
    
    convertDentalStatus();
            
}

function proximalM(status){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");   

    if(status==1){

        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i]; 

            var type=113;  
            var flag=101; 
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangtramA/", "/rangACTIVE/");
            var rangtramA = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangtramA/");    

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){                
                $('#rang-nguoi-lon-'+number).attr("data-tooth","9").attr("src", rangtramA); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');               
            }       

            if (($("#matngoai-"+type+"-"+number+"").length > 0) && ($("#mattrong-"+type+"-"+number+"").length > 0)){    
                $("#matngoai-"+type+"-"+number+"").remove();   
                $("#mattrong-"+type+"-"+number+"").remove();  

                $("#ketluan-"+type+"-"+number+"").remove();

                if (getLastRestorationStatus(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }


            }else{                           

                $('#mat_ngoai_'+number).append('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matngoai'+number+'-phai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_trong_'+number).append('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/mattrong'+number+'-trai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');

                if (getLastRestorationStatus(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Phục hồi miếng trám</i>');       
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt bên gần</i>');  
                }else {
                    var last = getLastRestorationStatus(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt bên gần</i>');            
                }           
                

            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }   
            }

        }
    } 
    else if(status==2){        
        
        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i]; 
            var type=122; 
            var flag=102; 
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
            var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/");

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');      
            }         

            if ($("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0){    
                $("#matngoai-"+type+"-"+number).remove();   
                $("#mattrong-"+type+"-"+number).remove();
                $("#ketluan-"+type+"-"+number).remove();

                if (getLastDecay(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }

            }else{
                $('#mat_ngoai_'+number).append('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/decay-matngoai'+number+'-phai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_trong_'+number).append('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/decay-mattrong'+number+'-trai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');      

                if (getLastDecay(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Sâu răng</i>');             
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt bên (G)</i>');  
                }else {
                    var last = getLastDecay(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt bên (G)</i>');            
                } 

            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            }

        }

    }    
    
    convertDentalStatus();
         
}

function abfractionV(status){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");    

    if(status==1){

        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i]; 

            var type=114;   
            var flag=101; 
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangtramA/", "/rangACTIVE/");
            var rangtramA = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangtramA/");  

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }  

            if (checkSick(number) == 0 && checkStatus(number) == 0){                
                $('#rang-nguoi-lon-'+number).attr("data-tooth","9").attr("src", rangtramA); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');               
            }     

            if (($("#matngoai-"+type+"-"+number+"").length > 0) && ($("#mattrong-"+type+"-"+number+"").length > 0)){    
                $("#matngoai-"+type+"-"+number+"").remove();   
                $("#mattrong-"+type+"-"+number+"").remove();

                $("#ketluan-"+type+"-"+number+"").remove();

                if (getLastRestorationStatus(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }

            }else{   

                $('#mat_ngoai_'+number).append('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matngoai'+number+'-giua.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_trong_'+number).append('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/mattrong'+number+'-giua.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');

                if (getLastRestorationStatus(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Phục hồi miếng trám</i>');       
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Cổ răng</i>');  
                }else {
                    var last = getLastRestorationStatus(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Cổ răng</i>');            
                }     

            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            }

        }
    } 
    else if(status==2){        
        
        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i]; 
            var type=123; 
            var flag=102; 
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
            var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/");   

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }   

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            }   

            if ($("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){    
                $("#matngoai-"+type+"-"+number).remove();   
                $("#mattrong-"+type+"-"+number).remove();  
                $("#matgan-"+type+"-"+number).remove();   
                $("#matxa-"+type+"-"+number).remove();
                $("#ketluan-"+type+"-"+number).remove(); 

                if (getLastDecay(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }

            }else{
                $('#mat_ngoai_'+number).append('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/decay-matngoai'+number+'-giua.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_trong_'+number).append('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/decay-mattrong'+number+'-giua.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_gan_'+number).append('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/decay-matgan'+number+'-giua.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_xa_'+number).append('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/decay-matxa'+number+'-giua.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');  

                if (getLastDecay(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Sâu răng</i>');             
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Cổ răng</i>');  
                }else {
                    var last = getLastDecay(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Cổ răng</i>');            
                }

            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }      
            }

        }

    }     
    
    convertDentalStatus();
       
}

function facialBuccal(status){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");    

    if(status==1){

        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i];

            var type=115;   
            var flag=101;  
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangtramA/", "/rangACTIVE/");
            var rangtramA = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangtramA/");   

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){                
                $('#rang-nguoi-lon-'+number).attr("data-tooth","9").attr("src", rangtramA); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');               
            }      

            if (($("#matnhai-"+type+"-"+number+"").length > 0)){    
                $("#matnhai-"+type+"-"+number+"").remove(); 

                $("#ketluan-"+type+"-"+number+"").remove();

                if (getLastRestorationStatus(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }


            }else{                

                $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matnhai'+number+'-duoi.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');

                if (getLastRestorationStatus(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Phục hồi miếng trám</i>');       
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt ngoài</i>');  
                }else {
                    var last = getLastRestorationStatus(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt ngoài</i>');            
                }                

            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }      
            }
        }
    } 
    else if(status==2){        
        
        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i]; 
            var type=124;
            var flag=102;  
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
            var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/");

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            }   

            if ($("#matnhai-"+type+"-"+number).length > 0){    
                $("#matnhai-"+type+"-"+number).remove(); 
                $("#ketluan-"+type+"-"+number).remove(); 

                if (getLastDecay(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }

            }else{
                $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/decay-matnhai'+number+'-duoi.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');    

                if (getLastDecay(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Sâu răng</i>');             
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt ngoài</i>');  
                }else {
                    var last = getLastDecay(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt ngoài</i>');            
                } 

            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); } 
            }

        }

    }       
    
    convertDentalStatus();
     
}

function palateLingual(status){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");    

    if(status==1){

        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i]; 

            var type=116; 
            var flag=101;  
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangtramA/", "/rangACTIVE/");
            var rangtramA = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangtramA/");    

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){                
                $('#rang-nguoi-lon-'+number).attr("data-tooth","9").attr("src", rangtramA); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');               
            }           

            if (($("#matnhai-"+type+"-"+number+"").length > 0)){    
                $("#matnhai-"+type+"-"+number+"").remove();  

                $("#ketluan-"+type+"-"+number+"").remove();

                if (getLastRestorationStatus(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }


            }else{                        

                $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matnhai'+number+'-tren.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');

                if (getLastRestorationStatus(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Phục hồi miếng trám</i>');       
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt trong</i>');  
                }else {
                    var last = getLastRestorationStatus(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt trong</i>');            
                }  

            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); } 
            }
        }
    }   
    else if(status==2){        
        
        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i]; 
            var type=125;
            var flag=102;
            var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
            var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/");

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');
            } 

            if ($("#matnhai-"+type+"-"+number).length > 0){    
                $("#matnhai-"+type+"-"+number).remove(); 
                $("#ketluan-"+type+"-"+number).remove(); 

                if (getLastDecay(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }

            }else{
                $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/decay-matnhai'+number+'-tren.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');      

                if (getLastDecay(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Sâu răng</i>');             
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt trong</i>');  
                }else {
                    var last = getLastDecay(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Mặt trong</i>');            
                } 

            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }    
            }

        }

    }     
    
    convertDentalStatus();
    
}

function sensitive(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");
        
    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i]; 
        var type=126; 
        var flag=103;  
        var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
        var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/");  

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
        } 

        if ($("#matnhai-"+type+"-"+number).length > 0){    
            $("#matnhai-"+type+"-"+number).remove();  
            $("#ketluan-"+type+"-"+number).remove(); 

            if (getLastToothache(number) == 0) {   
                $("#muc-"+flag+"-"+number).remove();
            }

        }else{
            $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/sensitive-tooth.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');    

            if (getLastToothache(number) == 0) {   
                $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Đau răng</i>');             
                $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Nhạy cảm</i>');  
            }else {
                var last = getLastToothache(number);
                $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Nhạy cảm</i>');            
            } 

        }   

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); } 
        }   

    }        
    
    convertDentalStatus();    
    
}

function pulpitis(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");
        
    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i]; 
        var type=127;  
        var flag=103;    
        var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
        var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/"); 

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
        } 

        if ($("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){    
            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove(); 
            $("#ketluan-"+type+"-"+number).remove(); 

            if (getLastToothache(number) == 0) {   
                $("#muc-"+flag+"-"+number).remove();
            }

        }else{
            $('#mat_ngoai_'+number).append('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/pulpitis'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).append('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/pulpitis'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).append('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/pulpitis'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).append('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/pulpitis'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');    

            if (getLastToothache(number) == 0) {   
                $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Đau răng</i>');             
                $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Viêm tủy</i>');  
            }else {
                var last = getLastToothache(number);
                $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Viêm tủy</i>');            
            }

        }

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); } 
        } 

    }     
    
    convertDentalStatus();    
       
}

function chronicPeriapical(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");
        
    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i];
        var type=128;  
        var flag=103;   
        var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
        var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/"); 

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');    
        }    

        if ($("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){    
            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove(); 
            $("#ketluan-"+type+"-"+number).remove();

            if (getLastToothache(number) == 0) {   
                $("#muc-"+flag+"-"+number).remove();
            }

        }else{
            $('#mat_ngoai_'+number).append('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/chroni'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).append('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/chroni'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).append('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/chroni'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).append('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/chroni'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');    

            if (getLastToothache(number) == 0) {   
                $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Đau răng</i>');             
                $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Viêm quanh chóp</i>');  
            }else {
                var last = getLastToothache(number);
                $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Viêm quanh chóp</i>');            
            }

        } 

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }    
        }

    }     
    
    convertDentalStatus();    
       
}

function crown(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");
        
    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i]; 
        var type=129;
        var flag=104;  
        var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
        var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/");   

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            
        }  

        if (($("#matnhai-"+type+"-"+number).length > 0)){              
            $("#matnhai-"+type+"-"+number).remove();         
            $('#mat-nhai').removeClass('opacity-0');  
            
            $("#ketluan-"+type+"-"+number).remove();  

            if (getLastFractured(number) == 0) {   
                $("#muc-"+flag+"-"+number).remove();
            }  

        }else{         
            $("#matngoai-130-"+number).remove();   
            $("#mattrong-130-"+number).remove(); 
            $("#matngoai-131-"+number).remove();   
            $("#mattrong-131-"+number).remove();
            $('#mat-ngoai').removeClass('opacity-0'); 
            $('#mat-trong').removeClass('opacity-0');
            $('#mat-nhai').addClass('opacity-0');

            // implant-fractured-crown   
            if (checkImplantStatus(number) == 1) {
                $('#mat-ngoai').addClass('opacity-0'); 
                $('#mat-trong').addClass('opacity-0');
            }                 
            // end         
            
            $('#mat_nhai_'+number).prepend('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/crown'+number+'.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');     

            if (getLastFractured(number) == 0) {   
                $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Nứt răng</i>');             
                $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Nứt thân răng</i>');  
            }else {
                var last = getLastFractured(number);
                $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Nứt thân răng</i>');            
            }

            $("#ketluan-130-"+number+"").remove();
            $("#ketluan-131-"+number+"").remove();
            
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); } 
            
        }  

    }      
    
    convertDentalStatus();         
    
}

function crownRoot(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");
        
    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i];  
        var type=131;
        var flag=104;  
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
        var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/"); 

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');
             
        }  

        if ($("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0){             
            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();
            $('#mat-ngoai').removeClass('opacity-0'); 
            $('#mat-trong').removeClass('opacity-0');
            $("#ketluan-"+type+"-"+number).remove();  

            if (getLastFractured(number) == 0) {   
                $("#muc-"+flag+"-"+number).remove();
            } 

        }else{
            $("#matnhai-129-"+number).remove(); 
            $("#matngoai-130-"+number).remove();   
            $("#mattrong-130-"+number).remove(); 
            $('#mat-ngoai').addClass('opacity-0'); 
            $('#mat-trong').addClass('opacity-0'); 
            $('#mat-nhai').removeClass('opacity-0');        
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/crownroot'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/crownroot'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');  

            if (getLastFractured(number) == 0) {   
                $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Nứt răng</i>');             
                $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Nứt thân- chân răng</i>');  
            }else {
                var last = getLastFractured(number);
                $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Nứt thân- chân răng</i>');            
            } 

            $("#ketluan-129-"+number).remove();
            $("#ketluan-130-"+number).remove();        
           
        } 

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); } 
            
        } 

    }      
    
    convertDentalStatus();    
    
}

function gradeI(status){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val(); 

    var data_array = JSON.parse("[" + string + "]");           

    if(status==1){

        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i]; 
            var type=132;
            var flag=105;  
            var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
            var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/"); 

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');   
                 
            }      

            if ($("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){    
                $("#matngoai-"+type+"-"+number).remove();   
                $("#mattrong-"+type+"-"+number).remove();  
                $("#matgan-"+type+"-"+number).remove();   
                $("#matxa-"+type+"-"+number).remove(); 
                $("#ketluan-"+type+"-"+number).remove(); 

                if (getLastCalculus(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                } 

            }else{
                $("#matngoai-133-"+number).remove();   
                $("#mattrong-133-"+number).remove();  
                $("#matgan-133-"+number).remove();   
                $("#matxa-133-"+number).remove();
                $("#matngoai-134-"+number).remove();   
                $("#mattrong-134-"+number).remove();  
                $("#matgan-134-"+number).remove();   
                $("#matxa-134-"+number).remove();

                $('#mat_ngoai_'+number).append('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/calculus-grade1-'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_trong_'+number).append('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/calculus-grade1-'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_gan_'+number).append('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/calculus-grade1-'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_xa_'+number).append('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/calculus-grade1-'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                
                if (getLastCalculus(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Vôi răng</i>');             
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Độ 1</i>');  
                }else {
                    var last = getLastCalculus(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Độ 1</i>');            
                } 

                $("#ketluan-133-"+number).remove();
                $("#ketluan-134-"+number).remove();  

            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }                 
                
            } 

        }         

    } 
    else if(status==2){

        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i];
            var type=136;
            var flag=106;
            var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
            var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/"); 

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
                 
            } 

            if ($("#matnhai-"+type+"-"+number).length > 0){    
                $("#matnhai-"+type+"-"+number).remove();
                $("#ketluan-"+type+"-"+number).remove();   

                if (getLastMobility(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                } 

            }else{
                $("#matnhai-137-"+number).remove(); 
                $("#matnhai-138-"+number).remove(); 

                $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/mobility-img-grade1.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                
                if (getLastMobility(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Lung lay</i>');             
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Độ 1</i>');  
                }else {
                    var last = getLastMobility(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Độ 1</i>');            
                } 

                $("#ketluan-137-"+number).remove();
                $("#ketluan-138-"+number).remove();        
               
            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); } 
                
            } 

        }

    }

    convertDentalStatus();  

}

function gradeII(status){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");        

    if(status==1){

        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i]; 
            var type=133;
            var flag=105;   
            var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
            var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/");  

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
                 
            }    

            if ($("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number+"").length > 0 && $("#matgan-"+type+"-"+number+"").length > 0 && $("#matxa-"+type+"-"+number+"").length > 0){    
                $("#matngoai-"+type+"-"+number).remove();   
                $("#mattrong-"+type+"-"+number).remove();  
                $("#matgan-"+type+"-"+number).remove();   
                $("#matxa-"+type+"-"+number).remove();
                $("#ketluan-"+type+"-"+number).remove(); 

                if (getLastCalculus(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                } 

            }else{
                $("#matngoai-132-"+number).remove();   
                $("#mattrong-132-"+number).remove();  
                $("#matgan-132-"+number).remove();   
                $("#matxa-132-"+number).remove(); 
                $("#matngoai-134-"+number).remove();   
                $("#mattrong-134-"+number).remove();  
                $("#matgan-134-"+number).remove();   
                $("#matxa-134-"+number).remove();

                $('#mat_ngoai_'+number).append('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/calculus-grade2-'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_trong_'+number).append('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/calculus-grade2-'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_gan_'+number).append('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/calculus-grade2-'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_xa_'+number).append('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/calculus-grade2-'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                
                if (getLastCalculus(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Vôi răng</i>');             
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Độ 2</i>');  
                }else {
                    var last = getLastCalculus(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Độ 2</i>');            
                } 

                $("#ketluan-132-"+number).remove();
                $("#ketluan-134-"+number).remove();        
               
            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
                
            } 
        }
    } 
    else if(status==2){

        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i]; 
            var type=137;
            var flag=106;  
            var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
            var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/");

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
                 
            } 

            if ($("#matnhai-"+type+"-"+number).length > 0){    
                $("#matnhai-"+type+"-"+number).remove(); 
                $("#ketluan-"+type+"-"+number).remove();   

                if (getLastMobility(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                } 

            }else{
                $("#matnhai-136-"+number).remove(); 
                $("#matnhai-138-"+number).remove(); 

                $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/mobility-img-grade2.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                
                if (getLastMobility(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Lung lay</i>');             
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Độ 2</i>');  
                }else {
                    var last = getLastMobility(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Độ 2</i>');            
                } 

                $("#ketluan-136-"+number).remove();
                $("#ketluan-138-"+number).remove();        
                
            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
                
            } 

        }

    }  

    convertDentalStatus(); 

}

function gradeIII(status){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]"); 
       

    if(status==1){

        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i];
            var type=134;
            var flag=105;   
            var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
            var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/"); 

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
                
            }        

            if ($("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){    
                $("#matngoai-"+type+"-"+number).remove();   
                $("#mattrong-"+type+"-"+number).remove();  
                $("#matgan-"+type+"-"+number).remove();   
                $("#matxa-"+type+"-"+number).remove(); 

                $("#ketluan-"+type+"-"+number).remove();

                if (getLastCalculus(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                }  

            }else{
                $("#matngoai-132-"+number).remove();   
                $("#mattrong-132-"+number).remove();  
                $("#matgan-132-"+number).remove();   
                $("#matxa-132-"+number).remove(); 
                $("#matngoai-133-"+number).remove();   
                $("#mattrong-133-"+number).remove();  
                $("#matgan-133-"+number).remove();   
                $("#matxa-133-"+number).remove();

                $('#mat_ngoai_'+number).append('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/calculus-grade3-'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_trong_'+number).append('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/calculus-grade3-'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_gan_'+number).append('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/calculus-grade3-'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_xa_'+number).append('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/calculus-grade3-'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                
                if (getLastCalculus(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Vôi răng</i>');             
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Độ 3</i>');  
                }else {
                    var last = getLastCalculus(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Độ 3</i>');            
                } 

                $("#ketluan-132-"+number).remove();
                $("#ketluan-133-"+number).remove();        
               
            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
                
            } 
        }

    } 
    else if(status==2){

        for (var i = 0; i < data_array.length; i++) {

            var number = data_array[i];
            var type=138;
            var flag=106; 
            var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
            var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/"); 

            if ($('#typeTooth').val() == "Universal") {
                var no = getUniversal(parseInt(number));
            }else {
                var no = number;
            }

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh);
                if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); } 
                $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
                
            } 

            if ($("#matnhai-"+type+"-"+number).length > 0){    
                $("#matnhai-"+type+"-"+number).remove(); 

                $("#ketluan-"+type+"-"+number).remove();  

                if (getLastMobility(number) == 0) {   
                    $("#muc-"+flag+"-"+number).remove();
                } 

            }else{
                $("#matnhai-136-"+number).remove(); 
                $("#matnhai-137-"+number).remove(); 

                $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/mobility-img-grade3.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                
                if (getLastMobility(number) == 0) {   
                    $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Lung lay</i>');             
                    $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Độ 3</i>');  
                }else {
                    var last = getLastMobility(number);
                    $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Độ 3</i>');            
                } 

                $("#ketluan-136-"+number).remove();
                $("#ketluan-137-"+number).remove();        
               
            } 

            if (checkSick(number) == 0 && checkStatus(number) == 0){
                $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
                $('#ket_luan_'+number).empty();
                if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
                
            } 

        }

    }  

    convertDentalStatus(); 

}

function root(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");
        
    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i];  
        var type=130;
        var flag=104; 
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
        var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/"); 

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            
        }     

        if ($("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0){   
            $('#mat-ngoai').removeClass('opacity-0'); 
            $('#mat-trong').removeClass('opacity-0'); 

            // residualCrown-fractured-root
            if ($("#matngoai-"+type+"-"+number).attr('src').indexOf('residualcrownroot') != -1 && $("#mattrong-"+type+"-"+number).attr('src').indexOf('residualcrownroot') != -1){ 
                $('#mat-ngoai').addClass('opacity-0'); 
                $('#mat-trong').addClass('opacity-0');
                $('#mat_ngoai_'+number).prepend('<img id="matngoai-5-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/residualcrown'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_trong_'+number).prepend('<img id="mattrong-5-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/residualcrown'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');  
            }// end residualCrown-fractured-root

            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove(); 
            $("#ketluan-"+type+"-"+number).remove();

            if (getLastFractured(number) == 0) {   
                $("#muc-"+flag+"-"+number).remove();
            } 


        }// residualCrown-fractured-root
        else if(checkResidualCrownRoot(5,number) == 1){ 
            $("#matngoai-5-"+number).remove();    
            $("#mattrong-5-"+number).remove(); 
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-5-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/residualcrown'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-5-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/residualcrown'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');  
            $("#ketluan-"+type+"-"+number).remove();
        }// end residualCrown-fractured-root
        else{     
            $("#matnhai-129-"+number).remove(); 
            $("#matngoai-131-"+number).remove();   
            $("#mattrong-131-"+number).remove(); 
            $('#mat-nhai').removeClass('opacity-0');
            $('#mat-ngoai').addClass('opacity-0'); 
            $('#mat-trong').addClass('opacity-0');

            // residualCrown-fractured-root
            if(($("#matngoai-5-"+number+"").length > 0) && ($("#mattrong-5-"+number+"").length > 0)){    
                $("#matngoai-5-"+number).remove();    
                $("#mattrong-5-"+number).remove();         
                $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/residualcrownroot'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/residualcrownroot'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');     
            }// end residualCrown-fractured-root
            else{
                $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/root'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/root'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');     
            }  

            if (getLastFractured(number) == 0) {   
                $('#ket_luan_'+number).append('<i id="muc-'+flag+"-"+number+'"> Nứt răng</i>');             
                $("#muc-"+flag+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Nứt chân răng</i>');  
            }else {
                var last = getLastFractured(number);
                $("#ketluan-"+last+"-"+number).after('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">, Nứt chân răng</i>');            
            } 

            $("#ketluan-129-"+number).remove();
            $("#ketluan-131-"+number).remove();
            
        } 

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); } 
            
        }  

    }    
    
    convertDentalStatus();    
    
}

function monRang(){ 

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");
        
    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i]; 
        var type=107;     
        var rangACTIVE     = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
        var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/");   

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth","1").attr("src", rangbenh); 
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
        } 

        if ($("#matnhai-"+type+"-"+number).length > 0 && $("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){    
            $("#matnhai-"+type+"-"+number).remove();   
            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove(); 
            $("#ketluan-"+type+"-"+number).remove(); 
        }else{
            $('#mat_nhai_'+number).append('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/monrang'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_ngoai_'+number).append('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/monrang'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).append('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/monrang'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).append('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/monrang'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).append('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/monrang'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');    
            $('#ket_luan_'+number).append('<i id="ketluan-'+type+'-'+number+'" data-user="'+id_user+'">Mòn răng</i>');
        }

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); } 
        } 

    }     
    
    convertDentalStatus();    

}

function residualCrownStatus(){ 

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]"); 

    for (var i = 0; i < data_array.length; i++) {   

        var number = data_array[i];
        var type=5;  
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
        var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/"); 

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        } 

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth",type).attr("src", rangbenh); 
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>');             
        } 

        if ($("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0){    
            unlockAll();
            offOpacityZero();

            // fractured-root-residualCrown        
            if (checkResidualCrownRoot(type,number)){    
                $('#mat-ngoai').addClass('opacity-0'); 
                $('#mat-trong').addClass('opacity-0');          
                $('#mat_ngoai_'+number).prepend('<img id="matngoai-130-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/root'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_trong_'+number).prepend('<img id="mattrong-130-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/root'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');     
            }// end fractured-root-residualCrown

            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove();  
      
        }// fractured-root-residualCrown
        else if(checkResidualCrownRoot(130,number) == 1){
            $("#matngoai-130-"+number).remove();    
            $("#mattrong-130-"+number).remove(); 
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove(); 
            $('#mat-gan').removeClass('opacity-0'); 
            $('#mat-xa').removeClass('opacity-0');     
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-130-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/root'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-130-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/root'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $("#ketluan-"+type+"-"+number).remove(); 
       
        }// end fractured-root-residualCrown
        else{

            // fractured-root-residualCrown
            if (checkRoot(number) == 1){
                $("#matngoai-130-"+number).remove();  
                $("#mattrong-130-"+number).remove();
                $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/residualcrownroot'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/residualcrownroot'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');      
            }// end fractured-root-residualCrown
            else{
                $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/residualcrown'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
                $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/residualcrown'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">'); 
            }       
            $('#mat_gan_'+number).prepend('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/residualcrown'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).prepend('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/residualcrown'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');        
            
            $('#ket_luan_'+number+' i:first-child').after('<i id="ketluan-'+type+"-"+number+'" data-user="'+id_user+'">Răng bể</i>'); 

            lockOfResidualCrown();
            onOpacityZeroType1();
        }

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            
        }  

    }    
    
    convertDentalStatus();    
       
}

function missingStatus(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");

    for (var i = 0; i < data_array.length; i++) {   

        var number = data_array[i];   
        var type=6;
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangmat/", "/rangACTIVE/");
        var rangmat  = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangmat/");   

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }      

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth",type).attr("src", rangmat); 
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>').append('<i id="ketluan-'+type+"-"+number+'" data-user="'+id_user+'">Răng mất</i>'); 
            
        } 

        if ($("#matnhai-"+type+"-"+number).length > 0 && $("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){ 
            unlockAll();
            offOpacityZero();
            $("#matnhai-"+type+"-"+number).remove();
            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove();  
            
        }else{
            lockOfMissing();
            onOpacityZero(); 
            $('#mat_nhai_'+number).prepend('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/missing'+number+'-matnhai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/missing'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/missing'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).prepend('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/missing'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).prepend('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/missing'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');        
                
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            
        } 

    }    
    
    convertDentalStatus();    
}

function veneerComposite(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");

    for (var i = 0; i < data_array.length; i++) {   

        var number = data_array[i];   
        var type=12;
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/Veneer/", "/rangACTIVE/");
        var Veneer  = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/Veneer/"); 

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        } 
      
        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth",3).attr("src", Veneer); 
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            
        } 

        if ($("#matnhai-"+type+"-"+number).length > 0 && $("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){ 
            unlockAll();            

            $("#matnhai-"+type+"-"+number).remove();
            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove();  
            $("#ketluan-"+type+"-"+number).remove(); 
            
        }else{    
            lockOfVeneer();        
 

            if (checkVeneerSu(number) == 1) {
                $("#matnhai-13-"+number).remove();
                $("#matngoai-13-"+number).remove();   
                $("#mattrong-13-"+number).remove();  
                $("#matgan-13-"+number).remove();   
                $("#matxa-13-"+number).remove(); 
                $("#ketluan-13-"+number).remove();  
               
            }

            $('#mat_nhai_'+number).prepend('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/veneercomposite'+number+'-matnhai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/veneercomposite'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/veneercomposite'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).prepend('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/veneercomposite'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).prepend('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/veneercomposite'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');     

            $('#ket_luan_'+number+' i:first-child').after('<i id="ketluan-'+type+"-"+number+'" data-user="'+id_user+'">Veneer composite</i>');     
                
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            
        } 

    }    
    
    convertDentalStatus();    
}

function veneerSu(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");

    for (var i = 0; i < data_array.length; i++) {   

        var number = data_array[i];   
        var type=13;
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/Veneer/", "/rangACTIVE/");
        var Veneer  = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/Veneer/");  

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }
      
        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth",3).attr("src", Veneer); 
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            
        } 

        if ($("#matnhai-"+type+"-"+number).length > 0 && $("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){  
            unlockAll();           
 
            $("#matnhai-"+type+"-"+number).remove();
            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove();  
            $("#ketluan-"+type+"-"+number).remove(); 
            
        }else{   
            lockOfVeneer();         

            if (checkVeneerComposite(number) == 1) {
                $("#matnhai-12-"+number).remove();
                $("#matngoai-12-"+number).remove();   
                $("#mattrong-12-"+number).remove();  
                $("#matgan-12-"+number).remove();   
                $("#matxa-12-"+number).remove(); 
                $("#ketluan-12-"+number).remove();  
            }

            $('#mat_nhai_'+number).prepend('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/veneersu'+number+'-matnhai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/veneersu'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/veneersu'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).prepend('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/veneersu'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).prepend('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/veneersu'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');       

            $('#ket_luan_'+number+' i:first-child').after('<i id="ketluan-'+type+"-"+number+'" data-user="'+id_user+'">Veneer sứ</i>');    
                
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            
        } 

    }    
    
    convertDentalStatus();
    
}

function maoKimLoai(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");

    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i];    
        var type=9;
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/ranggiacodinh/", "/rangACTIVE/");
        var ranggiacodinh  = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/ranggiacodinh/"); 

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }        

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth",2).attr("src", ranggiacodinh); 
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            
        } 

        if ($("#matnhai-"+type+"-"+number).length > 0 && $("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){ 
            unlockAll();
     
            $("#matnhai-"+type+"-"+number).remove();
            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove();  
            $("#ketluan-"+type+"-"+number).remove(); 
            
        }else{
            lockOfCrown();

            if (checkMaoSuKimLoai(number) == 1) {
                $("#matnhai-10-"+number).remove();
                $("#matngoai-10-"+number).remove();   
                $("#mattrong-10-"+number).remove();  
                $("#matgan-10-"+number).remove();   
                $("#matxa-10-"+number).remove(); 
                $("#ketluan-10-"+number).remove();            
            }else if (checkMaoToanSu(number) == 1) {
                $("#matnhai-11-"+number).remove();
                $("#matngoai-11-"+number).remove();   
                $("#mattrong-11-"+number).remove();  
                $("#matgan-11-"+number).remove();   
                $("#matxa-11-"+number).remove();
                $("#ketluan-10-"+number).remove();       
            }            
            
           
            $('#mat_nhai_'+number).prepend('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maokimloai'+number+'-matnhai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');   
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maokimloai'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maokimloai'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).prepend('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maokimloai'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).prepend('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maokimloai'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');        

            $('#ket_luan_'+number+' i:first-child').after('<i id="ketluan-'+type+"-"+number+'" data-user="'+id_user+'">Mão kim loại</i>');  
                
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            
        } 

    }    
    
    convertDentalStatus();
    
}

function maoKimLoaiSSC(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");

    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i];    
        var type=9;
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/ranggiacodinh/", "/rangACTIVE/");
        var ranggiacodinh  = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/ranggiacodinh/"); 

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }        

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth",2).attr("src", ranggiacodinh); 
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            
        } 

        if ($("#matnhai-"+type+"-"+number).length > 0 && $("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){ 
            unlockAll();
     
            $("#matnhai-"+type+"-"+number).remove();
            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove();  
            $("#ketluan-"+type+"-"+number).remove(); 
            
        }else{
            lockOfCrown();

            if (checkMaoToanSu(number) == 1) {
                $("#matnhai-11-"+number).remove();
                $("#matngoai-11-"+number).remove();   
                $("#mattrong-11-"+number).remove();  
                $("#matgan-11-"+number).remove();   
                $("#matxa-11-"+number).remove();        
                $("#ketluan-11-"+number).remove();
            }            
            
           
            $('#mat_nhai_'+number).prepend('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maokimloaissc'+number+'-matnhai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');   
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maokimloaissc'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maokimloaissc'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).prepend('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maokimloaissc'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).prepend('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maokimloaissc'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');   

            $('#ket_luan_'+number+' i:first-child').after('<i id="ketluan-'+type+"-"+number+'" data-user="'+id_user+'">Mão kim loại SSC</i>');       
                
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            
        } 

    }    
    
    convertDentalStatus();
    
}

function maoSuKimLoai(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");

    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i];    
        var type=10;
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/ranggiacodinh/", "/rangACTIVE/");
        var ranggiacodinh  = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/ranggiacodinh/"); 

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }        

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth",2).attr("src", ranggiacodinh); 
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            
        } 

        if ($("#matnhai-"+type+"-"+number).length > 0 && $("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){ 
            unlockAll();
     
            $("#matnhai-"+type+"-"+number).remove();
            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove();  
            $("#ketluan-"+type+"-"+number).remove(); 
            
        }else{
            lockOfCrown();

            if (checkMaoKimLoai(number) == 1) {
                $("#matnhai-9-"+number).remove();
                $("#matngoai-9-"+number).remove();   
                $("#mattrong-9-"+number).remove();  
                $("#matgan-9-"+number).remove();   
                $("#matxa-9-"+number).remove();  
                $("#ketluan-9-"+number).remove();  
            }else if (checkMaoToanSu(number) == 1) {
                $("#matnhai-11-"+number).remove();
                $("#matngoai-11-"+number).remove();   
                $("#mattrong-11-"+number).remove();  
                $("#matgan-11-"+number).remove();   
                $("#matxa-11-"+number).remove();
                $("#ketluan-11-"+number).remove();   
            } 
           
            $('#mat_nhai_'+number).prepend('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maosukimloai'+number+'-matnhai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');   
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maosukimloai'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maosukimloai'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).prepend('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maosukimloai'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).prepend('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maosukimloai'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');        

            $('#ket_luan_'+number+' i:first-child').after('<i id="ketluan-'+type+"-"+number+'" data-user="'+id_user+'">Mão sứ kim loại</i>'); 
                
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            
        } 

    }    
    
    convertDentalStatus();
    
}

function maoToanSu(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");

    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i];    
        var type=11;
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/ranggiacodinh/", "/rangACTIVE/");
        var ranggiacodinh  = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/ranggiacodinh/"); 

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }        

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth",2).attr("src", ranggiacodinh); 
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            
        } 

        if ($("#matnhai-"+type+"-"+number).length > 0 && $("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){ 
            unlockAll();
     
            $("#matnhai-"+type+"-"+number).remove();
            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove();  
            $("#ketluan-"+type+"-"+number).remove(); 
            
        }else{
            lockOfCrown();

            if (checkMaoKimLoai(number) == 1) {
                $("#matnhai-9-"+number).remove();
                $("#matngoai-9-"+number).remove();   
                $("#mattrong-9-"+number).remove();  
                $("#matgan-9-"+number).remove();   
                $("#matxa-9-"+number).remove(); 
                $("#ketluan-9-"+number).remove();
            }else if (checkMaoSuKimLoai(number) == 1) {
                $("#matnhai-10-"+number).remove();
                $("#matngoai-10-"+number).remove();   
                $("#mattrong-10-"+number).remove();  
                $("#matgan-10-"+number).remove();   
                $("#matxa-10-"+number).remove();
                $("#ketluan-10-"+number).remove();
            } 
           
            $('#mat_nhai_'+number).prepend('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/crown'+number+'-matnhai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');   
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/crown'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/crown'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).prepend('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/crown'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).prepend('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/crown'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');  
            $('#ket_luan_'+number+' i:first-child').after('<i id="ketluan-'+type+"-"+number+'" data-user="'+id_user+'">Mão toàn sứ</i>');       
                
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            
        } 

    }    
    
    convertDentalStatus();
    
}

function maoNhua(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");

    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i];    
        var type=11;
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/ranggiacodinh/", "/rangACTIVE/");
        var ranggiacodinh  = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/ranggiacodinh/"); 

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }        

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth",2).attr("src", ranggiacodinh); 
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            
        } 

        if ($("#matnhai-"+type+"-"+number).length > 0 && $("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){ 
            unlockAll();
     
            $("#matnhai-"+type+"-"+number).remove();
            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove();  
            $("#ketluan-"+type+"-"+number).remove(); 
            
        }else{
            lockOfCrown();

            if (checkMaoKimLoai(number) == 1) {
                $("#matnhai-9-"+number).remove();
                $("#matngoai-9-"+number).remove();   
                $("#mattrong-9-"+number).remove();  
                $("#matgan-9-"+number).remove();   
                $("#matxa-9-"+number).remove();    
                $("#ketluan-9-"+number).remove(); 
            }
           
            $('#mat_nhai_'+number).prepend('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maonhua'+number+'-matnhai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');   
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maonhua'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maonhua'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).prepend('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maonhua'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).prepend('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/maonhua'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');        
            
            $('#ket_luan_'+number+' i:first-child').after('<i id="ketluan-'+type+"-"+number+'" data-user="'+id_user+'">Mão nhựa</i>');                
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            
        } 

    }    
    
    convertDentalStatus();
    
}

function ponticToanSu(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");

    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i];  
        var type=16;    
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/vitricauranggia/", "/rangACTIVE/");
        var vitricauranggia  = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/vitricauranggia/"); 

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }    

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth",4).attr("src", vitricauranggia);
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            
        } 

        if ($("#matnhai-"+type+"-"+number).length > 0 && $("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){ 
            unlockAll();
            offOpacityZero();             

            $("#matnhai-"+type+"-"+number).remove();
            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove(); 
            $("#ketluan-"+type+"-"+number).remove();  
            
        }else{
            lockOfPontic();
            onOpacityZero();

            if (checkPonticKimLoai(number) == 1) {
                $("#matnhai-14-"+number).remove();  
                $("#matngoai-14-"+number).remove();   
                $("#mattrong-14-"+number).remove();  
                $("#matgan-14-"+number).remove();   
                $("#matxa-14-"+number).remove();
                $("#ketluan-14-"+number).remove(); 
        
            }else if (checkPonticSuKimLoai(number) == 1) {
                $("#matnhai-15-"+number).remove();  
                $("#matngoai-15-"+number).remove();   
                $("#mattrong-15-"+number).remove();  
                $("#matgan-15-"+number).remove();   
                $("#matxa-15-"+number).remove(); 
                $("#ketluan-15-"+number).remove(); 
           
            }  
           
            $('#mat_nhai_'+number).prepend('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/pontic'+number+'-matnhai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');            
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/pontic'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/pontic'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).prepend('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/pontic'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).prepend('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/pontic'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');   

            $('#ket_luan_'+number+' i:first-child').after('<i id="ketluan-'+type+"-"+number+'" data-user="'+id_user+'">Pontic toàn sứ</i>');          
                
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            
        } 

    }    
    
    convertDentalStatus();
    
}

function ponticKimLoai(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");

    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i];  
        var type=14;    
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/vitricauranggia/", "/rangACTIVE/");
        var vitricauranggia  = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/vitricauranggia/"); 

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }      

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth",4).attr("src", vitricauranggia);
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            
        } 

        if ($("#matnhai-"+type+"-"+number).length > 0 && $("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){ 
            unlockAll();
            offOpacityZero();             

            $("#matnhai-"+type+"-"+number).remove();
            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove(); 
            $("#ketluan-"+type+"-"+number).remove();   
            
        }else{
            lockOfPontic();
            onOpacityZero();

            if (checkPonticSuKimLoai(number) == 1) {
                $("#matnhai-15-"+number).remove();  
                $("#matngoai-15-"+number).remove();   
                $("#mattrong-15-"+number).remove();  
                $("#matgan-15-"+number).remove();   
                $("#matxa-15-"+number).remove();
                $("#ketluan-15-"+number).remove(); 

            }else if (checkPonticToanSu(number) == 1) {
                $("#matnhai-16-"+number).remove();  
                $("#matngoai-16-"+number).remove();   
                $("#mattrong-16-"+number).remove();  
                $("#matgan-16-"+number).remove();   
                $("#matxa-16-"+number).remove(); 
                $("#ketluan-16-"+number).remove(); 
         
            }  
           
            $('#mat_nhai_'+number).prepend('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/pontickimloai'+number+'-matnhai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');            
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/pontickimloai'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/pontickimloai'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).prepend('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/pontickimloai'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).prepend('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/pontickimloai'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">'); 

            $('#ket_luan_'+number+' i:first-child').after('<i id="ketluan-'+type+"-"+number+'" data-user="'+id_user+'">Pontic kim loại</i>');       
                
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE);  
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            
        } 

    }    
    
    convertDentalStatus();
    
}

function ponticSuKimLoai(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");

    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i];  
        var type=15;     
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/vitricauranggia/", "/rangACTIVE/");
        var vitricauranggia  = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/vitricauranggia/");

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }    

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth",4).attr("src", vitricauranggia);
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            
        } 

        if ($("#matnhai-"+type+"-"+number).length > 0 && $("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){ 
            unlockAll();
            offOpacityZero();             

            $("#matnhai-"+type+"-"+number).remove();
            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove();  
            $("#ketluan-"+type+"-"+number).remove(); 
            
        }else{
            lockOfPontic();
            onOpacityZero();

            if (checkPonticKimLoai(number) == 1) {
                $("#matnhai-14-"+number).remove();  
                $("#matngoai-14-"+number).remove();   
                $("#mattrong-14-"+number).remove();  
                $("#matgan-14-"+number).remove();   
                $("#matxa-14-"+number).remove();
                $("#ketluan-14-"+number).remove(); 
      
            }else if (checkPonticToanSu(number) == 1) {
                $("#matnhai-16-"+number).remove();  
                $("#matngoai-16-"+number).remove();   
                $("#mattrong-16-"+number).remove();  
                $("#matgan-16-"+number).remove();   
                $("#matxa-16-"+number).remove(); 
                $("#ketluan-16-"+number).remove(); 
            
            }  
           
            $('#mat_nhai_'+number).prepend('<img id="matnhai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/ponticsukimloai'+number+'-matnhai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');            
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/ponticsukimloai'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/ponticsukimloai'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).prepend('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/ponticsukimloai'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).prepend('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/ponticsukimloai'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');  

            $('#ket_luan_'+number+' i:first-child').after('<i id="ketluan-'+type+"-"+number+'" data-user="'+id_user+'">Pontic sứ kim loại</i>');       
                
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            
        } 

    }    
    
    convertDentalStatus();
    
}

function residualRootStatus(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");

    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i]; 
        var type=7;  
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangbenh/", "/rangACTIVE/");
        var rangbenh = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangbenh/");   

        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }    

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth",type).attr("src", rangbenh);
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            
        } 

        if ($("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){ 
            unlockAll();
            offOpacityZero();    


            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove();  

            $("#ketluan-"+type+"-"+number).remove();  
            
        }else{
            lockOfResidualRoot();
            onOpacityZeroType1();  
          
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/residualroot'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
        $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/residualroot'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
        $('#mat_gan_'+number).prepend('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/residualroot'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
        $('#mat_xa_'+number).prepend('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/residualroot'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');    

            $('#ket_luan_'+number+' i:first-child').after('<i id="ketluan-'+type+"-"+number+'" data-user="'+id_user+'">Còn chân răng</i>');    
                
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE); 
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            
        } 
    }    
    
    convertDentalStatus();
    
}

function implant(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");

    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i];  
        var type=19;
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangphuchoiIMPLANT/", "/rangACTIVE/");
        var rangphuchoiIMPLANT  = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangphuchoiIMPLANT/"); 
        
        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }

        //lock implant status
        if (number == 18 || number == 28 || number == 38 || number == 48){  
            return false;
        }
        //end lock implant status 

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth",8).attr("src", rangphuchoiIMPLANT);
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            
        } 

        if ($("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){ 
            unlockAll();
            offOpacityZero();              

            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove(); 
            $("#ketluan-"+type+"-"+number).remove();  
            
        }else{
            lockOfImplant();
            onOpacityZeroType1();  

            if (checkImplantMao(number) == 1) {
                $("#matngoai-17-"+number).remove();   
                $("#mattrong-17-"+number).remove();  
                $("#matgan-17-"+number).remove();   
                $("#matxa-17-"+number).remove();
                $("#ketluan-17-"+number).remove(); 

            }else if (checkImplantHealing(number) == 1) {
                $("#matngoai-18-"+number).remove();   
                $("#mattrong-18-"+number).remove();  
                $("#matgan-18-"+number).remove();   
                $("#matxa-18-"+number).remove(); 
                $("#ketluan-18-"+number).remove(); 
 
            }            
          
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/implant'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/implant'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).prepend('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/implant'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).prepend('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/implant'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');     

            $('#ket_luan_'+number+' i:first-child').after('<i id="ketluan-'+type+"-"+number+'" data-user="'+id_user+'">Implant</i>');            
                
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE);
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            
        } 
    }    
    
    convertDentalStatus();
    
}

function implantHealing(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");

    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i];  
        var type=18;
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangphuchoiIMPLANT/", "/rangACTIVE/");
        var rangphuchoiIMPLANT  = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangphuchoiIMPLANT/"); 
        
        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }

        //lock implant status
        if (number == 18 || number == 28 || number == 38 || number == 48){  
            return false;
        }
        //end lock implant status 

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth",8).attr("src", rangphuchoiIMPLANT);
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            
        } 

        if ($("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){ 
            unlockAll();
            offOpacityZero();              

            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove();  
            $("#ketluan-"+type+"-"+number).remove();
            
        }else{
            lockOfImplant();
            onOpacityZeroType1();  

            if (checkImplantMao(number) == 1) {
                $("#matngoai-17-"+number).remove();   
                $("#mattrong-17-"+number).remove();  
                $("#matgan-17-"+number).remove();   
                $("#matxa-17-"+number).remove();
                $("#ketluan-17-"+number).remove(); 

            }else if (checkImplant(number) == 1) {
                $("#matngoai-19-"+number).remove();   
                $("#mattrong-19-"+number).remove();  
                $("#matgan-19-"+number).remove();   
                $("#matxa-19-"+number).remove(); 
                $("#ketluan-19-"+number).remove(); 
           
            }            
          
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/implanthealing'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/implanthealing'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).prepend('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/implanthealing'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).prepend('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/implanthealing'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');    

            $('#ket_luan_'+number+' i:first-child').after('<i id="ketluan-'+type+"-"+number+'" data-user="'+id_user+'">Implant + healing</i>');             
                
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE);
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            
        } 
    }    
    
    convertDentalStatus();
    
}

function implantMao(){

    var id_user = $('#id_user').val();

    var string = $('#hidden_string_number').val();

    var data_array = JSON.parse("[" + string + "]");

    for (var i = 0; i < data_array.length; i++) {

        var number = data_array[i];  
        var type=17;
        var rangACTIVE = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangphuchoiIMPLANT/", "/rangACTIVE/");
        var rangphuchoiIMPLANT  = $('#rang-nguoi-lon-'+number).attr("src").replace("/rangACTIVE/", "/rangphuchoiIMPLANT/"); 
        
        if ($('#typeTooth').val() == "Universal") {
            var no = getUniversal(parseInt(number));
        }else {
            var no = number;
        }

        //lock implant status
        if (number == 18 || number == 28 || number == 38 || number == 48){  
            return false;
        }
        //end lock implant status 

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).attr("data-tooth",8).attr("src", rangphuchoiIMPLANT);
            if( $("#ket_luan_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).empty(); }
            $('#ket_luan_'+number).append('<i>Răng '+no+': </i>'); 
            
        } 

        if ($("#matngoai-"+type+"-"+number).length > 0 && $("#mattrong-"+type+"-"+number).length > 0 && $("#matgan-"+type+"-"+number).length > 0 && $("#matxa-"+type+"-"+number).length > 0){ 
            unlockAll();
            offOpacityZero();              

            $("#matngoai-"+type+"-"+number).remove();   
            $("#mattrong-"+type+"-"+number).remove();  
            $("#matgan-"+type+"-"+number).remove();   
            $("#matxa-"+type+"-"+number).remove();
            $("#ketluan-"+type+"-"+number).remove();  
            
        }else{
            lockOfImplant();
            onOpacityZeroType1();     

            if (checkImplantHealing(number) == 1) {
                $("#matngoai-18-"+number).remove();   
                $("#mattrong-18-"+number).remove();  
                $("#matgan-18-"+number).remove();   
                $("#matxa-18-"+number).remove(); 
                $("#ketluan-18-"+number).remove(); 
          
            }else if (checkImplant(number) == 1) {
                $("#matngoai-19-"+number).remove();   
                $("#mattrong-19-"+number).remove();  
                $("#matgan-19-"+number).remove();   
                $("#matxa-19-"+number).remove();
                $("#ketluan-19-"+number).remove(); 

            }          
          
            $('#mat_ngoai_'+number).prepend('<img id="matngoai-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/implantmao'+number+'-matngoai.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_trong_'+number).prepend('<img id="mattrong-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/implantmao'+number+'-mattrong.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_gan_'+number).prepend('<img id="matgan-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/implantmao'+number+'-matgan.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">');
            $('#mat_xa_'+number).prepend('<img id="matxa-'+type+'-'+number+'" src="<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/implantmao'+number+'-matxa.png" style="position: absolute;top: 0;left: 0;width:100%;height: auto;">'); 

            $('#ket_luan_'+number+' i:first-child').after('<i id="ketluan-'+type+"-"+number+'" data-user="'+id_user+'">Implant + mão</i>');                  
                
        }  

        if (checkSick(number) == 0 && checkStatus(number) == 0){
            $('#rang-nguoi-lon-'+number).removeAttr("data-tooth").attr("src", rangACTIVE);
            $('#ket_luan_'+number).empty();
            if( $("#ghi_chu_"+number).is(':empty') ) { }else{ $("#ket_luan_"+number).html('<i>Răng '+no+':</i>'); }
            
        } 
    }    
    
    convertDentalStatus();
    
}

/*End Sidenav*/
$('#table_treatment').click(function(){     
    $('#col-md-3').removeClass('col-md-3 col-lg-4').addClass('col-md-4 col-lg-5');
    $('#triangle').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-top');
    $('.treatment').fadeToggle('fast');
});

$(document).mouseup(function (e)
{
    var container = $(".treatment");
    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {    
        $('#col-md-3').removeClass('col-md-4 col-lg-5').addClass('col-md-3 col-lg-4');
        $('#triangle').removeClass('glyphicon-triangle-top').addClass('glyphicon-triangle-bottom');    
        container.hide();        
    }
     
});

$('#more1').click(function (e) {      
    $('#toggle_more1').fadeToggle('fast');
});
$(document).mouseup(function (e)
{
    var container = $("#toggle_more1");
    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {   
        
        container.hide();        
    }
     
});

$('.tooth').contextmenu(function (e) {

    e.preventDefault();     

    $('#row_opacity').removeClass('opacity-0');
    var position = $( this ).position();  
    var title=$( this ).attr("title");  
    var ret = title.split(" ");
    var number = ret[1]; 

    var str_number =  $('#hidden_string_number').val();   
    var rangACTIVE = $(this).attr("src").replace("/rang/", "/rangACTIVE/"); 
    if(e.shiftKey) { 
        if(str_number){     
            if(checkElementExist(number)){
                $('#hidden_string_number').val(str_number+','+number);
                $(this).attr("src", rangACTIVE);
            }     
        }else{
            $('#hidden_string_number').val(str_number+number);
            $(this).attr("src", rangACTIVE);
        }
    }else{
        $('#hidden_string_number').val(number);  
        $(".tooth").each(function() {  
            if($(this).attr("src").indexOf("/rangACTIVE/") !== -1) { 
                var rang = $(this).attr("src").replace("/rangACTIVE/", "/rang/"); 
                $(this).attr("src", rang);
            }
        });                 
        $(this).attr("src", rangACTIVE);
    }

    var src1 = "<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matnhai-"+number+".png";
    var src2 = "<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matngoai-"+number+".png";
    var src3 = "<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/mattrong-"+number+".png";
    var src4 = "<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matgan-"+number+".png";
    var src5 = "<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matxa-"+number+".png";   
    $('#toggle-dental').css({"top": position.top+25, "left": position.left+25});


    var type = $('#typeTooth').val();  
    var string = $('#hidden_string_number').val();

    if (type == "Universal") {
        title = 'RĂNG '+getUniversal(parseInt(number));
        $('#tooth_number').html("- "+title+" -");
        $('#tooth_title').html("- "+title+" -"); 
        $('.title_sidenav').html(getStringUniversal(string));
    }else {
        $('#tooth_number').html("- "+title+" -");
        $('#tooth_title').html("- "+title+" -");  
        $('.title_sidenav').html(string);
    } 

    var data_array = JSON.parse("[" + string + "]");
    
    for (var i = 0; i < data_array.length; i++) {  

        var number_array = data_array[i];   

        if (($("#mat_nhai_"+number_array).length > 0) && ($("#mat_ngoai_"+number_array).length > 0) && ($("#mat_trong_"+number_array).length > 0) && ($("#mat_gan_"+number_array).length > 0) && ($("#mat_xa_"+number_array).length > 0)){

        }else{
            $('#nhai').append('<div id="mat_nhai_'+number_array+'" class="mat"></div>');
            $('#ngoai').append('<div id="mat_ngoai_'+number_array+'" class="mat"></div>');
            $('#trong').append('<div id="mat_trong_'+number_array+'" class="mat"></div>');
            $('#gan').append('<div id="mat_gan_'+number_array+'" class="mat"></div>');
            $('#xa').append('<div id="mat_xa_'+number_array+'" class="mat"></div>'); 
        } 

        if (($("#ket_luan_"+number_array).length > 0) && ($("#ghi_chu_"+number_array).length > 0)){
            
        }else{          
            $('#div_conclude').prepend('<p id="ghi_chu_'+number_array+'" class="ghi"></p>').prepend('<p id="ket_luan_'+number_array+'" class="ket"></p>');                     
        } 

    }

    $('#hidden_number').val(number);
    $('#mat-nhai').attr("src", src1); 
    $('#mat-ngoai').attr("src", src2);
    $('#mat-trong').attr("src", src3);
    $('#mat-gan').attr("src", src4);
    $('#mat-xa').attr("src", src5);  
    $('.mat').addClass("hidden");
    $('#mat_nhai_'+number).removeClass("hidden");
    $('#mat_ngoai_'+number).removeClass("hidden");
    $('#mat_trong_'+number).removeClass("hidden");
    $('#mat_gan_'+number).removeClass("hidden");
    $('#mat_xa_'+number).removeClass("hidden");  
    $('#toggle-dental').fadeToggle('fast');
    unlockAll();
    offOpacityZero();  

    if (checkMissingStatus(number) == 1) {
        onOpacityZero(); 
        lockOfMissing();                             
    }else if (checkCrownStatus(number) == 1) {        
        lockOfCrown();                             
    }else if (checkVeneerStatus(number) == 1) {        
        lockOfVeneer();                             
    }else if (checkPonticStatus(number) == 1) {
        onOpacityZero();  
        lockOfPontic();
    }else if (checkResidualRootStatus(number) == 1) {
        onOpacityZeroType1();
        lockOfResidualRoot();
    }else if (checkImplantStatus(number) == 1) {
        onOpacityZeroType1();
        lockOfImplant();
    }else if (checkResidualCrownStatus(number) == 1) {
        onOpacityZeroType1();
        lockOfResidualCrown();
    }

    if (checkCrown(number) == 1) {
        $('#mat-nhai').addClass('opacity-0');
    }else if (checkRoot(number) == 1) {
        $('#mat-ngoai').addClass('opacity-0');
        $('#mat-trong').addClass('opacity-0');
    }else if (checkCrownRoot(number) == 1) {
        $('#mat-ngoai').addClass('opacity-0');
        $('#mat-trong').addClass('opacity-0');
    }

    $("#mat_nhai_"+number+" img").each(function() {         
        if ($(this).attr("id").indexOf("fractured-crown") >= 0){
            $('#mat-nhai').addClass('opacity-0');           
        }                 
    });

    $("#mat_ngoai_"+number+" img").each(function() {         
        if ($(this).attr("id").indexOf("fractured-root") >= 0 || $(this).attr("id").indexOf("fractured-crownRoot") >= 0){
            $('#mat-ngoai').addClass('opacity-0');           
        }                 
    });

    $("#mat_trong_"+number+" img").each(function() {         
        if ($(this).attr("id").indexOf("fractured-root") >= 0 || $(this).attr("id").indexOf("fractured-crownRoot") >= 0){
            $('#mat-trong').addClass('opacity-0');           
        }                 
    });  

    e.stopPropagation();    
});
$('.tooth').click(function (e) {  

    $('#row_opacity').removeClass('opacity-0');
    var title=$( this ).attr("title"); 
    var ret = title.split(" ");
    var number = ret[1];

    var str_number =  $('#hidden_string_number').val(); 
    var rangACTIVE = $(this).attr("src").replace("/rang/", "/rangACTIVE/"); 
    if(e.shiftKey) { 
        if(str_number){     
            if(checkElementExist(number)){
                $('#hidden_string_number').val(str_number+','+number);                    
                $(this).attr("src", rangACTIVE);
            }     
        }else{
            $('#hidden_string_number').val(str_number+number);           
            $(this).attr("src", rangACTIVE);
        }
    }else{
        $('#hidden_string_number').val(number);  
        $(".tooth").each(function() {  
            if($(this).attr("src").indexOf("/rangACTIVE/") !== -1) { 
                var rang = $(this).attr("src").replace("/rangACTIVE/", "/rang/"); 
                $(this).attr("src", rang);
            }
        });                 
        $(this).attr("src", rangACTIVE);
    }

    var src1 = "<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matnhai-"+number+".png";
    var src2 = "<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matngoai-"+number+".png";
    var src3 = "<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/mattrong-"+number+".png";
    var src4 = "<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matgan-"+number+".png";
    var src5 = "<?php echo Yii::app()->baseUrl; ?>/images/medical_record/images/rang-nguoi-lon/matxa-"+number+".png";            
    

    var type = $('#typeTooth').val();  
    var string = $('#hidden_string_number').val();

    if (type == "Universal") {
        title = 'RĂNG '+getUniversal(parseInt(number));
        $('#tooth_number').html("- "+title+" -");
        $('#tooth_title').html("- "+title+" -"); 
        $('.title_sidenav').html(getStringUniversal(string));
    }else {
        $('#tooth_number').html("- "+title+" -");
        $('#tooth_title').html("- "+title+" -");  
        $('.title_sidenav').html(string);
    }    

    var data_array = JSON.parse("[" + string + "]");
    
    for (var i = 0; i < data_array.length; i++) {  

        var number_array = data_array[i];   

        if (($("#mat_nhai_"+number_array).length > 0) && ($("#mat_ngoai_"+number_array).length > 0) && ($("#mat_trong_"+number_array).length > 0) && ($("#mat_gan_"+number_array).length > 0) && ($("#mat_xa_"+number_array).length > 0)){

        }else{
            $('#nhai').append('<div id="mat_nhai_'+number_array+'" class="mat"></div>');
            $('#ngoai').append('<div id="mat_ngoai_'+number_array+'" class="mat"></div>');
            $('#trong').append('<div id="mat_trong_'+number_array+'" class="mat"></div>');
            $('#gan').append('<div id="mat_gan_'+number_array+'" class="mat"></div>');
            $('#xa').append('<div id="mat_xa_'+number_array+'" class="mat"></div>'); 
        } 

        if (($("#ket_luan_"+number_array).length > 0) && ($("#ghi_chu_"+number_array).length > 0)){
            
        }else{          
            $('#div_conclude').prepend('<p id="ghi_chu_'+number_array+'" class="ghi"></p>').prepend('<p id="ket_luan_'+number_array+'" class="ket"></p>');           
        } 

    }

    $('#hidden_number').val(number);    
    $('#mat-nhai').attr("src", src1); 
    $('#mat-ngoai').attr("src", src2);
    $('#mat-trong').attr("src", src3);
    $('#mat-gan').attr("src", src4);
    $('#mat-xa').attr("src", src5);
    $('.mat').addClass("hidden");
    $('#mat_nhai_'+number).removeClass("hidden");
    $('#mat_ngoai_'+number).removeClass("hidden");
    $('#mat_trong_'+number).removeClass("hidden");
    $('#mat_gan_'+number).removeClass("hidden");
    $('#mat_xa_'+number).removeClass("hidden"); 
    offOpacityZero();  

    if (checkMissingStatus(number) == 1) {
        onOpacityZero();
        lockOfMissing();                              
    }else if (checkCrownStatus(number) == 1) {        
        lockOfCrown();                             
    }else if (checkVeneerStatus(number) == 1) {        
        lockOfVeneer();                             
    }else if (checkPonticStatus(number) == 1) {
        onOpacityZero();  
        lockOfPontic();
    }else if (checkResidualRootStatus(number) == 1) {
        onOpacityZeroType1();
        lockOfResidualRoot();
    }else if (checkImplantStatus(number) == 1) {
        onOpacityZeroType1();
        lockOfImplant();
    }else if (checkResidualCrownStatus(number) == 1) {
        onOpacityZeroType1();
        lockOfResidualCrown();
    }

    if (checkCrown(number) == 1) {        
        $('#mat-nhai').addClass('opacity-0');
    }else if (checkRoot(number) == 1) {
        $('#mat-ngoai').addClass('opacity-0');
        $('#mat-trong').addClass('opacity-0');
    }else if (checkCrownRoot(number) == 1) {
        $('#mat-ngoai').addClass('opacity-0');
        $('#mat-trong').addClass('opacity-0');
    }
                                     
    $("#mat_nhai_"+number+" img").each(function() {         
        if ($(this).attr("id").indexOf("fractured-crown") >= 0){
            $('#mat-nhai').addClass('opacity-0');           
        }                 
    });

    $("#mat_ngoai_"+number+" img").each(function() {         
        if ($(this).attr("id").indexOf("fractured-root") >= 0 || $(this).attr("id").indexOf("fractured-crownRoot") >= 0){
            $('#mat-ngoai').addClass('opacity-0');           
        }                 
    });

    $("#mat_trong_"+number+" img").each(function() {         
        if ($(this).attr("id").indexOf("fractured-root") >= 0 || $(this).attr("id").indexOf("fractured-crownRoot") >= 0){
            $('#mat-trong').addClass('opacity-0');           
        }                 
    });  

});

// var $set = $('img[data-tooth]');
// var len = $set.length;
// $set.each(function(index, element) {
//     var $this = $(this);
//     if (index == len - 1) {
//         $(this).click();
//     }
// });

$(document).mouseup(function (e)
{
    var container = $("#toggle-dental");
    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {   
        
        container.hide();        
    }
     
});

function clickAddNewTreatment(){

   var id_mhg = $('#id_mhg').val();

   var id_customer = $('#id_customer').val(); 

   if (id_mhg == 0) {    

        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsCustomers/Accounts/addNewTreatment',    
            data: {"id_customer":id_customer},   
            success:function(data){       

                $('#medical_record').html(data);

            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        }); 

   }

}

clickAddNewTreatment();


function unsetSessionAddPrescription(){

    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsCustomers/Accounts/unsetSessionAddPrescription',    
        data: {},   
        success:function(data){ 

        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });

}

function unsetSessionAddLab(){

    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsCustomers/Accounts/unsetSessionAddLab',    
        data: {},   
        success:function(data){ 

        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });

}

function set_null_ipt_id_mh(){ 

    unsetSessionAddPrescription();   

    unsetSessionAddLab();

    $("#treatment_process_title").html('Thêm Quá Trình Điều Trị');

    var evt = window.event || arguments.callee.caller.arguments[0];
    var elem = $('#add-treatment-process-blur')[0];   
    $(elem).fadeToggle(200,function(){});
    evt.stopPropagation();

    $("#id_medical_history").val('');  

    $("#id_cs_medical_history").val(''); 

    $("#id_cs_m3dical_history").val(''); 
}

function setValueExaminationAfter(){    
  
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd='0'+dd
    } 

    if(mm<10) {
        mm='0'+mm
    }     

    var today = mm+'/'+dd+'/'+yyyy;

    var reviewdate_val = $("#reviewdate").val();
    var split          = reviewdate_val.split("-");
    var reviewdate     = split[1]+'/'+split[2]+'/'+split[0]; 

    var date1 = new Date(today);
    var date2 = new Date(reviewdate);
    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

    $("#examination_after").val(diffDays);
    
}

$('#prescriptionModal').on('hidden.bs.modal', function (e) {
    if ($('#add-treatment-process-blur').css('display') == 'none'){

        $('#frm-save-medical-history')[0].reset();
        CKEDITOR.instances.medicalhistoryNewName.setData("");
        $("#frm-prescription")[0].reset();
        CKEDITOR.instances.advise.setData("");
        $("#frm-lab")[0].reset();
        CKEDITOR.instances.n0te.setData("");
        $("#action-prescription").replaceWith(aClone.clone());
        $("#action-lab").replaceWith(aLabClone.clone());   
        $("#dntd").replaceWith(divClone.clone());           

    }
})

$('#labModal').on('hidden.bs.modal', function (e) {
    if ($('#add-treatment-process-blur').css('display') == 'none'){

        $('#frm-save-medical-history')[0].reset();
        CKEDITOR.instances.medicalhistoryNewName.setData("");
        $("#frm-prescription")[0].reset();
        CKEDITOR.instances.advise.setData("");
        $("#frm-lab")[0].reset();
        CKEDITOR.instances.n0te.setData("");
        $("#action-prescription").replaceWith(aClone.clone());
        $("#action-lab").replaceWith(aLabClone.clone());   
        $("#dntd").replaceWith(divClone.clone());           

    }
})

function viewPrescriptionAndLab(id,type){       

    var evt = window.event || arguments.callee.caller.arguments[0];
    if (type == 1) {
        $('#prescriptionModal').modal('show'); 
    }else{
        $('#labModal').modal('show'); 
    }       
    evt.stopPropagation();    

    jQuery.ajax({
        type:"POST",
        url: baseUrl+'/itemsCustomers/Accounts/view_frm_treatment',
        data:{
            id  : id,
        },
        success:function(data){ 
            var getData = $.parseJSON(data);           
            if(getData){                
                $("#id_medical_history").val(getData.id);
                $("#id_cs_medical_history").val(getData.id);
                $("#id_cs_m3dical_history").val(getData.id);
                $("#id_dentist").val(getData.id_dentist);                 
                $("#medicalhistoryToothNumber").val(getData.tooth_number);                
                CKEDITOR.instances['medicalhistoryNewName'].setData(getData.name);                        
                $("#description").val(getData.description);                   
                $("#length_time").val(getData.length_time); 
                $("#medicine_during_treatment").val(getData.medicine_during_treatment);
                if (getData.reviewdate != '0000-00-00 00:00:00') {                                   
                    $("#reviewdate").val(getData.reviewdate);    
                }    
                if (getData.diagnose != null) {
                    $("#action-prescription").html('Xem toa thuốc');
                    $(".print").css('background-color','#94c63f');    
                }
                if (getData.id_branch != null) { 
                    $("#action-lab").html('Xem lab'); 
                    $(".print_lab").css('background-color','#94c63f');
                    var sent_date     = getData.sent_date.substr(0,10); 
                    var received_date = getData.received_date.substr(0,10); 
                    $("#sent_date").val(sent_date);
                    $("#received_date").val(received_date);
                }         
                $("#diagnose").val(getData.diagnose);
                CKEDITOR.instances['advise'].setData(getData.advise);   
                $("#examination_after").val(getData.examination_after); 
                //List Drug And Usage
                if(getData.listDrugAndUsage != ''){  
                    var listDrugAndUsage = getData.listDrugAndUsage; 
                    var str = '';
                    var data_drug = 1;
                    $.each(listDrugAndUsage, function(i, item) {     
                        data_drug = data_drug + parseInt(i);                                                           
                        if (data_drug == 1) {
                            str = str+'<div data-drug="'+data_drug+'"><div class="input-group"><span class="input-group-addon spn-dots">'+data_drug+'.</span><input required type="text" class="form-control ipt-dots" name="drug_name[]" value="'+listDrugAndUsage[i].drug_name+'"></div><div class="input-group"><span class="input-group-addon dots spn-dots">Sáng:</span><input type="number" class="form-control ipt-dots text-align-center" name="morning[]" value="'+listDrugAndUsage[i].morning+'"><span class="input-group-addon dots spn-dots">Trưa:</span><input type="number" class="form-control ipt-dots text-align-center" name="noon[]" value="'+listDrugAndUsage[i].noon+'"><span class="input-group-addon dots spn-dots">Chiều:</span><input type="number" class="form-control ipt-dots text-align-center" name="afternoon[]" value="'+listDrugAndUsage[i].afternoon+'"><span class="input-group-addon dots spn-dots">Tối:</span><input type="number" class="form-control ipt-dots text-align-center" name="night[]" value="'+listDrugAndUsage[i].night+'"></div></div>';
                        }else {
                            str = str+'<div data-drug="'+data_drug+'"><div class="input-group"><span class="input-group-addon spn-dots">'+data_drug+'.</span><input required type="text" class="form-control ipt-dots" name="drug_name[]" value="'+listDrugAndUsage[i].drug_name+'"></div><div class="input-group"><span class="input-group-addon dots spn-dots">Sáng:</span><input type="number" class="form-control ipt-dots text-align-center" name="morning[]" value="'+listDrugAndUsage[i].morning+'"><span class="input-group-addon dots spn-dots">Trưa:</span><input type="number" class="form-control ipt-dots text-align-center" name="noon[]" value="'+listDrugAndUsage[i].noon+'"><span class="input-group-addon dots spn-dots">Chiều:</span><input type="number" class="form-control ipt-dots text-align-center" name="afternoon[]" value="'+listDrugAndUsage[i].afternoon+'"><span class="input-group-addon dots spn-dots">Tối:</span><input type="number" class="form-control ipt-dots text-align-center" name="night[]" value="'+listDrugAndUsage[i].night+'"><div class="input-group-addon dots spn-dots"><button onclick="minusDelete('+data_drug+');" class="btn sbtnAdd"><span class="glyphicon glyphicon-minus"></span></button></div></div></div>';
                        }  
                    });
                    $('#dntd').html(str);
                }
                //End List Drug And Usage
                $("#id_br4nch").val(getData.id_branch);
                $("#id_d3ntist").val(getData.id_d3ntist);                
                $("#assign").val(getData.assign);
                CKEDITOR.instances['n0te'].setData(getData.note);  
                                      
            }
        },
        error: function(data){ 
            alert("Error occured.Please try again!");
        },
    });
}

function view_frm_treatment(id){   

    $("#treatment_process_title").html('Cập Nhật Quá Trình Điều Trị');

    var evt = window.event || arguments.callee.caller.arguments[0];
    var elem = $('#add-treatment-process-blur')[0];
    $(elem).fadeToggle(200,function(){});
    evt.stopPropagation();

    jQuery.ajax({
        type:"POST",
        url: baseUrl+'/itemsCustomers/Accounts/view_frm_treatment',
        data:{
            id  : id,
        },
        success:function(data){ 
            var getData = $.parseJSON(data);           
            if(getData){                
                $("#id_medical_history").val(getData.id);
                $("#id_cs_medical_history").val(getData.id);
                $("#id_cs_m3dical_history").val(getData.id);
                $("#id_dentist").val(getData.id_dentist);                 
                $("#medicalhistoryToothNumber").val(getData.tooth_number);                
                CKEDITOR.instances['medicalhistoryNewName'].setData(getData.name);                
                $("#description").val(getData.description);   
                $("#length_time").val(getData.length_time); 
                $("#medicine_during_treatment").val(getData.medicine_during_treatment);
                if (getData.reviewdate != '0000-00-00 00:00:00') {                                   
                    $("#reviewdate").val(getData.reviewdate);    
                }    
                if (getData.diagnose != null) $("#action-prescription").html('Xem toa thuốc'); 
                if (getData.id_branch != null) {
                    $("#action-lab").html('Xem lab');   
                    var sent_date     = getData.sent_date.substr(0,10); 
                    var received_date = getData.received_date.substr(0,10); 
                    $("#sent_date").val(sent_date);
                    $("#received_date").val(received_date);                 
                }                   
                $("#diagnose").val(getData.diagnose);
                CKEDITOR.instances['advise'].setData(getData.advise);   
                $("#examination_after").val(getData.examination_after); 
                //List Drug And Usage
                if(getData.listDrugAndUsage != ''){  
                    var listDrugAndUsage = getData.listDrugAndUsage; 
                    var str = '';
                    var data_drug = 1;
                    $.each(listDrugAndUsage, function(i, item) {     
                        data_drug = data_drug + parseInt(i); 
                        if (data_drug == 1) {
                            str = str+'<div data-drug="'+data_drug+'"><div class="input-group"><span class="input-group-addon spn-dots">'+data_drug+'.</span><input required type="text" class="form-control ipt-dots" name="drug_name[]" value="'+listDrugAndUsage[i].drug_name+'"></div><div class="input-group"><span class="input-group-addon dots spn-dots">Sáng:</span><input type="number" class="form-control ipt-dots text-align-center" name="morning[]" value="'+listDrugAndUsage[i].morning+'"><span class="input-group-addon dots spn-dots">Trưa:</span><input type="number" class="form-control ipt-dots text-align-center" name="noon[]" value="'+listDrugAndUsage[i].noon+'"><span class="input-group-addon dots spn-dots">Chiều:</span><input type="number" class="form-control ipt-dots text-align-center" name="afternoon[]" value="'+listDrugAndUsage[i].afternoon+'"><span class="input-group-addon dots spn-dots">Tối:</span><input type="number" class="form-control ipt-dots text-align-center" name="night[]" value="'+listDrugAndUsage[i].night+'"></div></div>';
                        }else {
                            str = str+'<div data-drug="'+data_drug+'"><div class="input-group"><span class="input-group-addon spn-dots">'+data_drug+'.</span><input required type="text" class="form-control ipt-dots" name="drug_name[]" value="'+listDrugAndUsage[i].drug_name+'"></div><div class="input-group"><span class="input-group-addon dots spn-dots">Sáng:</span><input type="number" class="form-control ipt-dots text-align-center" name="morning[]" value="'+listDrugAndUsage[i].morning+'"><span class="input-group-addon dots spn-dots">Trưa:</span><input type="number" class="form-control ipt-dots text-align-center" name="noon[]" value="'+listDrugAndUsage[i].noon+'"><span class="input-group-addon dots spn-dots">Chiều:</span><input type="number" class="form-control ipt-dots text-align-center" name="afternoon[]" value="'+listDrugAndUsage[i].afternoon+'"><span class="input-group-addon dots spn-dots">Tối:</span><input type="number" class="form-control ipt-dots text-align-center" name="night[]" value="'+listDrugAndUsage[i].night+'"><div class="input-group-addon dots spn-dots"><button onclick="minusDelete('+data_drug+');" class="btn sbtnAdd"><span class="glyphicon glyphicon-minus"></span></button></div></div></div>';
                        }                           
                    });
                    $('#dntd').html(str);
                }
                //End List Drug And Usage
                $("#id_br4nch").val(getData.id_branch);
                $("#id_labo_elite").val(getData.id_labo_elite);                
                $("#assign").val(getData.assign);
                CKEDITOR.instances['n0te'].setData(getData.note);  
                                      
            }
        },
        error: function(data){ 
            alert("Error occured.Please try again!");
        },
    });
}


$('#frm-treatment').submit(function(e) {

    $('.cal-loading').fadeIn('fast');

    e.preventDefault();
    var formData = new FormData($("#frm-treatment")[0]);
    formData.append('id_customer',$('#id_customer').val());
    formData.append('id_mhg',$('#id_mhg').val());
    if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({           
            type:"POST",
            url: baseUrl+'/itemsCustomers/Accounts/addNewMedicalHistory',   
            data:formData,
            datatype:'json',
            success:function(data){  
 
                e.stopPropagation(); 

                $('#medical_record').html(data);

                $('.cal-loading').fadeOut('slow');
         
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

$('#edit_info').click(function (e) { 

    $('.cal-loading').fadeIn('fast');

    var id_customer = $('#id_customer').val();  
    var id_mhg = $('#id_mhg').val(); 

    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsCustomers/Accounts/editMedicalHistory',    
        data: {"id_customer":id_customer,"id_mhg":id_mhg},   
        success:function(data){       

            $('#frm-treatment').html(data);

            $('.cal-loading').fadeOut('slow');
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });

});

$('#save').click(function (e) { 

    var dental_status_change = $('#dental_status_change').val();

    if (dental_status_change == 1) {

        $('.cal-loading').fadeIn('fast');

        var id_customer    = $('#id_customer').val();   
        var id_mhg         = $('#id_mhg').val(); 
        var tooth_data     = [];
        var tooth_image    = [];
        var tooth_conclude = [];
        var tooth_note     = [];  

        $(".tooth").each(function() {  
            if($(this).attr("data-tooth")) { 
                var title=$(this).attr("title"); 
                var ret = title.split(" ");
                var number = ret[1]; 
                var response = {};
                response['tooth_number'] = number; 
                response['tooth_data'] = $(this).attr("data-tooth");        
                tooth_data.push(response);  
            }
        });
        
        $(".mat img").each(function() { 
            var tit=$(this).attr("id"); 
            var re = tit.split("-");        
            var num = re[2];   
            var res = {};
            res['tooth_number'] = num; 
            res['id_image']     = tit;        
            res['src_image']    = $(this).attr("src").replace(/^.*[\\\/]/, '');  
            res['type_image']   = re[0]; 
            res['style_image']  = $(this).attr("style");    
            tooth_image.push(res);
        });

        $(".ket i").each(function() {   
            if($(this).attr("id")) {       
                var id_i = $(this).attr("id"); 
                var r_i  = id_i.split("-"); 
                if (r_i[0] == "ketluan") {              
                    var rp_i = {};
                    rp_i['tooth_number'] = r_i[2];    
                    rp_i['id_i']         = id_i;     
                    rp_i['conclude']     = $(this).html();  
                    rp_i['id_user']      = $(this).attr("data-user");             
                    tooth_conclude.push(rp_i);  
                }
            }          
        }); 

        $(".ghi").each(function() { 
            if($(this).html()) {            
                var id=$(this).attr("id"); 
                var r = id.split("_"); 
                var note = $(this).html();
                if (note != "") {
                    var split_note = note.split(":");
                    note           = split_note[1]; 
                }
                var rp = {};
                rp['tooth_number']  = r[2];       
                rp['note']          = note;    
                tooth_note.push(rp);      
            }      
        });         
     
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsCustomers/Accounts/addDentalStatus',    
            data: {"id_customer":id_customer,"id_mhg":id_mhg,"tooth_data":JSON.stringify(tooth_data),"tooth_image":JSON.stringify(tooth_image),"tooth_conclude":JSON.stringify(tooth_conclude),"tooth_note":JSON.stringify(tooth_note)},   
            success:function(data){    
       
                $('#medical_record').html(data); 

                $('.cal-loading').fadeOut('slow');              
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });

    }    

});

$('#div_conclude').bind("DOMSubtreeModified",function(){
    var imageUrl='../../images/medical_record/more_icon/sale_3.png';
    $('#dental_status_change').val(1);    
    $('#save').css('background-image', 'url(' + imageUrl + ')');
    confirmWinClose();
});

function checkExistImage(){ 
    var image_dental_status_change = $('#image_dental_status_change').val(); 
    if (image_dental_status_change == 1) {

        var imageUrl='../../images/medical_record/more_icon/draw_2.png';
        $('#draw').css('background-image', 'url(' + imageUrl + ')');    

    }  
}
checkExistImage();


function updateEvaluateStateOfTartar(id){ 
    
    var id_customer = $('#id_customer').val(); 
    var evaluate_state_of_tartar=$('#evaluate_state_of_tartar').val();
   
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsCustomers/Accounts/updateEvaluateStateOfTartar', 
        data: {"id":id,"evaluate_state_of_tartar":evaluate_state_of_tartar},   
        success:function(data){ 
           
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });
}

function checkAddNewTreatment(){

    var id_mhg = $('#id_mhg').val();

    var check_add_new_treatment =  $('#check_add_new_treatment').html();

    if(id_mhg == 0 || check_add_new_treatment != 0){
        
        $('#add_new_treatment').removeClass('background-666'); 
        $('#add_new_treatment').addClass('background-9CC34D');              

    }else{

        $('#add_new_treatment').removeClass('background-9CC34D');
        $('#add_new_treatment').addClass('background-666');

    } 
}
checkAddNewTreatment();


$('#add_new_treatment').click(function (e) {     

    var id_mhg = $('#id_mhg').val();

    var check_add_new_treatment =  $('#check_add_new_treatment').html();

    if(id_mhg == 0 || check_add_new_treatment != 0){

        $('.cal-loading').fadeIn('fast');

        var id_customer = $('#id_customer').val();  

        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsCustomers/Accounts/addNewTreatment',    
            data: {"id_customer":id_customer},   
            success:function(data){       

                $('#medical_record').html(data);

                $('.cal-loading').fadeOut('slow');

            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });

    }else{
        return false;
    } 

});

function error_save_medical_history(){

    var status = true;    

    CKEDITOR.instances.medicalhistoryNewName.updateElement(); 
    if(document.getElementById( 'medicalhistoryNewName' ).value == ''){       
        $.notify("Vui lòng nhập chi tiết điều trị.", "error");       
        status = false;
    }    

    return status;
}

$('#frm-save-medical-history').submit(function(e) {

    if(error_save_medical_history()){ 

        $('.cal-loading').fadeIn('fast');

        e.preventDefault();
        var formData = new FormData($("#frm-save-medical-history")[0]);  
        CKEDITOR.instances.medicalhistoryNewName.updateElement(); 
        formData.append('medicalhistoryNewName',document.getElementById( 'medicalhistoryNewName' ).value); 
        formData.append('id_customer',$('#id_customer').val());   
        formData.append('id_history_group',$('#id_mhg').val()); 
        if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({           
                type:"POST",
                url: baseUrl+'/itemsCustomers/Accounts/saveMedicalHistory',   
                data:formData,
                datatype:'json',
                success:function(data){    
                    if (data == -1) {                       
                        alert("Nha sỹ không làm việc!");   
                        e.stopPropagation();                        
                        $('.cal-loading').fadeOut('slow');
                        return false;       
                    }else if (data == -2) {
                        alert("Có lịch hẹn trùng!");    
                        e.stopPropagation();        
                        $('.cal-loading').fadeOut('slow');
                        return false;
                    }else{

                        $('#frm-save-medical-history')[0].reset();
                        CKEDITOR.instances.medicalhistoryNewName.setData("");
                        $("#frm-prescription")[0].reset();
                        CKEDITOR.instances.advise.setData("");
                        $("#frm-lab")[0].reset();
                        CKEDITOR.instances.n0te.setData("");
                        $("#action-prescription").replaceWith(aClone.clone());
                        $("#action-lab").replaceWith(aLabClone.clone());
                        $("#dntd").replaceWith(divClone.clone());          
                        $('#medical_history').html(data); 
                        templock = 1;
                        $($('#add-treatment-process-blur')[0]).fadeToggle(200,function(){
                            templock = 0;
                        });

                        e.stopPropagation();  
                        $('.cal-loading').fadeOut('slow');

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

    }    
});

$('#upAdd').click(function (e) { 

    e.preventDefault();

    var lastDataDrug = $('#dntd > div').last().data('drug');
    var data_drug    = lastDataDrug + 1;

    $('#dntd').append($('<div data-drug="'+data_drug+'">')
                .append($('<div class="input-group">')
                    .append('<span class="input-group-addon spn-dots">'+data_drug+'.</span>')
                    .append('<input required type="text" class="form-control ipt-dots" name="drug_name[]">')
                )                
                .append($('<div class="input-group">')
                    .append('<span class="input-group-addon dots spn-dots">Sáng:</span>')
                    .append('<input type="number" class="form-control ipt-dots text-align-center" name="morning[]">')
                    .append('<span class="input-group-addon dots spn-dots">Trưa:</span>')
                    .append('<input type="number" class="form-control ipt-dots text-align-center" name="noon[]">')
                    .append('<span class="input-group-addon dots spn-dots">Chiều:</span>')
                    .append('<input type="number" class="form-control ipt-dots text-align-center" name="afternoon[]">')
                    .append('<span class="input-group-addon dots spn-dots">Tối:</span>')
                    .append('<input type="number" class="form-control ipt-dots text-align-center" name="night[]">')
                    .append($('<div class="input-group-addon dots spn-dots">')
                        .append($('<button onclick="minusDelete('+data_drug+');" class="btn sbtnAdd">')
                            .append('<span class="glyphicon glyphicon-minus"></span>')
                            )
                        )
                )
                ); 

    e.stopPropagation();
});

function minusDelete(data_drug){
    
    var evt = window.event || arguments.callee.caller.arguments[0];

    evt.preventDefault();  

    $('div[data-drug]').each(function(index, element) {         
      
        if ( $(this).attr('data-drug') == data_drug ) {    

          $(this).remove();

        }

    });

    evt.stopPropagation();
}

$('#frm-prescription').submit(function(e) {

    $('.cal-loading').fadeIn('fast');

    e.preventDefault();
    var formData = new FormData($("#frm-prescription")[0]);
    CKEDITOR.instances.advise.updateElement(); 
    formData.append('advise',document.getElementById( 'advise' ).value); 
    formData.append('id_history_group',$('#id_mhg').val()); 
    if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({           
            type:"POST",
            url: baseUrl+'/itemsCustomers/Accounts/setSessionAddPrescription',   
            data:formData,
            datatype:'json',
            success:function(data){  
                e.stopPropagation(); 
                $('#prescriptionModal').modal('hide');  
                $('.cal-loading').fadeOut('slow');         
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

$('#frm-lab').submit(function(e) {

    $('.cal-loading').fadeIn('fast');

    e.preventDefault();
    var formData = new FormData($("#frm-lab")[0]);
    CKEDITOR.instances.n0te.updateElement(); 
    formData.append('note',document.getElementById( 'n0te' ).value); 
    formData.append('id_history_group',$('#id_mhg').val()); 
    if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({           
            type:"POST",
            url: baseUrl+'/itemsCustomers/Accounts/setSessionAddLab',   
            data:formData,
            datatype:'json',
            success:function(data){  
                e.stopPropagation(); 
                $('#labModal').modal('hide');  
                $('.cal-loading').fadeOut('slow');         
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

function deleteMedicalHistory(id){

    var evt = window.event || arguments.callee.caller.arguments[0];    
    evt.stopPropagation();

    if (confirm("Bạn có thật sự muốn xóa?")) { 

        $('.cal-loading').fadeIn('fast');

        var id_history_group = $('#id_mhg').val(); 

        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsCustomers/Accounts/deleteMedicalHistory',     
            data: {"id":id,"id_history_group":id_history_group},   
            success:function(data){
                               
                $('#medical_history').html(data); 

                $('.cal-loading').fadeOut('slow');
                                
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });
    }      
}


function showPluploadMaster(){
      
    var elem = $('#plupload-master-blur')[0];

      
    $('#draw').on('click',function(e){
        $(elem).fadeToggle(200,function(){
        }); 
        e.stopPropagation();
    });
    
    $('body').on('click',function(e){
        if(templock == 0){
            if($(e.target).closest($('#plupload-master-container')).length === 0){
                if($(elem).is(':visible')){
                    templock = 1;   
                    $(elem).fadeToggle(200,function(){
                        templock = 0;
                    }); 
                }
            }
        }
    });
    
    $('.btn_close').on('click',function(e){
        if(templock == 0){                   
                if($(elem).is(':visible')){
                    templock = 1;   
                    $(elem).fadeToggle(200,function(){
                        templock = 0;
                    }); 
                }                    
        }
    });

    $( document ).on( 'keydown', function ( e ) {
        if(templock == 0){
            if($(elem).is(':visible')){
                if ( e.keyCode === 27 ) {
                    templock = 1;
                    $(elem).fadeToggle(200,function(){
                        templock = 0;
                    }); 
                }
            }
        }
    });
}
showPluploadMaster();

$('#note').click(function(){ 
    var position = $( this ).position();  
    $('#notePopup').css({"top": position.top+25, "left": position.left+25});
    $('#notePopup').fadeToggle('fast');
});
$('#ic_close').click(function(){ 
    $('#notePopup').hide(); 
});
$(function() {   

    $(document).mouseup(function (e)
    {
        var container = $("#notePopup");

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $('#notePopup').hide();            
        }
               
    });
        
});

function showPopupMedicalHistory(){

var elem = $('#add-treatment-process-blur')[0];

$('body').on('click',function(e){
    if(templock == 0){
        if($(e.target).closest($('#addnewMedicalHistoryPopup')).length === 0 && $(e.target).closest($('#prescriptionModal')).length === 0 && $(e.target).closest($('#labModal')).length === 0 && $(e.target).closest($('#ui-datepicker-div')).length === 0 && $(e.target).closest($('.daterangepicker')).length === 0){   
            if($(elem).is(':visible')){
             
                $('#frm-save-medical-history')[0].reset();
                CKEDITOR.instances.medicalhistoryNewName.setData("");
                $("#frm-prescription")[0].reset();
                CKEDITOR.instances.advise.setData("");
                $("#frm-lab")[0].reset();
                CKEDITOR.instances.n0te.setData("");
                $("#action-prescription").replaceWith(aClone.clone());
                $("#action-lab").replaceWith(aLabClone.clone());                
                $("#dntd").replaceWith(divClone.clone());
                templock = 1;
                $(elem).fadeToggle(200,function(){
                    templock = 0;
                });

            }      
        }
    }
});

$('.close_tp').on('click',function(e){
    if(templock == 0){                   
            if($(elem).is(':visible')){

                $('#frm-save-medical-history')[0].reset();
                CKEDITOR.instances.medicalhistoryNewName.setData("");
                $("#frm-prescription")[0].reset();
                CKEDITOR.instances.advise.setData("");
                $("#frm-lab")[0].reset();
                CKEDITOR.instances.n0te.setData("");
                $("#action-prescription").replaceWith(aClone.clone());
                $("#action-lab").replaceWith(aLabClone.clone());  
                $("#dntd").replaceWith(divClone.clone()); 
                templock = 1;   
                $(elem).fadeToggle(200,function(){
                    templock = 0;
                }); 

            }                    
    }
});

$( document ).on( 'keydown', function ( e ) {
    if(templock == 0){
        if($(elem).is(':visible')){
            if ( e.keyCode === 27 ) {
                templock = 1;
                $(elem).fadeToggle(200,function(){
                    templock = 0;
                });
            }
        }
    }
});

}
showPopupMedicalHistory();

$(function() {
    $( "#iptSearchBirthdate" ).datepicker({
        changeMonth: true,
        changeYear: true,       
        dateFormat: 'yy-mm-dd',
        yearRange: '1900:+0'
    });
    $( "#birthdate" ).datepicker({
        changeMonth: true,
        changeYear: true,       
        dateFormat: 'dd/mm/yy',
        yearRange: '1900:+0'
    });
    $( "#startdate" ).datepicker({
        changeMonth: true,
        changeYear: true,       
        dateFormat: 'yy-mm-dd'
    });
    $( "#enddate" ).datepicker({
        changeMonth: true,
        changeYear: true,       
        dateFormat: 'yy-mm-dd'
    });
    /*** reviewdate ***/
    $('input[name="reviewdate"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        timePicker: true,
        autoApply: true,
        locale: {
            format: 'YYYY-MM-DD HH:mm:ss',
        }
    }, 
    function(start, end, label) {
        
       
    });   
    $('input[name="reviewdate"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
    $( "#reviewdate" ).val('');
    /*** end reviewdate ***/
    $( "#sent_date" ).datepicker({
        changeMonth: true,
        changeYear: true,       
        dateFormat: 'yy-mm-dd'
    });
    $( "#received_date" ).datepicker({
        changeMonth: true,
        changeYear: true,       
        dateFormat: 'yy-mm-dd'
    });
});

// modal báo giá
$( document ).ready(function() {  

    $('#oAdds').click(function (e) {        
        e.preventDefault(); 
        x = 1;
        $('.currentRow').nextAll('tr').remove();
        $('.sNote').show();
        $('#sAddNote').addClass('hidden');
        
        if($('.sItem tr:last').find('.group').val()){
            $('.newbtnAdd').addClass('btn_bookoke').removeClass('btn_unactive');
        }
    });

    var id_customer = $('#id_customer').val();
    var id_mhg      = $('#id_mhg').val();  
    var id_schedule  = $('#id_schedule').val();

    if($('#quote_modal div').length == 0){   
        
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/quotations/create',    
            data: {"id_customer":id_customer,"id_mhg":id_mhg,"id_schedule":id_schedule},   
            success:function(data){ 
                $('#quote_modal').html(data);                 
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    };


    /*update quotations*/ 
    $('.oUpdates').on('click',function(e){     
            
        var id_quotation = $('#id_quotation').val();
        var id_schedule  = $('#id_schedule').val();
        
        if(!id_quotation)
            return;     

        $.ajax({ 
            type:"POST",           
            url: baseUrl+'/itemsSales/quotations/updateQuotation',
            data: {
                id_quotation: id_quotation,
                id_schedule: id_schedule
            },
            success:function(data){
                
                if(data){
                    $("#update_quote_modal").html(data);
                        dentistList();
                        productList();
                        serviceList();
                }
                $('.cal-loading').fadeOut('slow');
            },
            error: function(data) {
                alert("Error occured.Please try again!");
            },
           
        });
    });

});

$( document ).ready(function() {

    $('.print').on('click',function(e){

        var id_customer        = $("#id_customer").val();

        var id_cs_medical_history = $("#id_cs_medical_history").val();   

        if (id_cs_medical_history) {
            var url="<?php echo CController::createUrl('Accounts/exportPrescription')?>?id_customer="+id_customer+"&id_medical_history="+id_cs_medical_history;
            window.open(url,'name') 
        };
                      
    });

    $('.print_lab').on('click',function(e){

        var id_customer        = $("#id_customer").val();

        var id_cs_m3dical_history = $("#id_cs_m3dical_history").val();   

        if (id_cs_m3dical_history) {
            var url="<?php echo CController::createUrl('Accounts/exportLab')?>?id_customer="+id_customer+"&id_medical_history="+id_cs_m3dical_history;
            window.open(url,'name') 
        };
                      
    });

});


/* Plupload-master */

// Initialize the widget when the DOM is ready
$(function() {   
    $("#uploader").plupload({        
        // General settings
        runtimes : 'html5,flash,silverlight,html4',
        url: baseUrl+'/itemsCustomers/Accounts/upload',
        multipart_params: {code_number : <?php echo $model->code_number;?>,id_customer : $('#id_customer').val(),id_mhg : $('#id_mhg').val()},        
        // User can upload no more then 20 files in one go (sets multiple_queues to false)
        max_file_count: 20,
        
        chunk_size: '1mb',
        preinit: attachCallbacks,

        // Resize images on clientside if we can
        resize : {
            width : 200, 
            height : 200, 
            quality : 90,
            crop: true // crop to exact dimensions
        },
        
        filters : {
            // Maximum file size
            max_file_size : '1000mb',
            // Specify what files to browse for
            mime_types: [
                {title : "Image files", extensions : "jpg,gif,png"},
                {title : "Zip files", extensions : "zip"}
            ]
        },

        // Rename files by clicking on their titles
        rename: true,
        
        // Sort files
        sortable: true,

        // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
        dragdrop: true,

        // Views to activate
        views: {
            list: true,
            thumbs: true, // Show thumbs
            active: 'list'
        },

        // Flash settings
        flash_swf_url : '../../js/Moxie.swf',

        // Silverlight settings
        silverlight_xap_url : '../../js/Moxie.xap'
    });


    // Handle the case when form was submitted before uploading has finished
    $('#form').submit(function(e) {
        // Files in queue upload them first
        if ($('#uploader').plupload('getFiles').length > 0) {

            // When all files are uploaded submit form
            $('#uploader').on('complete', function() {
                $('#form')[0].submit();                
            });

            $('#uploader').plupload('start');
        } else {
            alert("You must have at least one file in the queue.");
        }
        return false; // Keep the form from submitting
    });


    <?php 
    $dir = Yii::app()->basePath."/../upload/customer/dental_status/".$model->code_number;
    if(is_dir($dir))
    {
    ?>


        var dir = baseUrl+"/upload/customer/dental_status/"+<?php echo $model->code_number;?>+"/";
        var id_customer = $('#id_customer').val();
        var id_mhg      = $('#id_mhg').val();
   
        $.ajax({
            //This will retrieve the contents of the folder if the folder is configured as 'browsable'  
            type:"POST",
            url: baseUrl+'/itemsCustomers/Accounts/view_medical_image',        
            data: {"id_customer":id_customer,"id_mhg":id_mhg}, 
            success: function (data) {
  
            var getData = $.parseJSON(data);   
       
            if(getData){   

                //List all .png file names in the page
                $.each(getData, function(i, item) {

                    $(document).ready(function(){ // AUTO LOAD IMAGES        
                        plupload = $("#uploader").plupload('getUploader');
                        var img = new mOxie.Image();            
                        var url = o.resolveUrl(dir + getData[i].name);   

                        img.onload = function() {
                            plupload.addFile(img.getAsBlob());
                        }        

                        img.load(url); 
                 
                    });

                });             
                                    
            }


                
            }
        });

    <?php 
    }
    ?>

});

function attachCallbacks(Uploader) {    

    Uploader.bind('FileUploaded', function(Up, File, Response) {
     
      if( (Uploader.total.uploaded + 1) == Uploader.files.length)
      {           
           dataReponse = jQuery.parseJSON(JSON.stringify(Response));              
           detailCustomer(dataReponse.response);
      }
    });
}

/******* in dieu tri ************/
function printTreatment(id_customer, id_group_history) {
    var url="<?php echo CController::createUrl('accounts/printTreatment')?>?id_customer="+id_customer+"&id_group_history="+id_group_history;
    window.open(url,'name');
    
}
/******* end in dieu tri ************/

/* End Plupload-master */

function confirmWinClose() {

    if ($('#dental_status_change').val() == 1){ 
        window.onbeforeunload = function() {
            return 'Are you sure you want to navigate away from this page?';
        };
    }else{
        window.onbeforeunload = null;
    }

}

confirmWinClose();

$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();
    var customer_action = $(".customersActionHolder").height();  
    var customer_search = $(".customerSearchHolder").height();

    $('#profileSideNav').height(windowHeight-header);

    $('.statsTabContent').height(windowHeight-header-tab_menu-45);     

    $('#customerList').css('max-height', windowHeight-header-customer_action-customer_search-80);

});

$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();
    var customer_action = $(".customersActionHolder").height();    
    var customer_search = $(".customerSearchHolder").height();

    $('#profileSideNav').height(windowHeight-header);

    $('.statsTabContent').height(windowHeight-header-tab_menu-45);   

    $('#customerList').css('max-height', windowHeight-header-customer_action-customer_search-80);

});
</script>                           
