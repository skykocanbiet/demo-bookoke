

<!-- SHOW VIEW FORM INFO SEARCH -->
<div style="margin:10px auto; width:100%; position: relative;">

    <!-- VIEW BUTTON ACTION -->
    <span style="position: absolute;top: 3px;right: 95px;">
        <button class="button_izi" onclick="search_cus('1')" >Search</button>
        <span id="idwaiting_search" style="position: absolute;right:80px; top: 3px;"></span>
    </span>
    <span style="position: absolute;top: 3px; right: 0px;">
        <button class="button_izi" onclick="<?php echo $subject_js.'Create'; ?>();">New</button>    
    </span>
    <!-- END BUTTON ACTION -->
    
    <div style="float: left;margin-right: 5%;margin-left: 1%;">
        <!-- Users -->
        <div class="new_account_row">
            <span class="account_label" style="width: 120px;">Users:</span>
            <span>  
                <?php 
                    $listdata     = array();
                    $listdata[''] = "ALL";
                    $User         = User::model()->findAllByAttributes(array('block'=>0,'group_id'=>3));
                    foreach($User as $temp){
                        $listdata[$temp['id']] =  $temp['name'];
                    }
                    echo CHtml::dropDownList('frm_search_user_id',$model->user_id,$listdata,array('onChange'=>"search_cus(1);",'style'=>'width: 175px;')); 
                ?>
            </span>
        </div>
        <!-- Month -->
        <div class="new_account_row">
            <span class="account_label" style="width: 120px;">Month:</span>
            <span>
                <?php 
                    if(!$model->month){
                        $model->month = trim(date('n'));
                    }
                    echo CHtml::dropDownList('frm_search_month',$model->month,$list_month,array('onChange'=>"search_cus(1);",'style'=>'width: 175px; height: 30px;','options'=>array($model->month=>array('selected'=>true))));
                ?>
            </span>
        </div>
        <!-- Year -->
        <div class="new_account_row">
            <span class="account_label" style="width: 120px;">Year:</span>
            <span>
                <input  type="text" value="<?php echo ($model)?($model->year):'' ?>" id="frm_search_year" name="frm_search_year" onkeypress="runScript(event);" style="width: 160px;"/>
            </span>
        </div>
       
    </div>
    <div style="float: left;">
        <!-- Revenue -->
        <div class="new_account_row">
            <span class="account_label" style="width: 120px;">Revenue:</span>
            <span>
                <input  type="text" value="<?php echo ($model)?($model->revenue_target):'' ?>" id="frm_search_revenue_target" name="frm_search_revenue_target" onkeypress="runScript(event);" style="width: 160px;"/>
            </span>
        </div>
        <!-- New Account -->
        <div class="new_account_row">
            <span class="account_label" style="width: 120px;">New Account:</span>
            <span>
                <input  type="text" value="<?php echo ($model)?($model->new_account_target):'' ?>" id="frm_search_new_account_target" name="frm_search_new_account_target" onkeypress="runScript(event);" style="width: 160px;"/>
            </span>
        </div>
        <!-- Sale Calls -->
        <div class="new_account_row">
            <span class="account_label" style="width: 120px;">Sale Calls:</span>
            <span>
                <input  type="text" value="<?php echo ($model)?($model->call_target):'' ?>" id="frm_search_call_target" name="frm_search_call_target" onkeypress="runScript(event);" style="width: 160px;"/>
            </span>
        </div>
        
    </div>
    <div style="clear: both;"></div>
</div>
<!-- END VIEW FORM INFO SEARCH -->

<div id="return_content" style="margin-top: 20px;"></div>
<script>
search_cus(1);
</script>