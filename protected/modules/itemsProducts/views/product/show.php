<?php 
$baseUrl = Yii::app()->baseUrl;

$v = new CDbCriteria(); 
$v->addCondition('t.status_proline = 1');
$v->order= 'id DESC';
$pl_all=$pl->findAll($v);

$b=new Branch;
$b_all=$b->findAll();

function titleCase($string, $delimiters = array(" ", "-", ".", "'", "O'", "Mc"), $exceptions = array("and", "to", "of", "das", "dos", "I", "II", "III", "IV", "V", "VI"))
{    
    $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
    foreach ($delimiters as $dlnr => $delimiter) {
        $words = explode($delimiter, $string);
        $newwords = array();
        foreach ($words as $wordnr => $word) {
            if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                // check exceptions list for any words that should be in upper case
                $word = mb_strtoupper($word, "UTF-8");
            } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                // check exceptions list for any words that should be in upper case
                $word = mb_strtolower($word, "UTF-8");
            } elseif (!in_array($word, $exceptions)) {
                // convert to uppercase (non-utf8 only)
                $word = ucfirst($word);
            }
            array_push($newwords, $word);
        }
        $string = join($delimiter, $newwords);
   }
   return $string;
}

?>
<!--Font Awesome and Bootstrap Main css  -->

<input type="hidden" id="baseUrl" value="<?php echo Yii::app()->baseUrl?>"/>

<style type="text/css">
#profileSideNav ul li a i{
    font-size:2em;  
}
#product-container{
    padding:20px;position: fixed;top: 2%;right: 0;left: 0;width: 750px;height: auto;margin: 0 auto;background: #ffffff;border-radius: 3px;z-index: 999;
}
.blur{
    display: none;position: fixed;top: 0;right: 0;width: 100%;height: 100%;z-index: 999;background: rgba(0,0,0,0.8);
}
.sHeader{
    background: #e6e6e5;
    color: #5a5a5a;
    padding: 9px 30px;
    font-size: 18px;
    margin-left: -35px;
    margin-top: -20px;
    margin-right: -35px;
}
table th,table td{
    text-align: center;
}    

.rg-row{
    margin-left: -15px;
    margin-right: -15px;
}
.margin-bottom-05em{
    margin-bottom: .5em;
}
/*PHAN TRANG*/
.div_phan_trang
{
    width:100%;
    text-align:center;
}
.div_trang
{
    width:30px;
    padding:5px 10px 5px 10px;
    text-align:center;
    /*background:#F5D7BA;*/
    margin:2px;
}
.div_trang a
{
    text-decoration:none;
}
.close {
    font-size: 36px;
    color: white;
    opacity: 1;
    font-weight: lighter;
}
/*END PHAN TRANG*/
/*TABLE TOGGLE*/
.btn-toggle {border-radius: 0; margin-right: 15px; color: white;}

