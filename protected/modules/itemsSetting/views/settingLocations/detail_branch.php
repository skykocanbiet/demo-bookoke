<div class="statsTabContent tabContentHolder" style="margin-top:30px;">
<form id="frm-branch" class="location-form" method="post" novalidate="" onsubmit="return false;">    
<input type="hidden" name="save-add-another" id="save-add-another" value="false">
<input type="hidden" id="id_branch" value="<?php echo $model->id;?>">

<div class="rg-row">
    <div class="col-sm-12 col-bottom-margin  validation-summary hide">
        <div class="alert alert-error">
            <i class="fa fa-exclamation-triangle fa-2x pull-left"></i>
            Whoops, you are missing some required info
        </div>
    </div>
</div>    <div class="rg-row">
      
        <div class="col-md-12">
            <input id="Location_LocationId" name="Location.LocationId" type="hidden" value="68864"><input id="Location_BusinessId" name="Location.BusinessId" type="hidden" value="45390"><input id="Location_ContactId" name="Location.ContactId" type="hidden" value="14214809"><input id="Location_HoursId" name="Location.HoursId" type="hidden" value="750865"><input id="Origin" name="Origin" type="hidden" value="">
<input id="Tab" name="Tab" type="hidden" value="">


<div class="form-group required ">
    <label class="" for="Location_Name">Tên chi nhánh</label>
    <input onchange="updateBranch(<?php echo $model->id;?>);" class="form-control" id="Location_Name" name="name" type="text" value="<?php echo $model->name;?>" data-parsley-id="6655">
    <span class="help-block validation-error filled"><span id="branch_required" class="parsley-required"></span></span>
</div>



<div class="form-group">
    <label class="">Loại chi nhánh <a href="javascript:void(0);" rel="popover" data-content="If your appointments take place at a branch location or an office then choose the &quot;Fixed&quot; location type.<br />If you carry out your appointments on-site at your customers address then choose the &quot;Mobile&quot; location type." data-original-title="Location type" class="tip-init"><i class="fa fa-question-circle fa-fw">&nbsp;</i></a></label><br>

    <div class="btn-group btn-group-justified" data-toggle="buttons-radio">
        <a class="btn btn-padded location-type active" href="javascript:void(0);"><input checked="checked" class="hide fixed" id="Location_LocationTypeId" name="Location.LocationTypeId" type="radio" value="1">Cố định<br>(khách hàng liên hệ với bạn)</a>
        <a class="btn btn-padded location-type" href="javascript:void(0);"><input class="hide mobile" id="Location_LocationTypeId" name="Location.LocationTypeId" type="radio" value="2">Điện thoại di động<br>(bạn liên hệ với khách hàng)</a>
    </div>
</div>

<div class="form-group">
    <div class=" checkbox">
        <label>
<input onchange="updateBranch(<?php echo $model->id;?>);" <?php if($model->flag_online == 1) echo "checked";?> id="Location_CanBeBookedOnline" name="flag_online" type="checkbox" value="true" data-parsley-multiple="LocationCanBeBookedOnline" data-parsley-id="1065"><input name="Location.CanBeBookedOnline" type="hidden" value="false">            Khách hàng có thể đặt chi nhánh này trực tuyến

        </label>

    </div>
</div>

<div class="form-group" id="customer-address" style="display: none;">

    <div class="checkbox">
        <label>
            <input id="Location_CustomerAddressRequired" name="Location.CustomerAddressRequired" type="checkbox" value="true"><input name="Location.CustomerAddressRequired" type="hidden" value="false"> Appointments require an address from the customer
        </label>
    </div>

</div>

