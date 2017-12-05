<?php $baseUrl = Yii::app()->baseUrl;?>

<div style="position: relative;width: 120px; height: 120px;">
	<img id="stafflistimage" src="<?php echo $baseUrl; ?>/upload/customer/<?php if($model['image']!="") echo $model['image']; else echo "no_avatar.png";?>" class="fl" style="border-radius:100%;">
	<i class="camera fa fa-camera icon-2x"></i>
</div>        

<input onchange="updateCustomerImage(<?php echo $model->id;?>);" id="customerimageinput" class="hide" type="file" name="image123">
<div id="uploadcustomer" style="display:none;"></div>