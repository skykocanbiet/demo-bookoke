<?php $baseUrl = Yii::app()->baseUrl;?>
<input type="hidden" id="baseUrl" value="<?php echo Yii::app()->baseUrl?>"/>
<!--Font Awesome and Bootstrap Main css  -->
<?php include'css_deals.php'; ?>


<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/jqtransform.css" />
<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/setting.css" />
<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/customers_new.css" />
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src='<?php echo $baseUrl; ?>/js/daterangepicker/moment.min.js'></script>
<script type="text/javascript" src='<?php echo $baseUrl; ?>/js/daterangepicker/moment.js'></script>
<script type="text/javascript" src='<?php echo $baseUrl; ?>/js/daterangepicker/daterangepicker.js'></script>
<link rel="stylesheet" href="<?php echo $baseUrl; ?>/js/daterangepicker/daterangepicker.css" type="text/css">
<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/bootstrap-multiselect.css" type="text/css">

<!-- PAINT -->
<link rel="Stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/js/paint/wPaint.min.css" />
<!-- END PAINT -->

<input type="hidden" id="baseUrl" value="<?php echo Yii::app()->baseUrl?>"/>

<style type="text/css">
#profileSideNav ul li a i{
    font-size:2em;  
}
.itemsPromotions li {
    line-height: 24px;
}  
#tbl_deal .tbody {
    display:block;
    height:50px;
    overflow:auto;
}
#tbl_deal .tbhead, .tbody, .sss  {
   
    display:table;
    width:100%;
    table-layout:fixed;/* even columns width , fix width of table too*/
}
#tbl_deal .tbhead {
    width: calc( 100% - 1em )/ scrollbar is average 1em/16px width, remove it from thead width /
}
#tbl_deal tbody tr td{
    text-align: center;
}
#tbl_deal  thead th{
    text-align: center;
}
#tbl_deal tbody tr{
        border-bottom: 1px solid #ecebeb;
}
.sliders {
        line-height: 23px;
        float: left;
        width: 60px;
        position: absolute;
        color: #ffffff !important;
        font-size: 11px !important;
        font-weight: 800 !important;
    }
    .slider_off {
    background: url('../../images/switch-bg.png') -57px 0px no-repeat;
    left: 60px;
    text-indent: 26px;
    color: #ffffff !important;
    }
    .slider_on {
    background: url('../../images/switch-bg.png') 0px 0px no-repeat;
    text-indent: 10px;
    left: 2px;
    }
    .slider_switch {
    background: url('../../images/switch-btn.png') left top no-repeat;
    height: 24px;
    left: 38px;
    position: absolute;
    width: 25px;
    }
    .Off{
        left: 1px;
    }
    .On{
        left: -57px;
    }
    .Switch{
        left: 1px;
    }
