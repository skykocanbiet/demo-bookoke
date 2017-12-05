<div id="appointmentOverAllDetails" class="appointmentDetails pull-right">		
		<span class="fl" style="margin-right: 10px;">
			<span id="numSch"> <?php echo $listSch['numRow']; ?> </span>  lịch hẹn 
		</span> 
		<span class="fl" style=" margin-top: -11px;" data-original-title="" title="">
			<a class="btn_plus" id="createAppt"></a>
		</span> 
	</div>

	<div class="clearfix"></div>

<div class="appointmentListHolder">
	<ul id="appointmentList" class="appointmentList">
		<?php 
			$sch = new CsSchedule();
			$nodata = 0;
			if($listSch['numRow'] > 0)
			{
				foreach($listSch['data'] as $l_s)
				{	
					$status = array();
					switch ($l_s['status']) {
					    case 1:
					    	$status = $sch->st1;
					        break;
					    case 2:
					    	$status = $sch->st2;
					        break;
					    case 3:
					    	$status = $sch->st3;
					        break;
					    case -2:
					    	$status = $sch->st0;
					    break;
					    case 5:
					    	$status = $sch->st5;
					    break;
					    default:
					    	$st = $l_s['status'];
					    	if(isset($sch->status_arr[$st]))
					    		$status = array($st=>$sch->status_arr[$st]);
					    break;
					}
					$color 				= $sch->getColorSch($l_s['status']);

			?>

				<li id="s<?php echo $l_s['id'];?>" class="hasHoverStyles" style="margin-bottom:15px;border-left: 2px solid <?php echo $color;?>;">
					<span class="fl appointment_status_icon" style="margin: 10px 1px 0 7px;"><i class="fa fa-calendar"></i>  </span>
					<div class="fl" style="width:77%;">
						<h2 style="font-weight: normal;font-size: 16px;margin-bottom: 10px;"><?php echo date('d/m/Y H:i:s',strtotime($l_s['start_time']));?> - <?php echo date('H:i:s',strtotime($l_s['end_time']));?></h2>
						<label style="font-weight: normal;line-height: 7px;">
							<div style="width: 100%;padding: 0px;margin-top: 2px;font-size: 13px;">
								<span class="fl" style="margin-bottom: 4px; display: inline-block;width: 85px;">Dịch vụ</span>
								<span style="display: inline-block;">: <?php echo $l_s['name_service'];?></span>
							</div>
							<br>
							<div style="width: 100%;padding: 0px;margin-top: 3px;font-size: 13px;">
								<span style="display: inline-block;width: 81px;">Bác sỹ</span>
								<span>: <?php echo $l_s['name_dentist']; ?></span>
							</div>
							
						</label>
					</div>

	                <?php
					echo CHtml::dropDownList('status_schedule'.$l_s['id'],'',$status,array('onchange'=>'updateStatusSchedule('.$l_s['id'].','.$l_s['id_customer'].','.$l_s['id_dentist'].');','class'=>'form-control custProfileInput yellow_hover blue_focus fl','style'=>'width:121px;','options'=>array($l_s['status']=>array('selected'=>true))));
					?>
					<div class="clearfix"></div>
				</li>

				<?php }	 ?>
				<div style="clear:both"></div>
					<div id="" class="row fix_bottom">
					    <?php if($page) echo $page;?> 
					</div>
			<?php }
			else { 
				$nodata = 1;
			}				
			?>
		</ul>

		<?php if($nodata){ ?>
			<div class="no-data" style="display: table-cell; vertical-align: middle;text-align: center;">
				<div style="text-align: center;">
					<img src="<?php yii::app()->request->baseUrl; ?>/images/no-data.png" style="width:200px; height: auto;"><br>
					<p style="color: #464646; font-size: 15px;">Không có dữ liệu !</p>
				</div>
			</div>
		<?php } ?>

	</div> 

<script>
		/*calendarModal*/
$('#createAppt').click(function (e) {
	e.preventDefault();

	id_quote = $('#id_quotation').val();

    $('#CalendarModal').modal('show');
    getServiceForCus(id_quote);
});
</script>