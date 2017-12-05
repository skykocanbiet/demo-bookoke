<?php
	$this->metaKeywords = $data_seo[0]['meta_keywords'];
	$this->metaDescription = $data_seo[0]['meta_description'];
	$this->pageTitle = $data_seo[0]['meta_title'];
	// $this->canonical = $model->getAbsoluteUrl(); // canonical URLs should always be absolute
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
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
.contentwrap {
  position: relative;
  z-index: 5;
}

.bg_home {
  overflow: hidden;
}
#bg_01,#bg_02{
	height: 12em;
}
.margin_text_right{
	margin-bottom: 50px;
}
.t1
{
	margin-bottom: 0px;
}
.t2{
	margin-bottom: 20px;
}
.baiviet_box h4 {
	font-weight: bold;
	font-size: 20px !important;
}
.choose_slider {
        height: 380px;
        position: relative;
    }
.current_item .text_active{
    display: block !important;
}
.btn-in-banner{
	color: #fff !important;
    background: rgba(211,211,211,0.6);
    width: 170px;
    text-align: center;
    height: 45px;
    padding: 10px;
    border-radius: 10px;
    cursor: pointer;
}
.btn-in-banner a{
	color: #fff;
}
.text-banner-home
{
	color: #fff;
}
.position-text-banner-home{
	position: absolute;
	background: rgba(0, 0, 0, .3);
}
</style>



<div id="fb-root"></div>
<script>(function(d, s, id) {


  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Campaign specific CSS & JS -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.cssslider.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/animated-slider.css"/>
<script type="text/javascript">
    jQuery(document).ready(function ($) {

        var jssor_1_SlideoTransitions = [
          [{b:-1,d:1,o:-1},{b:0,d:1000,o:1}],
          [{b:1900,d:2000,x:-379,e:{x:7}}],
          [{b:1900,d:2000,x:-379,e:{x:7}}],
          [{b:-1,d:1,o:-1,r:288,sX:9,sY:9},{b:1000,d:900,x:-1400,y:-660,o:1,r:-288,sX:-9,sY:-9,e:{r:6}},{b:1900,d:1600,x:-200,o:-1,e:{x:16}}]
        ];

        var jssor_1_options = {
          $AutoPlay: true,
          $SlideDuration: 800,
          $SlideEasing: $Jease$.$OutQuint,
          $CaptionSliderOptions: {
            $Class: $JssorCaptionSlideo$,
            $Transitions: jssor_1_SlideoTransitions
          },
          $ArrowNavigatorOptions: {
            $Class: $JssorArrowNavigator$
          },
          $BulletNavigatorOptions: {
            $Class: $JssorBulletNavigator$
          }
        };

        var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

        /*responsive code begin*/
        /*you can remove responsive code if you don't want the slider scales while window resizing*/
        function ScaleSlider() {
            var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
            if (refSize) {
                refSize = Math.min(refSize, 1920);
                jssor_1_slider.$ScaleWidth(refSize);
            }
            else {
                window.setTimeout(ScaleSlider, 30);
            }
        }
        ScaleSlider();
        $(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);
        /*responsive code end*/
    });
</script>
<style>
        /* jssor slider bullet navigator skin 05 css */
        /*
        .jssorb05 div           (normal)
        .jssorb05 div:hover     (normal mouseover)
        .jssorb05 .av           (active)
        .jssorb05 .av:hover     (active mouseover)
        .jssorb05 .dn           (mousedown)
        */
        .jssorb05 {
            position: absolute;
        }
        .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
            position: absolute;
            /* size of bullet elment */
            width: 16px;
            height: 16px;
            background: url('img/b05.png') no-repeat;
            overflow: hidden;
            cursor: pointer;
        }
        .jssorb05 div { background-position: -7px -7px; }
        .jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
        .jssorb05 .av { background-position: -67px -7px; }
        .jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }

        /* jssor slider arrow navigator skin 22 css */
        /*
        .jssora22l                  (normal)
        .jssora22r                  (normal)
        .jssora22l:hover            (normal mouseover)
        .jssora22r:hover            (normal mouseover)
        .jssora22l.jssora22ldn      (mousedown)
        .jssora22r.jssora22rdn      (mousedown)
        .jssora22l.jssora22lds      (disabled)
        .jssora22r.jssora22rds      (disabled)
        */
        .jssora22l, .jssora22r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 40px;
            height: 58px;
            cursor: pointer;
            background: url('img/a22.png') center center no-repeat;
            overflow: hidden;
        }
        .jssora22l { background-position: -10px -31px; }
        .jssora22r { background-position: -70px -31px; }
        .jssora22l:hover { background-position: -130px -31px; }
        .jssora22r:hover { background-position: -190px -31px; }
        .jssora22l.jssora22ldn { background-position: -250px -31px; }
        .jssora22r.jssora22rdn { background-position: -310px -31px; }
        .jssora22l.jssora22lds { background-position: -10px -31px; opacity: .3; pointer-events: none; }
        .jssora22r.jssora22rds { background-position: -70px -31px; opacity: .3; pointer-events: none; }
    </style>
