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
.giamtheogiatri_edit{
    margin-top: 8px;
  }
.giamtheogiatri_edit th{
        text-align: left;
        background: #8ca7ae;
        border-right: 1px solid #fff;
        color: #fff;
        font-weight: 300;
  }
  .giamtheogiatri_edit tfoot td{
    text-align: left;
  }
  .giamtheogiatri_edit tbody td{
    background-color: #f1f5f6;
  }
</style>
<div class="container">
  

  <!-- Modal -->
  <div class="modal fade" id="edit_deals" role="dialog">
    <div class="modal-dialog">
    <div class="alert alert-danger canhbao" id="canhbao" style="    position: fixed;
    margin-left: -182px;
    left: 591px;
    top: 181px;
    z-index: 99999;
    box-shadow: 0 5px 15px #999;
    display:none;"><b>Giá trị nhập sai :</b> Giá trị cuối phải lớn hơn giá trị đầu</div>
      <!-- Modal content-->
      <div id="" class="modal-content">
      
        <div class="modal-header popHead" >
          <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
          <h5 class="modal-title" style="margin: 9px 0px;">CHỈNH SỬA CHƯƠNG TÌNH KHUYẾN MÃI</h5>
        </div>

        <form id="frm-edit-Deals" onsubmit="return false;" class="form-horizontal">
        <div class="modal-body clearfix">
        
          <div id="editdeals">
          <div class="col-sm-12">
          <div class="col-sm-2">
                <div id="image-holder" style="margin-top:10px;">
                    <img src="<?php echo Yii::app()->request->baseUrl;?>/images/img/placeholder_70x70.gif" id="file_preview_1" style="width: 100%; height:auto;" >
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
            <label>Name Deals</label>
            <input type="text" class="form-control  " name="dealsName" id="dealsName" placeholder="Name Deal" required="" >
          
          </div>
           <div  class="col-sm-6">
             <label>Company :</label>
                <select class="form-control " name="company" id="company" onchange="Dealscompany()" >
                  <option value="0">Select Company</option>
                          <?php
                                $pro = new Company();
                                $maps =  $pro->getCompanyDeals();
                                foreach ( $maps as $k => $v): 
                                                    ?>
                <option value="<?php echo $v['Id'] ?>"><?php echo $v['Name']; ?></option>
              <?php endforeach; ?>
              </select>
            </div>
           
            <div class="col-sm-6">
                <label>Start date :</label>
              
              <input type="text" class="form-control " name="daterange" value="<?php echo date('m/d/Y h:mm A'); ?> - <?php echo $month; ?>" onchange="startdate()" />
 
            </div>
            <div class="col-sm-6">
              <label>Status :</label>
               <select class="form-control" name="status_deal"  style="float:left;">
                        <option value="1">Pending</option>
                        <option value="2">Runding</option>
                        <option value="3">Paused</option>
                        <option value="4">Endsed</option>
                        <option value="-1">Removed</option>
                  </select>
            </div>
             <!-- <div style="width:100%;">
             
              <label>Description</label>
                    <textarea class="char-count-1000 form-control" cols="20" id="description_service" name="description_service" rows="2"></textarea>
            </div> -->
            </div>
            <div class="clearfix"></div>
            
            <div class="col-sm-2 pmt"><label>promotional:</label></div>
            <div class="col-sm-10 pmt">
               <div class="col-sm-6">
                 <select class="form-control" name="type_price" id="type_promotion" onchange="promotion_type()" style="float:left;">
                        <option value="0">Select promotional value</option>
                        <option value="1">phần trăm (%)</option>
                        <option value="2">giảm theo số tiền</option>
                        <option value="3">Bán giá cố định</option>
                        <option value="4">Giảm theo giá trị</option>
                  </select>
               </div>
               <div class="col-sm-6">
                 <input type="number" class="form-control input_value" name="value_promotion1" id="giamtheophantram"  placeholder="percent 1 - 100"  style=" width: 100%;" onchange="promotion()" >
                 <input type="number" class="form-control input_value" name="value_promotion2" id="giamtheosotien" placeholder="số tiền"  style=" width: 100%;" >
                  <input type="number" class="form-control input_value" name="value_promotion3" id="bangiacodinh" placeholder=""  style=" width: 100%;" >
               </div>
               <div class="clearfix"></div>
               <div class="col-sm-12">
                 <table class="table input_value giamtheogiatri123 " id="giamtheogiatri">
                   <thead>
                     <th></th>
                     <th>Start</th>
                     <th></th>
                     <th>End</th>
                     
                     <th>Decreases</th>
                     <th>Value</th>

                   </thead>
                   <tbody>
                   <?php for ($i=0; $i < 2 ; $i++): 
                     # code...
                    ?>
                     <tr>
                      <td><?php echo $i+1; ?></td>
                      <td><input type="number" min="1" class="form-control number " name="start_value[]" id="number" placeholder="Number"  onchange="sumprice(this)"></td>
                      <td> <span class="glyphicon glyphicon-chevron-right"></span> </td>
                      <td><input type="number" min="1" class="form-control number " name="end_value[]" id="number" placeholder="Number" onchange="sumprice(this)"></td>
                      
                      <td>
                          <select name="type_value[]" class="form-control ssl"  style="float:left;">
                            <option value="1">(%)</option>
                            <option value="2">Value</option>
                            <option value="3">Fixed value</option>
                          </select>
                      </td>
                      <td class="promotion_gt"><input type="number" min="1" class="form-control number " name="percent_value[]" id="number"  onchange="promotion_giatri(this)"></td>
                     </tr>
                   <?php endfor; ?>
                   </tbody>
                   <tfoot>
                    <td colspan="6">
                      <button type="button" id="add_giatri" class="btn btn-default" style="color: #fff;background-color: #40c74b; border-color: #40c74b;">Add</button>
             
                    </td>
                  </tfoot>
                 </table>
               </div>
            </div>
           <div class="clearfix"></div>
          
           <ul class="nav nav-tabs">
              <li class="active">
                <a data-toggle="tab" href="#home">Service and product</a>
              </li>
              <li>
               <a data-toggle="tab" href="#cus">Customer</a>
              </li>
              <li>
               <a data-toggle="tab" href="#store">Store</a>
              </li>
              <li>
               <a data-toggle="tab" href="#payment">Payment methods</a>
              </li>
          </ul>
           
           <div class="tab-content tab-content1">
            <div id="home" class="tab-pane fade in active">
              <table id="add">
                <thead style="    border-bottom: 2px solid #ccc;">
                  <th style="width:40%;">Product and Service</th>
                  <th style="width:15%;">unit price</th>
                  <th style="width:20%;">Number</th>
                  <!-- <th>Promotion</th> -->
                  
                  <th style="width:15%;">price</th>
                  <th style="width:10%;"></th>

                </thead>

                <tbody>

                 
                  <tr class="tradddeal">
                    <td class="dealservice" style="width:40%;">
                      <div class="service">
                        <select class="form-control" id="DealsService" style="float:left;">
                          <option>Service</option>
                        </select>
                      </div>
                    </td>
                    <td style="width:15%;" class="dealpri">
                      <input type="number" class="price" name="DealsPrice[]" id="DealsPrice" placeholder="Price" readonly="readonly" style="border: 0px solid; width: 100%;">
                    </td>
                    <td style="width:20%;" class="dealnumber" >
                      <input type="number" min="1" class="form-control number " name="number[]" id="number" placeholder="Number" required="number" onchange="sumprice(this)">
                    </td>
                    <td style="width:15%;">
                      <input type="number" class="allprice" name="Deals" id="DealsPrice" readonly="readonly" style="border: 0px solid; width: 100%; " placeholder="Price" value="0">
                    </td>
                    <td class="delete">
                      <button type="button" class="btn btn-default " onclick="myFunction(this)">
                              <span class="glyphicon glyphicon-trash"></span> 
                      </button>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <td colspan="5">
                     <button type="button" id="addpro" class="btn sCancel btn_cancel" > <span class="glyphicon glyphicon-plus"></span> Product</button>
                      <button type="button" id="addser" class="bbtn sCancel btn_cancel" data-dismiss="" > <span class="glyphicon glyphicon-plus"></span> Service</button>
                  </td>
                </tfoot>
              </table>
              </div>
              <div id="cus" class="tab-pane fade">
                
                <?php include'customers.php'; ?>
              </div>
              <div id="store" class="tab-pane fade">
                
                <p>updating....</p>
              </div>
              <div id="payment" class="tab-pane fade">
                
                <p>updating....</p>
              </div>
              </div>
            
               
            
             
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-sm-6" style="text-align: left;">
            
          </div>
          <div class="col-sm-6" style="float: right;">
            <button  class="btn sCancel btn_cancel" data-dismiss="modal">Hủy</button>
            <button class="btn Submit btn_bookoke" id="save" data-dismiss="" >Cập nhật</button>
            
          </div>
        </div>
        </div>
        </form>
      </div>
    
    </div>
  </div>
  
</div>
<script>
$(document).ready(function() {
       
//dieu kien
          
        //append addpro

         

 $("#add_giatri").click(function(){
    $("#giamtheogiatri").append(
      "<tr class='tradddeal'>"+
      '<td><?php echo $i++ ?></td>'+
     '<td><input type="number" min="1" class="form-control number " name="start_value[]" id="number" placeholder="Number" required="number" onchange="sumprice(this)"></td>' + 
     '<td> <span class="glyphicon glyphicon-chevron-right"></span> </td>'+
      '<td><input type="number" min="1" class="form-control number " name="end_value[]" id="number" placeholder="Number" required="number" onchange="sumprice(this)"></td>'+
                      
      '<td><select name="type_value[]" class="form-control" id="DealsService" style="float:left;">'+
              '<option value="1">(%)</option>'+
              '<option value="2">Value</option>'+
              '<option value="3">Fixed value</option>'+
            '</select>'+
      '</td>'+
      '<td><input type="number" min="1" class="form-control number " name="percent_value[]" id="number" placeholder="Number" required="number" onchange="sumprice(this)"></td>'+
     '</tr>');
 })
</script>
<?php include 'js_deals.php'; ?>