.customersActionHolder .popover {
    width: 230px !important;
    max-width: 300px !important;
}
.deleteProvider{
    /*//margin-top: 126px !important;*/
        width: 248px !important;
}
.btn_delete{
   display: none;
}
.n:hover .btn_delete{
       display: block;
     background: url('../../images/delete-def.png');
     background-size: 100% auto;
    /* background-color: #31b0d5; */
    border-color: #c4e2c7;
    color: #e1f113;
}
.btn_delete1{
        display: block;
  
     background-size: 100% auto;
    border-color: #c4e2c7;
    color: #e1f113;
}
/*.btn_plus {
    height: 30px;
    width: 30px;
    float: right;
    cursor: pointer;
    background: url(/images/add-def.png);
    background-size: 100%;
    background-repeat: no-repeat;
}*/
.none{
    opacity: 0.6;
    cursor: not-allowed;

}
</style>
<input type="hidden" id="baseUrl" value="<?php echo Yii::app()->baseUrl?>"/>
<div class="wrapper tab-content full-height">


    <!-- Contact Customers -->
    <div id="customers" class="tab-pane full-height active">
        <div class="row-fluid full-height">

            <div id="customerContent" class="content">

                <div  id="leftsidebar" class="col-sm-5 col-md-4 col-lg-3">
                    <div class="row">

                        <div class="customerListContainer">
                            <div style="margin:0px 2em;">

                                    <div class="customersActionHolder">
                                            <h3 style=" width: 200px;">Nhóm chương trình</h3>
                                            <a class="btn_plus" data-placement="bottom" id="addcroup" data-toggle="popoverMenu" type="button" data-html="true" href="#" ></a>
                                            <div id="importExportLabel" class="importLabel fr importAndSort blue_glowb hide">
                                                Import/Export
                                                <ul id="importExportOptionList">
                                                    <li id="import"> Import </li>
                                                    <li id="export"> Export All </li>
                                                </ul>
                                            </div>
                                            <div class="clearfix"></div>
                                    </div>
                                    <div id="addnewCustomerPopup" class="popover bottom" style="display: none;">
                                            <form id="frm-add-customer" onsubmit="return false;" class="form-horizontal">
                                                <div class="arrow"></div>
                                                <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Thêm khách hàng</h3>
                                                <div class="popover-content" style="width:225px;">
                                                    <input type="text" required="" oninvalid="this.setCustomValidity('Vui lòng nhập họ và tên.')" oninput="setCustomValidity('')" class="form-control" id="customerNewName" name="customerNewName" placeholder="Họ và tên" style="margin-bottom:10px;">
                                                    <input type="text" required="" pattern="\d{6,12}" oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại.')" oninput="setCustomValidity('')" title="Số điện thoại phải từ 6 đến 12 số." class="form-control" id="customerNewPhone" name="customerNewPhone" placeholder="Số điện thoại" style="margin-bottom:10px;">                                           
                                                    <button id="addnewCustomer" class="new-gray-btn new-green-btn">Tạo mới</button>
                                                    <button id="cancelNewCustomer" type="reset" class="cancelNewStaff new-gray-btn" style="min-width: 94px;margin-right: 0px;">Hủy</button>
                                                </div>
                                            </form>
                                    </div>

                                   

                                    <div id="customerListHolder" class="customerListHolder" style="padding-top:5px;">  
                                        <ul id="customerList" style="max-height: 770px;">                                                    
                                                    <li id="c0"  class="n active">                                                                            
                                                        <span class="jqTransformCheckboxWrapper" style="display:none;">
                                                            <a href="#" class="jqTransformCheckbox"></a>
                                                            <input type="checkbox" value="0" class="fl" style="display : none;">
                                                        </span> 
                                                        <label class="fl"><i class="fa fa-folder"></i> All </label>
                                                        <div class="clearfix"></div>
                                                    </li>
                                                    <?php
                                                        $model = new CroupPromotion;
                                                        foreach ($model->getcroup() as $key => $value):?>
                                                            <li id="c<?php echo $value['id']; ?>"  class="n ">                                                                            
                                                        <span class="jqTransformCheckboxWrapper" style="display:none;">
                                                            <a href="#" class="jqTransformCheckbox"></a>
                                                            <input type="checkbox" value="0" class="fl" style="display : none;">
                                                        </span> 
                                                        <label class="fl"><i class="fa fa-folder"></i><?php echo $value['name']; ?> </label>
                                                        <div class="clearfix"></div>
                                                    </li>
                                                    <?php 
                                                    endforeach;
                                                     ?>

                                                   
                                                   
                                            </ul>

                                    </div>

                            </div>
                        </div>
                    </div>    
                    <div class="clearfix"></div>
                </div> 
                 <div id="detailCustomer" class="col-sm-7 col-md-8 col-lg-9">
                   
                    <?php  include('Deals_default.php'); ?>
                    
                </div>


                <div class="clearfix"></div>  
            </div>
        </div>
    </div>


</div>

       <div id="popover-Menu" class="hide">
       <div class="row" style="background-color: #f8f8f8;
    padding: 5px 0px;
    margin-top: -9px;
    margin-bottom: 11px;
    text-align: center;">
           <h4 style="font-size:15px;">Thêm nhóm khuyến mãi</h4>
       </div>
       
            <div >
                  <input type="text" id="namecroup" name="textcroupname"  placeholder="Tên nhóm khuyến mãi" class="form-control" required="" onchange="abc(this)">

            </div>
            <div class="" id="error" style="margin:10px 0px;"></div>
            <div style="padding: 10px 0px;">
                  <button id="crouptaomoi" type="button" class="btn Submit btn_bookoke"  onclick="acb()" style="padding: 6px 19px;" >Tạo mới</button>
                  <button   class="btn sCancel btn_cancel" style="float:right; padding: 6px 33px;" onclick="huy()" >Hủy</button>
                  
            </div>
       
    </div>
