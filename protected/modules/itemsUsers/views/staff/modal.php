
<style type="text/css">
  .modal-header{
    background-color:#e6e6e5;
  }
  .staff-timeoff-details-daytime {
    border: 1px solid #d9d9d9;
    border-radius: 5px;
    color: #686868;
    display: block;
    line-height: 35px;
    padding-left: 10px;
    padding-right: 10px;
    width: 228px;
}
.staff-timeoff-popup-details-save-btn {
    background: none repeat scroll 0 0 #6ec4a1;
    border-radius: 4px;
    color: #fff !important;
    cursor: pointer;
    display: block;
    font-size: 14px;
    line-height: 40px;
    text-align: center;
    text-decoration: none !important;
    width: 150px;
}
.timeOff-summary-li {
    border: solid 1px #E9EDAB;
    background: #FDFFE5;
    text-align: center;
}
.timeoff-summary-content {
    color: #1C1C1C;
    display: inline-block;
    font-size: 13px;
    line-height: 35px;
    cursor: auto;
    padding: 0px 13px;
}
</style>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="margin-top: 25%;border-radius: 0px;">
      <div class="modal-header">
        <span class="close" data-dismiss="modal"><img style="width: 14px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_sb_left/ic_close.png" class="img-responsive"></span>
        <h4 class="modal-title" style="color: #495861;">Thêm Thời Gian Nghỉ Phép</h4>
      </div>
      <div class="modal-body">
      <p id="msg-error" style="color: green"></p>
        <div class="row">
          <div class="col-md-2" style="padding-right: 0px">
            <p>Ngày bắt đầu</p>
          </div>
          <div class="col-md-9">
            <input type='text' class="form-control" id='datetimepicker4' />
          </div>
        </div>
        <div class="row" style="margin-top: 15px">
          <div class="col-md-2" style="padding-right: 0px">
            <p>Ngày kết thúc</p>
          </div>
          <div class="col-md-9">
            <input type='text' class="form-control" id='datetimepicker5' />
          </div>
        </div>
        <div class="row" style="margin-top: 15px">
          <div class="col-md-2" style="padding-right: 0px">
            <p>Ghi chú</p>
          </div>
          <div class="col-md-9">
            <textarea placeholder="Ghi chú" class="form-control" id="note_time_off" />
          </div>
        </div>
        <div class="row timeOff-summary-li" style="margin-top: 30px;margin-right: 30px;margin-left: 30px;">
            <label class="timeoff-summary-content" id="newtimeoff-summary">Từ 30-12-2016 đến 30-12-2016</label>
        </div>
      </div>
      <div class="modal-footer" style="text-align: center;">
        <div style="margin: 15px 0px;margin-left: 40%">
          <a class="staff-timeoff-popup-details-save-btn  new-timeoff-savebtn" onclick="add_time_off(<?php echo $id_dentist; ?>)" id="saveTimeoff">
          Lưu mới
          </a>
        </div>
      </div>
    </div>

  </div>
</div>
<style type="text/css">
  .dropdown-menu{
    width: 160px;
  }
</style>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-datetimepicker.css">

<script type="text/javascript">
    $(document).ready(function() {
         $('#datetimepicker4').datetimepicker({ format: 'YYYY-MM-DD HH:mm:ss' });
        $('#datetimepicker5').datetimepicker({
          format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false, //Important! See issue #1075
        });
        $("#datetimepicker4").on("dp.change", function (e) {
            $('#datetimepicker5').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker5").on("dp.change", function (e) {
            $('#datetimepicker4').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
<script type="text/javascript">

    function add_time_off(id_dentist)
    {
      var $start_date =  $('#datetimepicker4').val();
      var $end_date =  $('#datetimepicker5').val();
      var $note_time_off =  $('#note_time_off').val();
      var $id_dentist = id_dentist;
      var $id_user = "6";
      if($start_date == "" || $end_date == "")
      {
        $.jAlert({
                    'title': "Thông báo !",
                    'content': "Vui lòng nhập ngày tháng đầy đủ"
                });
      }
      else 
      {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo CController::createUrl('Staff/AddTimeOff')?>",
            data:{
                'start_date' : $start_date,
                'end_date' : $end_date,
                'note_time_off' : $note_time_off,
                'id_dentist' : $id_dentist,
                'id_user' : $id_user,
            },
            success:function(data)
            {
               if(data)
               {
                  $('#add_time_off').css({'display':'none'});
                  $('#list_time_off').append(data);
                  $("#myModal").modal("hide");
                  $.jAlert({
                    'title': "Thông báo !",
                    'content': "Thành công"
                  });
                  $('#datetimepicker4').val("");
                  $('#datetimepicker5').val("");
                  $('#note_time_off').val("");
               }
               else {
                 alert("Error !");
               }
            },
            error: function (data) {
                alert("Error occured.Please try again!");
            },
        });
      }
      
    }
  $(document).ready(function() {});
</script>