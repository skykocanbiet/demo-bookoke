<style type="text/css">
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
<div id="myModal_update_time_off" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="margin-top: 25%;border-radius: 0px;">
      <div class="modal-header">
        <span class="close" data-dismiss="modal"><img style="width: 14px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_sb_left/ic_close.png" class="img-responsive"></span>
        <h4 class="modal-title" style="color: #495861;">Thay Đổi Thời Gian Nghỉ Phép</h4>
      </div>
      <div class="modal-body">
      <p id="msg-error" style="color: green"></p>
       <input type="hidden" id="time_off_Id" value=""/>
        <div class="row">
          <div class="col-md-2" style="padding-right: 0px">
            <p>Ngày bắt đầu</p>
          </div>
          <div class="col-md-9">
            <input type='text' class="form-control" id='datetimepicker6' />
          </div>
        </div>
        <div class="row" style="margin-top: 15px">
          <div class="col-md-2" style="padding-right: 0px">
            <p>Ngày kết thúc</p>
          </div>
          <div class="col-md-9">
            <input type='text' class="form-control" id='datetimepicker7' />
          </div>
        </div>
        <div class="row" style="margin-top: 15px">
          <div class="col-md-2" style="padding-right: 0px">
            <p>Ghi Chú</p>
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
          <span class="staff-timeoff-popup-details-save-btn  new-timeoff-savebtn" onclick="update_time_off_active()" id="saveTimeoff">
          Lưu Cập Nhật
          </span>
          <span
            style="margin-top: 20px" class="staff-timeoff-popup-details-save-btn  new-timeoff-savebtn" onclick="delete_time_off_active()" id="deleteTimeoff">
          Xóa
          </span>
          
        </div>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
         $('#datetimepicker6').datetimepicker({ format: 'YYYY-MM-DD HH:mm:ss' });
        $('#datetimepicker7').datetimepicker({
          format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false, //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });
    function update_time_off_active()
    {
        alert("update");
    }
    function delete_time_off_active()
    {
        var time_off_Id = $('#time_off_Id').val();
        // alert(time_off_Id);
        $.alertOnClick('deleteTimeoff', {
                'title':'Xóa thời gian !',
                'content':'Bạn chắc chắn muốn xóa thời gian này không ?',
                'btns': [
                    {'text':'Hủy', 'closeAlert':true},
                    {'text':'Đồng ý', 'closeAlert':true, 'onClick': function(){
                        jQuery.ajax({
                            type: "POST",
                            url: "<?php echo CController::createUrl('Staff/DeleteTimeOff')?>",
                            data:{
                                'id' : time_off_Id,
                            },
                            success:function(data)
                            {
                                if(data)
                                {
                                    $.jAlert({
                                        'title': "Thông báo !",
                                        'content': data
                                    });
                                    $("#myModal_update_time_off").modal("hide");
                                    $('#time_off_'+time_off_Id).remove();
                                }
                                
                                else{
                                    $.jAlert({
                                        'title': "Thông báo !",
                                        'content': "Không xóa được"
                                    });
                                }
                            },
                            error: function (data) {
                                alert("Error occured.Please try again!");
                            },
                        });
                        }}
                ]
        });
        // var checkstr =  confirm('are you sure you want to delete this?');
        // if(checkstr == true)
        // {
            
        // }else{
        // return false;
        // }
    }
</script>