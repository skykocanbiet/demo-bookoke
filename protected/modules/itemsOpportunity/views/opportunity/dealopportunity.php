<div class="customerProfileContainer">
    <div id="customerProfileDetail" class="customerProfileHolder" style="display: block;">

        <div id="content" style="padding-right: 0;">
        
        <ul id="menuk" class="menuk">
        <?php
      
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/bootstrap-typeahead.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/bootstrap-popover.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/date-en-US.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/jquery.ui.timeselect.js");
        ?>
        </ul>

        <div id="description" class="contentk" style="padding: 0px;height: 100%;min-height: 900px;">
            <!-- Body Deal -->
            <div id="application">
                <div id="pipelineCanvas">
                    <div id="pipelineContainer">                     
                        <div id="return_content" class="pipeline">
                                
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- AddNew Deal -->
            <?php include_once('addnew_deal_opportunity.php'); ?>
         
        </div>
            <!-- AddNew Schedule Activity -->
            <?php  include_once('frm_opportunity_activity.php');?>
        </div>
    </div>

</div>
<script>
    function UpdateStageOpportunity(id,stage){
        
        jQuery.ajax({   
                type:"POST",
                url:"<?php echo CController::createUrl('Opportunity/UpdateStageOpportunity')?>",
                data:{
                    id             :  id,
                    stage          :  stage,
                },
                beforeSend: function(){
                    $('#idwaiting_main').html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/waitingmain.gif" alt="loading....." />');
                },
                success:function(data){
                    if(data == 0){
                        $('#idwaiting_main').html('');
                        return false;
                    }
                    
                    var getData = $.parseJSON(data)
                    
                    if(getData.id == id){
                        var pluralDealOld = getData.totalDealOld>1?"cơ hội":"cơ hội";
                        var pluralDealNew = getData.totalDealNew>1?"cơ hội":"cơ hội";

                        if(getData.totalDealOld > 0){
                            $('ul [data-stage-id='+getData.stageOld+'] .stagevalue .value').html('<span style="float:left;">'+getData.totalDealOld+' '+pluralDealOld+'</span><span style="margin-right: 5px;float:right;">'+getData.valueDealOld+'</span>');
                        }else{
                            $('ul [data-stage-id='+getData.stageOld+'] .stagevalue .value').html('');
                        }
                        
                        if($('ul [data-stage-id='+stage+']').find('.stagevalue .value').length > 0){
                             $('ul [data-stage-id='+stage+'] .stagevalue .value').html('<span style="float:left;">'+getData.totalDealNew+' '+pluralDealNew+'</span><span style="margin-right: 5px;float:right;">'+getData.valueDealNew+'</span>');
                        }else{
                            $('ul [data-stage-id='+stage+']').append('<span class="stagevalue"><span class="value"><span style="float:left;">'+getData.totalDealNew+' '+pluralDealNew+'</span><span style="margin-right: 5px;float:right;">'+getData.valueDealNew+'</span></span></span>')
                        }
                        
                        $('#idwaiting_main').html('');                        
                    	return id;
                    }
                    return false;
                },
        });
    }
    function AddnewDealOpportunity(){
        
        var stage               = $("#addnew_stage .widget-radio" ).find('input:checked').val();        
       
        var contact_person_name = $('#addnew_contact_person_name').val();
        // var organization_name   = $('#addnew_organization_name').val();
        var email               = $('#addnew_email').val();
        var phone               = $('#addnew_phone').val();
        var deal_value          = $("#addnew_deal_value").val();
        var title               = $("#addnew_title").val();
        var finish_date         = $("#addnew_finish_date").val();    
        var currency            = $("#addnew_currency").val();

        if(contact_person_name == ""){
            $("#alertAddnewDeal").removeClass('hiden').html('<span class="alert alert-error" >Bạn chưa nhập tên người đại diện!</span>');            
            return false;
        }  

        if(email == ""){
            $("#alertAddnewDeal").removeClass('hiden').html('<span class="alert alert-error" >Bạn chưa nhập email!</span>');            
            return false;
        } 

        if(phone == ""){
            $("#alertAddnewDeal").removeClass('hiden').html('<span class="alert alert-error" >Bạn chưa nhập số điện thoại!</span>');            
            return false;
        }     

        if(title == ""){
            $("#alertAddnewDeal").removeClass('hiden').html('<span class="alert alert-error" >Bạn chưa nhập cơ hội!</span>');            
            return false;
        }    
        
        jQuery.ajax({
            type:"POST",
            url:"<?php echo CController::createUrl('Opportunity/AddnewDealOpportunity')?>",
            data:{               
                contact_person_name : contact_person_name,
                // organization_name   : organization_name,
                email               : email,
                phone               : phone,
                deal_value          : deal_value,
                title               : title,
                stage               : stage,
                finish_date         : finish_date,
                currency            : currency
            },
            beforeSend: function() {
                $('#idwaiting_convert_product').html('<i class="fa-li fa fa-spinner fa-spin"></i>');
            },
            success:function(data){               
                if(data == '1'){
                    AjaxSearchDealOpportunity(data);                    
                    $("#modalAddNewDeal").modal('hide');                    
                }               
                else{                  
                    $("#alertAddnewDeal").removeClass('hiden').html('<span class="alert alert-error" >Error ! Please check back value.</span>')
                }       
                      
            },
            error: function(data){ 
                $('#idwaiting_convert_product').html('');
                alert("Error occured.Please try again!");
            },
        });
    }
    function view_schedule_activity(id){
        var currdate = new Date();
        var currdate = (currdate.getMonth()+ 1) + '-' + currdate.getDate() + '-' + currdate.getFullYear();
        
        $('.btn-type-sch').removeClass('active-bth-type-sch');
        $('#type_schedule_1').addClass('active-bth-type-sch');
        $("#addnew_sch_date").val('');
        $("#addnew_sch_time").val('');
        $("#addnew_sch_duration").val('');
        $("#addnew_sch_type").val('');
        $("#addnew_sch_note").val('');
        $("#addnew_name_schedule").val('');
        $('#addnew_sch_checkbox').attr('checked', false);
        
        $("#alertErrorScheduleActivity").addClass('hiden');
        jQuery.ajax({
            type:"POST",
            url:"<?php echo CController::createUrl('Opportunity/view_schedule_activity')?>",
            data:{
                id  : id,
            },
            success:function(data){
                var getData = $.parseJSON(data);
                //console.log(getData);
                if(getData){
                    $("#addnew_id_deal").val(getData.id);                
                    $("#addnew_sch_title").val(getData.title);
                    $("#addnew_sch_contact_person_name").val(getData.contact_person_name);
                    $("#addnew_sch_organization_name").val(getData.organization_name);
                    $("#addnew_sch_id_user").val(getData.userid);                     
                }
            },
            error: function(data){ 
                alert("Error occured.Please try again!");
            },
        });
    }
    function edit_schedule_activity(id){
        
        jQuery.ajax({
            type:"POST",
            url:"<?php echo CController::createUrl('Opportunity/edit_schedule_activity')?>",
            data:{
                id  : id,
            },
            success:function(data){                
                var getData = $.parseJSON(data);
                //console.log(getData);
                if(getData){
                    
                    $("#addnew_id_schedule").val(getData.id);
                    $("#addnew_sch_duration").val(getData.duration.substr(0,5));
                    $("#addnew_name_schedule").val(getData.name_schedule);
                    $("#addnew_sch_note").val(getData.note);
                    if(getData.st==2) $("#addnew_sch_checkbox").attr('checked', true); else $("#addnew_sch_checkbox").attr('checked', false);                                   
                    
                    $('.btn-type-sch').removeClass('active-bth-type-sch');
                    $('#type_schedule_'+getData.type_schedule).addClass('active-bth-type-sch');
                    
                    var substr_date_schedule = getData.datetime_schedule.substr(0,10);
                    var split_date_schedule = substr_date_schedule.split("-");
                    var date_schedule = split_date_schedule[2]+"/"+split_date_schedule[1]+"/"+split_date_schedule[0];
                    $("#addnew_sch_date").val(date_schedule);
                    
                    if(getData.time_schedule==null){
                        $("#addnew_sch_time").val(''); 
                    }
                    else{
                        var time_schedule = getData.time_schedule.substr(0,5);
                        if(getData.time_schedule.substr(0,2) > 12){
                           var $am_pm = 'PM';
                        }else{
                           var $am_pm = 'AM'; 
                        }                    
                        $("#addnew_sch_time").val(time_schedule+' '+$am_pm); 
                    }
                    
                }
            },
            error: function(data){ 
                alert("Error occured.Please try again!");
            },
        });
        
    }
    
    function save_schedule_activity(){
        
        var id            = $("#addnew_id_schedule").val();
        var id_opportunity= $("#addnew_id_deal").val();        
        var name_schedule = $("#addnew_name_schedule").val();
        if(name_schedule=="") name_schedule = $("#addnew_name_schedule").attr("placeholder");
        var note          = $("#addnew_sch_note").val();
        var date_schedule = $("#addnew_sch_date").val();   
        if(date_schedule=="") date_schedule = $("#addnew_sch_date").attr("placeholder");     
        var time_schedule = $("#addnew_sch_time").val();
        var duration      = $("#addnew_sch_duration").val();
        var userid        = $("#addnew_sch_id_user").val();
        var type_schedule = $("input[name='type_schedule']:checked").val();
        var title         = $("#addnew_sch_title").val();
        var contact_person_name = $("#addnew_sch_contact_person_name").val();
        var organization_name   = $("#addnew_sch_organization_name").val();   
        if ($('#addnew_sch_checkbox').is(':checked')) var st = 2; else var st = 1;     

        var datetime_schedule = date_schedule+' '+ConvertTimeformat('00:00',time_schedule);
        if(time_schedule=="") time_schedule = ""; else time_schedule = ConvertTimeformat('00:00',time_schedule);      
        
        jQuery.ajax({
            type:"POST",
            url:"<?php echo CController::createUrl('Opportunity/save_schedule_activity')?>",
            data:{
                id                  :   id,
                id_opportunity      :   id_opportunity,
                name_schedule       :   name_schedule,
                note                :   note,
                datetime_schedule   :   datetime_schedule,                
                time_schedule       :   time_schedule,
                type_schedule       :   type_schedule,
                duration            :   duration,
                title               :   title,
                contact_person_name :   contact_person_name,
                organization_name   :   organization_name,
                st                  :   st                          
            },
            success:function(data){                           
                if (st == 1) $("#modalAddnewScheduleActivity").modal('hide');

                if(data == 1){
                 
                    AjaxSearchDealOpportunity(data);  

                    if (st == 2) {  
                        $("#modalAddnewScheduleActivity").slideUp().slideDown();    
                        view_schedule_activity(id_opportunity);
                    }    
                    
                }
            },
            error: function(data){
                alert("Error occured.Please try again!");
            },
        }); 
        
    }
    function returnViewActivity(id){
        jQuery.ajax({
            type:"POST",
            url:"<?php echo CController::createUrl('Opportunity/return_view_activity')?>",
            data:{
                id  : id,
            },
            success:function(data){
                $("#activity"+id).find('.DealActivity').html(data);
            },
            error: function(data){ 
                alert("Error occured.Please try again!");
            },
        });
    }
    function exportcsv(){
        var url="<?php echo CController::createUrl('Opportunity/Export')?>";
        window.open(url,'name');
    }
    function checkIconDateChange(id,datetime_schedule) {
        var CurrentDate = new Date();
        var ChangeDate  = new Date(datetime_schedule);
        if(ChangeDate.getDate() == CurrentDate.getDate()){
            $("#schedule_an_activity"+id).find('.icon').html('<i class="fa fa-chevron-circle-right icon_to_date"></i>');

        }else if(ChangeDate.getDate() < CurrentDate.getDate()){
            $("#schedule_an_activity"+id).find('.icon').html('<i class="fa fa-chevron-circle-right icon_out_of_date"></i>');

        }else{
            $("#schedule_an_activity"+id).find('.icon').html('<i class="fa fa-chevron-circle-right icon_furture_date"></i>');

        }
    }
    $(document).ready(function(){
        $("#modal_add_new_deal").click(function(){
            $("#alertAddnewDeal").html('');     
            $("#addnew_contact_person_name").val('');
            // $("#addnew_organization_name").val('');
            $("#addnew_email").val('');
            $("#addnew_phone").val('');
            $("#addnew_deal_value").val('');
            $("#addnew_title").val('');
            $("#addnew_finish_date").val('');
            $("#console_checkcontactpersonname").html('');
            $("#console_checkorganizationname").html('');
        });
    });
    
    function dragStart(ev) {        
        
        ev.dataTransfer.effectAllowed = 'move';
        var parent = ev.target;
        while (parent && !$(parent).is('li')) {
            parent = parent.parentElement;
            //console.log(parent);            
        }  
           
        ev.dataTransfer.setData("Text", parent.getAttribute('id'));
         
        ev.dataTransfer.setDragImage(parent, 0, 0);

        return true;
    }
    
    function dragEnter(ev) {

        $(".ul").addClass('pointer-events-none');
        $(ev.target).addClass('dragOver');
        event.preventDefault();
        return true;
    }
    
    function dragLeave(ev) {

        $(ev.target).removeClass('dragOver');
        event.preventDefault();
        return true;
    }
    
    function dragEnd(ev) {

        $(".ul").removeClass('pointer-events-none');
        $('.stage').removeClass('dragOver');        
        var parent = ev.target;
        
        while (parent && !$(parent).is('.stage')) {
            if($(parent).is('li')){
                //console.log('id = ' + $(parent).attr('id'));
            }
            parent = parent.parentElement;
            //console.log(parent);            
        }
        
        //console.log(' data-stage-id = ' + $(parent).attr('data-stage-id'));
        
        event.preventDefault();
        return true;
    }
    
    function dragOver(ev) {        
        return false;
    }
    
    function dragDrop(ev) {        
        var src          = ev.dataTransfer.getData("Text");
        var stage_new    = $(ev.target).attr("data-stage-id");
        var id_promotion = src.substr(4);
        
        if(stage_new){
            if(UpdateStageOpportunity(id_promotion,stage_new) == id_promotion){
                return false;
            } 
        }
        
        if($(ev.target).is("ul")){
            ev.target.appendChild(document.getElementById(src));
            ev.stopPropagation();
            return false;
        }
        
        if($(ev.target).is("li")){
            $(ev.target).parent('ul').append(document.getElementById(src));
            ev.stopPropagation();
            return false;
        }

        if($(ev.target).is("div")){
            $(ev.target).children('ul').append(document.getElementById(src));
            ev.stopPropagation();
            return false;
        }
         
        return true;
    }
    function ConvertTimeformat(format, str) {
        if(str == '' ){
            return '00:00:00';
        }
        var hours = Number(str.match(/^(\d+)/)[1]);
        var minutes = Number(str.match(/:(\d+)/)[1]);
        var AMPM = str.match(/\s?([AaPp][Mm]?)$/)[1];
        var pm = ['P', 'p', 'PM', 'pM', 'pm', 'Pm'];
        var am = ['A', 'a', 'AM', 'aM', 'am', 'Am'];
        if (pm.indexOf(AMPM) >= 0 && hours < 12) hours = hours + 12;
        if (am.indexOf(AMPM) >= 0 && hours == 12) hours = hours - 12;
        var sHours = hours.toString();
        var sMinutes = minutes.toString();
        if (hours < 10) sHours = "0" + sHours;
        if (minutes < 10) sMinutes = "0" + sMinutes;
        if (format == '0000') {
            return (sHours + sMinutes + ':00');
        } else if (format == '00:00') {
            return (sHours + ":" + sMinutes + ":00");
        } else {
            return false;
        }
    }
    function runScript(e) {
        if (e.keyCode == 13) {
            AjaxSearchDealOpportunity('1');
        }
    }
</script>