.oBtnDetail {background: #94c63f;}


.oView {    
    padding: 0 25px 25px 25px;
    margin: 10px 0;    
}
.hiddenRow {padding: 0 !important;background-color: #fff;}
tr.accordion-toggle {cursor: pointer;}
.table-product>thead{
    color: #fff;
    background-color: rgba(115, 149, 158, 0.80);
}
.table-product {
    border-bottom:0px !important;
}

.table-product>tbody {
    display:block;
    height:50px;
    overflow:auto;
}
.table-product>thead, .table-product>tbody tr {    
    display:table;
    width:100%;
    table-layout:fixed;/* even columns width , fix width of table too*/
}
.table-product>thead {
    width: calc( 100% - 1em )/ scrollbar is average 1em/16px width, remove it from thead width /
}
.at{
    background-color: #c4e2c7 !important;
}
/*END TABLE TOGGLE*/
.thumbnail{
height: 100px;
width: 100px;
margin: 10px;
}
.count{
    font-weight: normal;
    font-size: 14px;
}
</style>




    <!-- Contact Customers -->
    <div id="customers" class="tab-pane full-height active">
        <div class="row-fluid full-height">

            <div id="customerContent" class="content">

               
                    <div class="row">

                        <div class="customerListContainer col-sm-3 col-md-3">
                            <div style="margin:0px 2em;">
                                    <div class="customersActionHolder">
                                                                                        <h3 style="width: 170px;">Nhóm sản phẩm</h3>
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

                                    <div id="addnewCustomerPopup" class="popover bottom" style="display: none;padding:0px;">
                                        <form id="frm-add-customer" onsubmit="return false;" class="form-horizontal">                                         
                                            <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Thêm nhóm sản phẩm</h3>
                                            <div class="popover-content" style="width:225px;">
                                                <input type="text" required="" oninvalid="this.setCustomValidity('Vui lòng nhập tên nhóm sản phẩm.')" oninput="setCustomValidity('')" class="form-control" id="productNewName" name="productNewName" placeholder="Tên nhóm sản phẩm" style="margin-bottom:10px;width:96%;">                                                
                                                <button id="addnewCustomer" class="btn btn_bookoke btn_w">Tạo mới</button>
                                                <button id="cancelNewCustomer" type="reset" class="btn btn_cancel" style="min-width: 94px;margin-right: 0px;">Hủy</button>
                                                
                                            </div>
                                        </form>
                                    </div>

                                    

                                    <div id="customerListHolder" class="customerListHolder">  
                                    <ul id="customerList" style="max-height: 770px;">
                                       
                                                    <li id="c0" onclick="detailProductLine(0);" class="n active">
                                                                            
                                                                            <span class="jqTransformCheckboxWrapper" style="display:none;">
                                                                                <a href="#" class="jqTransformCheckbox"></a>
                                                                                <input type="checkbox" value="0" class="fl" style="display : none;">
                                                                            </span>
                                                                            
                                                                         
                                                                            <label class="fl"> Tất cả (<?php echo count($pl_all);?>) </label>
                                                                            <div class="clearfix"></div>
                                                     </li>
                                                    <?php 
                                                    foreach ($pl_all as $k => $v) 
                                                    {
                                                    ?> 
                                                     <li id="c<?php echo $v->id;?>" onclick="detailProductLine(<?php echo $v->id;?>);" class="n">
                                        
                                                        <span class="jqTransformCheckboxWrapper" style="display:none;">
                                                            <a href="#" class="jqTransformCheckbox"></a>
                                                            <input type="checkbox" value="<?php echo $v->id;?>" class="fl" style="display : none;">
                                                        </span>
                                                        
                                                       
                                                        <label class="fl"> <?php echo titleCase($v['name']);?> </label>
                                                       
                                                        <img id="ltn<?php echo $v->id;?>" class="hide" onclick="showUpdateProductLine(<?php echo $v->id;?>);" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/edit_cam.png" style="float:right;margin: 9px 6px 0 0;width: 20px;height: 20px;">
                                                        <div class="clearfix"></div>
                                                     </li> 
                                                    <div id="updateProductLinePopup<?php echo $v->id;?>" class="popover bottom product-line" style="display: none;padding:0px;top:150px;left:500px;">
                                                        <form id="frm-update-product-line-<?php echo $v->id;?>" onsubmit="return false;" class="form-horizontal">                                                                                                 
                                                            <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Chỉnh sửa nhóm sản phẩm</h3>
                                                            <div class="popover-content" style="width:225px;">
                                                                <input type="text" required="" oninvalid="this.setCustomValidity('Vui lòng nhập tên nhóm sản phẩm.')" oninput="setCustomValidity('')" class="form-control" id="productlineNewName<?php echo $v->id;?>" name="productlineNewName" value="<?php echo $v['name'];?>" placeholder="Tên nhóm sản phẩm" style="margin-top:0px;padding: 6px 12px;margin-bottom:10px;width:98%;">
                                                                <button onclick="deleteProductLine(<?php echo $v->id;?>);" class="btn btn_delete" style="min-width: 94px;margin-right: 0px;">Xóa</button>
                                                                <button onclick="updateProductLine(<?php echo $v->id;?>);" class="btn btn_bookoke">Cập nhật</button>
                                                            </div>
                                                        </form>
                                                    </div>                                    
                                                    <?php 
                                                    }
                                                    ?> 
                                                   
                                            </ul>

                                    </div>
                                </div>
                        </div>


                     


                <!-- Detail Customer -->
                <div id="addProduct" class="col-sm-7 col-md-9">





                

                    <div class="rg-constrained">

    <div class="rg-row">
        <div class="col-md-12">
<div class="t-settings-head affix-top" data-spy="affix" data-offset-top="105" style="margin-top:10px;">
    <h1>Tất cả <label class="count" id="countservice"></label></h1>
    <div class="t-settings-head__actions">  
            <div class="input-group" style="display:inline-flex;width:300px;margin-right:30px;">
              <input type="text" class="form-control" id="searchProduct" placeholder="Tìm kiếm theo mã và tên sản phẩm">
              <div class="input-group-addon" onclick="searchProduct();"  id="glyphicon-search" style="padding-right:25px;cursor:pointer;"><span class="glyphicon glyphicon-search"></span></div>
           </div>   
            <!-- <button class="btn btn-default dropdown-toggle" type="button" id="btnReport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right:5px;">Báo cáo
                <span class="caret"></span>
            </button>  -->         
            <a href="javascript:void(0);" class="btn_plus" id="add_product" onclick="" data-delay="0" data-placement="right" data-original-title="Thêm khách hàng"></a>
    </div>
   
</div>
<div id="detailProductLine" style="margin-top:20px;" >


</div>

        </div>
      
    </div>

</div>

  





                

                </div>

                <div class="clearfix"></div>
                
            </div>

            <div class="clearfix"></div>

            </div>   

            

        </div>
    </div>
















<div class="blur" id="add-product-blur">

<div class="rg-constrained" id="product-container">

        <div class="col-md-12">


                
 
 <div class="modal-header popHead sHeader" style="">
   <a class="btn_close close_p" data-dismiss="modal" aria-label="Close"></a>
    <h5>Tạo Sản Phẩm Mới</h5>
</div> 
<form class="product-form" id="product-form"  runat="server" action="" onsubmit="return false;" method="post">
<input id="XeroAuthError" name="XeroAuthError" type="hidden" value="False">
<input name="__RequestVerificationToken" type="hidden" value="coTO7fNiICrHN1GReqJ-KMIP5nWTduPaPUkDBDvAW593aEKWnN9EdG42_UHeTMWSlsvj8AASfAHbdZ5ExIOEvXDeVkPnwH1jEGSpwiYplrEqA3BBFytebHeoZXOpHJgQdCcZp5Cw-ySRxH8Dm0xBDVaH1ngsMGH8KMLgvEIOXL5fckcI0">    

    <div class="rg-row">

        <div class="col-md-12" style="margin-top:10px;">

            <h5>Chi tiết sản phẩm</h5>
           

        </div>
        <div class="col-md-12">

            <div class="rg-row">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">

                </div>
            </div>

            <div class="rg-row">
                <div class="col-sm-12">
                    <div class="form-group margin-bottom-05em required" id="rq-product-name">
                        <span class="" for="Product_Name">Tên sản phẩm</span>
                        <input class="form-control" id="Product_Name" name="Product_Name" type="text" value="">
                    </div>
                     <div class="form-group margin-bottom-05em required" id="rq-product-code">
                        <span class="" for="Product_Code">Mã sản phẩm</span>
                        <input class="form-control" id="Product_Code" name="Product_Code" type="text" value="">
                        <input type="hidden" value="" id="hidden_inventory_increase" name="hidden_inventory_increase">
                        <input type="hidden" value="" id="hidden_inventory_decrease" name="hidden_inventory_decrease">
                    </div>
                </div>

              
            </div>
             
            <div class="form-group margin-bottom-05em" id="rq-product-line">
                <span class="" for="ProductLineId">Nhóm sản phẩm</span>
                <?php
                    $product_line = array();
                    foreach($pl_all as $temp){
                        $product_line[$temp['id']] = $temp['name'];
                    }                            
                    echo CHtml::dropDownList('ProductLineId','',$product_line,array('class'=>'form-control','empty' => 'Chọn nhóm sản phẩm','options'=>array()));
                ?>     
            </div>

            <div class="form-group margin-bottom-05em ">
                <span class="" for="Product_Description">Mô tả</span>
                <span class="char-count-container">                     
                    <?php                                                 
                    $this->widget(
                        'booster.widgets.TbRedactorJs',
                        array(
                            'id'=> 'Product_Descriptions',
                            'name' => 'Product_Description',                          
                        )
                    );
                    ?>
                </span>
            </div>

            <div class="rg-row">
                <div class="col-sm-4">
                    <div class="form-group margin-bottom-05em" id="rq-product-costprice">
                        <span for="Product_CostPrice">Giá vốn</span> <a class="hide warning-icon-offset tip-init" href="javascript:void(0);" rel="popover" data-content="You have set your cost price higher than your retail price. Is this what you intended?" data-original-title="Cost price exceeds retail price">&nbsp;<i class="fa fa-exclamation-circle fa-fw fa-lg text-danger">&nbsp;</i></a>
                        <div class="input-group">
                            
                            <input value="" class="form-control price-input cost-price autoNum" onkeypress=" return isNumberKey(event)" id="Product_CostPrice" name="Product_CostPrice" type="text">
                            <span class="input-group-addon">VND</span>
                        </div>

                        
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group margin-bottom-05em" id="rq-product-price">
                        <span class="" for="Product_Price">Giá bán</span>
                        <div class="input-group">
                            
                            <input value="" class="form-control price-input retail-price autoNum" onkeypress=" return isNumberKey(event)" id="Product_Price" name="Product_Price" type="text">
                            <span class="input-group-addon">VND</span>
                        </div>
                        
                    </div>
                </div>
                 <div class="col-sm-4">
                    <div class="form-group margin-bottom-05em">
                        <span class="" for="Product_Tax">Thuế</span>
                         <div class="input-group">
                            
                           
                            <input class="form-control tax-input" onkeypress=" return isNumberKey(event)" id="Product_Tax" name="Product_Tax" type="text" value="">                             
                              <div class="input-group-addon">%</div>   
                        </div>
                    </div>
                </div>
            </div>

           

        </div>
    </div>
    <div class="rg-row">
        <div class="col-md-12">
            <h5>Tồn kho</h5>
            <a id="stock-control"></a>
           
        </div>
        <div class="col-md-12">
               <table class="table table-no-side-padding table-middle table-not-bordered">
                   <thead>
                       <tr>
                           <th>Vị trí</th>
                           <th><a class="tip-init" data-original-title="The amount of stock available for sale">Có sẵn</a></th>
                           <th></th>
                           <th></th>
                           <th><a class="invisible tip-init" data-original-title="When stock reaches this level we will alert you via an app notification and email">Alert</a></th>
                       </tr>
                   </thead>
                   <tbody>
                       
                    <?php 
                    foreach($b_all as $v) 
                    {                                                   
                    ?>
                    <tr data-location-id="68002">
                        <input id="Stock_StockQuantity_0__Location_LocationId" name="Stock.StockQuantity[0].Location.LocationId" type="hidden" value="68002">
                        <input id="Stock_StockQuantity_0__Location_Name" name="Stock.StockQuantity[0].Location.Name" type="hidden" value="aaaa">
                        <input class="quantity-available-type" id="Stock_StockQuantity_0__StockQuantityAvailableTypeId" name="Stock.StockQuantity[0].StockQuantityAvailableTypeId" type="hidden" value="1">
                        <input class="quantity-public" id="Stock_StockQuantity_0__Public" name="Stock.StockQuantity[0].Public" type="hidden" value="">
                        <input id="Stock_StockQuantity_0__Private" name="Stock.StockQuantity[0].Private" type="hidden" value="">
                        <input class="quantity-transaction-type" id="Stock_StockQuantity_0__StockQuantityTransactionTypeId" name="Stock.StockQuantity[0].StockQuantityTransactionTypeId" type="hidden" value="0">
                        <input class="quantity-comment" id="Stock_StockQuantity_0__Comment" name="Stock.StockQuantity[0].Comment" type="hidden" value="">
                        <td>
                            <?php echo $v['name'];?>
                        </td>
                        <td class="quantity-public-label" id="quantity-public-label-<?php echo $v['id'];?>">Không giới hạn</td>
                        <td>
                            <div class="btn-group btn-adjust-stock">
                                <a href="javascript:void(0);" class="btn-sm quantity-increase" onclick="openIncreasePopup(<?php echo $v['id'];?>);" data-location-id="68002"><i class="fa fa-plus"></i></a>
                                <a href="javascript:void(0);" class="btn-sm quantity-decrease" onclick="openDecreasePopup(<?php echo $v['id'];?>);" data-location-id="68002"><i class="fa fa-minus"></i></a>
                            </div>
                        </td>
                        <!-- <td>
                            <a href="javascript:void(0);" class="quantity-set isUnlimited" data-location-id="68002">reset to zero</a>
                        </td> -->
                        <td>
                            <input class="input-tiny quantity-alert form-control invisible" id="Stock_StockQuantity_0__Alert" name="Stock.StockQuantity[0].Alert" type="text" value="">
                        </td>
                    </tr>
                    <?php 
                    }
                    ?>
                   </tbody>
               </table>
               <div class="checkbox quantity-allow-negative-stock hide">
                   <label>
                       <input id="Stock_AllowNegativeStockQuantity" name="Stock.AllowNegativeStockQuantity" type="checkbox" value="true"><input name="Stock.AllowNegativeStockQuantity" type="hidden" value="false">&nbsp;Allow product to be sold even when out of stock?
                       <a href="javascript:void(0);" rel="popover" data-content="If your stock level falls to zero this product will still be available and the stock will reduce to a negative value." data-original-title="Available when out of stock" class="tip-init">&nbsp;<i class="fa fa-question-circle">&nbsp;</i></a>
                   </label>
               </div>
               <div class="checkbox quantity-email-alert hide">
                   <label>
                       <input id="Stock_StockAlertEmailEnabled" name="Stock.StockAlertEmailEnabled" type="checkbox" value="true"><input name="Stock.StockAlertEmailEnabled" type="hidden" value="false">&nbsp;Send emails when available stock reaches the alert limit?
                       <a href="javascript:void(0);" rel="popover" data-content="If your available stock level reaches the alert level set above an email will be sent to the main account holder. Even when this setting is disabled in-app notifications are still displayed." data-original-title="Stock alert email" class="tip-init">&nbsp;<i class="fa fa-question-circle">&nbsp;</i></a>
                   </label>
               </div>
        </div>
    </div>


    <div class="rg-row">
        <div class="col-md-12">
            <h5>Hình ảnh</h5>           
        </div>
        <div class="col-md-12">

                <output id="result" />
                </output>
                <div class="clearfix"></div>
                <div id="file-uploader">
                    <noscript>
                        &lt;p&gt;
                            Please enable JavaScript to use file uploader.&lt;/p&gt;
                        &lt;!-- or put a simple form for upload here --&gt;
                    </noscript>
                </div>
                <div class="modal-only">
                    <br>
                    <hr>
                </div>
                <p></p>
                <span id="upload" style="position: relative; overflow: hidden; direction: ltr;"> <!-- Required for IE -->
                    <span id="upload"> <!-- Required for IE -->
                        <a class="btn btn_bookoke" type="button" name="upload" id="upload" value="Upload"><i class="fa fa-arrow-circle-o-up"></i>&nbsp;Tải ảnh mới</a> 
                    </span>
                <input multiple="multiple" id="Product_Image" type="file" name="Product_Image[]" style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 20px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0;"></span>
                <span id="delete-button" style="display: none;">&nbsp;&nbsp;or&nbsp;&nbsp; <a class="btn btn-danger" href="javascript:void(0);" id="delete">
                                                                        <i class="fa fa-trash-o"></i>&nbsp;&nbsp;Delete</a> 
                </span>
                <div class="progress progress-striped active" id="progress" style="display: none;">
                    <div class="bar" style="width: 40%;" id="bar">
                    </div>
                </div>
            <p></p>
            <div id="error" class="alert alert-error" style="display: none;">
            </div>

        </div>
    </div>
   


     <div class="rg-row">
                   
            <div class="col-md-12">
                <h5>Điểm thưởng</h5>    


                <div class="rg-row">
                    <div class="col-sm-6">
                        <div class="form-group  margin-bottom-05em">

                            <span for="Product_Point_Donate" style="padding:0px;">Điểm được tặng khi mua sản phẩm</span>
                            <span  style="width: 45px;margin-left: 15px;display: inline-block;">
                                <input class="form-control" onkeypress=" return isNumberKey(event)" id="Product_Point_Donate" name="Product_Point_Donate" type="text" value="" data-parsley-id="0924">
                            </span>
                        <span class="help-block validation-error" id="parsley-id-0924"></span></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group margin-bottom-05em">
                            <span for="Product_Point_Exchange" style="padding:0px;">Điểm cần có để quy đổi sản phẩm</span>
                            <span style="width: 45px;margin-left: 15px; display: inline-block;"> 
                                <input class="form-control" onkeypress=" return isNumberKey(event)" id="Product_Point_Exchange" name="Product_Point_Exchange" type="text" value="" data-parsley-id="0924">
                            </span>
                        <span class="help-block validation-error" id="parsley-id-2107"></span></div>
                    </div>
                   

                </div>
            </div>

    </div>

    <div class="rg-row" style="margin-top:10px;">
        <div class="col-md-12">
            <div class="form-actions text-right">
                <a href="javascript:void(0);" class="btn btn_cancel close_p">Hủy</a>
                <button id="btn-add-product" type="submit" class="btn btn_bookoke">Xác nhận</button>
            </div>
        </div>
    </div>
</form>

    
        </div>
        <div class="col-md-10">
            <div>

            </div>
        </div>


</div>

<div class="popover top in" id="increasePopup" style="top: 350px; left: 760px; display: none; z-index: 5001;border: 0px;background-color: transparent;box-shadow: 0 0px 0px rgba(0, 0, 0, 0);"><div class="arrow"></div><div class="popover-inner stock-quantity-balloon" style="padding:0px;background: #fff;"><h3 class="popover-title">Tăng số lượng tồn kho<a class="close bln-close"><i class="fa fa-remove"></i></a></h3><div class="popover-content"><div><form class="form-vertical"><table class="table-condensed table-not-bordered table-no-decoration stock-quantity-table"><thead><tr><th class="left">Thêm</th><th>Lý do</th></tr></thead><tbody><tr><td style="width: 45%"><input class="input-small form-control quantity-adjustment" type="number" onchange="BtnDisabled();" id="ipt-increase" value="" min="1" placeholder="Số lượng"></td><td style="width: 55%"><select class="form-control quantity-transaction-type" id="StockTransactionTypesIncrease" name="StockTransactionTypesIncrease"><option value="3">Tồn kho mới</option><option value="1">Trả về</option><option value="2">Chuyển đổi</option><option value="4">Điều chỉnh</option><option value="5">Khác</option></select></td></tr><tr><td colspan="2" class="hide"><textarea class="quantity-comment form-control" style="width: 230px;" maxlength="250"></textarea></td></tr></tbody></table><div class="text-right" style="margin-top: 10px">&nbsp;&nbsp;<a href="javascript:void(0);" class="btn  bln-close"><i class="fa fa-remove"></i> Hủy</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="btn btn-primary " id="btn-increase" disabled="true" data-location-id="68002"><i class="fa fa-ok"></i> Thêm</a></div></form></div></div></div></div>
<div class="popover top in" id="decreasePopup" style="top: 350px; left: 790px; display: none; z-index: 5001;border: 0px;background-color: transparent;box-shadow: 0 0px 0px rgba(0, 0, 0, 0);"><div class="arrow"></div><div class="popover-inner stock-quantity-balloon" style="padding:0px;background: #fff;"><h3 class="popover-title">Giảm số lượng tồn kho<a class="close bln-close"><i class="fa fa-remove"></i></a></h3><div class="popover-content"><div><form class="form-vertical"><table class="table-condensed table-not-bordered table-no-decoration stock-quantity-table"><thead><tr><th class="left">Bỏ</th><th>Lý do</th></tr></thead><tbody><tr><td style="width: 45%"><input class="input-small form-control quantity-adjustment" type="number" onchange="BtnDisabled();" id="ipt-decrease" value="" min="1" placeholder="Số lượng"></td><td style="width: 55%"><select class="form-control quantity-transaction-type" id="StockTransactionTypesDecrease" name="StockTransactionTypesDecrease"><option value="7">Hư hỏng</option><option value="8">Hết hạn</option><option value="9">Đã bán</option><option value="10">Loại bỏ</option><option value="4">Điều chỉnh</option><option value="5">Khác</option></select></td></tr><tr><td colspan="2" class="hide"><textarea class="quantity-comment form-control" style="width: 230px;" maxlength="250"></textarea></td></tr></tbody></table><div class="text-right" style="margin-top: 10px">&nbsp;&nbsp;<a href="javascript:void(0);" class="btn  bln-close"><i class="fa fa-remove"></i> Hủy</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="btn btn-primary " id="btn-decrease" disabled="true" data-location-id="68002"><i class="fa fa-ok"></i> Bỏ</a></div></form></div></div></div></div>

</div>













<script type="text/javascript">
var baseUrl = $('#baseUrl').val();
var templock = 0;


function showAddProduct(){

var elem = $('#add-product-blur')[0];


  $('#add_product').on('click',function(e){

    $(elem).fadeToggle(200,function(){
    });
    e.stopPropagation();
});


$('body').on('click',function(e){
    if(templock == 0){
        if($(e.target).closest($('#product-container')).length === 0){  
            if($(e.target).closest($('#increasePopup')).length === 0){  
                if($(e.target).closest($('#decreasePopup')).length === 0){           
                    if($(elem).is(':visible')){
                        templock = 1;
                        $(elem).fadeToggle(200,function(){
                            templock = 0;
                        });
                    } 
                }    
            }               
        }
    }
});

$('.close_p').on('click',function(e){
    if(templock == 0){                   
            if($(elem).is(':visible')){
                templock = 1;   
                $(elem).fadeToggle(200,function(){
                    templock = 0;
                }); 
            }                    
    }
});

$( document ).on( 'keydown', function ( e ) {
    if(templock == 0){
        if($(elem).is(':visible')){
            if ( e.keyCode === 27 ) {
                templock = 1;
                $(elem).fadeToggle(200,function(){
                    templock = 0;
                });
            }
        }
    }
});
}
showAddProduct();

function detailProductLine(id){    
    var curpage=1;    
    $('.cal-loading').fadeIn('fast');
    $('.n').removeClass("active");   
    $("#c"+id).addClass("active");    
    $("#c"+id).find('code').removeClass("hide");  
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsProducts/Product/detailProductLine', 
        data: {"id":id,"curpage":curpage},   
        success:function(data){     
            $('#searchProduct').val('');        
            $('#detailProductLine').html(data);
            countservice(id);
            $('.cal-loading').fadeOut('slow');   
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });
}
function countservice(id){
     $.ajax({
        type:'POST',
        url: baseUrl+'/itemsProducts/Product/countservice', 
        data: {"id":id},   
        success:function(data){
           
            $('#countservice').html(data);
              
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });
}
$(function() {
    $("#customerList li")
        .mouseover(function() { 
            $(this).find("img").removeClass("hide");         
        })
        .mouseout(function() {                  
            $(this).find("img").addClass("hide");    
        })    
});

function pagination(curpage,id){  
    $('.cal-loading').fadeIn('fast');  
    var searchProduct= $('#searchProduct').val();     
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsProducts/Product/detailProductLine', 
        data:{"id":id,"curpage": curpage,"searchProduct": searchProduct},
        success:function(data){
            $('#detailProductLine').html(data);
            $('.cal-loading').fadeOut('slow');
        },
        error: function(data){
            console.log("error");
            console.log(data);
        }
    });      
}
function searchProduct(){ 
    $('.cal-loading').fadeIn('fast');
    var id=$('.n.active').find('span').find('input').val();   
    var curpage=1;      
    var searchProduct= $('#searchProduct').val(); 
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsProducts/Product/detailProductLine', 
        data:{"id":id,"curpage": curpage,"searchProduct": searchProduct},
        success:function(data){
            $('#detailProductLine').html(data); 
            $('.cal-loading').fadeOut('slow');          
        },
        error: function(data){
            console.log("error");
            console.log(data);
        }
    });
}
function isNumberKey(evt)
{
   var charCode = (evt.which) ? evt.which : event.keyCode;
   if(charCode == 59 || charCode == 46)
    return true;
   if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
   return true;
} 

