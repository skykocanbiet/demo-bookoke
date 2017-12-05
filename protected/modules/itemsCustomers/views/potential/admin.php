<?php
$baseUrl = Yii::app()->baseUrl;
?>
<link rel="stylesheet" href="<?php echo $baseUrl; ?>/js/daterangepicker/daterangepicker.css" type="text/css">

<script type="text/javascript" src='<?php echo $baseUrl; ?>/js/daterangepicker/moment.min.js'></script>

<script type="text/javascript" src='<?php echo $baseUrl; ?>/js/daterangepicker/moment.js'></script>

<script type="text/javascript" src='<?php echo $baseUrl; ?>/js/daterangepicker/daterangepicker.js'></script>
<style type="text/css">

#leftsidebar{
    background-color: #f1f5f7;
}
#profileSideNav ul li a i{
    font-size:2em;  
}
</style>

<input type="hidden" id="baseUrl" value="<?php echo Yii::app()->baseUrl?>"/>



    <!-- Contact Customers -->
    <div id="customers" class="tab-pane full-height active">
        <div class="row-fluid full-height">

            <div id="customerContent" class="content">

       

                    <div class="row">                        

                        <div class="customerListContainer col-sm-3 col-md-3">
                                <div style="margin:0px 2em;">
                                    <div class="customersActionHolder">
                                            <h3>Danh sách</h3>
                                            <a class="btn_plus" id="newCustomer" data-delay="0" data-placement="right" data-original-title="Thêm khách hàng"></a>
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
                                                <span class="help-block" id="parsley" style="color: #c72f29;font-weight:bold;"></span>
                                                <button id="addnewCustomer" class="btn btn_bookoke btn_bookoke_w">Tạo mới</button>
                                                <button id="cancelNewCustomer" type="reset" class="btn btn_cancel" style="min-width: 94px;margin-right: 0px;">Hủy</button>
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
                                        <ul id="customerList">
                                                
                                                   
                                        </ul>
                                        <div id="loadding" class="hidden" style="text-align: center;font-weight:bold;">
                                            <i class="fa fa-spinner fa-pulse fa-fw"></i>
                                            <span>Loading...</span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                      


                <!-- Detail Customer -->
                <div id="detailCustomer" class="col-sm-7 col-md-9">
                    <?php  include('customer_default.php'); ?>
                </div>


                <div class="clearfix"></div>

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
                               
                            </div>
                            <div align="center" class="setmoreHorizontalLoaderContent">Loading please wait...</div>
                        </div>

                        <div class="tab-pane" id="export_schedule">
                            <div align="center" class="setmoreHorizontalLoader">
                              
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


<script type="text/javascript">
    
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

$( document ).ready(function() {
    searchCustomers();
});

</script>


<?php include('_style.php'); ?>
<?php include('_js.php'); ?>