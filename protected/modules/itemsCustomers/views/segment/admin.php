<?php 
$baseUrl = Yii::app()->baseUrl;
$cities = array(array(1,1,"An Giang","An Giang"),array(2,1,"Bà Rịa-Vũng Tàu","Bà Rịa-Vũng Tàu"),array(3,1,"Bạc Liêu","Bạc Liêu"),array(4,1,"Bắc Kạn","Bắc Kạn"),array(5,1,"Bắc Giang","Bắc Giang"),array(6,1,"Bắc Ninh","Bắc Ninh"),array(7,1,"Bến Tre","Bến Tre"),array(8,1,"Bình Dương","Bình Dương"),array(9,1,"Bình Định","Bình Định"),array(10,1,"Bình Phước","Bình Phước"),array(11,1,"Bình Thuận","Bình Thuận"),array(12,1,"Cà Mau","Cà Mau"),array(13,1,"Cao Bằng","Cao Bằng"),array(14,1,"Cần Thơ (TP)","Cần Thơ (TP)"),array(15,1,"Đà Nẵng (TP)","Đà Nẵng (TP)"),array(16,1,"Đắk Lắk","Đắk Lắk"),array(17,1,"Đắk Nông","Đắk Nông"),array(18,1,"Điện Biên","Điện Biên"),array(19,1,"Đồng Nai","Đồng Nai"),array(20,1,"Đồng Tháp","Đồng Tháp"),array(21,1,"Gia Lai","Gia Lai"),array(22,1,"Hà Giang","Hà Giang"),array(23,1,"Hà Nam","Hà Nam"),array(24,1,"Hà Nội (TP)","Hà Nội (TP)"),array(25,1,"Hà Tây","Hà Tây"),array(26,1,"Hà Tĩnh","Hà Tĩnh"),array(27,1,"Hải Dương","Hải Dương"),array(28,1,"Hải Phòng (TP)","Hải Phòng (TP)"),array(29,1,"Hòa Bình","Hòa Bình"),array(30,1,"Hồ Chí Minh (TP)","Hồ Chí Minh (TP)"),array(31,1,"Hậu Giang","Hậu Giang"),array(32,1,"Hưng Yên","Hưng Yên"),array(33,1,"Khánh Hòa","Khánh Hòa"),array(34,1,"Kiên Giang","Kiên Giang"),array(35,1,"Kon Tum","Kon Tum"),array(36,1,"Lai Châu","Lai Châu"),array(37,1,"Lào Cai","Lào Cai"),array(38,1,"Lạng Sơn","Lạng Sơn"),array(39,1,"Lâm Đồng","Lâm Đồng"),array(40,1,"Long An","Long An"),array(41,1,"Nam Định","Nam Định"),array(42,1,"Nghệ An","Nghệ An"),array(43,1,"Ninh Bình","Ninh Bình"),array(44,1,"Ninh Thuận","Ninh Thuận"),array(45,1,"Phú Thọ","Phú Thọ"),array(46,1,"Phú Yên","Phú Yên"),array(47,1,"Quảng Bình","Quảng Bình"),array(48,1,"Quảng Nam","Quảng Nam"),array(49,1,"Quảng Ngãi","Quảng Ngãi"),array(50,1,"Quảng Ninh","Quảng Ninh"),array(51,1,"Quảng Trị","Quảng Trị"),array(52,1,"Sóc Trăng","Sóc Trăng"),array(53,1,"Sơn La","Sơn La"),array(54,1,"Tây Ninh","Tây Ninh"),array(55,1,"Thái Bình","Thái Bình"),array(56,1,"Thái Nguyên","Thái Nguyên"),array(57,1,"Thanh Hóa","Thanh Hóa"),array(58,1,"Thừa Thiên - Huế","Thừa Thiên - Huế"),array(59,1,"Tiền Giang","Tiền Giang"),array(60,1,"Trà Vinh","Trà Vinh"),array(61,1,"Tuyên Quang","Tuyên Quang"),array(62,1,"Vĩnh Long","Vĩnh Long"),array(63,1,"Vĩnh Phúc","Vĩnh Phúc"),array(64,1,"Yên Bái","Yên Bái"));
?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/js/spectrum/spectrum.css" />
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/spectrum/spectrum.js"></script>


