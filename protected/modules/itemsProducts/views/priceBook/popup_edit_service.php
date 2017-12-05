
<div class="blur" id="edit-service-blur-<?php echo $v['id'];?>">

    <div class="rg-constrained edit-service-container" id="edit-service-container-<?php echo $v['id'];?>" style="padding:20px;position: fixed;top: 2%;right: 0;left: 0;width: 750px;height: auto;margin: 0 auto;background: #ffffff;border-radius: 3px;z-index: 999;">

              
        <div class="col-md-12">                              
          
            <div class="modal-header popHead sHeader" style="margin-left: -35px;margin-right: -35px;">

                <a class="btn_close close_s" data-dismiss="modal" aria-label="Close"></a>
                <h5>Chỉnh Sửa Dịch Vụ</h5>

            </div> 

            <form class="ud-service-form" id="ud-service-form-<?php echo $v['id'];?>" action="" onsubmit="return false;" method="post" novalidate="">
             <div class="t-settings-head">                               
        </div>

        <div class="rg-row">
                                       
            <div class="col-md-12" style="margin-top:10px;">
                                            
                <h5>Mô tả dịch vụ</h5>     

                <div class="rg-row">

                    <div class="col-sm-4">
                        <div class="form-group">
                            <span>Mã dịch vụ</span>
                            <input id="id_pricebook_service" name="id_pricebook_service" type="hidden" value="<?php echo $v['id'];?>">
                            <input disabled class="form-control" type="text" value="<?php echo $v['code'];?>">  
                        </div>
                    </div>

                    <div class="col-sm-4">                     
                        <div class="form-group">
                            <span>Tên dịch vụ</span>
                            <div class="input-group">

                                <div class="input-group-addon">
                                    <div class="btn-group service-color-pallet-holder">
                                        <a class="dropdown-toggle">
                                            <code class="<?php echo $v['color'];?>"></code>
                                            <span class="caret"></span>
                                        </a>                                                       
                                    </div>
                                </div>

                                <input disabled class="form-control" type="text" value="<?php echo $v['name'];?>">
                               
                            </div>
                        <span class="help-block validation-error" id="parsley-id-0932-<?php echo $v['id'];?>"></span></div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <span>Nhóm dịch vụ</span>                          
                            <?php
                            $group_service = array();
                            foreach($model->getListServiceType() as $temp){
                                $group_service[$temp['id']] = $temp['name'];
                            }                            
                            echo CHtml::dropDownList('id_service_type','',$group_service,array('disabled'=>'disabled','class'=>'form-control','empty' => 'Chọn nhóm dịch vụ','options'=>array($v['id_service_type']=>array('selected'=>true))));
                            ?>                    
                   
                        </div>
                    </div>
                   

                </div>
                                 

                <div class="form-group">
                    <span class="" for="description_service">Mô tả</span>
                    <span class="char-count-container">
                        <textarea disabled class="char-count-1000 form-control" cols="20" rows="2"><?php echo $v['description'];?></textarea>
                    </span>
                 
                </div>
                               
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input disabled <?php if($v['status_hiden']==1) echo "checked"; else echo "";?> type="checkbox">
                             Khách hàng có thể đăng kí dịch vụ trực tuyến
                        </label>
                        
                    </div>
       

                </div>                                   

                <div class="clearfix"></div>

                <div class="rg-row">

                    <div class="col-sm-3">

                        <div class="form-group ">

                            <span class="" for="price_service">Giá dịch vụ</span><br>

                            <div class="inline-group">  

                                <span class="price-display">

                                    <div class="input-group">
                                        
                                        <input value="<?php echo number_format($v['price'],0,"","");?>" class="price-input form-control input-narrow autoNum" onkeypress="return isNumberKey(event)" id="price_service" name="price_service" type="text">
                                        <div class="input-group-addon"><?php echo $model->currency_code;?></div>
                                    </div>
                                    
                                </span>


              

                            </div>

                            <span class="help-block validation-error"></span></div>
                    </div>

                    <div class="col-sm-3">

                        <div class="form-group">
                            <span class="" for="tax_service">Thuế</span><br>
                            <div class="inline-group">
                            <div class="input-group">
                            
                             <input class="tax-input form-control input-narrow" onkeypress=" return isNumberKey(event)" id="tax_service" name="tax_service" type="text" value="<?php echo $v['tax'];?>">   
                               <div class="input-group-addon">%</div> 
                                   
                            </div>
                            </div>
                        <span class="help-block validation-error"></span></div>

                    </div>

                    <div class="col-sm-3">

                        <div class="form-group">
                        <span>Thời gian thực hiện</span><br>
                        <div class="input-group-duration">
                            <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                            <span class="ui-timepicker-container">
                            <input disabled class="duration-input form-control input-narrow ui-timepicker-input" type="number" value="<?php echo $v['length'];?>">                    
                          
                            </span>
                        </div>

                   
                      </div>

                    </div>



                    <div class="col-sm-3">
                       <div id="select-staff" class="rg-row" style="margin-bottom: 10px;">
                       
                            <div class="col-md-12">                                        
                             <span class="">Nhân viên thực hiện</span><br>

                            <div class="rg-row staff-services">
                                <div class="col-md-12">
                                    <select disabled class="staff" multiple="multiple">
                                        <optgroup label="Chọn tất cả">
                                            <?php    
                                            $staff_list=$model->getListDentists();                                                      
                                            $selected=$model->getListServiceUserSelected($v['id']);   
                                            foreach ($staff_list as $s_l) 
                                            {
                                            ?>
                                            <option value="<?php echo $s_l['id'];?>" 
                                            <?php 
                                            foreach ($selected as $s) {
                                                if ($s_l['id']==$s['id_user']) { 
                                                    echo "selected";
                                                }
                                            }
                                            ?>
                                            >
                                            <?php echo $s_l['name'];?>
                                            </option>
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

                        <span style="padding:0px;">Điểm được tặng khi mua dịch vụ</span>
                        <span style="width: 77px;margin-left: 15px;display: inline-block;">
                            <input disabled class="form-control" type="text" value="<?php echo $v['point_donate'];?>">
                        </span>
                   </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group margin-bottom-05em">
                        <span style="padding:0px;">Điểm cần có để quy đổi dịch vụ</span>
                        <span style="width: 77px;margin-left: 15px; display: inline-block;"> 
                            <input disabled class="form-control" type="text" value="<?php echo $v['point_exchange'];?>">
                        </span>
                    </div>
                </div>
               

                </div>

            
            </div>

        </div>

        <div class="rg-row" style="margin-top:10px;">                                           
            <div class="col-md-12">
                <div id="pBtn">
                    <div id="pBtnL">
                    <span class="pull-right">
                    <a href="javascript:void(0);" class="btn btn_cancel close_s">Hủy</a>
                    <button type="" id="" onclick="updateService(<?php echo $v['id'];?>);" class="btn btn_bookoke">Cập nhật</button>
                    </span> 
                    </div>
                </div>
            </div>
        </div>

    </form>


    </div>   

    </div>

</div>
