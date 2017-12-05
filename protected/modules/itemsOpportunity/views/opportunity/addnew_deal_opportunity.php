<style>
.input-icon-prepend{position: relative;}
.add-icon-input{
    position: absolute;
    top: 4px;
    left: 9px;
    width: 10px;
    font-size: 17px;
    color: #000;
}
.input_addnew_deal{
     width: 95%;
    box-shadow: none !important;
}
.row_add_deal{
    margin-bottom:5px;
}
.modal_deal{
    width: 355px !important;
    margin-left: -175px !important;
}
#console_checkphone, #console_checkcontactpersonname, #console_checkorganizationname{
    width: 40px;
}
.lable_phone_new{
    position: absolute;
    top: 7px;
    right: 10px;
    background: #3498db;
    color: #fff;
    padding: 1px 8px;
    text-transform:uppercase;
    border: 1px solid #3498db;
    box-sizing:border-box;
    border-radius: 10px;
    font-size: 9px;
    text-shadow: 0px 1px 1px #c2c8cd;
    border: 1px solid #3498db;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -ms-box-sizing: border-box;
    -o-box-sizing: border-box;
}
.lable_phone_invalid{
    position: absolute;
    top: 7px;
    right: 10px;
    background: red;
    color: #fff;
    padding: 1px 8px;
    text-transform:uppercase;
    border: 1px solid red;
    box-sizing:border-box;
    border-radius: 10px;
    font-size: 9px;
    text-shadow: 0px 1px 1px #c2c8cd;
    border: 1px solid red;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -ms-box-sizing: border-box;
    -o-box-sizing: border-box;
}

.key_search{ 
    color: #0072f4;
}
.input-icon-prepend .dropdown-menu{
    width: 300px;
}

