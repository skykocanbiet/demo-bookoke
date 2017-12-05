<?php
$baseUrl = Yii::app()->baseUrl;
?>

<style type="text/css">

#leftsidebar{
    padding: 0px;
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
               

                <!-- Detail Customer -->
                <div id="detailCustomer">
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
    var oSrchBar     = $("#oSrchBar").height();
    
    $('#profileSideNav').height(windowHeight-header);

    $('.statsTabContent').height(windowHeight-header-oSrchBar-30);

});
$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height(); 
    var oSrchBar     = $("#oSrchBar").height();

    $('#profileSideNav').height(windowHeight-header);

    $('.statsTabContent').height(windowHeight-header-oSrchBar-30); 

});

</script>


<?php include('_style.php'); ?>
<?php include('_js.php'); ?>