<?php
$model = new PromotionProduct;
 foreach ($data as $k => $v):
  # code...
 ?>
<div class="col-sm-12">
<input type="" class="hidden" name="id_promotion" value="<?php echo $v['id']; ?>">
<input type="" class="hidden" name="images_promotion" value="<?php echo $v['images'];?>">
          <div class="col-sm-2">
                <div id="image-holder1" style="margin-top:10px;">
                    <img src="<?php echo Yii::app()->request->baseUrl;?>/upload/deals/lg/<?php if($v['images']!=""){echo $v['images'];}else{echo 'photo.jpg';} ?> " id="file_preview_1" style="width: 100%; height:auto;" >
                </div>

                      <i class="camera fa fa-camera icon-2x"></i> 
                <div id="wrapper" style="margin-top: 0px;">
                   <input
                    type="file" id="fileUploadedit" class="fileUploadedit" name="fileUploadedit"
                    style="border-radius: 100%; position: absolute; width: 75%;
                  height: 100px;
                top: 0px; opacity: 0"> 
               </div>
          </div>
           <div class="col-sm-10">
          <div  class="col-sm-6">
            <label>Tên chương trình</label>
            <input type="text" class="form-control  " name="dealsNameedit" id="dealsNameedit" placeholder="Name Deal" required="" value="<?php echo $v['name']?>" >
          
          </div>
           <div  class="col-sm-6">
             <label >Nhóm chương trình :</label>
              <select name="croup_edit" class="form-control" >
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
                <label>Ngày khuyến mãi :</label>
              
               <?php $date = date("m/d/Y h:mm A", strtotime($v['start_date'])); 
              $dateend = date("m/d/Y h:mm A", strtotime($v['end_date']));
              ?>
               <input type="text" class="form-control " name="daterangeedit" value="<?php echo $date; ?> - <?php echo $dateend; ?>" onchange="startdate()" />
 
            </div>
            <div class="col-sm-6">
              <label>Trạng thại :</label>
               <select name="status_deal_edit" class="form-control" name="status_deal"  style="float:left;">
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
            
            <div class="col-sm-2 pmt"><label>Loại khuyến mãi:</label></div>
            <div class="col-sm-10 pmt">
               <div class="col-sm-6">
                 <select class="form-control" name="type_price_edit" id="type_promotion_edit" onchange="promotion_type_edit()" style="float:left;">
                        <option value="0">Chọn giá trị khuyến mãi</option>
                        <option value="1" <?php if($v['type_price']==1){echo 'selected';} ?>>phần trăm (%)</option>
                        <option value="2" <?php if($v['type_price']==2){echo 'selected';} ?>>Giảm theo số tiền</option>
                        <option value="3" <?php if($v['type_price']==3){echo 'selected';} ?>>Bán giá cố định</option>
                        <option value="4" <?php if($v['type_price']==4){echo 'selected';} ?>>Giảm theo giá trị</option>
                  </select>
               </div>
               <div class="col-sm-6">

                 <input type="number" name="value_promotion1_edit" class="form-control s1  <?php if($v['type_price']!=1){echo 'input_value';}  ?>" id="s1"   placeholder="Phần trăm 1 - 100"  style=" width: 100%;" onchange="promotion()" value="<?php if($v['type_price']==1){ echo $v['price'];} ?>" >
                 <input type="text" name="value_promotion2_edit" class="form-control num s2 <?php if($v['type_price']!=2){echo 'input_value';}  ?>" id="s2"   placeholder="Số tiền"  style=" width: 100%;" value="<?php if($v['type_price']==2){ echo $v['price'];} ?>" >
                  <input type="text" name="value_promotion3_edit" class="form-control num s3 <?php if($v['type_price']!=3){echo 'input_value';}  ?>" id="s3"  placeholder=""  style=" width: 100%;" value="<?php if($v['type_price']==3){ echo $v['price'];} ?>" >
               </div>
               <div class="clearfix"></div>
               <div class="col-sm-12">
                 <table class="table table-striped giamtheogiatri_edit <?php if($v['type_price']!=4){echo 'input_value';}  ?> " id="s4" name="giamtheogiatri_edit"  style="margin-top: 13px;">
                   <thead>
                     
                     <th colspan="2">Từ</th>
                     
                     <th>Đến</th>
                     
                     <th>Giảm theo</th>
                     <th>Giá trị</th>

                   </thead>
                   <tbody>
                   <?php 
                   if($v['type_price']==4){
                   
                      foreach ($model->getvaluepromotion($v['id']) as $vp): 
                     # code...
                    ?>
                     <tr>
                      
                      <td><input type="text" min="1" class="form-control number num p1" name="start_value_edit[]"  placeholder="Number" value="<?php echo number_format($vp['start_value']) ; ?>"></td>
                      <td> <span class="glyphicon glyphicon-chevron-right p1" style="margin-top: 9px;"></span> </td>
                      <td class="end"><input type="text" min="1" class="form-control number num " name="end_value_edit[]"  placeholder="Number" onchange="price_promotion(this)" value="<?php echo number_format($vp['end_value']) ; ?>"   ></td>
                      
                      <td>
                          <select name="type_value_edit[]" class="form-control ssl"  style="float:left;">
                            <option value="1" <?php if($vp['percent_value']==1){echo "selected";} ?>>(%)</option>
                            <option value="2" <?php if($vp['percent_value']==2){echo "selected";} ?>>Giá trị</option>
                            <option value="3" <?php if($vp['percent_value']==3){echo "selected";} ?>>Giá cố định</option>
                          </select>
                      </td>
                      <td class="promotion_gt"><input type="text" min="1" class="form-control number " value="<?php echo number_format($vp['percent_value']) ; ?>" name="percent_value_edit[]" ></td>

                     </tr>
                   <?php endforeach;


                   }else{ ?>
                    <?php for($i=0; $i<2; $i++): ?>
                    <tr>
                      
                      <td><input type="text" min="1" class="form-control number num p1" name="start_value_edit[]"  placeholder="Giá trị" value=""></td>
                      <td> <span class="glyphicon glyphicon-chevron-right"></span> </td>
                      <td class="end"><input type="text" min="1" class="form-control number num " name="end_value_edit[]"  placeholder="Giá trị" value="" onchange="price_promotion(this)" ></td>
                      
                      <td>
                          <select name="type_value_edit[]" class="form-control ssl"  style="float:left;">
                            <option value="1"  >(%)</option>
                            <option value="2" >Giá trị</option>
                            <option value="3" >Giá cố định</option>
                          </select>
                      </td>
                      <td class="promotion_gt"><input type="number" min="1" class="form-control number "  name="percent_value_edit[]" ></td>

                     </tr>
                    <?php 
                      endfor;
                    } ?>
                   </tbody>
                   <tfoot>
                     <td colspan="6">
                      <button type="button" id="add_giatri_edit"  class="btn sbtnAdd btn_bookoke" data-dismiss="" style="padding: 1px 25px;">Thêm</button>
             
                    </td>
                   </tfoot>
                 </table>
               </div>
            </div>
           <div class="clearfix"></div>
           
           <ul class="nav nav-tabs">
              <li class="active">
                <a data-toggle="tab" href="#home<?php echo $v['id']; ?>">Dịch vụ và Sản phẩm</a>
              </li>
              <li>
               <a data-toggle="tab" href="#cus<?php echo $v['id']; ?>">Khách hàng</a>
              </li>
              <li>
               <a data-toggle="tab" href="#branch<?php echo $v['id']; ?>"  onclick="checkbox()">Chi nhánh</a>
              </li>
              <li>
               <a data-toggle="tab" href="#payment<?php echo $v['id']; ?>">Thanh toán</a>
              </li>
          </ul>
           
           <div class="tab-content tab-content1">
            <div id="home<?php echo $v['id']; ?>" class="tab-pane fade in active">
            <div class="col-sm-12" style=" margin:10px;">
              <div onclick="change_service_edit()" id="slider_holder" class="slider_holder staffhours sliderdone">
            
              <input id="allservice_edit" name="all_service_edit" type="hidden" value="<?php if ($v['type_service'] == 0 && $v['type_product'] == 0 ){echo "0";}else{echo "1";}  ?>">
              <span  id="off_service_edit" class="slider_off <?php if ($v['type_service'] == 0 && $v['type_product'] == 0 ){echo "Off";}  ?>  sliders"> TẮT </span>
              <span  id="on_service_edit" class="slider_on <?php if ($v['type_service'] == 0 && $v['type_product'] == 0 ){echo "On";}  ?> sliders"> BẬT </span>
              <span  id="switch_service_edit" class="slider_switch <?php if ($v['type_service'] == 0 && $v['type_product'] == 0 ){echo "Switch";}  ?> "></span>

              
            

              </div> <lable style="margin-top: 3px;
            display: block;"> &nbsp; Giới hạn Dịch vụ và sản phẩm </lable>

          </div>
            
              <table id="editservice" class="<?php if ($v['type_service'] == 0 && $v['type_product'] == 0 ){echo "input_value";}  ?>">
                <thead style="    border-bottom: 2px solid #ccc;">
                  <th style="width:40%;">Dịch vụ và sản phẩm</th>
                  <th style="width:20%;">Đơn giá&nbsp;(VNĐ)</th>
                  <th style="width:9%;">Số lượng</th>
                  <!-- <th>Promotion</th> -->
                  
                  <th style="width:22%;">Giá&nbsp;(VNĐ)</th>
                  <th style="width:10%;"></th>
                </thead>

                <tbody>

                <?php
                 foreach ($model->getpproduct($v['id']) as $pp):
                      if($pp['id_service'] !=""):
                  ?>
                 <tr class="tradddeal">
                    <td class="dealservice" style="width:40%;">
                      <div class="">
                        <select class="form-control DealsService" name="DealsService[]" id="dealsservice"  style="float:left;" onchange="servicedeal(this)" >
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
                      
                        <input type="text"  class="pricelabel"   style="border: 0px solid; width: 100%; background-color: #f1f5f6;" placeholder="Đơn giá" readonly="readonly" value="<?php echo number_format($pp['price']); ?>" >
                       <input type="text" name="DealsPrice_edit[]" class="price"  style="border: 0px solid; background-color: #f1f5f6; width: 100%; display:none" placeholder="Đơn giá" readonly="readonly" value="<?php echo $pp['price']; ?>">
                    </td>

                    <td style="width:9%;" class="dealnumber" >
                      <input type="number" name="number_edit[]" min="1" class="form-control number "  value="<?php echo $pp['number']; ?>" onchange="sumprice(this)">
                    </td>
                    <td style="width:22%;">
                      <input type="text" class="allprice num" style="border: 0px solid; background-color: #f1f5f6; width: 100%; " placeholder="Price" value="<?php 
                            $gia = $pp['price'];
                            $sl  = $pp['number'];
                            $tong = $gia * $sl;
                            echo number_format($tong);

                       ?>"  readonly="readonly">
                    </td>
                   <td style="width:10%">
                      <button type="button" class="btn btn-default btn-sm" onclick="myFunction(this)" style="border: 0px; background-color: rgba(204, 204, 204, 0.07);" >
                      <img data-toggle="tooltip" title="" src="<?php echo yii::app()->request->baseUrl; ?>/images/icon_sb_left/delete-def.png" alt="" style="width: 15px; height:auto;" data-original-title="Xóa">
                      </button>
                    </td>
                  </tr>
                <?php endif;
                    if($pp['id_product'] !=""):
                 ?>
                  <tr class="tradddeal">
                    <td class="dealservice" style="width:40%;">
                      <div class="">
                        <select class="form-control DealsProduct" name="DealsProduct[]" id="DealsProductư"  style="float:left;">
                          <?php
                              $md = new Promotion; 
                              foreach ($md->getproduct($v['id_company']) as $key1 => $value1) {
                                if($value1['id']==$pp['id_product']){
                                    echo "<option value='".$value1['id']."' selected>".$value1['name']."</option>";
                                }else{
                                    echo "<option value='".$value1['id']."'>".$value1['name']."</option>";
                                }
                                
                              }
                          ?>
                        </select>
                      </div>
                    </td>
                    <td style="width:20%;" class="dealpri">
                      <input type="text" name="DealsPricepr_edit[]"   style="border: 0px solid; width: 100%;background-color: #f1f5f6;" placeholder="Đơn giá" readonly="readonly" value="<?php echo number_format($pp['price']); ?>" id="hiden">
                      <input type="text" name="DealsPricepr_edit[]" class="price"  style="border: 0px solid; width: 100%; display:none; background-color: #f1f5f6;" placeholder="Đơn giá" readonly="readonly" value="<?php echo $pp['price']; ?>">
                    </td>
                    <td style="width:9%;" class="dealnumber" >
                      <input type="number" name="numberpro_edit[]" min="1" class="form-control number " value="<?php echo $pp['number']; ?>" onchange="sumprice(this)" >
                    </td>
                    <td style="width:22%;">
                      <input type="text" class="allprice" style="border: 0px solid; width: 100%; " placeholder="Giá" value="<?php 
                            $gia = $pp['price'];
                            $sl  = $pp['number'];
                            $tong = $gia * $sl;
                            echo number_format($tong);

                       ?>" readonly="readonly">
                    </td>
                    <td style="width:10%">
                      <button type="button" class="btn btn-default btn-sm" onclick="myFunction(this)" style="border: 0px; background-color: rgba(204, 204, 204, 0.07);" >
                      <img data-toggle="tooltip" title="" src="<?php echo yii::app()->request->baseUrl; ?>/images/icon_sb_left/delete-def.png" alt="" style="width: 15px; height:auto;" data-original-title="Xóa">
                      </button>
                    </td>
                    
                  </tr>
                <?php endif;
                      endforeach;
              if ($v['type_service'] == 0 && $v['type_product'] == 0 ): ?>
            
               
                 <tr class="tradddeal">
                    <td class="dealservice" style="width:40%;">
                      <div class="">
                        <select class="form-control DealsService" name="DealsService[]" id="dealsservice"  style="float:left;" onchange="servicedeal(this)" >
                        <option>Chọn dịch vụ</option>
                          <?php
                              $md = new Promotion; 
                              foreach ($md->getservice($v['id_company']) as $key => $value) {
                                
                                    echo "<option value='".$value['id']."'>".$value['name']."</option>";
                                
                                
                              }
                          ?>
                        </select>
                      </div>
                    </td>
                    <td style="width:20%;" class="dealpri">
                      
                        <input type="text"  class="pricelabel"   style="border: 0px solid; width: 100%; background-color: #f1f5f6;" placeholder="Đơn giá" readonly="readonly" value="" >
                       <input type="text" name="DealsPrice_edit[]" class="price"  style="border: 0px solid; background-color: #f1f5f6; width: 100%; display:none" placeholder="Đơn giá" readonly="readonly" value="">
                    </td>

                    <td style="width:9%;" class="dealnumber" >
                      <input type="number" name="number_edit[]" min="1" class="form-control number "  value="" onchange="sumprice(this)">
                    </td>
                    <td style="width:22%;">
                      <input type="text" class="allprice num" style="border: 0px solid; background-color: #f1f5f6; width: 100%; " placeholder="Price" value=""  readonly="readonly">
                    </td>
                   <td style="width:10%">
                      <button type="button" class="btn btn-default btn-sm" onclick="myFunction(this)" style="border: 0px; background-color: rgba(204, 204, 204, 0.07);" >
                      <img data-toggle="tooltip" title="" src="<?php echo yii::app()->request->baseUrl; ?>/images/icon_sb_left/delete-def.png" alt="" style="width: 15px; height:auto;" data-original-title="Xóa">
                      </button>
                    </td>
                  </tr>
            <?php endif; ?>
                </tbody>
                <tfoot>
                  <td colspan="5">
                     <button type="button" id="addproduct" class="btn sbtnAdd btn_bookoke" style="padding: 1px 25px;"> <span class="glyphicon glyphicon-plus" ></span> Sản phẩm</button>
                      <button type="button" id="addservice" class="btn sbtnAdd btn_bookoke" data-dismiss="" style="padding: 1px 25px;"> <span class="glyphicon glyphicon-plus"></span> Dịch vụ</button>
                  </td>
                </tfoot>
              </table>

              </div>
              <div id="cus<?php echo $v['id']; ?>" class="tab-pane fade">
                
                <?php include'customers_edit.php'; ?>
              </div>
              <div id="branch<?php echo $v['id']; ?>" class="tab-pane fade">
                
                 <?php include 'store_edit.php'; ?>
              </div>
              <div id="payment<?php echo $v['id']; ?>" class="tab-pane fade">
                
                <p>Đang cập nhật....</p>
              </div>
              </div>
            
               
            
             
          </div>
        <?php endforeach; ?>

        <script type="text/javascript">
        
        $(document).ready(function() {
           $(".fileUploadedit").on('change', function() {
          //Get count of selected files
          var countFiles = $(this)[0].files.length;
          var imgPath = $(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = $("#image-holder1");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image",
                    "style": "width:100%;"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } 
        });
           $("#addproduct").click(function(){
          
          var company = '42';
          
          $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/addprod',   
            data: {"company":company},  
          
            success:function(data){   
                $("#editservice").append("<tr class='tradddeal'>"+
                "<td class='dealprocuct' style='width:40%;'>"+"<div class='product'>"+
                          data+
                          "</div>"+
                "</td>"+
                "<td style='width:15%;'>"+
                          '<input type="text" class="pricelabel" placeholder="Price" readonly="readonly" style="border: 0px solid; width: 100%;background-color: #f1f5f6; ">'+
                          '<input type="text" class="price num" name="DealsPricepr_edit[]"  placeholder="Price" readonly="readonly" style="border: 0px solid; width: 100%; background-color: #f1f5f6; display:none; ">'+
                "</td>"+
                '<td style="width:20%;"  class="dealnumber">'+
                          '<input type="number" class="form-control number " name="numberpro_edit[]" id="" placeholder="Number" onchange="sumprice(this)">'+
                
                '<td style="width:15%;">'+
                    '<input type="text" class="allprice num" name="DealsPrice[]" id="DealsPrice" readonly="readonly" style="border: 0px solid; width: 100%;background-color: #f1f5f6;  " placeholder="Price" value="0">'+
                        '</td>'+
                 '<td style="width:10%;" >'+
                          '<button type="button" class="btn btn-default btn-sm" onclick="myFunction(this)" style="border: 0px; background-color: rgba(204, 204, 204, 0.07);">'+
                            '<img data-toggle="tooltip" title="" src="<?php echo yii::app()->request->baseUrl; ?>/images/icon_sb_left/delete-def.png" alt="" style="width: 15px; height:auto;" data-original-title="Xóa"> '+ 
                          '</button>'+
                  '</td>'       

                +"</tr");
            },
            
      });
        
          });
                    //append addpro
          $("#addservice").click(function(){
          var company = '42';
         
          $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/addser',   
            data: {"company":company},  
          
            success:function(data){   
                $("#editservice").append("<tr class='tradddeal'>"+
                "<td class='dealservice' style='width:40%;'>"+"<div class='service'>"+
                          data+
                          "</div>"+
                "</td>"+
                "<td style='width:15%;'>"+
                 '<input type="text" class="pricelabel num"  placeholder="Price" readonly="readonly" style="border: 0px solid; width: 100%; background-color: #f1f5f6;">'+
                          '<input type="text" class="price num" name="DealsPrice_edit[]" id="" placeholder="Price" readonly="readonly" style="border: 0px solid; width: 100%; background-color: #f1f5f6; display:none">'+
                "</td>"+
                '<td style="width:20%;" class="dealnumber " >'+
                          '<input type="number" class="form-control number " name="number_edit[]" id="" placeholder="Number" onchange="sumprice(this)">'+
                '</td>'+
              
                '<td style="width:15%;">'+
                    '<input type="text" class="allprice num"  id="" readonly="readonly" style="border: 0px solid; width: 100%; background-color: #f1f5f6; " placeholder="Price" value="0">'+
                        '</td>'+
                        '<td style="width:10%;">'+
                          '<button type="button" class="btn btn-default btn-sm" onclick="myFunction(this)" style="border: 0px; background-color: rgba(204, 204, 204, 0.07);">'+
                            '<img data-toggle="tooltip" title="" src="<?php echo yii::app()->request->baseUrl; ?>/images/icon_sb_left/delete-def.png" alt="" style="width: 15px; height:auto;" data-original-title="Xóa"> '+ 
                          '</button>'+
                        '</td>'

                +"</tr");
            },
            
      });
        
          });
