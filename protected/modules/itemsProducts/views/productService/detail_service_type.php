<?php 
$cst = new CsServiceType;
$v = new CDbCriteria(); 
$v->addCondition('t.status = 1');
$v->order= 'id DESC';
$cst_all=$cst->findAll($v);
?>
<table id="stock" class="table table-boooke" role="grid" aria-describedby="stock_info" style="border-collapse:collapse;">
    <thead>
        <tr role="row">
            <th tabindex="0" aria-controls="stock" rowspan="1" colspan="1"  aria-label="Name: activate to sort column ascending">
            Mã dịch vụ
            </th>
            <th width="50%" tabindex="0" aria-controls="stock" rowspan="1" colspan="1" aria-label="SKU: activate to sort column ascending">
            Tên dịch vụ
            </th>
            <th tabindex="0" aria-controls="stock" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending">Thời gian thực hiện</th>
            <th id="set_padding" tabindex="0" aria-controls="stock" rowspan="1" colspan="1"  aria-label="Price: activate to sort column ascending">
            Giá bán
            </th>          
        </tr>
    </thead>
    <tbody id="bodyTblContent">
    <?php     
    if(!empty($cs))
    {          
        foreach ($cs as $k => $v) 
        {
    ?>
        <tr data-toggle="collapse" data-target="#demo<?php echo $k+1;?>" class="accordion-toggle background-color-f1f5f6">
            <td><?php echo $v['code'];?></td>
            <td width="50%"><?php echo $v['name'];?></td>
            <td><?php echo $v['length'];?> phút</td>
            <td class="autoNum"><?php echo $v['price'];?></td>            
        </tr>
        <tr class="background-color-fff">
            <td colspan="4" class="hiddenRow" style="text-align: left;">
                <div class="accordian-body collapse oView col-md-12 <?php if(count($cs)==1) echo "in";?>" id="demo<?php echo $k+1;?>">
                    <?php 
                    $csservice=new CsService;
                    $dts=$csservice->findByAttributes(array('id'=>$v['id']));                  
                    ?>
                    <div class="oViewDetail col-md-12">
                        <div id="oInfo" class="col-md-12">
                            <form class="ud-service-form" id="" action="" onsubmit="return false;" method="post" novalidate="">    
                                <input type="hidden" name="save-add-another" id="save-add-another" value="false">
                                <input id="ShowAffixTimesPanel" name="ShowAffixTimesPanel" type="hidden" value="False"><input name="__RequestVerificationToken" type="hidden" value="m-8u1fvSfNz50dkff6cvQk0EUL9PihfcNInjSXly1DAeWYwhxawPLWLrb7I4qgiROzKWRUyJHugUuGja6bRz-mgBK6KezJI9Irzg9lJbwyXdp2VSS3fZOCiilM3IxjTL7mUa7yfG3GjiMhM0FM0DArCSVO4pjOugmTMQ60c1Wa7dA0pR0">        <div class="t-settings-head">
                                            
                                            
                                        </div>
                                <div class="rg-row">
                                       
                                        <div class="col-md-12" style="margin-top:10px;">
                                            
                                              
                                <input id="XeroAuthError" name="XeroAuthError" type="hidden" value="False">
                                <input id="Title" name="Title" type="hidden" value="Add Service">
                                <input id="Service_BusinessId" name="Service.BusinessId" type="hidden" value="0">
                                <input id="Origin" name="Origin" type="hidden" value="">
                                <input id="Tab" name="Tab" type="hidden" value="details">
                                <input id="Service_ServiceTypeId" name="Service.ServiceTypeId" type="hidden" value="1">


                                <div class="rg-row">
                                    <div class="col-sm-4">
                                        <div class="form-group required" id="">
                                            <span class="" for="code_service">Mã dịch vụ</span>
                                            <input id="id_service" name="id_service" type="hidden" value="<?php echo $dts['id'];?>">
                                            <input disabled class="form-control" id="" name="code_service" required="" type="text" value="<?php echo $dts['code'];?>" data-parsley-id="0931">                        
                                            <span class="help-block validation-error" id=""></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">                     
                                        <div class="form-group required" id="">
                                            <span class="" for="name_service">Tên dịch vụ</span>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <div class="btn-group service-color-pallet-holder">
                                                        <a class="dropdown-toggle">
                                                            <label id="" name="color_service" class="" style="font-weight: normal;color: #464646;font-size: 12px;margin-bottom: 0;">VN</label>
                                                            <span class="caret"></span>
                                                        </a>                                                       
                                                    </div>
                                                </div>
                                                <input disabled class="form-control" id="" name="name_service" required="" type="text" value="<?php echo $dts['name'];?>" data-parsley-id="0932">
                                               
                                            </div>
                                        <span class="help-block validation-error" id=""></span></div>
                                    </div>
                                        <div class="col-sm-4">
                                            <div class="form-group required" id="">
                                                <span class="" for="id_service_type">Nhóm dịch vụ</span>                          
                                                <?php
                                                $group_service = array();
                                                foreach($cst_all as $temp){
                                                    $group_service[$temp['id']] = $temp['name'];
                                                }                            
                                                echo CHtml::dropDownList('id_service_type','',$group_service,array('disabled'=>'disabled','class'=>'form-control','required'=>'required','empty' => 'Chọn nhóm dịch vụ','options'=>array($dts['id_service_type']=>array('selected'=>true))));
                                                ?>                 
                                                <span class="help-block validation-error" id=""></span>
                                            </div>
                                        </div>
                                   

                                </div>

                                    <input id="Service_Capacity" name="Service.Capacity" type="hidden" value="0">

                                <div class="form-group ">
                                    <span class="" for="description_service">Mô tả</span>
                                    <span class="char-count-container">
                                        <textarea disabled class="char-count-1000 form-control" cols="20" id="description_service" name="description_service" rows="2"><?php echo $dts['description'];?></textarea>
                                    </span>
                                <span class="help-block validation-error"></span></div>
                               
                                <div class="form-group" style="padding: 0px;">
                                    <div class="checkbox">
                                        <label>
                                            <input disabled <?php if($dts['status_hiden']==1) echo "checked"; else echo "";?> type="checkbox" value="true" data-parsley-multiple="ServiceOnlineBookings">
                                            <input name="Service.OnlineBooking" type="hidden" value="false"> Khách hàng có thể đăng kí dịch vụ trực tuyến
                                        </label>
                                        
                                    </div>


                                    <span class="help-block validation-error"></span>

                                </div>    
                               

                                 <div class="clearfix"></div>
                                <div class="rg-row">
                                    <div class="col-sm-3">
                                        <div class="form-group ">
                                            <span class="" for="price_service">Giá dịch vụ</span><br>
                                            <div class="inline-group">
                                                
                               

                             

                             

                                <span class="price-display">
                                    <div class="input-group">
                                        
                                        <input disabled value="<?php echo number_format($dts['price'],0,"","");?>" class="price-input form-control input-narrow autoNum" id="price_service" name="price_service" type="text">
                                        <div class="input-group-addon"><?php echo $dts['unit_price']; ?></div>
                                    </div>
                                    
                                </span>


                              

                                            </div>
                                        <span class="help-block validation-error"></span></div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <span>Thuế</span><br>
                                            <div class="inline-group">
                                            <div class="input-group">
                                                
                                                <input disabled class="tax-input form-control input-narrow" type="text" value="<?php echo $dts['tax'];?>">                             
                                                  <div class="input-group-addon">%</div> 
                                            </div>
                                            </div>
                                        <span class="help-block validation-error"></span></div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group required ">
                                    <span class="" for="length_service">Thời gian thực hiện</span><br>
                                    <div class="input-group-duration">
                                        <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                        <span class="ui-timepicker-container">
                                        <input disabled class="duration-input form-control input-narrow ui-timepicker-input" id="length_service" name="length_service" pattern="^([0-1]?[0-9]|2[0-3]):([0-5][0-9])(:[0-5][0-9])?$" required="" type="number" value="<?php echo $dts['length'];?>" autocomplete="off">                    
                                      
                                        </span>
                                    </div>

                                   
                                <span class="help-block validation-error"></span></div>
                                    </div>



                                    <div class="col-sm-3">
                                       <div id="select-staff" class="rg-row" style="margin-bottom: 10px;">
                                       
                                        <div class="col-md-12">                                        
                                         <span class="">Nhân viên thực hiện</span><br>

                                        <div class="rg-row staff-services">
                                            <div class="col-md-12">
                                                <select disabled id="example-enableCollapsibleOptGroups-enableClickableOptGroup" name="example-enableCollapsibleOptGroups-enableClickableOptGroup[]" class="example-enableCollapsibleOptGroups-enableClickableOptGroup" multiple="multiple">
                                                    <optgroup label="Chọn tất cả">
                                                        <?php                                                         
                                                        $cs_service=new CsService;
                                                        $staff_list=$cs_service->getListDentists(); 
                                                        $csserviceusers=new CsServiceUsers;
                                                        $selected=$csserviceusers->findAllByAttributes(array('id_service'=>$dts['id']));   
                                                        foreach ($staff_list as $s_l) 
                                                        {
                                                        ?>
                                                        <option value="<?php echo $s_l['id'];?>" <?php foreach ($selected as $s) {if ($s_l['id']==$s['id_user']) { echo "selected";}}?>><?php echo $s_l['name'];?></option>
                                                        <?php 
                                                        }
                                                        ?>
                                                    </optgroup>                                          
                                                </select>  
                                            </div>
                                               
                                        </div>

                                        </div>
                                    </div>
                                    </div>



                                </div>


                               


                                        </div>
                                    </div>
                                    

                                    
                                    
                                     <div class="rg-row">
                                       
                                        <div class="col-md-12">
                                   


                                        <div class="rg-row">
                                        <div class="col-sm-6">
                                            <div class="form-group  margin-bottom-05em">

                                                <span for="point_buy_service" style="padding:0px;">Điểm được tặng khi mua dịch vụ</span>
                                                <span style="width: 77px;margin-left: 15px;display: inline-block;">
                                                    <input disabled class="form-control" id="point_buy_service" name="point_buy_service" required="" onkeypress=" return isNumberKey(event)" type="text" value="<?php echo $dts['point_donate'];?>">
                                                </span>
                                            <span class="help-block validation-error"></span></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group margin-bottom-05em">
                                                <span for="point_change_service" style="padding:0px;">Điểm cần có để quy đổi dịch vụ</span>
                                                <span style="width: 77px;margin-left: 15px; display: inline-block;"> 
                                                    <input disabled class="form-control" id="point_change_service" name="point_change_service" required="" onkeypress=" return isNumberKey(event)" type="text" value="<?php echo $dts['point_exchange'];?>">
                                                </span>
                                            <span class="help-block validation-error"></span></div>
                                        </div>
                                       

                                    </div>

                                        
                                        </div>

                                    </div>

                                </form>




                        </div>
                        <div class="col-md-12">
                            <div id="pBtn">
                                <div id="pBtnL">
                                <button type="" id="" onclick="showEditService(<?php echo $dts['id'];?>);" class="btn btn_bookoke">Chỉnh sửa</button>
                                <span class="pull-right"><button type="button" class="btn btn_delete" onclick="deleteService(<?php echo $dts['id'];?>);">Xóa</button></span>
                                </div>
                            </div>
                        </div>
                    </div>   

                    <?php include("popup_edit_service.php");?>
                </div> 
            </td>
        </tr>
    <?php 
        }  
    }
    else
    {                                      
    ?>  
    <tr role="row" class="odd">
        <td colspan="4" align="center">Không có dữ liệu!</td>
    </tr>             
    <?php 
    }
    ?>            
    </tbody>
