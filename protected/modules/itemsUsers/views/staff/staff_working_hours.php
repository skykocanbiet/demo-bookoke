<style type="text/css">
	.stacked-list {
	    list-style: none;
	    margin-left: 0px;
	}
	.staff-breaks-list, .staff-hour-list {
	    margin-left: 30px;
	    margin-top: 10px;
	}
	.staff-breaks-list .active label:first-child span, .staff-hour-list label:first-child span {
	    border-radius: 50px;
	    background-color: #dff6f5;
	    color: #455862 !important;
	    font-weight: 400;
	    cursor: default;
	}
/*	.sliders {
	    line-height: 23px;
	    float: left;
	    width: 60px;
	    position: absolute;
	    color: #ffffff !important;
	    font-size: 11px !important;
	    font-weight: 800 !important;
	}*/
	.slider_off {
    background: url('../../images/switch-bg.png') -57px 0px no-repeat;
    left: 60px;
    text-indent: 26px;
    color: #ffffff !important;
	}
	.slider_on {
    background: url('../../images/switch-bg.png') 0px 0px no-repeat;
    text-indent: 10px;
    left: 2px;
	}
	.slider_switch {
    background: url('../../images/switch-btn.png') left top no-repeat;
    height: 24px;
    left: 38px;
    position: absolute;
    width: 25px;
	}
	.btn-group {
	    position: relative;
	    display: inline-block;
	    font-size: 0;
	    vertical-align: middle;
	    white-space: nowrap;
	}
	.staff-hour-list li.active span.span6 .btn-group .btn.dropdown-toggle {
    border: 1px solid #cccccc;
    color: #455862;
	}
	.staff-hour-list li span.span6 .btn-group .btn.dropdown-toggle:first-child {
    margin-right: 10px;
    margin-bottom: 3px;
    background: white;
	}
	.staff-hour-list li span.span6 .btn-group .btn.dropdown-toggle:first-child {
    width: 75px;
	}
	.stacked-list .btn {
		border: 1px solid #ccc !important;
	    padding: 2px 15px !important;
	    color: #455862 !important;
	}
	.stacked-list li{
		height: 40px;
	}
	.active_off{
		background-color: inherit !important;
    	color: #ccc !important;
	}
	span.active_off{
		color: #ccc !important;
	}
</style>
<?php
	include_once('modal.php');
	include_once('modal_update.php');
 	function In_thu($number)
 	{
 		switch ($number) {
 			case 1:
 				echo 'Thứ Hai';
 				break;
 			case 2:
 				echo 'Thứ Ba';
 				break;
 			case 3:
 				echo 'Thứ Tư';
 				break;
 			case 4:
 				echo 'Thứ Năm';
 				break;
 			case 5:
 				echo 'Thứ Sáu';
 				break;
 			case 6:
 				echo "Thứ Bảy";
 				break;
 			case 0:
 				echo 'Chủ Nhật';
 				break;
 		}
 	}
 	function get_times_defaulf($time) 
	 {

	    $output = '';
	    $output.='<option value="">Chọn</option>';
	    for($hours=12; $hours<=13; $hours++)// the interval for hours is '1'
	    {
	    	for($mins=0; $mins<=30; $mins+=15) // the interval for mins is '30'
	        {	
	        	$time_cur = ''.str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'';
	        	$so_sanh = $time_cur == $time;
	        	if($so_sanh)
	        	{
	        		$output.= '<option selected="selected" value='.str_pad($hours,2,'0',STR_PAD_LEFT).':'
	                       .str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
	                       .str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'</option>';
	        	}
	        	else
	        	{
	        		$output.= '<option value='.str_pad($hours,2,'0',STR_PAD_LEFT).':'
	                       .str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
	                       .str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'</option>';
	        	}
	        	
	        }
	        
	    }
	    return $output;
	}
 	function get_times($time) 
 	{

    $output = '';
    $output.='<option value="">Chọn</option>';
    for($hours=8; $hours<=11; $hours++)// the interval for hours is '1'
    {
    	for($mins=0; $mins<60; $mins+=15) // the interval for mins is '30'
        {	
        	$time_cur = ''.str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'';
        	$so_sanh = $time_cur == $time;
        	if($so_sanh)
        	{
        		$output.= '<option selected="selected" value='.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                       .str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                       .str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'</option>';
        	}
        	else
        	{
        		$output.= '<option value='.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                       .str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                       .str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'</option>';
        	}
        	
        }
        
    }
    if('12:00:00'==$time){
    	$output.='<option selected="selected" value="12:00:00">12:00:00</option>';
    }
    else {
    	$output.='<option value="12:00:00">12:00:00</option>';
    }if('13:30:00'==$time){
    	$output.='<option selected="selected" value="13:30:00">13:30:00</option>';
    }
    else {
    	$output.='<option value="13:30:00">13:30:00</option>';
    }
    for($hours=14; $hours<=19; $hours++)// the interval for hours is '1'
    {
    	for($mins=0; $mins<60; $mins+=15) // the interval for mins is '30'
        {	
        	$time_cur = ''.str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'';
        	$so_sanh = $time_cur == $time;
        	if($so_sanh)
        	{
        		$output.= '<option selected="selected" value='.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                       .str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                       .str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'</option>';
        	}
        	else
        	{
        		$output.= '<option value='.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                       .str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                       .str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'</option>';
        	}
        	
        }
        
    }
    if('20:00:00'==$time){
    	$output.='<option selected="selected" value="20:00:00">20:00:00</option>';
    }
    else {
    	$output.='<option value="20:00:00">20:00:00</option>';
    }

    return $output;
	}
	function select_branch($number)
	{
		$output="";
		for ($i=1; $i<=2 ; $i++) { 
			if($i==$number)
			{
				$output.='<option selected="selected" value="'.$i.'">Cơ Sở '.$i.'</option>';
			}
			else 
			{
				$output.='<option value="'.$i.'">Cơ Sở '.$i.'</option>';
			}
		}
		return $output;
	}
