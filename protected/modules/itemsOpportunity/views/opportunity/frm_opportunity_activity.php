<style>
.modal_activity_schedule_deal{
    width: 635px !important;
    margin-left: -325px !important;
}
.box_col_due{
    width: 30.5%; 
    float: left;
    margin-right: 15px;
}
.box_col_due .label_due{
    font-size: 11px;
    padding-left: 1px;
}
.btn-type-sch{
    background: none;
    color: rgba(38, 41, 44, 0.64);
    font-size: 13px !important;
    padding: 5px 15px 4px 15px;
    -webkit-transition: all .1s ease;
    -moz-transition: all .1s ease;
    -o-transition: all .1s ease;
    -ms-transition: all .1s ease ;
    transition: all .1s ease ;
    
}
.active-bth-type-sch{
    -webkit-box-shadow:inset 0 1px 2px rgba(38, 41, 44, 0.1);
    box-shadow:inset 0 1px 2px rgba(38, 41, 44, 0.1);
    background: #e0e4e7 !important;
    color: #000 !important;
}
.btn-type-radio{
    width: auto;
    position: absolute;
    visibility: hidden;
    width: 100%;
    height: 21px;
}
</style>
<?php $baseUrl = Yii::app()->request->baseUrl;  ?>
<!-- Modal -->
<div id="modalAddnewScheduleActivity" class="modal modal_activity_schedule_deal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="left:50%;background-color: #fff;">

    <div class="modal-header" style="background-color: #f3f5f6;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel" style="margin: 0px;">Lập kế hoạch</h3>
    </div>
    
    <div class="modal-body" style="padding: 20px;">

        <div class="row_add_deal" style="margin-bottom: 15px;">
            <div class="btn-group">
              <button id="type_schedule_1" class="btn btn-type-sch active-bth-type-sch">
                <input class="btn-type-radio" type="radio" name="type_schedule" value="1" checked="checked" data-title="Gọi điện"/>
                <i class="fa fa-phone-square" style="font-size:15px;"></i> Gọi điện
              </button>
              <button id="type_schedule_2" class="btn btn-type-sch">
                <input class="btn-type-radio" type="radio" name="type_schedule" value="2"  data-title="Hẹn gặp"/>
                <i class="fa fa fa-users" style="font-size:14px;"></i> Hẹn gặp
              </button>
              <button id="type_schedule_3" class="btn btn-type-sch">
                <input class="btn-type-radio" type="radio" name="type_schedule" value="3"  data-title="Thực hiện"/>
                <i class="fa fa-clock-o" style="font-size:14px;"></i> Thực hiện
              </button>
              <button id="type_schedule_4" class="btn btn-type-sch">
                <input class="btn-type-radio" type="radio" name="type_schedule" value="4"  data-title="Hẹn định"/>
                <i class="fa fa-flag" style="font-size:14px;"></i> Hẹn định
              </button>
              <button id="type_schedule_5" class="btn btn-type-sch">
                <input class="btn-type-radio" type="radio" name="type_schedule" value="5" data-title="Email"/>
                <i class="fa fa-envelope" style="font-size:14px;"></i> Email
              </button>
              <button id="type_schedule_6" class="btn btn-type-sch">
                <input class="btn-type-radio" type="radio" name="type_schedule" value="6"  data-title="Hẹn ăn trưa"/>
                <i class="fa fa-coffee" style="font-size:14px;"></i> Hẹn ăn trưa
              </button>
            </div>
        </div>

        <div class="row_add_deal" style="margin-bottom: 15px;">
            <input id="addnew_name_schedule" class="input_addnew_deal input-xlarge form-control" type="text" placeholder="Call"/>
        </div>

        <div class="row_add_deal" style="margin-bottom: 15px;">
            <label class="box_col_due">
                <span class="label_due">NGÀY</span><br />
                <span>
                    <input id="addnew_sch_date" type="text" class="input_addnew_deal form-control" placeholder="<?php echo date("d/m/Y");?>" />
                </span>
            </label>
            <label class="box_col_due">
                <span class="label_due">GIỜ</span><br />
                <span>
                    <input id="addnew_sch_time" type="text" class="input_addnew_deal form-control" />
                </span>
            </label>
            <label class="box_col_due" style="width: 30.5%;">
                <span class="label_due">THỜI GIAN</span><br />
                <span>
                    <select id="addnew_sch_duration" class="input_addnew_deal form-control">
                        <option value="00:05">00:05:00</option>
                        <option value="00:10">00:10:00</option>
                        <option value="00:15">00:15:00</option>
                        <option value="00:20">00:20:00</option>
                        <option value="00:25">00:25:00</option>
                        <option value="00:30">00:30:00</option>
                        <option value="00:35">00:35:00</option>
                        <option value="00:40">00:40:00</option>
                        <option value="00:45">00:45:00</option>
                        <option value="00:50">00:50:00</option>
                        <option value="00:55">00:55:00</option>
                        <option value="01:00">01:00:00</option>
                        <option value="02:00">02:00:00</option>
                        <option value="03:00">03:00:00</option>
                        <option value="04:00">04:00:00</option>
                        <option value="05:00">05:00:00</option>
                        <option value="06:00">06:00:00</option>
                    </select>
                </span>
            </label>
            
            
            <div class="clear"></div>
        </div>

        <!-- <div class="row_add_deal" style="margin-bottom: 15px;"> -->
            <!-- Opportunity -->
            <input id="addnew_id_deal" type="hidden"  value="" />
            <!-- Schedule Opportunity -->
            <input id="addnew_id_schedule" type="hidden"  value="" />
            <!-- Phone -->
            <!-- <span class="input-icon-prepend" style="width: 30.5%;float: left;margin-right: 15px;">
              <div class="add-icon-input"><i class="fa fa-phone"></i></div>
              <input id="addnew_sch_phone" class="input_addnew_deal input-xlarge form-control" style="text-indent: 25px;" type="text"  placeholder="Phone" />
            </span>  -->          
            <!-- Deal value -->
            <!-- <span class="input-icon-prepend" style="width: 30.5%;float: left;margin-right: 15px;">
              <div class="add-icon-input" style="width: 17px; top: 5px;left: 6px;"><img src="<?php /* echo $baseUrl."/images/icon_money_deal.png"; */ ?>" style="max-width: 100%;border: 0;"/></div>
              <input id="addnew_sch_deal_value" class="input_addnew_deal input-xlarge form-control" style="text-indent: 25px;" type="text" placeholder="Value" />
            </span>
            <div class="clearfix"></div>
        </div>   -->   
        
        <div class="row_add_deal" style="margin-bottom: 15px;">
            <textarea id="addnew_sch_note" name="editor1"  rows="3" class="input_addnew_deal form-control" placeholder="Ghi chú" style="background-color: #ffffdd;"></textarea>
        </div>       
        
        <div class="row_add_deal" style="margin-bottom: 15px;">
            <label class="box_col_due" style="width: 100%;">
                <span class="label_due">PHÂN CÔNG CHO</span><br />
                <span>
                    <?php 
                    $model=new CsOpportunity;
                    $listdata     = array();
                    $listdata[''] = 'Select User';
                    foreach($model->getListUsers() as $temp){
                        $listdata[$temp['id']] =  $temp['name'];
                    }
                    
                    $group_no = Yii::app()->user->getState('group_no');
                    if(($group_no=='admin'||$group_no=='superadmin' || $group_no=='manager' || $group_no=='leader')){
                        echo CHtml::dropDownList('addnew_sch_id_user','',$listdata,array('onChange'=>"",'class'=>'input_addnew_deal form-control','options'=>array(Yii::app()->user->getState('id_user')=>array('selected'=>true)))); 
                    }else{
                        echo CHtml::dropDownList('addnew_sch_id_user','',$listdata,array('onChange'=>"",'class'=>'input_addnew_deal form-control',"disabled"=>"disabled",'options'=>array(Yii::app()->user->getState('id_user')=>array('selected'=>true)))); 
                    }
                    ?>
                </span>
            </label>
            <div class="clear"></div>
        </div>  

        <div class="row_add_deal" style="margin-bottom: 15px;">
            <label class="box_col_due" style="width: 100%;">
                <span class="label_due">KẾT NỐI TỚI</span><br />
                 <!-- Deal title -->
                <span class="input-icon-prepend" style="width: 100%;float: left;margin-right: 15px;">
                  <div class="add-icon-input" style="width: 17px; top: 5px;left: 6px;"><img src="<?php echo $baseUrl."/images/business-icon.png";?>" style="max-width: 100%;border: 0;"/></div>
                  <input id="addnew_sch_title" class="input_addnew_deal input-xlarge form-control" style="text-indent: 25px;" type="text" placeholder="Deal title" />
                </span>
                <span class="input-icon-prepend" style="width: 100%;float: left;margin-right: 15px;">
                  <div class="add-icon-input" style="width: 17px; top: 5px;left: 6px;"><i class="glyphicon glyphicon-user"></i></div>
                  <input id="addnew_sch_contact_person_name" class="input_addnew_deal input-xlarge form-control" style="text-indent: 25px;" type="text" placeholder="Contact" />
                </span>
                <span class="input-icon-prepend" style="width: 100%;float: left;margin-right: 15px;">
                  <div class="add-icon-input" style="width: 17px; top: 5px;left: 6px;"><i class="fa fa-building"></i></div>
                  <input id="addnew_sch_organization_name" class="input_addnew_deal input-xlarge form-control" style="text-indent: 25px;" type="text" placeholder="Organization" />
                </span>
            </label>
            <div class="clearfix"></div>
        </div>         

    </div>
    
    <div class="modal-footer" style="background-color: #f3f5f6;position: relative;">
        <div id="alertErrorScheduleActivity" class="hiden" style="position: absolute;top: 10px;left:10px;"></div>
        
        <label style=" width: 30%;margin-right: 15px;margin-top: 7px;">
            <input type="checkbox" id="addnew_sch_checkbox" />
            <span style="margin-left: 1px;">Chọn nếu đã hoàn tất</span>
        </label>        
         
        <span aria-hidden="true" onclick="save_schedule_activity();" class="btn btn-success">Lưu lại</span>
    </div>

</div>

<script>
 $('#addnew_sch_date').datepicker({
    showButtonPanel: true,
    closeText: 'Clear',
    minDate: new Date(),
    dateFormat: "dd/mm/yy"
});

$('#addnew_sch_time').timeselect({
    'step': 15,
    autocompleteSettings: {
        autoFocus: true
    }
});

$('.btn-type-sch').click(function(e){
    
    $('.btn-type-sch').removeClass('active-bth-type-sch');
    $(this).addClass('active-bth-type-sch');
    
    $('.btn-type-radio').removeAttr('checked');
    $(this).find('.btn-type-radio').prop( "checked", true );
    
    var title = $(this).find('.btn-type-radio').attr('data-title');
    $("#addnew_name_schedule").attr('placeholder',title);
    
});

</script>