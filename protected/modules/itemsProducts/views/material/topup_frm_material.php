<div class="blur" id="add-product-blur">

<div class="rg-constrained" id="product-container">

    <div class="col-md-12">
       
        <div class="modal-header popHead sHeader" style="">
           <a class="btn_close close_m" data-dismiss="modal" aria-label="Close"></a>
            <h5>Tạo Vật Liệu Mới</h5>
        </div> 

        <form class="product-form" id="product-form"  runat="server" action="" onsubmit="return false;" method="post">

            <input id="XeroAuthError" name="XeroAuthError" type="hidden" value="False" />
            <input name="__RequestVerificationToken" type="hidden" value="coTO7fNiICrHN1GReqJ-KMIP5nWTduPaPUkDBDvAW593aEKWnN9EdG42_UHeTMWSlsvj8AASfAHbdZ5ExIOEvXDeVkPnwH1jEGSpwiYplrEqA3BBFytebHeoZXOpHJgQdCcZp5Cw-ySRxH8Dm0xBDVaH1ngsMGH8KMLgvEIOXL5fckcI0" />    

            <div class="rg-row">

                <div class="col-md-12" style="margin-top:10px;">
                    <h5>Chi tiết vật liệu</h5>
                </div>

                <div class="col-md-12">

                    <div class="rg-row">
                    
                        <div class="col-sm-6">
                            <div class="form-group margin-bottom-05em required" id="rq-product-name">
                                <span class="" for="Product_Name">Tên vật liệu</span>
                                <input class="form-control" id="Product_Name" name="Product_Name" type="text" value="">
                            </div>
                             <div class="form-group margin-bottom-05em required" id="rq-product-code">
                                <span class="" for="Product_Code">Mã vật liệu</span>
                                <input class="form-control" id="Product_Code" name="Product_Code" type="text" value="">
                                <input type="hidden" value="" id="hidden_inventory_increase" name="hidden_inventory_increase">
                                <input type="hidden" value="" id="hidden_inventory_decrease" name="hidden_inventory_decrease">
                            </div>
                        </div>

                        <div class="col-sm-6 " style="padding-top:15px;">
                           <div class="rg-row">
                                <div class="col-md-4">
                                    <div class="timely-image timely-image-centered">
                                        <img style="width:90%;" class="img-responsive" src="<?php echo $baseUrl; ?>/upload/product_image/photo_normal.png" alt="" id="blah">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <p style="font-size:11.5px;">Định dạng được chấp nhận: PNG, GIF hoặc JPEG. Kích thước tối đa là 2.0MB.</p>
                                    <span id="upload" style="position: relative; overflow: hidden; direction: ltr;"> <!-- Required for IE -->
                                    <span id="upload"> <!-- Required for IE -->
                                    <a class="btn btn_bookoke" type="button" name="upload" id="upload" value="Upload"><i class="fa fa-arrow-circle-o-up"></i>&nbsp;Tải ảnh mới</a> 
                                    </span>
                                    <input multiple="multiple" type="file" id="Product_Image" name="Product_Image" style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 20px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0;">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                     
                    <div class="form-group margin-bottom-05em" id="rq-product-line">
                        <span class="" for="ProductLineId">Nhóm vật liệu</span>
                        <?php
                            $product_line = array();
                            foreach($listLineMaterial as $temp){
                                $product_line[$temp['id']] = $temp['name'];
                            }
                            echo CHtml::dropDownList('ProductLineId','',$product_line,array('class'=>'form-control','empty' => 'Chọn nhóm vật liệu','options'=>array()));
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
                                    <span class="input-group-addon">VND</span>
                                    <input value="" class="form-control price-input cost-price" onkeypress=" return isNumberKey(event)" id="Product_CostPrice" name="Product_CostPrice" type="text">
                                </div>

                                
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group margin-bottom-05em" id="rq-product-price">
                                <span class="" for="Product_Price">Giá bán</span>
                                <div class="input-group">
                                    <span class="input-group-addon">VND</span>
                                    <input value="" class="form-control price-input retail-price" onkeypress=" return isNumberKey(event)" id="Product_Price" name="Product_Price" type="text">
                                </div>
                                
                            </div>
                        </div>
                         <div class="col-sm-4">
                            <div class="form-group margin-bottom-05em">
                                <span class="" for="Product_Tax">Thuế</span>
                                <select class="tax-input form-control" id="Product_Tax" name="Product_Tax"><option selected="selected" value="0">Không áp dụng</option>
                                </select>
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
                               <th><a class="tip-init" data-original-title="The amount of stock available for sale">Available</a></th>
                               <th></th>
                               <th></th>
                               <th><a class="invisible tip-init" data-original-title="When stock reaches this level we will alert you via an app notification and email">Alert</a></th>
                           </tr>
                       </thead>
                       <tbody>
                          
                        <?php 

                        foreach($model->getListBranchs() as $v) 
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
                            <td class="quantity-public-label" id="quantity-public-label-<?php echo $v['id'];?>">Unlimited</td>
                            <td>
                                <div class="btn-group btn-adjust-stock">
                                    <a href="javascript:void(0);" class="btn btn-sm quantity-increase" onclick="openIncreasePopup(<?php echo $v['id'];?>);" data-location-id="68002"><i class="fa fa-plus"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-sm quantity-decrease" onclick="openDecreasePopup(<?php echo $v['id'];?>);" data-location-id="68002"><i class="fa fa-minus"></i></a>
                                </div>
                            </td>
                          <!--   <td>
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
                    <h5>Điểm thưởng</h5>    


                    <div class="rg-row">
                        <div class="col-sm-6">
                            <div class="form-group  margin-bottom-05em">

                                <span for="Product_Point_Donate" style="padding:0px;">Điểm được tặng khi mua vật liệu</span>
                                <span  style="width: 45px;margin-left: 15px;display: inline-block;">
                                    <input class="form-control" onkeypress=" return isNumberKey(event)" id="Product_Point_Donate" name="Product_Point_Donate" type="text" value="" data-parsley-id="0924">
                                </span>
                            <span class="help-block validation-error" id="parsley-id-0924"></span></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group margin-bottom-05em">
                                <span for="Product_Point_Exchange" style="padding:0px;">Điểm cần có để quy đổi vật liệu</span>
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
                        <a href="javascript:void(0);" class="btn btn_cancel close_m">Hủy</a>
                        <button id="btn-add-product" type="submit" class="btn btn_bookoke">Xác nhận</button>
                    </div>
                </div>
            </div>

        </form>


    </div>


