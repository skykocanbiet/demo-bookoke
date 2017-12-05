<div class="form-group"><label class="control-label" for="Customer_id_city">City</label>
	<div>
	<?php
	$city_list=CHtml::listData(CsCity::model()->findAll("id_country='$id_country'"),'id','name_long');
	echo CHtml::dropDownList('Customer[id_city]',$selected_value='1',$city_list,array('class'=>'form-control'));
	?>
	</div>
</div>