<style type="text/css">
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
    padding: 9px 30px;
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

.table-package>thead{
    color: #fff;
    background-color: rgba(115, 149, 158, 0.80);
}

.at{
    background-color: #c4e2c7 !important;
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

                                            <a class="btn_plus" id="newCustomer" data-toggle="modal" data-target="#addGroupModal"></a>


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

								

								<div id="detailGroup">

									

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


<?php include("popup_add_group.php");?>

<script type="text/javascript">

var baseUrl = $('#baseUrl').val();

// Biến dùng kiểm tra nếu đang gửi ajax thì ko thực hiện gửi thêm
var is_ajax = false;
// Biến dùng kiểm tra nếu đang gửi ajax thì ko thực hiện gửi thêm
var is_busy = false;  
// Biến lưu trữ trang hiện tại
var page = 1;
// Biến lưu trữ rạng thái phân trang 
var stopped = false;

function searchSegment(id=''){

    // Nếu đang gửi ajax thì ngưng
    if (is_ajax == true){        
        return false;
    } 
    // Thiết lập đang gửi ajax
    is_ajax = true;       
    
    var value = $('#searchNameCustomer').val(); 
    var type  = $("#searchSortCustomer").val();
    
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsCustomers/Segment/searchSegment',    
        data: {"value":value,"type":type},   
        success:function(data){
            page = 1;
            stopped = false;
            $('#customerList').html(data);
            detailSegment(id);

            is_ajax = false;  
            
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });
   
}
function detailSegment(id){     

    $('.cal-loading').fadeIn('fast');

    var curpage=1;

    if(id == null || id == '') 
    {
        var id = $("#customerList li:first-child").find('input').val();
    }
    
    $('.n').removeClass("active"); 
    $("#c"+id).addClass("active");
    $("#c"+id).find('code').removeClass("hide");

    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsCustomers/Segment/detailSegment', 
        data: {"id":id,"curpage":curpage},   
        success:function(data){     

            $('#detailGroup').html(data);
            $('.cal-loading').fadeOut('slow');  
           
        },
        error: function(data){
        console.log("error");
        console.log(data);
        }
    });  
  
}

function changeSegment(){ 

    var rule = $('#rule').val();  

    var $set = $('div[data-value]');

    var len = $set.length;

    $set.each(function(index, element) { 

        var field = $(this).attr('data-value'); 
      
        if (field == rule) {         
            $('.field').css("display", "none");
            $(this).css("display", "block");
        }

    });

}

// function errorAddRule(){

//     var status = true;

//     var k        = $('#rule').val();

//     $("#rule_items > tbody > tr td:first-child").each(function(){       

//         var td=$(this).attr('data-rule');  

//         if(k == td){
//             status = false; 
//         }
        
//     });

//     return status;
// }

