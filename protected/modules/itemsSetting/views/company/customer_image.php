<?php $baseUrl = Yii::app()->baseUrl;?>

<div style="position: relative;width: 120px; height: 120px;">
	<img id="stafflistimage" src="<?php echo $baseUrl; ?>/upload/<?php if($model['images']!="") echo $model['images']; ?>" class="fl" style="border-radius:100%;">
	<label for="customerimageinput">
	<i class="camera ui-icon-camera fa fa-camera icon-2x"></i>
	</label>
</div>        

<input onchange="updateCustomerImage(<?php echo $model->Id;?>);" id="customerimageinput" class="hide" type="file" name="image123">
<div id="uploadcustomer" style="display:none;"></div>