<div id="contact-details">
    <div class="form-group ">
        <label class="">Điện thoại</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            <input onchange="updateBranch(<?php echo $model->id;?>);" autocomplete="off" class="form-control" id="Location_Contact_Telephone" name="hotline1" type="text" value="<?php echo $model->hotline1;?>" data-parsley-id="5775">
        </div>

    </div>
    <div class="form-group add-address hide" style="display: none;">
        <a href="javascript:void(0);">Add an office/billing address</a>
    </div>
    <div id="address">

        <div class="rg-row">
            <div class="col-sm-6" style="padding:0px;">
                <div id="PhysicalAddressOneGroup" class="form-group  required">
                    <label class="" for="Location_Contact_PhysicalAddress1">Địa chỉ</label>
                    <input onchange="updateBranch(<?php echo $model->id;?>);" autocomplete="off" class="form-control" id="Location_Contact_PhysicalAddress1" name="address" type="text" value="<?php echo $model->address;?>" data-parsley-required="true" data-parsley-id="4637">
                </div>
              
            </div>
            <div class="col-sm-6" style="padding:0px;">
                <div id="PhysicalCityGroup" class="form-group  required">
                    <label class="" for="Location_Contact_PhysicalCity">Thành phố</label>
                   
                    <?php
                        $city = array();
                        $list_data = $model->getListCity();

                        foreach($list_data as $temp){
                            $city[$temp['id']] = $temp['name_long'];
                        }
                        echo CHtml::dropDownList('id_city','',$city,array('onchange'=>'updateBranch('.$model->id.');','class'=>'form-control','empty' => 'Chọn thành phố','options'=>array($model->id_city=>array('selected'=>true))));
                    ?>
                </div>
            </div>
        </div>
    </div>


</div>

<script>

    function toggleAddress(flag) {

        if ($('.fixed').prop('checked')) { 
            if (flag == 1) {
                $(".location-type").removeClass('active');
            }              
            $('#customer-address').hide();
            enableAddressValidations(true);
        }
        else {
            $(".location-type").removeClass('active');
            $('#customer-address').show();            
            enableAddressValidations(false);
        }
    }

    function enableAddressValidations(enable) {
        $('#Location_Contact_PhysicalAddress1').attr('data-parsley-required', enable);
        $('#Location_Contact_PhysicalCity').attr('data-parsley-required', enable);

        if (enable) {
            $('#PhysicalAddressOneGroup').addClass('required');
            $('#PhysicalCityGroup').addClass('required');
        } else {
            $('#PhysicalAddressOneGroup').removeClass('required');
            $('#PhysicalCityGroup').removeClass('required');
            $('#PhysicalAddressOneGroup').removeClass('error');
            $('#PhysicalCityGroup').removeClass('error');
        }
        
    }

    $(".location-type").click(function () {
        $(this).find("input:radio").prop("checked", true);
        toggleAddress(1);
    });

    $('.add-address').click(function() {
        $('.add-address').hide();
        $('#address').show();
    });

    $(document).ready(function () {
        toggleAddress(0);
    });

</script>

        </div>
    </div>
    <hr class="">
    <div class="rg-row ">
        
    <div class="col-md-12">

