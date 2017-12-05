<script type="text/javascript">
	jQuery(function($) {
		// Asynchronously Load the map API 
		var script = document.createElement('script');
		script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCFAVSpXPepjSP87AkCiaXnyYj-VYm6yZc";

		document.body.appendChild(script);
	});

	jQuery.fn.exists = function(){return this.length>0;}

	function initialize() {
	if ($("#map_canvas").exists()) {

		var map;
		var bounds = new google.maps.LatLngBounds();
		var mapOptions = {
		    mapTypeId: 'roadmap'
		};
		                
		// Display a map on the page
		map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		map.setTilt(45);
		    
		// Multiple Markers
		var markers = [
		    ['Nha Khoa 2000',10.762774,106.691045],
		    ['Nha Khoa 2000',10.759070,106.668309]
		];
		                    
		// Info Window Content
		var infoWindowContent = [
		    ['<div class="info_content">' +
		    '<h4>Nha Khoa 2000 CS1</h4>' +
		    '<p></p>' +        '</div>'],
		    ['<div class="info_content">' +
		    '<h4>Nha Khoa 2000 CS2</h4>' +
		    '<p></p>' +
		    '</div>']
		];
		    
		// Display multiple markers on a map
		var infoWindow = new google.maps.InfoWindow(), marker, i;

		// Loop through our array of markers & place each one on the map  
		for( i = 0; i < markers.length; i++ ) {
		    var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
		    bounds.extend(position);
		    marker = new google.maps.Marker({
		        position: position,
		        map: map,
		        title: markers[i][0],
		        label: markers[i][0],
		    });

		    marker.setMap(map);
		    
		    // Allow each marker to have an info window    
		    google.maps.event.addListener(marker, 'click', (function(marker, i) {
		        return function() {
		            infoWindow.setContent(infoWindowContent[i][0]);
		            infoWindow.open(map, marker);
		        }
		    })(marker, i));

		    // Automatically center the map fitting all markers on the screen
		    map.fitBounds(bounds);
		}

		// Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
		var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
		    this.setZoom(15);
		    google.maps.event.removeListener(boundsListener);
		});

		}	
	}
</script>

<style>
#ctact {padding-bottom: 40px;}
	#ctact h3 {text-align: left; font-weight: bold; border-bottom: 1px solid #ddd; padding-bottom: 10px;padding-top: 10px; font-size: 20px;}
	#banner {position: relative;}
	.quote {font-size: 36px;}
	.icon {width: 18px; height: auto;}
	#ctact_lh span{padding-left: 15px;color: black;}
	#ctact_lh div {padding-bottom: 5px;}
	#ctact_lh p {font-size: 18px; font-weight: bold; padding-top: 15px;}
	#ctact .form-control {border-radius: 4px;}
