<?php     
    $baseUrl = Yii::app()->baseUrl;
?>

        <?php  
        if(!empty($list_data['data']))
        {       
        foreach($list_data['data'] as $k=> $value)
        {
           
        ?>
        <li id="c<?php echo $value['id'];?>" onclick="detailCustomer(<?php echo $value['id'];?>);"  class="n" >
                                        
                                        <span class="jqTransformCheckboxWrapper" style="display:none;">
                                            <a href="#" class="jqTransformCheckbox"></a>
                                            <input type="checkbox" value="<?php echo $value['id'];?>" class="fl" style="display : none;">
                                        </span>
                                        
                                        <img src="<?php echo $baseUrl; ?>/upload/customer/avatar/<?php if($value['image']!="") echo $value['image']; else echo "no_avatar.png";?>" class="fl" style="border-radius:100%;">
                                        <label class="fl"><?php echo $value['fullname'];?> </label>

                                        <?php if(Yii::app()->user->getState('group_id') == 1 || Yii::app()->user->getState('group_id') == 2) { ?>
                                            <img id="ltn<?php echo $value['id'];?>" class="hide" onclick="showUpdateCustomer(<?php echo $value['id'];?>);" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/edit_cam.png" style="float:right;margin: 9px 6px 0 0;width: 20px;height: 20px;">
                                        <?php } ?>   
                                            
                                        <?php 
                                        if( $value['status_schedule']==2 ){
                                        ?>
                                        <code class="delete_btn status_2">
                                            Đã đến
                                        </code>
                                        <?php 
                                        }elseif( $value['status_schedule']==3 ){
                                        ?>
                                        <code class="delete_btn status_3">
                                            Vào khám
                                        </code>
                                        <?php 
                                        }
                                        ?>
                                
                                        <div class="clearfix"></div>     

        </li>

        <div id="updateCustomerPopup<?php echo $value['id'];?>" class="popover bottom customer" style="display: none;padding:0px;top:150px;left:500px;">
            <form id="frm-update-customer-<?php echo $value['id'];?>" onsubmit="return false;" class="form-horizontal">                                                                                                 
                <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Chỉnh sửa khách hàng</h3>
                <div class="popover-content" style="width:225px;">
                    <input type="text" required oninvalid="this.setCustomValidity('Vui lòng nhập tên khách hàng.')" oninput="setCustomValidity('')" class="form-control" id="customerName<?php echo $value['id'];?>" name="customerName" value="<?php echo $value['fullname'];?>" placeholder="Tên khách hàng" style="margin-top:0px;padding: 6px 12px;margin-bottom:10px;width:98%;">
                    <button onclick="deleteCustomer(<?php echo $value['id'];?>);" class="btn btn_delete" style="min-width: 94px;margin-right: 0px;">Xóa</button>
                    <button onclick="updateCustomerName(<?php echo $value['id'];?>);" class="btn btn_bookoke">Cập nhật</button>
                </div>
            </form>
        </div>  

        <?php
        }
        }
        else
        {   
        ?>
        <li>Không Tìm Thấy Khách Hàng!!!</li>
        <?php
        } 
        ?>
        