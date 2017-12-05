      

    <li id="c0" onclick="chitietnhom(0)"  class="n active">                                                                            
                                                        <span class="jqTransformCheckboxWrapper" style="display:none;">
                                                            <a href="#" class="jqTransformCheckbox"></a>
                                                            <input type="checkbox" value="0" class="fl" style="display : none;">
                                                        </span> 
                                                        <label class="fl">Tất cả  </label>
                                                        <div class="clearfix"></div>
                                                    </li>
          <?php
           foreach ($model as $key => $value):?>
              <li onclick="chitietnhom(<?php echo $value['id']; ?>)" id="c<?php echo $value['id']; ?>"  class="n ">                                                                            
                <span class="jqTransformCheckboxWrapper" style="display:none;">
              <a href="#" class="jqTransformCheckbox"></a>
              <input type="checkbox" value="0" class="fl" style="display : none;">
          </span> 
          <label class="fl"><?php echo $value['name']; ?> </label>
          <div id="delete">
            <span class="delete popup">
                <a href="#" class=" delete_provider" style="float:right;margin:5px;"  data-placement="bottom" id="a<?php echo $value['id'] ?>" onclick="delete_provider(<?php echo $value['id']; ?>)">
                <img data-toggle="tooltip" title="" src="<?php echo yii::app()->request->baseUrl; ?>/images/icon_sb_left/edit_cam.png" alt="" style="width: 18px; height:auto; margin: 4px 4px 0 8px;" data-original-title="Xóa">

                  <!-- <span class="glyphicon glyphicon-trash"></span> -->
                </a>
            </span>
            <input type="hidden" value="<?php echo $value['id']; ?>">
          <div id="deleteProvider<?php echo $value['id']; ?>" class="popover bottom deleteProvider" style="display: none;">
              <form id="frm-delete-provider" onsubmit="return false;" class="form-horizontal">
                  <div class="arrow"></div>
                  <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;"> Thông báo</h3>
                  <div class="popover-content" >
                  <input type="text" id="txtnamegroup" name="txtname" value="<?php echo $value['name']; ?>" class="form-control" style="padding-left: 5px;padding-right: 5px;">
                  <br>
                   <button id="yes_delete<?php echo $value['id']; ?>" onclick="deleteprovider(<?php echo $value['id']; ?>)" class="cancelNewStaff  btn sCancel btn_cancel"   style="float:left; padding: 6px 37px; margin-right: 10px;">Xóa</button>
                  <button id="update<?php echo $value['id']; ?>" class="btn Submit btn_bookoke"   onclick="Update(<?php echo $value['id']; ?>)"  style="padding: 6px 19px;">Xác Nhận</button>
                 
                  </div>
              </form>
          </div>
         </div>   
          <div class="clearfix"></div>
          </li>
      <?php 
      endforeach;
          ?>