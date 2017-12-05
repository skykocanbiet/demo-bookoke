<?php $baseUrl = Yii::app()->baseUrl;?>
<!--Font Awesome and Bootstrap Main css  -->


<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/jqtransform.css" />
<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/setting.css" />
<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/customers_new.css" />

<!-- PAINT -->
<link rel="Stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/js/paint/wPaint.min.css" />
<!-- END PAINT -->

<input type="hidden" id="baseUrl" value="<?php echo Yii::app()->baseUrl?>"/>

<style type="text/css">
#profileSideNav ul li a i{
    font-size:2em;  
}

#detailCustomer {padding: 0;}

.srchBar {padding: 15px;}

.tableList {padding: 10px 20px;}

.tableList thead {
    color: #fff;
    background-color: rgba(115, 149, 158, 0.80);
}

.tableList th, .tableList td {text-align: center;}

.tr_col {background: #F2F2F2;}
.hiddenRow { padding: 0 !important; }
.hiddenRow:hover {background: white;}
tr.accordion-toggle {cursor: pointer;}
td.hiddenRow {border: 0 !important;}

.noty_Detail {padding: 30px;}

.div_trang {
    width: 30px;
    padding: 5px 10px 5px 10px;
    text-align: center;
    /* background: #F5D7BA; */
    margin: 2px;
}
.btnNoti{
    margin-right: 10px;
    padding:5px 15px;
}

</style>

<div class="row wrapper tab-content full-height">

    <!-- Contact Customers -->
    <div id="customers" class="tab-pane full-height active">
        <div class="row-fluid full-height">

            <div id="customerContent" class="content">
                <div  id="profileSideNav"  class="span1 primary-navbar col-sm-2 col-md-1">
                    <ul class="nav nav-tab nav-stacked" id="myTab">
                        <li id="profile_preview_nav" class="active">
                            <a href="<?php echo Yii::app()->getBaseUrl(); ?>/itemsUsers/Notifications/View">
                                <img src="<?php echo $baseUrl;?>/images/icon_sb_left/3_Tin_nhan/thong-bao_def.png" /> <br>
                                Thông báo
                            </a>
                        </li>

                        <li id="profile_configure_nav">
                            <a href="<?php echo Yii::app()->getBaseUrl(); ?>/itemsUsers/sms/view">
                                <img src="<?php echo $baseUrl;?>/images/icon_sb_left/3_Tin_nhan/sms_def.png" /> <br>
                                SMS
                            </a>
                        </li>

<!--                         <li id="profile_configure_nav">
                            <a href="<?php echo Yii::app()->getBaseUrl(); ?>/itemsChat/chat/view">
                                <img src="<?php echo $baseUrl;?>/images/icon_sb_left/3_Tin_nhan/trao-doi_def.png" /> <br>
                                Trao đổi
                            </a>
                        </li>

                        <li id="profile_configure_nav">
                            <a href="<?php echo Yii::app()->getBaseUrl(); ?>/itemsChat/chat/view">
                                <img src="<?php echo $baseUrl;?>/images/icon_sb_left/3_Tin_nhan/task_def.png" /> <br>
                                Công việc
                            </a>
                        </li> -->
                        
                    </ul>
                </div>

                <!-- Detail Customer -->
                <div id="detailCustomer" class="col-sm-10 col-md-11">
                    <div class=" col-xs-12 col-md-6 srchBar">
                        <form class="form-inline">
                            <div class="pull-left">
                                <div class="form-group">
                                    <label >Thời gian</label>
                                    <select name="" class="form-control" id="quote_time">
                                        <option value="1">Tất cả</option>
                                        <option value="2">Hôm nay</option>
                                        <option value="3">7 ngày trước</option>
                                        <option value="4">Tháng trước</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class=" col-xs-12 col-md-6 srchBar">
                        <form class="form-inline">
                            <div class="pull-right">
                                <div class="form-group">
                                    <select name="" class="form-control" id="taskNoti">
                                        <option value="">Chọn tác vụ</option>
                                        <option value="1">Chọn</option>
                                        <option value="2" >Xem tất cả</option>
                                        <option value="3">Xóa tất cả</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class=" col-xs-12 hidden" id="btnHidden">
                        <!-- <button class="btn btnNoti" id="watchNoti">Xem</button> -->
                        <button class="btn btnNoti" id="cancelNoti">Xóa</button>
                    </div>
                    
                    <div class="col-md-12 noty_Content tableList">
                        <div id="noty_List">
            
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();

    $('#profileSideNav').height(windowHeight-header);
    $('#detailCustomer').height(windowHeight-header);

    $('.cal-loading').fadeOut('slow');

});
</script>

<?php include '_js.php'; ?>