<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden; visibility: hidden;">
        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden;">
        	<?php
		$i=1;
		 foreach($img as $item){
			
		 ?>
		 	<div data-p="225.00" <?php if($i!=1) echo 'style="display:none;"'; ?>>
                <div style="position: relative;">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/upload/images/lg/<?php echo $item['name_upload']; ?>" alt="" class="img-responsive">
					<div class="wow fadeInUp position-text-banner-home" data-wow-duration="2s">
						<p class="text-banner-home"><?php echo $item['name']; ?></p>
					</div>
					
				</div>
            </div>
		<?php $i++; } ?>
            

        </div>
    </div>
<!---->
<div id="intro">
	<div class="container">
	<div class="row">
		<div class="col-sm-5 hidden-xs">
			<img name="myimage" src="<?php echo Yii::app()->request->baseUrl; ?>/images/section_1.png" alt="" class="img-responsive">
		</div>
		<div class="col-sm-7 margin-top-15 margin-bottom-25" id="intro_text">
			<h2 class="text_green">Chào mừng bạn đến với</h2>
			<h2 style="color: #6a8d2c;">NHA KHOA 2000</h2>
			<hr/>
			<div>
				Sở hữu một nụ cười tươi tắn, một hàm răng khỏe mạnh là niềm vui, hạnh phúc của tất cả mọi người. Và đó cũng là phương châm hoạt động của chúng tôi, Nha khoa 2000 mong ước mang đến cho các bạn chìa khóa thành công, sức mạnh của hình thể và sự tự tin trong cuộc sống.
			</div>
			<div style="margin-top: 20px">
				Với khẩu hiệu: <strong>“You smile, We smile”</strong>, Nha khoa 2000 mong muốn đem đến điều tốt đẹp hơn cho mỗi khách hàng, chỉ khi nhìn thấy bạn tự tin hạnh phúc với nụ cười trọn vẹn, thì điều đó mới thực sự việc làm ý nghĩa mang lại giá trị chân thành nhất mà chúng ta mong muốn có được. 
			</div>
		</div>
	</div>
	</div>
</div>

