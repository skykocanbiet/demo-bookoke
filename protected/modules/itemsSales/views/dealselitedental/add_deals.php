<?php $user = $user1 = Yii::app()->user->getState('user_name'); 
  $today = date('m/d/Y ');
  $month = strtotime(date("m/d/Y", strtotime($today)) . " +1 month");
  $month = strftime("%m/%d/%Y", $month);
  
?>
<input type="text" class="form-control " name="DealsStop" id="date" placeholder="" value="<?php echo date('m/d/Y H:i:s'); ?>" style="display:none;">
<style type="text/css">
  .form-control{
    border-radius: 2px;
  }
  .delete{
    
  }
  .sumprice{
    float: left;
    width: 94%;
    border-top: 0px;
    border-left: 0px;
    border-right: 0px;
    border-bottom: 1px solid #ccc;
    
    text-align: center;
  }
  .error{
    background-color: #ccc;

  }
  .nobutton{
    display: none;
  }
  .input_value{
    display: none;
  }
.nav-tabs>li.active>a,.nav-tabs>li.active>a:focus,.nav-tabs>li.active>a:hover{
    color: #555;
    cursor: default;
    background-color: #fff;
     border: 0px solid #ddd; 
    border-bottom: 2px solid #4e9a7b;
    /*letter-spacing: 0.5px;*/
    font-weight: bold;
   /* font-family: helvetica;*/
}
.nav-tabs>li>a{
  color: #777;

}
.tab-content1 {
  margin-top: 10px;
}
.pmt{
  margin-top: 20px; 
  margin-bottom: 20px;
}
.num
{
  text-align: center;
}
</style>
<div class="container">
  

  <!-- Modal -->
  <div class="modal fade" id="add_deals" role="dialog">
    <div class="modal-dialog">
     <div class="alert alert-danger" id="canhbao" style="    position: fixed;
    margin-left: -182px;
    left: 591px;
    top: 181px;
    z-index: 99999;
    box-shadow: 0 5px 15px #999;
    display:none;"><b>Giá trị nhập sai :</b> Giá trị cuối phải lớn hơn giá trị đầu</div>
    <div class="alert alert-danger" id="saiten" style="    position: fixed;
    margin-left: -182px;
    left: 500px;
    top: 40px;
    z-index: 99999;
    box-shadow: 0 5px 15px #999;
    display:none;"><b>Nhập tên sai :</b> Tên chương trình đã tồn tại</div>
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header popHead">
<!--           <a class="btn_close close" data-dismiss="modal"></a>
 -->          <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
