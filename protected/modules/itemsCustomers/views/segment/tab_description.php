<?php 
$baseUrl = Yii::app()->baseUrl;
$cities = array(array(1,1,"An Giang","An Giang"),array(2,1,"Bà Rịa-Vũng Tàu","Bà Rịa-Vũng Tàu"),array(3,1,"Bạc Liêu","Bạc Liêu"),array(4,1,"Bắc Kạn","Bắc Kạn"),array(5,1,"Bắc Giang","Bắc Giang"),array(6,1,"Bắc Ninh","Bắc Ninh"),array(7,1,"Bến Tre","Bến Tre"),array(8,1,"Bình Dương","Bình Dương"),array(9,1,"Bình Định","Bình Định"),array(10,1,"Bình Phước","Bình Phước"),array(11,1,"Bình Thuận","Bình Thuận"),array(12,1,"Cà Mau","Cà Mau"),array(13,1,"Cao Bằng","Cao Bằng"),array(14,1,"Cần Thơ (TP)","Cần Thơ (TP)"),array(15,1,"Đà Nẵng (TP)","Đà Nẵng (TP)"),array(16,1,"Đắk Lắk","Đắk Lắk"),array(17,1,"Đắk Nông","Đắk Nông"),array(18,1,"Điện Biên","Điện Biên"),array(19,1,"Đồng Nai","Đồng Nai"),array(20,1,"Đồng Tháp","Đồng Tháp"),array(21,1,"Gia Lai","Gia Lai"),array(22,1,"Hà Giang","Hà Giang"),array(23,1,"Hà Nam","Hà Nam"),array(24,1,"Hà Nội (TP)","Hà Nội (TP)"),array(25,1,"Hà Tây","Hà Tây"),array(26,1,"Hà Tĩnh","Hà Tĩnh"),array(27,1,"Hải Dương","Hải Dương"),array(28,1,"Hải Phòng (TP)","Hải Phòng (TP)"),array(29,1,"Hòa Bình","Hòa Bình"),array(30,1,"Hồ Chí Minh (TP)","Hồ Chí Minh (TP)"),array(31,1,"Hậu Giang","Hậu Giang"),array(32,1,"Hưng Yên","Hưng Yên"),array(33,1,"Khánh Hòa","Khánh Hòa"),array(34,1,"Kiên Giang","Kiên Giang"),array(35,1,"Kon Tum","Kon Tum"),array(36,1,"Lai Châu","Lai Châu"),array(37,1,"Lào Cai","Lào Cai"),array(38,1,"Lạng Sơn","Lạng Sơn"),array(39,1,"Lâm Đồng","Lâm Đồng"),array(40,1,"Long An","Long An"),array(41,1,"Nam Định","Nam Định"),array(42,1,"Nghệ An","Nghệ An"),array(43,1,"Ninh Bình","Ninh Bình"),array(44,1,"Ninh Thuận","Ninh Thuận"),array(45,1,"Phú Thọ","Phú Thọ"),array(46,1,"Phú Yên","Phú Yên"),array(47,1,"Quảng Bình","Quảng Bình"),array(48,1,"Quảng Nam","Quảng Nam"),array(49,1,"Quảng Ngãi","Quảng Ngãi"),array(50,1,"Quảng Ninh","Quảng Ninh"),array(51,1,"Quảng Trị","Quảng Trị"),array(52,1,"Sóc Trăng","Sóc Trăng"),array(53,1,"Sơn La","Sơn La"),array(54,1,"Tây Ninh","Tây Ninh"),array(55,1,"Thái Bình","Thái Bình"),array(56,1,"Thái Nguyên","Thái Nguyên"),array(57,1,"Thanh Hóa","Thanh Hóa"),array(58,1,"Thừa Thiên - Huế","Thừa Thiên - Huế"),array(59,1,"Tiền Giang","Tiền Giang"),array(60,1,"Trà Vinh","Trà Vinh"),array(61,1,"Tuyên Quang","Tuyên Quang"),array(62,1,"Vĩnh Long","Vĩnh Long"),array(63,1,"Vĩnh Phúc","Vĩnh Phúc"),array(64,1,"Yên Bái","Yên Bái"));
?>

