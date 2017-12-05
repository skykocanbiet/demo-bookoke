<div class="modal fade" id="addPriceBookModal" tabindex="-1" role="dialog" aria-labelledby="addGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
       
        <div class="modal-header popHead sHeader">
           <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
            <h5>Tạo Bảng Giá Mới</h5>
         </div> 
         
        <div class="modal-body">

          <form id="frm-price-book" onsubmit="return false;"> 

            <div class="rg-row">    

              <div class="col-md-12">              

                <div class="rg-row">

                    <div class="col-sm-6">

                        <div class="form-group">

                            <span>Tên bảng giá <span style="color:red;">*</span></span>

                            <input required class="form-control" id="name" name="name" type="text"> 

                        </div>

                    </div>
                  

                    <div class="col-sm-6">  

                        <div class="form-group">

                            <span>Nhóm khách hàng <span style="color:red;">*</span></span>

                            <?php
                            $list_segment = array();  
                            
                            foreach($model->getListSegment() as $temp){
                              $list_segment[$temp['id']] = $temp['name'];
                            }
                             
                            echo CHtml::dropDownList('id_segment','',$list_segment,array('required'=>'required','class'=>'form-control','empty' => 'Chọn nhóm','options'=>array()));
                            ?>  

                        </div>

                    </div>                   

                </div>   

                <div class="rg-row">

                    <div class="col-sm-6">

                        <div class="form-group">

                        <span>Dịch vụ <span style="color:red;">*</span></span><br>  

                         <!--  <div class="input-group">

                              <div class="input-group-addon" style="padding:0px;background-color:#fff;text-align:left;">

                                  <div onclick="change_service()" class="slider_holder staffhours sliderdone">            
                                    <input id="hidden_service" type="hidden" value="1">
                                    <span  id="off_service" class="slider_off sliders"> TẮT </span>
                                    <span  id="on_service" class="slider_on sliders"> BẬT </span>
                                    <span  id="switch_service" class="slider_switch"></span>
                                  </div>

                              </div> -->
                              


                              <select required class="form-control" id="id_service" name="id_service[]" multiple="multiple">
                                  <optgroup label="Chọn tất cả">
                                      <?php                                                                               
                                      foreach ($model->getListService() as $key => $value) 
                                      {
                                      ?>
                                      <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
                                      <?php 
                                      }
                                      ?>
                                  </optgroup>                                          
                              </select>  

                              
                          <!-- </div> -->
                                  
                
                          

                                                      
                       
                            

                        </div>

                    </div>
                  

                    <div class="col-sm-6"> 

                      <div class="form-group">
                        <span>Loại tiền <span style="color:red;">*</span></span>                       
                        <select required class="form-control" name="currency_code">
                          <option value="VND">VND</option>
                          <option value="CAD">CAD</option>
                          <option value="CHF">CHF</option>
                          <option value="DKK">DKK</option>
                          <option value="EUR">EUR</option>
                          <option value="GBP">GBP</option>
                          <option value="HKD">HKD</option>
                          <option value="INR">INR</option>
                          <option value="JPY">JPY</option>
                          <option value="KRW">KRW</option>
                          <option value="KWD">KWD</option>
                          <option value="MYR">MYR</option>
                          <option value="NOK">NOK</option>
                          <option value="RUB">RUB</option>
                          <option value="SAR">SAR</option>
                          <option value="SEK">SEK</option>
                          <option value="SGD">SGD</option>
                          <option value="THB">THB</option>
                          <option value="USD">USD</option>                  
                        </select>
                      </div> 

                    </div>                   

                </div>  

                <div class="rg-row">                 

                  <div class="col-sm-6"> 

                     <div class="form-group">

                          <div onclick="change_effect()" class="slider_holder staffhours sliderdone">            
                            <input id="hidden_effect" name="effect" type="hidden" value="1">
                            <span  id="off_effect" class="slider_off sliders"> TẮT </span>
                            <span  id="on_effect" class="slider_on sliders"> BẬT </span>
                            <span  id="switch_effect" class="slider_switch"></span>
                          </div>                       

                          <span style="margin-left:10px;">Hiệu lực</span>  

                          

                        </div>

                  </div>

                  <div class="col-sm-6"> 

                     <div class="form-group">

                           <div id="change_time" onclick="change_time()" class="slider_holder staffhours sliderdone">            
                            <input id="hidden_time" type="hidden" value="0">
                            <span  id="off_time" class="slider_off Off sliders"> TẮT </span>
                            <span  id="on_time" class="slider_on On sliders"> BẬT </span>
                            <span  id="switch_time" class="slider_switch Switch"></span>

                          </div>                          

                          <span style="margin-left:10px;">Giới hạn thời gian</span> 

                          

                        </div>

                  </div>

                </div>            


                <div class="rg-row">                 

                  <div class="col-sm-12"> 

                     <div class="form-group">                          

                          <input type="text" class="form-control hidden" id="daterange" name="daterange" value="<?php echo date('m/d/Y h:mm A'); ?>"/>                                        

                        </div>

                  </div>

                </div>            


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

