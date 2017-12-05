<link href="<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar/scheduler.css" rel="stylesheet" type="text/css" />

<style>
.padding-0       {padding: 0}
.padding-left-0  {padding-left: 0}
.padding-right-0 {padding-right: 0}
.padding-left-0  {padding-left: 0}
.padding-right-15{padding-right: 15px;}

.breakTime {
    background: url('../../images/bg-breakTime.jpg');
}
.evBranch {
    font-size: 10px;
    text-align: right;
    margin-bottom: 4px;
}
#calendar .fc-bgevent {opacity: 0.8; }
#sr_val{
    -webkit-border-bottom-right-radius: 0;
    -moz-border-bottom-right-radius   : 0;
    border-bottom-right-radius        : 0;
    
    -webkit-border-top-right-radius   : 0;
    -moz-border-top-right-radius      : 0;
    border-top-right-radius           : 0;                
}

.errors {
    border    : 1px solid red !important;
    background: rgba(217, 3, 3, 0.2) !important;
}

.errors .select2-selection{
    background: rgba(217, 3, 3, 0.2) !important;
}

.unactive   {cursor: not-allowed !important;}
.load-at .fa{color: #7cc9ac;}

.modal-dialog {padding-top: 97px;}
.modal-content {border-radius: 0;}

.btn_new {background: #969696;}

/*calendar header*/
#calendar .fc-button-group {float: right;}
#calendar .fc-center {position: relative;}
#calendar .fc-state-default {background: none; box-shadow: 0; border: 1px solid #ddd;}
#calendar .fc-button {height: 34px !important;}
#calendar #cal_date {font-size: 22px; padding: 7px; font-weight: normal;cursor: pointer; text-transform: capitalize;}
#calendar #date {position: absolute;left: -15%;top: 90%;}

/*calendar calendar*/
	/* calendar thead */
#calendar th.fc-resource-cell {    
	font-weight: normal;
    line-height: 1.3;
    padding: 10px 0;
    font-size: 13px;
}

	/*calendar color day*/
#calendar .fc-past {background: rgba(230,230,229,0.5);}
#calendar .fc-today {background: #fff;}
	/*calendar tbody*/
#calendar .fc-helper {background: rgb(196, 230, 239); border: rgb(196, 230, 239);}
#calendar .fc-event {border-radius: 0; font-size: 12px;}

/********* datepicker style *************/
.ui-datepicker {
    border       : 0;
    box-shadow   : 4px 5px 20px #a7a7a7;
    padding      : 0;
    border-radius: 0;
}
button.ui-datepicker-close { display: none; }

.ui-datepicker-header {border-radius: 0;}
.ui-datepicker-buttonpane .ui-state-default {
    border-radius: 0; background: none !important;}
.ui-datepicker-next, .ui-datepicker-prev {background: inherit !important; border: 0 !important;}
.ui-widget-header .ui-icon {
    background-image: url(../../img/ui-icons_888888_256x240.png);
}
button.ui-datepicker-current {
    padding     : 0.5em 7em !important;
    border      : 0 !important;
}

/**** pop up create new event ****/
.calendarModal .modal-dialog {width: 447px;}
.calendarModal .modal-body {padding: 0 15px 10px;}
.calendarModal .modal-body h4 {font-size: 16px; font-weight: bold; color: #888888;}

.calendarModal label {color: #5e5e5e;}
.calendarModal .form-control {color: #7a797a;}

.calendarModal ul.nav {background: #f4f5f5; border-bottom: 3px solid white;}
.calendarModal ul.nav-1 {padding: 10px 20px 0px;height: 53px;}
.calendarModal ul.nav-2 {padding-top: 7px;}

.calendarModal .nav li a {
    background: inherit;
    border: 0;
    font-weight: bold;
}
.calendarModal .nav-1 li a {
    padding: 10px 20px;
    color: black;
}

.calendarModal .nav>li.active>a, 
.calendarModal .nav>li.active>a:focus, 
.calendarModal .nav>li.active>a:hover
{  
    font-weight: bold;
    border: 0;
    background: white;
}
.calendarModal .nav-1>li.active>a, 
.calendarModal .nav-1>li.active>a:focus, 
.calendarModal .nav-1>li.active>a:hover
{  
    background: inherit;
    border-bottom: 3px solid #93c54c;
    color: black;
}

.calendarModal .tab-ct {padding-top: 20px;}

.calendarModal table tr td {border: 0; padding: 5px 8px;}

#img_cus {
    border-radius: 100%;
    width: 50px;
}

label[for='Customer_fullname']
{
    margin-top: -15px;
}
label.checkbox {
    font-weight: normal;
    cursor: pointer;
}

#t-cus {
    padding-top: 20px;
    border-top: 2px dashed #ccc;
}

.fc-container {max-width: 100%; max-height: 100%; overflow-x: auto; overflow-y: hidden;}

.text-time {display:table-cell; text-align: right; color: #8b8a8a; font-size: 0.8em;padding-right: 5px;}

/**** pop up notify ****/
.noti .modal-dialog {margin-top: 10%;}
.noti .alert{margin-bottom: 0;}

/*** popover ***/
.popover {width: 290px; max-width: 300px; border: 0;border-radius: 0; padding: 0;}
.popover .popover-title {
    border-radius: 0; 
    padding: 10px 7px;
}
.popover .table tr td {border: 0; vertical-align: middle; padding: 4px 5px;}
.popover #pop-tb1 tr td:first-child {width: 38%; color: #999695;}
.popover #pop-tb2 {
    background: #f1f0f0;
    padding: 3px;
    margin-bottom: 10px;
    margin-top: 10px;
}
.popover #pop-tb2 tr td {
    padding-left: 14px;
}
.popover #pop-footer {padding: 5px 0px;}
.popover .btn_view {
    background: white;
    padding: 0
}
#pop_edit{
    background: url('../../images/icon_sb_left/edit_def.png') center top no-repeat;
    height: 35px;
    background-size: 110px;
    width: 111px;
}
#pop_edit:hover {
    background-image: url('../../images/icon_sb_left/edit_act.png');
}
#pop_quote{
    background: url('../../images/icon_sb_left/price_def.png') center top no-repeat;
    height: 35px;
    background-size: 110px;
    width: 111px;
}
#pop_quote:hover {
    background-image: url('../../images/icon_sb_left/price_act.png');
}
</style>