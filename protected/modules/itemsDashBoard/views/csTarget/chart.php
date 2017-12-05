<i class="fa fa-list" style="z-index: 999;" id="icon_dashboard_list" onclick="<?php echo $subject_js.'Admin' ?>();" title="Admin" ></i>

<div id="body_chart12" style="margin-top: 10%;">
    <?php  include_once('dashboard.php'); ?>
</div>

<hr style="background-color: #5C2B95  ;opacity:0.5;margin-top: 45px;"  />

<style>
.search_lable_filter{width: 70px ; display: inline-block;}
</style>

<!-- Search Chart -->
<div style="position: relative;">
    <div style="font-weight: bold;">
        <div style="margin:15px 0px;" >
            <span style="color: #5C2B95;">From :</span><span style="margin-left: 32px;"><input style="width: 110px;" id="box_search_date_from" value="<?php echo date('Y-m-d'); ?>" type="text"  /></span>
            <span style="margin-left: 45px;color: #5C2B95;">To :</span><span style="margin-left: 50px;"><input style="width: 110px;" id="box_search_date_to" value="<?php echo date('Y-m-d') ?>" type="text" /></span>
            <span style="display: none;"><input id="box_search_date_type" value="today" type="text" /></span>
        </div>
        <div class="clearfix"></div>
        <div style="width: 26%; float: left;">
            <span>
                <span  class="search_lable_filter" style="font-size: 11pt;font-weight: bold;color: #5C2B95; ">Users:</span>
                <span>  
                    <?php 
                        $listdata     = array();
                        $listdata[''] = "ALL";
                        $User         = User::model()->findAllByAttributes(array('block'=>0,'group_id'=>3));
                        foreach($User as $temp){
                            $listdata[$temp['id']] =  $temp['name'];
                        }
                        echo CHtml::dropDownList('frm_search_user_id','',$listdata,array('style'=>'width: 120px;')); 
                    ?>
                </span>
            </span>
        </div>
        <div style="width: 26%;float: left;">
    		<input style="display: none;"  type="radio"  checked="checked" id="id_daily" name="dashboard" value="daytime"/>
    		<span class="search_lable_filter" style="font-size: 11pt;font-weight: bold;color: #5C2B95; ">Day time: </span>
    		<input size="10" type="text" id="search_datetimes" value="<?php echo date("Y-m-d")?>" readonly="" style="color: #f7ba3e;font-weight: bold;width: 110px;" />
        </div>
        <div style="width: 36%;float: left;">
            <input style="display: none;"  type="radio"  id="id_monthly"   name="dashboard" value="month"/>
    		<span class="search_lable_filter" style="color: #5C2B95;">Month : </span>
                <?php 
                   $default_month =  ""; //trim(date('n'));
                   $listdata = array();
                   $listdata[''] = "Select Month";
                    foreach($list_month as $key => $temp){
                        $listdata[$key] =  $temp;
                    }
                   echo CHtml::dropDownList('search_month','',$listdata,array('onChange'=>'GetDaysInMonth()','style'=>'width:120px','options'=>array($default_month=>array('selected'=>true))));
                ?>
    		<span style="color: #5C2B95;margin-left: 15px;">Year of  : <input id="search_year" size="7" value="<?php echo date('Y') ?>" type="text" readonly="" style="border: none;color: #f7ba3e;font-weight: bold;width: 35px;" /></span>     
            
        </div>
        <div style="width:20%;display: none;" >
            <input style="display: none;" type="radio"  id="id_weekly" name="dashboard" value="week"/>
        	<span class="search_lable_filter" style="font-size: 11pt;font-weight: bold;color: #5C2B95; ">Week</span>
            <span class="week-picker" style="display: inline-block;" ></span>
        </div>
        <div class="clearfix"></div>
                               
    </div>
    <button style="position: absolute;right: 10px;top: 0px;" onclick="<?php echo $subject_js.'SearchDashboard';?>();" class="button_save">FILTER</button>
</div>
<script>


</script>

<script type="text/javascript">