$("#add_giatri_edit").click(function(){
  
    $("#s4").append(
      "<tr class='tradddeal'>"+
      
     '<td><input type="text" min="1" class="form-control number  num p1" name="start_value_edit[]" id="number" placeholder="Giá trị"  onchange="sumprice(this)"></td>' + 
     '<td> <span class="glyphicon glyphicon-chevron-right" style="    margin-top: 9px;"></span> </td>'+
      '<td class="end"><input type="text" min="1" class="form-control number num " name="end_value_edit[]" id="number" placeholder="Giá trị"  onchange="price_promotion(this)"></td>'+
                      
      '<td><select name="type_value_edit[]" class="form-control" id="DealsService" style="float:left;">'+
              '<option value="1">(%)</option>'+
              '<option value="2">Value</option>'+
              '<option value="3">Fixed value</option>'+
            '</select>'+
      '</td>'+
      '<td><input type="text" min="1" class="form-control number num " name="percent_value_edit[]" id="number" placeholder="Giá trị"  onchange="sumprice(this)"></td>'+
     '</tr>');
    $(function(){
    var numberOptions = {aSep: ',', aDec: '.', mDec: 3, aPad: false};
    $('.num').autoNumeric('init',numberOptions);
    });
 })
        });
         function myFunction(dev) {
            
    var i = dev.parentNode.parentNode.rowIndex;
    document.getElementById("editservice").deleteRow(i);
    
}$(function() {
    $('input[name="daterangeedit"]').daterangepicker({
        timePicker: true,
        timePickerIncrement: 365,
        locale: {
            format: 'MM/DD/YYYY h:mm:ss'
        }
    });
});
$( function() {
    $( "#datepicker" ).datepicker();
    $('#DealsStart').datepicker();
  } );