</table>
<br>
<div style="clear:both"></div>
<div align="center">
    <?php echo $lst;?>          
</div>



<script>   
function getColor(color,id){    
    $('#color_service-'+id).removeClass(function() {return $('#color_service-'+id).attr( "class" );});
    $('#color_service-'+id).addClass(color); 
    $('#color_service-'+id).html(color);
    if(color == "EN"){
        $('#name_service_'+id).addClass('hide');
            $('#name_service_en_'+id).removeClass('hide');
    }else{
        $('#name_service_'+id).removeClass('hide');
            $('#name_service_en_'+id).addClass('hide');
    }
}
function getunit(color,id){    
    $('#color_unit-'+id).removeClass(function() {return $('#color_unit-'+id).attr( "class" );});
    $('#color_unit-'+id).addClass(color); 
    $('#color_unit-'+id).html(color);
    /*if(color == "EN"){
        $('#name_service_'+id).addClass('hide');
            $('#name_service_en_'+id).removeClass('hide');
    }else{
        $('#name_service_'+id).removeClass('hide');
            $('#name_service_en_'+id).addClass('hide');
    }*/
}
function error_update_service(id){

    var status = true;

    if($('#code_service_'+id).val() == ''){
        status = false;       
        $('#ud-service-code-'+id).addClass('error');
        $("#parsley-id-0931-"+id).addClass('filled').html('<span class="parsley-required">Vui lòng nhập mã dịch vụ.</span>');       
    }
    else{
        $('#ud-service-code-'+id).removeClass('error');
    }

    if($('#name_service_'+id).val() == ''){
        status = false;       
        $('#ud-service-name-'+id).addClass('error');
        $("#parsley-id-0932-"+id).addClass('filled').html('<span class="parsley-required">Vui lòng nhập tên dịch vụ.</span>');       
    }
    else{
        $('#ud-service-name-'+id).removeClass('error');
    }

    if($('#id_service_type_'+id).val() == ''){
        status = false;       
        $('#ud-service-group-'+id).addClass('error');
        $("#parsley-id-0933-"+id).addClass('filled').html('<span class="parsley-required">Vui lòng chọn nhóm dịch vụ.</span>');       
    }
    else{
        $('#ud-service-group-'+id).removeClass('error');
    }

    return status;
}

