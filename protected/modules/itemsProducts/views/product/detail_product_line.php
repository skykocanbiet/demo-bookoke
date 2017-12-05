<?php 
$baseUrl = Yii::app()->baseUrl;
$pl = new ProductLine;
$v = new CDbCriteria(); 
$v->addCondition('t.status_proline = 1');
$v->order= 'id DESC';
$pl_all=$pl->findAll($v);

$b=new Branch;
$b_all=$b->findAll();
?>

      
            <table id="stock" class="table table-product table-boooke" role="grid" aria-describedby="stock_info" style="border-collapse:collapse;">
                <thead>
                    <tr role="row">
                    <th tabindex="0" aria-controls="stock" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Mã sản phẩm</th>
                    <th tabindex="0" aria-controls="stock" rowspan="1" colspan="1" aria-label="SKU: activate to sort column ascending">Tên sản phẩm</th>
                    <th tabindex="0" aria-controls="stock" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending">Số lượng</th>
                    <th tabindex="0" aria-controls="stock" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending">Giá bán</th>

                    </tr>
                </thead>
            <tbody id="bodyTblContent">
            <?php     
            if(!empty($pr))
            {          
                foreach ($pr as $k => $v) 
                {
            ?>
                <tr data-toggle="collapse" data-target="#demo<?php echo $k+1;?>" role="row" class="accordion-toggle background-color-f1f5f6">
                <td><?php echo $v['code'];?></td>
                <td><?php echo $v['name'];?></td>
                <td><?php echo $v['stock'];?></td>
                <td><?php echo number_format($v['price'],0,",",".");?></td>               
                </tr>
                <tr class="background-color-fff">
                <td colspan="4" class="hiddenRow" style="text-align: left;">
                    <div class="accordian-body collapse oView col-md-12 <?php if(count($pr)==1) echo "in";?>" id="demo<?php echo $k+1;?>">
                    <?php 
                    $p=new Product;
                    $dtp=$p->findByAttributes(array('id'=>$v['id'])); 

                    $pi = new ProductImage;
                    $dtpi=$pi->findAllByAttributes(array('id_product'=>$dtp['id'])); 
                    ?>
                    <div class="oViewDetail col-md-12">
                    <div id="oInfo" class="col-md-12">





                            <form class="ud-product-form" id="" runat="server" action="" onsubmit="return false;" method="post">
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
                                                <div class="form-group margin-bottom-05em required" id="">
                                                    <span class="" for="">Tên sản phẩm</span>
                                                    <input disabled class="form-control" id="" name="" type="text" value="<?php echo $dtp['name'];?>">
                                                </div>
                                                 <div class="form-group margin-bottom-05em" id="">
                                                    <span class="" for="">Mã sản phẩm</span>  
                                                    <input disabled class="form-control" id="" name="" type="text" value="<?php echo $dtp['code'];?>">
                                                    <input id="id_product" name="id_product" type="hidden" value="<?php echo $dtp['id'];?>">
                                                   
                                                    
                                                </div>
                                            </div>

                                           
                                        </div>
                                         
                                        <div class="form-group margin-bottom-05em" id="">
                                            <span class="" for="">Nhóm sản phẩm</span>
                                            <?php
                                                $product_line = array();
                                                foreach($pl_all as $temp){
                                                    $product_line[$temp['id']] = $temp['name'];
                                                }                            
                                                echo CHtml::dropDownList('id_product_line','',$product_line,array('disabled'=>'disabled','class'=>'form-control','empty' => 'Chọn nhóm sản phẩm','options'=>array($dtp['id_product_line']=>array('selected'=>true))));
                                            ?>     
                                        </div>

                                        <div class="form-group margin-bottom-05em ">
                                            <span class="" for="d3scription_product">Mô tả</span>
                                            <span class="char-count-container">    
                                                <?php                                                 
                                                $this->widget(
                                                    'booster.widgets.TbRedactorJs',
                                                    array(                                                        
                                                        'id'=> 'd3scription_product_'.$dtp['id'].'',
                                                        'name' => 'd3scription_product',
                                                        'value'=>$dtp['description'],
                                                    )
                                                );
                                                ?>
                                            </span>
                                        </div>

                                        <div class="rg-row">
                                            <div class="col-sm-4">
                                                <div class="form-group margin-bottom-05em" id="">
                                                    <span for="">Giá vốn</span> <a class="hide warning-icon-offset tip-init" href="javascript:void(0);" rel="popover" data-content="You have set your cost price higher than your retail price. Is this what you intended?" data-original-title="Cost price exceeds retail price">&nbsp;<i class="fa fa-exclamation-circle fa-fw fa-lg text-danger">&nbsp;</i></a>
                                                    <div class="input-group">
                                                     
                                                        <input disabled value="<?php echo number_format($dtp['cost_price'],0,",",".");?>" class="form-control price-input cost-price autoNum" onkeypress=" return isNumberKey(event)" id="" name="" type="text">
                                                        <span class="input-group-addon">VND</span>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group margin-bottom-05em" id="">
                                                    <span class="" for="">Giá bán</span>
                                                    <div class="input-group">
                                                        
                                                        <input disabled value="<?php echo number_format($dtp['price'],0,",",".");?>" class="form-control price-input retail-price autoNum" onkeypress=" return isNumberKey(event)" id="" name="" type="text">
                                                        <span class="input-group-addon">VND</span>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                             <div class="col-sm-4">
                                                <div class="form-group margin-bottom-05em">
                                                    <span>Thuế</span>
                                                     <div class="input-group">
                            
                                                        
                                                        <input disabled class="form-control tax-input" onkeypress=" return isNumberKey(event)" id="" name="" type="text" value="<?php echo $dtp['tax'];?>">                             
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
                                                    <td class="quantity-public-label" id=""><?php
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
                                        <?php 
                                        if(!empty($dtpi))
                                        {
                                        foreach($dtpi as $imgs) 
                                        {
                                        ?>    
                                        <div class="col-md-3">
                                            <img class="thumbnail" src="<?php echo $baseUrl;?>/upload/product_image/md/<?php echo $imgs['name_upload'];?>">
                                        </div>              
                                        <?php 
                                        }
                                        }
                                        else
                                        {
                                        ?>
                                        <div class="col-md-3">
                                            <img class="thumbnail" src="<?php echo $baseUrl;?>/upload/product_image/photo_normal.png">
                                        </div> 
                                        <?php     
                                        }    
                                        ?>
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
                                                            <input disabled class="form-control" onkeypress=" return isNumberKey(event)" id="point_donate_product" name="point_donate_product" type="text" value="<?php echo $dtp['point_donate'];?>" data-parsley-id="0924">
                                                        </span>
                                                    <span class="help-block validation-error" id="parsley-id-0924"></span></div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group margin-bottom-05em">
                                                        <span for="point_exchange_product" style="padding:0px;">Điểm cần có để quy đổi sản phẩm</span>
                                                        <span style="width: 45px;margin-left: 15px; display: inline-block;"> 
                                                            <input disabled class="form-control" onkeypress=" return isNumberKey(event)" id="point_exchange_product" name="point_exchange_product" type="text" value="<?php echo $dtp['point_exchange'];?>" data-parsley-id="0924">
                                                        </span>
                                                    <span class="help-block validation-error" id="parsley-id-2107"></span></div>
                                                </div>
                                               

                                            </div>
                                        </div>

                                </div>

                                
                            
                            </form>





                    </div>

                    <div class="col-md-12">
                            <div id="pBtn">
                                <div id="pBtnL">
                                           
                                <button type="" id="" onclick="showEditProduct(<?php echo $dtp['id'];?>);" class="btn btn_bookoke">Chỉnh sửa</button>
                                <span class="pull-right"><button type="button" class="btn btn_delete" onclick="deleteProduct(<?php echo $dtp['id'];?>);">Xóa</button></span>
                                </div>
                            </div>
                        </div>

                    </div>
                        <?php include("popup_edit_product.php");?>
                    </div>     
                </td>                
                </tr>
            <?php 
                }
            }
            else
            {
            ?> 
            <tr role="row" class="odd">
            <td colspan="4" align="center">Không có dữ liệu!</td>
            </tr>             
            <?php 
            }
            ?>                    
            </tbody>
            </table>
            <br>
            <div style="clear:both"></div>
            <div align="center">
                <?php echo $lst;?>          
            </div>



