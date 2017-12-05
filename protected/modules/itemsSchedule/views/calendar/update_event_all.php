<?php $baseUrl = Yii::app()->getBaseUrl(); ?>
<?php $time_range  = array();
   for ($i=0; $i <= 180 ; $i+=5) { 
          $time_range[$i] = $i;
      }
      $time_range[0] = 'N/A'; ?>
<style type="text/css" media="screen">
.me_inp {
    border      : 0;
    box-shadow  : none;
    padding-left: 20px;
    background  : white;
    height      : 22px;
}
.errors {
    border    : 1px solid red !important;
    background: rgba(217, 3, 3, 0.2) !important;
}

.errors .select2-selection{
    background: rgba(217, 3, 3, 0.2) !important;
}

.unactive   {cursor: not-allowed !important;}
.load-at .fa{color: #7cc9ac;}
.calendarModal .modal-dialog {width: 447px;}
.calendarModal .modal-body {padding: 0 15px 10px;}
.calendarModal .modal-body h4 {font-size: 16px; font-weight: bold; color: #888888;}

.calendarModal label {color: #5e5e5e;}
.calendarModal .form-control {color: #7a797a;}

.calendarModal ul.nav {background: #f4f5f5; border-bottom: 3px solid white;}
.calendarModal ul.nav-1 {padding: 10px 20px 0px;height: 53px;}
.calendarModal ul.nav-2 {padding-top: 7px;}

.calendarModal .nav li a {
    background: inherit;
    border: 0;
    font-weight: bold;
}
.calendarModal .nav-1 li a {
    padding: 10px 20px;
    color: black;
}

.calendarModal .nav>li.active>a, 
.calendarModal .nav>li.active>a:focus, 
.calendarModal .nav>li.active>a:hover
{  
    font-weight: bold;
    border: 0;
    background: white;
}
.calendarModal .nav-1>li.active>a, 
.calendarModal .nav-1>li.active>a:focus, 
.calendarModal .nav-1>li.active>a:hover
{  
    background: inherit;
    border-bottom: 3px solid #93c54c;
    color: black;
}

.calendarModal .tab-ct {padding-top: 20px;}

.calendarModal table tr td {border: 0; padding: 5px 8px;}

#img_cus {
    border-radius: 100%;
    width: 50px;
}

label[for='Customer_fullname']
{
    margin-top: -15px;
}
label.checkbox {
    font-weight: normal;
    cursor: pointer;
}
</style>
<div id="update_sch_modal_all" class="modal calendarModal pop_bookoke">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header popHead">
           <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
            <h5>CẬP NHẬT LỊCH HẸN</h5>
         </div>
      
         <div id="modalBody" class="modal-body">
            <div class="row">
               <ul class="nav nav-tabs nav-1">
                  <li class="active"><a data-toggle="tab" href="#up-all-schedule">Lịch Hẹn</a></li>
                  <li><a data-toggle="tab" href="#up-all-cus">Khách Hàng</a></li>
               </ul>
            
               <div class="tab-content">
                  <!-- Lich hen -->
                  <div id="up-all-schedule" class="tab-pane tab-ct fade in active">
                     <form enctype="multipart/form-data" class="form-horizontal" id="frm-up-all-sch" action="" method="post">
                        <div class="form-group">
                           <div class="col-xs-6 col-xs-offset-1">
                              <h4>Trạng thái lịch hẹn</h4>
                           </div>
                           <div class="col-xs-4">
                              <?php echo CHtml::dropDownList('CsSchedule[status]', '', $stArr, array('class'=>'form-control','id'=>'CsSchedule_up_all_status')); ?>
                           </div>
                        </div>

                        <input name="CsSchedule[type]" value="<?php echo $sch['status']; ?>" class="Csh_type" type="hidden" />
                        <input name="CsSchedule[id]" value="<?php echo $sch['id']; ?>" id="CsSchedule_up_all_id" type="hidden" />
                        <input name="CsSchedule[id_customer]" value="<?php echo $sch['id_customer']; ?>" id="CsSchedule_up_all_id_customer" type="hidden" />
                        <input name="CsSchedule[id_author]" value="<?php echo $sch['id_author']; ?>" id="CsSchedule_up_all_id_author" type="hidden" />

                        <input name="CsSchedule[id_quotation]" value="<?php echo $sch['id_quotation']; ?>" id="CsSchedule_up_all_id_quotation" type="hidden" />

                        <input class="chair" name="CsSchedule[id_chair]" id="CsSchedule_up_all_id_chair" type="hidden" value="" />
                        <input class="branch" name="CsSchedule[id_branch]" value="<?php echo $sch['id_branch']; ?>" id="CsSchedule_up_all_id_branch" type="hidden"/>
                        <input class="end_time" name="CsSchedule[end_time]" value="<?php echo $sch['end_time']; ?>" id="CsSchedule_up_all_end_time" type="hidden" />
                        <input class="chkT" id="up_all_chkT" type="hidden" value="1" name="checkT" />
                        
                        <div class="clearfix"></div>

                        <div class="form-group">
                           <label class="col-xs-4 control-label" for="CsSchedule_up_all_id_dentist">Nha sỹ</label>
                           <div class="col-xs-6">
                              <select placeholder="" class="sch_dentist form-control" name="CsSchedule[id_dentist]" id="CsSchedule_up_all_id_dentist">
                                 <option value="<?php echo $sch['id_dentist']; ?>"><?php echo $sch['name_dentist']; ?></option>
                              </select>
                           </div>
                           <div class="col-xs-1 load-up-at load-at load-dt padding-left-0">
                              <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                           </div>
                        </div>

                        <div class="form-group">
                           <label class="col-xs-4 control-label" for="CsSchedule_up_all_id_service">Dịch vụ</label>
                           <div class="col-xs-6">
                              <select placeholder="" class="sch_service form-control" name="CsSchedule[id_service]" id="CsSchedule_up_all_id_service">
                                 <option value="<?php echo $sch['id_service']; ?>"><?php echo $sch['name_service']; ?></option>
                              </select>
                           </div>
                           <div class="col-xs-1 load-up-at load-at  padding-left-0" id="load-sv">
                              <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                           </div>
                        </div>

                        <div class="form-group">
                           <label class="col-xs-4 control-label" for="CsSchedule_up_all_lenght">Thời gian</label>
                           <div class="col-xs-6">
                              <div class="input-group">
                                 <?php echo CHtml::dropDownList('CsSchedule[lenght]', $sch['lenght'], $time_range, array('class'=>'form-control','id'=>'CsSchedule_up_all_lenght')); ?>
                                 <span class="input-group-addon">phút</span>
                              </div>
                           </div>
                           <div class="col-xs-1 load-up-at load-at  padding-left-0" id="load-ti">
                              <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                           </div>
                        </div>

                        <div class="form-group">
                           <label class="col-xs-4 control-label" for="CsSchedule_up_all_start_time">Ngày giờ</label>
                           <div class="col-xs-6 times">
                              <input required="required" placeholder="" value="<?php echo $sch['start_time']; ?>" class="group_time datetimepicker form-control" name="CsSchedule[start_time]" id="CsSchedule_up_all_start_time" type="text" />
                           </div>
                           <div class="col-xs-1 load-up-at load-at padding-left-0" id="load-da">
                              <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                           </div>
                        </div>

                        <div class="form-group">
                           <label class="col-xs-4 control-label" for="CsSchedule_up_all_note">Ghi chú</label>
                           <div class="col-xs-6">
                              <textarea class="form-control" value="<?php echo $sch['note']; ?>" placeholder="Note" name="CsSchedule[note]" id="CsSchedule_up_all_note"></textarea>
                           </div>
                           <div class="col-xs-1 load-up-at load-at padding-left-0" id="load-no">
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
                  <div id="up-all-cus" class="tab-pane fade">
                     <div id="show-cus">
                        <ul class="nav nav-tabs nav-2 nav-justified">
                           <li class="active"><a data-toggle="tab" href="#up-all-info">Thông tin</a></li>
                           <li><a data-toggle="tab" href="#up-all-med">Bệnh sử</a></li>
                        </ul>

                        <div class="tab-content">
                           <!-- Lich hen -->
                           <div id="up-all-info" class="tab-pane tab-ct fade in active">
                              <div class="col-xs-12 form-horizontal">
                                 <div class="form-group">
                                    <label class="col-xs-4 control-label required" for="Customer_up_fullname" style="margin-top: -15px;">
                                       <img src="<?php echo Yii::app()->getBaseUrl(); ?>/upload/customer/no_avatar.png" id="img_cus" />
                                    </label>
                                    <div class="col-xs-6 padding-left-0">
                                       <input placeholder="Họ và tên" readonly value="<?php echo $cus['fullname']; ?>" class="ckError read form-control" name="Customer[fullname]" id="Customer_up_fullname" type="text" maxlength="255" />
                                       <div class="help-block error" id="Customer_up_fullname_em_" style="display:none"></div>
                                    </div>
                                    <div class="col-xs-1 load-up-cus padding-left-0">
                                       <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                    </div>
                                 </div>

                                    <input class="" name="Customer[id]" readonly value="<?php echo $cus['id']; ?>" id="Customer_up_id" type="hidden" />

                                    <div class="form-group">
                                       <label class="col-xs-4 control-label required" for="Customer_up_phone">Số điện thoại <span class="required">*</span></label>
                                       <div class="col-xs-6 padding-left-0">
                                          <input placeholder="Số điện thoại" readonly value="<?php echo $cus['phone']; ?>" class="ckError read form-control" name="Customer[phone]" id="Customer_up_phone" type="text" maxlength="20" />
                                          <div class="help-block error" id="Customer_up_phone_em_" style="display:none"></div>
                                       </div>
                                       <div class="col-xs-1 load-up-cus padding-left-0">
                                          <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                       </div>
                                    </div>

                                    <div class="form-group">
                                       <label class="col-xs-4 control-label" for="Customer_up_email">Email</label>
                                       <div class="col-xs-6 padding-left-0">
                                          <input placeholder="Email" readonly value="<?php echo $cus['email']; ?>" class="read form-control" name="Customer[email]" id="Customer_up_email" type="text" maxlength="255" />
                                          <div class="help-block error" id="Customer_up_email_em_" style="display:none"></div>
                                       </div>
                                       <div class="col-xs-1 load-up-cus padding-left-0">
                                          <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                       </div>
                                    </div>                                 
                        
                                    <div class="form-group">
                                       <label class="col-xs-4 control-label" for="Customer_up_gender">Giới tính</label>
                                       <div class="col-xs-6 padding-left-0">
                                          <select class="read form-control" readonly name="Customer[gender]" id="Customer_up_gender">
                                             <?php if ($cus['gender'] == 1): ?>
                                                <option value="0">Nam</option>
                                                <option value="1" selected="selected">Nữ</option>
                                             <?php else: ?>
                                                <option value="0" selected="selected">Nam</option>
                                                <option value="1">Nữ</option>
                                             <?php endif ?>
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
                                          <input placeholder="Ngày sinh" readonly value="<?php echo date_format(date_create($cus['birthdate']),'Y-m-d'); ?>" class="read form-control" name="Customer[birthdate]" id="Customer_up_birthdate" type="text" />
                                          <div class="help-block error" id="Customer_up_birthdate_em_" style="display:none"></div>
                                       </div>
                                       <div class="col-xs-1 load-up-cus padding-left-0">
                                          <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                       </div>
                                    </div>

                                    <div class="form-group">
                                       <label class="col-xs-4 control-label" for="Customer_up_identity_card_number">CMND</label>
                                       <div class="col-xs-6 padding-left-0">
                                          <input placeholder="CMND" readonly value="<?php echo $cus['identity_card_number']; ?>" class="read form-control" name="Customer[identity_card_number]" id="Customer_up_identity_card_number" type="text" maxlength="20" />
                                          <div class="help-block error" id="Customer_up_identity_card_number_em_" style="display:none"></div>
                                       </div>
                                       <div class="col-xs-1 load-up-cus padding-left-0">
                                          <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                       </div>
                                    </div>

                                    <div class="form-group">
                                       <label class="col-xs-4 control-label" for="Customer_up_id_country">Quốc tịch</label>
                                       <div class="col-xs-6 padding-left-0">
                                          <input placeholder="Quốc tịch" readonly value="" class="read form-control" name="Customer[id_country]" id="Customer_up_id_country" type="text" maxlength="255" />
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
                           <div id="up-all-med" class="tab-pane fade">
                              <h5 class="text-center">Bệnh sử y khoa</h5>
                              <div id="medi">
                                 <div class="col-xs-10 col-xs-offset-1">
                                 <?php 
                                    $t     =  0;
                                    $al    =  CHtml::listData($al,'id_medicine_alert','note');
                                    $alert =  MedicineAlert::model()->findAllByAttributes(array('status'=>1));
                                    $alert =  CHtml::listData($alert,'id','name');
                                    foreach ($alert as $key => $value):
                                       $check = '';
                                       $note = '';
                                       $disNote = 'none';
                                       if (array_key_exists($key, $al)) {
                                           $check = 'checked';
                                           if($al[$key]){
                                             $note    = $al[$key];
                                             $disNote = 'block';
                                           }
                                       }
                                 ?>
                                    <div class="checkbox">
                                       <label>
                                          <input id="ytCsMedicalHistoryAlert_id_medicine_alert_<?php echo $key; ?>" type="hidden" value="0" name="CsMedicalHistoryAlert[id_medicine_alert][<?php echo $key; ?>]">

                                          <input class="me_ck" readonly name="CsMedicalHistoryAlert[id_medicine_alert][<?php echo $key; ?>]" id="CsMedicalHistoryAlert_up_id_medicine_alert_<?php echo $key; ?>" value="1" type="checkbox" <?php echo $check; ?>>
                                          <?php echo $value; ?>
                                       </label>
                                       <input style="display: <?php echo $disNote; ?>;" readonly type="text" name="CsMedicalHistoryAlert[note][<?php echo $key; ?>]" id="CsMedicalHistoryAlert_up_note_<?php echo $key; ?>" class="form-control me_inp" value="<?php echo $note; ?>">
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

/*********** Action update Schedule + Customer ***********/
   function updateSchCus(formData) {
      return  jQuery.ajax({ 
            type     :  "POST",
            url      :  "<?php echo Yii::app()->createUrl('itemsSchedule/calendar/updateEvent')?>",
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
         $($('#CsSchedule_up_all_id_dentist').data('select2').$container).addClass('errors');
         ck = false;
      }
      else {
         $($('#CsSchedule_up_all_id_dentist').data('select2').$container).removeClass('errors');
      }

      // check services
      if(!id_services) {
         $($('#CsSchedule_up_all_id_service').data('select2').$container).addClass('errors');
         ck = false;
      }
      else {
         $($('#CsSchedule_up_all_id_service').data('select2').$container).removeClass('errors');
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
         $('#up_all_chkT').val(0);
         return;
      }

      if(!moment(start).isValid()) {
         $('#CsSchedule_up_all_start_time').addClass('errors');
         $chk = 0;
      }

      startT      = moment(start).format("YYYY-MM-DD HH:mm:ss");     
      end         = moment(start).add(len,'m').format("YYYY-MM-DD HH:mm:ss");
      $('#CsSchedule_up_all_end_time').val(end);

      if($chk == 0) {
         $('#up_all_chkT').val(0);
         $('.up_sch').addClass('btn_unactive');
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
/*********** Kiểm tra thời gian lich hen ***********/
   function checkTimeAjax(id_dentist, start_time, end_time, id_schedule) {
      $('.load-at').fadeIn('fast');
      return $.ajax({ 
         type    :"POST",
         url     :"<?php echo CController::createUrl('calendar/checkTime'); ?>",
         dataType:'json',
         data    : {
            id_dentist : id_dentist,
            start      : start_time,
            end        : end_time,
            id_schedule: id_schedule
           },
       });
   }

   function checkTime(data) {
      $('.load-at').fadeOut('slow');
      // dinh dang thoi gian khong dung
      if(data.status == -1) {
         $('.group_time').addClass('errors');
         $('.chkT').val(0);
      }
      // nha sy khong lam viec
      if(data.status == -2) {
         $('.group_time').addClass('errors');
         $($('.sch_dentist').data('select2').$container).addClass('errors');
         $('.chkT').val(0);
      }
      // lich hen trung
      if(data.status == -3) {
         $('.group_time').addClass('errors');
         $('.chkT').val(0);
      }
      if(data.status == 1) {
            $id_br = $('#id_branch').val();
            $('#step-1').removeClass('btn_unactive').addClass('btn_bookoke');
            $('.up-sch').removeClass('btn_unactive');
            $('.up-sch').addClass('btn_bookoke');

         $('.branch').val($id_br);
            $('.chair').val(0);

            $('.chkT').val(1);
            $('.group_time').removeClass('errors');
      }
   }
/*********** Danh sách bác sỹ ***********/
   function dentistListModal(id_branch) {
      $('.sch_dentist').select2({
          placeholder: {
            id: -1,
            text: 'Xem tất cả'
          },
          width: '100%',
          ajax: {
              dataType : "json",
              url      : '<?php echo CController::createUrl('calendar/getDentistList'); ?>',
              type     : "post",
              delay    : 1000,
              data : function (params) {
               return {
                  q: params.term, // search term
                  page: params.page || 1,
                  id_branch: id_branch,
               };
            },
            processResults: function (data, params) {
                
               return {
                  results: data,
               };
            },
            cache: true,
          },
      });
   }
/*********** Danh sách dịch vụ ***********/
   function servicesList(id_dentist,id_service,up) {
      if(id_service == 0) {
         $('.sch_service').select2({
            language: 'vi',
               placeholder: {
               id: -1,
               text: 'Xem tất cả'
             },
             width: '100%',
             data: [{'id':0,'title':'Không làm việc'}],
         });
         return;
      }
      $('.sch_service').select2({
         language: 'vi',
            placeholder: {
            id: -1,
            text: 'Xem tất cả'
          },
          width: '100%',
          ajax: {
              dataType : "json",
              url      : '<?php echo CController::createUrl('calendar/getServiceList'); ?>',
              type     : "post",
              delay    : 1000,
              data : function (params) {
               return {
                  q         : params.term, // search term
                  page      : params.page || 1,
                  id_dentist: id_dentist,
                  up        : up,
               };
            },
            processResults: function (data, params) {
               return {
                  results: data,
               };
            },
            cache: true,
          },
      });
   }
/*********** Thông báo ***********/
   function getNoti(dataSch, action, author) {
    $.ajax({
      url     : '<?php echo CController::createUrl('calendar/getNoti'); ?>',
      type    : "post",
      dataType: 'json',
      data    : {
         dataSch  : dataSch,
         action   : action,
         id_author: author,
      },
      success : function (data) {
         console.log(data);
      }
    })
   }
</script>

<script>

$(function(){
/*********** Khoi tao gia tri ***********/
   start_time = moment('<?php echo date_format(date_create($sch['start_time']), 'Y-m-d H:i:s'); ?>');
   today = moment();
   // lich hen
   dentistListModal(<?php echo $sch['id_branch']; ?>);
   servicesList(<?php echo $sch['id_dentist']; ?>,<?php echo $sch['id_service']; ?>,1);
   $('.load-at').hide();
   $('.datetimepicker').datetimepicker({
      sideBySide: true,
      minDate   : today.startOf('hour'),
      format    : 'YYYY-MM-DD HH:mm:ss',
      stepping  : 5,
   });
   $('.datetimepicker').val(start_time.format('YYYY-MM-DD HH:mm:ss'));

   // khach hang
   $('.load-up-cus').hide();
/*********** chon nha sy ***********/
   $('#CsSchedule_up_all_id_dentist').change(function(){
      var id_dentist = $('#CsSchedule_up_all_id_dentist').val();

      $('#CsSchedule_up_all_id_service').html('');
      $('#CsSchedule_up_all_lenght').val(0);

      var id_service = $('#CsSchedule_up_all_id_service').val();

      servicesList(id_dentist, id_service, 1);
   });
/*********** chon dich vụ ***********/
   $('#CsSchedule_up_all_id_service').change(function(e){
      var id_services = $('#CsSchedule_up_all_id_service').val();

      if(!id_services) {
         return;
      }
      else {
         data  = $('#CsSchedule_up_all_id_service').select2('data');
         len   = data[0].len;

         if(typeof len === 'undefined')
            len = 45;

         id_dentist  = $('#CsSchedule_up_all_id_dentist').val();
         start       = moment($('#CsSchedule_up_all_start_time').val());
         id_schedule = $('#CsSchedule_up_all_id').val();

         chkTimeUp(id_dentist, id_services, start, len, id_schedule);

         $('#CsSchedule_up_all_lenght').val(len);
         $('#CsSchedule_up_all_lenght').removeClass('errors');
      }
   })
/*********** chon trang thai ***********/
   $('#CsSchedule_up_all_status').change(function(e){
      id_dentist  = $('#CsSchedule_up_all_id_dentist').val();
      id_services = $('#CsSchedule_up_all_id_service').val();
      start       = moment($('#CsSchedule_up_all_start_time').val());
      len         = $('#CsSchedule_up_all_lenght').val();
      id_schedule = $('#CsSchedule_up_all_id').val();

      chkTimeUp(id_dentist, id_services, start, len, id_schedule);
   })
/*********** chon khoang thoi gian ***********/
   $('#CsSchedule_up_all_lenght').change(function(e){
      id_dentist  = $('#CsSchedule_up_all_id_dentist').val();
      id_services = $('#CsSchedule_up_all_id_service').val();
      start       = moment($('#CsSchedule_up_all_start_time').val());
      len         = $('#CsSchedule_up_all_lenght').val();
      id_schedule = $('#CsSchedule_up_all_id').val();

      chkTimeUp(id_dentist, id_services, start, len, id_schedule);
   })
/*********** chon thoi gian bat dau ***********/
   $('#CsSchedule_up_all_start_time').on('dp.change',function(){
      id_dentist  = $('#CsSchedule_up_all_id_dentist').val();
      id_services = $('#CsSchedule_up_all_id_service').val();
      len      = $('#CsSchedule_up_all_lenght').val();
      start       = moment($('#CsSchedule_up_all_start_time').val());
      id_schedule = $('#CsSchedule_up_all_id').val();
      
      chkTimeUp(id_dentist, id_services, start, len, id_schedule);
   })
/*********** cap nhat lich hen ***********/
   $('.up-sch').click(function (e) {
      e.preventDefault();

      if($('.up-sch').hasClass('btn_unactive')) {
         return;
      }

      userLog = $('#idUserLog').val();

      var formData   = new FormData($("#frm-up-all-sch")[0]);
      
      $('.cal-loading').fadeIn('fast');

      if (!formData.checkValidity || formData.checkValidity()) {
         if($('.up-sch').hasClass('up_sch_cus')) {
            $.when(updateSchCus(formData)).done(function (data) {
               $('#update_sch_modal_all').modal('hide');
               $('.cal-loading').fadeOut('fast');
               getNoti(data['dt'],'update',userLog);
            });
         }
      }
   });
/*********** Xoa lich hen ***********/
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