<?php 
$baseUrl = Yii::app()->baseUrl;

$v = new CDbCriteria(); 
$v->addCondition('t.status_proline = 1');
$v->order= 'id DESC';
$pl_all=$pl->findAll($v);

$cs=new CsService;
$n = new CDbCriteria(); 
$n->addCondition('t.status = 1');
$n->order= 'id DESC';
$cs_all=$cs->findAll($n);

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
.table-package>thead{
    color: #fff;
    background-color: rgba(115, 149, 158, 0.80);
}
.table-package>tbody {
    display:block;
    height:50px;
    overflow:auto;
}
.table-package>thead, .table-package>tbody tr {    
    display:table;
    width:100%;
    table-layout:fixed;/* even columns width , fix width of table too*/
}
.table-package>thead {
    width: calc( 100% - 1em )/ scrollbar is average 1em/16px width, remove it from thead width /
}
.at{
    background-color: #c4e2c7 !important;
}
.table-left th,.table-left td{
    text-align: left;
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
                                                                                        <h3 style="width: 170px;">Nhóm gói dịch vụ</h3>
                                            <a class="btn_plus" id="newCustomer" data-delay="0" data-placement="right"></a>
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
                                            <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Thêm nhóm gói dịch vụ</h3>
                                            <div class="popover-content" style="width:225px;">
                                                <input type="text" required="" oninvalid="this.setCustomValidity('Vui lòng nhập tên nhóm gói dịch vụ.')" oninput="setCustomValidity('')" class="form-control" id="packageNewName" name="packageNewName" placeholder="Tên nhóm gói dịch vụ" style="margin-bottom:10px;width:96%;">                                                
                                                <button id="addnewCustomer" class="btn btn_bookoke btn_w">Tạo mới</button>
                                                <button id="cancelNewCustomer" type="reset" class="btn btn_cancel" style="min-width: 94px;margin-right: 0px;">Hủy</button>
                                            </div>
                                        </form>
                                    </div>

                                    

                                    <div id="customerListHolder" class="customerListHolder">  
                                    <ul id="customerList" style="max-height: 770px;">
                                       
                                                    <li id="c0" onclick="detailPackageLine(0);" class="n active">
                                                                            
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
                                                     <li id="c<?php echo $v->id;?>" onclick="detailPackageLine(<?php echo $v->id;?>);" class="n">
                                        
                                                        <span class="jqTransformCheckboxWrapper" style="display:none;">
                                                            <a href="#" class="jqTransformCheckbox"></a>
                                                            <input type="checkbox" value="<?php echo $v->id;?>" class="fl" style="display : none;">
                                                        </span>
                                                        
                                                       
                                                        <label class="fl"> <?php echo titleCase($v['name']);?> </label>                                                       
                                                        <img id="ltn<?php echo $v->id;?>" class="hide" onclick="showUpdatePackageLine(<?php echo $v->id;?>);" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/edit_cam.png" style="float:right;margin: 9px 6px 0 0;width: 20px;height: 20px;">
                                                        <div class="clearfix"></div>
                                                     </li> 
                                                     <div id="updatePackageLinePopup<?php echo $v->id;?>" class="popover bottom package-line" style="display: none;padding:0px;top:150px;left:500px;">
                                                        <form id="frm-update-package-line-<?php echo $v->id;?>" onsubmit="return false;" class="form-horizontal">                                                                                                 
                                                            <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Chỉnh sửa nhóm gói dịch vụ</h3>
                                                            <div class="popover-content" style="width:225px;">
                                                                <input type="text" required="" oninvalid="this.setCustomValidity('Vui lòng nhập tên nhóm gói dịch vụ.')" oninput="setCustomValidity('')" class="form-control" id="packagelineNewName<?php echo $v->id;?>" name="packagelineNewName" value="<?php echo $v['name'];?>" placeholder="Tên nhóm gói dịch vụ" style="margin-top:0px;padding: 6px 12px;margin-bottom:10px;width:98%;">
                                                                <button onclick="deletePackageLine(<?php echo $v->id;?>);" class="btn btn_delete" style="min-width: 94px;margin-right: 0px;">Xóa</button>
                                                                <button onclick="updatePackageLine(<?php echo $v->id;?>);" class="btn btn_bookoke">Cập nhật</button>
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
                <div id="" class="col-sm-7 col-md-9">





                

                    <div class="rg-constrained">

    <div class="rg-row">
        <div class="col-md-12">
<div class="t-settings-head affix-top" data-spy="affix" data-offset-top="105" style="margin-top:10px;">
                                        <h1>Tất cả <label class="count" id="countservice"></label></h1>
    <div class="t-settings-head__actions">  
            <div class="input-group" style="display:inline-flex;width:300px;margin-right:30px;">
              <input type="text" class="form-control" id="searchPackage" placeholder="Tìm kiếm theo mã và tên gói dịch vụ">
              <div class="input-group-addon" onclick="searchPackage();"  id="glyphicon-search" style="padding-right:25px;cursor:pointer;"><span class="glyphicon glyphicon-search"></span></div>
           </div>   
            <!-- <button class="btn btn-default dropdown-toggle" type="button" id="btnReport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right:5px;">Báo cáo
                <span class="caret"></span>
            </button>  -->         
            <a href="javascript:void(0);" class="btn_plus" id="add_package" onclick="" data-delay="0" data-placement="right"></a>
    </div>
   
</div>
<div id="detailPackageLine" style="margin-top:20px;" >


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















<div class="blur" id="add-package-blur">

<div class="rg-constrained" id="package-container">

        <div class="col-md-12">


                
 
<div class="modal-header popHead sHeader" style="">
   <a class="btn_close close_p" data-dismiss="modal" aria-label="Close"></a>
    <h5>Tạo Gói Dịch Vụ Mới</h5>
</div> 
<form class="package-form" id="package-form"  runat="server" action="" onsubmit="return false;" method="post">
<input id="XeroAuthError" name="XeroAuthError" type="hidden" value="False">
<input name="__RequestVerificationToken" type="hidden" value="coTO7fNiICrHN1GReqJ-KMIP5nWTduPaPUkDBDvAW593aEKWnN9EdG42_UHeTMWSlsvj8AASfAHbdZ5ExIOEvXDeVkPnwH1jEGSpwiYplrEqA3BBFytebHeoZXOpHJgQdCcZp5Cw-ySRxH8Dm0xBDVaH1ngsMGH8KMLgvEIOXL5fckcI0">    

    <div class="rg-row">

        <div class="col-md-12" style="margin-top:10px;">

            <h5>Chi tiết gói dịch vụ</h5>
           

        </div>
        <div class="col-md-12">

            <div class="rg-row">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">

                </div>
            </div>

            <div class="rg-row">
                <div class="col-sm-6">
                    <div class="form-group margin-bottom-05em required" id="rq-package-name">
                        <span class="" for="Package_Name">Tên gói dịch vụ</span>
                        <input class="form-control" id="Package_Name" name="Package_Name" type="text" value="">
                    </div>
                     <div class="form-group margin-bottom-05em required" id="rq-package-code">
                        <span class="" for="Package_Code">Mã gói dịch vụ</span>
                        <input class="form-control" id="Package_Code" name="Package_Code" type="text" value="">                   
                    </div>
                </div>

                <div class="col-sm-6 " style="padding-top:15px;">
                   <div class="rg-row">
                        <div class="col-md-4">
                            <div class="timely-image timely-image-centered">
                                <img style="width:90%;" class="img-responsive" src="<?php echo $baseUrl; ?>/upload/package_image/photo_normal.png" alt="" id="blah">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <p style="font-size:11.5px;">Định dạng được chấp nhận: PNG, GIF hoặc JPEG. Kích thước tối đa là 2.0MB.</p>
                            <span id="upload" style="position: relative; overflow: hidden; direction: ltr;"> <!-- Required for IE -->
                            <span id="upload"> <!-- Required for IE -->
                            <a class="btn btn_bookoke" type="button" name="upload" id="upload" value="Upload"><i class="fa fa-arrow-circle-o-up"></i>&nbsp;Tải ảnh mới</a> 
                            </span>
                            <input multiple="multiple" type="file" id="Package_Image" name="Package_Image" style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 20px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0;">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
             
            <div class="form-group margin-bottom-05em" id="rq-package-line">
                <span class="" for="PackageLineId">Nhóm gói dịch vụ</span>
                <?php
                    $package_line = array();
                    foreach($pl_all as $temp){
                        $package_line[$temp['id']] = $temp['name'];
                    }                            
                    echo CHtml::dropDownList('PackageLineId','',$package_line,array('class'=>'form-control','empty' => 'Chọn nhóm gói dịch vụ','options'=>array()));
                ?>     
            </div>

            <div class="form-group margin-bottom-05em ">
                <span class="" for="Package_Description">Mô tả</span>
                <span class="char-count-container">  
                    <textarea class="char-count-1000 form-control" cols="20" id="Package_Description" name="Package_Description" rows="2"></textarea> 
                </span>
            </div>

            <div class="rg-row">
                <div class="col-sm-4">
                    <div class="form-group margin-bottom-05em" id="rq-package-costprice">
                        <span for="Package_CostPrice">Giá vốn</span> <a class="hide warning-icon-offset tip-init" href="javascript:void(0);" rel="popover" data-content="You have set your cost price higher than your retail price. Is this what you intended?" data-original-title="Cost price exceeds retail price">&nbsp;<i class="fa fa-exclamation-circle fa-fw fa-lg text-danger">&nbsp;</i></a>
                        <div class="input-group">
                            
                            <input value="" class="form-control price-input cost-price autoNum" onkeypress=" return isNumberKey(event)" id="Package_CostPrice" name="Package_CostPrice" type="text">
                            <span class="input-group-addon">VND</span>
                        </div>

                        
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group margin-bottom-05em" id="rq-package-price">
                        <span class="" for="Package_Price">Giá bán</span>
                        <div class="input-group">
                            
                            <input value="" class="form-control price-input retail-price autoNum" onkeypress=" return isNumberKey(event)" id="Package_Price" name="Package_Price" type="text">
                            <span class="input-group-addon">VND</span>
                        </div>
                        
                    </div>
                </div>
                 <div class="col-sm-4">
                    <div class="form-group margin-bottom-05em">
                        <span class="" for="Package_Tax">Thuế</span>
                         <div class="input-group">
                            
                            
                            <input class="form-control tax-input" onkeypress=" return isNumberKey(event)" id="Package_Tax" name="Package_Tax" type="text" value="">                             
                               <div class="input-group-addon">%</div> 
                        </div>
                    </div>
                </div>
            </div>

           

        </div>
    </div>
    


    <div class="rg-row">
    <div class="col-md-12" style="margin-top:10px;">
        <h5>Hiệu lực</h5>
       
    </div>

    <div class="col-md-12">

        <div class="rg-row">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">

            </div>
        </div>
        
        <div class="rg-row">
            <div class="col-sm-6">
                <div class="form-group ">
                    <span class="" for="ValidityDuration_Duration">Thời gian hợp lệ từ ngày bán</span><br>
                    <div class="duration-hide hide">
                        No restriction&nbsp;<a href="javascript:void(0);">+ Add</a>
                    </div>
                    <div class="inline-group duration-show">
                        


<div class="input-group">
    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
    <input onkeypress="return isNumberKey(event)" min="0" class="form-control input-narrow" id="Package_Lenght" name="Package_Lenght" type="number" value="" data-parsley-id="4094"><span class="help-block validation-error" id="parsley-id-4094"></span>
</div>&nbsp;&nbsp;
<select class="form-control" id="Package_Duration_Unit" name="Package_Duration_Unit" data-parsley-id="0024"><option value="3">Ngày</option>
<option value="4">Tuần</option>
<option value="5">Tháng</option>
<option value="6">Năm</option>
</select><span class="help-block validation-error" id="parsley-id-0024"></span>
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                
                <div class="form-group ">
                    <span class="" for="Package_StartDate">Ngày bắt đầu</span>
                    <input onchange="redemptionStartDate();" class="form-control hasDatepicker" data-custom="" id="Package_StartDate" name="Package_StartDate" type="date" min="<?php echo date("Y-m-d");?>" value="" data-parsley-id="7894"><span class="help-block validation-error" id="parsley-id-7894"></span>
                    
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group ">
                    <span class="" for="Package_EndDate">Ngày kết thúc</span>
                    <input onchange="redemptionEndDate();" class="form-control hasDatepicker" id="Package_EndDate" name="Package_EndDate" type="date" min="<?php echo date("Y-m-d");?>" value="" data-parsley-id="0178"><span class="help-block validation-error" id="parsley-id-0178"></span>
                    
                </div>
            </div>
        </div>

        
       
    </div>
</div>

     

    
    <div class="rg-row" id="concession-items">
    <input data-bind="value: ko.toJSON(concessionItems())" id="ConcessionItemJson" name="ConcessionItemJson" type="hidden" value="[]">
    <div class="col-md-12">
        <h5>Thành phần</h5>
        
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
                <div class="tabbable">
                    <!-- <ul class="nav nav-tabs" style="margin-left: 0;margin-bottom: 24px;">
                            <li class="active">
                                <a href="#specific-service" data-toggle="tab">Specific service</a>
                            </li>
                            <li class=""><a href="#any-service" data-toggle="tab">Any service</a></li>
                    </ul> -->
                    <div class="tab-content">
                            <div class="tab-pane active" id="specific-service">
                                <div class="rg-row" data-bind="visible: showAddServiceTab()">
                                    <div class="col-sm-6 form-group" id="rq-service-id">
                                       <select class="form-control" id="ServiceId" name="ServiceId" data-parsley-id="1712">
                                       <optgroup label="" value="">
                                            <option value=""></option>
                                        </optgroup>
                                            <optgroup label="Chọn dịch vụ" value="">
                                            <?php 
                                            foreach ($cs_all as $t) 
                                            {
                                            ?>
                                            <option value="<?php echo $t['id'];?>"><?php echo $t['name'];?></option>
                                            <?php 
                                            }
                                            ?>                                           
                                            </optgroup>
                                        </select>
   
<span class="help-block validation-error" id="parsley-id-1712"></span>
                                        
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="#" class="btn btn_bookoke" onclick="addService();" data-bind="click: function(data, event) { $root.addNewConcessionItem(data, event, 1) }">Thêm dịch vụ</a>
                                    </div>
                                </div>
                                <p class="alert alert-info" data-bind="visible: !showAddServiceTab()" style="display: none;">Your package may only contain either services or classes. To add a service first delete any classes then select the service to add.</p>
                            </div>
                                                <div class="tab-pane" id="any-service">
                            <p>
                                Add an item to this package that can be redeemed against any service that you offer.
                            </p>
                            <a href="#" class="btn btn-success btn-sm btn-padded" data-bind="click: function(data, event) { $root.addNewConcessionItem(data, event, 2) }">Add "any service" item</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rg-row">
            <div class="col-md-12">
                <div data-bind="visible: concessionItems().length == 0" class=" alert alert-info" style="display: none;">There are currently no items set up as part of this package</div>
                <table id="package_items" data-bind="visible: concessionItems().length > 0" class="table table-middle table-left hidden">
                    <thead>
                        <tr>
                            <th style="width: 50%">Tên</th>
                            <th style="width: 30%">
                                Giới hạn                               
                            </th>
                            <th></th>                            
                        </tr>
                    </thead>
                    <tbody data-bind="foreach: { data: concessionItems() }">
                       
                    
                    </tbody>
                </table>
            </div>
        </div>



     

       
    </div>
</div>



    <div class="rg-row" style="margin-top:10px;">
        <div class="col-md-12">
            <div class="form-actions text-right">
                <a href="javascript:void(0);" class="btn btn_cancel close_p">Hủy</a>
                <button disabled id="btn-add-package" type="submit" class="btn btn_bookoke">Xác nhận</button>
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

<div id="editlimitPopup" class="popover top in" style="top: 510px; left: 1040px; display: none; z-index: 5001;border: 0px;background-color: transparent;box-shadow: 0 0px 0px rgba(0, 0, 0, 0);"><div class="arrow"></div><div class="popover-inner" style="padding:0px;background: #fff;"><h3 class="popover-title">Chỉnh sửa thành phần</h3><div class="popover-content"><div><form class="form-vertical"><table class="table-condensed table-not-bordered table-no-decoration concession-item-limit-table"><thead><tr><th class="left">Số lượng</th><th>Kiểu</th></tr></thead><tbody><tr><td style="width: 45%"><input id="ipt-editlimit" class="input-small form-control durationValue" type="number" value="1" min="1" placeholder="" max="9999"></td><td style="width: 55%"><select class="form-control" id="ConcessionItemDurationOptions" name="ConcessionItemDurationOptions"><option value="7">Visits</option><option value="2">Giờ</option><option value="1">Phút</option></select></td></tr></tbody></table><div class="text-right" style="margin-top: 10px">&nbsp;&nbsp;<a href="javascript:void(0);" class="btn  bln-close"><i class="fa fa-remove"></i> Hủy</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="btn btn-primary" id="btn-editlimit" ><i class="fa fa-ok"></i>OK</a></div></form></div></div></div></div> 

</div>













<script type="text/javascript">
var baseUrl = $('#baseUrl').val();
var templock = 0;


function showAddPackage(){

var elem = $('#add-package-blur')[0];


  $('#add_package').on('click',function(e){

    $(elem).fadeToggle(200,function(){
    });
    e.stopPropagation();
});


$('body').on('click',function(e){
    if(templock == 0){
        if($(e.target).closest($('#package-container')).length === 0){  
            if($(e.target).closest($('#editlimitPopup')).length === 0){ 
                if($(elem).is(':visible')){
                    templock = 1;
                    $(elem).fadeToggle(200,function(){
                        templock = 0;
                    });
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
showAddPackage();

function detailPackageLine(id){    
    var curpage=1;    
    $('.cal-loading').fadeIn('fast');
    $('.n').removeClass("active");   
    $("#c"+id).addClass("active");   
    $("#c"+id).find('code').removeClass("hide");  
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsProducts/Packages/detailPackageLine', 
        data: {"id":id,"curpage":curpage},   
        success:function(data){     
            $('#searchPackage').val('');        
            $('#detailPackageLine').html(data);
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
        url: baseUrl+'/itemsProducts/Packages/countservice', 
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
    var searchPackage= $('#searchPackage').val();     
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsProducts/Packages/detailPackageLine', 
        data:{"id":id,"curpage": curpage,"searchPackage": searchPackage},
        success:function(data){
            $('#detailPackageLine').html(data);
            $('.cal-loading').fadeOut('slow');
        },
        error: function(data){
            console.log("error");
            console.log(data);
        }
    });      
}
function searchPackage(){ 
    $('.cal-loading').fadeIn('fast');
    var id=$('.n.active').find('span').find('input').val();   
    var curpage=1;      
    var searchPackage= $('#searchPackage').val(); 
    $.ajax({
        type:'POST',
        url: baseUrl+'/itemsProducts/Packages/detailPackageLine', 
        data:{"id":id,"curpage": curpage,"searchPackage": searchPackage},
        success:function(data){
            $('#detailPackageLine').html(data); 
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

function error_add_package(){

    var status = true;

    if($('#Package_Name').val() == ''){
        status = false;       
        $('#rq-package-name').addClass('error');         
    }
    else{
        $('#rq-package-name').removeClass('error');
    }

    if($('#Package_Code').val() == ''){
        status = false;       
        $('#rq-package-code').addClass('error');            
    }
    else{
        $('#rq-package-code').removeClass('error');
    }

    if($('#PackageLineId').val() == ''){
        status = false;       
        $('#rq-package-line').addClass('error');      
    }
    else{
        $('#rq-package-line').removeClass('error');
    }

    if($('#Package_CostPrice').val() == ''){
        status = false;       
        $('#rq-package-costprice').addClass('error');         
    }
    else{
        $('#rq-package-costprice').removeClass('error');
    }

    if($('#Package_Price').val() == ''){
        status = false;       
        $('#rq-package-price').addClass('error');         
    }
    else{
        $('#rq-package-price').removeClass('error');
    } 

    return status;
}
function redemptionStartDate(){
    $('#Package_EndDate').removeAttr("min").attr("min", $('#Package_StartDate').val());    
}
function redemptionEndDate(){       
    $('#Package_StartDate').removeAttr("max").attr("max", $('#Package_EndDate').val());
}

// Package items
function error_add_service(){

    var status = true;

    var k = $('#ServiceId').val(); 

    $("#package_items > tbody > tr td:last-child").each(function(){       
        var td=$(this).html();     
        if(k == td){
            status = false; 
        }
        
    });

    return status;
}
function addService(){ 
    
    var selected = $('#ServiceId option:selected').text(); 
    if(selected!=""){
        if (error_add_service()) {
            var k = $('#ServiceId').val();
            $("#package_items").removeClass("hidden");
            $('#btn-add-package').removeAttr('disabled');
            $("#package_items").find('tbody')
            .append($('<tr id="ps'+k+'">')
                .append('<td data-bind="text: name">'+selected+'</td>')
                .append('<td data-bind="text: limitDescription" id="public-label-'+k+'">Không có giới hạn mặc định</td>')                
                .append($('<td>')
                    .append($('<a class="btn btn-info btn-sm" onclick="editLimit('+k+');" data-bind="click: editLimit" href="javascript:void(0);">')
                        .append('<i class="fa fa-edit"></i>')                        
                    )
                    .append($('<a class="pop btn btn-danger btn-sm" onclick="deleteLimit('+k+');" href="javascript:void(0);" data-original-title="Delete package item" data-content="<a class=&quot;btn bln-close&quot;><i class=&quot;fa fa-times&quot;></i> Cancel</a> <a href=&quot;#&quot; data-concession-item-id=&quot;470402&quot; data-service-id=&quot;470402&quot; class=&quot;btn btn-danger concession-item-delete bln-close&quot;><i class=&quot;fa fa-trash-o&quot;></i> Delete</a>">')  
                        .append('<i class="fa fa-trash-o"></i>')
                    )
                )
                .append('<td class="hd" style="display:none;">'+k+'</td>')
            );
        }
    }
    
}
function editLimit(k){    
    $('#btn-editlimit').attr('onclick','addEditLimit('+k+')'); 
    $('#ipt-editlimit').val('1');  
    $('#ConcessionItemDurationOptions').val('7'); 
    $('#editlimitPopup').fadeToggle('fast');
}
$('.bln-close').click(function(){ 
    $('#editlimitPopup').hide();    
});
function deleteLimit(k){   
    if (confirm("Bạn có thật sự muốn xóa?")) {  
        var evt = window.event || arguments.callee.caller.arguments[0];
        evt.preventDefault(); 
        $('#ps'+k).remove();
        if($('.hd').length == 0){
            $("#package_items").addClass("hidden"); 
            $('#btn-add-package').attr('disabled','disabled');
        }    
        evt.stopPropagation();
    }
}
$(document).mouseup(function (e)
{
    var container = $("#editlimitPopup");
    if (!container.is(e.target) 
        && container.has(e.target).length === 0) 
    {        
        container.hide();
    } 
});
function addEditLimit(k){ 

    var amount    = $('#ipt-editlimit').val();
    var type = $('#ConcessionItemDurationOptions option:selected').text();   
    var vle = $('#ConcessionItemDurationOptions').val();  
  
    $('#public-label-'+k).html(amount+" "+type); 

    if ($("#amount"+k).length > 0 || $("#vle"+k).length > 0){
       $('#amount'+k).html(amount);
       $('#vle'+k).html(vle);
    }
    else{
        $('#ps'+k).append('<td id="amount'+k+'" style="display:none;">'+amount+'</td>');
        $('#ps'+k).append('<td id="vle'+k+'" style="display:none;">'+vle+'</td>');
    }
    
    $('#editlimitPopup').hide(); 
}
// End Package items
function addPackage(){
    $('#btn-add-package').click(function(){
        if(error_add_package()){            
            $('.cal-loading').fadeIn('fast'); 

            var package_service = [];    
            $("#package_items > tbody > tr").each(function(){       
                var id_service=$(this).children('td:nth-child(4)').html(); 
                var quantity = $(this).children('td:nth-child(5)').html();
                var type = $(this).children('td:nth-child(6)').html();

                var response = {};
                response['id_service'] = id_service; 
                response['quantity'] = quantity==""?"":quantity;
                response['type'] = type==""?"":type;
                package_service.push(response);        
            });

            var formData = new FormData($('#package-form')[0]);   
            formData.append('Package_Service',JSON.stringify(package_service));      
            if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({
                type:'POST',
                url: baseUrl+'/itemsProducts/Packages/addPackage',
                data:formData,
                datatype:'json',
                success:function(data){                           
                    if (data == '-1') {                         
                        $('#rq-package-code').addClass('error');                     
                        $('.cal-loading').fadeOut('slow');
                        return false;
                    }
                    else if(data == '1')
                    {
                        $('#rq-package-code').removeClass('error');
                        $('.cal-loading').fadeOut('slow'); 
                        window.location.assign("<?php echo CController::createUrl('Packages/View')?>"); 
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
addPackage();



function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#Package_Image").change(function(){
    readURL(this);
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
function showUpdatePackageLine(id){    
    var evt = window.event || arguments.callee.caller.arguments[0];
    evt.preventDefault();
    var position = $('#ltn'+id).position();    
    $('#updatePackageLinePopup'+id).css({"top": position.top-50, "left": position.left+50});
    $('#updatePackageLinePopup'+id).fadeToggle('fast');
    evt.stopPropagation();
}

$(document).mouseup(function (e)
{
    var container = $(".popover.bottom.package-line");
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
            url: baseUrl+'/itemsProducts/Packages/addPackageLine',          
            data:formData,
            datatype:'json',
            success:function(data){
                if(data == '1'){ 
                $('#addnewCustomerPopup').hide();               
                e.stopPropagation();
                window.location.assign("<?php echo CController::createUrl('Packages/View')?>"); 
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
function updatePackageLine(id){ 
    if($('#packagelineNewName'+id).val()!=""){
        var formData = new FormData($('#frm-update-package-line-'+id)[0]);  
        formData.append('id_package_line',id);     
        if (!formData.checkValidity || formData.checkValidity()) {
            jQuery.ajax({
                type:'POST',
                url: baseUrl+'/itemsProducts/Packages/updatePackageLine',
                data:formData,
                datatype:'json',
                success:function(data){             
                    if(data == '1'){ 
                    $('#updatePackageLinePopup'+id).hide();  
                    window.location.assign("<?php echo CController::createUrl('Packages/View')?>"); 
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
function deletePackageLine(id){
    if (confirm("Bạn có thật sự muốn xóa?")) {  
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsProducts/Packages/deletePackageLine',    
            data: {"id":id},   
            success:function(data){
                if(data == '1')
                {                    
                    window.location.assign("<?php echo CController::createUrl('Packages/View')?>");  
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
    detailPackageLine(0);
});
</script>







