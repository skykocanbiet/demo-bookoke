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
.itemsPromotions li {
    line-height: 24px;
} 
.customerListHolder ul li {list-style-type: none;}

</style>

<div class="row">
    

                        <div class="customerListContainer col-sm-4 col-md-4">
                            <div style="margin:0px 2em;">

                                    <div class="customersActionHolder">
                                            <h3>Chương trình</h3>
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
                                                    <input type="text" required="" oninvalid="this.setCustomValidity('Vui lòng nhập họ và tên.')" oninput="setCustomValidity('')" class="form-control" id="customerNewName" name="customerNewName" placeholder="Họ và tên" style="margin-bottom:10px;">
                                                    <input type="text" required="" pattern="\d{6,12}" oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại.')" oninput="setCustomValidity('')" title="Số điện thoại phải từ 6 đến 12 số." class="form-control" id="customerNewPhone" name="customerNewPhone" placeholder="Số điện thoại" style="margin-bottom:10px;">                                           
                                                    <button id="addnewCustomer" class="new-gray-btn new-green-btn">Tạo mới</button>
                                                    <button id="cancelNewCustomer" type="reset" class="cancelNewStaff new-gray-btn" style="min-width: 94px;margin-right: 0px;">Hủy</button>
                                                </div>
                                            </form>
                                    </div>

                                   

                                    <div id="customerListHolder" class="customerListHolder" style="padding-top:5px;">  
                                        <ul id="customerList" style="max-height: 770px;">                                                    
                                                    <li id="c0"  class="n active">                                                                            
                                                        <span class="jqTransformCheckboxWrapper" style="display:none;">
                                                            <a href="#" class="jqTransformCheckbox"></a>
                                                            <input type="checkbox" value="0" class="fl" style="display : none;">
                                                        </span> 
                                                        <label class="fl"><i class="fa fa-folder"></i> Tất cả </label>
                                                        <div class="clearfix"></div>
                                                    </li>


                                                    <li  onclick="" class="n">                                        
                                                        <span class="jqTransformCheckboxWrapper" style="display:none;">
                                                            <a href="#" class="jqTransformCheckbox"></a>
                                                            <input type="checkbox" value="1" class="fl" style="display : none;">
                                                        </span>  
                                                        <label class="fl"><i class="fa fa-folder"></i> Hội viên </label>
                                                        <div class="clearfix"></div>
                                                    </li> 

                                                    <li  onclick="" class="n">                                        
                                                        <span class="jqTransformCheckboxWrapper" style="display:none;">
                                                            <a href="#" class="jqTransformCheckbox"></a>
                                                            <input type="checkbox" value="2" class="fl" style="display : none;">
                                                        </span>  
                                                        <label class="fl"><i class="fa fa-folder"></i> Giảm giá </label>
                                                        <div class="clearfix"></div>
                                                    </li>

                                                    <li  onclick="" class="n">                                        
                                                        <span class="jqTransformCheckboxWrapper" style="display:none;">
                                                            <a href="#" class="jqTransformCheckbox"></a>
                                                            <input type="checkbox" value="3" class="fl" style="display : none;">
                                                        </span>  
                                                        <label class="fl"><i class="fa fa-folder"></i>Phiếu quà tặng</label>
                                                        <div class="clearfix"></div>
                                                    </li>
                                                   
                                            </ul>

                                    </div>

                            </div>
                        </div>
                    
               
   
</div>

<script type="text/javascript">

    
$( document ).ready(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();

    $('#profileSideNav').height(windowHeight-header);
    $('.customerListContainer').height(windowHeight-header);
    $('#detailCustomer').height(windowHeight-header);
    $('.cal-loading').fadeOut('slow');

});

$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    $('#profileSideNav').height(windowHeight-header);
    $('.customerListContainer').height(windowHeight-header);
    $('#detailCustomer').height(windowHeight-header);

});

</script>

