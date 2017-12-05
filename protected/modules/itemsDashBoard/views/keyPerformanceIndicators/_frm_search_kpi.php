<!-- SHOW VIEW FORM INFO SEARCH -->
<div style="margin:10px auto 25px; width:100%; position: relative;">

    <!-- VIEW BUTTON ACTION -->
    <span style="position: absolute;top: 3px;right: 50px;">
        <button class="button_izi" onclick="search_cus('1')" >FILTER</button>
        <span id="idwaiting_search" style="position: absolute;right:80px; top: 3px;"></span>
    </span>
    <!-- END BUTTON ACTION -->
    
    <div style="float: left;margin-right: 5%;margin-left: 6%;">
        <!-- Month -->
        <div class="new_account_row">
            <span class="account_label" style="width: 120px;">Month:</span>
            <span>
                <?php 
                    $listdata     = array();
                    $listdata[''] = "Select Month";
                    $listdata     = array_merge($listdata,$model->getListMonths());
                    echo CHtml::dropDownList('frm_search_month',date('n'),$model->getListMonths(),array('onChange'=>"GetDaysInMonth();",'style'=>'width: 175px;'));
                ?>
            </span>
        </div> 
        <!-- Year -->
        <div class="new_account_row">
            <span class="account_label" style="width: 120px;">Year:</span>
            <span>
                <input  type="text" value="<?php echo date('Y'); ?>" id="frm_search_year" name="frm_search_year" onkeypress="runScript(event);" style="width: 160px;"/>
            </span>
        </div>
    </div>
    <div style="float: left;">
        <!-- Account Manager -->
        <div class="new_account_row">
            <span class="account_label" style="width: 120px;">Account Manager:</span>
            <span>  
                <?php 
                    $listdata     = array();
                    $listdata[''] = "ALL";
                    foreach($model->getListUsers() as $temp){
                        $listdata[$temp['id']] =  $temp['name'];
                    }
                    $group_no = Yii::app()->user->getState('group_no');
                    if(($group_no=='admin'||$group_no=='superadmin' || $group_no=='manager' || $group_no=='leader')){
                        echo CHtml::dropDownList('frm_search_user_id',$model->user_id,$listdata,array('onChange'=>"",'style'=>'width: 175px;')); 
                    }else{
                        echo CHtml::dropDownList('frm_search_user_id',$model->user_id,$listdata,array('onChange'=>"",'style'=>'width: 175px;',"disabled"=>"disabled",'options'=>array(Yii::app()->user->getState('id_user')=>array('selected'=>true)))); 
                    }
                ?>
            </span>
        </div>
        <!-- Quarters -->
        <div class="new_account_row">
            <span class="account_label" style="width: 120px;">Quarters of the year:</span>
            <span>  
                <?php 
            		$list = array();
            		$list[''] = "Select Quarters";
            		$list['01-01,03-31'] = "1st Quarter";
            		$list['04-01,06-30'] = "2nd Quarter";
            		$list['07-01,09-30'] = "3rd Quarter";
                    $list['10-01,12-31'] = "4th Quarter";
            		echo CHtml::dropDownList('frm_search_quarters_of_year',"",$list,array('style'=>'width: 175px;','onChange'=>"getQuarter();",));
        		?>
            </span>
        </div>
        
    </div>
    <div style="display: none;" >
        <input id="box_search_date_from" value="" type="text"  />
        <input id="box_search_date_to" value="" type="text" />
        <input id="box_search_date_type" value="month" type="text" />
    </div>
    <div style="clear: both;"></div>
</div>
<!-- END VIEW FORM INFO SEARCH -->
<script>
function getQuarter() { 
    
    var year      = $("#frm_search_year").val();
    var strperiod = $("#frm_search_quarters_of_year").val();
    var data      = strperiod.split(',');
    var startdate = year+'-'+data[0];
    var enddate   = year+'-'+data[1];
    
    $('#box_search_date_to').val(enddate);
    $('#box_search_date_from').val(startdate);
    $('#box_search_date_type').val('quarters');
}
function GetDaysInMonth(){
    var month       =  $("#frm_search_month").val();
    var year        =  $("#frm_search_year").val();
    var lastDay     =  daysInMonth(month,year);
    $("#frm_search_quarters_of_year").val("");
    $('#box_search_date_from').val(year + '-' + month + '-1' );
    $('#box_search_date_to').val(year + '-' + month + '-' + lastDay);
    $('#box_search_date_type').val('month');
    
}
function daysInMonth(month,year){
    return new Date(year, month, 0).getDate();
}
GetDaysInMonth();
search_cus('1');
</script>