?>
<style type="text/css">
	.btn_remove_listwork{
		width: 26px;
		height: 26px;
		border-radius: 5px;
		padding: 1px;
		text-align: center;
		background: #f1b51b;
		color: #fff;
		font-size: 15px;
		font-weight: bold;
		cursor: pointer;
	}
	.btn_add_listwork{
		width: 26px;
		height: 26px;
		border-radius: 5px;
		padding: 0px;
		text-align: center;
		background: #6ec4a1;
		color: #fff;
		font-size: 20px;
		font-weight: bold;
		cursor: pointer;
	}
	.btn_add_break{
		border: 1px solid #ccc;
	    border-radius: 10px;
	    width: 87px;
	    height: 26px;
	    padding: 5px 17px;
	    background-color: #6ec4a1;
	    color: #fff;
	    cursor: pointer;
	    font-size: 11px;
	}
	ul.new-timeoff-list {
    list-style: outside none none;
    margin: 0;
	}
	li.new-timeoff-list-li:hover{
		box-shadow: 2px 2px 2px 2px #ccc;
	}
	li.new-timeoff-list-li {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: #e5e5e5 #fff;
    border-image: none;
    border-style: solid;
    border-width: 1px;
    box-sizing: border-box;
    cursor: pointer;
    font-size: 13px;
    margin-top: -1px;
    padding: 10px 7px;
    transition: 0.2s linear;
	}
	.timeoff-icon-holder {
    border: 1px solid #ccc;
    border-radius: 100%;
    font-size: 16px;
    height: 50px;
    line-height: 50px;
    text-align: center;
    width: 50px;
	}
	.timeoff-list-details-noteslabel{
		color: #ccc;
		font-style: 15px;
	}
	.no-timeoff-container {
    border: 1px solid #ccc;
    box-sizing: border-box;
    margin-top: 25px;
    padding: 10px 0;
    text-align: center;
	}
	.new-no-timeoff-header {
    color: #455862;
    font-size: 16px !important;
    font-weight: 400;
    text-align: center;
	}
	.new-gray-btn {
    background: #F1F5F7;
    border-color: #F1F5F7;
    font-size: 13px !important;
    line-height: 32px !important;
    margin-top: 5px;
    padding: 0 15px !important;
    color: #252C32;
    border-style: solid;
    border-width: 1px;
    height: 34px;
    border-radius: 3px !important;
    cursor: pointer;
    border: solid 1px #D7D7D7;
	}
	.slider_holder {
    font-family: helveticaneuelight;
	}
