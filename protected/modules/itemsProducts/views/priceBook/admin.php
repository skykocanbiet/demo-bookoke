<?php 
$baseUrl = Yii::app()->baseUrl;
?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/bootstrap-multiselect.css" />

<link rel="stylesheet" href="<?php echo $baseUrl; ?>/js/daterangepicker/daterangepicker.css" type="text/css">

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-multiselect.js"></script>

<script type="text/javascript" src='<?php echo $baseUrl; ?>/js/daterangepicker/moment.min.js'></script>

<script type="text/javascript" src='<?php echo $baseUrl; ?>/js/daterangepicker/moment.js'></script>

<script type="text/javascript" src='<?php echo $baseUrl; ?>/js/daterangepicker/daterangepicker.js'></script>

<style type="text/css">
.btn-default {
    color: #333 !important;
}
.btn-group{
    width: 100% !important;
    margin: 0px;
}
.btn-group > button{
    text-align: left;
}
.btn-group > button > .caret{
    float: right;
}
.multiselect-selected-text{
    color: #333;
}
.multiselect-container{
    height: 210px;
    overflow-y: auto;
}
#tabcontent {
    padding: 30px 30px 10px 30px;
}
#profileSideNav ul li a i{
    font-size:2em;  
}
#package-container{
    padding:20px;position: fixed;top: 2%;right: 0;left: 0;width: 750px;height: auto;margin: 0 auto;background: #ffffff;border-radius: 3px;z-index: 999;
}
.blur{
    display: none;position: fixed;top: 0;right: 0;width: 100%;height: 100%;z-index: 999;background: rgba(0,0,0,0.8);
}
.sHeader{
    background: #e6e6e5;
    color: #5a5a5a; 
    font-size: 18px;
    margin-top: -20px;
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
.table thead{
    color: #fff;
    background-color: rgba(115, 149, 158, 0.80);
}
.table {
    border-bottom:0px !important;
}
.table th, .table td {
    border: 0px !important;
}
.at{
    background-color: #c4e2c7 !important;
}
.table tbody {
    display:block;
    height:50px;
    overflow:auto;
}
.table thead, .table tbody tr {
    display:table;
    width:100%;
    table-layout:fixed;/* even columns width , fix width of table too*/
}
thead {
    width: calc( 100% - 1em )/ scrollbar is average 1em/16px width, remove it from thead width /
}
.table-left th,.table-left td{
    text-align: left;
}
/*END TABLE TOGGLE*/
.ui.label {
    display: inline-block;
    line-height: 1;
    vertical-align: baseline;
    margin: 0 .14285714em;
    background-color: #E8E8E8;
    background-image: none;
    padding: .5833em .833em;
    color: rgba(0,0,0,.6);
    text-transform: none;
    font-weight: 700;
    border: 0 solid transparent;
    border-radius: .28571429rem;
    -webkit-transition: background .1s ease;
    transition: background .1s ease;
}
/* slider */
.slider_off {
background: url('../../images/switch-bg.png') -57px 0px no-repeat;
left: 60px;
text-indent: 26px;
color: #ffffff !important;
}
.slider_on {
background: url('../../images/switch-bg.png') 0px 0px no-repeat;
text-indent: 10px;
left: 2px;
}
.slider_switch {
background: url('../../images/switch-btn.png') left top no-repeat;
height: 24px;
left: 38px;
position: absolute;
width: 25px;
}
.Off{
    left: 1px;
}
.On{
    left: -57px;
}
.Switch{
    left: 1px;
}
.multiselect-container>li>a>label>input[type=checkbox]{
    margin-top: 3px;
}
/* end slider */
</style>

<input type="hidden" id="baseUrl" value="<?php echo Yii::app()->baseUrl?>"/>
    
    <div id="customers" class="tab-pane full-height active">

        <div class="row-fluid full-height">

            <div id="customerContent" class="content">             

                    <div class="row">                        

                        <div class="customerListContainer col-sm-3 col-md-3">

                            <div style="margin:0px 2em;">

                                    <div class="customersActionHolder">

                                        <h3 style="width: 170px;">Danh sách</h3>

                                            <a class="btn_plus" data-toggle="modal" data-target="#addPriceBookModal"></a>


                                            <div class="clearfix"></div>

                                    </div>                                 

                                    <div class="customerSearchHolder">
                                            <div id="customer-search-textbox">
                                                <input type="text" onkeypress="runScript_search(event);" id="searchNameCustomer" class="customerSearch fl blue_focus " placeholder="Tìm kiếm...">
                                                <input type="hidden" id="searchSortCustomer" value="0">
                                                <i class="icon-sort-down fr noDisplay" id="advanced-search-PopUp" style="position:absolute;left:227px;margin-top: 7px;cursor: pointer;"></i>
                                            </div>
                                            
                                            <div id="sortLabel" class="sortLabel fr importAndSort">
                                                <i class="fa fa-list"></i>
                                                <ul id="sortOptionList">
                                                    <li class="SortBy" class="sort-customers-option"><input type="hidden" value="1">Theo Tên </li>                                                   
                                                    <li class="SortBy" class="sort-customers-option"><input type="hidden" value="4">Theo Mã </li>                                              
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

                                        <ul id="customerList" style="max-height: 770px;">   
                                                       
                                        </ul>
                        
                                    </div>

                            </div>

                        </div>

                      


                <!-- Detail -->
                <div id="" class="col-sm-7 col-md-9">               

                    <div class="rg-constrained">

                        <div class="rg-row">

                            <div class="col-md-12">

                                
                                <div class="t-settings-head">
                                    <div class="t-settings-head affix-top" data-spy="affix" data-offset-top="105" style="margin-top:10px;">
                                        <h1>Tất cả</h1>
                                        <div class="t-settings-head__actions">
                                        <div class="input-group" style="display:inline-flex;width:300px;">
                                          <input type="text" class="form-control" onkeypress="runScript_searchService(event);" id="searchService" placeholder="Tìm kiếm theo mã và tên dịch vụ">
                                          <div class="input-group-addon" onclick="searchService();"  id="glyphicon-search" style="padding-right:25px;cursor:pointer;"><span class="glyphicon glyphicon-search"></span></div>
                                       </div>  
                                        
                                     
                                        </div>
                                      
                                    </div>
                                </div> 

                                <div id="detailPriceBook" style="margin-top:20px;">

                                    

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


<?php include("popup_add_price_book.php");?>

<script type="text/javascript">

var baseUrl = $('#baseUrl').val();

var templock = 0;

// Biến dùng kiểm tra nếu đang gửi ajax thì ko thực hiện gửi thêm
var is_busy = false;  
// Biến lưu trữ trang hiện tại
var page = 1;
// Biến lưu trữ rạng thái phân trang 
var stopped = false;

function searchPriceBook(id=''){      
    
    var value = $('#searchNameCustomer').val(); 
    var type  = $("#searchSortCustomer").val();
    
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsProducts/PriceBook/searchPriceBook',    
        data: {"value":value,"type":type},   
        success:function(data){
            page = 1;
            stopped = false;
            $('#customerList').html(data);
            detailPriceBook(id);
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });
   
}