<div id="info">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="choose_slider">
                    <div class="choose_slider_items">
                        <ul id="mySlider1">
                        <?php
                            $data_review = PReviewCustomer::model()->findAllByAttributes(array('status_hidden'=>1));
                            if($data_review)
                            {
                                foreach ($data_review as $item) 
                                {
                        ?>
                                <li class="current_item">
                                    <a>
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/upload/post/review/lg/<?php echo $item['r_img']; ?>"/>
                                    </a>
                                    <div class="info_name_job">
                                    	<p style="margin-bottom: 0px"><?php echo $item['r_name']; ?></p>
                                    </div>
                                    <div style="display: none;margin-top: 30px;" class="text_active">
                                    <p style="text-align: left;"><img style="width: 5%" src="<?php echo Yii::app()->request->baseUrl; ?>/images/iconhome/ngoac-mo.png"/></p>
                                    <p style="font-size: 14px;padding: 0px 20px;">
                                    <?php echo $item['r_content']; ?>
                                    </p>
                                    <p style="text-align: right;"><img style="width: 5%" src="<?php echo Yii::app()->request->baseUrl; ?>/images/iconhome/ngoac-dong.png"/></p>
                                    </div>
                                </li>
                        <?php 
                                }
                            }
                        ?>
                            <!-- <li class="current_item">
                                <a>
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Review/hang-nga.png"/>
                                </a>
                                <div class="info_name_job">
                                	<p style="margin-bottom: 0px">HẰNG NGA</p>
                                </div>
                                <div style="display: none;margin-top: 30px;" class="text_active">
                                <p style="text-align: left;"><img style="width: 5%" src="<?php echo Yii::app()->request->baseUrl; ?>/images/iconhome/ngoac-mo.png"/></p>
                                <p style="font-size: 14px;padding: 0px 20px;">
                                Nếu có người thân ở nước ngoài cần khám chữa răng thì tôi khuyên bạn nên thử đến khám chữa răng Nha khoa 2000. Không chỉ có được tư vấn khám chữa kỹ càng, mà đội ngũ tư vấn viên rất nhiệt tình, khả năng đối đáp ngoại ngữ rất trôi chảy trả lời mọi câu hỏi thắc mắc khiến gia đình tôi rất tin tưởng.
                                </p>
                                <p style="text-align: right;"><img style="width: 5%" src="<?php echo Yii::app()->request->baseUrl; ?>/images/iconhome/ngoac-dong.png"/></p>
                                </div>
                            </li>
                            <li class="current_item">
                                <a>
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Review/hung-phuc.png"/>
                                </a>
                                <div class="info_name_job">
                                	<p style="margin-bottom: 0px">HƯNG PHỤC</p>
                                </div>
                                <div style="display: none;margin-top: 30px;" class="text_active">
                                <p style="text-align: left;"><img style="width: 5%" src="<?php echo Yii::app()->request->baseUrl; ?>/images/iconhome/ngoac-mo.png"/></p>
                                <p style="font-size: 14px;padding: 0px 20px;">
                                Mình thường xuyên rất ngại đánh răng vì nướu miệng rất dễ bị chảy máu, trong khi hơi thở thường có mùi hôi. Nhờ các bác sĩ tại đây tư vấn khám chữa giúp răng mình thực sự khỏe hơn và cũng không còn bị triệu chứng chảy máu nướu răng nữa.
                                </p>
                                <p style="text-align: right;"><img style="width: 5%" src="<?php echo Yii::app()->request->baseUrl; ?>/images/iconhome/ngoac-dong.png"/></p>
                                </div>
                            </li>
                            <li class="current_item">
                                <a>
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Review/quoc-dat.png"/>
                                </a>
                                <div class="info_name_job">
                                	<p style="margin-bottom: 0px">QUỐC ĐẠT</p>
                                </div>
                                <div style="display: none;margin-top: 30px;" class="text_active">
                                <p style="text-align: left;"><img style="width: 5%" src="<?php echo Yii::app()->request->baseUrl; ?>/images/iconhome/ngoac-mo.png"/></p>
                                <p style="font-size: 14px;padding: 0px 20px;">
                                Là nghệ sĩ, gương mặt nụ cười thực sự rất quan trọng. Tôi đã từng có thời gian kém tự tin vì hàm răng thưa và xỉn màu. Nhưng sau khi khám tại Nha Khoa 2000, mình hoàn toàn hài lòng bởi chất lượng dịch vụ nơi đây.
                                </p>
                                <p style="text-align: right;"><img style="width: 5%" src="<?php echo Yii::app()->request->baseUrl; ?>/images/iconhome/ngoac-dong.png"/></p>
                                </div>
                            </li>
                            <li class="current_item">
                                <a>
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Review/thanh-trong.png"/>
                                </a>
                                <div class="info_name_job">
                                	<p style="margin-bottom: 0px">THANH TRỌNG</p>
                                </div>
                                <div style="display: none;margin-top: 30px;" class="text_active">
                                <p style="text-align: left;"><img style="width: 5%" src="<?php echo Yii::app()->request->baseUrl; ?>/images/iconhome/ngoac-mo.png"/></p>
                                <p style="font-size: 14px;padding: 0px 20px;">
                                Thật không nghĩ vấn đề vệ sinh răng miệng lại có thể dẫn tới bị viêm lở nhiệt miệng, thậm chí kéo theo nhiều bệnh mãn tính răng hàm mặt khác. Cám ơn đội ngũ y bác sĩ đã giúp tôi có thêm nhiều kiến thức chuyên môn để bảo vệ sức khỏe của mình. 
                                </p>
                                <p style="text-align: right;"><img style="width: 5%" src="<?php echo Yii::app()->request->baseUrl; ?>/images/iconhome/ngoac-dong.png"/></p>
                                </div>
                            </li>
                            <li class="current_item">
                                <a>
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Review/nhat-huy.png"/>
                                </a>
                                <div class="info_name_job">
                                	<p style="margin-bottom: 0px">BÉ NHẬT HUY</p>
                                </div>
                                <div style="display: none;margin-top: 30px;" class="text_active">
                                <p style="text-align: left;"><img style="width: 5%" src="<?php echo Yii::app()->request->baseUrl; ?>/images/iconhome/ngoac-mo.png"/></p>
                                <p style="font-size: 14px;padding: 0px 20px;">
                                Các cô chú bác sĩ rất dễ thương và tận tình. Con đến phòng khám mà thấy rất vui, mọi người không chỉ giúp con an tâm, không lo lắng khi khám răng còn chỉ con cách đánh răng, chăm sóc răng miệng sao cho đúng.<br>Con chúc cô chú sức khỏe dồi dào và thành công nhiều hơn nữa.
                                </p>
                                <p style="text-align: right;"><img style="width: 5%" src="<?php echo Yii::app()->request->baseUrl; ?>/images/iconhome/ngoac-dong.png"/></p>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                </div>
                <div class="btn_next_pre" style="text-align: center;margin-bottom: 30px;">
                	<span style="margin-right: 6px;"><a id="btn_next1" href="#"><img id="next" src="<?php echo Yii::app()->request->baseUrl; ?>/images/iconhome/lui-rv-def.png" style="width: 2%"/></a></span>
                	<span><a id="btn_prev1" href="#"><img id="prev" src="<?php echo Yii::app()->request->baseUrl; ?>/images/iconhome/toi-rv-def.png" style="width: 2%"/></a></span>
                </div>
                
			</div>
		</div>
	</div>	
