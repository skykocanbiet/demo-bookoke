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
 .slider_holder {
    float: left;
    /* margin-top: 3px; */
    overflow-x: hidden;
    padding-left: 0px;
    position: relative;
    width: 60px;
    height: 25px;
    cursor: pointer;
} 
.btnsearch:hover{
    /* box-shadow: 0 5px 15px rgba(0,0,0,.5);
         height: 109%;*/
}
.delete{
    float: right;
    display: none;
   
    margin-top: 12px;

}
.btn_delete{
      margin-top: -12px;
    margin-bottom: -6px;
    background-color: rgba(255, 255, 255, 0);
    border-color: rgba(204, 204, 204, 0.03);
}
#customerList li:hover .delete{
    display: inline;
}
#customerList .active .delete{
    display: inline;
}

</style>


<div class="row wrapper tab-content full-height">

<div>
    <?php include 'add_list.php'; ?>
    
</div>
    <!-- Contact Customers -->
    <div id="customers" class="tab-pane full-height active">
        <div class="row-fluid full-height">

            <div id="customerContent" class="content">
   				<!-- Detail Customer -->
                <div id="detailCustomer" class="col-sm-12 col-md-12 col-lg-12">
                    <?php  include('provider_default.php'); ?>
                </div>


                <div class="clearfix"></div>
            



        </div>
    </div>


</div>

<?php include('_style.php'); ?>
<?php include('_js.php'); ?>
