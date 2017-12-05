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

#profileSideNav ul li a img{
    opacity:.5;  
}

#profileSideNav ul li.active a img{
    opacity:1;  
}
  
#profileSideNav ul li a:hover img{
    opacity:1;  
}
  

</style>
<div class="row wrapper tab-content full-height">


    <!-- Contact Customers -->
    <div id="customers" class="tab-pane full-height active">
        <div class="row-fluid full-height">

            <div id="customerContent" class="content">

                <div  id="leftsidebar" class="col-sm-5 col-md-4 col-lg-3">
                    <div class="row">

                        <div  id="profileSideNav"  class="span1 primary-navbar col-sm-3 col-md-3">

                            <ul class="nav nav-tab nav-stacked" id="myTab">
                            <li id="profile_configure_nav">
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/itemsPartner/company/view" >
                                        <img src="<?php echo $baseUrl;?>/images/icon_sb_left/agent_act.png" /> <br>
                                        NHÀ CUNG CẤP
                                    </a>
                                </li>

                                <li id="profile_preview_nav" class="active">
                                    <a href="#itemsCustomers/Accounts/admin" data-toggle="tab">
                                        <img src="<?php echo $baseUrl;?>/images/icon_sb_left/daily.png" />
                                        <br>
                                       ĐẠI LÝ
                                    </a>
                                </li>

                                
                                
                            </ul>
                        </div>

                        <div class="customerListContainer col-sm-9 col-md-9" >
                            
                        </div>
                    </div>    
                    <div class="clearfix"></div>
                </div>   

                <!-- Detail Customer -->
                <div id="detailCustomer" class="col-sm-7 col-md-8 col-lg-9">
                    
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


$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();

    $('#profileSideNav').height(windowHeight-header);
    $('#detailCustomer').height(windowHeight-header);

});


</script>

