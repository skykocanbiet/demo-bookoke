<style>
    .smsTable tr td {
        border-top: 1px solid #fff !important;
        vertical-align: middle !important;
    }
    .reSendSmshover {
        background: url('../../images/icon_sb_left/gui_lai_act.png'); 
    }
</style>
<table class="table table-hover smsTable" style="border-collapse:collapse;">
    <thead>
        <tr>
            <th style="width: 3%;">STT</th>
            <th style="width: 10%;">Người gửi</th>
            <th style="width: 10%;">Người nhận</th>
            <th style="width: 9%;">Số điện thoại</th>
            <th>Nội dung</th>
            <th style="width: 8%;">Lịch hẹn</th>
            <th style="width: 11%;">Ngày gửi</th>
            <th style="width: 7%;">Trạng thái</th>
            <th style="width: 6%;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!$sms): ?>
    	<tr><td colspan="9">Không có dữ liệu</td></tr>
    <?php endif ?>
    	<?php  foreach ($sms as $key => $value): ?>
    		<tr data-toggle="collapse" data-target="#q<?php echo $key;?>" style="background: #f1f5f6 !important;">
	        	<td class="id"><?php echo $value['id']; ?></td>
	        	<td class="aut"><?php echo $value['author']; ?></td>
                <td class="id_cus hidden"><?php echo $value['id_customer']; ?></td>
                <td class="cus"><?php echo $value['customer']; ?></td>
	        	<td class="pho"><?php echo $value['phone']; ?></td>
                <td class="ct"><?php echo $value['content']; ?></td>
                <td class="sch"><?php echo $value['id_schedule']; ?></td>
	        	<td class="date"><?php echo $value['create_date']; ?></td>
	        	<td class="sts"> 
                    <?php if ($value['status'] == 1): ?>
                        Thành công
                    <?php elseif(isset(Sms::model()->sendSMSError[$value['status']])): ?>
                        <?php echo Sms::model()->sendSMSError[$value['status']]; ?>    
                    <?php endif ?>
                </td>
                <td> 
                   <a href="" class="reSendSms" data-toggle="modal" data-target="#sendsSmsPop" style="padding-right: 10px;"><img data-toggle="tooltip" title="Gửi lại"  src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/gui_lai_def.png" alt="" style="width: 25px;"></a>
                   <a href="" class="cancelSms text-right" style="color: red;"><img data-toggle="tooltip" title="Xóa tin nhắn" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/icon_sb_left/delete-def.png" alt="" style="width: 15px;"></a>
                </td>
	        </tr>
	        <tr>
	    		<td colspan="6" class="hiddenRow">
	    		</td>
            </tr>
    	<?php endforeach ?>
    </tbody>
</table>

<div style="clear:both"></div>
<div id="" class="col-xs-12 text-center" style="position: fixed; bottom: 10px;">
    <?php if($page_list) echo $page_list;?> 
</div>

<div id="smsRs" class="modal pop_bookoke">
    <div class="modal-dialog" style="width: 380px; padding-top: 100px;">
        <div class="modal-content">
            <div class="modal-header popHead">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">close</span></button>
                <span>THÔNG BÁO</span>
            </div>
   
            <div class="modal-body">
                <p id="rsct">Bạn muốn xóa tin nhắn này</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_bookoke calcf">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

<?php include 'send_sms.php'; ?>

<script>
    $('[data-toggle="tooltip"]').tooltip();
    $('.smsTable').on('click','.cancelSms',function (e) {
        e.preventDefault();

        id     = $(this).parents('tr').find('.id').text();

        $('#smsRs').modal();

        $('.calcf').click(function (e) {
            e.preventDefault();
            $.ajax({
                type    : "post",
                dataType: 'json',
                url     : '<?php echo Yii::app()->createUrl('itemsUsers/Sms/delSms'); ?>',
                data    : {
                   id:id
                },
                success: function(data) {
                   if(data == 1){
                        location.href = '<?php echo Yii::app()->getBaseUrl(); ?>/itemsUsers/sms/view';
                   }
                },
          });
        })

    });

    $('.smsTable').on('click','.reSendSms',function (e) {
        e.preventDefault();

        id     = $(this).parents('tr').find('.id').text();
        phone  = $(this).parents('tr').find('.pho').text();
        ct     = $(this).parents('tr').find('.ct').text();
        cus    = $(this).parents('tr').find('.cus').text();
        id_cus = $(this).parents('tr').find('.id_cus').text();
       
        $('#Sms_phone').val(phone);
        $('#Sms_content').val(ct);
        $('#Sms_cus').val(cus);
        $('#Sms_id_cus').val(id_cus);
        len = ct.length;
        
        $('#charNum').text(200-len);

    })
</script>