function error_add_product(){

    var status = true;

    if($('#Product_Name').val() == ''){
        status = false;       
        $('#rq-product-name').addClass('error');         
    }
    else{
        $('#rq-product-name').removeClass('error');
    }

    if($('#Product_Code').val() == ''){
        status = false;       
        $('#rq-product-code').addClass('error');            
    }
    else{
        $('#rq-product-code').removeClass('error');
    }

    if($('#ProductLineId').val() == ''){
        status = false;       
        $('#rq-product-line').addClass('error');      
    }
    else{
        $('#rq-product-line').removeClass('error');
    }

    if($('#Product_CostPrice').val() == ''){
        status = false;       
        $('#rq-product-costprice').addClass('error');         
    }
    else{
        $('#rq-product-costprice').removeClass('error');
    }

    if($('#Product_Price').val() == ''){
        status = false;       
        $('#rq-product-price').addClass('error');         
    }
    else{
        $('#rq-product-price').removeClass('error');
    }    

    return status;
}
function addProduct(){    
    $('#btn-add-product').click(function(){
        if(error_add_product()){            
            $('.cal-loading').fadeIn('fast'); 
            var formData = new FormData($('#product-form')[0]);         
            if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({
                type:'POST',
                url: baseUrl+'/itemsProducts/Product/addProduct',
                data:formData,
                datatype:'json',
                success:function(data){ 
                    if (data == '-1') {                         
                        $('#rq-product-code').addClass('error');                     
                        $('.cal-loading').fadeOut('slow');
                        return false;
                    }
                    else if(data == '1')
                    {
                        $('#rq-product-code').removeClass('error');
                        $('.cal-loading').fadeOut('slow'); 
                        window.location.assign("<?php echo CController::createUrl('Product/Show')?>"); 
                    } 
                },
                error: function(data){
                    console.log("error");
                    console.log(data);
                },
                cache: false,
                contentType: false,
                processData: false
            });
            }
        }
    });
}
addProduct();