function promotion_type_edit(){
    var id = $('#type_promotion_edit').val();
    
    if(id == 1){
        
       $('#s1').removeClass('input_value');
       $('#s2').addClass('input_value');
       $('#s3').addClass('input_value');
       $('#s4').addClass('input_value');
        return false;
    }else if(id ==2 ){
         $('#s2').removeClass('input_value');
       $('#s1').addClass('input_value');
       $('#s3').addClass('input_value');
       $('#s4').addClass('input_value');
        return false;

    }
    else if(id == 3){
         $('#s3').removeClass('input_value');
       $('#s2').addClass('input_value');
       $('#s1').addClass('input_value');
       $('#s4').addClass('input_value');
       return false;
    }
    else if(id == 4){
         $('#s4').removeClass('input_value');
       $('#s2').addClass('input_value');
       $('#s3').addClass('input_value');
       $('#s1').addClass('input_value');
        return false;


    }
}
$('#frm-edit-Deals').submit(function(e) {
    e.preventDefault();    
    var formData = new FormData($("#frm-edit-Deals")[0]); 
      
    if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({           
            type:"POST",
            url: baseUrl+'/itemsSales/Dealselitedental/updateDeals',   
            data:formData,
            datatype:'json',
            success:function(data){
               
                if(data > 0){ 
                  $("#edit_deals").modal("hide");
                 
                detail();
                
                
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
function change_service_edit()
    {
        $("#on_service_edit").toggleClass("On");
        $("#off_service_edit").toggleClass("Off");
        $('#switch_service_edit').toggleClass("Switch");
        $('#editservice').toggleClass('input_value'); 
       var vl = $('#allservice_edit').val();
        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsSales/Dealselitedental/allservice',   
            data: {"vl":vl},  
          
            success:function(data){  
               $('#allservice_edit').val(data);
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
        }); 

    } 
    </script>
