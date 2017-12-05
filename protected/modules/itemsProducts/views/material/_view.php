<?php 
$baseUrl = Yii::app()->baseUrl;
$listLineMaterial = $model->getListMaterialLine();

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
.count{
    font-weight: normal;
    font-size: 14px;
}
/*END TABLE TOGGLE*/
</style>




    <!-- Contact Customers -->
    <div id="customers" class="tab-pane full-height active">
        <div class="row-fluid full-height">

            <div id="customerContent" class="content">

           
                    <div class="row">                        

                        <div class="customerListContainer col-sm-3 col-md-3">
                            <div style="margin:0px 2em;">
                                    <div class="customersActionHolder">
                                            <h3 style="width: 170px;">Nhóm Vật liệu</h3>
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
                                                <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Thêm nhóm vật liệu</h3>
                                                <div class="popover-content" style="width:225px;">
                                                    <input type="text" required="" oninvalid="this.setCustomValidity('Vui lòng tên nhóm vật liệu.')" oninput="setCustomValidity('')" class="form-control" id="materialNewName" name="materialNewName" placeholder="Tên nhóm vật liệu" style="margin-bottom:10px;">                                                           
                                                    <button id="addnewCustomer" class="btn btn_bookoke btn_material_w">Tạo mới</button>
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
                                                        
                                                     
                                                        <label class="fl"> Tất cả (<?php echo count($listLineMaterial);?>) </label>
                                                        <div class="clearfix"></div>
                                                     </li>
                                                    <?php 
                                                    
                                                    foreach ($listLineMaterial as $k => $v) 
                                                    {
                                                    ?> 
                                                     <li id="c<?php echo $v->id;?>" onclick="detailProductLine(<?php echo $v->id;?>);" class="n">
                                        
                                                        <span class="jqTransformCheckboxWrapper" style="display:none;">
                                                            <a href="#" class="jqTransformCheckbox"></a>
                                                            <input type="checkbox" value="<?php echo $v->id;?>" class="fl" style="display : none;">
                                                        </span>
                                                        
                                                       
                                                        <label class="fl"> <?php echo titleCase($v['name']);?> </label>
                                                        <img id="ltn<?php echo $v->id;?>" class="hide" onclick="showUpdateMaterialLine(<?php echo $v->id;?>);" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/edit_cam.png" style="float:right;margin: 9px 6px 0 0;width: 20px;height: 20px;">
                                                        <div class="clearfix"></div>
                                                     </li> 
                                                     <div id="updateMaterialLinePopup<?php echo $v->id;?>" class="popover bottom material-line" style="display: none;padding:0px;top:150px;left:500px;">
                                                        <form id="frm-update-material-line-<?php echo $v->id;?>" onsubmit="return false;" class="form-horizontal">                                                                                                 
                                                            <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Chỉnh sửa nhóm vật liệu</h3>
                                                            <div class="popover-content" style="width:225px;">
                                                                <input type="text" required="" oninvalid="this.setCustomValidity('Vui lòng nhập tên nhóm sản phẩm.')" oninput="setCustomValidity('')" class="form-control" id="materiallineNewName<?php echo $v->id;?>" name="materiallineNewName" value="<?php echo $v['name'];?>" placeholder="Tên nhóm vật liệu" style="margin-top:0px;padding: 6px 12px;margin-bottom:10px;width:98%;">
                                                                <button onclick="deleteMaterialLine(<?php echo $v->id;?>);" class="btn btn_delete" style="min-width: 94px;margin-right: 0px;">Xóa</button>
                                                                <button onclick="updateMaterialLine(<?php echo $v->id;?>);" class="btn btn_bookoke">Cập nhật</button>
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
                                              <input type="text" class="form-control" id="searchProduct" placeholder="Tìm kiếm theo mã và tên vật liệu">
                                              <div class="input-group-addon" onclick="searchProduct();"  id="glyphicon-search" style="padding-right:25px;cursor:pointer;"><span class="glyphicon glyphicon-search"></span></div>
                                           </div>     
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


<?php include("topup_frm_material.php") ?>


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

$('.close_m').on('click',function(e){
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
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsProducts/Material/ViewListMaterial', 
        data: {"id":id,"curpage":curpage},   
        success:function(data){     
            $('#searchProduct').val('');        
            $('#detailProductLine').html(data);
            //countservice(id);
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
        url: baseUrl+'/itemsProducts/Material/countservice', 
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
        url: baseUrl+'/itemsProducts/Material/ViewListMaterial', 
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
        url: baseUrl+'/itemsProducts/Material/ViewListMaterial', 
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
                url: baseUrl+'/itemsProducts/Material/addMaterial',
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
                        window.location.assign("<?php echo CController::createUrl('Material/View')?>"); 
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



function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#Product_Image").change(function(){
    readURL(this);
});
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
    if($('#quantity-public-label-'+id).html()=="Unlimited")
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
    if($('#quantity-public-label-'+id).html()=="Unlimited")
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
function showUpdateMaterialLine(id){    
    var evt = window.event || arguments.callee.caller.arguments[0];
    evt.preventDefault();
    var position = $('#ltn'+id).position();    
    $('#updateMaterialLinePopup'+id).css({"top": position.top-50, "left": position.left+50});
    $('#updateMaterialLinePopup'+id).fadeToggle('fast');
    evt.stopPropagation();
}

$(document).mouseup(function (e)
{
    var container = $(".popover.bottom.material-line");
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
            url: baseUrl+'/itemsProducts/Material/addMaterialLine',          
            data:formData,
            datatype:'json',
            success:function(data){
                if(data == '1'){ 
                $('#addnewCustomerPopup').hide();               
                e.stopPropagation();
                window.location.assign("<?php echo CController::createUrl('Material/View')?>");  
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
function updateMaterialLine(id){ 
   
    if($('#materiallineNewName'+id).val()!=""){
        var formData = new FormData($('#frm-update-material-line-'+id)[0]);  
        formData.append('id_material_line',id);     
        if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({
                type:'POST',
                url: baseUrl+'/itemsProducts/Material/updateMaterialLine',
                data:formData,
                datatype:'json',
                success:function(data){             
                    if(data == '1'){ 
                    $('#updateMaterialLinePopup'+id).hide();  
                    window.location.assign("<?php echo CController::createUrl('Material/View')?>"); 
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
function deleteMaterialLine(id){
    if (confirm("Bạn có thật sự muốn xóa?")) {  
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsProducts/Material/deleteProductLine',    
            data: {"id":id},   
            success:function(data){
                if(data == '1')
                {                    
                    window.location.assign("<?php echo CController::createUrl('Material/View')?>");  
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

</script>