<script>
function error_update_product(id){

    var status = true;

    if($('#name_product_'+id).val() == ''){
        status = false;       
        $('#ud-product-name-'+id).addClass('error');      
    }
    else{
        $('#ud-product-name-'+id).removeClass('error');
    }

    if($('#code_product_'+id).val() == ''){
        status = false;       
        $('#ud-product-code-'+id).addClass('error');     
    }
    else{
        $('#ud-product-code-'+id).removeClass('error');
    }    

    if($('#id_product_line_'+id).val() == ''){
        status = false;       
        $('#ud-product-line-'+id).addClass('error');     
    }
    else{
        $('#ud-product-line-'+id).removeClass('error');
    }

    if($('#costprice_product_'+id).val() == ''){
        status = false;       
        $('#ud-product-costprice-'+id).addClass('error');         
    }
    else{
        $('#ud-product-costprice-'+id).removeClass('error');
    }

    if($('#price_product_'+id).val() == ''){
        status = false;       
        $('#ud-product-price-'+id).addClass('error');         
    }
    else{
        $('#ud-product-price-'+id).removeClass('error');
    }  

    return status;
}

function showEditProduct(id){

    var elem = $('#edit-product-blur-'+id)[0];

    $(elem).fadeToggle(200,function(){
    });

    $(document).mouseup(function (e)
    {   

        var container = $(".edit-product-container");
        if(templock == 0){
            if (!container.is(e.target) && container.has(e.target).length === 0){        
               if($(elem).is(':visible')){
                    templock = 1;
                    $(elem).fadeToggle(200,function(){
                        templock = 0;
                    });
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

function updateProduct(id){  
    if(error_update_product(id)){
        $('.cal-loading').fadeIn('fast');     
        var formData = new FormData($('#ud-product-form-'+id)[0]);       
        if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({
            type:'POST',
            url: baseUrl+'/itemsProducts/Product/updateProduct',
            data:formData,
            datatype:'json',
            success:function(data){                
                if (data == '-1') {                         
                    $('#ud-product-code-'+id).addClass('error');              
                    $('.cal-loading').fadeOut('slow');
                    return false;
                }
                else
                {
                    $('#ud-product-code-'+id).removeClass('error');

                    $("#searchProduct").val(data);   
                    var elem = $('#edit-product-blur-'+id)[0];
                    if(templock == 0){                   
                        if($(elem).is(':visible')){
                            templock = 1;   
                            $(elem).fadeToggle(200,function(){
                                templock = 0;
                            }); 
                        }                    
                    }
                    $('#glyphicon-search').click();

                    $('.cal-loading').fadeOut('slow');                 
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

function deleteProduct(id){
    if (confirm("Bạn có thật sự muốn xóa?")) {     
        $('.cal-loading').fadeIn('fast');
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsProducts/Product/deleteProduct',    
            data: {"id":id},   
            success:function(data){
                if(data == '1')
                {
                    $('.cal-loading').fadeOut('slow'); 
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

$('.accordion-toggle').click(function(){
    
    $( ".accordion-toggle" ).each(function( index ) {  
        $(this).removeClass("at");  
    });

    var st =  $(this).attr("aria-expanded");   

    if(st == 'false' || st == undefined){        
        $(this).addClass("at");
    }else if(st == 'true'){

        $(this).removeClass("at");
    } 
});

$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var title     = $(".t-settings-head").height();

    $('#bodyTblContent').height(windowHeight-header-title-130);
    
});
$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var title     = $(".t-settings-head").height();

    $('#bodyTblContent').height(windowHeight-header-title-130);
});

$('.collapse').on('show.bs.collapse', function () {    
    $('.collapse.in').collapse('hide');
});


// PRODUCT INVENTORY
function ud_openIncreasePopup(id_branch,id_product){  
    $('#ud-btn-increase-'+id_product).attr('onclick','udAddIncrease('+id_branch+','+id_product+')'); 
    $('#ud-ipt-increase-'+id_product).val('');  
    $('#ud-StockTransactionTypesIncrease-'+id_product).val('3');
    $('#ud-increasePopup-'+id_product).fadeToggle('fast');
}
function ud_openDecreasePopup(id_branch,id_product){
    $('#ud-btn-decrease-'+id_product).attr('onclick','udRemoveDecrease('+id_branch+','+id_product+')'); 
    $('#ud-ipt-decrease-'+id_product).val('');  
    $('#ud-StockTransactionTypesDecrease-'+id_product).val('7'); 
    $('#ud-decreasePopup-'+id_product).fadeToggle('fast');
}
$('.bln-close').click(function(){ 
    $(".popover.top.in").hide(); 
    $(".popover.top.in").hide();
});
$(document).mouseup(function (e)
{
    var container = $(".popover.top.in");
    if (!container.is(e.target) 
        && container.has(e.target).length === 0) 
    {        
        container.hide();
    } 
});
function udBtnDisabled(id_product){
    if($('#ud-ipt-increase-'+id_product).val()>0)
    {
        $('#ud-btn-increase-'+id_product).removeAttr('disabled');
    }  
    else
    {
        $('#ud-btn-increase-'+id_product).attr('disabled','disabled');
    }  

    if($('#ud-ipt-decrease-'+id_product).val()>0)
    {
        $('#ud-btn-decrease-'+id_product).removeAttr('disabled');
    }  
    else
    {
        $('#ud-btn-decrease-'+id_product).attr('disabled','disabled');
    } 
}
function udAddIncrease(id_branch,id_product){
   
    if($('#ud-quantity-public-label-'+id_branch+id_product).html()=="Không giới hạn")
    {
        var number=0;        
    }
    else{
        var number=parseInt($('#ud-quantity-public-label-'+id_branch+id_product).html());
    }

    var amount    = parseInt($('#ud-ipt-increase-'+id_product).val());
    var status    = $('#ud-StockTransactionTypesIncrease-'+id_product).val();

    var inventory = $('#ud_hidden_inventory_increase_'+id_product).val();    
    if(inventory){
        var inventory = JSON.parse(inventory);
    }else{
        inventory = [];
    }
    var response = {};
    response['id_branch'] = id_branch; 
    response['available'] = amount;
    response['status'] = status;
    inventory.push(response); 
    $('#ud_hidden_inventory_increase_'+id_product).val(JSON.stringify(inventory)); 
    
    $('#ud-quantity-public-label-'+id_branch+id_product).html(number+amount);  
    $('#ud-increasePopup-'+id_product).hide();  
    $('#ud-btn-increase-'+id_product).attr('disabled','disabled'); 
   
}
function udRemoveDecrease(id_branch,id_product){

    if($('#ud-quantity-public-label-'+id_branch+id_product).html()=="Không giới hạn")
    {
        var number=0;
    }
    else{
        var number=parseInt($('#ud-quantity-public-label-'+id_branch+id_product).html());
    }

    var amount    = parseInt($('#ud-ipt-decrease-'+id_product).val());
    var status    = $('#ud-StockTransactionTypesDecrease-'+id_product).val();

    var inventory = $('#ud_hidden_inventory_decrease_'+id_product).val();    
    if(inventory){
        var inventory = JSON.parse(inventory);
    }else{
        inventory = [];
    }
    var response = {};
    response['id_branch'] = id_branch; 
    response['available'] = amount;
    response['status'] = status;
    inventory.push(response); 
    $('#ud_hidden_inventory_decrease_'+id_product).val(JSON.stringify(inventory)); 

    $('#ud-quantity-public-label-'+id_branch+id_product).html(number-amount);    
    $('#ud-decreasePopup-'+id_product).hide(); 
    $('#ud-btn-decrease-'+id_product).attr('disabled','disabled');
   
}
// END PRODUCT INVENTORY
// Upload multiple images with preview
function multipleImages(id){ 
$('.imgs-hidden').addClass("hidden");  
//Check File API support
if(window.File && window.FileList && window.FileReader)
{
var filesInput = document.getElementById("image_product"+id);

var files = event.target.files; //FileList object
var output = document.getElementById("results"+id);
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

}
else
{
console.log("Your browser does not support File API");
}
}
// End Upload multiple images with preview
</script>