</style>
<div id="ctact">
	<div id="banner">
		<div id="map_canvas" class="mapping" style="height:400px"></div>
		<div id="scroll"></div>
	</div>
	
	<div  class="container">
			<div class="row">
			<h2 class="col-md-12 text_green" style="font-weight: bolder;margin-top: 50px;">NHA KHOA 2000</h2>

			<div class="col-md-6" style="padding-right: 50px;">
				<div class="">
					<h3>LIÊN HỆ</h3>
					<div id="ctact_lh">
						<?php 
						$branch = Branch::model()->findAllByAttributes(array('status'=>1)); 
						if(count($branch) > 0){
							foreach ($branch as $key => $value) {
						?>
						<div>
							<p><?php echo $value['name']; ?></p>
							<div>
								<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/location.png" alt="" class="icon"><span><?php echo $value['address']; ?></span>
							</div>
							<div><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/call.png" alt="" class="icon"><span><?php echo $value['hotline1']; ?> - <?php echo $value['hotline2']; ?></span></div>
							<div>
								<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mail.png" alt="" class="icon"><span><?php echo $value['email']; ?></span>
							</div>
						</div>
						<?php } } ?>
					</div>
					<h3 style="border-bottom: 0;">VỀ CHÚNG TÔI</h3>
					<div>
						<p style="color: black;"><span class="quote">&ldquo;</span> Sở hữu một nụ cười tươi tắn, một hàm răng khỏe mạnh là niềm vui, hạnh phúc của tất cả mọi người. Và đó cũng là phương châm hoạt động của chúng tôi, Nha khoa 2000 mong ước mang đến cho các bạn chìa khóa thành công, sức mạnh của hình thể và sự tự tin trong cuộc sống.<br>Với khẩu hiệu: <strong>“You smile, We smile”</strong>, Nha khoa 2000 mong muốn đem đến điều tốt đẹp hơn cho mỗi khách hàng, chỉ khi nhìn thấy bạn tự tin hạnh phúc với nụ cười trọn vẹn, thì điều đó mới thực sự việc làm ý nghĩa mang lại giá trị chân thành nhất mà chúng ta mong muốn có được. <span class="quote">&rdquo;</span></p>
					</div>
				</div>
			</div>
			<div class="col-md-6" style="padding-left: 40px;">
				<h3>THƯ PHẢN HỒI</h3>
				<form action="" method="post" id="form_contact" name="form_contact" accept-charset="utf-8" class="form">
						<div class="form-group col-xs-8">
							<div class="row">
								<label>Tên*</label>
								<input type="text" id="name" name="" value="" placeholder="" class="form-control">
								<p class="name-error error"></p>
							</div>
						</div>
						<div class="form-group col-xs-8">
							<div class="row">
								<label>Email*</label>
								<input type="text" id="email" name="" value="" placeholder="" class="form-control">
								<p class="email-error error"></p>
							</div>
						</div>
						<div class="form-group col-xs-8">
							<div class="row">
								<label>Số điện thoại*</label>
								<input type="text" id="phone" name="" value="" placeholder="" class="form-control">
								<p class="phone-error error"></p>
							</div>
						</div>
						<div class="form-group col-xs-12">
							<div class="row">
								<label>Nội dung*</label>
								<textarea name="" id="content" class="form-control" rows="6"></textarea>
								<p class="content-error error"></p>
							</div>
						</div>
						<div class="form-group col-xs-12">
							<div class="row">
								<button type="button" onclick="contact()" class="btn btn_blue btn-block">GỬI</button>
							</div>
						</div>
					</form>
			</div>
			</div>
	</div>
</div>
<script type="text/javascript">
	function contact()
	{
		var reg_mail = /^[A-Za-z0-9]+([_\.\-]?[A-Za-z0-9])*@[A-Za-z0-9]+([\.\-]?[A-Za-z0-9]+)*(\.[A-Za-z]+)+$/;
		var reg_phone = /^[0-9-+]+$/;
		var name =$('#name').val();
		var email =$('#email').val();
		var phone = $('#phone').val();
		var content = $('textarea#content').val();
		if(name == "")
		{
			alert("vui lòng nhập họ tên quý khách!");
			// $('.name-error').html("vui lòng nhập họ tên quý khách!");
        	document.forms['form_contact'].name.focus();
		}
		else if(email == "")
		{
			alert("vui lòng nhập email!");
			// $('.email-error').html("vui lòng nhập email!");
			document.forms['form_contact'].email.focus();
		}
		else if(reg_mail.test(email)==false)
		{
			alert("địa chỉ email không hợp lệ! Vui lòng nhập lại ( ví dụ: abc@gmail.com)");
			// $('.email-error').html("địa chỉ email không hợp lệ! Vui lòng nhập lại");
			document.forms['form_contact'].email.focus();
		}
		else if(phone =="")
		{
			alert("vui lòng nhập số điện thoại!");
			// $('.phone-error').html("vui lòng nhập số điện thoại!");
			document.forms['form_contact'].phone.focus();
		}
		else if(reg_phone.test(phone)==false)
		{
			alert("Số điện thoại không hợp lệ! Vui lòng nhập lại");
			// $('.phone-error').html("Số điện thoại không hợp lệ! Vui lòng nhập lại");
			document.forms['form_contact'].phone.focus();
		}
		else if(content =="")
		{
			alert("vui lòng nhập nội dung");
			// $('.content-error').html("vui lòng nhập nội dung");
			document.forms['form_contact'].content.focus();
		}
		else{
			$.ajax({
				type :"POST",
				url  :"<?php echo CController::createUrl('contact/sendcontent') ?>",
				data : {
					  "name"     : name,
                      "phone"     : phone,
                      "email"   : email,
                      "content"   : content, 
				},
				success : function(data)
				{
					alert(data);
				},
				complete : function()
				{
					$('#name').val("");
					$('#email').val("");
					$('#phone').val("");
					$('textarea#content').val("");
				}
			});
		}
	}
	window.onload = initialize;
</script>