<div class="blur" id="edit-package-blur-<?php echo $dtp['id'];?>">

<div class="rg-constrained edit-package-container" id="edit-package-container-<?php echo $dtp['id'];?>" style="padding:20px;position: fixed;top: 2%;right: 0;left: 0;width: 750px;height: auto;margin: 0 auto;background: #ffffff;border-radius: 3px;z-index: 999;">

        <div class="col-md-12">


                

<div class="modal-header popHead sHeader" style="">
   <a class="btn_close close_p" data-dismiss="modal" aria-label="Close"></a>
    <h5>Chỉnh Sửa Gói Dịch Vụ</h5>
</div>
<form class="ud-package-form" id="ud-package-form-<?php echo $dtp['id'];?>" runat="server" action="" onsubmit="return false;" method="post">
                           

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
                                                <div class="form-group margin-bottom-05em required" id="ud-package-name-<?php echo $dtp['id'];?>">
                                                    <span class="" for="name_package">Tên gói dịch vụ</span>
                                                    <input class="form-control" id="name_package_<?php echo $dtp['id'];?>" name="name_package" type="text" value="<?php echo $dtp['name'];?>">
                                                </div>
                                                 <div class="form-group margin-bottom-05em" id="ud-package-code-<?php echo $dtp['id'];?>">
                                                    <span class="" for="code_package">Mã gói dịch vụ</span>  
                                                    <input class="form-control" id="code_package_<?php echo $dtp['id'];?>" name="code_package" type="text" value="<?php echo $dtp['code'];?>">
                                                    <input id="id_package" name="id_package" type="hidden" value="<?php echo $dtp['id'];?>">
                                                   
                                                    
                                                </div>
                                            </div>

                                            <div class="col-sm-6 " style="padding-top:15px;">
                                               <div class="rg-row">
                                                    <div class="col-md-4">
                                                        <div class="timely-image timely-image-centered">
                                                            <img style="width:90%;" class="img-responsive" src="<?php echo $baseUrl; ?>/upload/package_image/<?php if($dtpi['name_upload']) echo "md/".$dtpi['name_upload']; else echo "photo_normal.png";?>" alt="" id="blahn-<?php echo $dtp['id'];?>">
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-8">
                                                        <p style="font-size:11.5px;">Định dạng được chấp nhận: PNG, GIF hoặc JPEG. Kích thước tối đa là 2.0MB.</p>
                                                        <span id="upload" style="position: relative; overflow: hidden; direction: ltr;"> <!-- Required for IE -->
                                                        <span id="upload"> <!-- Required for IE -->
                                                        <a class="btn btn_bookoke" type="button" name="upload" id="upload" value="Upload"><i class="fa fa-arrow-circle-o-up"></i>&nbsp;Tải ảnh mới</a> 
                                                        </span>
                                                        <input multiple="multiple" type="file" id="image_package_<?php echo $dtp['id'];?>" name="image_package" onchange="readURLN(this,<?php echo $dtp['id'];?>)" style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 20px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0;">
                                                        </span>
                                                    </div>                                                 
                                                </div>
                                            </div>
                                        </div>
                                         
                                        <div class="form-group margin-bottom-05em" id="ud-package-line-<?php echo $dtp['id'];?>">
                                            <span class="" for="PackageLineId">Nhóm gói dịch vụ</span>
                                            <?php
                                                $package_line = array();
                                                foreach($pl_all as $temp){
                                                    $package_line[$temp['id']] = $temp['name'];
                                                }                            
                                                echo CHtml::dropDownList("id_package_line_".$dtp['id']."",'',$package_line,array('class'=>'form-control','empty' => 'Chọn nhóm sản phẩm','options'=>array($dtp['id_package_line']=>array('selected'=>true))));
                                            ?>     
                                        </div>

                                        <div class="form-group margin-bottom-05em ">
                                            <span class="" for="description_package">Mô tả</span>
                                            <span class="char-count-container">   
                                                <textarea class="char-count-1000 form-control" cols="20" id="description_package" name="description_package" rows="2"><?php echo $dtp['description'];?></textarea>
                                            </span>
                                        </div>

                                        <div class="rg-row">
                                            <div class="col-sm-4">
                                                <div class="form-group margin-bottom-05em" id="ud-package-costprice-<?php echo $dtp['id'];?>">
                                                    <span for="costprice_package">Giá vốn</span> <a class="hide warning-icon-offset tip-init" href="javascript:void(0);" rel="popover" data-content="You have set your cost price higher than your retail price. Is this what you intended?" data-original-title="Cost price exceeds retail price">&nbsp;<i class="fa fa-exclamation-circle fa-fw fa-lg text-danger">&nbsp;</i></a>
                                                    <div class="input-group">
                                                        
                                                        <input value="<?php echo $dtp['cost_price'];?>" class="form-control price-input cost-price autoNum" onkeypress=" return isNumberKey(event)" id="costprice_package_<?php echo $dtp['id'];?>" name="costprice_package" type="text">
                                                        <span class="input-group-addon">VND</span>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group margin-bottom-05em" id="ud-package-price-<?php echo $dtp['id'];?>">
                                                    <span class="" for="price_package">Giá bán</span>
                                                    <div class="input-group">
                                                        
                                                        <input value="<?php echo $dtp['price'];?>" class="form-control price-input retail-price autoNum" onkeypress=" return isNumberKey(event)" id="price_package_<?php echo $dtp['id'];?>" name="price_package" type="text">
                                                        <span class="input-group-addon">VND</span>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                             <div class="col-sm-4">
                                                <div class="form-group margin-bottom-05em">
                                                    <span class="" for="tax_package">Thuế</span>
                                                    <div class="input-group">
                            
                                                        
                                                        <input class="form-control tax-input" onkeypress=" return isNumberKey(event)" id="tax_package" name="tax_package" type="text" value="<?php echo $dtp['tax'];?>">                             
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
                    <span class="" for="">Thời gian hợp lệ từ ngày bán</span><br>
                    <div class="duration-hide hide">
                        No restriction&nbsp;<a href="javascript:void(0);">+ Add</a>
                    </div>
                    <div class="inline-group duration-show">
                        


