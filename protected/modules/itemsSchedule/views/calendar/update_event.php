<?php $baseUrl = Yii::app()->getBaseUrl(); ?>
<style type="text/css" media="screen">
.me_inp {
    border      : 0;
    box-shadow  : none;
    padding-left: 20px;
    background  : white;
    height      : 22px;
}
</style>
<div id="update_sch_modal" class="modal calendarModal pop_bookoke">
<div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header popHead">
        <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
         <h5>CẬP NHẬT LỊCH HẸN</h5>
      </div>
   
      <div id="modalBody" class="modal-body">
         <div class="row">
            <ul class="nav nav-tabs nav-1">
               <li id="up-sch" class="active"><a data-toggle="tab" href="#up-schedule">Lịch Hẹn</a></li>
               <li id="up-customer"><a data-toggle="tab" href="#up-cus">Khách Hàng</a></li>
            </ul>
         
            <div class="tab-content">

               <!-- Lich hen -->
               <div id="up-schedule" class="tab-pane tab-ct fade in active">
                  <form enctype="multipart/form-data" class="form-horizontal" id="frm-up-sch" action="" method="post">
                     <div class="form-group">
                        <div class="col-xs-6 col-xs-offset-1">
                           <h4>Trạng thái lịch hẹn</h4>
                        </div>
                        <div class="col-xs-4">
                            <?php 

                            $stArr = array_filter($status_sch, function($k, $v){
                                 return $v != 0;
                              }, ARRAY_FILTER_USE_BOTH); 
                              ?>

                           <?php echo CHtml::dropDownList('CsSchedule[status]', '', $stArr, array('class'=>'form-control','id'=>'CsSchedule_up_status')); ?>
                        </div>
                     </div>

                     <input name="CsSchedule[type]" class="Csh_type" type="hidden" />
                     <input name="CsSchedule[id]" id="CsSchedule_up_id" type="hidden" />
                     <input name="CsSchedule[id_customer]" id="CsSchedule_up_id_customer" type="hidden" />
                     <input name="CsSchedule[id_author]" id="CsSchedule_up_id_author" type="hidden" />

                     <input name="CsSchedule[id_quotation]" id="CsSchedule_up_id_quotation" type="hidden" />

                     <input class="chair" name="CsSchedule[id_chair]" id="CsSchedule_up_id_chair" type="hidden" value="" />
                     <input class="branch" name="CsSchedule[id_branch]" id="CsSchedule_up_id_branch" type="hidden" value="" />
                     <input class="end_time" name="CsSchedule[end_time]" id="CsSchedule_up_end_time" type="hidden" />
                     <input class="chkT" id="create_up_chkT" type="hidden" value="1" name="checkT" />
                     
                     <div class="clearfix"></div>

                     <div class="form-group">
                        <label class="col-xs-4 control-label" for="CsSchedule_up_id_dentist">Nha sỹ</label>
                        <div class="col-xs-6">
                           <select placeholder="" class="sch_dentist form-control" name="CsSchedule[id_dentist]" id="CsSchedule_up_id_dentist"></select>
                        </div>
                        <div class="col-xs-1 load-up-at load-at load-dt padding-left-0">
                           <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="col-xs-4 control-label" for="CsSchedule_up_id_service">Dịch vụ</label>
                        <div class="col-xs-6">
                           <select placeholder="" class="sch_service form-control" name="CsSchedule[id_service]" id="CsSchedule_up_id_service"></select>
                        </div>
                        <div class="col-xs-1 load-up-at load-at  padding-left-0" id="load-sv">
                           <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="col-xs-4 control-label" for="CsSchedule_up_lenght">Thời gian</label>
                        <div class="col-xs-6">
                           <div class="input-group">
                              <?php echo CHtml::dropDownList('CsSchedule[lenght]', 0, $time_range, array('class'=>'form-control','id'=>'CsSchedule_up_lenght')); ?>
                              <span class="input-group-addon">phút</span>
                           </div>
                        </div>
                        <div class="col-xs-1 load-up-at load-at  padding-left-0" id="load-ti">
                           <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="col-xs-4 control-label" for="CsSchedule_up_start_time">Ngày giờ</label>
                        <div class="col-xs-6 times">
                           <input required="required" placeholder="" class="group_time datetimepicker form-control" name="CsSchedule[start_time]" id="CsSchedule_up_start_time" type="text" />
                        </div>
                        <div class="col-xs-1 load-up-at load-at padding-left-0" id="load-da">
                           <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="col-xs-4 control-label" for="CsSchedule_up_note">Ghi chú</label>
                        <div class="col-xs-6">
                           <textarea class="form-control" placeholder="Note" name="CsSchedule[note]" id="CsSchedule_up_note"></textarea>
                        </div>
                        <div class="col-xs-1 load-up-at load-at  padding-left-0" id="load-no">
                           <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        </div>
                     </div>

                     <div class="form-group">
                        <div class="col-xs-6 col-xs-offset-4">
                           <?php if ($group_id == 1 || $group_id == 2): ?>
                              <button type="button" class="btn btn_cancel pull-left del-sch">Xóa lịch</button>
                           <?php endif ?>
                           <button type="button" class="btn btn_unactive pull-right up-sch up_sch_cus">Cập nhật</button>
                        </div>  
                     </div>
               </div>
               
               <!-- Khach hang -->
               <div id="up-cus" class="tab-pane fade">
                  <div id="show-cus">
                     <ul class="nav nav-tabs nav-2 nav-justified">
                        <li class="active"><a data-toggle="tab" href="#up-info">Thông tin</a></li>
                        <li><a data-toggle="tab" href="#up-med">Bệnh sử</a></li>
                     </ul>

                     <div class="tab-content">
                        <!-- Lich hen -->
                        <div id="up-info" class="tab-pane tab-ct fade in active">
                           <div class="col-xs-12 form-horizontal">
                              <div class="form-group">
                                 <label class="col-xs-4 control-label required" for="Customer_up_fullname" style="margin-top: -15px;">
                                    <img src="<?php echo Yii::app()->getBaseUrl(); ?>/upload/customer/no_avatar.png" id="img_cus" />
                                 </label>
                                 <div class="col-xs-6 padding-left-0">
                                    <input placeholder="Họ và tên" value="" class="ckError read form-control" name="Customer[fullname]" id="Customer_up_fullname" type="text" maxlength="255" />
                                    <div class="help-block error" id="Customer_up_fullname_em_" style="display:none"></div>
                                 </div>
                                 <div class="col-xs-1 load-up-cus padding-left-0">
                                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                 </div>
                              </div>

                                 <input class="" name="Customer[id]" id="Customer_up_id" type="hidden" />

                                 <div class="form-group">
                                    <label class="col-xs-4 control-label required" for="Customer_up_phone">Số điện thoại <span class="required">*</span></label>
                                    <div class="col-xs-6 padding-left-0">
                                       <input placeholder="Số điện thoại" value="" class="ckError read form-control" name="Customer[phone]" id="Customer_up_phone" type="text" maxlength="20" />
                                       <div class="help-block error" id="Customer_up_phone_em_" style="display:none"></div>
                                    </div>
                                    <div class="col-xs-1 load-up-cus padding-left-0">
                                       <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label class="col-xs-4 control-label" for="Customer_up_email">Email</label>
                                    <div class="col-xs-6 padding-left-0">
                                       <input placeholder="Email" value="" class="read form-control" name="Customer[email]" id="Customer_up_email" type="text" maxlength="255" />
                                       <div class="help-block error" id="Customer_up_email_em_" style="display:none"></div>
                                    </div>
                                    <div class="col-xs-1 load-up-cus padding-left-0">
                                       <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                    </div>
                                 </div>
                     
                                 <div class="form-group">
                                    <label class="col-xs-4 control-label" for="Customer_up_gender">Giới tính</label>
                                    <div class="col-xs-6 padding-left-0">
                                       <select value="" class="read form-control" name="Customer[gender]" id="Customer_up_gender">
                                          <option value="0" selected="selected">Nam</option>
                                          <option value="1">Nữ</option>
                                       </select>
                                       <div class="help-block error" id="Customer_up_gender_em_" style="display:none"></div>
                                    </div>
                                    <div class="col-xs-1 load-up-cus padding-left-0">
                                       <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                    </div>
                                 </div>
                                
                                 <div class="form-group">
                                    <label class="col-xs-4 control-label" for="Customer_up_birthdate">Ngày sinh</label>
                                    <div class="col-xs-6 padding-left-0">
                                       <input placeholder="Ngày sinh" value="" class="read form-control" name="Customer[birthdate]" id="Customer_up_birthdate" type="text" />
                                       <div class="help-block error" id="Customer_up_birthdate_em_" style="display:none"></div>
                                    </div>
                                    <div class="col-xs-1 load-up-cus padding-left-0">
                                       <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label class="col-xs-4 control-label" for="Customer_up_identity_card_number">CMND</label>
                                    <div class="col-xs-6 padding-left-0">
                                       <input placeholder="CMND" value="" class="read form-control" name="Customer[identity_card_number]" id="Customer_up_identity_card_number" type="text" maxlength="20" />
                                       <div class="help-block error" id="Customer_up_identity_card_number_em_" style="display:none"></div>
                                    </div>
                                    <div class="col-xs-1 load-up-cus padding-left-0">
                                       <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label class="col-xs-4 control-label" for="Customer_up_id_country">Quốc tịch</label>
                                    <div class="col-xs-6 padding-left-0">
                                       <input placeholder="Quốc tịch" value="" class="read form-control" name="Customer[id_country]" id="Customer_up_id_country" type="text" maxlength="255" />
                                       <div class="help-block error" id="Customer_up_id_country_em_" style="display:none"></div>
                                    </div>
                                    <div class="col-xs-1 load-up-cus padding-left-0">
                                       <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <div class="col-xs-11 btn_cus text-right">
                                       <!-- <button type="button" class="btn btn_book up_sch_cus" style="color: white;">Cập nhật</button> -->
                                    </div>  
                                 </div>
                              </form>  
                           </div>
                        </div>

                        <!-- Benh su -->
                        <div id="up-med" class="tab-pane fade">
                           <h5 class="text-center">Bệnh sử y khoa</h5>
                           <div id="medi">
                              <div class="col-xs-10 col-xs-offset-1">
                              <?php 
                                 $t = 0;
                                 $alert      =  MedicineAlert::model()->findAllByAttributes(array('status'=>1));
                                 $alert      =  CHtml::listData($alert,'id','name');

                                 
                                 foreach ($alert as $key => $value):
                              ?>

                              <div class="checkbox">
                                 <label>
                                    <input id="ytCsMedicalHistoryAlert_id_medicine_alert_<?php echo $key; ?>" type="hidden" value="0" name="CsMedicalHistoryAlert[id_medicine_alert][<?php echo $key; ?>]">

                                    <input class="me_ck" name="CsMedicalHistoryAlert[id_medicine_alert][<?php echo $key; ?>]" id="CsMedicalHistoryAlert_up_id_medicine_alert_<?php echo $key; ?>" value="1" type="checkbox">
                                    <?php echo $value; ?>
                                 </label>
                                 <input style="display: none;" readonly type="text" name="CsMedicalHistoryAlert[note][<?php echo $key; ?>]" id="CsMedicalHistoryAlert_up_note_<?php echo $key; ?>" placeholder="" class="form-control me_inp">
                              </div>
                              <?php endforeach ?>
                              </div>

                              <div class="form-group">
                                 <!-- <div class="col-xs-11 text-right" style="margin: 10px 0;">
                                     <button type="submit" class="btn btn_book" id="step-4" style="color: white;">Đặt lịch</button>
                                  </div>  --> 
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>

