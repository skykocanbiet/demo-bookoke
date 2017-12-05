<div class="blur" id="edit-product-blur-<?php echo $dtp['id'];?>">

<div class="rg-constrained edit-product-container" id="edit-product-container-<?php echo $dtp['id'];?>" style="padding:20px;position: fixed;top: 2%;right: 0;left: 0;width: 750px;height: auto;margin: 0 auto;background: #ffffff;border-radius: 3px;z-index: 999;">

        <div class="col-md-12">


                
 
 <div class="modal-header popHead sHeader">
   <a class="btn_close close_p" data-dismiss="modal" aria-label="Close"></a>
    <h5>Chỉnh Sửa Sản Phẩm</h5>
</div> 
<form class="ud-product-form" id="ud-product-form-<?php echo $dtp['id'];?>" runat="server" action="" onsubmit="return false;" method="post">
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
                                                <div class="form-group margin-bottom-05em required" id="ud-product-name-<?php echo $dtp['id'];?>">
                                                    <span class="" for="name_product">Tên sản phẩm</span>
                                                    <input class="form-control" id="name_product_<?php echo $dtp['id'];?>" name="name_product" type="text" value="<?php echo $dtp['name'];?>">
                                                </div>
                                                 <div class="form-group margin-bottom-05em" id="ud-product-code-<?php echo $dtp['id'];?>">
                                                    <span class="" for="code_product">Mã sản phẩm</span>  
                                                    <input class="form-control" id="code_product_<?php echo $dtp['id'];?>" name="code_product" type="text" value="<?php echo $dtp['code'];?>">
                                                    <input id="id_product" name="id_product" type="hidden" value="<?php echo $dtp['id'];?>">
                                                    <input type="hidden" value="" id="ud_hidden_inventory_increase_<?php echo $dtp['id'];?>" name="ud_hidden_inventory_increase">
                                                    <input type="hidden" value="" id="ud_hidden_inventory_decrease_<?php echo $dtp['id'];?>" name="ud_hidden_inventory_decrease">
                                                    
                                                </div>
                                            </div>

                                         
                                        </div>
                                         
                                        <div class="form-group margin-bottom-05em" id="ud-product-line-<?php echo $dtp['id'];?>">
                                            <span class="" for="ProductLineId">Nhóm sản phẩm</span>
                                            <?php
                                                $product_line = array();
                                                foreach($pl_all as $temp){
                                                    $product_line[$temp['id']] = $temp['name'];
                                                }                            
                                                echo CHtml::dropDownList("id_product_line_".$dtp['id']."",'',$product_line,array('class'=>'form-control','empty' => 'Chọn nhóm sản phẩm','options'=>array($dtp['id_product_line']=>array('selected'=>true))));
                                            ?>     
                                        </div>

                                        <div class="form-group margin-bottom-05em ">
                                            <span class="" for="description_product">Mô tả</span>
                                            <span class="char-count-container">                                                
                                                <?php                                                 
                                                $this->widget(
                                                    'booster.widgets.TbRedactorJs',
                                                    array(
                                                        'id'=> 'description_product_'.$dtp['id'].'',
                                                        'name' => 'description_product',
                                                        'value'=>$dtp['description'],
                                                    )
                                                );
                                                ?>
                                            </span>
                                        </div>

                                        <div class="rg-row">
                                            <div class="col-sm-4">
                                                <div class="form-group margin-bottom-05em" id="ud-product-costprice-<?php echo $dtp['id'];?>">
                                                    <span for="costprice_product">Giá vốn</span> <a class="hide warning-icon-offset tip-init" href="javascript:void(0);" rel="popover" data-content="You have set your cost price higher than your retail price. Is this what you intended?" data-original-title="Cost price exceeds retail price">&nbsp;<i class="fa fa-exclamation-circle fa-fw fa-lg text-danger">&nbsp;</i></a>
                                                    <div class="input-group">
                                                        
                                                        <input value="<?php echo number_format($dtp['cost_price'],0,",",".");?>" class="form-control price-input cost-price" onkeypress=" return isNumberKey(event)" id="costprice_product_<?php echo $dtp['id'];?>" name="costprice_product" type="text">
                                                        <span class="input-group-addon">VND</span>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group margin-bottom-05em" id="ud-product-price-<?php echo $dtp['id'];?>">
                                                    <span class="" for="price_product">Giá bán</span>
                                                    <div class="input-group">
                                                        
                                                        <input value="<?php echo number_format($dtp['price'],0,",",".");?>" class="form-control price-input retail-price" onkeypress=" return isNumberKey(event)" id="price_product_<?php echo $dtp['id'];?>" name="price_product" type="text">
                                                        <span class="input-group-addon">VND</span>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                             <div class="col-sm-4">
                                                <div class="form-group margin-bottom-05em">
                                                    <span class="" for="tax_product">Thuế</span>
                                                    <div class="input-group">
                            
                                                        
                                                        <input class="form-control tax-input" onkeypress=" return isNumberKey(event)" id="tax_product" name="tax_product" type="text" value="<?php echo $dtp['tax'];?>">                             
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
                                                    <td><?php echo $v['name'];?></td>                                                    
                                                    <td class="quantity-public-label" id="ud-quantity-public-label-<?php echo $v['id'];?><?php echo $dtp['id'];?>"><?php
                                                    $pii=new ProductInventoryIncrease;
                                                    $pid=new ProductInventoryDecrease;
                                                    $dtpii=$pii->findAllByAttributes(array('id_product'=>$dtp['id'],'id_branch'=>$v['id']));
                                                    $dtpid=$pid->findAllByAttributes(array('id_product'=>$dtp['id'],'id_branch'=>$v['id']));  
                                                    $sum=0;
                                                    $minus=0;
                                                    $result=0;
                                                    if($dtpii){                                                        
                                                        foreach ($dtpii as $va) 
                                                        {
                                                           $sum+=$va['available'];
                                                        }
                                                    }
                                                    if($dtpid)
                                                    {                                                        
                                                        foreach ($dtpid as $va) 
                                                        {
                                                           $minus+=$va['available'];
                                                        }
                                                    }
                                                    $result=$sum-$minus;
                                                    if($dtpii || $dtpid){echo $result;}elseif(!$dtpii || !$dtpid){echo "Không giới hạn";}?></td>
                                                    <td>
                                                        <div class="btn-group btn-adjust-stock">
                                                            <a href="javascript:void(0);" class="btn-sm quantity-increase" onclick="ud_openIncreasePopup(<?php echo $v['id'];?>,<?php echo $dtp['id'];?>);" data-location-id="68002"><i class="fa fa-plus"></i></a>
                                                            <a href="javascript:void(0);" class="btn-sm quantity-decrease" onclick="ud_openDecreasePopup(<?php echo $v['id'];?>,<?php echo $dtp['id'];?>);" data-location-id="68002"><i class="fa fa-minus"></i></a>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                   <!--  <td>
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

                                            <output id="results<?php echo $dtp['id'];?>" />
                                            <?php 
                                            if(!empty($dtpi))
                                            {
                                            foreach($dtpi as $imgs) 
                                            {
                                            ?>    
                                            <div class="col-md-3">
                                                <img class="thumbnail imgs-hidden" src="<?php echo $baseUrl;?>/upload/product_image/md/<?php echo $imgs['name_upload'];?>">
                                            </div>              
                                            <?php 
                                            }
                                            }                                           
                                            ?>  
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
                                            <input onchange="multipleImages(<?php echo $dtp['id'];?>);" multiple="multiple" id="image_product<?php echo $dtp['id'];?>" type="file" name="image_product[]" style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 20px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0;"></span>
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

                                                        <span for="point_donate_product" style="padding:0px;">Điểm được tặng khi mua sản phẩm</span>
                                                        <span  style="width: 45px;margin-left: 15px;display: inline-block;">
                                                            <input class="form-control" onkeypress=" return isNumberKey(event)" id="point_donate_product" name="point_donate_product" type="text" value="<?php echo $dtp['point_donate'];?>" data-parsley-id="0924">
                                                        </span>
                                                    <span class="help-block validation-error" id="parsley-id-0924"></span></div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group margin-bottom-05em">
                                                        <span for="point_exchange_product" style="padding:0px;">Điểm cần có để quy đổi sản phẩm</span>
                                                        <span style="width: 45px;margin-left: 15px; display: inline-block;"> 
                                                            <input class="form-control" onkeypress=" return isNumberKey(event)" id="point_exchange_product" name="point_exchange_product" type="text" value="<?php echo $dtp['point_exchange'];?>" data-parsley-id="0924">
                                                        </span>
                                                    <span class="help-block validation-error" id="parsley-id-2107"></span></div>
                                                </div>
                                               

                                            </div>
                                        </div>

                                </div>

                                 <div class="rg-row" style="margin-top:10px;">                                           
                                    <div class="col-md-12">
                                        <div id="pBtn">
                                            <div id="pBtnL">
                                            <span class="pull-right">
                                            <a href="javascript:void(0);" class="btn btn_cancel close_p">Hủy</a>
                                            <button type="" id="" onclick="updateProduct(<?php echo $dtp['id'];?>);" class="btn btn_bookoke">Cập nhật</button>
                                            </span> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="popover top in" id="ud-increasePopup-<?php echo $dtp['id'];?>" style="top: 295px; left: 205px; display: none; z-index: 5001;border: 0px;background-color: transparent;box-shadow: 0 0px 0px rgba(0, 0, 0, 0);"><div class="arrow"></div><div class="popover-inner stock-quantity-balloon" style="padding:0px;background: #fff;"><h3 class="popover-title">Tăng số lượng tồn kho<a class="close bln-close"><i class="fa fa-remove"></i></a></h3><div class="popover-content"><div><form class="form-vertical"><table class="table-condensed table-not-bordered table-no-decoration stock-quantity-table"><thead><tr><th class="left">Thêm</th><th>Lý do</th></tr></thead><tbody><tr><td style="width: 45%"><input class="input-small form-control quantity-adjustment" type="number" onchange="udBtnDisabled(<?php echo $dtp['id'];?>);" id="ud-ipt-increase-<?php echo $dtp['id'];?>" value="" min="1" placeholder="Số lượng"></td><td style="width: 55%"><select class="form-control quantity-transaction-type" id="ud-StockTransactionTypesIncrease-<?php echo $dtp['id'];?>" name="StockTransactionTypesIncrease"><option value="3">Tồn kho mới</option><option value="1">Trả về</option><option value="2">Chuyển đổi</option><option value="4">Điều chỉnh</option><option value="5">Khác</option></select></td></tr><tr><td colspan="2" class="hide"><textarea class="quantity-comment form-control" style="width: 230px;" maxlength="250"></textarea></td></tr></tbody></table><div class="text-right" style="margin-top: 10px">&nbsp;&nbsp;<a href="javascript:void(0);" class="btn  bln-close"><i class="fa fa-remove"></i> Hủy</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="btn btn-primary " id="ud-btn-increase-<?php echo $dtp['id'];?>" disabled="true" data-location-id="68002"><i class="fa fa-ok"></i> Add</a></div></form></div></div></div></div>
                                <div class="popover top in" id="ud-decreasePopup-<?php echo $dtp['id'];?>" style="top: 295px; left: 235px; display: none; z-index: 5001;border: 0px;background-color: transparent;box-shadow: 0 0px 0px rgba(0, 0, 0, 0);"><div class="arrow"></div><div class="popover-inner stock-quantity-balloon" style="padding:0px;background: #fff;"><h3 class="popover-title">Giảm số lượng tồn kho<a class="close bln-close"><i class="fa fa-remove"></i></a></h3><div class="popover-content"><div><form class="form-vertical"><table class="table-condensed table-not-bordered table-no-decoration stock-quantity-table"><thead><tr><th class="left">Bỏ</th><th>Lý do</th></tr></thead><tbody><tr><td style="width: 45%"><input class="input-small form-control quantity-adjustment" type="number" onchange="udBtnDisabled(<?php echo $dtp['id'];?>);" id="ud-ipt-decrease-<?php echo $dtp['id'];?>" value="" min="1" placeholder="Số lượng"></td><td style="width: 55%"><select class="form-control quantity-transaction-type" id="ud-StockTransactionTypesDecrease-<?php echo $dtp['id'];?>" name="StockTransactionTypesDecrease"><option value="7">Hư hỏng</option><option value="8">Hết hạn</option><option value="9">Đã bán</option><option value="10">Loại bỏ</option><option value="4">Điều chỉnh</option><option value="5">Khác</option></select></td></tr><tr><td colspan="2" class="hide"><textarea class="quantity-comment form-control" style="width: 230px;" maxlength="250"></textarea></td></tr></tbody></table><div class="text-right" style="margin-top: 10px">&nbsp;&nbsp;<a href="javascript:void(0);" class="btn  bln-close"><i class="fa fa-remove"></i> Hủy</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="btn btn-primary " id="ud-btn-decrease-<?php echo $dtp['id'];?>" disabled="true" data-location-id="68002"><i class="fa fa-ok"></i> Remove</a></div></form></div></div></div></div>
                            
                            </form>

    
        </div>
        <div class="col-md-10">
            <div>

            </div>
        </div>


</div>



</div>