<input id="Location_Hours_HoursId" name="Location.Hours.HoursId" type="hidden" value="750865">
<div class="" id="hours-750865">
    <?php
    if (!empty($data)) 
    {       
    foreach ($data as $key => $value) 
    {
        switch ($value->weekday) {           
            case 2:
                $weekday = 'Thứ hai';
                $wd      = 'Monday';
                break;
            case 3:
                $weekday = 'Thứ ba';
                $wd      = 'Tuesday';
                break;
            case 4:
                $weekday = 'Thứ tư';
                $wd      = 'Wednesday';
                break;    
            case 5:
                $weekday = 'Thứ năm';
                $wd      = 'Thursday';
                break;
            case 6:
                $weekday = 'Thứ sáu';
                $wd      = 'Friday';
                break;    
            case 7:
                $weekday = 'Thứ bảy';
                $wd      = 'Saturday';
                break; 
            case 8:
                $weekday = 'Chủ nhật';
                $wd      = 'Sunday';
                break;      
        }   

    ?>   

    <div class="inline-blocker-row day-group">
        <div class="inline-blocker inline-blocker--fixed">
            <label class="big-check big-check--left checkbox">
                <input <?php if($value->status) echo "checked";?> id="Location_Hours_<?php echo $wd;?>Open" name="Location.Hours.<?php echo $wd;?>Open" type="checkbox" value="true" data-id="<?php echo $value->id;?>" data-parsley-multiple="LocationHours<?php echo $wd;?>Open"><input name="Location.Hours.<?php echo $wd;?>Open" type="hidden" value="false">
                <span class="big-check-indicator"></span>
                <span></span>
            </label>
            <label for="Location_Hours_<?php echo $wd;?>Open"><?php echo $weekday;?></label>
        </div>
        <div class="timeselect-group">

            <div class="inline-blocker">
                
                <span class="timeselect" id="Location_Hours_<?php echo $wd;?>Start-timeselect">

                    <input autocomplete="off" type="hidden" id="Location_Hours_<?php echo $wd;?>Start" name="Location.Hours.<?php echo $wd;?>Start" value="09:00">
        
                    <input type="hidden" class="timeselect__isTwentyFourTime" value="false">    

                    <span class="drop-container btn">
              
                        <select onchange="updateBranchSchedule(<?php echo $value->id;?>,<?php echo $value->weekday;?>,0);" id="Hours_<?php echo $value->weekday;?>_Start" name="hours" class="timeselect__hours form-control drop-select select-menu">                               
                                <?php 
                                for ($i=1; $i <= 12; $i++) 
                                {                                 
                                ?>  
                                <option value="<?php echo $i;?>" <?php if($i == date("h", strtotime($value->start_time))) echo "selected";?> ><?php echo $i;?></option>
                                <?php  
                                }
                                ?>
                        </select>

                    </span>

                </span>
    
                <span class="drop-container btn">

                    <select onchange="updateBranchSchedule(<?php echo $value->id;?>,<?php echo $value->weekday;?>,0);" id="Minutes_<?php echo $value->weekday;?>_Start" name="minutes" class="timeselect__minutes form-control drop-select select-menu"> 
                            <?php 
                            for ($i=0; $i <= 59; $i++) 
                            {                                 
                            ?>  
                            <option value="<?php echo $i;?>" <?php if($i == date("i", strtotime($value->start_time))) echo "selected";?> ><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                            <?php  
                            }
                            ?>                            
                    </select>
                </span>
    
            <span class="drop-container btn">       
                <select onchange="updateBranchSchedule(<?php echo $value->id;?>,<?php echo $value->weekday;?>,0);" id="AmPm_<?php echo $value->weekday;?>_Start" name="ampm" class="timeselect__ampm form-control drop-select select-menu">
                    <option value="am" <?php if("am" == date("a", strtotime($value->start_time))) echo "selected";?> >am</option>
                    <option value="pm" <?php if("pm" == date("a", strtotime($value->start_time))) echo "selected";?> >pm</option>
                </select>
            </span>



            </div>

            <div class="inline-blocker">
                to
            </div>

            <div class="inline-blocker">
                
                <span class="timeselect" id="Location_Hours_<?php echo $wd;?>End-timeselect">

                    <input autocomplete="off" type="hidden" id="Location_Hours_<?php echo $wd;?>End" name="Location.Hours.<?php echo $wd;?>End" value="17:00">
                    
                        <input type="hidden" class="timeselect__isTwentyFourTime" value="false">    

                        <span class="drop-container btn">

                        <select onchange="updateBranchSchedule(<?php echo $value->id;?>,<?php echo $value->weekday;?>,1);" id="Hours_<?php echo $value->weekday;?>_End" name="hours" class="timeselect__hours form-control drop-select select-menu">
                                <?php 
                                for ($i=1; $i <= 12; $i++) 
                                {                                 
                                ?>  
                                <option value="<?php echo $i;?>" <?php if($i == date("h", strtotime($value->end_time))) echo "selected";?> ><?php echo $i;?></option>
                                <?php  
                                }
                                ?>
                        </select>
                    </span>
                    
                    <span class="drop-container btn">
                      
                        <select onchange="updateBranchSchedule(<?php echo $value->id;?>,<?php echo $value->weekday;?>,1);" id="Minutes_<?php echo $value->weekday;?>_End" name="minutes" class="timeselect__minutes form-control drop-select select-menu">
                                <?php 
                                for ($i=0; $i <= 59; $i++) 
                                {                                 
                                ?>  
                                <option value="<?php echo $i;?>" <?php if($i == date("i", strtotime($value->end_time))) echo "selected";?> ><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                <?php  
                                }
                                ?> 
                        </select>

                    </span>
                    
                    <span class="drop-container btn">

                        <select onchange="updateBranchSchedule(<?php echo $value->id;?>,<?php echo $value->weekday;?>,1);" id="AmPm_<?php echo $value->weekday;?>_End" name="ampm" class="timeselect__ampm form-control drop-select select-menu">
                            <option value="am" <?php if("am" == date("a", strtotime($value->end_time))) echo "selected";?> >am</option>
                            <option value="pm" <?php if("pm" == date("a", strtotime($value->end_time))) echo "selected";?> >pm</option>
                        </select>
                    </span>

                </span> 


            </div>

        </div>

    </div>

    <?php        
    }
    }
    ?>    