$(function() {
    var startDate;
    var endDate;

    var selectCurrentWeek = function() {
        window.setTimeout(function () {
            $('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
        }, 1);
    }

    $('.week-picker').datepicker( {
        dateFormat: 'yy-mm-dd',
        changeYear:true,
        changeMonth:true,
        showWeek:true,
        showOtherMonths: true,
        selectOtherMonths: true,
        onSelect: function(dateText, inst) { 
            var date = $(this).datepicker('getDate');
            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
            var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
            if(!$('input:radio[name=dashboard][value=week]').is(':checked')){
               $('input:radio[name=dashboard][value=week]').prop('checked',true);
            }  
            $('#box_search_date_from').val($.datepicker.formatDate( dateFormat, startDate, inst.settings ));
            $('#box_search_date_to').val($.datepicker.formatDate( dateFormat, endDate, inst.settings ));
            $("#search_month").val("");
            $("#search_datetimes").val("");
            selectCurrentWeek();
        },
        beforeShowDay: function(date) {
            var cssClass = '';
            if(date >= startDate && date <= endDate)
                cssClass = 'ui-datepicker-current-day';
            return [true, cssClass];
        },
        onChangeMonthYear: function(year, month, inst) {
            selectCurrentWeek();
        }
    });

    $('.week-picker .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
    $('.week-picker .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
});

$('#search_datetimes').datepicker({
    changeYear:true,
    changeMonth:true,
    dateFormat: 'yy-mm-dd',
    inline: true,
    onSelect: function(dateText, inst) { 
        var date = $(this).datepicker('getDate'),
            day  = date.getDate(),  
            month = date.getMonth() + 1,              
            year =  date.getFullYear();
            $('#box_search_date_from').val(year + '-' + month + '-' + day);
            $('#box_search_date_to').val(year + '-' + month + '-' + day);
            if(!$('input:radio[name=dashboard][value=daytime]').is(':checked')){
                $('input:radio[name=dashboard][value=daytime]').prop('checked',true);
            }
            $("#search_month").val("");
            $('#box_search_date_type').val('today');
            $( ".week-picker" ).datepicker( "refresh" );
    }
});

function GetDaysInMonth(){
    var month       =  $("#search_month").val();
    var year        =  $("#search_year").val();   
    var lastDay     =  daysInMonth(month,year);
    $('#box_search_date_from').val(year + '-' + month + '-1' );
    $('#box_search_date_to').val(year + '-' + month + '-' + lastDay);
    if(!$('input:radio[name=dashboard][value=month]').is(':checked')){
        $('input:radio[name=dashboard][value=month]').prop('checked',true);
    }
    $("#search_datetimes").val("");
    $( ".week-picker" ).datepicker( "refresh" );
    $('#box_search_date_type').val('month');
}

function daysInMonth(month,year) {
    return new Date(year, month, 0).getDate();
}

$('#box_search_date_from').datepicker({
    changeYear:true,
    changeMonth:true,
    dateFormat: 'yy-mm-dd',
    inline: true,
    onSelect: function(dateText, inst) { 
        var date = $(this).datepicker('getDate'),
            day  = date.getDate(),  
            month = date.getMonth() + 1,              
            year =  date.getFullYear();
            $('#box_search_date_from').val(year + '-' + month + '-' + day);
            if(!$('input:radio[name=dashboard][value=daytime]').is(':checked')){
                $('input:radio[name=dashboard][value=daytime]').prop('checked',true);
            }
            $("#search_month").val("");
            $('#box_search_date_type').val('month');
            $(".week-picker").datepicker("refresh");
    }
});
$('#box_search_date_to').datepicker({
    changeYear:true,
    changeMonth:true,
    dateFormat: 'yy-mm-dd',
    inline: true,
    onSelect: function(dateText, inst) { 
        var date = $(this).datepicker('getDate'),
            day  = date.getDate(),  
            month = date.getMonth() + 1,              
            year =  date.getFullYear();
            $('#box_search_date_to').val(year + '-' + month + '-' + day);
            if(!$('input:radio[name=dashboard][value=daytime]').is(':checked')){
                $('input:radio[name=dashboard][value=daytime]').prop('checked',true);
            }
            $("#search_month").val("");
            $('#box_search_date_type').val('month');
            $( ".week-picker" ).datepicker( "refresh" );
    }
});

</script>

<script>

$(function(){
    // Change period
    $('input:radio[name=dashboard]').change(function() {
        var period = $(this).val();
        var today = new Date();
        
        var dd = today.getDate();
        var dd_from = dd;
        var dd_to = dd;
        
        var mm = today.getMonth()+1;
        var mm_from = mm;
        var mm_to = mm;
        
        var yyyy = today.getFullYear();
        var yyyy_from = yyyy;
        var yyyy_to = yyyy;
        
        var day_from;
        var day_to;
        
        var d = new Date(yyyy, mm, 0);
        
        var n = today.getDay();
        var beforeOneWeek = new Date(new Date().getTime() - 60 * 60 * 24 * 7 * 1000);
        
        switch(period) {
            //This week
            case 'week':
                if(dd <= n){
                    dd_from = beforeOneWeek.getDate() - n + 7 + 1;
                    mm_from = mm_from - 1;
                }else if((dd - n + 6) > d.getDate()){
                    dd_from = dd - n + 1;
                }else{
                    dd_from = dd - n + 1;
                }
                break;
            case 'month':
                dd_from = 1;
                break;
            default:
                break;
        }
        if(dd_from < 10) { dd_from = '0' + dd_from;}
        if(dd_to < 10) { dd_to = '0' + dd_to;}
        if(mm_from < 10) { mm_from = '0' + mm_from;}
        if(mm_to < 10) { mm_to = '0' + mm_to;}
        
        day_from = yyyy_from + '-' + mm_from + '-' + dd_from + ' 00:00:00';
        day_to = yyyy_to + '-' + mm_to + '-' + dd_to + ' 23:59:59';
        $('#box_search_date_type').val(day_to);
    });

});
</script>