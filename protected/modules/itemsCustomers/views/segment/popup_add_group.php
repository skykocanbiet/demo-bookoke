<div class="modal fade" id="addGroupModal" tabindex="-1" role="dialog" aria-labelledby="addGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
       
        <div class="modal-header popHead">
           <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
            <h5>Tạo Phân Khúc Mới</h5>
         </div> 
         
        <div class="modal-body">

          <form id="frm-segment" onsubmit="return false;"> 

            <div class="rg-row">    

              <div class="col-md-12">  

                <h5>Thông tin nhóm khách hàng</h5>  

                <div class="rg-row">

                    <div class="col-sm-5">

                        <div class="form-group">

                            <span for="name">Tên <span style="color:red;">*</span></span>

                            <input required class="form-control" id="name" name="name" type="text">                            

                        </div>

                    </div>

                    <div class="col-sm-2">

                      <div class="form-group">

                            <span for="color">Màu</span>

                            <input id="color" name="color" />

                        </div>                      

                    </div>

                    <div class="col-sm-5">  

                        <div id="rq-code" class="form-group">

                            <span for="code">Mã</span>

                            <input class="form-control" id="code" name="code" type="text"> 

                            <span class="help-block"></span>

                        </div>

                    </div>                   

                </div>   

              </div>

            </div>    


            <div class="form-group">

              <span for="description">Mô tả</span>

              <span class="char-count-container">

                  <textarea class="char-count-1000 form-control" id="description" name="description" rows="3"></textarea>
              
              </span>              

            </div>   


            <div class="rg-row">

                  <div class="col-md-12"> 

                  <h5>Chi tiết nhóm khách hàng</h5>

                  <div class="rg-row">

                    <div class="col-sm-4">

                        <div class="form-group">

                            <span>Rule</span>

                            <select id="rule" class="form-control" onchange="changeSegment();">

                              <option value="0">------</option>                
                              <option value="2">Giới tính</option>
                              <option value="3">Loại khách hàng</option>
                              <option value="4">Tỉnh/Thành</option>
                              <option value="5">Mã khách hàng</option>
                              <option value="6">Ngày sinh</option>
                              <option value="7">Điện thoại</option>
                              <option value="8">Email</option>                            
                              <option value="10">Trạng thái khách hàng</option>
                              <option value="11">Nguồn khách hàng</option>
                              <option value="12">Số lượng đơn hàng</option>                       
                              <option value="14">Ngày tạo</option>
                              <option value="15">Ngày đặt hàng lần đầu</option>
                              <option value="16">Ngày đặt hàng cuối cùng</option>                        

                            </select>

                        </div>

                    </div>


                    <div class="col-sm-8 field" data-value="0" style="display: none;">

                                        

                    </div>                  

                    <div class="col-sm-8 field" data-value="2" style="display: none;">

                      <div class="col-sm-6">

                        <div class="form-group">

                            <span>Giới tính</span>

                            <select name="gender" class="form-control">

                              <option value="0">Nam</option>
                              <option value="1">Nữ</option>                              

                            </select>

                        </div>  

                       </div>                             

                    </div>

                    <div class="col-sm-8 field" data-value="3" style="display: none;">

                      <div class="col-sm-6">

                        <div class="form-group">

                            <span>Loại khách hàng</span>

                            <select name="customer_type" class="form-control">

                              <option value="1">Khách hàng thân thiết</option>
                              <option value="2">Khách hàng thường</option>                              

                            </select>

                        </div>  

                       </div>                             

                    </div>

                    <div class="col-sm-8 field" data-value="4" style="display: none;">

                      <div class="col-sm-6">

                        <div class="form-group">

                            <span>Tỉnh/Thành</span>

                            <select name="region" class="form-control">

                              <?php
                              foreach($cities as $row){
                              ?>
                              <option value="<?php echo $row[0]?>"><?php echo $row[2]?></option>
                              <?php }?>                             

                            </select>

                        </div>  

                       </div>                             

                    </div>

                    <div class="col-sm-8 field" data-value="5" style="display: none;">

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Loại giá trị</span>

                            <select name="rule" class="form-control">

                              <option value="2">Có chứa chính xác chuỗi</option>
                              <option selected value="3">Có chưa chuỗi</option>    
                              <option value="4">Regex</option>                            

                            </select>

                        </div>   

                      </div>

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Giá trị</span>

                             <input name="value" class="form-control" type="text"> 

                        </div> 

                      </div>                                           

                    </div>


                    <div class="col-sm-8 field" data-value="6" style="display: none;">

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Ngày bắt đầu</span>

                           <input name="date_start" class="form-control" type="date" value="<?php echo date("Y-m-d");?>"> 

                        </div>   

                      </div>

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Ngày kết thúc</span>

                             <input name="date_end" class="form-control" type="date" value="<?php echo date("Y-m-d", strtotime('tomorrow'));?>"> 

                        </div> 

                      </div>                                           

                    </div>


                    <div class="col-sm-8 field" data-value="7" style="display: none;">

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Loại giá trị</span>

                            <select name="rule" class="form-control">

                              <option value="2">Có chứa chính xác chuỗi</option>
                              <option selected value="3">Có chưa chuỗi</option>    
                              <option value="4">Regex</option>                            

                            </select>

                        </div>   

                      </div>

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Giá trị</span>

                             <input name="value" class="form-control" type="text"> 

                        </div> 

                      </div>                                           

                    </div>


                    <div class="col-sm-8 field" data-value="8" style="display: none;">

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Loại giá trị</span>

                            <select name="rule" class="form-control">

                              <option value="2">Có chứa chính xác chuỗi</option>
                              <option selected value="3">Có chưa chuỗi</option>    
                              <option value="4">Regex</option>                            

                            </select>

                        </div>   

                      </div>

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Giá trị</span>

                             <input name="value" class="form-control" type="text"> 

                        </div> 

                      </div>                                           

                    </div>
                   

                    <div class="col-sm-8 field" data-value="10" style="display: none;">

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Trạng thái khách hàng</span>

                            <select name="customer_status" class="form-control">

                              <option value="1">Chưa liên hệ</option>
                              <option value="2">Đã liên hệ</option>    
                              <option value="3">Đã mua hàng</option>                            

                            </select>

                        </div>   

                      </div>                                                      

                    </div>


                    <div class="col-sm-8 field" data-value="11" style="display: none;">

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Nguồn khách hàng</span>

                            <select name="customer_origin" class="form-control">

                              <option value="1">Facebook</option>
                              <option value="2">Telesale</option>    
                              <option value="3">Website</option>                            

                            </select>

                        </div>   

                      </div>                                                      

                    </div>

                    <div class="col-sm-8 field" data-value="12" style="display: none;">

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Giá trị</span>

                            <input name="value" class="form-control" type="text"> 

                        </div>   

                      </div>

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Giá trị kết thúc</span>

                             <input name="value_end" class="form-control" type="text"> 

                        </div> 

                      </div>                                           

                    </div>                   

                    <div class="col-sm-8 field" data-value="14" style="display: none;">

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Ngày bắt đầu</span>

                           <input name="date_start" class="form-control" type="date" value="<?php echo date("Y-m-d");?>"> 

                        </div>   

                      </div>

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Ngày kết thúc</span>

                             <input name="date_end" class="form-control" type="date" value="<?php echo date("Y-m-d", strtotime('tomorrow'));?>"> 

                        </div> 

                      </div>                                           

                    </div>

                    <div class="col-sm-8 field" data-value="15" style="display: none;">

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Ngày bắt đầu</span>

                           <input name="date_start" class="form-control" type="date" value="<?php echo date("Y-m-d");?>"> 

                        </div>   

                      </div>

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Ngày kết thúc</span>

                             <input name="date_end" class="form-control" type="date" value="<?php echo date("Y-m-d", strtotime('tomorrow'));?>"> 

                        </div> 

                      </div>                                           

                    </div>

                    <div class="col-sm-8 field" data-value="16" style="display: none;">

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Ngày bắt đầu</span>

                           <input name="date_start" class="form-control" type="date" value="<?php echo date("Y-m-d");?>"> 

                        </div>   

                      </div>

                      <div class="col-sm-6">
                        
                        <div class="form-group">

                            <span>Ngày kết thúc</span>

                             <input name="date_end" class="form-control" type="date" value="<?php echo date("Y-m-d", strtotime('tomorrow'));?>"> 

                        </div> 

                      </div>                                           

                    </div>     

                    </div> 
           
                      <span> 
                        <a onclick="addRule();" class="btn btn_bookoke" type="button" style="margin-top:17px;">Thêm</a> 
                      </span>                    
       

                  </div>

                </div>   


                <div class="rg-row">

                    <div class="col-md-12">
                        
                        <table id="rule_items" class="table table-middle table-left">
                          <thead>
                            <tr>
                                <th>Rule</th>
                                <th>Loại giá trị</th>
                                <th>Giá trị</th>    
                                <th>Giá trị kết thúc</th>    
                                <th></th>                      
                            </tr>
                          </thead>
                          <tbody>   
                                <tr id="no_record"><td colspan="5" style="text-align:center;">Không có dữ liệu nào!</td></tr>
                          </tbody>
                        </table>

                    </div>

                </div>

                <div class="modal-footer" style="border-top:0px;">   
                  <button type="button" class="btn btn_cancel" data-dismiss="modal">Hủy</button>
                  <button type="submit" class="btn btn_bookoke">Xác nhận</button>
              </div>
            
          </form>

        </div>        

      </div>
    </div>
</div>