<script type="text/javascript">

    
$( document ).ready(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var head = $('.head').height();
    var tbhead  = $('.tbhead').height();
    $('#t_bd').height(windowHeight-header-head-tbhead-37);
    $('#profileSideNav').height(windowHeight-header);
    $('.customerListContainer').height(windowHeight-header);
    $('#detailCustomer').height(windowHeight-header);
    $('.cal-loading').fadeOut('slow');
   detail();
   detail_croup();

});
function huy(){
    //$("[data-toggle='popover-Menu']").popover('hide');
    $("[data-toggle='popoverMenu']").popover('hide');
    //$('#popoverMenu').popover('hide')

}
$('#addcroup').click(function () {
    $(this).popover({
                html: true,
                trigger: 'manual',
                placement: 'bottom',
                content: function () {
                    var $buttons = $('#popover-Menu').html();
                    return $buttons;
                }
    }).popover('toggle');

});
$('#detailCustomer' ).click(function(){
     $("[data-toggle='popoverMenu']").popover('hide');
});
$( '#customerListHolder').click(function(){
     $("[data-toggle='popoverMenu']").popover('hide');
});
function acb(){

    var name = $("#namecroup").val();
    if(name == ""){
        $("#namecroup").addClass('error');
        return false;
    } 
    else{

         $("#namecroup").removeClass('error');

    $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/addcroup',   
            data: {"name":name},  
          
            success:function(data){ 

               if(data == 1){
                 $("[data-toggle=popoverMenu]").popover('hide');
                 detail_croup();
               }else{
                $('#namecroup').addClass('error');
                  $('#error').addClass('alert alert-danger');
                    $('#error').html("Tên nhóm đã tồn tại");
               }

            }
        });
    }
} 
function detail_croup(){
     $('.cal-loading').fadeIn('fast');

    $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/detailcroup',   
           
          
            success:function(data){  
               
               $('#customerList').html(data);
                $('.cal-loading').fadeOut('slow');  
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        }); 
}

 /* initiates autoNumeric and passes a function from the HTML5 data atribute */ 
                                                                                
  
$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    $('#profileSideNav').height(windowHeight-header);
    $('.customerListContainer').height(windowHeight-header);
    $('#detailCustomer').height(windowHeight-header);

});
 /* $("[data-toggle=popoverMenu]").popover({
                html: true,
               
              content: function() {
                        return $('#popover-Menu').html();
                     }
                });*/
  function chitietnhom(id){
        $('.cal-loading').fadeIn('fast');
        $('.n').removeClass("active");
        $('.btn_delete').removeClass("btn_delete1"); 
    $("#c"+id).addClass("active");
    $("#c"+id).find('code').removeClass("hide");

    $("#a"+id).addClass("btn_delete1");
    $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/chitietnhom',   
            data: {"id":id},  
          
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
 function delete_provider(id){

   var evt = window.event || arguments.callee.caller.arguments[0];

     evt.preventDefault();
      var position = $('#a'+id).position(); 
     $('#deleteProvider'+id).css({"top": position.top-50, "left": position.left+50});
     $('#deleteProvider'+id).fadeToggle('fast');
     evt.stopPropagation();
    $("#yes_delete"+id).click(function(e){
        e.preventDefault();
         $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/deletecroup',   
            data: {"id":id},   

            success:function(data){ 

                   if(data == "1")
                   {
                    $('#deleteProvider'+id).hide();
                    detail();
                    detail_croup();
                   }       
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });
         e.stopPropagation();
    });
     $("#update"+id).click(function(e){
        var txtname = $('#txtnamegroup').val();
    
        e.preventDefault();
         $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/updategroup',   
            data: {"id":id, 'txtname':txtname},   

            success:function(data){ 

                   if(data == "1")
                   {
                    $('#deleteProvider'+id).hide();
                    detail();
                    detail_croup();
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
function abc(ac){
    var name = $('#namecroup').val();
    if(name !=""){
     $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/testnamecroup',   
            data: {"name":name},  
          
            success:function(data){  
               if(data > 0){
                  $('#namecroup').addClass('error');
                  $('#error').addClass('alert alert-danger');
                    $('#error').html("Tên nhóm đã tồn tại");
                   // $('#crouptaomoi').prop('disabled', 'disabled');
                  return false;
               }else{
                  $('#namecroup').removeClass('error');
                   $('#error').removeClass('alert alert-danger');
                    $('#error').html("");
                    //$('#crouptaomoi').prop('disabled', '');
                   return true;
               };
            },
           
        }); 
  }
 return true;
}
$(function(){
    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    $('.num').autoNumeric('init',numberOptions);
});
function update(id){
  alert('sadsad');
  return false;
   var evt = window.event || arguments.callee.caller.arguments[0];

     evt.preventDefault();
     $('#deleteProvider'+id).fadeToggle('fast');
     evt.stopPropagation();
    $("#yes_delete"+id).click(function(e){
        e.preventDefault();
         $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/update',   
            data: {"id":id},   

            success:function(data){ 

                   if(data == "1")
                   {
                    $('#deleteProvider'+id).hide();
                    detail();
                    detail_croup();
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
</script>

