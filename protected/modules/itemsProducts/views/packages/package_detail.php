<?php 
$baseUrl = Yii::app()->baseUrl;
$pl = new PackageLine;
$v = new CDbCriteria(); 
$v->addCondition('t.status_proline = 1');
$v->order= 'id DESC';
$pl_all=$pl->findAll($v);

$cs=new CsService;
$n = new CDbCriteria(); 
$n->addCondition('t.status = 1');
$n->order= 'id DESC';
$cs_all=$cs->findAll($n);
?>

      
            <table id="stock" class="table table-package table-boooke" role="grid" aria-describedby="stock_info" style="border-collapse:collapse;">
                <thead>
                    <tr role="row">
                    <th tabindex="0" aria-controls="stock" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Mã gói dịch vụ</th>
                    <th tabindex="0" aria-controls="stock" rowspan="1" colspan="1" aria-label="SKU: activate to sort column ascending">Tên gói dịch vụ</th>
                    <th tabindex="0" aria-controls="stock" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending">Số lượng</th>
                    <th tabindex="0" aria-controls="stock" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending">Giá bán</th>

                    </tr>
                </thead>
            <tbody id="bodyTblContent">
            <?php     
            if(!empty($pr))
            {          
                foreach ($pr as $k => $v) 
                {
                $p=new Package;
                $dtp=$p->findByAttributes(array('id'=>$v['id'])); 
                $pi = new PackageImage;
                $dtpi=$pi->findByAttributes(array('id_package'=>$dtp['id']));  
                $ps = new PackageService;
                $dtps=$ps->findAllByAttributes(array('id_package'=>$dtp['id']));
            ?>
                <tr data-toggle="collapse" data-target="#demo<?php echo $k+1;?>" role="row" class="accordion-toggle background-color-f1f5f6">
                <td><?php echo $v['code'];?></td>
                <td><?php echo $v['name'];?></td>
                <td><?php echo count($dtps);?></td>
                <td class="autoNum"><?php echo $v['price'];?></td>               
                </tr>
                <tr class="background-color-fff">
                <td colspan="4" class="hiddenRow" style="text-align: left;">
                    <div class="accordian-body collapse oView col-md-12 <?php if(count($pr)==1) echo "in";?>" id="demo<?php echo $k+1;?>">
                   
                    <div class="oViewDetail col-md-12">
                    <div id="oInfo" class="col-md-12">





                            <form class="" id="" runat="server" action="" onsubmit="return false;" method="post">
                           

                                <div class="rg-row">

                                    <div class="col-md-12" style="margin-top:10px;">

                                        <h5>Chi tiết gói dịch vụ</h5>
                                       

                                    </div>
                                    <div class="col-md-12">

                                        <div class="rg-row">
                                            <div class="col-sm-6">

                                            </div>
                                            <div class="col-sm-6">

                                            </div>
                                        </div>

                                        <div class="rg-row">
                                            <div class="col-sm-6">
                                                <div class="form-group margin-bottom-05em required" id="">
                                                    <span class="" for="">Tên gói dịch vụ</span>
                                                    <input disabled class="form-control" id="" name="" type="text" value="<?php echo $dtp['name'];?>">
                                                </div>
                                                 <div class="form-group margin-bottom-05em" id="">
                                                    <span class="" for="">Mã gói dịch vụ</span>  
                                                    <input disabled class="form-control" id="" name="" type="text" value="<?php echo $dtp['code'];?>">
                                                    <input id="" name="" type="hidden" value="<?php echo $dtp['id'];?>">
                                                   
                                                    
                                                </div>
                                            </div>

                                            <div class="col-sm-6 " style="padding-top:15px;">
                                               <div class="rg-row">
                                                    <div class="col-md-4">
                                                        <div class="timely-image timely-image-centered">
                                                            <img style="width:90%;" class="img-responsive" src="<?php echo $baseUrl; ?>/upload/package_image/<?php if($dtpi['name_upload']) echo "md/".$dtpi['name_upload']; else echo "photo_normal.png";?>" alt="" id="">
                                                        </div>
                                                    </div>                                                  
                                                </div>
                                            </div>
                                        </div>
                                         
                                        <div class="form-group margin-bottom-05em" id="">
                                            <span class="" for="">Nhóm gói dịch vụ</span>
                                            <?php
                                                $package_line = array();
                                                foreach($pl_all as $temp){
                                                    $package_line[$temp['id']] = $temp['name'];
                                                }                            
                                                echo CHtml::dropDownList('id_package_line','',$package_line,array('disabled'=>'disabled','class'=>'form-control','empty' => 'Chọn nhóm sản phẩm','options'=>array($dtp['id_package_line']=>array('selected'=>true))));
                                            ?>     
                                        </div>

                                        <div class="form-group margin-bottom-05em ">
                                            <span class="" for="">Mô tả</span>
                                            <span class="char-count-container">   
                                                <textarea disabled class="char-count-1000 form-control" cols="20" id="" name="" rows="2"><?php echo $dtp['description'];?></textarea>
                                            </span>
                                        </div>

                                        <div class="rg-row">
                                            <div class="col-sm-4">
                                                <div class="form-group margin-bottom-05em" id="">
                                                    <span for="">Giá vốn</span> <a class="hide warning-icon-offset tip-init" href="javascript:void(0);" rel="popover" data-content="You have set your cost price higher than your retail price. Is this what you intended?" data-original-title="Cost price exceeds retail price">&nbsp;<i class="fa fa-exclamation-circle fa-fw fa-lg text-danger">&nbsp;</i></a>
                                                    <div class="input-group">
                                                        
                                                        <input disabled value="<?php echo $dtp['cost_price'];?>" class="form-control price-input cost-price autoNum" onkeypress=" return isNumberKey(event)" id="" name="" type="text">
                                                        <span class="input-group-addon">VND</span>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group margin-bottom-05em" id="">
                                                    <span class="" for="">Giá bán</span>
                                                    <div class="input-group">
                                                        
                                                        <input disabled value="<?php echo $dtp['price'];?>" class="form-control price-input retail-price autoNum" onkeypress=" return isNumberKey(event)" id="" name="" type="text">
                                                        <span class="input-group-addon">VND</span>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                             <div class="col-sm-4">
                                                <div class="form-group margin-bottom-05em">
                                                    <span>Thuế</span>
                                                    <div class="input-group">
                            
                                                        
                                                        <input disabled class="form-control tax-input" onkeypress=" return isNumberKey(event)" id="" name="" type="text" value="<?php echo $dtp['tax'];?>">                             
                                                           <div class="input-group-addon">%</div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                       

                                    </div>
                                </div>
                                
                                


                                <div class="rg-row">
    <div class="col-md-12" style="margin-top:10px;">
        <h5>Hiệu lực</h5>
       
    </div>

    <div class="col-md-12">

        <div class="rg-row">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">

            </div>
        </div>
        
        <div class="rg-row">
            <div class="col-sm-6">
                <div class="form-group ">
                    <span class="" for="ValidityDuration_Duration">Thời gian hợp lệ từ ngày bán</span><br>
                    <div class="duration-hide hide">
                        No restriction&nbsp;<a href="javascript:void(0);">+ Add</a>
                    </div>
                    <div class="inline-group duration-show">
                        


<div class="input-group">
    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
    <input disabled onkeypress="return isNumberKey(event)" min="0" class="form-control input-narrow" id="" name="" type="number" value="<?php echo $dtp['lenght'];?>" data-parsley-id=""><span class="help-block validation-error" id=""></span>
</div>&nbsp;&nbsp;
<select disabled class="form-control" id="" name="" data-parsley-id="">
<option <?php if($dtp['duration_unit']==3) echo "selected";?> value="3">Ngày</option>
<option <?php if($dtp['duration_unit']==4) echo "selected";?> value="4">Tuần</option>
<option <?php if($dtp['duration_unit']==5) echo "selected";?> value="5">Tháng</option>
<option <?php if($dtp['duration_unit']==6) echo "selected";?> value="6">Năm</option>
</select><span class="help-block validation-error" id=""></span>
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                
                <div class="form-group ">
                    <span class="" for="Package_StartDate">Ngày bắt đầu</span>
                    <input disabled class="form-control hasDatepicker" data-custom="" id="" name="" type="date" min="<?php echo date("Y-m-d");?>" value="<?php echo $dtp['redemption_start_date'];?>" data-parsley-id=""><span class="help-block validation-error" id=""></span>
                    
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group ">
                    <span class="" for="Package_EndDate">Ngày kết thúc</span>
                    <input disabled class="form-control hasDatepicker" id="" name="" type="date" min="<?php echo date("Y-m-d");?>" value="<?php echo $dtp['redemption_end_date'];?>" data-parsley-id=""><span class="help-block validation-error" id=""></span>
                    
                </div>
            </div>
        </div>

        
       
    </div>
</div>

<?php     
if(!empty($dtps))
{  
?>          
    <div class="rg-row" id="">
    <input data-bind="value: ko.toJSON(concessionItems())" id="" name="" type="hidden" value="[]">
    <div class="col-md-12">
        <h5>Thành phần</h5>
        
    </div>

    <div class="col-md-12">

        <div class="rg-row">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">

            </div>
        </div>
        


        <div class="rg-row">
            <div class="col-sm-12">
                <div class="tabbable">
                    <!-- <ul class="nav nav-tabs" style="margin-left: 0;margin-bottom: 24px;">
                            <li class="active">
                                <a href="#specific-service" data-toggle="tab">Specific service</a>
                            </li>
                            <li class=""><a href="#any-service" data-toggle="tab">Any service</a></li>
                    </ul> -->
                    
                </div>
            </div>
        </div>

        <div class="rg-row">
            <div class="col-md-12 margin-bottom-05em">
                <div data-bind="visible: concessionItems().length == 0" class=" alert alert-info" style="display: none;">There are currently no items set up as part of this package</div>
                  
                <table id="" data-bind="visible: concessionItems().length > 0" class="table table-middle table-left">
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>
                                Giới hạn                               
                            </th>
                                             
                        </tr>
                    </thead>
                    <tbody data-bind="foreach: { data: concessionItems() }">
                        <?php 
                        foreach($dtps as $n)
                        {      
                        $csn=new CsService;                       
                        $dtcsn=$csn->findByPk($n['id_service']);     
                        if($n['type']==7)
                        {
                            $type="Visits";
                        }    
                        elseif($n['type']==2) 
                        {
                            $type="Giờ";
                        }  
                        elseif($n['type']==1)
                        {
                            $type="Phút";
                        } 
                        else
                        {
                            $type="Không có giới hạn mặc định";
                        }       
                        ?>
                        <tr>
                            <td data-bind="text: name"><?php echo $dtcsn['name'];?></td>
                            <td data-bind="text: limitDescription"><?php echo $n['quantity'];?> <?php echo $type;?></td>                            
                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
                
            </div>
        </div>



     

       
    </div>
</div>    
                               
<?php 
}
?>                            
                            </form>





                    </div>

                    <div class="col-md-12">
                            <div id="">
                                <div id="">
                                <button type="" id="" onclick="showEditPackage(<?php echo $dtp['id'];?>);" class="btn btn_bookoke">Chỉnh sửa</button>           
                                <span class="pull-right"><button type="button" class="btn btn_delete" onclick="deletePackage(<?php echo $dtp['id'];?>);">Xóa</button></span>
                                </div>
                            </div>
                        </div>

                    </div>
                        <?php include("popup_edit_package.php");?>
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

function readURLN(input,id) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blahn-'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function error_update_package(id){

    var status = true;

    if($('#name_package_'+id).val() == ''){
        status = false;       
        $('#ud-package-name-'+id).addClass('error');      
    }
    else{
        $('#ud-package-name-'+id).removeClass('error');
    }

    if($('#code_package_'+id).val() == ''){
        status = false;       
        $('#ud-package-code-'+id).addClass('error');     
    }
    else{
        $('#ud-package-code-'+id).removeClass('error');
    }    

    if($('#id_package_line_'+id).val() == ''){
        status = false;       
        $('#ud-package-line-'+id).addClass('error');     
    }
    else{
        $('#ud-package-line-'+id).removeClass('error');
    }

    if($('#costprice_package_'+id).val() == ''){
        status = false;       
        $('#ud-package-costprice-'+id).addClass('error');         
    }
    else{
        $('#ud-package-costprice-'+id).removeClass('error');
    }

    if($('#price_package_'+id).val() == ''){
        status = false;       
        $('#ud-package-price-'+id).addClass('error');         
    }
    else{
        $('#ud-package-price-'+id).removeClass('error');
    } 

    return status;
}
function udredemptionStartDate(id){
    $('#enddate_package_'+id).removeAttr("min").attr("min", $('#startdate_package_'+id).val());   
    if ($('#startdate_package_'+id).val()>$('#enddate_package_'+id).val()) {
        $('#enddate_package_'+id).val($('#startdate_package_'+id).val());
    }
}
function udredemptionEndDate(id){       
    $('#startdate_package_'+id).removeAttr("max").attr("max", $('#enddate_package_'+id).val());
    if ($('#enddate_package_'+id).val()<$('#startdate_package_'+id).val()) {
        $('#startdate_package_'+id).val($('#enddate_package_'+id).val());
    }
}
function showEditPackage(id){

    var elem = $('#edit-package-blur-'+id)[0];

    $(elem).fadeToggle(200,function(){
    });

    $(document).mouseup(function (e)
    {   

        var container = $(".edit-package-container");
        if(templock == 0){
            if (!container.is(e.target) && container.has(e.target).length === 0){      
                if (!$(".edlimitPopup").is(e.target) && $(".edlimitPopup").has(e.target).length === 0){   
                   if($(elem).is(':visible')){
                        templock = 1;
                        $(elem).fadeToggle(200,function(){
                            templock = 0;
                        });
                    }    
                }        
            } 
        }
    
    });

    $('.close_p').on('click',function(e){
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
// Package items
function error_add_services(id){

    var status = true;

    var k = $('#idservice'+id).val(); 

    $("#package_item"+id+" > tbody > tr td:last-child").each(function(){       
        var td=$(this).html();     
        if(k == td){
            status = false; 
        }
        
    });

    return status;
}
function addServices(id){     
    var selected = $('#idservice'+id+' option:selected').text();
    if(selected!=""){
        if (error_add_services(id)) {
            var k = $('#idservice'+id).val();
            $("#package_item"+id).removeClass("hidden");
            $('#btn-add-items'+id).removeAttr('disabled');
            $("#package_item"+id).find('tbody')
            .append($('<tr id="pss'+id+k+'">')
                .append('<td style="width: 50%;" data-bind="text: name">'+selected+'</td>')
                .append('<td data-bind="text: limitDescription" id="public-labels-'+id+k+'">Không có giới hạn mặc định</td>')                
                .append($('<td>')
                    .append($('<a class="btn btn-info btn-sm" onclick="editLimits('+id+','+k+');" data-bind="click: editLimits" href="javascript:void(0);">')
                        .append('<i class="fa fa-edit"></i>')                        
                    )
                    .append($('<a class="pop btn btn-danger btn-sm" onclick="deleteLimits('+id+','+k+');" href="javascript:void(0);" data-original-title="Delete package item" data-content="<a class=&quot;btn bln-close&quot;><i class=&quot;fa fa-times&quot;></i> Cancel</a> <a href=&quot;#&quot; data-concession-item-id=&quot;470402&quot; data-service-id=&quot;470402&quot; class=&quot;btn btn-danger concession-item-delete bln-close&quot;><i class=&quot;fa fa-trash-o&quot;></i> Delete</a>">')  
                        .append('<i class="fa fa-trash-o"></i>')
                    )
                )
                .append('<td class="hds'+id+'" style="display:none;">'+k+'</td>')
            );
        }
    }
    
}
function editLimits(id,k){ 
     
    $('#btn-editlimit'+id).attr('onclick','addEditLimits('+id+','+k+')'); 
    $('#ipt-editlimit'+id).val('1');  
    $('#ConcessionItemDurationOptions'+id).val('7'); 
    $('#editlimitPopup'+id).fadeToggle('fast');
    
}
$('.bln-close').click(function(){ 
    $('.edlimitPopup').hide();    
});
function deleteLimits(id,k){   
    if (confirm("Bạn có thật sự muốn xóa?")) {  
        var evt = window.event || arguments.callee.caller.arguments[0];
        evt.preventDefault(); 
        $('#pss'+id+k).remove();
        if($('.hds'+id).length == 0){
            $("#package_item"+id).addClass("hidden");
            $('#btn-add-items'+id).attr('disabled','disabled');
        }    
        evt.stopPropagation();
    }
}
$(document).mouseup(function (e)
{
    var container = $(".edlimitPopup");
    if (!container.is(e.target) 
        && container.has(e.target).length === 0) 
    {        
        container.hide();
    } 
});
function addEditLimits(id,k){ 

    var amount    = $('#ipt-editlimit'+id).val();
    var type = $('#ConcessionItemDurationOptions'+id+' option:selected').text();   
    var vle = $('#ConcessionItemDurationOptions'+id).val();  
  
    $('#public-labels-'+id+k).html(amount+" "+type); 

    if ($("#amount"+id+k).length > 0 || $("#vle"+id+k).length > 0){
       $('#amount'+id+k).html(amount);
       $('#vle'+id+k).html(vle);
    }
    else{
    $('#pss'+id+k).append('<td id="amount'+id+k+'" style="display:none;">'+amount+'</td>');
    $('#pss'+id+k).append('<td id="vle'+id+k+'" style="display:none;">'+vle+'</td>');
    }

    $('.edlimitPopup').hide(); 
}
// End Package items
function updatePackage(id){  
    if(error_update_package(id)){
        $('.cal-loading').fadeIn('fast');     

        var package_service = [];    
        $("#package_item"+id+" > tbody > tr").each(function(){       
            var id_service=$(this).children('td:nth-child(4)').html(); 
            var quantity = $(this).children('td:nth-child(5)').html();
            var type = $(this).children('td:nth-child(6)').html();

            var response = {};
            response['id_service'] = id_service; 
            response['quantity'] = quantity==""?"":quantity;
            response['type'] = type==""?"":type;
            package_service.push(response);        
        });


        var formData = new FormData($('#ud-package-form-'+id)[0]);
        formData.append('Package_Service',JSON.stringify(package_service));        
        if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({
            type:'POST',
            url: baseUrl+'/itemsProducts/Packages/updatePackage',
            data:formData,
            datatype:'json',
            success:function(data){ 
                if (data == '-1') {                         
                    $('#ud-package-code-'+id).addClass('error');              
                    $('.cal-loading').fadeOut('slow');
                    return false;
                }
                else
                {
                    $('#ud-package-code-'+id).removeClass('error');

                    $("#searchPackage").val(data);   
                    var elem = $('#edit-package-blur-'+id)[0];
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

function deletePackage(id){
    if (confirm("Bạn có thật sự muốn xóa?")) {     
        $('.cal-loading').fadeIn('fast');
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsProducts/Packages/deletePackage',    
            data: {"id":id},   
            success:function(data){
                if(data == '1')
                {
                    $('.cal-loading').fadeOut('slow'); 
                    window.location.assign("<?php echo CController::createUrl('Packages/View')?>"); 
                }                 
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });
    }      
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

$('.collapse').on('show.bs.collapse', function () {    
    $('.collapse.in').collapse('hide');
});

$(function(){
    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    $('.autoNum').autoNumeric('init',numberOptions);
});
</script>