<style>
#tab-info .form-group{
   margin-bottom: 10px;
}
</style>

<?php $baseUrl = Yii::app()->getBaseUrl(); ?>

<div id="create_sch_modal" class="modal calendarModal pop_bookoke">
   <div class="modal-dialog" style="padding-top: 48px;">
      <div class="modal-content">

         <div class="modal-header popHead">
            <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
            <h5>TẠO LỊCH HẸN</h5>
         </div>
   
         <div id="modalBody" class="modal-body">   
            <div class="row">
<?php /** @var TbActiveForm $form */
   $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
           'id'               =>    'frm-create-sch',
           'type'                =>    'horizontal',
           'enableAjaxValidation'   => true,
           'clientOptions'       => array(
               'validateOnSubmit'      => true,
               'validateOnChange'      => true,
               'validateOnType'     => true,
           ),
           'htmlOptions'         => array(  
               'enctype'            =>    'multipart/form-data'                        
           ),
       )
); ?>
         
               <ul class="nav nav-tabs nav-1">
                  <li id="nav-sch" class="active"><a data-toggle="tab" href="#tab-schedule">Lịch Hẹn</a></li>
                  <li id="nav-cus"><a data-toggle="tab" href="#customer">Khách Hàng</a></li>
               </ul>
         
            <div class="tab-content">
               <!-- Lich hen -->
               <div id="tab-schedule" class="tab-pane tab-ct fade in active">
               <div class="col-xs-6 col-xs-offset-1">
                     <h4>Trạng thái lịch hẹn</h4>
               </div>
               <div class="col-xs-4">
                  
                  <?php 
                     echo $form->dropDownListGroup($sch, "status",array(
                        'wrapperHtmlOptions' => array('class' => 'col-xs-12',),
                        'widgetOptions'=>array(
                           'data' => $this->stNew,
                           'htmlOptions'=>array('required'=>false,'placeholder'=>'','class'=>'')),
                           'labelOptions' => array("label" => false)
                     ));
                  ?>
               </div>
                   <?php   
                     echo $form->hiddenField($sch,'id_author',array('value' =>Yii::app()->user->user_id));
                     echo $form->hiddenField($sch,'id_chair',array('class'  =>'chair'));
                     echo $form->hiddenField($sch,'id_branch',array('class' =>'branch'));
                     echo $form->hiddenField($sch,'end_time',array('class'  =>'end_time'));
                     echo CHtml::hiddenField('checkT',0,array('class'=>'chkT','id'=>'create_chkT')); ?>

                     <input name="CsSchedule[type]" class="Csh_type" type="hidden" />
                     <div class="form-group">
                        <label class="col-xs-4 control-label" for="CsSchedule_id_dentist">Nha sỹ</label>
                        <div class="col-xs-6">
                           <select placeholder="" class="sch_dentist form-control" name="CsSchedule[id_dentist]" id="CsSchedule_id_dentist"></select>
                        </div>
                        <div class="col-xs-1 load-at load-dt padding-left-0">
                           <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="col-xs-4 control-label" for="CsSchedule_id_service">Dịch vụ</label>
                        <div class="col-xs-6">
                           <select placeholder="" class="sch_service form-control" name="CsSchedule[id_service]" id="CsSchedule_id_service"></select>
                        </div>
                        <div class="col-xs-1 load-at padding-left-0" id="load-sv">
                           <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="col-xs-4 control-label" for="CsSchedule_lenght">Thời gian</label>
                        <div class="col-xs-6">
                           <div class="input-group">
                              <?php echo CHtml::dropDownList('CsSchedule[lenght]', 0, $time_range, array('class'=>'form-control','id'=>'CsSchedule_lenght')); ?>
                              <span class="input-group-addon">phút</span>
                           </div>
                        </div>
                        <div class="col-xs-1 load-at padding-left-0" id="load-ti">
                           <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="col-xs-4 control-label" for="CsSchedule_start_time">Ngày giờ</label>
                        <div class="col-xs-6 times">
                           <input required="required" placeholder="" class="group_time datetimepicker form-control" name="CsSchedule[start_time]" id="CsSchedule_start_time" type="text" />
                        </div>
                        <div class="col-xs-1 load-at padding-left-0" id="load-da">
                           <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        </div>
                     </div>

                  <?php // thoi gian thuc hien
               
                  echo $form->textAreaGroup($sch,'note',array(
                     'wrapperHtmlOptions' => array('class' => 'col-xs-6',),
                     'widgetOptions'=>array(
                        'htmlOptions'=>array()),
                        'labelOptions' => array("label" => 'Ghi chú','class' => 'col-xs-4')
                  ));
                  ?>
                  <div class="form-group">
                     <div class="col-xs-10">
                        <button type="button" class="btn btn_unactive pull-right col-xs-4 crAppt" id="step-1">Tiếp tục</button>
                     </div>  
                  </div>
               </div>
               
               <!-- Khach hang -->
               <div id="customer" class="tab-pane fade">
                     <div id="srch-cus" class="col-xs-12 tab-ct">
                        <?php 
                           echo $form->dropDownListGroup($sch, 'id_customer',array(
                              'wrapperHtmlOptions' => array('class' => 'col-xs-8 col-xs-offset-2',),
                              'widgetOptions' => array(
                                 'htmlOptions'=>array('class'=>'customer','required'=>false)),
                                 'labelOptions' => array("label" => false)
                           ));
                         ?>
                         <div class="col-xs-12 text-center" id="t-cus" style="margin-bottom: 20px;">
                            <button type="button" class="btn btn_bookoke" id="new-cus">Khách mới</button>
                         </div>
                     </div>
         
                     <div class="clearfix"></div>
                     <div id="show-cus" style="display: none;">
                        <ul class="nav nav-tabs nav-2 nav-justified">
                           <li class="active"><a data-toggle="tab" href="#tab-info">Thông tin</a></li>
                           <li><a data-toggle="tab" href="#medical">Bệnh sử</a></li>
                        </ul>
                                 
                        <div class="tab-content">
                           <!-- Lich hen -->
                           <div id="tab-info" class="tab-pane tab-ct fade in active">
                              <div class="col-xs-12">
                              <?php 
                                 $img  =  '<img src="'.$baseUrl.'/upload/customer/no_avatar.png" id="img_cus" />';
                                 echo $form->textFieldGroup($cus, "fullname",array(
                                    'wrapperHtmlOptions' => array('class' => 'col-xs-7 padding-left-0',),
                                    'widgetOptions'=>array(
                                       'htmlOptions'=>array('required'=>false,'placeholder'=>'Họ và tên','value'=>'', 'class'=>'ckError read')),
                                       'labelOptions' => array("label" => $img,'class' => 'col-xs-4')
                                 ));
                                 
                                 echo $form->hiddenField($cus,'id',array('class'=>''));
                                 
                                 echo $form->textFieldGroup($cus, "phone",array(
                                    'wrapperHtmlOptions' => array('class' => 'col-xs-7 padding-left-0',),
                                    'widgetOptions'=>array(
                                       'htmlOptions'=>array('required'=>'','placeholder'=>'Số điện thoại','value'=>'', 'class'=>'ckError read')),
                                       'labelOptions' => array("label" => 'Số điện thoại','class' => 'col-xs-4')
                                 ));
                                 
                                 echo $form->textFieldGroup($cus, "email",array(
                                    'wrapperHtmlOptions' => array('class' => 'col-xs-7 padding-left-0',),
                                    'widgetOptions'=>array(
                                       'htmlOptions'=>array('required'=>'','placeholder'=>'Email','value'=>'', 'class'=>'read')),
                                       'labelOptions' => array("label" => 'Email','class' => 'col-xs-4')
                                 ));
                                  ?> 

                                 <div class="form-group">
                                    <label class="col-xs-4 control-label" for="Customer_cus_seg">Nhóm</label>
                                    <div class="col-xs-6 padding-left-0">
                                      <?php  echo CHtml::dropDownList('Customer[cus_seg]','',$cusSeg, array('empty'=>"Chọn nhóm khách hàng",'class'=>'form-control read')); ?>
                                    </div>
                                 </div>
                  
                              <div class="form-group">
                                 <label class="col-xs-4 control-label" for="Customer_gender">Giới tính</label>
                                 <div class="col-xs-6 padding-left-0">
                                    <select class="read form-control" name="Customer[gender]" id="Customer_gender">
                                       <option value="0">Nam</option>
                                       <option value="1">Nữ</option>
                                    </select>
                                    <div class="help-block error" id="Customer_gender_em_" style="display:none"></div>
                                 </div>
                              </div>
                             
                              <?php
                                 echo $form->textFieldGroup($cus, "birthdate",array(
                                    'wrapperHtmlOptions' => array('class' => 'col-xs-6 padding-left-0',),
                                    'widgetOptions'=>array(
                                       'htmlOptions'=>array('required'=>'','placeholder'=>'Ngày sinh','value'=>'', 'class'=>'read')),
                                       'labelOptions' => array("label" => 'Ngày sinh','class' => 'col-xs-4')
                              ));?>
                                 
                                <?php echo $form->textFieldGroup($cus, "identity_card_number",array(
                                    'wrapperHtmlOptions' => array('class' => 'col-xs-7 padding-left-0',),
                                    'widgetOptions'=>array(
                                       'htmlOptions'=>array('required'=>'','placeholder'=>'CMND','value'=>'', 'class'=>'read')),
                                       'labelOptions' => array("label" => 'CMND','class' => 'col-xs-4')
                                 ));
                              ?>

                                 <div class="form-group">
                                    <label class="col-xs-4 control-label" for="Customer_id_country">Quốc tịch</label>
                                    <div class="col-xs-6 padding-left-0">
                                       <select placeholder="" class="read form-control" name="Customer[id_country]" id="Customer_id_country"></select>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <div class="col-xs-11 btn_cus text-right">
                                       <button type="button" class="btn btn_cancel" id="step-pre" style="color: white;">Quay lại</button>
                                       <button type="button" class="btn btn_unactive" id="step-2" style="color: white;">Tiếp tục</button>
                                    </div>  
                                 </div>
                              <?php 
                                 $this->endWidget();
                                 unset($form);
                              ?>
                              </div>
                           </div>
                                 
                           <!-- Benh su -->
                           <div id="medical" class="tab-pane fade">
                              <h5 class="text-center">Bệnh sử y khoa</h5>
                              <div id="medi">
                              <div class="col-xs-10 col-xs-offset-1">
                              <?php 
                                 $t = 0;
                                 $alert =  MedicineAlert::model()->findAllByAttributes(array('status'=>1));
                                 $alert =  CHtml::listData($alert,'id','name');
                                 
                                 foreach ($alert as $key => $value): 
                                    $checked = '';
                                    $dis = 'style="display: none;"';
                                    if(isset($als[$t]) && $key == $als[$t]) {
                                       $checked = 'checked';
                                       $dis = '';
                                       $t++;

                                    }
                              ?>

                              <div class="checkbox">
                                 <label>
                                    <input id="ytCsMedicalHistoryAlert_id_medicine_alert_<?php echo $key; ?>" type="hidden" value="0" name="CsMedicalHistoryAlert[id_medicine_alert][<?php echo $key; ?>]">

                                    <input class="alCk" <?php echo $checked; ?> name="CsMedicalHistoryAlert[id_medicine_alert][<?php echo $key; ?>]" id="CsMedicalHistoryAlert_id_medicine_alert_<?php echo $key; ?>" value="1" type="checkbox">
                                    <?php echo $value; ?>
                                 </label>
                                 <input <?php echo $dis; ?> type="text" name="CsMedicalHistoryAlert[note][<?php echo $key; ?>]" id="CsMedicalHistoryAlert_note_<?php echo $key; ?>" value="" placeholder="" class="form-control Medical_note">
                              </div>
                              <?php endforeach ?>
                           </div>

                           <div class="form-group">
                              <div class="col-xs-11 text-right" style="margin: 10px 0;">
                                 <button type="submit" class="btn btn_bookoke" id="step-4">Đặt lịch</button>
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
</div>