<script>
/*********** Load schedule info update ***********/
function getInfoUp(id) {
   return $.ajax({ 
      type    :"POST",
      url     :"<?php echo CController::createUrl('calendar/updateEvent'); ?>",
      dataType:'json',
      data    : {
         id_schedule: id,
      }
  })
   
}

/*********** Show info Schedule ***********/
function infoUpSch(sch,den='') {

   if($.isEmptyObject(sch))
      return -1;
   st = [];
   st_arr = [];
   if(sch.status == 1)
      st = <?php echo json_encode($this->st1); ?>;
   else if(sch.status == 2)
      st = <?php echo json_encode($this->st2); ?>;
   else if(sch.status == 3)
      st = <?php echo json_encode($this->st3); ?>;
   else if(sch.status == -2)
      st = <?php echo json_encode($this->st0); ?>;
   else if(sch.status == 5)
      st = <?php echo json_encode($this->st5); ?>;
   else
      st_arr = <?php echo json_encode($this->status_arr); ?>;
   stOp = '';
   if(st) {
      $.each(st, function (k, v) {
         stOp +=  '<option value="'+k+'">'+v+'</option>';
      })
   }
   if(stOp == '') {
      $.each(st_arr, function (k, v) {
         if(k == sch.status)
            stOp +=  '<option value="'+k+'">'+v+'</option>';
      })  
   }

   $('#CsSchedule_up_status').html(stOp);
   // dentist
   if(den != 1)
      $('#CsSchedule_up_id_dentist').html('<option value="'+sch.id_dentist+'">'+sch.name_dentist+'</option>');

   if(sch.id_service == 0) {
      sv = 'Không làm việc';
   }
   else 
      sv = sch.name_service;

   servicesList(sch.id_dentist, sch.id_service, 1);

   // services
   $('#CsSchedule_up_id_service').html('<option value="'+sch.id_service+'">'+sv+'</option>');  

   $.each(sch, function (k, v) {
      $('#CsSchedule_up_'+k).val(v);
   })

   $('.load-up-at, .load-at').fadeOut('fast');
}

