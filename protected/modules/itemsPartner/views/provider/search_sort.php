 <?php $baseUrl = Yii::app()->baseUrl;?>
                                       
        <?php  
        if(!empty($list_data['data']))
        {   
            

        foreach($list_data['data'] as $k=> $value)
        {
        ?>
        <li id="c<?php echo $value['Id'];?>" onclick="detailprovider(<?php echo $value['Id'];?>);"  class="n" style=" position: relative;" >
                                        
                                        <span class="jqTransformCheckboxWrapper" style="display:none;">
                                            <a href="#" class="jqTransformCheckbox"></a>
                                            <input type="checkbox" value="<?php echo $value['Id'];?>" class="fl" style="display : none;">
                                        </span>
                                        
                                        <img src="<?php echo $baseUrl; ?>/upload/provider/lg/<?php if($value['images']!="") echo $value['images']; else echo "no_avatar.png";?>" class="fl" style="border-radius:100%;">
                                        <label class="fl"><?php echo $value['Name'];?> </label>
                                        <div id="delete">
                                                    <span class="delete popup">
                                                        <a href="#" class="btn btn-info  btn_delete delete_provider" id="" onclick="delete_provider(<?php echo $value['Id']; ?>)">
                                                             <span class="glyphicon glyphicon-trash"></span>
                                                         </a>
                                                            <input type="hidden" value="<?php echo $value['Id']; ?>">
                                                        <div id="deleteProvider<?php echo $value['Id']; ?>" class="popover bottom deleteProvider" style="display: none;">
                                                            <form id="frm-delete-provider" onsubmit="return false;" class="form-horizontal">
                                                                <div class="arrow"></div>
                                                                <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Are you sure delete.?</h3>
                                                                <div class="popover-content" style="width:225px;">
                                                                    <label><?php echo $value['Name']; ?></label><br>
                                                                    <button id="yes_delete<?php echo $value['Id']; ?>" onclick="deleteprovider(<?php echo $value['Id']; ?>)" class="new-gray-btn new-green-btn">Yes</button>
                                                                    <button id="cancelNewCustomer" type="reset" class="cancelNewStaff new-gray-btn" style="min-width: 94px;margin-right: 0px;">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>                                                    </span> 
                                                    </div>
                                        <div class="clearfix"></div>
        </li>
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