<div class="customerProfileContainer">

<div class="customerProfileHolder" style="display: block;margin:30px auto;">

<form id="ffrm-segment" onsubmit="return false;">

<input type="hidden" name="id_segment" value="<?php echo $model['id'];?>"/>

<div class="rg-row">    

  <div class="col-md-12">  

    <h5>Thông tin nhóm khách hàng</h5>  

    <div class="rg-row">

        <div class="col-sm-5">

            <div class="form-group">

                <span>Tên</span>

                <input required class="form-control" type="text" name="name" value="<?php echo $model['name'];?>">

            </div>

        </div>

        <div class="col-sm-2">

          <div class="form-group">

                <span>Màu</span>
                </br>
                <input id="ccolor" name="color" value="<?php echo $model['color'];?>">          

            </div>                      

        </div>

        <div class="col-sm-5">  

            <div id="rrq-code" class="form-group">

                <span>Mã</span>

                <input class="form-control" type="text" name="code" value="<?php echo $model['code'];?>">                                          
                <span class="help-block"></span>

            </div>

        </div>                   

    </div>   

  </div>

</div>    


<div class="form-group">

  <span>Mô tả</span>

  <span class="char-count-container">

      <textarea class="char-count-1000 form-control" name="description" rows="3"><?php echo $model['description'];?></textarea>
  
  </span>              

</div>   