/*********** Show info customer ***********/
function infoUpCus(cus) {
   if($.isEmptyObject(cus))
      return -1;

   $.each(cus, function (k, v) {
      $('#Customer_up_'+k).val(v);
   })

   $('.read').attr('readonly',true);

   $('.load-up-cus').fadeOut('fast');
}

/*********** Show info Medical Alert ***********/
function infoUpAl(als) {
   $('.me_inp').val('');
   $('.me_ck').prop('checked',false);
   if($.isEmptyObject(als))
      return -1;
   $.each(als, function (k,v) {
      $('#CsMedicalHistoryAlert_up_id_medicine_alert_'+k).prop('checked',true);
      if(v) {
         $('#CsMedicalHistoryAlert_up_note_'+k).val(v);
         $('#CsMedicalHistoryAlert_up_note_'+k).show();
      }
   })
   //$('.load-up-at, .load-at').fadeOut('fast');
}

/*********** Action update Schedule + Customer ***********/
function updateSchCus(formData) {
   
   return  jQuery.ajax({ 
         type     :  "POST",
         url      :  "<?php echo CController::createUrl('calendar/updateEvent')?>",
         data     :  formData,
         dataType :  'json',
         cache    : false,
         contentType: false,
         processData: false
      });
}

/*********** Check Schedule ***********/
function checkSchUp(id_dentist, id_services, len) {
   ck = true;
   // check dentist
   if(!id_dentist) {
      $($('#CsSchedule_up_id_dentist').data('select2').$container).addClass('errors');
      ck = false;
   }
   else {
      $($('#CsSchedule_up_id_dentist').data('select2').$container).removeClass('errors');
   }

   // check services
   if(!id_services) {
      $($('#CsSchedule_up_id_service').data('select2').$container).addClass('errors');
      ck = false;
   }
   else {
      $($('#CsSchedule_up_id_service').data('select2').$container).removeClass('errors');
   }

   // check len
   if(len == 0) {
      $('.len').addClass('errors');
      ck = false;
   }
   else {
      $('.len').removeClass('errors');
   }

   return ck;
}
/*********** Check Time ***********/
function chkTimeUp(id_dentist, id_services, start, len, id_schedule) {
   $chk   = 1;
   
   chkSch = checkSchUp(id_dentist, id_services, len);

   if(!chkSch) {
      $chk = 0;
      $('#create_up_chkT').val(0);
      return;
   }

   if(!moment(start).isValid()) {
      $('#CsSchedule_up_start_time').addClass('errors');
      $chk = 0;
   }

   startT      = moment(start).format("YYYY-MM-DD HH:mm:ss");     
   end         = moment(start).add(len,'m').format("YYYY-MM-DD HH:mm:ss");
   $('#CsSchedule_up_end_time').val(end);

   if($chk == 0) {
      $('#create_up_chkT').val(0);
      $('.up_sch').addClass('unbtn');
      return ;
   }

   ck = checkTimeAjax(id_dentist, startT, end, id_schedule).done(checkTime);
}
function delSch(id) {
   return  $.ajax({ 
      type       :  "POST",
      url        :  "<?php echo CController::createUrl('calendar/delSch')?>",
      data       :  {id_sch:id},
      dataType   :  'json',
   });
}
</script>

