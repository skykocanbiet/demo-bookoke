
<table id="stock" class="table table-boooke" role="grid" aria-describedby="stock_info" style="border-collapse:collapse;">
    <thead>
        <tr role="row">
            <th tabindex="0" aria-controls="stock" rowspan="1" colspan="1"  aria-label="Name: activate to sort column ascending">
            Mã dịch vụ
            </th>
            <th tabindex="0" aria-controls="stock" rowspan="1" colspan="1" aria-label="SKU: activate to sort column ascending">
            Tên dịch vụ
            </th>
            <th tabindex="0" aria-controls="stock" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending">Thời gian thực hiện</th><th tabindex="0" aria-controls="stock" rowspan="1" colspan="1"  aria-label="Price: activate to sort column ascending">
            Giá bán
            </th>          
        </tr>
    </thead>
    <tbody id="bodyTblContent">
    <?php     
    if(!empty($data))
    {          
        foreach ($data as $k => $v) 
        {
    ?>
        <tr data-toggle="collapse" data-target="#demo<?php echo $k+1;?>" class="accordion-toggle background-color-f1f5f6">
            <td><?php echo $v['code'];?></td>
            <td><?php echo $v['name'];?></td>
            <td><?php echo $v['length'];?> phút</td>
            <td class="autoNum"><?php echo $v['price'];?></td>            
        </tr>
        <tr class="background-color-fff">
            <td colspan="4" class="hiddenRow" style="text-align: left;">
                <div class="accordian-body collapse oView col-md-12 <?php if(count($data)==1) echo "in";?>" id="demo<?php echo $k+1;?>">
                   
                    <div class="oViewDetail col-md-12">

                        <div id="oInfo" class="col-md-12">

                            <form class="ud-service-form" id="" action="" onsubmit="return false;" method="post" novalidate="">    
                                
                                <div class="t-settings-head">
                                    
                                    
                                </div>

                                <div class="rg-row">
                                       
                                <div class="col-md-12" style="margin-top:10px;">  

                                <div class="rg-row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <span>Mã dịch vụ</span>                                            
                                            <input disabled class="form-control" type="text" value="<?php echo $v['code'];?>">  
                                        </div>
                                    </div>
                                    <div class="col-sm-4">                     
                                        <div class="form-group">
                                            <span>Tên dịch vụ</span>
                                            <div class="input-group">

                                                <div class="input-group-addon">
                                                    <div class="btn-group service-color-pallet-holder">
                                                        <a class="dropdown-toggle">
                                                            <code class="<?php echo $v['color'];?>"></code>
                                                            <span class="caret"></span>
                                                        </a>                                                       
                                                    </div>
                                                </div>

                                                <input disabled class="form-control" type="text" value="<?php echo $v['name'];?>">
                                               
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <span>Nhóm dịch vụ</span>                          
                                                <?php
                                                $group_service = array();
                                                foreach($model->getListServiceType() as $temp){
                                                    $group_service[$temp['id']] = $temp['name'];
                                                }                            
                                                echo CHtml::dropDownList('id_service_type','',$group_service,array('disabled'=>'disabled','class'=>'form-control','empty' => 'Chọn nhóm dịch vụ','options'=>array($v['id_service_type']=>array('selected'=>true))));
                                                ?>                 
                                              
                                            </div>
                                        </div>
                                   

                                </div>

                                 

                                <div class="form-group ">
                                    <span>Mô tả</span>
                                    <span class="char-count-container">
                                        <textarea disabled class="char-count-1000 form-control" cols="20" rows="2"><?php echo $v['description'];?></textarea>
                                    </span>
                                </div>
                               
                                <div class="form-group">
                                    <div class="checkbox">

                                        <label>
                                            <input disabled <?php if($v['status_hiden']==1) echo "checked"; else echo "";?> type="checkbox">
                                            Khách hàng có thể đăng kí dịch vụ trực tuyến
                                        </label>
                                        
                                    </div>
                                   

                                </div>    
                               

                                <div class="clearfix"></div>
                                <div class="rg-row">
                                    <div class="col-sm-3">
                                        <div class="form-group ">

                                            <span>Giá dịch vụ</span><br>

                                            <div class="inline-group">   

                                                <span class="price-display">
                                                    <div class="input-group">
                                                        
                                                        <input disabled value="<?php echo number_format($v['price'],0,"","");?>" class="price-input form-control input-narrow autoNum" type="text">
                                                        <div class="input-group-addon"><?php echo $model->currency_code;?></div>
                                                    </div>
                                                    
                                                </span>                              

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <span>Thuế</span><br>
                                            <div class="inline-group">
                                            <div class="input-group">
                                                
                                                <input disabled class="tax-input form-control input-narrow" type="text" value="<?php echo $v['tax'];?>">                             
                                                  <div class="input-group-addon">%</div> 
                                            </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <span>Thời gian thực hiện</span><br>
                                            <div class="input-group-duration">
                                                <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                                <span class="ui-timepicker-container">

                                                <input disabled class="duration-input form-control input-narrow ui-timepicker-input" type="number" value="<?php echo $v['length'];?>">                   
                                              
                                                </span>
                                            </div>
                                   
                                        </div>
                                    </div>



                                    <div class="col-sm-3">
                                       <div class="rg-row">
                                       
                                        <div class="col-md-12">  

                                            <span class="">Nhân viên thực hiện</span><br>

                                        <div class="rg-row">
                                            <div class="col-md-12">
                                                <select disabled class="staff" multiple="multiple">
                                                    <optgroup label="Chọn tất cả">
                                                        <?php    
                                                        $staff_list=$model->getListDentists();                                                      
                                                        $selected=$model->getListServiceUserSelected($v['id']);   
                                                        foreach ($staff_list as $s_l) 
                                                        {
                                                        ?>
                                                        <option value="<?php echo $s_l['id'];?>" 
                                                        <?php 
                                                        foreach ($selected as $s) {
                                                            if ($s_l['id']==$s['id_user']) { 
                                                                echo "selected";
                                                            }
                                                        }
                                                        ?>
                                                        >
                                                        <?php echo $s_l['name'];?>
                                                        </option>
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
                                            <div class="form-group">

                                                <span>Điểm được tặng khi mua dịch vụ</span>
                                                <span style="width: 77px;margin-left: 15px;display: inline-block;">
                                                    <input disabled class="form-control" type="text" value="<?php echo $v['point_donate'];?>">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <span>Điểm cần có để quy đổi dịch vụ</span>
                                                <span style="width: 77px;margin-left: 15px; display: inline-block;"> 
                                                    <input disabled class="form-control" id="point_change_service" type="text" value="<?php echo $v['point_exchange'];?>">
                                                </span>
                                            </div>
                                        </div>
                                       

                                    </div>

                                        
                                        </div>

                                    </div>

                                </form>




                        </div>
                        <div class="col-md-12">
                            <div id="pBtn">
                                <div id="pBtnL">
                                <button onclick="showEditService(<?php echo $v['id'];?>);" class="btn btn_bookoke">Chỉnh sửa</button>
                                <span class="pull-right"><button type="button" class="btn btn_delete" onclick="deleteService(<?php echo $v['id'];?>);">Xóa</button></span>
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
  
        $('.cal-loading').fadeIn('fast'); 

        var formData = new FormData($('#ud-service-form-'+id)[0]); 

        if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({
            type:'POST',  
            url: baseUrl+'/itemsProducts/PriceBook/updateService', 
            data:formData,
            datatype:'json',
            success:function(data){              

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

function deleteService(id){
    if (confirm("Bạn có thật sự muốn xóa?")) {     
        $('.cal-loading').fadeIn('fast');
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsProducts/PriceBook/deleteService',               
            data: {"id":id},   
            success:function(data){
                if(data == '1')
                {
                    detailPriceBook(<?php echo $model->id;?>);
                }                 
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });
    }      
}

$(function() {
    $("#customerList li")
        .mouseover(function() { 
            $(this).find("img").removeClass("hide");         
        })
        .mouseout(function() {                  
            $(this).find("img").addClass("hide");    
        })    
});

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

    $('.staff').multiselect({
        enableClickableOptGroups: true,
        enableCollapsibleOptGroups: true
    }); 

    $('.service').multiselect({
        enableClickableOptGroups: true,
        enableCollapsibleOptGroups: true
    }); 

});

function disabled_edit_time(id)
{
    var form = "#frm-price-book"+id;
    
    $(form+" span[name=on_time]").addClass("On");    
    $(form+" span[name=off_time]").addClass("Off");    
    $(form+" span[name=switch_time]").addClass("Switch");    
    $(form+" input[name=daterange]").addClass("hidden");  
  
    $(form+" input[name=hidden_time]").val(0);  
}

function edit_effect(id)
{
    var form = "#frm-price-book"+id; 
   
    $(form+" span[name=on_effect]").toggleClass("On");
    $(form+" span[name=off_effect]").toggleClass("Off");
    $(form+" span[name=switch_effect]").toggleClass("Switch");   

    if ($(form+" input[name=effect]").val() == 0) {      
        $(form+" input[name=effect]").val(1); 
        $(form+" div[name=change_time]").attr('onclick','edit_time('+id+')');
    }else {    
        $(form+" input[name=effect]").val(0);
        $(form+" div[name=change_time]").removeAttr('onclick');
        disabled_edit_time(id);
    }
    
}

function edit_time(id)
{
    var form = "#frm-price-book"+id;

    $(form+" span[name=on_time]").toggleClass("On");
    $(form+" span[name=off_time]").toggleClass("Off");
    $(form+" span[name=switch_time]").toggleClass("Switch");
    $(form+" input[name=daterange]").toggleClass("hidden");  

    if ($(form+" input[name=hidden_time]").val() == 0) 
        $(form+" input[name=hidden_time]").val(1); 
    else 
        $(form+" input[name=hidden_time]").val(0);
  
}

$(function() {
    $('.daterange').daterangepicker({
        timePicker: true,
        timePickerIncrement: 365,
        locale: {
            format: 'MM/DD/YYYY h:mm:ss'
        }
    });
});

function updatePriceBook(id){  

    var form = "#frm-price-book"+id;   

    if($(form+" input[name=name]").val() != "" && $(form+" select[name=id_segment]").val() != "" && $(form+" select[name=id_service]").val() != "" && $(form+" select[name=currency_code]").val() != ""){
 
        $('.cal-loading').fadeIn('fast');                 

        var formData = new FormData($(form)[0]); 

        formData.append('id',id);

        if($(form+" input[name=hidden_time]").val() == 0)       
            formData.append('daterange',""); 

        if (!formData.checkValidity || formData.checkValidity()) {

            jQuery.ajax({
                type:'POST',
                url: baseUrl+'/itemsProducts/PriceBook/updatePriceBook',
                data:formData,
                datatype:'json',
                success:function(data){ 
                    if (data > 0) {
                        $("#quote_modal").removeClass("in");
                        $(".modal-backdrop").remove();                       
                        $(form).modal('hide');                     
                        searchPriceBook(data);                   
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

    }else{
        return false;
    }

}

function deletePriceBook(id){  

    if (confirm("Bạn có thật sự muốn xóa?")) {     
        $('.cal-loading').fadeIn('fast');
        var form = "#frm-price-book"+id; 
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsProducts/PriceBook/deletePriceBook',    
            data: {"id":id},   
            success:function(data){
                if(data > 0)
                {
                    $("#quote_modal").removeClass("in");
                    $(".modal-backdrop").remove();                       
                    $(form).modal('hide');
                    searchPriceBook();
                }                 
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });
    }      
}

$(function(){
    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    $('.autoNum').autoNumeric('init',numberOptions);
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

</script>





