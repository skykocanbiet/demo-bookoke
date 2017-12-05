<script type="text/javascript">
function formatNumber(nStr, decSeperate, groupSeperate) {
        nStr += '';
        x = nStr.split(decSeperate);
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
        }
        return x1 + x2;
    }
  var baseUrl = $('#baseUrl').val();
  function Dealscompany(id){
       
    var id = $('#company').val();
    $.ajax({

            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/company',   
            data: {"id":id},  
          
            success:function(data){ 
               
              DealsService(id);
                $(".product").html(data);
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
      });
  }
  function DealsService(id){
    var id = $('#company').val();
    $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/service',   
            data: {"id":id},  
          
            success:function(data){   
                $(".service").html(data);

            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
      });
  }

    function servicedeal(sel){
       // var id = $('.DealsService').val();
          var value = sel.value;
          $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/price',   
            data: {"value":value},  
          
            success:function(data){  
                
                
                $(sel).parents('.dealservice').next().find(".pricelabel").val(formatNumber(data, '.', ','));
                $(sel).parents('.dealservice').next().next().find(".number").val(1);
                 $(sel).parents('.dealservice').next().next().next().find(".allprice").val(formatNumber(data, '.', ','));
                $(sel).parents('.dealservice').next().find(".price").val(data);
               // $(sel).parents('.dealservice').next().find(".pricelabel").css("display", "block");
               // $('#hiden').css("display", "none");
                // .next().find(".price").val(data);
                /*$(this).parents('tr').find('.price').autoNumeric('set', data);
                $(this).parents('tr').find('.price').val(data);*/
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        }); 
       
    }
     function productsdeal(sel){
         var value = sel.value;
        
          $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/priceproduct',   
            data: {"value":value},  
          
            success:function(data){  
                
                $(sel).parents('.dealprocuct').next().find(".pricelabel").val(formatNumber(data, '.', ',') );
                $(sel).parents('.dealprocuct').next().find(".price").val(data);
                // .next().find(".price").val(data);
                /*$(this).parents('tr').find('.price').autoNumeric('set', data);
                $(this).parents('tr').find('.price').val(data);*/
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        }); 
   }
  function error(){
    
  
  }

    
  $('#frm-add-Deals').submit(function(e) {

    var promotion_type = $('#type_promotion').val();
    var giamtheophantram = $('#giamtheophantram').val();
    var giamtheosotien = $('#giamtheosotien').val();
    var bangiacodinh = $('#bangiacodinh').val();
    var croup = $('#croup_promotion').val();
    if (promotion_type == 0) {
      
      $('#type_promotion').addClass('error');
       return false;
    }else if(croup == 0 ){
      
      $('#croup_promotion').addClass('error');
      return false;
      }
    else if(promotion_type == 1 && giamtheophantram == ""){
      
      $('#giamtheophantram').addClass('error');
      return false;
      }
    else if(croup == 0 ){
      
      $('#croup_promotion').addClass('error');
      return false;
      }
   else if(promotion_type == 2 && giamtheosotien == ""){
      
      $('#giamtheosotien').addClass('error');
      return false;
      }
   else if(promotion_type == 3 && bangiacodinh == ""){
      
      $('#bangiacodinh').addClass('error');
      return false;
      }
    else{
    e.preventDefault();    
    var formData = new FormData($("#frm-add-Deals")[0]); 
      
    if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({           
            type:"POST",
            url: baseUrl+'/itemsSales/Dealselitedental/addDeals',   
            data:formData,
            datatype:'json',
            success:function(data){
             
                if(data > 0){ 
                  $("#add_deals").modal("hide");
                    
                    detail();
                
                
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
function sumprice(sum){
    var value = sum.value;

    /*var number = $(sum).parents('.dealpromotion').prev().find(".number").val();*/
    var price = $(sum).parents('.dealnumber').prev().find(".price").val();
    var allprice = (price * value);
    $(sum).parents('.dealnumber').next().find(".allprice").val(formatNumber(allprice, '.', ',') );
    var a = 0;
    
    //$(sum).parents('.dealnumber').next().find("").val(formatNumber(b, '.', ','));
}
function price_promotion(is) {
  var iss = is.value;
  var price = $(is).parents('.end').prev().prev().find(".p1").val();
  if(parseInt(iss) < parseInt(price)){
    $(is).addClass('error');
    $('.canhbao').fadeIn();
    $('.canhbao').fadeOut(6000);
    return false;
  }else{
    $(is).removeClass('error');
    return false;
  }

  
}
function promotion_giatri(sv){
    var s = sv.value;
    var v = $(sv).parents('.promotion_gt').prev().find(".ssl").val();
    if(v == 1 && s > 100){
        $(sv).val('100');
    }

}
function promotion(){
    var s = $('#giamtheophantram').val();
    if(s > 100){
        $('#giamtheophantram').val('100');
    }
    /*var vl = vl.value;
    var pr =  $('.priceall').val();
    var ap = pr - (vl * pr)/100 ;
    $('.price_promotion').val(ap + ".000");*/
    
}
function detail(){
     $('.cal-loading').fadeIn('fast');
    $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/detail',   
           
          
            success:function(data){  
               
               $('#abcabc').html(data);
                $('.cal-loading').fadeOut('slow');  
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        }); 
}
function clearField(input,val) {
      if(input.value == val)
         input.value="";
};
function parseDate(str) {
  var mdy = str.split('/');
  return new Date(mdy[2], mdy[1], mdy[0]);
}
function startdate(){
    var start = $('input[name="daterangepicker_start"]').val();
    var date = $('#date').val();
    
    var s = parseDate(start).getTime();
    var d = parseDate(date).getTime();
    
    if(s >  d){
        $('#DealsStart').removeClass('error');
        //$("#save").removeClass('nobutton');
        return false;
    }else{
       $('#DealsStart').addClass('error');
        //$("#save").addClass('nobutton');
        return false;
    }
}
function stopdate(){
    var start = $('#DealsStart').val();
    var stop = $('#datepicker').val();
    var s = parseDate(start).getTime();
    var d = parseDate(stop).getTime();
    if(s > d){
        $('#datepicker').removeClass('error');
        $("#save").removeClass('nobutton');
        return false;
    }else{
       $('#datepicker').addClass('error');
       $("#save").addClass('nobutton');
        return false;
    }
}
function promotion_type(){
    var id = $('#type_promotion').val();
    
    if(id == 1){
        
       $('#giamtheophantram').removeClass('input_value');
       $('#giamtheosotien').addClass('input_value');
       $('#bangiacodinh').addClass('input_value');
       $('#giamtheogiatri').addClass('input_value');
        return false;
    }else if(id ==2 ){
        $('#giamtheosotien').removeClass('input_value');
        $('#giamtheophantram').addClass('input_value');
       
       $('#bangiacodinh').addClass('input_value');
       $('#giamtheogiatri').addClass('input_value');
        return false;

    }
    else if(id == 3){
        $('#bangiacodinh').removeClass('input_value');
        $('#giamtheosotien').addClass('input_value');
        $('#giamtheophantram').addClass('input_value');
        $('#giamtheogiatri').addClass('input_value');
        return false;

    }
    else if(id == 4){
        $('#giamtheogiatri').removeClass('input_value');
        $('#bangiacodinh').addClass('input_value');
        $('#giamtheosotien').addClass('input_value');
        $('#giamtheophantram').addClass('input_value');
        return false;


    }
}
$(document).ready(function() {
  
        $("#fileUpload").on('change', function() {
          //Get count of selected files
          var countFiles = $(this)[0].files.length;
          var imgPath = $(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = $("#image-holder");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } 
        });
//dieu kien
          
        //append addpro
        $("#addpro").click(function(){
          var company = "42";
          $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/addprod',   
            data: {"company":company},  
          
            success:function(data){   
                $("#add").append("<tr class='tradddeal'>"+
                "<td class='dealprocuct' style='width:40%;'>"+"<div class='product'>"+
                          data+
                          "</div>"+
                "</td>"+
                "<td style='width:20%;'>"+
                          '<input type="text" class="pricelabel num" name="DealsPricepr[]" id="DealsPrice" placeholder="Đơn giá" readonly="readonly" style="border: 0px solid; width: 100%;background-color: #f1f5f6; ">'+
                          '<input type="number" class="price" name="DealsPricepr[]" id="DealsPrice" placeholder="Price" readonly="readonly" style="border: 0px solid; width: 100%;background-color: #f1f5f6; display:none; ">'+
                "</td>"+
                '<td style="width:9%;"  class="dealnumber">'+
                          '<input type="number" class="form-control number " name="numberpro[]" id="" placeholder="Số lượng" onchange="sumprice(this)" style="text-align:center;">'+
                
                '<td style="width:22%;">'+
                    '<input type="text" class="allprice num" name="DealsPrice[]" id="DealsPrice" readonly="readonly" style="border: 0px solid; width: 100%;background-color: #f1f5f6;  " placeholder="Price" value="0">'+
                        '</td>'+
                 '<td style="width:10%;" >'+
                          '<button type="button" class="btn btn-default btn-sm" onclick="myFunction(this)" style="border: 0px; background-color: rgba(204, 204, 204, 0.07);">'+
                            '<img data-toggle="tooltip" title="" src="<?php echo yii::app()->request->baseUrl; ?>/images/icon_sb_left/delete-def.png" alt="" style="width: 15px; height:auto;" data-original-title="Xóa"> '+ 
                          '</button>'+
                  '</td>'       

                +"</tr");
            },
            
      });
        
          });
         //append addpro
          $("#addser").click(function(){
          var company = "42";
          $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/addser',   
            data: {"company":company},  
          
            success:function(data){   
                $("#add").append("<tr class='tradddeal'>"+
                "<td class='dealservice' style='width:40%;'>"+"<div class='service'>"+
                          data+
                          "</div>"+
                "</td>"+
                "<td style='width:20%;' class='dealpri'>"+
                      '<input type="text" class="pricelabel num" name="DealsPrice[]" id="DealsPrice" placeholder="Đơn giá" readonly="readonly" style="border: 0px solid; width: 100%; background-color: #f1f5f6;  ">'+
                          '<input type="number" class="price" name="DealsPrice[]" id="DealsPrice" placeholder="Price" readonly="readonly" style="border: 0px solid; width: 100%; background-color: #f1f5f6; display:none; ">'+
                "</td>"+
                '<td style="width:9%;" class="dealnumber" >'+
                          '<input type="number" class="form-control number" name="number[]" id="" placeholder="Số lượng" onchange="sumprice(this)" style="text-align:center;">'+
                '</td>'+
              
                '<td style="width:22%;">'+
                  
                    '<input type="text" class="allprice num" name="DealsPrice[]" id="DealsPrice" readonly="readonly" style="border: 0px solid; width: 100%;background-color: #f1f5f6;  " placeholder="Price" value="0">'+
                        '</td>'+
                        '<td style="width:10%;">'+
                          '<button type="button" class="btn btn-default btn-sm" onclick="myFunction(this)" style="border: 0px; background-color: rgba(204, 204, 204, 0.07);" >'+
                            '<img data-toggle="tooltip" title="" src="<?php echo yii::app()->request->baseUrl; ?>/images/icon_sb_left/delete-def.png" alt="" style="width: 15px; height:auto;" data-original-title="Xóa"> '+ 
                          '</button>'+
                        '</td>'

                +"</tr");
            },
            
      });
        
          });
    $("#add_giatri").click(function(){

    $("#giamtheogiatri").append(
      "<tr class='tradddeal'>"+
      '<td style="padding-top: 18px;"><?php echo $i++ ?></td>'+
     '<td><input type="text" min="1" class="form-control num " name="start_value[]" id="number" placeholder="Giá trị" required="number" onchange="sumprice(this)"></td>' + 
     '<td> <span class="glyphicon glyphicon-chevron-right"></span> </td>'+
      '<td><input type="text" min="1" class="form-control num   " name="end_value[]" id="number" placeholder="Giá trị" required="number" onchange="sumprice(this)"></td>'+
                      
      '<td><select name="type_value[]" class="form-control" id="DealsService" style="float:left;">'+
              '<option value="1">(%)</option>'+
              '<option value="2">Value</option>'+
              '<option value="3">Fixed value</option>'+
            '</select>'+
      '</td>'+
      '<td><input type="number" min="1" class="form-control   " name="percent_value[]" id="number" placeholder="Giá trị"  onchange="sumprice(this)"></td>'+
     '</tr>');
    $(function(){
    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    $('.num').autoNumeric('init',numberOptions);
});

 });
       
      });
$( function() {
    $( "#datepicker" ).datepicker();
    $('#DealsStart').datepicker();
  } );
function myFunction(dev) {
    var i = dev.parentNode.parentNode.rowIndex;
    document.getElementById("add").deleteRow(i);
    
}
$(function() {
    $('input[name="daterange"]').daterangepicker({
        timePicker: true,
        timePickerIncrement: 365,
        locale: {
            format: 'MM/DD/YYYY h:mm:ss'
        }
    });
});
function txtname(id){
  var  name = $('#dealsName').val();
  if(name !=""){
     $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Deals/testname',   
            data: {"name":name},  
          
            success:function(data){  
               if(data > 0){
                  $('#dealsName').addClass('error');
                  $('#save').addClass('none');
                  $('#save').prop('disabled', 'disabled');
                  $('#saiten').fadeIn();
                  $('#saiten').fadeOut(7000);
                  return false;
               }else{
                  $('#dealsName').removeClass('error');
                   $('#save').removeClass('none');
                    $('#save').prop('disabled', '');
                   return false;
               };
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        }); 
  }
  return false;
}
function change_service()
    {
        $("#on_service").toggleClass("On");
        $("#off_service").toggleClass("Off");
        $('#switch_service').toggleClass("Switch");
        $('#add').toggleClass('input_value'); 
       var vl = $('#allservice').val();
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/allservice',   
            data: {"vl":vl},  
          
            success:function(data){  
               $('#allservice').val(data);
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        }); 

    } 
</script>