// PRODUCT INVENTORY
function openIncreasePopup(id){   
    $('#btn-increase').attr('onclick','addIncrease('+id+')'); 
    $('#ipt-increase').val('');  
    $('#StockTransactionTypesIncrease').val('3');   
    $('#increasePopup').fadeToggle('fast');
}
function openDecreasePopup(id){
    $('#btn-decrease').attr('onclick','removeDecrease('+id+')');     
    $('#ipt-decrease').val('');  
    $('#StockTransactionTypesDecrease').val('7');
    $('#decreasePopup').fadeToggle('fast');
}
$('.bln-close').click(function(){ 
    $('#increasePopup').hide(); 
    $('#decreasePopup').hide();
});
$(document).mouseup(function (e)
{
    var increasePopup = $("#increasePopup");
    if (!increasePopup.is(e.target) 
        && increasePopup.has(e.target).length === 0) 
    {        
        increasePopup.hide();
    }    

    var decreasePopup = $("#decreasePopup");
    if (!decreasePopup.is(e.target) 
        && decreasePopup.has(e.target).length === 0) 
    {        
        decreasePopup.hide();
    }      
});
function BtnDisabled(){
    if($('#ipt-increase').val()>0)
    {
        $('#btn-increase').removeAttr('disabled');
    }  
    else
    {
        $('#btn-increase').attr('disabled','disabled');
    }  

    if($('#ipt-decrease').val()>0)
    {
        $('#btn-decrease').removeAttr('disabled');
    }  
    else
    {
        $('#btn-decrease').attr('disabled','disabled');
    } 
}
function addIncrease(id){
    if($('#quantity-public-label-'+id).html()=="Không giới hạn")
    {
        var number=0;        
    }
    else{
        var number=parseInt($('#quantity-public-label-'+id).html());
    }

    var amount    = parseInt($('#ipt-increase').val());
    var status    = $('#StockTransactionTypesIncrease').val();

    var inventory = $('#hidden_inventory_increase').val();    
    if(inventory){
        var inventory = JSON.parse(inventory);
    }else{
        inventory = [];
    }
    var response = {};
    response['id_branch'] = id; 
    response['available'] = amount;
    response['status'] = status;
    inventory.push(response); 
    $('#hidden_inventory_increase').val(JSON.stringify(inventory)); 
    
    $('#quantity-public-label-'+id).html(number+amount);  
    $('#increasePopup').hide();  
    $('#btn-increase').attr('disabled','disabled'); 
   
}
function removeDecrease(id){
    if($('#quantity-public-label-'+id).html()=="Không giới hạn")
    {
        var number=0;
    }
    else{
        var number=parseInt($('#quantity-public-label-'+id).html());
    }

    var amount    = parseInt($('#ipt-decrease').val());
    var status    = $('#StockTransactionTypesDecrease').val();

    var inventory = $('#hidden_inventory_decrease').val();    
    if(inventory){
        var inventory = JSON.parse(inventory);
    }else{
        inventory = [];
    }
    var response = {};
    response['id_branch'] = id; 
    response['available'] = amount;
    response['status'] = status;
    inventory.push(response); 
    $('#hidden_inventory_decrease').val(JSON.stringify(inventory)); 

    $('#quantity-public-label-'+id).html(number-amount);    
    $('#decreasePopup').hide(); 
    $('#btn-decrease').attr('disabled','disabled');
   
}
// END PRODUCT INVENTORY
$('#newCustomer').click(function(){ 
    $('#addnewCustomerPopup').fadeToggle('fast');
});
$('#cancelNewCustomer').click(function(){ 
    $('#addnewCustomerPopup').hide(); 
});
$(document).mouseup(function (e)
{
    var container = $("#addnewCustomerPopup");
    if (!container.is(e.target) 
        && container.has(e.target).length === 0) 
    {        
        container.hide();
    } 
});
function showUpdateProductLine(id){    
    var evt = window.event || arguments.callee.caller.arguments[0];
    evt.preventDefault();
    var position = $('#ltn'+id).position();    
    $('#updateProductLinePopup'+id).css({"top": position.top-50, "left": position.left+50});
    $('#updateProductLinePopup'+id).fadeToggle('fast');
    evt.stopPropagation();
}

