<?php $baseUrl = Yii::app()->baseUrl;?>

<input type="hidden" id="baseUrl" value="<?php echo Yii::app()->baseUrl?>"/>
<input type="hidden" id="id_customer" value="<?php echo $model->id;?>"/>

<div style="position: relative;width: 120px; height: 120px;">
	<img id="stafflistimage" src="<?php echo $baseUrl; ?>/upload/customer/avatar/<?php if($model['image']!="") echo $model['image']; else echo "no_avatar.png";?>" class="fl" style="border-radius:100%;width:120px;height:120px;">
	<label style="margin:0px;">
		<i class="camera fa fa-camera icon-2x" data-toggle="modal" data-target="#webcamModal" onclick="configure_camera();"></i>
	</label>
</div>        

<input onchange="updateCustomerImage(<?php echo $model->id;?>);" id="customerimageinput" class="hide" type="file" name="image123">

<div id="uploadcustomer" style="display:none;"></div>

<div class="modal fade" id="webcamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

      	<div class="modal-header popHead">
           	<a class="btn_close" data-dismiss="modal" aria-label="Close"></a>
            <h5>Máy quay</h5>
        </div> 
       
        <div class="modal-body">
  
           <div id="my_camera"></div>
          
       
        </div>

        <div class="modal-footer">                   
          	<button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
          	<label for="customerimageinput" style="margin:0px;">
				<span class="btn btn_bookoke">Chọn ảnh</span>
			</label> 
          	<button type="button" class="btn btn_bookoke" onClick="take_snapshot()">Chụp ảnh</button>      
            <button type="button" class="btn btn_bookoke" onClick="updateCustomerImageDefault(<?php echo $model->id;?>);">Ảnh mặc định</button>          	
        </div>

      </div>
    </div>
</div>

<script language="JavaScript">
/*** Webcam ***/
var baseUrl = $('#baseUrl').val();
function configure_camera() {
	Webcam.set({
		width: 569,
		height: 462,
		dest_width: 640,
		dest_height: 480,
		image_format: 'jpeg',
		jpeg_quality: 90
	});
	Webcam.attach( '#my_camera' );
}

function take_snapshot() {
	$('#webcamModal').modal('hide');
	Webcam.snap( function(data_uri) {
        // snap complete, image data is in 'data_uri'
        var id = $('#id_customer').val();    	
    	var url = "<?php echo CController::createUrl('Accounts/updateWebcamImage')?>?id="+id
        Webcam.upload( data_uri, url, function(code, text) {
        	searchCustomers(id);            
            Webcam.reset();
        });

    } );
}

$('#webcamModal').on('hidden.bs.modal', function (e) {
  Webcam.reset();
})
/*** End Webcam ***/    
</script>