function detailPriceBook(id){     

    $('.cal-loading').fadeIn('fast');     

    $('#searchService').val('');

    if(id == '') 
    {
        var id = $("#customerList li:first-child").find('input').val();
    }
    
    $('.n').removeClass("active"); 
    $("#c"+id).addClass("active");
    $("#c"+id).find('code').removeClass("hide");

    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsProducts/PriceBook/detailPriceBook', 
        data: {"id":id,"curpage":1},   
        success:function(data){     

            $('#detailPriceBook').html(data);
            $('.cal-loading').fadeOut('slow');  
           
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });  
  
}

function disabled_time()
{
  $("#on_time").addClass("On");
  $("#off_time").addClass("Off");
  $('#switch_time').addClass("Switch");
  $('#daterange').addClass('hidden'); 
  $('#hidden_time').val('0');  
}

function change_effect()
{
  $("#on_effect").toggleClass("On");
  $("#off_effect").toggleClass("Off");
  $('#switch_effect').toggleClass("Switch");   

  if ($('#hidden_effect').val() == 0) {      
    $('#hidden_effect').val('1'); 
    $('#change_time').attr('onclick','change_time()');
  }else {    
    $('#hidden_effect').val('0');
    $('#change_time').removeAttr('onclick');
    disabled_time();
  }
    
}

function change_time()
{
  $("#on_time").toggleClass("On");
  $("#off_time").toggleClass("Off");
  $('#switch_time').toggleClass("Switch");
  $('#daterange').toggleClass('hidden');   

  if ($('#hidden_time').val() == 0) 
    $('#hidden_time').val('1'); 
  else 
    $('#hidden_time').val('0');
  
}

$(function() {
    $('input[name="daterange"]').daterangepicker({
        timePicker: true,
        timePickerIncrement: 365,
        locale: {
            format: 'MM/DD/YYYY h:mm:ss'
        }
    });
});