function addRule(){   

    var k        = $('#rule').val();  
    
    var selected = $('#rule option:selected').text();    
    
    if(k != 0 && selected != '------'){

        if (($("#no_record").length > 0)){
           $("#no_record").remove();
        }

        var number_rule = $('td[data-rule]').length;   

        $(".field").each(function(){  

            if($(this).css('display') == 'block') {    

                var data_value = $(this).attr('data-value'); 

                var value_end = $(this).find('input[name=value_end]').val();

                if (data_value==2) {

                    var val = $(this).find('select[name=gender]').val();

                    var text = $(this).find('select[name=gender] option:selected').text(); 
                   
                    $("#rule_items").find('tbody')
                    .append($('<tr id="r'+number_rule+'">')
                        .append('<td data-rule="'+k+'">'+selected+'</td>')
                        .append('<td data-type-value="1">Loại số</td>')  
                        .append('<td data-value="'+val+'">'+text+'</td>')   
                        .append('<td data-value-end=""></td>')                      
                        .append($('<td>')                            
                            .append('<img onclick="deleteRule('+number_rule+');" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;">')  
                        )                        
                    );

                }else if (data_value==3) {

                    var val = $(this).find('select[name=customer_type]').val();

                    var text = $(this).find('select[name=customer_type] option:selected').text(); 
                   
                    $("#rule_items").find('tbody')
                    .append($('<tr id="r'+number_rule+'">')
                        .append('<td data-rule="'+k+'">'+selected+'</td>')
                        .append('<td data-type-value="1">Loại số</td>')  
                        .append('<td data-value="'+val+'">'+text+'</td>')   
                        .append('<td data-value-end=""></td>')                      
                        .append($('<td>')                            
                            .append('<img onclick="deleteRule('+number_rule+');" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;">')  
                        )                        
                    );

                }else if (data_value==4) {

                    var val = $(this).find('select[name=region]').val();

                    var text = $(this).find('select[name=region] option:selected').text(); 
                   
                    $("#rule_items").find('tbody')
                    .append($('<tr id="r'+number_rule+'">')
                        .append('<td data-rule="'+k+'">'+selected+'</td>')
                        .append('<td data-type-value="1">Loại số</td>')  
                        .append('<td data-value="'+val+'">'+text+'</td>')   
                        .append('<td data-value-end=""></td>')                      
                        .append($('<td>')                            
                            .append('<img onclick="deleteRule('+number_rule+');" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;">')  
                        )                        
                    );

                }else if (data_value==5 || data_value==7 || data_value==8) {

                    var val_rule = $(this).find('select[name=rule]').val();

                    var text_rule = $(this).find('select[name=rule] option:selected').text(); 

                    var val = $(this).find('input[name=value]').val();                
                   
                    $("#rule_items").find('tbody')
                    .append($('<tr id="r'+number_rule+'">')
                        .append('<td data-rule="'+k+'">'+selected+'</td>')
                        .append('<td data-type-value="'+val_rule+'">'+text_rule+'</td>')  
                        .append('<td data-value="'+val+'">'+val+'</td>')   
                        .append('<td data-value-end=""></td>')                      
                        .append($('<td>')                            
                            .append('<img onclick="deleteRule('+number_rule+');" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;">')  
                        )                        
                    );

                }else if (data_value==6 || data_value==14 || data_value==15 || data_value==16) {

                    var date_start_value = $(this).find('input[name=date_start]').val();

                    var split_start_value = date_start_value.split("-");

                    var date_start_text = split_start_value[2]+'/'+split_start_value[1]+'/'+split_start_value[0];  

                    var date_end_value = $(this).find('input[name=date_end]').val();

                    var split_end_value = date_end_value.split("-");

                    var date_end_text = split_end_value[2]+'/'+split_end_value[1]+'/'+split_end_value[0];  
                   
                    $("#rule_items").find('tbody')
                    .append($('<tr id="r'+number_rule+'">')
                        .append('<td data-rule="'+k+'">'+selected+'</td>')
                        .append('<td data-type-value="1">Loại số</td>')  
                        .append('<td data-value="'+date_start_value+'">'+date_start_text+'</td>')   
                        .append('<td data-value-end="'+date_end_value+'">'+date_end_text+'</td>')                      
                        .append($('<td>')                            
                            .append('<img onclick="deleteRule('+number_rule+');" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;">')
                        )                        
                    );

                }else if (data_value==10) {

                    var val = $(this).find('select[name=customer_status]').val();

                    var text = $(this).find('select[name=customer_status] option:selected').text(); 
                   
                    $("#rule_items").find('tbody')
                    .append($('<tr id="r'+number_rule+'">')
                        .append('<td data-rule="'+k+'">'+selected+'</td>')
                        .append('<td data-type-value="1">Loại số</td>')  
                        .append('<td data-value="'+val+'">'+text+'</td>')   
                        .append('<td data-value-end=""></td>')                      
                        .append($('<td>')                            
                            .append('<img onclick="deleteRule('+number_rule+');" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;">')
                        )                        
                    );

                }else if (data_value==11) {

                    var val = $(this).find('select[name=customer_origin]').val();

                    var text = $(this).find('select[name=customer_origin] option:selected').text(); 
                   
                    $("#rule_items").find('tbody')
                    .append($('<tr id="r'+number_rule+'">')
                        .append('<td data-rule="'+k+'">'+selected+'</td>')
                        .append('<td data-type-value="1">Loại số</td>')  
                        .append('<td data-value="'+val+'">'+text+'</td>')   
                        .append('<td data-value-end=""></td>')                      
                        .append($('<td>')                            
                            .append('<img onclick="deleteRule('+number_rule+');" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;">')
                        )                        
                    );

                }else if (data_value==12) {

                    var value = $(this).find('input[name=value]').val();   

                    var value_end = $(this).find('input[name=value_end]').val();
                   
                    $("#rule_items").find('tbody')
                    .append($('<tr id="r'+number_rule+'">')
                        .append('<td data-rule="'+k+'">'+selected+'</td>')
                        .append('<td data-type-value="1">Loại số</td>')  
                        .append('<td data-value="'+value+'">'+value+'</td>')   
                        .append('<td data-value-end="'+value_end+'">'+value_end+'</td>')                      
                        .append($('<td>')                            
                            .append('<img onclick="deleteRule('+number_rule+');" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;">')  
                        )                        
                    );

                }

            }

        });   

    }
    
}