<div class="input-group">
    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
    <input onkeypress="return isNumberKey(event)" min="0" class="form-control input-narrow" id="lenght_package" name="lenght_package" type="number" value="<?php echo $dtp['lenght'];?>" data-parsley-id="">
    <span class="help-block validation-error" id=""></span>
</div>&nbsp;&nbsp;
<select class="form-control" id="duration_unit_package" name="duration_unit_package" data-parsley-id="">
<option <?php if($dtp['duration_unit']==3) echo "selected";?> value="3">Ngày</option>
<option <?php if($dtp['duration_unit']==4) echo "selected";?> value="4">Tuần</option>
<option <?php if($dtp['duration_unit']==5) echo "selected";?> value="5">Tháng</option>
<option <?php if($dtp['duration_unit']==6) echo "selected";?> value="6">Năm</option>
</select><span class="help-block validation-error" id=""></span>
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                
                <div class="form-group ">
                    <span class="" for="startdate_package">Ngày bắt đầu</span>
                    <input onchange="udredemptionStartDate(<?php echo $dtp['id'];?>);" class="form-control hasDatepicker" data-custom="" id="startdate_package_<?php echo $dtp['id'];?>" name="startdate_package" type="date" min="<?php echo date('Y-m-d',strtotime($dtp['redemption_start_date']));?>" value="<?php echo $dtp['redemption_start_date'];?>"><span class="help-block validation-error"></span>
                    
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group ">
                    <span class="" for="enddate_package">Ngày kết thúc</span>
                    <input onchange="udredemptionEndDate(<?php echo $dtp['id'];?>);" class="form-control hasDatepicker" id="enddate_package_<?php echo $dtp['id'];?>" name="enddate_package" type="date" min="<?php echo date('Y-m-d',strtotime($dtp['redemption_start_date']));?>" value="<?php echo $dtp['redemption_end_date'];?>"><span class="help-block validation-error"></span>
                    
                </div>
            </div>
        </div>

        
       
    </div>
