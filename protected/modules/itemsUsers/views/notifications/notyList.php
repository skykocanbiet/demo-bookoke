<style type="text/css">
     .noty_Table tr td {
        border-top: 1px solid #fff !important;
        vertical-align: middle !important;
    }
</style>
<table class="table table-hover noty_Table" style="border-collapse:collapse;">
    <thead>
        <tr>
            <th></th>
            <th>Tiêu đề</th>
            <th>Người tạo</th>
            <th>Người thực hiện</th>
            <th>Hành động</th>
            <th>Ngày tạo</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!$noty): ?>
    	<tr><td colspan="6">Không có dữ liệu</td></tr>
    <?php endif ?>
    	<?php 
      /*  echo "<pre>";
        print_r($noty);
        echo "</pre>";*/
        foreach ($noty as $key => $value): 
    		$title = array('0' => 'Lịch hẹn');
    		$data = json_decode($value['data']);
    		$text = ($value['status'] == 0) ? 'Lịch hẹn' : '';
    	?>
    		<tr style="background: #f1f5f6 !important;" data-toggle="collapse" data-target="#q<?php echo $key;?>" class="accordion-toggle" onclick="updateUserNotifications(<?php echo $value['id']; ?>);" >
                <td><input type="checkbox" name="checkNoti" value="<?= $value['id']; ?>" class="hidden" id="checkNoti<?= $value['id']; ?>"></td>
	        	<td style="position: relative;">
                    <?php echo $title[$value['flag']]; ?>
                    <?php if(!$value['id_user']){ ?>
                        <span class="watched<?php echo $value['id']; ?>" style="position: absolute;top: 5px;left: 10px;font-size: 14px;color: #ccc "><i class="fa fa-eye" aria-hidden="true"></i></span>
                    <?php } ?>      
                </td>
	        	<td><?php echo $value['name_author']; ?></td>
	        	<td><?php echo $value['name_dentist']; ?></td>
	        	<td><?php 
                        if($value['action'] == 'update'){
                            echo "Cập nhật";
                        }

                        if($value['action'] == 'add'){
                            echo "Tạo mới";
                        }

                ?></td>
	        	<td><?php echo $value['creatdate']; ?></td>
	        	<td style="text-align: center;"><?php 

                $data= json_decode($value['data']);

                if($data->status == '-2'){
                    echo '<span class = "label label_sch_khongden">Không đến</span>';
                }

                if($data->status == '-1'){
                    echo '<span class = "label label_sch_huy">Hủy hẹn</span>';
                }

                if($data->status == 0){
                    echo '<span class = "label  label_notworking">Không làm việc</span>';
                }

                if($data->status == 1){
                    echo '<span class = "label label_sch_moi">Lịch mới</span>';
                }

                if($data->status == 2){
                    echo '<span class = "label label_sch_daden">Đã đến</span>';
                }

                if($data->status == 3){
                    echo '<span class = "label label_sch_vaokham">Vào khám</span>';
                }

                if($data->status == 4){
                    echo '<span class = "label label_sch_hoantat">Hoàn tất</span>';
                }

                if($data->status == 5){
                    echo '<span class = "label label_sch_hoantat">Bỏ về</span>';
                }
                ?>
              

                </td>
	        </tr>
	        <tr>
	    		<td colspan="6" class="hiddenRow">
	    			<div class="accordian-body collapse noty_Detail col-md-12 text-left" id="q<?php echo $key;?>">
                    <h5 class="text-left">Mô tả:</h5>
                        <p></p>
                        <p><b><?php echo $text; ?> từ khách hàng:</b> <?php echo $data->fullname; ?></p>
                        <p><b>Người thực hiện:</b> <?php echo $value['name_dentist']; ?></p>
	                    <p><b>Thời gian bắt đầu:</b> <?php echo $data->start_time;?></p>
	                    <p><b>Thời gian kết thúc:</b> <?php echo $data->end_time; ?></td></p>
	    			</div>
	    		</td>
    	<?php endforeach ?>
    </tbody>
</table>

<div style="clear:both"></div>
<div id="" class="col-xs-12 text-center" style="position: fixed; bottom: 10px;">
    <?php if($page_list) echo $page_list;?> 
</div>