function searchService(){ 

    $('.cal-loading').fadeIn('fast');

    var id=$('.n.active').find('span').find('input').val();   
   
    var searchService= $('#searchService').val(); 

    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsProducts/PriceBook/detailPriceBook',  
        data:{"id":id,"curpage": 1,"searchService": searchService},
        success:function(data){
            $('#detailPriceBook').html(data);  
            $('.cal-loading').fadeOut('slow');          
        },
        error: function(data){
            console.log("error");
            console.log(data);
        }
    });
}

function pagination(curpage,id){  
    $('.cal-loading').fadeIn('fast');  

    var searchService= $('#searchService').val();  

    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsProducts/PriceBook/detailPriceBook',
        data:{"id":id,"curpage": curpage,"searchService": searchService},
        success:function(data){

            $('#detailPriceBook').html(data);
            $('.cal-loading').fadeOut('slow');

        },
        error: function(data){
            console.log("error");
            console.log(data);
        }
    });      
}

//** jQuery Ajax scrolling pagination **//

$(document).ready(function()
{    
    // Khi kéo scroll thì xử lý

    $('#customerList').on('scroll', function()     
    {       
        // Nếu màn hình đang ở dưới cuối thẻ thì thực hiện ajax
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) 
        {
            // Nếu đang gửi ajax thì ngưng
            if (is_busy == true){
                return false;
            } 
            // Nếu hết dữ liệu thì ngưng
            if (stopped == true){
                return false;
            }
            // Thiết lập đang gửi ajax
            is_busy = true;             
            // Tăng số trang lên 1
            page++;  
            // Hiển thị loadding
            $('#loadding').removeClass('hidden');
            // Gửi Ajax  
            var value = $('#searchNameCustomer').val(); 
            var type  = $("#searchSortCustomer").val();
            $.ajax(
            {
                type        : 'POST',              
                url         : baseUrl+'/itemsProducts/PriceBook/searchPriceBook', 
                data        : {"value":value,"type":type,"cur_page": page},
                success     : function (result)
                {    
                                         
                    $('#customerList').append(result);                    
                }
            })
            .always(function()
            {
                // Sau khi thực hiện xong ajax thì ẩn hidden và cho trạng thái gửi ajax = false  
                $('#loadding').addClass('hidden');             
                is_busy = false;
            });
            return false;
        }
    });
});

//** end jQuery Ajax scrolling pagination **//

function runScript_search(e){
    
    if (e.keyCode == 13) {
        e.preventDefault();
       searchPriceBook();
    }
}

function runScript_searchService(e){
    
    if (e.keyCode == 13) {
        e.preventDefault();
       searchService();
    }
}

$('#sortLabel').click(function(){ 
    $('#sortOptionList').fadeToggle('fast');
});

$('.SortBy').click(function(){    
    $("#searchSortCustomer").val($(this).find('input').val());
    searchPriceBook();
});

$('#addPriceBookModal').on('hidden.bs.modal', function (e) {
    $('#frm-price-book')[0].reset();  
    $("#id_service").multiselect('refresh');
})

function showEditPriceBookModal(id){
    var evt = window.event || arguments.callee.caller.arguments[0];    
    $('#editPriceBookModal'+id).modal('show');
    evt.stopPropagation();
}

$('#frm-price-book').submit(function(e) {

    $('.cal-loading').fadeIn('fast');
    
    var formData = new FormData($("#frm-price-book")[0]);     

    if($('#hidden_time').val() == 0)        
        formData.append('daterange',"");       

    if (!formData.checkValidity || formData.checkValidity()) {

        jQuery.ajax({           
            type:"POST",
            url: baseUrl+'/itemsProducts/PriceBook/addNewPriceBook',    
            data:formData,
            datatype:'json',
            success:function(data){  
                if (data > 0) {
                    $('#addPriceBookModal').modal('hide');                     
                    searchPriceBook(data);                   
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

$(document).mouseup(function (e)
{
    var container = $("#sortOptionList");
    if (!container.is(e.target) 
        && container.has(e.target).length === 0) 
    {       
        container.hide();        
    }     
});

$(document).ready(function() {
    $('#id_service').multiselect({
        enableClickableOptGroups: true,
        enableCollapsibleOptGroups: true
    });
});

$( document ).ready(function() { 
    searchPriceBook();
});

$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();
    var customer_action = $(".customersActionHolder").height();  
    var customer_search = $(".customerSearchHolder").height();

    $('#profileSideNav').height(windowHeight-header);

    $('.customerListContainer').height(windowHeight-header);

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

    $('.customerListContainer').height(windowHeight-header);

    $('.statsTabContent').height(windowHeight-header-tab_menu-45);   

    $('#customerList').css('max-height', windowHeight-header-customer_action-customer_search-80);

});

</script>









