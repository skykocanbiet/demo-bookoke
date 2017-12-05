<?php
$baseUrl = Yii::app()->baseUrl;

$paramDefaultCustomers = '[{"id":"27694","fullname":"05 LINH","image":null,"phone":"84988467742"},{"id":"3300","fullname":"A HUNG LUONG","image":null,"phone":"84907441668"},{"id":"45362","fullname":"AALTO ANNE","image":null,"phone":"84358400314577"},{"id":"31739","fullname":"AARON FREDERICK STALSWORTH","image":null,"phone":"84903321333"},{"id":"19455","fullname":"AARON TUAN VO","image":null,"phone":"841203197643"},{"id":"21341","fullname":"ABDUL AZIZ YOUSOF","image":null,"phone":"84908564993"},{"id":"37659","fullname":"ABDULLAH YILMAZ","image":null,"phone":"841634326100"},{"id":"34144","fullname":"ACBERT JANG","image":null,"phone":"841224182861"},{"id":"16641","fullname":"ADAM EDERMO","image":null,"phone":"84946109278"},{"id":"43569","fullname":"ADAM MARSHALL","image":null,"phone":"841219580600"},{"id":"5966","fullname":"ADELA MELINZ","image":null,"phone":"84938319083"},{"id":"4794","fullname":"AGUSTINUS AGUSTINUS","image":null,"phone":"84918003641"}]';

$paramDefaultCustomers = json_decode($paramDefaultCustomers);

?>

<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/jqtransform.css" />
<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/setting.css" />
<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/customers_new.css" />

<!-- PAINT 
<link rel="Stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/js/paint/wPaint.min.css" />-->
<!-- END PAINT -->


<!-- Add mousewheel plugin (this is optional) 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
-->
<!-- Add fancyBox
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script> -->

<!-- Optionally add helpers - button, thumbnail and/or media 
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
-->
<style type="text/css">

#leftsidebar{
    background-color: #f1f5f7;
}
#profileSideNav ul li a i{
    font-size:2em;  
}
</style>

<input type="hidden" id="baseUrl" value="<?php echo Yii::app()->baseUrl?>"/>

