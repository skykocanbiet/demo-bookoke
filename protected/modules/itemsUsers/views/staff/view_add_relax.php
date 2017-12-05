<?php
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

?>
<?php if(isset($relax_record) && $relax_record)
	{
 ?>
<li id="row_relax_<?php echo $relax_record[0]['id']; ?>">
	<div class="col-md-2" style="padding-right: 0px">
		<select style="height: 26px;width: 100%;border-radius: 4px;">
			<?php echo get_times_defaulf($relax_record[0]['start']); ?>
		</select>
	</div>
	<div class="col-md-1">to</div>
	<div class="col-md-2" style="padding-left: 0px">
		<select style="height: 26px;width: 100%;border-radius: 4px;">
			<?php echo get_times_defaulf($relax_record[0]['end']); ?>
		</select>
	</div>
	<div id="btn_remove_relax_<?php echo $relax_record[0]['id']; ?>" class="col-md-1 btn_remove_listwork" onclick="remove_relax(<?php echo $relax_record[0]['id']; ?>)" style="color: #ccc;background-color: #ffffff">
		<i class='fa fa-trash-o'></i>
	</div>
</li>
<?php 
	}
?>