</div>

<script>
    
    $(function () {
        
        $("#hours-750865 .checkbox input[type=checkbox]").change(function (e) {     
            e.preventDefault();
            var group = $(this).closest('.day-group');   
            var isWorking = this.checked;
            var inputs = $('input[type=hidden]', group);
            inputs.prop('readonly', !isWorking);
            var inputHolder = inputs.closest('.timeselect-group');
            if (isWorking) {
                group.find('.timeselect-group').removeClass('hide'); 

                var id = $(this).attr("data-id");            
                updateBranchStatus(id,1);
            }else {
                group.find('.timeselect-group').addClass('hide');

                var id = $(this).attr("data-id");               
                updateBranchStatus(id,0);
            }
             
        });

        $("#hours-750865 .day-group").each(function () {       
            var group = $(this);
            var isWorking = $('input[type="checkbox"]:checked', group).val() == "true";
            var inputs = $('input[type=hidden]', group);
            var inputHolder = inputs.closest('.timeselect-group');
            inputs.prop('readonly', !isWorking);
            inputHolder.toggleClass('hide', !isWorking);
            group.find('.not-working').toggleClass('hide', isWorking);         
        });


    });

</script>

            


        </div>
    </div>
       
</form>
</div>

<script type="text/javascript">

function err(id){

    if (!id) {        
        return false;      
    }

    var status = true;      
    
    if ($('#Location_Name').val() == '') {
        status = false;
        $('#branch_required').html('Bạn phải nhập tên chi nhánh.');        
    }else {
        $('#branch_required').html('');
    }
     
    return status;
}

function updateBranch(id){    
    if(err(id)){   

        var name = $('#Location_Name').val();
        if(document.getElementById('Location_CanBeBookedOnline').checked) {
            var flag_online = 1;
        }else {
            var flag_online = 0;
        }
        var hotline1 = $('#Location_Contact_Telephone').val();
        var address  = $('#Location_Contact_PhysicalAddress1').val();
        var id_city  = $('#id_city').val();

        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSetting/SettingLocations/updateBranch',  
            data: {"id":id,"name":name,"flag_online":flag_online,"hotline1":hotline1,"address":address,"id_city":id_city},   
            success:function(data){    
                searchBranchs(data);
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });
    }   
}

function updateBranchStatus(id, status){    
   
    var id_branch = $('#id_branch').val();

    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsSetting/SettingLocations/updateBranchStatus',  
        data: {"id":id,"status":status},   
        success:function(data){  
            searchBranchs(id_branch);
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });     
}

function updateBranchSchedule(id, weekday, flag){     

    var id_branch = $('#id_branch').val();

    if (flag == 0) {

        var hours   = $('#Hours_'+weekday+'_'+'Start').val();  
        
        var minutes = $('#Minutes_'+weekday+'_'+'Start').val();

        var ampm    = $('#AmPm_'+weekday+'_'+'Start').val();

    }else {

        var hours   = $('#Hours_'+weekday+'_'+'End').val();  
        
        var minutes = $('#Minutes_'+weekday+'_'+'End').val();

        var ampm    = $('#AmPm_'+weekday+'_'+'End').val();

    }    

    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsSetting/SettingLocations/updateBranchSchedule',  
        data: {"id":id,"flag":flag,"hours":hours,"minutes":minutes,"ampm":ampm},   
        success:function(data){      
            searchBranchs(id_branch);
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });
     
}

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














































