<?php 
$baseUrl = Yii::app()->baseUrl;

$v = new CDbCriteria(); 
$v->addCondition('t.status = 1');
$v->order= 'id DESC';
$cst_all=$cst->findAll($v);

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

<!-- multiselect -->
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/bootstrap-multiselect.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-multiselect.js"></script>
<!-- end multiselect -->


<input type="hidden" id="baseUrl" value="<?php echo Yii::app()->baseUrl?>"/>

<style type="text/css">
.btn-group{
    width: 100% !important;
}
.multiselect-selected-text{
    color: #000;
}
#profileSideNav ul li a i{
    font-size:2em;  
}
#service-container{
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
.dropdown-menu li a{
    color: black !important;
}
.caret-container .caret{    
    vertical-align: middle;
}
#mn_nav .dropdown-menu {
    right: initial;
}
.rg-row{
    margin-left: -15px;
    margin-right: -15px;
}

#select-staff .btn-group{
    margin: 0;    
}

#select-staff .multiselect-container{
    height: 150px;
    overflow-y: auto;
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
tbody {
    display:block;
    height:50px;
    overflow:auto;
}
thead, tbody tr {
    display:table;
    width:100%;
    table-layout:fixed;/* even columns width , fix width of table too*/
}
thead {
    width: calc( 100% - 1em )/ scrollbar is average 1em/16px width, remove it from thead width /
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
                                                                                        <h3>Nhóm dịch vụ</h3>
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
                                            <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Thêm nhóm dịch vụ</h3>
                                            <div class="popover-content" style="width:225px;">
                                                <input type="text" required="" oninvalid="this.setCustomValidity('Vui lòng nhập tên nhóm dịch vụ.')" oninput="setCustomValidity('')" class="form-control" id="serviceNewName" name="serviceNewName" placeholder="Tên nhóm dịch vụ" style="margin-bottom:10px;width:96%;">                                                  
                                                <button id="addnewCustomer" class="btn btn_bookoke btn_w">Tạo mới</button> 
                                                <button id="cancelNewCustomer" type="reset" class="btn btn_cancel" style="min-width: 94px;margin-right: 0px;">Hủy</button>    
                                                                                               
                                            </div>
                                        </form>
                                    </div>

                                    <div id="customerListHolder" class="customerListHolder">  
                                        <ul id="customerList" style="max-height: 770px;">                                                    
                                                    <li id="c0" onclick="detailServiceType(0);" class="n active">                                                                            
                                                        <span class="jqTransformCheckboxWrapper" style="display:none;">
                                                            <a href="#" class="jqTransformCheckbox"></a>
                                                            <input type="checkbox" value="0" class="fl" style="display : none;">
                                                        </span> 
                                                        <label class="fl"> Tất cả (<?php echo count($cst_all);?>) </label>
                                                     
                                                        <div class="clearfix"></div>
                                                    </li>
                                                    <?php 
                                                    foreach ($cst_all as $k => $v) 
                                                    {
                                                    ?>
                                                    <li id="c<?php echo $v->id;?>" onclick="detailServiceType(<?php echo $v->id;?>);" class="n">                                        
                                                        <span class="jqTransformCheckboxWrapper" style="display:none;">
                                                            <a href="#" class="jqTransformCheckbox"></a>
                                                            <input type="checkbox" value="<?php echo $v['id'];?>" class="fl" style="display : none;">
                                                        </span>  
                                                        <label class="fl"> <?php echo titleCase($v['name']);?> </label>                                                       
                                                        <img id="ltn<?php echo $v->id;?>" class="hide" onclick="showUpdateServiceType(<?php echo $v->id;?>);" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/edit_cam.png" style="float:right;margin: 9px 6px 0 0;width: 20px;height: 20px;">
                                                        <div class="clearfix"></div>
                                                    </li>  
                                                    <div id="updateServiceTypePopup<?php echo $v->id;?>" class="popover bottom service-type" style="display: none;padding:0px;top:150px;left:500px;">
                                                        <form id="frm-update-service-type-<?php echo $v->id;?>" onsubmit="return false;" class="form-horizontal">                                                                                                 
                                                            <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Chỉnh sửa nhóm dịch vụ</h3>
                                                            <div class="popover-content" style="width:225px;">
                                                                <input type="text" required="" oninvalid="this.setCustomValidity('Vui lòng nhập tên nhóm dịch vụ.')" oninput="setCustomValidity('')" class="form-control" id="servicetypeNewName<?php echo $v->id;?>" name="servicetypeNewName" value="<?php echo $v['name'];?>" placeholder="Tên nhóm dịch vụ" style="margin-top:0px;padding: 6px 12px;margin-bottom:10px;width:98%;">
                                                                <button onclick="deleteServiceType(<?php echo $v->id;?>);" class="btn btn_delete" style="min-width: 94px;margin-right: 0px;">Xóa</button>
                                                                <button onclick="updateServiceType(<?php echo $v->id;?>);" class="btn btn_bookoke">Cập nhật</button>
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
   

                <!-- Detail Service Type -->
                <div  class="col-sm-7 col-md-9">
                
                    

                        <div class="rg-constrained">

                            <div class="rg-row">
                                <div class="col-md-12">
                                    <div class="t-settings-head">
                                        <div class="t-settings-head affix-top" data-spy="affix" data-offset-top="105" style="margin-top:10px;">
                                            <h1>Tất cả <label class="count" id="countservice"></label></h1>
                                            <div class="t-settings-head__actions">
                                            <div class="input-group" style="display:inline-flex;width:300px;margin-right:30px;">
                                              <input type="text" class="form-control" onkeypress="runScript_search(event);" id="searchService" placeholder="Tìm kiếm theo mã và tên dịch vụ">
                                              <div class="input-group-addon" onclick="searchService();"  id="glyphicon-search" style="padding-right:25px;cursor:pointer;"><span class="glyphicon glyphicon-search"></span></div>
                                           </div>  
                                            
                                            <a data-bind="" onclick="" id="add_service" class="btn_plus" href="javascript:void(0);"></a>
                                            </div>
                                          
                                        </div>
                                    </div> 
                                    <div id="detailServiceType"  style="margin-top:20px;">

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





<div class="blur" id="add-service-blur">

<div class="rg-constrained" id="service-container">

              
                    <div class="col-md-12">

                        
                       
                            
           
            <div class="modal-header popHead sHeader" style="">
               <a class="btn_close close_s" data-dismiss="modal" aria-label="Close"></a>
                <h5>Tạo Dịch Vụ Mới</h5>
            </div>     
            <form class="service-form" id="service-form" action="" onsubmit="return false;" method="post" novalidate="">    
            <input type="hidden" name="save-add-another" id="save-add-another" value="false">
            <input id="ShowAffixTimesPanel" name="ShowAffixTimesPanel" type="hidden" value="False"><input name="__RequestVerificationToken" type="hidden" value="m-8u1fvSfNz50dkff6cvQk0EUL9PihfcNInjSXly1DAeWYwhxawPLWLrb7I4qgiROzKWRUyJHugUuGja6bRz-mgBK6KezJI9Irzg9lJbwyXdp2VSS3fZOCiilM3IxjTL7mUa7yfG3GjiMhM0FM0DArCSVO4pjOugmTMQ60c1Wa7dA0pR0">        <div class="t-settings-head">
                        
                        
                    </div>
              <div class="rg-row">
                   
                    <div class="col-md-12" style="margin-top:10px;">
                        
              <h5>Mô tả dịch vụ</h5>               
            <input id="XeroAuthError" name="XeroAuthError" type="hidden" value="False">
            <input id="Title" name="Title" type="hidden" value="Add Service">
            <input id="Service_BusinessId" name="Service.BusinessId" type="hidden" value="0">
            <input id="Origin" name="Origin" type="hidden" value="">
            <input id="Tab" name="Tab" type="hidden" value="details">
            <input id="Service_ServiceTypeId" name="Service.ServiceTypeId" type="hidden" value="1">


            <div class="rg-row">
                <div class="col-sm-4">
                    <div class="form-group required" id="rq-service-code">
                        <span class="" for="Service_Code">Mã dịch vụ</span>
                        <input class="form-control" id="Service_Code" name="Service_Code" required="" type="text" value="" data-parsley-id="0921">                        
                        <span class="help-block validation-error" id="parsley-id-0921"></span>
                    </div>
                </div>
                <div class="col-sm-4">                     
                    <div class="form-group required" id="rq-service-name">
                        <span class="" for="Service_Name">Tên dịch vụ</span>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <div class="btn-group service-color-pallet-holder">
                                    <a class="dropdown-toggle" id="dropdown-toggle-1" data-toggle="dropdown" href="javascript:void(0);">
                                        <label id="Service_Color" name="Service_Color" class="VN" style="font-weight: normal;color: #464646;font-size: 12px;margin-bottom: 0;">VN</label>
                                        <span class="caret"></span>                                                        
                                    </a>
                                    <ul class="dropdown-menu service-pallet-list" id="service-pallet-list-1">
                                       <li><a href="javascript:void(0);"><code class=" VN"></code>VN</a></li>
                                      <li><a href="javascript:void(0);"><code class=" EN"></code> EN</a></li>
                                      <!-- <li><a href="javascript:void(0);"><code class="service-color-pallet red"></code> Red</a></li>
                                      <li><a href="javascript:void(0);"><code class="service-color-pallet light-gray"></code> Light gray</a></li>
                                      <li><a href="javascript:void(0);"><code class="service-color-pallet green"></code> Green</a></li>
                                      <li><a href="javascript:void(0);"><code class="service-color-pallet light-blue"></code> Light blue</a></li>
                                      <li><a href="javascript:void(0);"><code class="service-color-pallet maroon"></code> Maroon</a></li>
                                      <li><a href="javascript:void(0);"><code class="service-color-pallet deep-sky-blue"></code> Deep sky blue</a></li>
                                      <li><a href="javascript:void(0);"><code class="service-color-pallet violet"></code> Violet</a></li>
                                      <li><a href="javascript:void(0);"><code class="service-color-pallet yellow"></code> Yellow</a></li>
                                      <li><a href="javascript:void(0);"><code class="service-color-pallet orange"></code> Orange</a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <input class="form-control" id="Service_Name" name="Service_Name" required="" type="text" value="" data-parsley-id="0922">
                            <input class="form-control hide" id="Service_Name_En" name="Service_Name_En" required="" type="text" value="123" data-parsley-id="0922" >
                           
                        </div>
                    <span class="help-block validation-error" id="parsley-id-0922"></span></div>
                </div>
                    <div class="col-sm-4">
                        <div class="form-group required" id="rq-service-group">
                            <span class="" for="ServiceCategoryId">Nhóm dịch vụ</span>                          
                            <?php
                            $group_service = array();
                            foreach($cst_all as $temp){
                                $group_service[$temp['id']] = $temp['name'];
                            }                            
                            echo CHtml::dropDownList('ServiceCategoryId','',$group_service,array('class'=>'form-control','required'=>'required','empty' => 'Chọn nhóm dịch vụ','options'=>array()));
                            ?>                     
                            <span class="help-block validation-error" id="parsley-id-0923"></span>
                        </div>
                    </div>
               

            </div>

                <input id="Service_Capacity" name="Service.Capacity" type="hidden" value="0">

            <div class="form-group ">
                <span class="" for="Service_Description">Mô tả</span>
                <span class="char-count-container">
                    <textarea class="char-count-1000 form-control" cols="20" id="Service_Description" name="Service_Description" rows="2" data-parsley-id="6859"></textarea>
                </span>
            <span class="help-block validation-error" id="parsley-id-6859"></span></div>
           
            <div class="form-group" style="padding: 0px;">
                <div class="checkbox">
                    <label>
                        <input checked="checked" id="Service_Booking" name="Service_Booking" type="checkbox" value="true" data-parsley-multiple="ServiceOnlineBookings" data-parsley-id="4531"><input name="Service.OnlineBookings" type="hidden" value="false"> Khách hàng có thể đăng kí dịch vụ trực tuyến
                    </label>
                    
                </div>


                <span class="help-block validation-error" id="parsley-id-multiple-ServiceOnlineBookings"></span>

            </div>    
           

             <div class="clearfix"></div>
            <div class="rg-row">
                <div class="col-sm-3">
                    <div class="form-group ">
                        <span class="" for="Service_Price">Giá dịch vụ</span><br>
                        <div class="inline-group">
                            
          

         

         

            <span class="price-display">
                <div class="input-group">
                    
                    <input value="" class="price-input form-control input-narrow autoNum"  onkeypress=" return isNumberKey(event)" id="Service_Price" name="Service_Price" type="text" data-parsley-id="7867">
                    <div class="input-group-addon">
                        <div class="btn-group service-color-pallet-holder" style="margin: 0 0;">
                                    <a class="dropdown-toggle" id="dropdown-toggle-unit" data-toggle="dropdown" href="javascript:void(0);">
                                        <label id="Service_unit_price" name="Service_unit_price" class="VND" style="font-weight: normal;color: #464646;font-size: 12px;margin-bottom: 0;">VND</label>
                                        <!-- <span class="caret"></span>      -->                                                   
                                    </a>
                                    <ul class="dropdown-menu service-pallet-list" id="service-unit-price">
                                       <li><a href="javascript:void(0);"><code class=" VND"></code>VND</a></li>
                                      <li><a href="javascript:void(0);"><code class=" USD"></code>USD</a></li>
                                    </ul>
                                </div>
                    </div>
                </div>
                
            </span>


           

                        </div>
                    <span class="help-block validation-error" id="parsley-id-7867"></span></div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <span class="" for="Service_Tax">Thuế</span><br>
                        <div class="inline-group">
                        <div class="input-group">
                            
                            
                            <input class="tax-input form-control input-narrow" onkeypress=" return isNumberKey(event)" id="Service_Tax" name="Service_Tax" type="text" value="">                             
                               <div class="input-group-addon">%</div> 
                        </div>
                        </div>
                    <span class="help-block validation-error" id="parsley-id-8933"></span></div>

                </div>
                <div class="col-sm-3">
                    <div class="form-group required ">
                <span class="" for="Service_Length">Thời gian thực hiện</span><br>
                <div class="input-group-duration">
                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                    <span class="ui-timepicker-container">
                    <input onkeypress="return isNumberKey(event)" class="duration-input form-control input-narrow ui-timepicker-input" id="Service_Length" name="Service_Length" pattern="^([0-1]?[0-9]|2[0-3]):([0-5][0-9])(:[0-5][0-9])?$" required="" type="number" min="0" value="" autocomplete="off" data-parsley-id="3353">                    
                    
                    </span>
                </div>

               
            <span class="help-block validation-error" id="parsley-id-3353"></span></div>
                </div>


                <div class="col-sm-3">
                    <div id="select-staff" class="rg-row" style="margin-bottom: 10px;">
                   
                    <div class="col-md-12">                
                     <span class="">Nhân viên thực hiện</span><br>

                    <div class="rg-row staff-services">
                        <div class="col-md-12">
                            <select id="example-enableCollapsibleOptGroups-enableClickableOptGroups" name="example-enableCollapsibleOptGroups-enableClickableOptGroups[]" multiple="multiple">
                                <optgroup label="Chọn tất cả">
                                    <?php 
                                    $cs_service=new CsService;
                                    $staff_list=$cs_service->getListDentists();                          
                                    foreach ($staff_list as $s_l) 
                                    {
                                    ?>
                                    <option value="<?php echo $s_l['id'];?>"><?php echo $s_l['name'];?></option>
                                    <?php 
                                    }
                                    ?>
                                </optgroup>                                          
                            </select>  
                        </div>
                           
                    </div>

                    </div>
                </div>
                </div>



            </div>

            


                    </div>
                </div>
                

                
                
                 <div class="rg-row">
                   
                    <div class="col-md-12">
                     <h5>Điểm thưởng</h5>    


                    <div class="rg-row">
                    <div class="col-sm-6">
                        <div class="form-group  margin-bottom-05em">

                            <span for="Service_Point_Donate" style="padding:0px;">Điểm được tặng khi mua dịch vụ</span>
                            <span style="width: 77px;margin-left: 15px;display: inline-block;">
                                <input class="form-control" id="Service_Point_Donate" name="Service_Point_Donate" required="" onkeypress=" return isNumberKey(event)" type="text" value="" data-parsley-id="0924">
                            </span>
                        <span class="help-block validation-error" id="parsley-id-0924"></span></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group margin-bottom-05em">
                            <span for="Service_Point_Exchange" style="padding:0px;">Điểm cần có để quy đổi dịch vụ</span>
                            <span style="width: 77px;margin-left: 15px; display: inline-block;"> 
                                <input class="form-control" id="Service_Point_Exchange" name="Service_Point_Exchange" required="" onkeypress=" return isNumberKey(event)" type="text" value="" data-parsley-id="0924">
                            </span>
                        <span class="help-block validation-error" id="parsley-id-2107"></span></div>
                    </div>
                   

                </div>

                    
                    </div>

                </div>
              
                
                <div class="rg-row" style="margin-top:10px;">
                    <div class="col-md-12">
                        <div class="form-actions text-right">
                                <a href="javascript:void(0);" class="btn btn_cancel close_s">Hủy</a>
                            <button id="btn-add-service" type="submit" class="btn btn_bookoke">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </form>


                        </div>
           
                    
             

            </div>
</div>




  




<script type="text/javascript">
var baseUrl = $('#baseUrl').val();
var templock = 0;

function showAddService(){

    var elem = $('#add-service-blur')[0];


      $('#add_service').on('click',function(e){

        $(elem).fadeToggle(200,function(){
        });
        e.stopPropagation();
    });


    $('body').on('click',function(e){
        if(templock == 0){
            if($(e.target).closest($('#service-container')).length === 0){                      
                if($(elem).is(':visible')){
                    templock = 1;
                    $(elem).fadeToggle(200,function(){
                        templock = 0;
                    });
                }                
            }
        }
    });

    $('.close_s').on('click',function(e){
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
showAddService();
function detailServiceType(id){
    var curpage=1;    
    $('.cal-loading').fadeIn('fast');    
    $('.n').removeClass("active");   
    $("#c"+id).addClass("active");  
    $("#c"+id).find('code').removeClass("hide");  
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsProducts/ProductService/detailServiceType', 
        data: {"id":id,"curpage":curpage},   
        success:function(data){
            $('#searchService').val('');
            $('#detailServiceType').html(data);
             countservice(id);
            $('.cal-loading').fadeOut('slow');    
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
    var searchService= $('#searchService').val();    
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsProducts/ProductService/detailServiceType', 
        data:{"id":id,"curpage": curpage,"searchService": searchService},
        success:function(data){
            $('#detailServiceType').html(data);
            $('.cal-loading').fadeOut('slow');
        },
        error: function(data){
            console.log("error");
            console.log(data);
        }
    });      
}
 function searchService(){ 
    $('.cal-loading').fadeIn('fast');
    var id=$('.n.active').find('span').find('input').val();   
    var curpage=1;      
    var searchService= $('#searchService').val(); 
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsProducts/ProductService/detailServiceType', 
        data:{"id":id,"curpage": curpage,"searchService": searchService},
        success:function(data){
            $('#detailServiceType').html(data);  
            $('.cal-loading').fadeOut('slow');          
        },
        error: function(data){
            console.log("error");
            console.log(data);
        }
    });
}

function runScript_search(e){
    
    if (e.keyCode == 13) {
        e.preventDefault();
       searchService();
    }
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
function error_add_service(){

    var status = true;

    if($('#Service_Code').val() == ''){
        status = false;       
        $('#rq-service-code').addClass('error');
        $("#parsley-id-0921").addClass('filled').html('<span class="parsley-required">Vui lòng nhập mã dịch vụ.</span>');       
    }
    else{
        $('#rq-service-code').removeClass('error');
    }

    if($('#Service_Name').val() == ''){
        status = false;       
        $('#rq-service-name').addClass('error');
        $("#parsley-id-0922").addClass('filled').html('<span class="parsley-required">Vui lòng nhập tên dịch vụ.</span>');       
    }
    else{
        $('#rq-service-name').removeClass('error');
    }

    if($('#ServiceCategoryId').val() == ''){
        status = false;       
        $('#rq-service-group').addClass('error');
        $("#parsley-id-0923").addClass('filled').html('<span class="parsley-required">Vui lòng chọn nhóm dịch vụ.</span>');       
    }
    else{
        $('#rq-service-group').removeClass('error');
    }

    return status;
}
function addService(){    
    $('#btn-add-service').click(function(){
        if(error_add_service()){
            $('.cal-loading').fadeIn('fast'); 
            var formData = new FormData($('#service-form')[0]); 
            formData.append('Service_Color',$('#Service_unit_price').attr( "class" ));
            if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({
                type:'POST',
                url: baseUrl+'/itemsProducts/ProductService/addService',
                data:formData,
                datatype:'json',
                success:function(data){                     
                    if (data == '-1') {                         
                        $('#rq-service-code').addClass('error');
                        $("#parsley-id-0921").addClass('filled').html('<span class="parsley-required">Mã dịch vụ đã tồn tại.</span>'); 
                        $('.cal-loading').fadeOut('slow');
                        return false;
                    }
                    else if(data == '1')
                    {
                        $('#rq-service-code').removeClass('error');
                        $('.cal-loading').fadeOut('slow'); 
                        window.location.assign("<?php echo CController::createUrl('ProductService/View')?>"); 
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
addService();
$('#service-pallet-list-1 li').click(function(){ 
    var color=$(this).find('code').attr('class').split(' ')[1];
        
    

   
    $('#dropdown-toggle-1 label').removeClass(function() {return $('#dropdown-toggle-1 label').attr( "class" );});
    $('#dropdown-toggle-1 label').addClass(color);
        
    $('#dropdown-toggle-1 label').html(color); 
    if(color == 'EN'){
            $('#Service_Name').addClass('hide');
            $('#Service_Name_En').removeClass('hide');
        } else {
            $('#Service_Name').removeClass('hide');
            $('#Service_Name_En').addClass('hide');
        }
      //$('#dropdown-toggle-1 code').html('VN');
});
$('#service-unit-price li').click(function(){ 
    var color=$(this).find('code').attr('class').split(' ')[1];
    $('#dropdown-toggle-unit label').removeClass(function() {return $('#dropdown-toggle-unit label').attr( "class" );});
    $('#dropdown-toggle-unit label').addClass(color);
        
    $('#dropdown-toggle-unit label').html(color); 
    /*if(color == 'unti'){
            $('#Service_Name').addClass('hide');
            $('#Service_Name_En').removeClass('hide');
        } else {
            $('#Service_Name').removeClass('hide');
            $('#Service_Name_En').addClass('hide');
        }*/
      //$('#dropdown-toggle-1 code').html('VN')
});
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
function showUpdateServiceType(id){    
    var evt = window.event || arguments.callee.caller.arguments[0];
    evt.preventDefault();
    var position = $('#ltn'+id).position();    
    $('#updateServiceTypePopup'+id).css({"top": position.top-50, "left": position.left+50});
    $('#updateServiceTypePopup'+id).fadeToggle('fast');
    evt.stopPropagation();
}

$(document).mouseup(function (e)
{
    var container = $(".popover.bottom.service-type");
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
            url: baseUrl+'/itemsProducts/ProductService/addServiceType',       
            data:formData,
            datatype:'json',
            success:function(data){
                if(data == '1'){ 
                $('#addnewCustomerPopup').hide();               
                e.stopPropagation();
                window.location.assign("<?php echo CController::createUrl('ProductService/View')?>"); 
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

function updateServiceType(id){ 
    if($('#servicetypeNewName'+id).val()!=""){
        var formData = new FormData($('#frm-update-service-type-'+id)[0]);  
        formData.append('id_service_type',id);     
        if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({
                type:'POST',
                url: baseUrl+'/itemsProducts/ProductService/updateServiceType',
                data:formData,
                datatype:'json',
                success:function(data){             
                    if(data == '1'){ 
                    $('#updateServiceTypePopup'+id).hide();  
                    window.location.assign("<?php echo CController::createUrl('ProductService/View')?>"); 
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
function deleteServiceType(id){
    if (confirm("Bạn có thật sự muốn xóa?")) {  
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsProducts/ProductService/deleteServiceType',    
            data: {"id":id},   
            success:function(data){
                if(data == '1')
                {                    
                    window.location.assign("<?php echo CController::createUrl('ProductService/View')?>"); 
                }                 
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        });
    }      
}
function countservice(id){
     $.ajax({
        type:'POST',
        url: baseUrl+'/itemsProducts/ProductService/countservice', 
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
$(document).ready(function() {
    $('#example-enableCollapsibleOptGroups-enableClickableOptGroups').multiselect({
        enableClickableOptGroups: true,
        enableCollapsibleOptGroups: true
    });
});

$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();
    var customer_action = $(".customersActionHolder").height();  

    $('#profileSideNav').height(windowHeight-header);
    $('.customerListContainer').height(windowHeight-header);

    $('#customerList').css('max-height', windowHeight-header-customer_action-80);
    
});
$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();
    var customer_action = $(".customersActionHolder").height();  

    $('#profileSideNav').height(windowHeight-header);
    $('.customerListContainer').height(windowHeight-header);

    $('#customerList').css('max-height', windowHeight-header-customer_action-80);
    
});

$( document ).ready(function() {
    detailServiceType(0);
});


</script>