<div class="rg-row">

                  <div class="col-md-12"> 

                  <h5>Chi tiết nhóm khách hàng</h5>

                  <div class="rg-row">

                    <div class="col-sm-4">

                        <div class="form-group">

                            <span>Rule</span>

                            <select id="rrule" class="form-control" onchange="cchangeSegment();">

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


                    <div class="col-sm-8 ffield" data-vvalue="0" style="display: none;">

                                        

                    </div>                  

                    <div class="col-sm-8 ffield" data-vvalue="2" style="display: none;">

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

                    <div class="col-sm-8 ffield" data-vvalue="3" style="display: none;">

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

                    <div class="col-sm-8 ffield" data-vvalue="4" style="display: none;">

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

                    <div class="col-sm-8 ffield" data-vvalue="5" style="display: none;">

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


                    <div class="col-sm-8 ffield" data-vvalue="6" style="display: none;">

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


                    <div class="col-sm-8 ffield" data-vvalue="7" style="display: none;">

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


                    <div class="col-sm-8 ffield" data-vvalue="8" style="display: none;">

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
                   

                    <div class="col-sm-8 ffield" data-vvalue="10" style="display: none;">

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


                    <div class="col-sm-8 ffield" data-vvalue="11" style="display: none;">

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

                    <div class="col-sm-8 ffield" data-vvalue="12" style="display: none;">

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

                    <div class="col-sm-8 ffield" data-vvalue="14" style="display: none;">

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

                    <div class="col-sm-8 ffield" data-vvalue="15" style="display: none;">

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

                    <div class="col-sm-8 ffield" data-vvalue="16" style="display: none;">

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
                        <a onclick="aaddRule();" class="btn btn_bookoke" type="button" style="margin-top:17px;">Thêm</a> 
                      </span>                    
       

                  </div>

                </div>    


    <div class="rg-row">

        <div class="col-md-12">
            
            <table id="rrule_items" class="table table-middle table-left">
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
                    <?php 
                    if (!empty($listSegmentRule)) {           
                    foreach ($listSegmentRule as $keyal => $modelal) { 
                       
                    switch ($modelal['rule']) {
                        case 2:                                                       
                            $rule       = "Giới tính";
                            $modelalue_type = "Loại số";
                            $modelalue      = $modelal['value']==0?"Nữ":"Nam";
                            $modelalue_end  = "";
                            break;
                        case 3:
                            $rule       = "Loại khách hàng";
                            $modelalue_type = "Loại số";
                            $modelalue      = $modelal['value']==1?"Khách hàng thân thiết":"Khách hàng thường";
                            $modelalue_end  = "";
                            break;
                        case 4:
                            $rule       = "Tỉnh/Thành";
                            $modelalue_type = "Loại số";
                            foreach($cities as $row){  
                                if ($row[0] == $modelal['value']) {
                                    $modelalue      = $row[2];                                                     
                                } 
                            }                                                         
                            $modelalue_end  = "";
                            break; 
                        case 5:
                            $rule       = "Mã khách hàng";
                            if ($modelal['value_type'] == 2) {
                                $modelalue_type = "Có chứa chính xác chuỗi";
                            }elseif ($modelal['value_type'] == 3) {
                                $modelalue_type = "Có chưa chuỗi";
                            }else {
                                $modelalue_type = "Regex";
                            }                                                        
                            $modelalue      = $modelal['value'];
                            $modelalue_end  = "";
                            break;  
                        case 7:
                            $rule       = "Điện thoại";
                            if ($modelal['value_type'] == 2) {
                                $modelalue_type = "Có chứa chính xác chuỗi";
                            }elseif ($modelal['value_type'] == 3) {
                                $modelalue_type = "Có chưa chuỗi";
                            }else {
                                $modelalue_type = "Regex";
                            }                                                        
                            $modelalue      = $modelal['value'];
                            $modelalue_end  = "";
                            break;  
                        case 8:
                            $rule       = "Email";
                            if ($modelal['value_type'] == 2) {
                                $modelalue_type = "Có chứa chính xác chuỗi";
                            }elseif ($modelal['value_type'] == 3) {
                                $modelalue_type = "Có chưa chuỗi";
                            }else {
                                $modelalue_type = "Regex";
                            }                                                        
                            $modelalue      = $modelal['value'];
                            $modelalue_end  = "";
                            break;  
                        case 6:
                            $rule       = "Ngày sinh";
                            $modelalue_type = "Loại số";                                                       
                            $modelalue      = date('d/m/Y',strtotime($modelal['value']));
                            $modelalue_end  = date('d/m/Y',strtotime($modelal['value_end']));
                            break;  
                        case 14:
                            $rule       = "Ngày tạo";
                            $modelalue_type = "Loại số";                                                       
                            $modelalue      = date('d/m/Y',strtotime($modelal['value']));
                            $modelalue_end  = date('d/m/Y',strtotime($modelal['value_end']));
                            break; 
                        case 15:
                            $rule       = "Ngày đặt hàng lần đầu";
                            $modelalue_type = "Loại số";                                                       
                            $modelalue      = date('d/m/Y',strtotime($modelal['value']));
                            $modelalue_end  = date('d/m/Y',strtotime($modelal['value_end']));
                            break; 
                        case 16:
                            $rule       = "Ngày đặt hàng cuối cùng";
                            $modelalue_type = "Loại số";                                                       
                            $modelalue      = date('d/m/Y',strtotime($modelal['value']));
                            $modelalue_end  = date('d/m/Y',strtotime($modelal['value_end']));
                            break;  
                        case 10:
                            $rule       = "Trạng thái khách hàng";
                            $modelalue_type = "Loại số";                                                      
                            if ($modelal['value'] == 1) {
                                $modelalue = "Chưa liên hệ";
                            }elseif ($modelal['value'] == 2) {
                                $modelalue = "Đã liên hệ";
                            }else {
                                $modelalue = "Đã mua hàng";
                            }  
                            $modelalue_end  = "";
                            break;   
                        case 11:
                            $rule       = "Nguồn khách hàng";
                            $modelalue_type = "Loại số";                                                      
                            if ($modelal['value'] == 1) {
                                $modelalue = "Facebook";
                            }elseif ($modelal['value'] == 2) {
                                $modelalue = "Telesale";
                            }else {
                                $modelalue = "Website";
                            }  
                            $modelalue_end  = "";
                            break;  
                        case 12:
                            $rule       = "Số lượng đơn hàng";
                            $modelalue_type = "Loại số";                                                      
                            $modelalue      = $modelal['value'];
                            $modelalue_end  = $modelal['value_end'];
                            break;                                              
                    }  

                    ?>
                    <tr id="rr<?php echo $keyal;?>">
                        <td data-rrule="<?php echo $modelal['rule'];?>"><?php echo $rule;?></td>
                        <td data-ttype-value="<?php echo $modelal['value_type'];?>"><?php echo $modelalue_type;?></td>
                        <td data-vvalue="<?php echo $modelal['value'];?>"><?php echo $modelalue;?></td>
                        <td data-vvalue-end="<?php echo $modelal['value_end'];?>"><?php echo $modelalue_end;?></td>
                        <td><img onclick="ddeleteRule(<?php echo $keyal;?>);" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;"></td>
                    </tr>
                    <?php 
                    } }else {
                    ?>
                    <tr id="nno_record"><td colspan="5" style="text-align:center;">Không có dữ liệu nào!</td></tr>
                    <?php     
                    } 
                    ?>                                                
              </tbody>
            </table>

        </div>

    </div>  

    <?php 
    if (isset($model['id'])) {
    ?>
    <div class="col-md-12">
        <div>
            <div>
            <button type="submit" class="btn btn_bookoke">Cập nhật</button>    
            </div>
        </div>
    </div>                            
    <?php 
    }
    ?>