<script>
$(window).load(function (e) {
   // change length services
   $('#CsSchedule_up_status').change(function(e){
      id_dentist  = $('#CsSchedule_up_id_dentist').val();
      id_services = $('#CsSchedule_up_id_service').val();
      start       = moment($('#CsSchedule_up_start_time').val());
      len         = $('#CsSchedule_up_lenght').val();
      id_schedule = $('#CsSchedule_up_id').val();

      chkTimeUp(id_dentist, id_services, start, len, id_schedule);
   })

   // change dentist
   $('#CsSchedule_up_id_dentist').change(function(){
      var id_dentist = $('#CsSchedule_up_id_dentist').val();
      var id_service = $('#CsSchedule_up_id_service').val();

      $('#CsSchedule_up_id_service').html('');
      $('#CsSchedule_up_lenght').val(0);

      servicesList(id_dentist, id_service, 1);

      $($('#CsSchedule_up_id_service').data('select2').$container).addClass('errors');
     
   });

   // change services
   $('#CsSchedule_up_id_service').change(function(e){
      var id_services = $('#CsSchedule_up_id_service').val();

      if(!id_services) {
         $($('#CsSchedule_up_id_service').data('select2').$container).addClass('errors');
         $('#CsSchedule_up_lenght').val(0);
         $('#CsSchedule_up_lenght').addClass('errors');
      }
      else {
         $($('#CsSchedule_up_id_service').data('select2').$container).removeClass('errors');

         data  = $('#CsSchedule_up_id_service').select2('data');
         len   = data[0].len;

         if(typeof len === 'undefined')
            len = 45;

         id_dentist  = $('#CsSchedule_up_id_dentist').val();
         start       = moment($('#CsSchedule_up_start_time').val());
         id_schedule = $('#CsSchedule_up_id').val();

         chkTimeUp(id_dentist, id_services, start, len, id_schedule);

         $('#CsSchedule_up_lenght').val(len);
         $('#CsSchedule_up_lenght').removeClass('errors');
      }
   })

   // change length services
   $('#CsSchedule_up_lenght').change(function(e){
      id_dentist  = $('#CsSchedule_up_id_dentist').val();
      id_services = $('#CsSchedule_up_id_service').val();
      start       = moment($('#CsSchedule_up_start_time').val());
      len         = $('#CsSchedule_up_lenght').val();
      id_schedule = $('#CsSchedule_up_id').val();

      chkTimeUp(id_dentist, id_services, start, len, id_schedule);
   })

   // change start_time
   $('#CsSchedule_up_start_time').on('dp.change',function(){
      id_dentist  = $('#CsSchedule_up_id_dentist').val();
      id_services = $('#CsSchedule_up_id_service').val();
      len      = $('#CsSchedule_up_lenght').val();
      start       = moment($('#CsSchedule_up_start_time').val());
      id_schedule = $('#CsSchedule_up_id').val();
      
      chkTimeUp(id_dentist, id_services, start, len, id_schedule);
   })

   // update schedule
   $('.up-sch').click(function (e) {
      e.preventDefault();

      if($('.up-sch').hasClass('btn_unactive')) {
         return;
      }

      userLog = $('#idUserLog').val();

      var formData   = new FormData($("#frm-up-sch")[0]);
      
      $('.cal-loading').fadeIn('fast');

      if (!formData.checkValidity || formData.checkValidity()) {
         if($('.up-sch').hasClass('up_sch_cus')) {
            $.when(updateSchCus(formData)).done(function (data) {
               $('#calendar').fullCalendar( 'removeEvents', data['ev'].id );
               $('#calendar').fullCalendar( 'renderEvent', data['ev'], true );
               $('#update_sch_modal').modal('hide');
               $('.cal-loading').fadeOut('fast');
               getNoti(data['ev'],'update',userLog);
            });
         }
         else if($('.up-sch').hasClass('up_next')) {

            $.when(addSchCus(formData)).done(function (data) {
               $('#frm-create-sch')[0].reset();
               $('.read').attr('readonly',false);
               $('.cal-loading').fadeOut('fast');

               if(data.status == 1){
                  $('.help-block').hide();
                  $('.ckError').removeClass('errors');

                  $('#calendar').fullCalendar('renderEvent',data.data,true);
                  $('#update_sch_modal').modal('hide');
               }
            })
         }
      }
   });

   // delete schedule
   $('.del-sch').click(function (e) {
      e.preventDefault();
      id       = $('#CsSchedule_up_id').val();
      id_quote = $('#CsSchedule_up_id_quotation').val();
      st       = $('#CsSchedule_up_status').val();

      if(id_quote || st == 4) {
         $('#info_content').html('Lịch hẹn đã hoàn tất hay có báo giá.<br/> Bạn không thể xóa lịch hẹn này!');
         $("#info").modal();
      }
      else {
         delEv(id);
      }
   })
})
</script>