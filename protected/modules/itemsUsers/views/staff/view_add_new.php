<?php
function get_times_defaulf() 
{

    $output = '';

    for($hours=8; $hours<21; $hours++) // the interval for hours is '1'
    for($mins=0; $mins<60; $mins+=15) // the interval for mins is '30'
        $output.= '<option value='.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                       .str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                       .str_pad($mins,2,'0',STR_PAD_LEFT).':00'.'</option>';

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
<?php
	if(isset($record) && $record)
	{
?>
<li id="row_<?php echo $record['dow']; ?>_<?php echo $record['id'] ?>">
	<div class="col-md-5 col-lg-6">
		<span>
			<select onchange="change_time_start(<?php echo $count_record; ?>,<?php echo $record['dow'] ?>,<?php echo $record['id'] ?>,<?php echo $record['id_dentist'] ?>)" id="time_start_<?php echo $record['id'] ?>" style="height: 26px;width: 35%;border-radius: 4px;" name="time_start_<?php echo $count_record; ?>">
				<!-- <option selected="selected" value="<?php //echo $record['start']?>"><?php //echo $record['start']?></option> -->
				<?php echo get_times($record['start']); ?>
			</select>
		</span>
		<span class="staff-hours-to">đến</span>
		<span>
			<select onchange="change_time_end(<?php echo $count_record; ?>,<?php echo $record['dow'] ?>,<?php echo $record['id'] ?>,<?php echo $record['id_dentist'] ?>)" name="time_end_<?php echo $count_record; ?>" id="time_end_<?php echo $record['id'] ?>" style="height: 26px;width: 35%;border-radius: 4px;" name=time_end>
			<!-- <option selected="selected" value="<?php //echo $record['end']?>"><?php //echo $record['end']?></option> -->
				<?php echo get_times($record['end']); ?>
			</select>
		</span>
	</div>
	<div  class="col-md-3">
		<select onchange="change_branch(<?php echo $record['id'] ?>)" id="address_<?php echo $record['id'] ?>"  style="height: 26px;width: 85%;border-radius: 4px;">
			<?php
            $branch_user = Branch::model()->findAll();
             foreach ($branch_user as $value) {
                if($record['id_branch'] == $value['id']){
            ?>
                <option selected="selected" value="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></option>
            <?php }else { ?>
                <option value="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></option>
            <?php } } ?>
		</select>
	</div>
	<div id="remove_<?php echo $record['id'] ?>" class="col-md-2" style="padding-left: 6%;">
		<span id="ground_btn">
			<div id="btn_remove_job<?php echo $record['id'] ?>" onclick="remove_time(<?php echo $record['dow'] ?>,<?php echo $record['id'] ?>,<?php echo $record['id_dentist'] ?>,<?php echo $count_record; ?>)" class="btn_remove_listwork">
				<i class="fa fa-trash-o"></i>
			</div>
		</span>
	</div>
</li>
<?php }
	else
	{
?>
<div>Không có dữ liệu</div><?php } ?>