</form>

</div>

</div>

<script type="text/javascript">

var baseUrl = $('#baseUrl').val();



function cchangeSegment(){ 

    var rule = $('#rrule').val();  

    var $set = $('div[data-vvalue]');

    var len = $set.length;

    $set.each(function(index, element) { 

        var field = $(this).attr('data-vvalue'); 
      
        if (field == rule) {         
            $('.ffield').css("display", "none");
            $(this).css("display", "block");
        }

    });

}



function aaddRule(){   

    var k        = $('#rrule').val();  
    
    var selected = $('#rrule option:selected').text();    
    
    if(k != 0 && selected != '------'){

        if (($("#nno_record").length > 0)){
           $("#nno_record").remove();
        }

        var number_rule = $('td[data-rrule]').length;   

        $(".ffield").each(function(){  

            if($(this).css('display') == 'block') {    

                var data_value = $(this).attr('data-vvalue'); 

                var value_end = $(this).find('input[name=value_end]').val();

                if (data_value==2) {

                    var val = $(this).find('select[name=gender]').val();

                    var text = $(this).find('select[name=gender] option:selected').text(); 
                   
                    $("#rrule_items").find('tbody')
                    .append($('<tr id="rr'+number_rule+'">')
                        .append('<td data-rrule="'+k+'">'+selected+'</td>')
                        .append('<td data-ttype-value="1">Loại số</td>')  
                        .append('<td data-vvalue="'+val+'">'+text+'</td>')   
                        .append('<td data-vvalue-end=""></td>')                      
                        .append($('<td>')  
                            .append('<img onclick="ddeleteRule('+number_rule+');" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;">')                        
                        )                        
                    );

                }else if (data_value==3) {

                    var val = $(this).find('select[name=customer_type]').val();

                    var text = $(this).find('select[name=customer_type] option:selected').text(); 
                   
                    $("#rrule_items").find('tbody')
                    .append($('<tr id="rr'+number_rule+'">')
                        .append('<td data-rrule="'+k+'">'+selected+'</td>')
                        .append('<td data-ttype-value="1">Loại số</td>')  
                        .append('<td data-vvalue="'+val+'">'+text+'</td>')   
                        .append('<td data-vvalue-end=""></td>')                      
                        .append($('<td>')                            
                            .append('<img onclick="ddeleteRule('+number_rule+');" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;">')  
                        )                        
                    );

                }else if (data_value==4) {

                    var val = $(this).find('select[name=region]').val();

                    var text = $(this).find('select[name=region] option:selected').text(); 
                   
                    $("#rrule_items").find('tbody')
                    .append($('<tr id="rr'+number_rule+'">')
                        .append('<td data-rrule="'+k+'">'+selected+'</td>')
                        .append('<td data-ttype-value="1">Loại số</td>')  
                        .append('<td data-vvalue="'+val+'">'+text+'</td>')   
                        .append('<td data-vvalue-end=""></td>')                      
                        .append($('<td>')                            
                            .append('<img onclick="ddeleteRule('+number_rule+');" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;">')  
                        )                        
                    );

                }else if (data_value==5 || data_value==7 || data_value==8) {

                    var val_rule = $(this).find('select[name=rule]').val();

                    var text_rule = $(this).find('select[name=rule] option:selected').text(); 

                    var val = $(this).find('input[name=value]').val();                
                   
                    $("#rrule_items").find('tbody')
                    .append($('<tr id="rr'+number_rule+'">')
                        .append('<td data-rrule="'+k+'">'+selected+'</td>')
                        .append('<td data-ttype-value="'+val_rule+'">'+text_rule+'</td>')  
                        .append('<td data-vvalue="'+val+'">'+val+'</td>')   
                        .append('<td data-vvalue-end=""></td>')                      
                        .append($('<td>')                            
                            .append('<img onclick="ddeleteRule('+number_rule+');" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;">')  
                        )                        
                    );

                }else if (data_value==6 || data_value==14 || data_value==15 || data_value==16) {

                    var date_start_value = $(this).find('input[name=date_start]').val();

                    var split_start_value = date_start_value.split("-");

                    var date_start_text = split_start_value[2]+'/'+split_start_value[1]+'/'+split_start_value[0];  

                    var date_end_value = $(this).find('input[name=date_end]').val();

                    var split_end_value = date_end_value.split("-");

                    var date_end_text = split_end_value[2]+'/'+split_end_value[1]+'/'+split_end_value[0];  
                   
                    $("#rrule_items").find('tbody')
                    .append($('<tr id="rr'+number_rule+'">')
                        .append('<td data-rrule="'+k+'">'+selected+'</td>')
                        .append('<td data-ttype-value="1">Loại số</td>')  
                        .append('<td data-vvalue="'+date_start_value+'">'+date_start_text+'</td>')   
                        .append('<td data-vvalue-end="'+date_end_value+'">'+date_end_text+'</td>')                      
                        .append($('<td>')                            
                            .append('<img onclick="ddeleteRule('+number_rule+');" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;">')  
                        )                        
                    );

                }else if (data_value==10) {

                    var val = $(this).find('select[name=customer_status]').val();

                    var text = $(this).find('select[name=customer_status] option:selected').text(); 
                   
                    $("#rrule_items").find('tbody')
                    .append($('<tr id="rr'+number_rule+'">')
                        .append('<td data-rrule="'+k+'">'+selected+'</td>')
                        .append('<td data-ttype-value="1">Loại số</td>')  
                        .append('<td data-vvalue="'+val+'">'+text+'</td>')   
                        .append('<td data-vvalue-end=""></td>')                      
                        .append($('<td>')                            
                            .append('<img onclick="ddeleteRule('+number_rule+');" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;">')  
                        )                        
                    );

                }else if (data_value==11) {

                    var val = $(this).find('select[name=customer_origin]').val();

                    var text = $(this).find('select[name=customer_origin] option:selected').text(); 
                   
                    $("#rrule_items").find('tbody')
                    .append($('<tr id="rr'+number_rule+'">')
                        .append('<td data-rrule="'+k+'">'+selected+'</td>')
                        .append('<td data-ttype-value="1">Loại số</td>')  
                        .append('<td data-vvalue="'+val+'">'+text+'</td>')   
                        .append('<td data-vvalue-end=""></td>')                      
                        .append($('<td>')                            
                            .append('<img onclick="ddeleteRule('+number_rule+');" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;">')  
                        )                        
                    );

                }else if (data_value==12) {

                    var value = $(this).find('input[name=value]').val();   

                    var value_end = $(this).find('input[name=value_end]').val();
                   
                    $("#rrule_items").find('tbody')
                    .append($('<tr id="rr'+number_rule+'">')
                        .append('<td data-rrule="'+k+'">'+selected+'</td>')
                        .append('<td data-ttype-value="1">Loại số</td>')  
                        .append('<td data-vvalue="'+value+'">'+value+'</td>')   
                        .append('<td data-vvalue-end="'+value_end+'">'+value_end+'</td>')                      
                        .append($('<td>')                            
                            .append('<img onclick="ddeleteRule('+number_rule+');" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" style="width: 15px;cursor:pointer;">')  
                        )                        
                    );

                }

            }

        });   

    }
    
}