</div>

<div class="popover top in" id="increasePopup" style="top: 350px; left: 760px; display: none; z-index: 5001;border: 0px;background-color: transparent;box-shadow: 0 0px 0px rgba(0, 0, 0, 0);"><div class="arrow"></div><div class="popover-inner stock-quantity-balloon"><h3 class="popover-title">Increase stock<a class="close bln-close"><i class="fa fa-remove"></i></a></h3><div class="popover-content"><div><form class="form-vertical"><table class="table-condensed table-not-bordered table-no-decoration stock-quantity-table"><thead><tr><th class="left">Add</th><th>Reason</th></tr></thead><tbody><tr><td style="width: 45%"><input class="input-small form-control quantity-adjustment" type="number" onchange="BtnDisabled();" id="ipt-increase" value="" min="1" placeholder="Amount"></td><td style="width: 55%"><select class="form-control quantity-transaction-type" id="StockTransactionTypesIncrease" name="StockTransactionTypesIncrease"><option value="3">New stock</option><option value="1">Return</option><option value="2">Transfer</option><option value="4">Adjustment</option><option value="5">Other</option></select></td></tr><tr><td colspan="2" class="hide"><textarea class="quantity-comment form-control" style="width: 230px;" maxlength="250"></textarea></td></tr></tbody></table><div class="text-right" style="margin-top: 10px">&nbsp;&nbsp;<a href="javascript:void(0);" class="btn  bln-close"><i class="fa fa-remove"></i> Cancel</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="btn btn-primary " id="btn-increase" disabled="true" data-location-id="68002"><i class="fa fa-ok"></i> Add</a></div></form></div></div></div></div>
<div class="popover top in" id="decreasePopup" style="top: 350px; left: 790px; display: none; z-index: 5001;border: 0px;background-color: transparent;box-shadow: 0 0px 0px rgba(0, 0, 0, 0);"><div class="arrow"></div><div class="popover-inner stock-quantity-balloon"><h3 class="popover-title">Decrease stock<a class="close bln-close"><i class="fa fa-remove"></i></a></h3><div class="popover-content"><div><form class="form-vertical"><table class="table-condensed table-not-bordered table-no-decoration stock-quantity-table"><thead><tr><th class="left">Remove</th><th>Reason</th></tr></thead><tbody><tr><td style="width: 45%"><input class="input-small form-control quantity-adjustment" type="number" onchange="BtnDisabled();" id="ipt-decrease" value="" min="1" placeholder="Amount"></td><td style="width: 55%"><select class="form-control quantity-transaction-type" id="StockTransactionTypesDecrease" name="StockTransactionTypesDecrease"><option value="7">Damaged</option><option value="8">Out of date</option><option value="9">Sold</option><option value="10">Removed</option><option value="4">Adjustment</option><option value="5">Other</option></select></td></tr><tr><td colspan="2" class="hide"><textarea class="quantity-comment form-control" style="width: 230px;" maxlength="250"></textarea></td></tr></tbody></table><div class="text-right" style="margin-top: 10px">&nbsp;&nbsp;<a href="javascript:void(0);" class="btn  bln-close"><i class="fa fa-remove"></i> Cancel</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="btn btn-primary " id="btn-decrease" disabled="true" data-location-id="68002"><i class="fa fa-ok"></i> Remove</a></div></form></div></div></div></div>
</div>