</div>



<!-- CHI NHANH NHA KHOA 2000 -->
<div  class="contentwrap" id="nhakhoa">
	<div class="container">
		<div class="row">
			<h2 class="text_green">NHA KHOA 2000</h2>
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-6">
						<ul class="list-unstyled" id="time">
							<li><p><b>Thứ 2 đến thứ 7:</b></p>
								<ul class="list-unstyled" id="t27">
									<li><p>Sáng: 8h đến 12h</p></li>
									<li><p>Chiều 13h30 đến 20h</p></li>
								</ul>
							</li>
							<li><p><b>Chủ nhật, ngày lễ:</b> nghỉ</p></li>
						</ul>
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/olock.png" alt="" id="clock">	
					</div>
					<div class="col-sm-6" id="branch">
						<h3>CÁC CHI NHÁNH</h3>
                        <?php 
                        $branch = Branch::model()->findAllByAttributes(array('status'=>1)); 
                        if(count($branch) > 0){
                            foreach ($branch as $key => $value) {
                        ?>
						<div id="br<?php echo $key+1; ?>">
							<span style="color: #333"><b><?php echo $value['name']; ?>:</b></span>
							<span><?php echo $value['address']; ?></span>
							<span>ĐT: <?php echo $value['hotline1']; ?> - <?php echo $value['hotline2']; ?></span>
						</div>
                        <?php } } ?>			
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- GOOGLE MAP -->
<div id="map_wrapper" style="height:400px">
    <div id="map_canvas" class="mapping" style="height:400px"></div>
</div> 

<!-- DAT LICH && FACEBOOK  -->


<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.parallaxscrolling.js"></script>
<script>
       $(document).ready(function(){

            $.parallax({
                speed: .95
            });
        });
     
</script>


<script>
    
</script>
<script type="text/javascript">
var current = 1;
var numIMG = 4;

function switchImage(){
  current++;
  // Thay thế hình
  document.images['myimage'].src ='<?php echo Yii::app()->baseUrl?>/images/section_' + current + '.png';
  // Gọi lại hàm nếu thõa đk
  if(current == numIMG){current =0;}
	setTimeout("switchImage()", 8000);
}

$(document).ready(function(){
    		
		switchImage();

    	var next=document.getElementById('next');

    	$('#next').mouseleave(function(){
        	next.src="<?php echo Yii::app()->baseUrl?>/images/iconhome/lui-rv-def.png";
	    });

	    $('#next').mousemove(function(){
	        next.src="<?php echo Yii::app()->baseUrl?>/images/iconFAQ/lui-rv-act.png";
	    });

	    var prev=document.getElementById('prev');

    	$('#prev').mouseleave(function(){
        	prev.src="<?php echo Yii::app()->baseUrl?>/images/iconhome/toi-rv-def.png";
	    });

	    $('#prev').mousemove(function(){
	        prev.src="<?php echo Yii::app()->baseUrl?>/images/iconFAQ/toi-rv-act.png";
	    });

        $("#mySlider1").AnimatedSlider( { prevButton: "#btn_prev1", 
                                         nextButton: "#btn_next1",
                                         visibleItems: 3,
                                         infiniteScroll: true,
                                         willChangeCallback: function(obj, item) { $("#statusText").text("Will change to " + item); },
                                         changedCallback: function(obj, item) { $("#statusText").text("Changed to " + item); }
        });
});

window.onload = initialize;

</script>