<!--           <button type="button" class="close" data-dismiss="modal">&times;</button>
 -->          <h5 class="modal-title" style="margin: 9px 0px;">THÊM CHƯƠNG TRÌNH KHUYẾN MÃI</h5>
        </div>
        <form id="frm-add-Deals" onsubmit="return false;" class="form-horizontal">
        <div class="modal-body clearfix">

          <div class="col-sm-12">
          <div class="col-sm-2">
                <div id="image-holder" style="margin-top:10px;">
                    <img src="<?php echo Yii::app()->request->baseUrl;?>/upload/deals/lg/photo.jpg" id="file_preview_1" style="width: 100%; height:auto;" >
                </div>

                      <i class="camera fa fa-camera icon-2x"></i> 
                <div id="wrapper" style="margin-top: 0px;">
                  <input
                    type="file" id="fileUpload" name="fileUpload"
                    style="border-radius: 100%; position: absolute; width: 75%;
                  height: 100px;
                top: 0px; opacity: 0">
               </div>
          </div>
           <div class="col-sm-10">
          <div  class="col-sm-6">
            <label>Tên chương trình</label>
            <input type="text" class="form-control  " name="dealsName" id="dealsName" placeholder="Tên chương trình khuyến mãi" required="" onchange="txtname(this)" >
          
          </div>
           <div  class="col-sm-6">
          <!-- Moi up -->
             <label>Nhóm chương trình :</label>
                <select class="form-control " name="croup_promotion" id="croup_promotion" >
                  <option value="0">Chọn nhóm chương trình</option>
                          <?php
                                $pro = new CroupPromotion();
                                $maps =  $pro->getcroup();
                                foreach ( $maps as $k => $v): 
                                                    ?>
                <option value="<?php echo $v['id'] ?>"><?php echo $v['name']; ?></option>
              <?php endforeach; ?>
              </select>
              <!-- Moi up -->
            </div>
           
            <div class="col-sm-6">
                <label>Ngày khuyến mãi :</label>
              
              <input type="text" class="form-control " name="daterange" value="<?php echo date('m/d/Y h:mm A'); ?> - <?php echo $month; ?>" onchange="startdate()" />
 
            </div>
            <div class="col-sm-6">
              <label>Trạng thái :</label>
               <select class="form-control" name="status_deal"  style="float:left;">
                        <option value="1">Đang duyệt</option>
                        <option value="2">Khởi động</option>
                        <option value="3">Tạm dừng</option>
                        <option value="4">Kết thúc</option>
                        <option value="-1">Xóa</option>
                  </select>
            </div>
             <!-- <div style="width:100%;">
             
              <label>Description</label>
                    <textarea class="char-count-1000 form-control" cols="20" id="description_service" name="description_service" rows="2"></textarea>
            </div> -->
            </div>
            <div class="clearfix" ></div>
            
            <div class="col-sm-2 pmt"  ><label>Loại khuyến mãi:</label></div>
            <div class="col-sm-10 pmt" >
               <div class="col-sm-6">
                 <select class="form-control" name="type_price" id="type_promotion" onchange="promotion_type()" style="float:left;">
                        <option value="0">Chọn cách tính</option>
                        <option value="1">Phần trăm (%)</option>
                        <option value="2">Giảm theo số tiền</option>
                        <option value="3">Bán giá cố định</option>
                        <option value="4">Giảm theo giá trị</option>
                  </select>
               </div>
               <div class="col-sm-6">
                 <input type="number" class="form-control input_value" name="value_promotion1" id="giamtheophantram"  placeholder="Phần trăm 1 - 100"  style=" width: 100%;" onchange="promotion()" >
                 <input type="text" class="form-control input_value num" name="value_promotion2" id="giamtheosotien" placeholder="Số tiền"  style=" width: 100%;" >
                  <input type="text" class="form-control input_value num" name="value_promotion3" id="bangiacodinh" placeholder=""  style=" width: 100%;" >
               </div>
               <div class="clearfix"></div>
               <div class="col-sm-12">
                 <table class="table input_value" id="giamtheogiatri">
                   <thead>
                     <th></th>
                     <th colspan="2">Từ</th>
                     
                     <th>Đến</th>
                     
                     <th>Giảm theo</th>
                     <th>Giá trị</th>

                   </thead>
                   <tbody>
                   <?php for ($i=0; $i < 2 ; $i++): 
                     # code...
                    ?>
                     <tr>
                      <td style="padding-top: 18px;"><?php echo $i+1; ?></td>
                      <td class="start"><input type="text" min="1" class="form-control number num p1 " name="start_value[]" id="number" placeholder="Giá trị" ></td>
                      <td style="padding-top: 18px;"> <span class="glyphicon glyphicon-chevron-right"></span> </td>
                      <td class="end"><input type="text" min="1" class="form-control number num " name="end_value[]" id="number" placeholder="Giá trị" onchange="price_promotion(this)"></td>
                      
                      <td>
                          <select name="type_value[]" class="form-control ssl"  style="float:left;">
                            <option value="1">(%)</option>
                            <option value="2">Giá trị</option>
                            <option value="3">Giá cố định</option>
                          </select>
                      </td>
                      <td class="promotion_gt"><input type="text" min="1" class="form-control number num " name="percent_value[]" id="number"  onchange="promotion_giatri(this)"></td>
                     </tr>
                   <?php endfor; ?>
                   </tbody>
                   <tfoot>
                    <td colspan="6">
                      <button type="button" id="add_giatri"  class="btn sbtnAdd btn_bookoke" data-dismiss="" style="padding: 1px 25px;"><span class="glyphicon glyphicon-plus"></span></button>
             
                    </td>
                  </tfoot>
                 </table>
               </div>
            </div>
           <div class="clearfix"></div>
           
           <ul class="nav nav-tabs pmt">
              <li class="active">
                <a data-toggle="tab" href="#home">Dịch vụ và sản phẩm</a>
              </li>
              <li>
               <a data-toggle="tab" href="#cus">Khách hàng</a>
              </li>
              <li>
               <a data-toggle="tab" href="#store">Chi nhánh</a>
              </li>
              <li>
               <a data-toggle="tab" href="#payment">Thanh toán</a>
              </li>
          </ul>
           
           <div class="tab-content tab-content1">
            <div id="home" class="tab-pane fade in active">
            <div class="col-sm-12" style=" margin:10px;">
              <div onclick="change_service()" id="slider_holder" class="slider_holder staffhours sliderdone">
            
              <input id="allservice" name="all_service" type="hidden" value="0">
              <span  id="off_service" class="slider_off Off sliders"> TẮT </span>
              <span  id="on_service" class="slider_on On sliders"> BẬT </span>
              <span  id="switch_service" class="slider_switch Switch"></span>

              
            

              </div> <lable style="margin-top: 3px;
            display: block;"> &nbsp; Giới hạn Dịch vụ và sản phẩm </lable>

          </div>
  <div class="clearfix"></div>
              <table id="add" class="input_value">
                <thead style="    border-bottom: 2px solid #ccc;">
                  <th style="width:40%;">Dịch vụ và sản phẩm</th>
                  <th style="width:20%;">Đơn giá&nbsp; (VNĐ)</th>
                  <th style="width:9%;">Số lượng</th>
                  <!-- <th>Promotion</th> -->
                  
                  <th style="width:22%;">Giá &nbsp;(VNĐ)</th>
                  <th style="width:10%;"></th>

                </thead>

                <tbody>

                 
                  <tr class="tradddeal">
                    <td class="dealservice" style="width:40%;">
                      <div class="service">
                        <select id="DealsService"  name="DealsService[]" class="form-control DealsService" onchange="servicedeal(this)"  >
                          <option>Chọn dịch vụ</option>
                          <?php 
                              $model = new Promotion;
                              foreach ($model->getservice("42") as $k=>$v){ 
                          ?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                          <?php } ?>                                              
                      </select>
                      </div>
                    </td>
                   
                    <td style="width:20%;" class="dealpri">
                      <input type="text" class="pricelabel num"  id="DealsPrice" placeholder="Đơn giá" readonly="readonly" style="border: 0px solid; width: 100%; background-color: #f1f5f6;  ">
                      <input type="text" class="price num" name="DealsPrice[]" id="DealsPrice" placeholder="Đơn giá" readonly="readonly" style="border: 0px solid; width: 100%; background-color: #f1f5f6; display: none; ">
                    </td>
                    <td style="width:9%;" class="dealnumber" >
                      <input type="number" min="1" class="form-control number " name="number[]" id="number" placeholder=""  onchange="sumprice(this)">
                    </td>
                    <td style="width:22%;">
                      <input type="text" class="allprice num" name="Deals" id="DealsPrice" readonly="readonly" style="border: 0px solid; width: 100%;background-color: #f1f5f6;  " placeholder="" value="0">
                    </td>
                    <td class="delete">
                      <button type="button" class="btn btn-default " onclick="myFunction(this)" style="border: 0px; background-color: rgba(204, 204, 204, 0.07);">
                              <img data-toggle="tooltip" title="" src="<?php echo yii::app()->request->baseUrl; ?>/images/icon_sb_left/delete-def.png" alt="" style="width: 15px; height:auto;" data-original-title="Xóa"> 
                      </button>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <td colspan="5">
                     <button type="button" id="addpro"  class="btn sbtnAdd btn_bookoke" data-dismiss="" style="padding: 1px 25px;" > <span class="glyphicon glyphicon-plus"></span> Sản phẩm</button>
                      <button type="button" id="addser"  class="btn sbtnAdd btn_bookoke" data-dismiss="" style="padding: 1px 25px;" data-dismiss=""> <span class="glyphicon glyphicon-plus"></span> Dịch vụ</button>
                  </td>
                </tfoot>
              </table>
              </div>
              <div id="cus" class="tab-pane fade">
                
                <?php include'customers.php'; ?>
              </div>
              <div id="store" class="tab-pane fade">
                
                <?php include'store.php'; ?>
              </div>
              <div id="payment" class="tab-pane fade">
                
                <p>Updating....</p>
              </div>
              </div>
            
               
            
             
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-sm-6" style="text-align: left;">
            
          </div>
          <div class="col-sm-6" style="float: right;">
          
            
            <button  class="btn sCancel btn_cancel" data-dismiss="modal">Hủy</button>
            <button class="btn Submit btn_bookoke" id="save" data-dismiss="" >Xác nhận</button>
          </div>
        </div>
        </form>
      </div>
      
    </div>
  </div>
  
</div>

<script type="text/javascript">
  
</script>