<div class="row wrapper tab-content full-height">


    <!-- Contact Customers -->
    <div id="customers" class="tab-pane full-height active">
        <div class="row-fluid full-height">

            <div id="customerContent" class="content">

                <div  id="leftsidebar" class="col-sm-5 col-md-4 col-lg-4">
                    <div class="row">

                        <div  id="profileSideNav"  class="span1 primary-navbar col-sm-3 col-md-2">

                            <ul class="nav nav-tab nav-stacked" id="myTab">

                                <li id="profile_preview_nav" >
                                    <a href="<?php echo Yii::app()->baseUrl.'/itemsCustomers/Accounts/admin'; ?>">
                                        <img src="<?php echo $baseUrl;?>/images/icon_sb_left/KHACHHANG.png" /> <br>
                                        Khách hàng 
                                    </a>
                                </li>

                                <li id="profile_embed_nav">
                                    <a href="#embed/website" data-toggle="tab">
                                        <img src="<?php echo $baseUrl;?>/images/icon_sb_left/COHOI.png" /> <br>
                                         Cơ hội
                                    </a>
                                </li>

                                <li id="profile_configure_nav" class="active">
                                    <a  href="<?php echo Yii::app()->baseUrl.'/itemsCustomers/Lead/ViewLead'; ?>">
                                        <img src="<?php echo $baseUrl;?>/images/icon_sb_left/TIEMNANG.png" /> <br>
                                        Tiềm năng
                                    </a>
                                </li>
                                
                                <li id="profile_embed_nav">
                                    <a href="#embed/website" data-toggle="tab">
                                        <i class="fa fa-heartbeat" aria-hidden="true"></i> <br>
                                         Đánh giá
                                    </a>
                                </li>

                                <li id="profile_embed_nav">
                                    <a href="#embed/website" data-toggle="tab">
                                        <i class="fa fa-bullhorn" aria-hidden="true"></i> <br>
                                         Phàn nàn
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="customerListContainer col-sm-9 col-md-10" >
                                <div style="margin:0px 2em;">
                                    <div class="customersActionHolder">
                                            <h3>Danh sách</h3>
                                            <a class="global_btn" id="newCustomer" data-delay="0" data-placement="right" data-original-title="Thêm khách hàng"> + </a>
                                            <div id="importExportLabel" class="importLabel fr importAndSort blue_glowb hide">
                                                Import/Export
                                                <ul id="importExportOptionList">
                                                    <li id="import"> Import </li>
                                                    <li id="export"> Export All </li>
                                                </ul>
                                            </div>
                                            <div class="clearfix"></div>
                                    </div>
                                    <div id="addnewCustomerPopup" class="popover bottom" style="display: none;">
                                        <form id="frm-add-customer" onsubmit="return false;" class="form-horizontal">
                                            <div class="arrow"></div>
                                            <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Thêm khách hàng</h3>
                                            <div class="popover-content" style="width:225px;">
                                                <input type="text" required oninvalid="this.setCustomValidity('Vui lòng nhập họ và tên.')" oninput="setCustomValidity('')" class="form-control" id="customerNewName" name="customerNewName" placeholder="Họ và tên" style="margin-bottom:10px;">
                                                <input type="text" required pattern="\d{6,12}" oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại.')" oninput="setCustomValidity('')" title="Số điện thoại phải từ 6 đến 12 số." class="form-control" id="customerNewPhone" name="customerNewPhone" placeholder="Số điện thoại" style="margin-bottom:10px;">                                           
                                                <button id="addnewCustomer" class="new-gray-btn new-green-btn">Tạo mới</button>
                                                <button id="cancelNewCustomer" type="reset" class="cancelNewStaff new-gray-btn" style="min-width: 94px;margin-right: 0px;">Hủy</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="customerSearchHolder">
                                            <div id="customer-search-textbox">
                                                <input type="text" onkeypress="runScript_search(event);" id="searchNameCustomer" class="customerSearch fl blue_focus " value="" placeholder="Tìm kiếm...">
                                                <input type="hidden" id="searchSortCustomer" value="1">
                                                <i class="icon-sort-down fr noDisplay" id="advanced-search-PopUp" style="position:absolute;left:227px;margin-top: 7px;cursor: pointer;"></i>
                                            </div>
                                            
                                            <div id="sortLabel" class="sortLabel fr importAndSort">
                                                <i class="fa fa-list"></i>
                                                <ul id="sortOptionList">
                                                    <li class="SortBy" class="sort-customers-option"><input type="hidden" value="1">Theo Họ và Tên </li>
                                                    <!-- <li class="SortBy" class="sort-customers-option"><input type="hidden" value="3">Theo điện thoại </li> -->
                                                    <li class="SortBy" class="sort-customers-option"><input type="hidden" value="4">Theo Mã số </li>                                              
                                                </ul>
                                            </div>
                                            
                                            <div class="clearfix"></div>    
                                            <div id="advancePopup-holder">
                                                <div class="advanced-search-popup popover bottom">
                                                    <div class="arrow" style="margin-left:82px;"></div>
                                                    <h3 style="background-color: #f8f8f8" class="popover-title">Advanced Search</h3>
                                                    <div class="advanced-search-textarea-holder" style="padding: 10px 40px 0px 12px;">
                                                        <div class="searchByName-input">
                                                            <span><input type="text" placeholder="Search By Name" id="searchByName"></span>
                                                        </div>
                                                        <div class="searchByTag-input">
                                                            <!-- <input type="text" placeholder="Search By Tag" id="searchByTag"> -->
                                                            <div id="advanced-search-tag-view" class="tag-Search-view">
                                                                <ul class="customertags_list" id="customerTagForSearch" style="padding:0px;"></ul>
                                                                <span>
                                                                    <input type="text" id="searchByTag" class="tag-input-text" placeholder="Search By Tag">
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div id="tag-customer-search" class="fl" style="margin-top:9px;margin-left:1px;"></div>
                                                        <div id="btn-advanced-search" style="margin-bottom: 15px;">
                                                            <button id="search-btn-advanced" class="new-gray-btn new-green-btn" style="min-width:115px">Search</button>
                                                            <button id="cancel-btn-advanced" class="new-gray-btn">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>

                                    <div id="customerListHolder" class="customerListHolder">
                                        <ul id="customerList" style="max-height: 770px;">
                                                <?php
                                                foreach($paramDefaultCustomers as $k=> $value){ ?>
                                                <li id="c<?php echo $value->id;?>" onclick="detailCustomer(<?php echo $value->id;?>);"  class="n" >
                                                                                
                                                    <span class="jqTransformCheckboxWrapper" style="display:none;">
                                                        <a href="#" class="jqTransformCheckbox"></a>
                                                        <input type="checkbox" value="<?php echo $value->id;?>" class="fl" style="display : none;">
                                                    </span>
                                                    
                                                    <img src="<?php echo $baseUrl; ?>/upload/customer/<?php if($value->image !="") echo $value->image; else echo "no_avatar.png";?>" class="fl" style="border-radius:100%;">
                                                    <label class="fl"><?php echo $value->fullname;?> </label>
                                                    <div class="clearfix"></div>
                                                </li>
                                                <?php } ?>
                                                   
                                        </ul>
                                    </div>
                                </div>
                        </div>
                    </div>    
                    <div class="clearfix"></div>
                </div>   

                <!-- Detail Customer -->
                <div id="detailCustomer" class="col-sm-7 col-md-8 col-lg-8">
                    <?php  include('customer_default.php'); ?>
                </div>


                <div class="clearfix"></div>
            </div>



        </div>
    </div>

    

    <!--  Complete settings -->
    <div class="tab-pane full-height" id="settings">
        <div class="row-fluid full-height">
            <div id="settingsSideNav" class="span1 primary-navbar">
            </div>

            <!--Left Side Secondary NavBar For Setting Page  -->
            <div id="settingsTabContent" class="tab-content full-height">

                <div class="tab-pane full-height" id="staff">
                    <div id="staffSideList" class="span3 secondary-navbar container-fluid">

                    </div>
                    <div class="span9 detail-wrapper">
                        <div id="staffContentNav" class="detail-navbar container-fluid">

                        </div>

                        <div class="container-fluid staff-details-container">
                            <div class="tab-content">


                                <div class="tab-pane" id="staff-details">

                                </div>


                                <div class="tab-pane" id="staff-services">

                                </div>


                                <div class="tab-pane" id="staff-hours">

                                </div>


                                <div class="tab-pane" id="staff-break">

                                </div>


                                <div class="tab-pane" id="staff-timeoff" style="padding-bottom: 100px;">

                                </div>


                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane full-height" id="accounts">

                    <div id="accountsSideNav" class="span3 secondary-navbar container-fluid">

                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="preferences">

                        </div>
                        <div class="tab-pane" id="payment_integration">

                        </div>
                        <div class="tab-pane" id="billing_history">
                            <div align="center" class="setmoreHorizontalLoader">
                                <img src="<?php echo Yii::app()->baseUrl;?>/images/setmore-loader.gif">
                            </div>
                            <div align="center" class="setmoreHorizontalLoaderContent">Loading please wait...</div>
                        </div>

                        <div class="tab-pane" id="export_schedule">
                            <div align="center" class="setmoreHorizontalLoader">
                                <img src="<?php echo Yii::app()->baseUrl;?>/images/setmore-loader.gif">
                            </div>
                            <div align="center" class="setmoreHorizontalLoaderContent">Loading please wait...</div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane full-height" id="services">

                  <div id="services-category" class="span3 secondary-navbar container-fluid full-height">

                  </div>

                  <div class="span9 detail-wrapper">
                    <div id="servicesListHeader" class="detail-navbar container-fluid">

                    </div>
                    <div class="row-fluid position-relative full-height">
                      <ul id="servicesList" class="stacked-list service-list full-height">

                      </ul>

                      <div id="serviceDetails" class="full-height service-info-holder row-fluid" style="display:none;">

                      </div>

                    </div>
                  </div>
                </div>

                <div class="tab-pane full-height" id="classesSetting">

                  <div id="classCategoryList" class="span3 secondary-navbar container-fluid full-height">

                  </div>

                  <div class="span9 detail-wrapper">
                    <div id="classCategoryHeader" class="detail-navbar container-fluid">

                    </div>
                    <div class="row-fluid position-relative classDetailsContainer">
                      <ul id="settingsClassesList" class="stacked-list class-list full-height">

                      </ul>

                      <div id="classDetails" class="full-height row-fluid" style="display:none;">
                            <div class="span6 class-details-container full-height" id="classDetailsHolder">
                            </div>
                            <div class="span6 class-timings-list">
                                <div class="class-timings-header container-fluid full-height" id="classTimingHeader">

                                </div>
                                <ul class="class-date-time stacked-list row-fluid" id="classApptList">
                                </ul>
                            </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane full-height active" id="payments">
                    <div id="paymentsSideNav" class="span3 secondary-navbar container-fluid full-height">

                    </div>
                    <div class="tab-content full-height">
                        <div class="tab-pane active" id="paymentConfigureHolder">

                        </div>
                        <div class="tab-pane " id="paymentHistory">
                                <div class="span8 detial-header-wraper">
                                        <div class="detail-navbar container-fluid">
                                            <h3>Payment Transaction History</h3>
                                        </div>
                                        <div class="container-fluid payment-history-container" id="paymentHistoryHolder">
                                        </div>
                                </div>
                        </div>
                        <div class="tab-pane " id="paymentBookingPage">
                                <div class="span8 detial-header-wraper">
                                        <div class="detail-navbar container-fluid">
                                            <h3>Get Paid from Your Booking Page</h3>
                                        </div>
                                        <div class="container-fluid payment-config-contianer" id="paymentBookingPageHolder">
                                        </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane full-height active" id="notifications">
                    <div class="setmore-loader" style="display:block;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Complete dashBoard -->
    <div class="tab-pane full-height" id="dashboard">
    </div>

</div>
<script type="text/javascript">
    
$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();

    $('#profileSideNav').height(windowHeight-header);

    $('.statsTabContent').height(windowHeight-header-tab_menu-45);
    
    
});
$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();

    $('#profileSideNav').height(windowHeight-header);

    $('.statsTabContent').height(windowHeight-header-tab_menu-45);

});

$( document ).ready(function() {
    detailLeadCustomers(<?php echo $paramDefaultCustomers[0]->id; ?>);
});

</script>


<?php include('_style.php'); ?>
<?php include('_js.php'); ?>