<?php 
$subject_js = Yii::app()->controller->id;
include_once('library_js.php');
?>

<div id="content" style="padding-right: 0;">
    <ul id="menuk" class="menuk">
    <?php
        include_once(Yii::app()->theme->basePath.'/views/layouts/tab.php');
        MyTab::getTab('dashboard', 'Sales', 'lead/dashboard');
        MyTab::getTab('key_performance_indicators', 'KPI', 'KeyPerformanceIndicators/Kpi','active');
        MyTab::getTab('task', 'Task', 'lead/task');
        MyTab::getTab('calendar', 'Calendar', 'lead/calendar');
        MyTab::getTab('voc', 'VOC', 'lead/voc');
        $group_no = Yii::app()->user->getState('group_no');
        if($group_no=="admin" ||$group_no=="superadmin" ||$group_no=="manager")
        {
            MyTab::getTab('report_sys', 'Report', 'lead/report_sys');
            MyTab::getTab('balance', 'Balance', 'lead/balance');
        }
        
        ?>
    </ul>
    <div id="box_task_total">
        <script>
        view_task_new_total();
        </script>
    </div>
    <div id="description" class="contentk">
    	<div class="bg_popup"  style="padding: 5px;" >
            <div style="position:absolute;top:138px;right:50px" id="idloading_main"></div>
            <div id="_from_search_kpi">
                    <?php include_once('_frm_search_kpi.php'); ?>
            </div>
            <div id="return_content">
                    <?php // include_once('ajax_search_kpi.php'); ?>
            </div>
        </div>
    </div>
</div>  
