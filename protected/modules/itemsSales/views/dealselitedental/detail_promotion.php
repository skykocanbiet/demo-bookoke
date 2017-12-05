 <div class="col-sm-12" style="padding: 0px 20px;">
          <div class="col-sm-2">
                <div id="image-holder" style="margin-top:10px;">
                    <img src="<?php echo Yii::app()->request->baseUrl;?>/upload/deals/lg/<?php if($v['images']!=""){echo $v['images'];}else{echo 'photo.jpg';} ?> " id="file_preview_1" style="width: 100%; height:auto;" >
                </div>

                      <i class="camera fa fa-camera icon-2x"></i> 
                <div id="wrapper" style="margin-top: 0px;">
                  <!-- <input
                    type="file" id="fileUpload" name="fileUpload"
                    style="border-radius: 100%; position: absolute; width: 75%;
                  height: 100px;
                top: 0px; opacity: 0"> -->
               </div>
          </div>
           <div class="col-sm-10 " style="text-align: left;">
          <div  class="col-sm-6">
            <label style="padding: 8px 0px;">Tên chương trình</label>
            <input type="text" class="form-control  " name="" id="dealsName" placeholder="Name Deal" required="" value="<?php echo $v['name']?>" readonly="readonly" >
          
          </div>
            <div  class="col-sm-6">
             <label style="padding: 8px 0px;">Nhóm chương trình :</label>
              <select class="form-control" disabled readonly="readonly">
                <?php
                 foreach (CroupPromotion::model()->getcroup() as $u=>$a){
                    if($a['id']==$v['id_croup']){
                        echo "<option value='".$a['id']."' selected>".$a['name']."</option>";
                    }else{
                         echo "<option value='0'>Chọn nhóm chương trình</option>";
                        echo "<option value='".$a['id']."'>".$a['name']."</option>";
                    }
                    }
                  ?>
                </select>  
            </div>
           
            <div class="col-sm-6">
                <label style="padding: 8px 0px;">Ngày khuyến mãi</label>
              <?php $date = date("m/d/Y h:mm A", strtotime($v['start_date'])); 
              $dateend = date("m/d/Y h:mm A", strtotime($v['end_date']));
              ?>
               <input type="text" class="form-control "  value="<?php echo $date; ?> - <?php echo $dateend; ?>" onchange="startdate()" readonly="readonly" />
 
            </div>
            <div class="col-sm-6">
              <label style="padding: 8px 0px;">Trạng khái chương trình :</label>
               <select class="form-control" name="status_deal" disabled=""  style="float:left;">
                        <option value="1" <?php if($v['status']==1){echo 'selected';} ?>>Đang duyệt</option>
                        <option value="2" <?php if($v['status']==2){echo 'selected';} ?>>Khởi động</option>
                        <option value="3" <?php if($v['status']==3){echo 'selected';} ?>>Tạm dừng</option>
                        <option value="4" <?php if($v['status']==4){echo 'selected';} ?>>Kết thúc</option>
                        <option value="-1" <?php if($v['status']==-1){echo 'selected';} ?>>Xóa</option>
                  </select>
            </div>
             <!-- <div style="width:100%;">
             
              <label>Description</label>
                    <textarea class="char-count-1000 form-control" cols="20" id="description_service" name="description_service" rows="2"></textarea>
            </div> -->
            </div>
            <div class="clearfix"></div>
           
            <div class="col-sm-2 pmt"><label style="padding: 8px 0px;">loại khuyến mãi:</label></div>
            <div class="col-sm-10 pmt">
               <div class="col-sm-6">
                 <select class="form-control" name="type_price" id="type_promotion" onchange="promotion_type()" disabled="" style="float:left;">
                        <option value="0">Select promotional value</option>
                        <option value="1" <?php if($v['type_price']==1){echo 'selected';} ?>>Phần trăm (%)</option>
                        <option value="2" <?php if($v['type_price']==2){echo 'selected';} ?>>Giảm theo số tiền</option>
                        <option value="3" <?php if($v['type_price']==3){echo 'selected';} ?>>Bán giá cố định</option>
                        <option value="4" <?php if($v['type_price']==4){echo 'selected';} ?>>Giảm theo giá trị</option>
                  </select>
               </div>
               <div class="col-sm-6">

                 <input type="number" class="form-control <?php if($v['type_price']!=1){echo 'input_value';}  ?>"   placeholder="percent 1 - 100"  style=" width: 100%;" onchange="promotion()" value="<?php echo $v['price']; ?>" readonly="readonly" >
                 <input type="number" class="form-control <?php if($v['type_price']!=2){echo 'input_value';}  ?>"   placeholder="số tiền"  style=" width: 100%;" value="<?php echo $v['price']; ?>" readonly="readonly" >
                  <input type="number" class="form-control <?php if($v['type_price']!=3){echo 'input_value';}  ?>"   placeholder=""  style=" width: 100%;" value="<?php echo $v['price']; ?>" readonly="readonly" >
               </div>
               <div class="clearfix"></div>
               <div class="col-sm-12">
                 <table class="table table-striped <?php if($v['type_price']!=4){echo 'input_value';}  ?> "  style="margin-top: 20px;">
                   <thead>
                     
                     <th>Bắt đầu</th>
                     <th></th>
                     <th>Cho đến</th>
                     
                     <th>Giảm theo</th>
                     <th>Giá trị</th>

                   </thead>
                   <tbody>
                   <?php 
                   if($v['type_price']==4):
                   
                      foreach ($model->getvaluepromotion($v['id']) as $vp): 
                     # code...
                    ?>
                     <tr>
                      
                      <td><input type="text" min="1" class="form-control number " name=""  placeholder="text" value="<?php echo number_format($vp['start_value']) ; ?>" readonly="readonly"></td>
                      <td> <span class="glyphicon glyphicon-chevron-right"></span> </td>
                      <td><input type="text" min="1" class="form-control number " name=""  placeholder="Number" value="<?php echo number_format($vp['end_value']); ?>" readonly="readonly"></td>
                      
                      <td>
                          <select name="" disabled="" class="form-control ssl"  style="float:left;">
                            <option value="1" <?php if($vp['percent_value']==1){echo "selected";} ?>>(%)</option>
                            <option value="2" <?php if($vp['percent_value']==2){echo "selected";} ?>>Value</option>
                            <option value="3" <?php if($vp['percent_value']==3){echo "selected";} ?>>Fixed value</option>
                          </select>
                      </td>
                      <td class="promotion_gt"><input type="number" min="1" class="form-control number " value="<?php echo $vp['percent_value']; ?>" readonly="readonly"></td>
                     </tr>
                   <?php endforeach;endif; ?>
                   </tbody>
                   
                 </table>
               </div>
            </div>
           <div class="clearfix"></div>
          
           <ul class="nav nav-tabs">
              <li class="active">
                <a data-toggle="tab" href="#home_<?php echo $v['id']; ?>">Dịch vụ và sản phẩm</a>
              </li>
              <li>
               <a data-toggle="tab" href="#cus_<?php echo $v['id']; ?>">Khách hàng</a>
              </li>
              <li>
               <a data-toggle="tab" href="#branch_<?php echo $v['id']; ?>">Chi nhánh</a>
              </li>
              <li>
               <a data-toggle="tab" href="#payment_<?php echo $v['id']; ?>">Thanh toán</a>
              </li>
          </ul>
           
           <div class="tab-content tab-content1">
            <div id="home_<?php echo $v['id']; ?>" class="tab-pane fade in active">
            <?php 
            if ($v['type_service'] != 0 || $v['type_product'] != 0 ) {
              # code...
             ?>
              <table id="add">
                <thead style="    border-bottom: 2px solid #ccc;">
                  <th style="width:40%;">Dịch vụ và sản phẩm</th>
                  <th style="width:20%;">Đơn giá &nbsp;(VNĐ)</th>
                  <th style="width:9%;">Số lượng</th>
                  <!-- <th>Promotion</th> -->
                  
                  <th style="width:22%;">Giá &nbsp;(VNĐ)</th>
                  
                </thead>

                <tbody>
                <?php foreach ($model->getpproduct($v['id']) as $pp):
                      if($pp['id_service'] !=""):
                  ?>
                 <tr class="tradddeal">
                    <td class="dealservice" style="width:40%;">
                      <div class="">
                        <select disabled="" class="form-control"  style="float:left;">
                          <?php
                              $md = new Promotion; 
                              foreach ($md->getservice($v['id_company']) as $key => $value) {
                                if($value['id']==$pp['id_service']){
                                    echo "<option value='".$value['id']."' selected>".$value['name']."</option>";
                                }else{
                                    echo "<option value='".$value['id']."'>".$value['name']."</option>";
                                }
                                
                              }
                          ?>
                        </select>
                      </div>
                    </td>
                    <td style="width:20%;" class="dealpri">
                      
                      <label><?php echo number_format($pp['price']) ?></label>
                    </td>
                    <td style="width:9%;" class="dealnumber" >
                      <input type="number" min="1" name="number[]" class="form-control number " readonly="readonly" value="<?php echo $pp['number']; ?>">
                    </td>
                    <td style="width:22%;">
                     <?php $gia = $pp['price'];
                            $sl  = $pp['number'];
                            $tong = $gia * $sl;
                            echo "<label>".number_format($tong)." </label";

                       ?>
                    </td>
                   
                  </tr>
                <?php endif;
                    if($pp['id_product'] !=""):
                 ?>
                  <tr class="tradddeal">
                    <td class="dealservice" style="width:40%;">
                      <div class="">
                        <select disabled="" class="form-control" id="DealsService"  style="float:left;">
                          <?php
                              $md = new Promotion; 
                              foreach ($md->getproduct($v['id_company']) as $key => $value) {
                                if($value['id']==$pp['id_product']){
                                    echo "<option value='".$value['id']."' selected>".$value['name']."</option>";
                                }else{
                                    echo "<option value='".$value['id']."'>".$value['name']."</option>";
                                }
                                
                              }
                          ?>
                        </select>
                      </div>
                    </td>
                    <td style="width:19%;" class="dealpri">
                      <label><?php echo number_format($pp['price']) ?></label>
                    </td>
                    <td style="width:9%;" class="dealnumber" >
                      <input type="number" min="1" class="form-control number " value="<?php echo $pp['number']; ?>" readonly="readonly" >
                    </td>
                    <td style="width:19%;">
                      
                      <?php $gia = $pp['price'];
                            $sl  = $pp['number'];
                            $tong = $gia * $sl;
                            echo "<label>".number_format($tong)." </label";

                       ?>
                    </td>
                    
                  </tr>
                <?php endif;
                      endforeach;
                 ?>
                </tbody>
                
              </table>
              <?php }else {
                  echo "<div class='alert alert-success'>Gói khuyến mãi được áp dụng cho tất cả sản phẩm và dịch vụ ! </div>";
                  } ?>
              </div>
              <div id="cus_<?php echo $v['id']; ?>" class="tab-pane fade">
                
                <?php 
                    if ($v['type_segment'] == 0) {
                      echo "<div class='alert alert-success'>Gói khuyến mãi được áp dụng cho tất cả các đối tượng ! </div>";
                    }else{
                      ?>
                       <table class="table table-condensed table-hover" style="margin-bottom:10px;">
                      <thead>
                        <th></th>
                        <th>Nhóm khách hàng</th>
                        <th>Ghi chú</th>
                      </thead>
                      <tbody>
                        <?php 
                            $store = new Promotion;
                            $list_segment = $store->getsegmentfor($v['id']);

                            foreach ($store->getsegment() as $s_m):

                        ?>
                          <tr>
                            <td><input type="checkbox" class="chk_store" name="store[]" value="<?php echo  $s_m['id']; ?>"<?php if(array_key_exists($s_m['id'],$list_segment)) echo "checked";?> ></td>
                            <td><?php echo $s_m['name']; ?></td>
                            <td><input type="text" class="form-control" name=""></td>
                          </tr>
                        <?php
                          
                         endforeach; ?>
                      </tbody>
                    </table>
                      <?php
                    }

                 ?>
              </div>
              <div id="branch_<?php echo $v['id']; ?>" class="tab-pane fade" style="text-align:left;">
                <?php 
                    if ($v['type_branch'] == 0) {
                     echo "<div class='alert alert-success'>Gói khuyến mãi được áp dụng cho tất cả các chi nhánh thuộc công ty ! </div>";
                    }else{
                        
                      ?>
                    <div class="col-sm-12" style="padding-left:10px;">
                      <input type="checkbox" id="limit_store" name="" checked> Giới hạn cửa hàng

                    </div>
                    <table class="table table-condensed table-hover" style="margin-bottom:10px;">
                      <thead>
                        <th></th>
                        <th>Chi nhánh</th>
                        <th>Ghi chú</th>
                      </thead>
                      <tbody>
                        <?php 
                            $store = new Promotion;
                            $list_data = $store->getbranchfor($v['id']);

                            foreach ($store->getbranch() as $key):

                        ?>
                          <tr>
                            <td><input type="checkbox" class="chk_store" name="store[]" value="<?php echo  $key['id']; ?>"<?php if(array_key_exists($key['id'],$list_data)) echo "checked";?> ></td>
                            <td><?php echo $key['name']; ?></td>
                            <td><input type="text" class="form-control" name=""></td>
                          </tr>
                        <?php
                          
                         endforeach; ?>
                      </tbody>
                    </table>

                          
                  <?php     
                    }

                 ?>

         
              </div>
              <div id="payment_<?php echo $v['id']; ?>" class="tab-pane fade">
                
                <p>updating....</p>
              </div>
              </div>
            
               
            
             
          </div>
          <div class="col-sm-12" style="text-align:left;">
            <button class="btn btn_bookoke" id="btn_edit_deals"  data-target="#edit_deals" onclick="edit(<?php echo $v['id']; ?>)">Chỉnh sửa</button>
            
          </div>
        </div>