</div>

        
    <div class="rg-row" id="">

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
                                    <div class="col-sm-6 form-group" id="ud-service-id<?php echo $dtp['id'];?>">
                                       <select class="form-control" id="idservice<?php echo $dtp['id'];?>" name="idservice" data-parsley-id="">
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
   
                                    <span class="help-block validation-error" id=""></span>
                                        
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="#" class="btn btn_bookoke" onclick="addServices(<?php echo $dtp['id'];?>);" data-bind="click: function(data, event) { $root.addNewConcessionItem(data, event, 1) }">Thêm dịch vụ</a>
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
            <div class="col-md-12 margin-bottom-05em">
                <div data-bind="visible: concessionItems().length == 0" class=" alert alert-info" style="display: none;">There are currently no items set up as part of this package</div>
                
                <table id="package_item<?php echo $dtp['id'];?>" data-bind="visible: concessionItems().length > 0" class="table table-middle table-left <?php if(empty($dtps)) echo "hidden";?>">
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
                       
                        <?php 
                        if(!empty($dtps))
                        {  
                        foreach($dtps as $n)
                        {      
                        $csn=new CsService;                       
                        $dtcsn=$csn->findByPk($n['id_service']);     
                        if($n['type']==7)
                        {
                            $type="Visits";
                        }    
                        elseif($n['type']==2) 
                        {
                            $type="Giờ";
                        }  
                        elseif($n['type']==1)
                        {
                            $type="Phút";
                        } 
                        else
                        {
                            $type="Không có giới hạn mặc định";
                        }       
                        ?>
                        <tr id="pss<?php echo $dtp['id'];?><?php echo $n['id_service'];?>">
                            <td style="width: 50%;" data-bind="text: name"><?php echo $dtcsn['name'];?></td>
                            <td style="width: 30%;" data-bind="text: limitDescription" id="public-labels-<?php echo $dtp['id'];?><?php echo $n['id_service'];?>"><?php echo $n['quantity'];?> <?php echo $type;?></td>                            
                             <td>
                                <a class="btn btn-info btn-sm" onclick="editLimits(<?php echo $dtp['id'];?>,<?php echo $n['id_service'];?>);" data-bind="click: editLimits" href="javascript:void(0);">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a style="margin-left:1px;" class="pop btn btn-danger btn-sm" data-bind="attr: {'data-content': deleteHtml()}" onclick="deleteLimits(<?php echo $dtp['id'];?>,<?php echo $n['id_service'];?>);" href="javascript:void(0);" data-original-title="Delete package item" data-content="<a class=&quot;btn bln-close&quot;>
                                    <i class=&quot;fa fa-times&quot;></i> Hủy</a> <a href=&quot;#&quot; data-concession-item-id=&quot;470402&quot; data-service-id=&quot;470402&quot; class=&quot;btn btn-danger concession-item-delete bln-close&quot;><i class=&quot;fa fa-trash-o&quot;></i> Delete</a>">
                                    <i class="fa fa-trash-o"></i>
                                </a>                                
                            </td>

                            <td class="hds<?php echo $dtp['id'];?>" style="display:none;"><?php echo $n['id_service'];?></td>                            
                            <td id="amount<?php echo $dtp['id'];?><?php echo $n['id_service'];?>" style="display:none;"><?php echo $n['quantity'];?></td>
                            <td id="vle<?php echo $dtp['id'];?><?php echo $n['id_service'];?>" style="display:none;"><?php echo $n['type'];?></td>
                        </tr>
                        <?php 
                        }
                        }
                        ?>
                        
                    </tbody>

                </table>
               
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
                                            <button type="" id="btn-add-items<?php echo $dtp['id'];?>" <?php if(empty($dtps)) echo "disabled";?> onclick="updatePackage(<?php echo $dtp['id'];?>);" class="btn btn_bookoke">Cập nhật</button>
                                            </span> 
                                            </div>
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

<div id="editlimitPopup<?php echo $dtp['id'];?>" class="popover top in edlimitPopup" style="top: 490px; left: 1040px; display: none; z-index: 5001;border: 0px;background-color: transparent;box-shadow: 0 0px 0px rgba(0, 0, 0, 0);"><div class="arrow"></div><div class="popover-inner" style="padding:0px;background: #fff;"><h3 class="popover-title">Chỉnh sửa thành phần</h3><div class="popover-content"><div><form class="form-vertical"><table class="table-condensed table-not-bordered table-no-decoration concession-item-limit-table"><thead><tr><th class="left">Số lượng</th><th>Kiểu</th></tr></thead><tbody><tr><td style="width: 45%"><input id="ipt-editlimit<?php echo $dtp['id'];?>" class="input-small form-control durationValue" type="number" value="1" min="1" placeholder="" max="9999"></td><td style="width: 55%"><select class="form-control" id="ConcessionItemDurationOptions<?php echo $dtp['id'];?>" name="ConcessionItemDurationOptions"><option value="7">Visits</option><option value="2">Giờ</option><option value="1">Phút</option></select></td></tr></tbody></table><div class="text-right" style="margin-top: 10px">&nbsp;&nbsp;<a href="javascript:void(0);" class="btn  bln-close"><i class="fa fa-remove"></i> Hủy</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="btn btn-primary" id="btn-editlimit<?php echo $dtp['id'];?>" ><i class="fa fa-ok"></i>OK</a></div></form></div></div></div></div> 

</div>