$(document).mouseup(function (e)
{
    var container = $(".popover.bottom.product-line");
    if (!container.is(e.target) 
        && container.has(e.target).length === 0) 
    {        
        container.hide();
    } 
});
$('#frm-add-customer').submit(function(e) {    
    e.preventDefault();    
    var formData = new FormData($("#frm-add-customer")[0]);    
    if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({           
            type:"POST",
            url: baseUrl+'/itemsProducts/Product/addProductLine',          
            data:formData,
            datatype:'json',
            success:function(data){
                if(data == '1'){ 
                $('#addnewCustomerPopup').hide();               
                e.stopPropagation();
                window.location.assign("<?php echo CController::createUrl('Product/Show')?>"); 
                }
            },
            error: function(data) {
                alert("Error occured. Please try again!");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
    return false;
});
function updateProductLine(id){ 
    if($('#productlineNewName'+id).val()!=""){
        var formData = new FormData($('#frm-update-product-line-'+id)[0]);  
        formData.append('id_product_line',id);     
        if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({
                type:'POST',
                url: baseUrl+'/itemsProducts/Product/updateProductLine',
                data:formData,
                datatype:'json',
                success:function(data){             
                    if(data == '1'){ 
                    $('#updateProductLinePopup'+id).hide();  
                    window.location.assign("<?php echo CController::createUrl('Product/Show')?>"); 
                    }
                },
                error: function(data){
                    console.log("error");
                    console.log(data);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    }
}
function deleteProductLine(id){
    if (confirm("Bạn có thật sự muốn xóa?")) {  
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsProducts/Product/deleteProductLine',    
            data: {"id":id},   
            success:function(data){
                if(data == '1')
                {                    
                    window.location.assign("<?php echo CController::createUrl('Product/Show')?>");  
                }                 
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });
    }      
}
$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();

    $('#profileSideNav').height(windowHeight-header);
    $('.customerListContainer').height(windowHeight-header);
    
});
$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();

    $('#profileSideNav').height(windowHeight-header);
    $('.customerListContainer').height(windowHeight-header);
  
});
$( document ).ready(function() {
    detailProductLine(0);
});

// Upload multiple images with preview
window.onload = function(){
//Check File API support
if(window.File && window.FileList && window.FileReader)
{
var filesInput = document.getElementById("Product_Image");
filesInput.addEventListener("change", function(event){
var files = event.target.files; //FileList object
var output = document.getElementById("result");
for(var i = 0; i< files.length; i++)
{
var file = files[i];
//Only pics
if(!file.type.match('image'))
continue;
var picReader = new FileReader();
picReader.addEventListener("load",function(event){
var picFile = event.target;
var div = document.createElement("div");
div.setAttribute("class", "col-md-3");
div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
"title='" + picFile.name + "'/>";
output.insertBefore(div,null);
});
//Read the image
picReader.readAsDataURL(file);
}
});
}
else
{
console.log("Your browser does not support File API");
}
}
// End Upload multiple images with preview
$(function(){
    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    $('.autoNum').autoNumeric('init',numberOptions);
});
</script>