function ddeleteRule(number_rule){   
    if (confirm("Bạn có thật sự muốn xóa?")) {  
        var evt = window.event || arguments.callee.caller.arguments[0];
        evt.preventDefault(); 
        $('#rr'+number_rule).remove();   
        if (($("#rrule_items tbody tr").length == 0)){
           $("#rrule_items").find('tbody').append($('<tr id="nno_record">').append('<td colspan="5" style="text-align:center;">Không có dữ liệu nào!</td>'));
        }     
        evt.stopPropagation();
    }
}



$('#ffrm-segment').submit(function(e) {
         
    $('.cal-loading').fadeIn('fast');       

    if (($("#nno_record").length == 0)){

        var segment_rule = []; 

        $("#rrule_items > tbody > tr").each(function(){  

            var rule       = $(this).children('td:nth-child(1)').attr('data-rrule'); 
            var value_type = $(this).children('td:nth-child(2)').attr('data-ttype-value'); 
            var value      = $(this).children('td:nth-child(3)').attr('data-vvalue');
            var value_end  = $(this).children('td:nth-child(4)').attr('data-vvalue-end');      

            var response = {};

            response['rule']       = rule; 
            response['value_type'] = value_type; 
            response['value']      = value;
            response['value_end']  = value_end;

            segment_rule.push(response);   

        });

    }else {

        var segment_rule = "";

    }  

    var formData = new FormData($('#ffrm-segment')[0]); 

    formData.append('segment_rule',JSON.stringify(segment_rule));  

    if (!formData.checkValidity || formData.checkValidity()) {  

    jQuery.ajax({
        type:'POST',
        url: baseUrl+'/itemsCustomers/Segment/updateSegment',
        data:formData,
        datatype:'json',
        success:function(data){  
            if (data == -2) {                                       
                $('#rrq-code').addClass('error').find('.help-block').html('Mã đã tồn tại');
                $('.cal-loading').fadeOut('slow');
        
            }else if(data == 1) {
                $('#rrq-code').removeClass('error').find('.help-block').html('');
                $('.cal-loading').fadeOut('slow'); 
                window.location.assign("<?php echo CController::createUrl('Segment/admin')?>"); 
            } 
        },
        error: function(data){
            console.log("error");
            console.log(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });

    }

});

$("#ccolor").spectrum({
    preferredFormat: "name",
    showInput: true,
    showPalette: true,
    palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]]
});

$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();
    var customer_action = $(".customersActionHolder").height();  
    var customer_search = $(".customerSearchHolder").height();

    $('#profileSideNav').height(windowHeight-header);

    $('.customerListContainer').height(windowHeight-header);

    $('.statsTabContent').height(windowHeight-header-tab_menu-45);     

    $('#customerList').css('max-height', windowHeight-header-customer_action-customer_search-80);

});

$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();
    var customer_action = $(".customersActionHolder").height();    
    var customer_search = $(".customerSearchHolder").height();

    $('#profileSideNav').height(windowHeight-header);

    $('.customerListContainer').height(windowHeight-header);

    $('.statsTabContent').height(windowHeight-header-tab_menu-45);   

    $('#customerList').css('max-height', windowHeight-header-customer_action-customer_search-80);

});

</script>