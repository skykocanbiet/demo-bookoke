<?php $baseUrl = Yii::app()->getBaseUrl(); ?>
<?php $this->renderPartial('calendar_css'); ?>

<?php $val = '';
      $chair = '<option value="2">Ghế khám</option>';
      $disabled = '';
if($role == 0){
  $val      = '<option value="'.$id_user.'">'.$name_user.'</option>';
  $chair    = '';
  $disabled = 'disabled';
} 

for ($i=0; $i <= 180 ; $i+=5) { 
    $time_range[$i] = $i;
}
$time_range[0] = 'N/A';
?>

<input type="hidden" id="idUserLog" value="<?php echo Yii::app()->user->getState('user_id'); ?>">

<div class="col-md-4 side-left padding-0">
  <div class="col-md-4 padding-left-0">
    <?php echo CHtml::dropDownList('id_branch','',$branch, array('class'=>'form-control')); ?>
  </div>

  <div class="col-md-4 padding-0">
    <select name="" id="at_srch" class="form-control search" <?php echo $disabled; ?>>
    <?php echo $val; ?>
    </select>
  </div>

</div>

	<!-- calendar -->
<div id="calendar"></div>
</div>

  <!-- tạo lịch hẹn -->
<?php include 'create_event.php'; ?>
	<!-- update schedule -->
<?php include 'update_event.php'; ?>
  <!-- send_sms -->
<?php include 'send_sms.php'; ?>

	<!-- quotation -->
<div id="quote_modal" class="modal fade">
</div>

  <!-- order -->
<div id="order_modal" class="modal fade">
</div>

<!-- pop up information -->
<div class="modal pop_bookoke" id="info" role="dialog">
    <div class="modal-dialog" style="width: 350px;">
        <div class="modal-content">

            <div class="modal-header popHead">
                <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
                <h5 id="info_head">THÔNG BÁO</h5>
            </div>
            <div class="modal-body text-center">
                <p id="info_content">Some text in the modal.</p>
            </div>

        </div>
    </div>
</div>

<!-- pop up confirm -->
<div class="modal pop_bookoke" id="confirm" role="dialog">
    <div class="modal-dialog" style="width: 350px;">
        <div class="modal-content">

            <div class="modal-header popHead">
                <a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
                <h5 id="cf_head">THÔNG BÁO</h5>
            </div>
            <div class="modal-body">
                <p id="cf_content" class="text-center">Some text in the modal.</p>
            </div>
            <div class="text-right" style="padding: 0 15px 15px">
                <button type="button" class="btn btn_bookoke cf_submit">Đồng ý</button>
            </div>
            
        </div>
    </div>
</div>

<?php include 'calendar_js.php'; ?>