function showEditService(id){

    var elem = $('#edit-service-blur-'+id)[0];

    $(elem).fadeToggle(200,function(){
    });

    $(document).mouseup(function (e)
    {   

        var container = $(".edit-service-container");
        if(templock == 0){
            if (!container.is(e.target) && container.has(e.target).length === 0){        
               if($(elem).is(':visible')){
                    templock = 1;
                    $(elem).fadeToggle(200,function(){
                        templock = 0;
                    });
                }        
            } 
        }
    
    });

    $('.close_s').on('click',function(e){
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

function updateService(id){
    if(error_update_service(id)){    
        $('.cal-loading').fadeIn('fast');     
        var formData = new FormData($('#ud-service-form-'+id)[0]); 
        formData.append('color_service',$('#color_unit-'+id).attr( "class" ));
        if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({
            type:'POST',
            url: baseUrl+'/itemsProducts/ProductService/updateService',
            data:formData,
            datatype:'json',
            success:function(data){               
                if (data == '-1') {                         
                    $('#ud-service-code-'+id).addClass('error');
                    $("#parsley-id-0931-"+id).addClass('filled').html('<span class="parsley-required">Mã dịch vụ đã tồn tại.</span>'); 
                    $('.cal-loading').fadeOut('slow');
                    return false;
                }
                else
                {
                    $('#ud-service-code-'+id).removeClass('error');

                    $("#searchService").val(data);   
                    var elem = $('#edit-service-blur-'+id)[0];
                    if(templock == 0){                   
                        if($(elem).is(':visible')){
                            templock = 1;   
                            $(elem).fadeToggle(200,function(){
                                templock = 0;
                            }); 
                        }                    
                    }
                    $('#glyphicon-search').click();
                    
                    $('.cal-loading').fadeOut('slow');
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

function deleteService(id){
    if (confirm("Bạn có thật sự muốn xóa?")) {     
        $('.cal-loading').fadeIn('fast');
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsProducts/ProductService/deleteService',    
            data: {"id":id},   
            success:function(data){
                if(data == '1')
                {
                    $('.cal-loading').fadeOut('slow'); 
                    window.location.assign("<?php echo CController::createUrl('ProductService/View')?>"); 
                }                 
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });
    }      
}

function checkClick(){     
    $( ".accordion-toggle" ).each(function( index ) {        
        if ($(this).attr("aria-expanded")=="true") {            
            $(this).addClass("at");
        }
    });
}
$('.accordion-toggle').click(function(){

    $( ".accordion-toggle" ).each(function( index ) {        
        $(this).removeClass("at");
    });

    var st =  $(this).attr("aria-expanded");   

    if(st == 'false' || st == undefined){        
        $(this).addClass("at");
    }else if(st == 'true'){

        $(this).removeClass("at");
    }
    
});

$('.collapse').on('show.bs.collapse', function () {    
    $('.collapse.in').collapse('hide');   
});
$(document).ready(function() {
        $('.example-enableCollapsibleOptGroups-enableClickableOptGroup').multiselect({
            enableClickableOptGroups: true,
            enableCollapsibleOptGroups: true
        });
});

$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var title     = $(".t-settings-head").height();

    $('#bodyTblContent').height(windowHeight-header-title-130);
    
});
$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var title     = $(".t-settings-head").height();

    $('#bodyTblContent').height(windowHeight-header-title-130);
});

$(function(){
    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    $('.autoNum').autoNumeric('init',numberOptions);
});

(function($) {
    $.fn.hasScrollBar = function() {
        return this.get(0).scrollHeight > this.height();
    }
})(jQuery);

$(function(){
    if ($('#bodyTblContent').hasScrollBar()) {
        $('#set_padding').css('padding-right','40px');
    }else {
        $('#set_padding').css('padding-right','0px');
    }  
});
</script>