.input-icon-prepend .dropdown-menu a{
    padding:5px;
}
.dropdown-menu>li{
    border-top: 1px solid #ccd6dd;
}
.dropdown-menu>li:first-child{
    border-top:none;
}
.dropdown-menu>li a:hover .typeahead_wrapper .typeahead_primary { color: #fff !important;}
.dropdown-menu .active{
    color: #fff !important;
}
.dropdown-menu>li a:hover .typeahead_wrapper .typeahead_secondary { color: #fff !important;}
.typeahead_wrapper                             { display: block;width: 100%;margin: 0px auto;}
.typeahead_wrapper .typeahead_labels           { float: left; line-height: 19px; }
.typeahead_wrapper .typeahead_labels::after    { clear:both; }
.typeahead_wrapper .typeahead_primary          { font-size: 15px;  }
.typeahead_wrapper .typeahead_secondary        { font-size: 11px; color: #666;  }
.typeahead_wrapper .typeahead_userinfo         { float: right; line-height: 17px;}
.typeahead_wrapper .typeahead_userinfo::after  { clear: both; } 
.typeahead_wrapper .typeahead_userinfo .lable_accounts{ display: inline-block;font-size: 11px; color: #8899a6;width: 60px; text-align: right;}
.typeahead_wrapper .typeahead_userinfo .users_name{ display: inline-block;font-size: 12px;margin-left: 5px; width: 85px; }
.typeahead_wrapper .typeahead_userinfo .status{ display: inline-block;font-size: 12px;margin-left: 5px; width: 85px; }
</style>
<?php $baseUrl = Yii::app()->request->baseUrl;  ?>
<!-- Modal -->
<div class="modal fade" id="modalAddNewDeal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:800px;">
    <div class="modal-content">    
        <div class="modal-header popHead sHeader">
           <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
            <h5>THÊM CƠ HỘI</h5>
        </div> 
      <div class="modal-body">
        <form>

            <div class="row">
                <!-- Contact person name -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Tên người đại diện</label>  
                        <div id="console_checkcontactpersonname"></div>
                        <input id="addnew_contact_person_name" class="form-control" type="text" data-provide="typeahead" />
                    </div>
                </div>
                <!-- Organization name -->
                <!-- <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Tên công ty</label>
                        <div id="console_checkorganizationname"></div>
                        <input id="addnew_organization_name" class="form-control" type="text" data-provide="typeahead" />
                    </div>
                </div> -->

                <!-- Email -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Email</label>                      
                        <input id="addnew_email" class="form-control" type="text"/>
                    </div>
                </div> 

                 <!-- Phone -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Số điện thoại</label>                      
                        <input id="addnew_phone" class="form-control" type="text"/>
                    </div>
                </div>                

            </div>  

            <div class="row">

                <!-- Deal title -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Cơ hội</label>                        
                        <input id="addnew_title" class="form-control" type="text"/>
                    </div>
                </div>

                <!-- Deal Value -->
                <div class="col-md-4">
                    <div class="form-group">

                        <label class="form-control-label">Giá trị</label>  

                        <div class="input-group">
                            <input id="addnew_deal_value" class="form-control" type="text"/>
                            <div class="input-group-btn" style="width:77px;">                           
                                <select id="addnew_currency" class="form-control">
                                    <option value="VND">VND</option>
                                    <option value="USD">USD</option>                                    
                                </select>
                            </div>    
                        </div>   
                 
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Ngày dự kiến hoàn tất</label>
                        <input id="addnew_finish_date" class="form-control" type="text"/>
                    </div>
                </div>                

            </div>    

            <div class="row">
                <div class="col-md-12">
                    <label>Giai đoạn</label>
                    <span class="input stageOptionWrapper">
                        <div class="plainStages" id="stage-sVQKai7A">
                            <span id="addnew_stage" class="options">
                                <label class="widget-radio active" title="Lead In"><input type="radio" name="stage_id" value="1" checked="checked" tabindex="0" data-title="Lead In"/></label>
                                <label class="widget-radio" title="Contact Made"><input type="radio" name="stage_id" value="2" tabindex="0" data-title="Contact Made"/></label>
                                <label class="widget-radio" title="Needs Defined"><input type="radio" name="stage_id" value="3" tabindex="0" data-title="Needs Defined"/></label>
                                <label class="widget-radio" title="Proposal Made"><input type="radio" name="stage_id" value="4" tabindex="0" data-title="Proposal Made"/></label>
                                <label class="widget-radio" title="Negotiations Started"><input type="radio" name="stage_id" value="5" tabindex="0" data-title="Negotiations Started" /></label>
                            </span>
                       </div>
                    </span> 
                </div>       
            </div>
         

        </form>
      </div>
      <div class="modal-footer" style="border-top:0px;">
        <div id="alertAddnewDeal" class="hiden"></div> 
        <button type="button" class="btn btn_cancel" data-dismiss="modal">Hủy</button>
        <button onclick="AddnewDealOpportunity();" type="submit" class="btn btn_bookoke">Xác nhận</button>
      </div>
    </div>
  </div>
</div>

<!-- <div id="modalAddNewDeal" class="modal modal_deal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="left:50%;background-color: #fff;">

    <div class="modal-header" style="background-color: #f3f5f6;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel" style="margin: 0px;">Thêm cơ hội</h3>
    </div>
    
    <div class="modal-body" style="padding: 20px;">
        <div class="clearfix"></div>     

        
        <div class="row_add_deal">
            <label>Tên người đại diện</label>
            <div class="input-icon-prepend">
              <div class="add-icon-input"><i class="glyphicon glyphicon-user"></i></div>
              <div id="console_checkcontactpersonname"></div>
              <input id="addnew_contact_person_name" class="input_addnew_deal input-xlarge form-control" style="text-indent: 30px;" type="text" data-provide="typeahead" />
            </div>
        </div>

        
        <div class="row_add_deal">
            <label>Tên công ty</label>
            <div class="input-icon-prepend">
              <div class="add-icon-input"><i class="fa fa-building"></i></div>
              <div id="console_checkorganizationname"></div>
              <input id="addnew_organization_name" class="input_addnew_deal input-xlarge form-control" style="text-indent: 30px;" type="text" data-provide="typeahead" />
            </div>
        </div>
        
        
        <div class="row_add_deal">
            <label>Cơ hội</label>
            <div class="input-icon-prepend">
              <div class="add-icon-input" style="width: 17px; top: 5px;left: 6px;"><img src="<?php echo $baseUrl."/images/business-icon.png";?>" style="max-width: 100%;border: 0;"/></div>
              <input id="addnew_title" class="input_addnew_deal input-xlarge form-control" style="text-indent: 30px;" type="text"/>
            </div>
        </div>
        
        
        <div class="row_add_deal">
            <label style="display:block;">Giá trị</label>
            <span class="input-icon-prepend" style="width: 35%; display: inline-block;margin-right: 12px;" >             
              <input id="addnew_deal_value" class="input_addnew_deal input-xlarge form-control" type="text"/>
            </span>
            <span>
                <select id="addnew_currency" class="input-xlarge form-control" style="width: 55%;display: inline-block;" >
                    <option value="USD">US Dollar (USD)</option>
                    <option value="VND">Vietnamese Dong (VND)</option>
                </select>
            </span>
            <div class="clear"></div>
        </div>
        
        <div class="row_add_deal">
            <label>Giai đoạn</label>
			<span class="input stageOptionWrapper">
				<div class="plainStages" id="stage-sVQKai7A">
					<span id="addnew_stage" class="options">
						<label class="widget-radio active" title="Lead In"><input type="radio" name="stage_id" value="1" checked="checked" tabindex="0" data-title="Lead In"/></label>
						<label class="widget-radio" title="Contact Made"><input type="radio" name="stage_id" value="2" tabindex="0" data-title="Contact Made"/></label>
						<label class="widget-radio" title="Needs Defined"><input type="radio" name="stage_id" value="3" tabindex="0" data-title="Needs Defined"/></label>
						<label class="widget-radio" title="Proposal Made"><input type="radio" name="stage_id" value="4" tabindex="0" data-title="Proposal Made"/></label>
						<label class="widget-radio" title="Negotiations Started"><input type="radio" name="stage_id" value="5" tabindex="0" data-title="Negotiations Started" /></label>
					</span>
			   </div>
			</span>
        </div>
        
        <div class="row_add_deal">
            <label>Ngày dự kiến hoàn tất</label>
            <div class="input-icon-prepend">
              <div class="add-icon-input"><i class="fa fa-calendar"></i></div>
              <input id="addnew_finish_date" class="input_addnew_deal input-xlarge form-control" type="text" style="text-indent: 35px;"/>
            </div>
        </div>
        
    </div>
    
    <div class="modal-footer" style="background-color: #f3f5f6;position: relative;">
        <div id="alertAddnewDeal" class="hiden" style="position: absolute;top: 10px;left:10px;"></div>
        <span onclick="AddnewDealOpportunity();" class="btn btn-success">Lưu lại</span>
    </div>

</div> -->


<script>
$("input:radio[name=stage_id]").click(function() {
    $(".widget-radio").removeClass('active');
    $(this).parent().addClass('active');
});

$('#addnew_finish_date').datepicker({
    showButtonPanel: true,
    closeText: 'Clear',
    dateFormat: "dd/mm/yy",
    minDate: new Date(),
});

var wto;
// $( "#addnew_phone").change(function(e) {
//     clearTimeout(wto);
//     var phone = $(this).val();
//     wto = setTimeout(function() {
//         if(phone.length > 0){
//             $("#addnew_title").val(phone+' deal');
//             checkPhoneOpp(phone);
//         }else{
//             $("#console_checkphone").html('');
//             $("#addnew_title").val('');
//         }
//     }, 1000);
  
    
// });

$( "#addnew_contact_person_name").change(function(e) {
    clearTimeout(wto);
    var contactpersonname = $(this).val();   
    wto = setTimeout(function() {  
        if(contactpersonname.length > 0){            
            $("#addnew_title").val(contactpersonname);
            checkContactPersonNameOpp(contactpersonname);        
        }else{
            $("#console_checkcontactpersonname").html('');
            $("#addnew_title").val('');
        }  
    }, 1000);
  
    
});

$( "#addnew_organization_name").change(function(e) {
    clearTimeout(wto);
    var organizationname = $(this).val();
    wto = setTimeout(function() {
        if(organizationname.length > 0){
            $("#addnew_title").val(organizationname+' deal');
            checkOrganizationNameOpp(organizationname);
        }else{
            $("#console_checkorganizationname").html('');
            $("#addnew_title").val('');
        }
    }, 1000);
  
    
});

function checkPhoneOpp(phone){
    jQuery.ajax({
            type:"POST",
            url:"<?php echo CController::createUrl('Opportunity/check_phone_opportunity')?>",
            data:{
                phone  : phone,
            },
            success:function(data){
                if(data == ''){
                    $("#console_checkphone").html('<span class="lable lable_phone_new">New</span>');
                }else if(data == 0){
                    $("#console_checkphone").html('<span class="lable lable_phone_invalid">Invalid !</span>');
                }else{
                    $("#console_checkphone").html('');
                }
            },
            error: function(data){ 
                alert("Error occured.Please try again!");
            },
    });
}

function checkContactPersonNameOpp(contactpersonname){
    jQuery.ajax({
            type:"POST",
            url:"<?php echo CController::createUrl('Opportunity/check_contact_person_name_opportunity')?>",
            data:{
                contactpersonname  : contactpersonname,
            },
            success:function(data){                 
                if(data == ''){
                    $("#console_checkcontactpersonname").html('');
                }else if(data == 0){
                    $("#console_checkcontactpersonname").html('<span class="lable lable_phone_new">New</span>');
                }else{
                    $("#console_checkcontactpersonname").html('');
                }
            },
            error: function(data){ 
                alert("Error occured.Please try again!");
            },
    });
}

function checkOrganizationNameOpp(organizationname){
    jQuery.ajax({
            type:"POST",
            url:"<?php echo CController::createUrl('Opportunity/check_organization_name_opportunity')?>",
            data:{
                organizationname  : organizationname,
            },
            success:function(data){                 
                if(data == ''){
                    $("#console_checkorganizationname").html('');
                }else if(data == 0){
                    $("#console_checkorganizationname").html('<span class="lable lable_phone_new">New</span>');
                }else{
                    $("#console_checkorganizationname").html('');
                }
            },
            error: function(data){ 
                alert("Error occured.Please try again!");
            },
    });
}
</script>


<script type="text/javascript">
// $(document).ready(function() {
    
//     // use this hash to cache search results
//     window.query_cache = {};
    
//     $('#addnew_phone').typeahead({
//         minLength:3,
//         source: function (phone, process) {
//         if(query_cache[phone]){
//               process(query_cache[phone]);
//               return;
//         }
//         if( typeof searching != "undefined") {
//               clearTimeout(searching);
//               process([]);
//         }
        
//         $.ajax({
//             url: '<?php echo CController::createUrl('Opportunity/ListPhoneContact')?>',
//             type: 'POST',
//             dataType: 'JSON',
//             data:{
//                 phone        : phone,
//             },
//             success: function(data){   

//                 Accounts = {};
//                 AccountLabels = [];
//                 map = [];
                
//                 $.each(data, function(i, v){
                   
//                     Accounts[ v.phone ] = {
//                         idlead  : v.idlead
//                         ,name   : v.lastname + ' ' + v.firstname
//                         ,phone  : v.phone
//                         ,user   : v.user_names
//                         ,status : v.status
//                     };
    
//                     AccountLabels.push(v.phone);
                    
//                 })
//                 return process(AccountLabels);
//             }
//         });
        
//         },
//         highlighter: function(item){
         
//             var p = Accounts[item];
            
//             if(p.name.length > 1){
//                 fullname =  p.name ; 
//             }else{
//                 fullname = 'N/A';
//             }
            
//             if(p.status == 0 || p.status == '' || p.status == null ){
//                 accountstatus = 'Lead';
//             }else if(p.status == 1 ){
//                 accountstatus = 'Account';
//             }else{
//                 accountstatus = 'N/A';
//             }
            
//             var rep_phone = p.phone.replace(this.query,'<strong>'+this.query+'</strong>');
            
//             var itm = ''
//                      + "<div class='typeahead_wrapper'>"
//                      + "<div class='typeahead_labels'>"
//                      + "<div class='typeahead_primary'>" + rep_phone + "</div>"
//                      + "<div class='typeahead_secondary'>" +  fullname + "</div>"
//                      + "</div>"
//                      + "<div class='typeahead_userinfo'>"
//                      + "<div class='status_account'><span class='lable_accounts'>Status :</span><span class='status'>"+ accountstatus +"</span></div>"
//                      + "<div class='user_account'><span class='lable_accounts'>Manager :</span><span class='users_name'>" + p.user + "</span></div>"
//                      + "</div><div class='clearfix'></div>"
//                      + "</div>";
//             return itm;
//         }

//     });
    
// });
$(document).ready(function() {
    
    // use this hash to cache search results
    window.query_cache = {};
    
    $('#addnew_contact_person_name').typeahead({
        minLength:2,
        source: function (contact_person_name, process) {
        if(query_cache[contact_person_name]){
              process(query_cache[contact_person_name]);
              return;
        }
        if( typeof searching != "undefined") {
              clearTimeout(searching);
              process([]);
        }
        
        $.ajax({           
            url: '<?php echo CController::createUrl('Opportunity/ListContactPersonNameContact')?>',
            type: 'POST',
            dataType: 'JSON',
            data:{
                contact_person_name        : contact_person_name,
            },
            success: function(data){  

                Accounts = {};
                AccountLabels = [];
                map = [];
                
                $.each(data, function(i, v){
                   
                    Accounts[ v.contact_person_name ] = {   
                        contact_person_name  : v.contact_person_name                    
                    };
    
                    AccountLabels.push(v.contact_person_name);
                    
                })
                return process(AccountLabels);
            }
        });
        
        },
        highlighter: function(item){
            
            var p = Accounts[item];  
            
            var rep_contact_person_name = p.contact_person_name.replace(this.query,'<strong>'+this.query+'</strong>');
            
            var itm = ''
                     + "<div class='typeahead_wrapper'>"
                     + "<div class='typeahead_labels'>"
                     + "<div class='typeahead_primary'>" + rep_contact_person_name + "</div>"               
                     + "</div>"
                     + "<div class='typeahead_userinfo'>"          
                     + "</div><div class='clearfix'></div>"
                     + "</div>";
            return itm;
        }

    });
    
});
$(document).ready(function() {
    
    // use this hash to cache search results
    window.query_cache = {};
    
    $('#addnew_organization_name').typeahead({
        minLength:2,
        source: function (organization_name, process) {
        if(query_cache[organization_name]){
              process(query_cache[organization_name]);
              return;
        }
        if( typeof searching != "undefined") {
              clearTimeout(searching);
              process([]);
        }
        
        $.ajax({           
            url: '<?php echo CController::createUrl('Opportunity/ListOrganizationNameContact')?>',
            type: 'POST',
            dataType: 'JSON',
            data:{
                organization_name        : organization_name,
            },
            success: function(data){  

                Accounts = {};
                AccountLabels = [];
                map = [];
                
                $.each(data, function(i, v){
                   
                    Accounts[ v.organization_name ] = {   
                        organization_name  : v.organization_name                    
                    };
    
                    AccountLabels.push(v.organization_name);
                    
                })
                return process(AccountLabels);
            }
        });
        
        },
        highlighter: function(item){
            
            var p = Accounts[item];  
            
            var rep_organization_name = p.organization_name.replace(this.query,'<strong>'+this.query+'</strong>');
            
            var itm = ''
                     + "<div class='typeahead_wrapper'>"
                     + "<div class='typeahead_labels'>"
                     + "<div class='typeahead_primary'>" + rep_organization_name + "</div>"               
                     + "</div>"
                     + "<div class='typeahead_userinfo'>"          
                     + "</div><div class='clearfix'></div>"
                     + "</div>";
            return itm;
        }

    });
    
});
</script>