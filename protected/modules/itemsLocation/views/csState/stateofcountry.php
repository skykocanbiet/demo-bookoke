<div class="form-group"><label class="control-label" for="Customer_id_state">State</label>
	<div>
	<?php
	$state_list=CHtml::listData(CsState::model()->findAll("id_country='$id_country'"),'id','name_long');
	echo CHtml::dropDownList('Customer[id_state]',$selected_value='1',$state_list,array('class'=>'form-control'));
	?>
	</div>
</div>