</style>
<div id="content_tab_agenda" style="width: 100%;overflow: auto;padding-left: 15px" class="row">
	<div class="col-md-12" style="margin-top: 20px">
		<p style="font-size: 25px;font-weight: bold;color: #6ec4a1;">Thời gian làm việc</p>
		<ul id="stacked-list" class="stacked-list staff-hour-list">

	<?php
		if(isset($working_list) && $working_list)
		{
			$i=1; 
			foreach($working_list as $data)
			{
	?>
			<li class="row" id="row_<?php echo $i;?>">
				<label class="col-md-2">
				<?php if($data['status'] != 1){?>
					<span style="background-color: #fff;color: #ccc"><?php $thu = In_thu($i); ?></span>
				<?php } else {?>
					<span><?php $thu = In_thu($i); ?></span>
				<?php }?>
				</label>
				<input name="id_dentist" id="<?php echo $data['id_dentist']; ?>" type="hidden" value="<?php echo $data['id_dentist']; ?>"></input>

				<span class="col-md-2" style="width: 12%;">
					<div onclick="change_status(<?php echo $i;?>,<?php echo $data['id_dentist']; ?>,<?php echo $data['dow'] ?>)" id="slider_holder_<?php echo $i;?>" class="slider_holder staffhours sliderdone">
						<?php if($data['status'] != 1){?>
							<input type="hidden" value="1">
							<span style="left: 1px;" class="slider_off sliders"> TẮT </span>
							<span style="left: -57px;" class="slider_on sliders"> BẬT </span>
							<span style="left: 1px;" class="slider_switch"></span>
						<?php } else {?>
							<input type="hidden" value="0">
							<span class="slider_off sliders"> TẮT </span>
							<span class="slider_on sliders"> BẬT </span>
							<span class="slider_switch"></span>
						<?php }?>

					</div>
				</span>
				<?php 

					$list_time = CsScheduleChair::model()->findAllByAttributes(array('id_dentist'=>$data['id_dentist'],'dow'=>$data['dow']));
					$count_list_time = count($list_time);
					foreach ($list_time as $item) {
						if(strtotime($item['end']) == strtotime('20:00:00'))
						{
							$status_time_end = 1;
						}
						else{
							$status_time_end = 0;
						}
					}
				?>
				<ul id="list_work_<?php echo $i;?>" class="col-md-8">
					<input id="count_list_time_<?php echo $i;?>" type="hidden" value="<?php echo $count_list_time; ?>"></input>
					<?php
					 if(isset($list_time) && $list_time)
					 {
						$j=1;
						foreach($list_time as $item)
						{ 
					?>

					<li id="row_<?php echo $i; ?>_<?php echo $item['id']; ?>">
						<div class="col-md-2" style="padding-right: 0px">
							<select onchange="change_time_start(<?php echo $j ?>,<?php echo $i; ?>,<?php echo $item['id'] ?>,<?php echo $item['id_dentist'] ?>)" name="time_start_<?php echo $j; ?>" id="time_start_<?php echo $item['id'] ?>" style="height: 26px;width: 100%;border-radius: 4px;" name=time_start>
								<?php echo get_times($item['start']); ?>
							</select>
						</div>
						<div class="col-md-1">đến</div>
						<div class="col-md-2" style="padding-left: 0px">
							<select onchange="change_time_end(<?php echo $j ?>,<?php echo $i; ?>,<?php echo $item['id'] ?>,<?php echo $item['id_dentist'] ?>)" name="time_end_<?php echo $j; ?>" id="time_end_<?php echo $item['id'] ?>" style="height: 26px;width: 100%;border-radius: 4px;">
								<?php echo get_times($item['end']); ?>
							</select>
						</div>
						<div  class="col-md-4 col-md-offset-1">
							<select onchange="change_branch(<?php echo $item['id'] ?>)" id="address_<?php echo $item['id'] ?>"  style="height: 26px;width: 85%;border-radius: 4px;">
								<?php
								$branch_user = Branch::model()->findAll();
								 foreach ($branch_user as $value) {
									if($item['id_branch'] == $value['id']){
								?>
									<option selected="selected" value="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></option>
								<?php }else { ?>
									<option value="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></option>
								<?php } } ?>		
							</select>
						</div>
						
						<div id="remove_<?php echo $item['id'] ?>" class="col-md-2" style="padding-left: 6%;">
							<span id="ground_btn">
							<?php 
								if($j==1)
								{
									if($status_time_end==1)
									{
							?>
								<div style="background-color: #ccc;" id="btn_add_job<?php echo $item['dow'] ?>" onclick="" class="btn_add_listwork">+</div>
								<?php 
									}
								 	else 
								 	{
								 ?>
									<div id="btn_add_job<?php echo $item['dow'] ?>" onclick="add_new_time(<?php echo $i; ?>,<?php echo $item['id_dentist'] ?>,<?php echo $count_list_time ?>)" class="btn_add_listwork">+</div>
								<?php
									} 
								}
								else
								{
							?>
								<div id="btn_remove_job<?php echo $item['id'] ?>" onclick="remove_time(<?php echo $i; ?>,<?php echo $item['id'] ?>,<?php echo $item['id_dentist'] ?>,<?php echo $j ?>)" class="btn_remove_listwork">
									<i class='fa fa-trash-o'></i>
								</div>
							<?php } ?>
							</span>
						</div>
					</li>
					<?php
						$j++; 
						} 
					}
				?>	
				</ul>
			</li>
			<?php
			 	$i++;
			}
			?>
		</ul>
	<?php
		}
	?>
	</div>
	<div class="col-md-12">
		<p style="font-size: 25px;font-weight: bold;margin-top:15px;color: #6ec4a1;">Thời Gian Nghỉ</p>
		<ul class="stacked-list staff-hour-list">
		<?php for($i=1;$i<=6;$i++){ ?>
			<li class="row" id="row_break_<?php echo $i;?>">
				
				<?php $test_status = CsScheduleRelax::model()->findAllByAttributes(array('dow'=>$i,'id_dentist'=>$id_dentist));
					if($test_status[0]['status'] == 1){
				?>
				<label class="col-md-2">
					<span><?php $thu = In_thu($i); ?></span>
				</label>
				<span class="col-md-2" style="width: 12%;">
				<div onclick="add_break(<?php echo $i;?>,<?php echo $id_dentist;?>)" id="btn_add_break_<?php echo $i;?>" class="slider_holder staffhours sliderdone">
					<input type="hidden" value="0">
					<span class="slider_off sliders"> TẮT </span>
					<span class="slider_on sliders"> BẬT </span>
					<span class="slider_switch"></span>
				</div>
				</span>
				<!-- <div id="btn_add_break_<?php echo $i; ?>" onclick="add_break(<?php echo $i; ?>,<?php echo $id_dentist; ?>)" class="col-md-1 btn_add_break">Add Break</div> -->
				<?php } else { ?>
					<label class="col-md-2">
						<span style="background-color: #fff;color: #ccc"><?php $thu = In_thu($i); ?></span>
					</label>
					<span class="col-md-2" style="width: 12%;">
					<div onclick="add_break(<?php echo $i;?>,<?php echo $id_dentist;?>)" id="btn_add_break_<?php echo $i;?>" class="slider_holder staffhours sliderdone">
						<input type="hidden" value="1">
						<span style="left: 1px;" class="slider_off sliders"> TẮT </span>
						<span style="left: -57px;" class="slider_on sliders"> BẬT </span>
						<span style="left: 1px;" class="slider_switch"></span>
					</div>
					</span>
					<!-- <div style="background-color: #ccc" id="btn_add_break_<?php echo $i; ?>" class="col-md-1 btn_add_break">Add Break</div> -->
				<?php } ?>
				<ul style="display: <?php if($test_status[0]['status'] == 1) echo "block"; else echo "none";?>" id="time_relax_<?php echo $i; ?>" class="col-md-8" style="padding-left:35px;height: auto;">
				<?php 
					$relax_list = CsScheduleRelax::model()->findAllByAttributes(array('id_dentist'=>$id_dentist,'dow'=>$i));
					if( isset($relax_list) && $relax_list[0]['start']!="")
					{
						foreach($relax_list as $data)
						{
				?>
					<li id="row_relax_<?php echo $data['id']; ?>">
						<div class="col-md-2" style="padding-right: 0px">
							<select style="height: 26px;width: 100%;border-radius: 4px;">
								<?php echo get_times_defaulf($data['start']); ?>
							</select>
						</div>
						<div class="col-md-1">đến</div>
						<div class="col-md-2" style="padding-left: 0px">
							<select style="height: 26px;width: 100%;border-radius: 4px;">
								<?php echo get_times_defaulf($data['end']); ?>
							</select>
						</div>
					</li>
					<?php 
						}
					}
					?>
				</ul>
			</li>
		<?php } ?>
		</ul>
	</div>
	<div class="col-md-12" style="margin-bottom: 30px;margin-top: 30px">
		<p style="font-size: 25px;font-weight: bold;color: #6ec4a1;">Lịch nghỉ phép</p>
		<div class="row-fluid" style="border-bottom: 1px solid #ccc; padding-bottom: 10px">
				<a class="btn_plus" data-toggle="modal" data-target="#myModal" data-delay="0" data-placement="right"></a>
				<!-- <button style="background-color:#6ec4a1 " class="pull-right btn btn-circle"   id="addNewTimeOffButton">
				<i class="glyphicon glyphicon-plus" style="color: #fff"></i>
				</button> -->
				<div class="clear-fix" style="clear: both;"></div>
		</div>
		<?php if(isset($time_off_list) && $time_off_list){ 
			
		?>
			<div class="row-fluid">
			<ul id="list_time_off" class="new-timeoff-list">
			<?php 
				foreach ($time_off_list as $data) {
			?>
				<li id="time_off_<?php echo $data['id'] ?>" class="new-timeoff-list-li" onclick="show_update(<?php echo $data['id'] ?>)">
					<div class="row-fluid">
						<input id="<?php echo $data['id'] ?>" type="hidden" value="<?php echo $data['id'] ?>"></input>
						<div class="col-md-1">
							<div class="timeoff-icon-holder">
								<i class="glyphicon glyphicon-calendar"></i>
							</div>
						</div>
						<div class="col-md-11">
							<div class="new-timeoff-details-holder">
								<span style="color: #455862;font-size: 15px;">
								<input id="start_off_<?php echo $data['id'] ?>" type="hidden" value="<?php echo $data['start']; ?>"></input>
								<?php echo $data['start']; ?>
								</span>
								<span style="padding: 5px"> to</span>
								<span style="color: #455862;font-size: 15px;">
									<input id="end_off_<?php echo $data['id'] ?>" type="hidden" value="<?php echo $data['end']; ?>"></input>
									<?php echo $data['end']; ?>
								</span>
								<div class="timeoff-list-details-noteslabel">
									<input id="note_off_<?php echo $data['id'] ?>" type="hidden" value="<?php echo $data['note']; ?>"></input>
									<?php echo $data['note']; ?>
								</div>
							</div>
						</div>
						<div class="clear-fix" style="clear: both;"></div>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
		<?php  
		} else { ?>
			<div id="add_time_off" class="row-fluid no-timeoff-container">
				<h5 class="new-no-timeoff-header">Thêm thời gian nghỉ phép bằng cách nhấn vào nút bên dưới.</h5>
				<button class="new-gray-btn" data-toggle="modal" data-target="#myModal" id="addNewTimeOffButton">
				<i class="glyphicon glyphicon-plus"></i> Thêm thời gian nghỉ phép
				</button>
			</div>
			<div class="row-fluid">
			<ul id="list_time_off" class="new-timeoff-list">
			</ul>
			</div>
		<?php	} ?>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#stacked-list li').each(function(index){
		$("#slider_holder_"+index).click(function(){
			var id_dentist = $('input[name=id_dentist]').val();
			var value = $("#slider_holder_"+index+" input").val();
			if(value =="0")
			{
				$('#row_'+index+' label:first-child span').css({'background-color':'#fff','color':'#ccc'});
				$('#row_'+index+' .btn-group a').css({'background-color':'#F5F5F5','color':'#ccc'});

				$('#row_break_'+index+' label:first-child span').css({'background-color':'#fff','color':'#ccc'});
				$('#row_break_'+index+' .btn-group a').css({'background-color':'#F5F5F5','color':'#ccc'});

				$('#slider_holder_'+index+' .slider_off').css({'left':'1px'});
				$('#slider_holder_'+index+' .slider_on').css({'left':'-57px'});
				$('#slider_holder_'+index+' .slider_switch').css({'left':'1px'});
				// $('#btn_add_break_'+index).css({'background-color' : '#ccc'});
				// $('#btn_add_break_'+index).removeAttr('onclick');
				$('#btn_add_break_'+index+' .slider_off').css({'left':'1px'});
				$('#btn_add_break_'+index+' .slider_on').css({'left':'-57px'});
				$('#btn_add_break_'+index+' .slider_switch').css({'left':'1px'});
				$('#time_relax_'+index).css({'display':'none'});
				$('#slider_holder_'+index+' input').val("1");
			}
			if (value=="1"){
				$('#row_'+index+' label:first-child span').css({'background-color':'#dff6f5'});
				$('#row_'+index+' .btn-group a').css({'background-color':'#fff','color':'#455862'});

				$('#row_break_'+index+' label:first-child span').css({'background-color':'#dff6f5'});
				$('#row_break_'+index+' .btn-group a').css({'background-color':'#fff','color':'#455862'});

				$('#slider_holder_'+index+' .slider_off').css({'left':'1px'});
				$('#slider_holder_'+index+' .slider_on').css({'left':'2px'});
				$('#slider_holder_'+index+' .slider_switch').css({'left':'38px'});
				// $('#btn_add_break_'+index).css({'background-color' : '#6ec4a1'});
				// $('#btn_add_break_'+index).attr('onclick','add_break('+index+','+id_dentist+')');
				$('#btn_add_break_'+index+' .slider_off').css({'left':'1px'});
				$('#btn_add_break_'+index+' .slider_on').css({'left':'2px'});
				$('#btn_add_break_'+index+' .slider_switch').css({'left':'38px'});
				$('#time_relax_'+index).css({'display':'block'});
				$('#slider_holder_'+index+' input').val("0");
			}	
		});
	});

	$('#stacked-list li').each(function(index){
		$("#btn_add_break_"+index).click(function(){
			var value = $("#btn_add_break_"+index+" input").val();
			if(value =="0") // Bật
			{
				$('#row_break_'+index+' label:first-child span').css({'background-color':'#fff','color':'#ccc'});
				$('#row_break_'+index+' .btn-group a').css({'background-color':'#F5F5F5','color':'#ccc'});
				$('#btn_add_break_'+index+' .slider_off').css({'left':'1px'});
				$('#btn_add_break_'+index+' .slider_on').css({'left':'-57px'});
				$('#btn_add_break_'+index+' .slider_switch').css({'left':'1px'});
				
				$('#time_relax_'+index).css({'display':'none'});
				$('#btn_add_break_'+index+' input').val("1"); 
				
			}
			if (value=="1"){// tắt
				$('#row_break_'+index+' label:first-child span').css({'background-color':'#dff6f5'});
				$('#row_break_'+index+' .btn-group a').css({'background-color':'#fff','color':'#455862'});
				$('#btn_add_break_'+index+' .slider_off').css({'left':'1px'});
				$('#btn_add_break_'+index+' .slider_on').css({'left':'2px'});
				$('#btn_add_break_'+index+' .slider_switch').css({'left':'38px'});
				$('#time_relax_'+index).css({'display':'block'});
				$('#btn_add_break_'+index+' input').val("0");
			}
		});
	});
});
	function show_update(id)
	{
		var id_time_off = id;
		var start_date = $('#start_off_'+id).val();
		var end_date = $('#end_off_'+id).val();
		var note_off = $('#note_off_'+id).val();

		$(".modal-body #time_off_Id").val(id_time_off);
		$('.modal-body #datetimepicker6').val(start_date);
		$('.modal-body #datetimepicker7').val(end_date);
		$('.modal-body #note_time_off').val(note_off);
		// alert(start_date);
		$('#myModal_update_time_off').modal();
	}
</script>
	