<script>
/*********** kiem tra lich hen ***********/
   function checkSch(id_dentist, id_services, len) {
      ck = true;
      // check dentist
      if(!id_dentist) {
         $($('#CsSchedule_id_dentist').data('select2').$container).addClass('errors');
         ck = false;
      }
      else {
         $($('#CsSchedule_id_dentist').data('select2').$container).removeClass('errors');
      }

      // check services
      if(!id_services) {
         $($('#CsSchedule_id_service').data('select2').$container).addClass('errors');
         ck = false;
      }
      else {
         $($('#CsSchedule_id_service').data('select2').$container).removeClass('errors');
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
/*********** kiem tra thoi gian cua lich hen ***********/
   function chkTime(id_dentist, id_services, start, len, chk) {
      $chk = 1;
      $('#step-1').attr('class','btn btn_unactive pull-right col-xs-4');
      if(id_services == 0) {
         $('#step-1').addClass('brTime');
      }
      chkSch = checkSch(id_dentist, id_services, len);

      if(!chkSch) {
         $chk = 0;
         $('#create_chkT').val(0);
         return;
      }

      if(!moment(start).isValid()) {
         $('#CsSchedule_start_time').addClass('errors');
         $chk = 0;
      }

      startT      = moment(start).format("YYYY-MM-DD HH:mm:ss");     
      end         = moment(start).add(len,'m').format("YYYY-MM-DD HH:mm:ss");
      $('#CsSchedule_end_time').val(end);

      if($chk == 0) {
         $('#create_chkT').val(0);
         $('#step-1').addClass('unbtn');
         return ;
      }

      ck = checkTimeAjax(id_dentist, startT, end, 0).done(checkTime);
   }
/*********** lay nhom khach hang theo id ***********/
   function getCusSeg(id_customer) {
      $.ajax({
         url    :"<?php echo CController::createUrl('calendar/getCustomerSeg'); ?>",
         type   : 'POST',
         dataType: 'json',
         data   : {id_customer: id_customer},
         success: function (data) {
            if(data.length > 0)
               $('#Customer_cus_seg').val(data[0].id_segment);
            else
               $('#Customer_cus_seg').val('');
         }
      });
   }
/*********** kiem tra lich hen hien tai cua khach hang ***********/
   function checkCustomerSchedule(id_customer) {
      $.ajax({
         url     : '<?php echo CController::createUrl('calendar/checkCustomerSchedule'); ?>',
         type    : 'POST',
         dataType: 'json',
         data    : {id_customer: id_customer},
         success:function (data) {
            if(data == 1){
               $('#info_head').text('THÔNG BÁO!');
               $('#info_content').text('Khách hàng có lịch hẹn chưa hoàn tất!');
               $("#info").modal();
            }
         }
      });
   }
/*********** Customer ***********/
   function getCountryName(id_country) {
      $.ajax({ 
            type     :  "POST",
            url      :  "<?php echo CController::createUrl('calendar/getCountryName')?>",
            data     :  {id_country: id_country},
            dataType :  'json',
            success: function (data) {
               $('#Customer_id_country').html("<option value='"+id_country+"'>"+data+"</option>");
            }
      });
   }
   function Customer(id_customer,data) {
      if(id_customer) {
         $('#Customer_fullname').val(data[0].text);
         $('#Customer_phone').val(data[0].phone);
         $('#Customer_email').val(data[0].email);
         $('#Customer_gender').val(data[0].gender);
         $('#Customer_birthdate').val(data[0].birthdate);
         $('#Customer_identity_card_number').val(data[0].identity_card_number);
         $('.read').attr('readonly',true);

         getCusSeg(id_customer);
         getCountryName(data[0].id_country);
         $("#Customer_id_country").prop("disabled", true);
      }
      else {
         $('#Customer_fullname').val('');
         $('#Customer_phone').val('');
         $('#Customer_email').val('');
         $('#Customer_gender').val(0);
         $('#Customer_birthdate').val('');
         $('#Customer_identity_card_number').val('');
         $('#Customer_id_country').html("<option value='VN'>Việt Nam</option>");
         $('#Customer_cus_seg').val('');
         $('.read').attr('readonly',false);
         $("#Customer_id_country").prop("disabled", false); 
      }
   }
/*********** kiem tra thong tin khach hang ***********/
   function checkCus(id_customer, fullname, phone) {
      if(id_customer) {
         $('#Customer_fullname').removeClass('errors');
         $('#Customer_phone').removeClass('errors');
         $('#Customer_id').val(id_customer);
         $('.read').attr('readonly',true);
         $('#step-2').attr('class','btn btn_bookoke');
         return true;
      }
      else {
         $('#Customer_id').val('');
         $('.read').attr('readonly',false);
         if(fullname && phone.match(/^\d+$/)) {
            $('#Customer_fullname').removeClass('errors');
            $('#Customer_phone').removeClass('errors');
            $('#step-2').attr('class','btn btn_bookoke');
            return true;
         }
         else {
            $('#Customer_fullname').addClass('errors');
            $('#Customer_phone').addClass('errors');
            return false;
         }
      }
      return false;
   }
/*********** lay thong tin benh su y khoa ***********/
   function getMedicalAlert(id_customer) {
      $('.Medical_note').hide();
      $('.Medical_note').val('');
      
      $.ajax({ 
         type     :"POST",
         url      :"<?php echo CController::createUrl('calendar/medicalAlert'); ?>",
         dataType :'json',
         data: {
            id_customer: id_customer,
         },
         success: function (data) {
            $.each(data, function (k,v) {
               $('#CsMedicalHistoryAlert_id_medicine_alert_'+k).prop('checked',true);
               if(v) {
                  $('#CsMedicalHistoryAlert_note_'+k).val(v);
                  $('#CsMedicalHistoryAlert_note_'+k).show();
               }
            })
         },
      });
   }
/*********** Action create new Schedule + Customer ***********/
   function addSchCus(formData) {
      return  jQuery.ajax({ 
            type       :  "POST",
            url        :  "<?php echo CController::createUrl('calendar/addEvent')?>",
            data       :  formData,
            dataType   :  'json',
            cache      : false,
            contentType: false,
            processData: false
         });
   }
/*********** Add break time ***********/
   function addBreak(formData) {
      return  $.ajax({ 
            type       :  "POST",
            url        :  "<?php echo CController::createUrl('calendar/addBreak')?>",
            data       :  formData,
            dataType   :  'json',
            cache      : false,
            contentType: false,
            processData: false
         });
   }
</script>

<script>
$(window).load(function () {
   countryList();
   // preview customer
   $('#step-pre').click(function (e) {
      $('#CsSchedule_id_customer').val(-1).trigger('change');
      $('#srch-cus').show();
      $('#show-cus').hide();
   })

   // change dentist
   $('#CsSchedule_id_dentist').change(function(){
      var id_dentist = $('#CsSchedule_id_dentist').val();
      if(!id_dentist) {
         $($('#CsSchedule_id_dentist').data('select2').$container).addClass('errors');
      }
      else {
         $($('#CsSchedule_id_dentist').data('select2').$container).removeClass('errors');
      }

      $('#CsSchedule_id_service').html('');

      servicesList(id_dentist);
      $($('#CsSchedule_id_service').data('select2').$container).addClass('errors');
      $('#CsSchedule_lenght').val(0);
   });

   // change services
   $('#CsSchedule_id_service').change(function(e){
      var id_services = $('#CsSchedule_id_service').val();

      if(!id_services) {
         $($('#CsSchedule_id_service').data('select2').$container).addClass('errors');
         $('#CsSchedule_lenght').val(0);
         $('#CsSchedule_lenght').addClass('errors');
      }
      else {
         $($('#CsSchedule_id_service').data('select2').$container).removeClass('errors');

         data  = $('#CsSchedule_id_service').select2('data');
         len   = data[0].len;

         id_dentist  = $('#CsSchedule_id_dentist').val();
         start       = moment($('#CsSchedule_start_time').val());

         if(len == 0 || typeof len == 'object' || len == '') {
            $('#CsSchedule_lenght').val(0);
            return;
         }

         chkTime(id_dentist, id_services, start, len);

         $('#CsSchedule_lenght').val(len);
         $('#CsSchedule_lenght').removeClass('errors');
      }
   })

   // change length services
   $('#CsSchedule_lenght').change(function(e){
      id_dentist  = $('#CsSchedule_id_dentist').val();
      id_services = $('#CsSchedule_id_service').val();
      start       = moment($('#CsSchedule_start_time').val());
      len         = $('#CsSchedule_lenght').val();

      chkTime(id_dentist, id_services, start, len);
   })

   // change start_time
   $('#CsSchedule_start_time').on('dp.change',function(){
      id_dentist  = $('#CsSchedule_id_dentist').val();
      id_services = $('#CsSchedule_id_service').val();
      len      = $('#CsSchedule_lenght').val();
      start       = moment($('#CsSchedule_start_time').val());
      
      chkTime(id_dentist, id_services, start, len);
   })

   // change tab customer
   $('.nav-tabs a[href="#customer"]').on("click", function(e) {
       e.preventDefault();

      id_dentist     = $('#CsSchedule_id_dentist').val();
      id_services    = $('#CsSchedule_id_service').val();
      len            = $('#CsSchedule_lenght').val();
      start          = moment($('#CsSchedule_start_time').val());

      if(id_services == 0) {
         return false;
      }

      ck = chkTime(id_dentist, id_services, start, len);

      var ckT = '';
      $.when(ck).done(function(){
         ckT = $('#create_chkT').val();
      });

      if(ckT == 0)
         return false;

      $('.nav-tabs a[href="#tab-info"]').tab('show');
      id_customer = $('#CsSchedule_id_customer').val();

      if(!id_customer) {
         $('#srch-cus').show();
         $('#show-cus').hide();
         $('#step-2').addClass('btn_unactive');
      }
      
      $('#step-2').removeClass('btn_unactive');
   }); 

   // btn click next step customer
   $('#step-1').click(function(e){
      e.preventDefault();

      if($('#step-1').hasClass('btn_unactive')) {
         return;
      }

      if($('#step-1').hasClass('brTime')) {
         var formData   = new FormData($("#frm-create-sch")[0]);
         $.when(addBreak(formData)).done(function (data) {
            $('#calendar').fullCalendar('renderEvent',data,true);
            $('#create_sch_modal').modal('hide');
         })
         return;
      }

      id_dentist  = $('#CsSchedule_id_dentist').val();
      id_services = $('#CsSchedule_id_service').val();
      len         = $('#CsSchedule_lenght').val();
      start       = moment($('#CsSchedule_start_time').val());
      ckT         = '';

      ck = chkTime(id_dentist, id_services, start, len);
   
      $.when(ck).done(function(){
         ckT      = $('#create_chkT').val();

         if(ckT == 1) {
            $('.nav-tabs a[href="#customer"]').tab('show');
            $('.nav-tabs a[href="#tab-info"]').tab('show');

            id_customer = $('#CsSchedule_id_customer').val();

            if(!id_customer) {
               $('#srch-cus').show();
               $('#show-cus').hide();
            }
         }
      });
   })

   // new customer
   $('#new-cus').click(function (e) {
      $('#srch-cus').hide();
      $('#show-cus').show();
      $('#CsSchedule_id_customer').html('');
      $('#step-2').attr('class','btn btn_unactive');
      Customer();
   })

   // search customer
   $('#CsSchedule_id_customer').change(function(){
      id_customer = $('#CsSchedule_id_customer').val();
      data        =  $('#CsSchedule_id_customer').select2('data');

      if(id_customer) {
         $('#srch-cus').hide();
         $('#show-cus').show();
         checkCustomerSchedule(id_customer);
      }

      checkCus(id_customer);
      Customer(id_customer,data);
   });

   // change customer
   $('#Customer_fullname, #Customer_phone').on('keyup',function (e) {
      fullname = $('#Customer_fullname').val();
      phone =  $('#Customer_phone').val();

      checkCus('', fullname, phone);

      if(customer && phone.match(/^\d+$/)) {
         $('#step-2').removeClass('unbtn');
      }
   })

   $('#Customer_birthdate').datetimepicker({
      maxDate: moment().format('YYYY-MM-DD'),
      format: 'YYYY-MM-DD',
   });

   // change tab medical history (chuyen tab benh su y khoa)
   $('.nav-tabs a[href="#medical"]').on("click", function(e) {
       e.preventDefault();

      id_customer = $('#CsSchedule_id_customer').val();

      if(id_customer) {
         $('.nav-tabs a[href="#medical"]').tab('show');
         getMedicalAlert(id_customer);
      }
      else {
         fullname = $('#Customer_fullname').val();
         phone = $('#Customer_phone').val();

         ckCus = checkCus('', fullname, phone);

         if(ckCus) {
            $('.nav-tabs a[href="#medical"]').tab('show');
         }
      }

      return false;
      
   });

   // btn click next step medical
   $('#step-2').click(function(e){
      e.preventDefault();
      if($('#step-2').hasClass('unbtn')) {
         return;
      }

      id_customer = $('#CsSchedule_id_customer').val();

      if(id_customer) {
         $('.nav-tabs a[href="#medical"]').tab('show');
         getMedicalAlert(id_customer)
      }
      else {
         fullname = $('#Customer_fullname').val();
         phone = $('#Customer_phone').val();

         ckCus = checkCus('', fullname, phone);

         if(ckCus) {
            $('.nav-tabs a[href="#medical"]').tab('show');
         }
      }
   })
   
   // check medical alert (benh su y khoa)
   $('.alCk').change(function (e) {
      idCk = $(this).attr('id');
      ck = $(this).is(':checked');
      idNote = idCk.replace('id_medicine_alert','note');
      if(ck == true) {
         $('#'+idNote).show();
      }
      else {
         $('#'+idNote).val('');
         $('#'+idNote).hide();
      }
   })

   // btn dat lich submit form
   $('#step-4').click(function (e) {
      e.preventDefault();

      fullname       = $('#Customer_fullname').val();
      phone          = $('#Customer_phone').val();
      id_customer    = $('#CsSchedule_id_customer').val();

      ckCus       = checkCus(id_customer, fullname, phone);

      if(!ckCus)
         return;

      ck = chkTime(id_dentist, id_services, start, len);

      var ckT = '';
      $.when(ck).done(function(){
         ckT = $('#create_chkT').val();
      });

      var formData   = new FormData($("#frm-create-sch")[0]);
      
      if(ckT == 1 && ckCus){
         $('.cal-loading').fadeIn('fast');
         if (!formData.checkValidity || formData.checkValidity()) {
            $.when(addSchCus(formData)).done(function (data) {
               
               $('.cal-loading').fadeOut('fast');
               if(data == -1){
                  serText = $('#CsSchedule_id_service').select2('data')[0].text;
                  segText = $('#Customer_cus_seg option:selected').text();
                  $('#info_content').text('Dịch vụ '+serText+' không thuộc nhóm khách hàng '+segText+'!');
                  $("#info").modal();
                  return;
               }
               else if(data.status == 1){
                  $('#frm-create-sch')[0].reset();
                  $('.cal_loading').fadeIn('fast');
                  $('.help-block').hide();
                  $('.ckError').removeClass('errors');

                  $('#calendar').fullCalendar('renderEvent',data.ev,true);
                  $('#create_sch_modal').modal('hide');
                  getNoti(data.dt,'add');
               }
               else {
                  $('.read').attr('readonly',false);
                  $.each(data, function (k, v) {
                     $('#Customer_' + k +'_em_').text(v);
                     $('#Customer_' + k +'_em_').show();
                     $('#Customer_' + k).addClass('errors');
                  })
               }
            });
         }
      }
   })
})
</script>