function deleteRule(number_rule){   
    if (confirm("Bạn có thật sự muốn xóa?")) {  
        var evt = window.event || arguments.callee.caller.arguments[0];
        evt.preventDefault(); 
        $('#r'+number_rule).remove();   
        if (($("#rule_items tbody tr").length == 0)){
           $("#rule_items").find('tbody').append($('<tr id="no_record">').append('<td colspan="5" style="text-align:center;">Không có dữ liệu nào!</td>'));
        }     
        evt.stopPropagation();
    }
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
                url         : baseUrl+'/itemsCustomers/Segment/searchSegment', 
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
       searchSegment();
    }
}

$('#frm-segment').submit(function(e) {
         
    $('.cal-loading').fadeIn('fast');       

    if (($("#no_record").length == 0)){

        var segment_rule = []; 

        $("#rule_items > tbody > tr").each(function(){  

            var rule       = $(this).children('td:nth-child(1)').attr('data-rule'); 
            var value_type = $(this).children('td:nth-child(2)').attr('data-type-value'); 
            var value      = $(this).children('td:nth-child(3)').attr('data-value');
            var value_end  = $(this).children('td:nth-child(4)').attr('data-value-end');      

            var response = {};

            response['rule']       = rule; 
            response['value_type'] = value_type; 
            response['value']      = value;
            response['value_end']  = value_end;

            segment_rule.push(response);   

        });

    }else {

        var segment_rule = "";

    }  

    var formData = new FormData($('#frm-segment')[0]); 

    formData.append('segment_rule',JSON.stringify(segment_rule));  

    if (!formData.checkValidity || formData.checkValidity()) {  

    jQuery.ajax({
        type:'POST',
        url: baseUrl+'/itemsCustomers/Segment/addSegment',
        data:formData,
        datatype:'json',
        success:function(data){                                   
            if (data == -2) {                                       
                $('#rq-code').addClass('error').find('.help-block').html('Mã đã tồn tại');
                $('.cal-loading').fadeOut('slow');
        
            }else if(data == 1) {
                $('#rq-code').removeClass('error').find('.help-block').html('');
                $('.cal-loading').fadeOut('slow'); 
                window.location.assign("<?php echo CController::createUrl('Segment/admin')?>"); 
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

});

$("#color").spectrum({
    preferredFormat: "name",
    showInput: true,
    showPalette: true,
    palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]]
});

$('#sortLabel').click(function(){ 
    $('#sortOptionList').fadeToggle('fast');
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

$( document ).ready(function() { 
    searchSegment();
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









