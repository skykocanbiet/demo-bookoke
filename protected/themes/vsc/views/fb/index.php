<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
<?php
    $baseUrl = Yii::app()->getBaseUrl();
    // Yii::app()->clientScript->registerCssFile($baseUrl.'/assets_home/mini-website/css/reset.css');
    Yii::app()->clientScript->registerCssFile($baseUrl.'/css/book.css');
    Yii::app()->clientScript->registerCssFile($baseUrl.'/css/bookoke.css');

    // datetime bootstrap
    Yii::app()->clientScript->registerCssFile($baseUrl.'/css/bootstrap-datetimepicker.min.css');
    Yii::app()->clientScript->registerCssFile($baseUrl.'/js/select2/select2.min.css');
    Yii::app()->clientScript->registerCssFile($baseUrl.'/js/select2/select2-bootstrap.min.css');

    Yii::app()->clientScript->registerCoreScript('jquery.ui');
    Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/moment-with-locales.js');
    Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/bootstrap-datetimepicker.min.js');
    Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/select2/select2.min.js');
    Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/select2/i18n/vi.js');
    Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/autoNumeric.js');
?>
    
<script src="https://apis.google.com/js/api:client.js"></script>

<!-- google capchar -->
<script type="text/javascript">
      var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '6Le3xhQUAAAAAMyUiFGS_Azelo3aD3uuIYtj3gg9'
        });
      };
</script>

<!-- sign in google -->
<script id="logGG">
  var googleUser = {};
  var startApp = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '1021861760556-slrh5kf0r21ncmunnmo7794mh7m6bsq5.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scopes: 'profile, email'
      });
      attachSignin(document.getElementById('loginAccGg'));
    });
  };

  function attachSignin(element) {
    auth2.attachClickHandler(element, {},
        function(googleUser) {
        	console.log(googleUser);
        	uId = googleUser.getBasicProfile().getId();
        	uNa = googleUser.getBasicProfile().getName();
        	uEm = googleUser.getBasicProfile().getEmail();
        	FbAccInfo(uId, uNa, uEm, 2);
          //document.getElementById('name').innerText = "Signed in: " +
            //  googleUser.getBasicProfile().getName();
        }, function(error) {
          //alert(JSON.stringify(error, undefined, 2));
        });
  }
</script>
<style>

.error {color: red; font-style: italic;}
.book_pc_tt {font-weight: bold;}

#datetimepickerBook {background: #f0f0f0; padding: 5px;}
th.picker-switch {text-transform: capitalize;}
#datetimepickerBook th.dow {font-size: 0.8em;}
#datetimepickerBook td.day {font-size: 0.75em; border-radius: 0;}
#datetimepickerBook td.today {background: #7cc9ac; color: white;}
#datetimepickerBook td.today::before {border-bottom-color: #7cc9ac;}
#datetimepickerBook td.active {background: #c0bfbf;}

table.collapseTable>tbody>tr>td {padding: 0;}

/*image provider*/
#book_choose_provider table td {
	vertical-align: middle;
}
.p1 {width: 8%;}
.p2 {width: 49%;}
.p3 {width: 35%;}
.p4 {width: 8%;}

.t1 {width: 8%;}
.t2 {width: 49%;}
.t3 {width: 35%; text-align: right;}
.t4 {width: 8%;}


table.tableSub {
	width: 100%;
    max-width: 100%;
    margin: 0;
}

.cur {cursor: pointer;}

.choose_pr>td {padding: 0 !important;}

.hiddenRow {padding: 0px !important; border: 0 !important; font-weight: normal !important;}

.viewMore {padding: 10px 30px;}

img.imgP {
	border-radius: 100%;
	width: 40px;
}
img.imgS {
	width: 16px;
	padding-bottom: 5px;
}
img.imgM {
	width: 18px;
}
#book_choose .book_choose_table {max-height: 610px; overflow: auto;}
#book_choose td{font-size: 12.8px !important;}
body {
  overflow-y: hidden;
}
</style>

<style type="text/css">
    #customBtn {
      display: inline-block;
      background: white;
      color: #444;
      width: 190px;
      border-radius: 5px;
      border: thin solid #888;
      box-shadow: 1px 1px 1px grey;
      white-space: nowrap;
    }
    #customBtn:hover {
      cursor: pointer;
    }
    span.label {
      font-family: serif;
      font-weight: normal;
    }
    span.icon {
      background: url('/identity/sign-in/g-normal.png') transparent 5px 50% no-repeat;
      display: inline-block;
      vertical-align: middle;
      width: 42px;
      height: 42px;
    }
    span.buttonText {
      display: inline-block;
      vertical-align: middle;
      padding-left: 42px;
      padding-right: 42px;
      font-size: 14px;
      font-weight: bold;
      /* Use the Roboto font that is loaded in the <head> */
      font-family: 'Roboto', sans-serif;
    }
  </style>
	<style>
  	.cal-loading {
		  position: fixed;
		  left: 0px;
		  top: 0px;
		  width: 100%;
		  height: 100%;
		  z-index: 9999;
		  background: url('../../images/icon_sb_left/loading.gif') 50% 40% no-repeat rgba(221,221,221,0.5);
		  background-size: 5% auto;
	 }
  	</style>
	<div class="cal-loading" style="display: none;"></div>
<div class="" id="book_container" style="width: 96%;">
	<div class="col-xs-12" id="book_info">
		<div id="book_process">
			<ul class="list-inline">
				<li><span class="process book_pc_tt fbBr">VĂN PHÒNG</span></li>
			  	<li><span class="glyphicon glyphicon-menu-right"></span></li>
			  	<li><span class="process book_pc_tt fbSv">DỊCH VỤ</span></li>
			  	<li><span class="glyphicon glyphicon-menu-right"></span></li>
			  	<li><span class="process book_pc_tt fbPv">NGƯỜI THỰC HIỆN</span></li>
			  	<li><span class="glyphicon glyphicon-menu-right"></span></li>
			  	<li><span class="process book_pc_tt fbDt">NGÀY GIỜ</span></li>
			  	<li><span class="glyphicon glyphicon-menu-right"></span></li>
			  	<li><span class="process book_pc_tt fbIf">THÔNG TIN</span></li>
			  	<li><span class="glyphicon glyphicon-menu-right"></span></li>
			  	<li><span class="process book_pc_tt fbCf">XÁC NHẬN</span></li>
			</ul>

			<div class="progress-container">
			    <div class="progress progress-striped active">
			        <div class="progress-bar progress-bar-success"></div>
			    </div>
			</div>
		</div>

		<div id="book_choose">
			
		</div>
	</div>
</div>

<script id="LoginByFB">
  	// This is called with the results from from FB.getLoginStatus().
  	function statusChangeCallback(response) {
    	/*console.log('statusChangeCallback');
    	console.log(response);*/
    	// The response object is returned with a status field that lets the app know the current login status of the person.
    	// Full docs on the response object can be found in the documentation for FB.getLoginStatus().
    	if (response.status === 'connected') {
      		// Logged into your app and Facebook.
      		testAPI();
    	} else if (response.status === 'not_authorized') {
      		// The person is logged into Facebook, but not your app.
    	} else {
      		// The person is not logged into Facebook, so we're not sure if they are logged into this app or not.
    	}
  	}

	// This function is called when someone finishes with the Login Button.
  	function checkLoginState() {
    	FB.getLoginStatus(function(response) {
      		statusChangeCallback(response);
    	});
  	}

  	window.fbAsyncInit = function() {
	  	FB.init({
		    appId      : '1756869464576904',
		    cookie     : true,  // enable cookies to allow the server to access the session
		    xfbml      : true,  // parse social plugins on this page
		    version    : 'v2.8' // use graph api version 2.8
	  	});

	// Now that we've initialized the JavaScript SDK, we call FB.getLoginStatus().
	// This function gets the state of the person visiting this page and can return one of three states to the callback you provide.
	//   They can be:
	// 1. Logged into your app ('connected')
	// 2. Logged into Facebook, but not your app ('not_authorized')
	// 3. Not logged into Facebook and can't tell if they are logged into your app or not.
	// These three cases are handled in the callback function.
	  	FB.getLoginStatus(function(response) {
	    	statusChangeCallback(response);
	  	});

	};

  	// Load the SDK asynchronously
  	(function(d, s, id) {
    	var js, fjs = d.getElementsByTagName(s)[0];
    	if (d.getElementById(id)) return;
    	js = d.createElement(s); js.id = id;
    	js.src = "//connect.facebook.net/en_US/sdk.js";
   	 	fjs.parentNode.insertBefore(js, fjs);
  	}(document, 'script', 'facebook-jssdk'));

  	// Here we run a very simple test of the Graph API after login is
  	// successful.  See statusChangeCallback() for when this call is made.
  	function testAPI() {
	    /*FB.api('/me', function(response) {
	    	console.log(response);
	      	uId = response.id;
	      	uNa = response.name;

	      	FbAccRegister(uId, uNa);

	    });*/
  	}

  	// google Signin APi
  	/*function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
      };

    function signOut() {
	    var auth2 = gapi.auth2.getAuthInstance();
	    auth2.signOut().then(function () {
	      console.log('User signed out.');
	    });
	}*/
</script>
<script>
/******* chay thanh trang thai ************/
	function runProcess(width) {
		$(".progress-bar").animate({
		    width: width
		}, 0 );
	}
/******* chon văn phòng ************/
	function calBranch() {
		runProcess('0%');
		$.ajax({
			url : "<?php echo CController::createUrl('fb/book_branch'); ?>",
			type: 'POST',
			success: function (data) {
				$('#book_choose').empty();
				$('#book_choose').html(data);
				$('.book_pc_tt').removeClass('cur');
			}, 
		})
	}
/******* chon dich vu ************/
	function calService(id_branch, address, name) {
		wp = $('.progress').width();
		w = ($('li:nth-child(2)').offset()).left;
		wpc = parseInt(w-30)*100/parseInt(wp);
		runProcess(wpc+'%');

		$.ajax({
			url : "<?php echo CController::createUrl('fb/book_services'); ?>",
			type: 'POST',
			data: {
				id_branch: id_branch, 
				address  : address, 
				name     : name, 
			},
			success: function (data) {
				$('#book_choose').empty();
				$('#book_choose').html(data);
				$('.book_pc_tt').removeClass('cur');
				$('.fbBr').addClass('cur');
			}, 
		})
	}
/******* chon nguoi thuc hien ************/
	function calProvider(service_id, service_name, len, price) {		
		wp = $('.progress').width();
		w = ($('li:nth-child(4)').offset()).left;
		wpc = parseInt(w-30)*100/parseInt(wp);
		runProcess(wpc+'%');

		$.ajax({
			url : "<?php echo CController::createUrl('fb/book_provider'); ?>",
			type: 'POST',
			data: {
				service_id 		: 	service_id,
				service_name	: 	service_name,
				service_len		: 	len,
				service_price 	: 	price,
			},
			success: function (data) {
				$('#book_choose').empty();
				$('#book_choose').html(data);
				$('.book_pc_tt').removeClass('cur');
				$('.fbBr, .fbSv').addClass('cur');
			}, 
		})
	}
/******* chon ngay gio ************/
	function calDate(provider_id, provider_name) {
		wp = $('.progress').width();
		w = ($('li:nth-child(6)').offset()).left;
		wpc = parseInt(w-30)*100/parseInt(wp);
		runProcess(wpc+'%');
		
		$.ajax({
			url: "<?php echo CController::createUrl('fb/book_date'); ?>",
			type: 'POST',
			data: {
				provider_id 	: 	provider_id,
				provider_name	: 	provider_name,
			},
			success: function (data) {
				$('#book_choose').empty();
				$('#book_choose').html(data);
				$('.book_pc_tt').removeClass('cur');
				$('.fbBr, .fbSv, .fbPv').addClass('cur');
			}, 
		})
	}
/******* nhap thong tin ************/
	function calInfo(date, time_start, time_end) {
		wp = $('.progress').width();
		w = ($('li:nth-child(8)').offset()).left;
		wpc = parseInt(w-30)*100/parseInt(wp);
		runProcess(wpc+'%');

		$.ajax({
			url: "<?php echo CController::createUrl('fb/book_info'); ?>",
			type: 'POST',
			data: {
				date 		: 	date,
				time_start 	: 	time_start,
				time_end	: 	time_end,
			},
			success: function (data) {
				$('#book_choose').empty();
				$('#book_choose').html(data);
				$('.fbDt').addClass('cur');
				getFBinfo();
			}, 
		})
	}
/******* lay du lieu facebook ************/
	function getFBinfo() {
		FB.getLoginStatus(function(response) {
      		if (response.status === 'connected') {
      			/*FB.api("/me/permissions","DELETE",function(response){
				    console.log(response); //gives true on app delete success 
				});*/
      			//getUFbInfo();
      		}
    	});
	}
/******* lay thong tin nguoi dung facebook ************/
	function getUFbInfo() {
		FB.api('/me?fields=id,name,email', function(response) {
	      	uId = response.id;
	      	uNa = response.name;
	      	uEm = response.email;

	      	FbAccInfo(uId, uNa, uEm, 1);
	    });
	}	
/********** thong tin khach hang dang nhap bang facebook / google ***************/
	function FbAccInfo(uId, uNa, uEm, typeLog) {
		$.ajax({ 
			type    : 	"POST",
			url     : 	"<?php echo CController::createUrl('fb/LogFb')?>",
			data    : 	{
				uId    : uId,
				uNa    : uNa,
				uEm    : uEm,
				typeLog: typeLog,
			},
			dataType: 	'json',
			success : 	function(data){
				if(data == 1) {
					calVerify();
				}
				else if(data == 0) {
					$('.FbLoginInfo').hide();
					$('.FbInfoCus').show();
					$('#cusFullname').val(uNa);
					$('#cusEmail').val(uEm);
					if(typeLog == 1){		// dang nhap bang facebook
						$('#Customer_id_fb').val(uId);
						$('#Customer_name_fb').val(uNa);
					}
					if(typeLog == 2){		// dang nhap bang google
						$('#cusEmail').prop('readonly', true);
						$('#Customer_id_gg').val(uId);
						$('#Customer_name_gg').val(uNa);
					}
				}
            },
            error: function(data) {
                alert("Error occured.Please try again!");
            },
        });
	}
/******* chon xac thuc ************/
	function calVerify() {
		wp = $('.progress').width();
		w = ($('li:nth-child(10)').offset()).left;
		wpc = parseInt(w-30)*100/parseInt(wp);
		runProcess(wpc+'%');

		$.ajax({
			url: "<?php echo CController::createUrl('fb/book_verity'); ?>",
			type: 'POST',
			success: function (data) {
				$('#book_choose').empty();
				$('#book_choose').html(data);
				
				if(data.status == -2) {
					$('.txtschInfo').hide();
					$('#txtSchErr').text(data.error);
				}
			}, 
		})
	}
/******* nhap ma xac thuc************/
	function calVerifySMS(veriType) {
		wp  = $('.progress').width();
		wpl = $('li:last-child').width();
		w   = ($('li:nth-child(8)').offset()).left;
		wpc = parseInt(w-30)*100/parseInt(wp);
		wpc2 = wpc + (100-wpc)/2;
		runProcess(wpc2+'%');

		$.ajax({
			url: "<?php echo CController::createUrl('fb/book_verity_sms'); ?>",
			type: 'POST',
			data: {veriType:veriType},
			success: function (data) {
				$('#book_choose').empty();
				$('#book_choose').html(data);
				$('.book_pc_tt').removeClass('cur');
				$('.cal-loading').fadeOut('fast');
				showCountDown(60);
			}, 
		})
	}
/******* thoi gian dem nguoc 5 phút = 5000 ************/
	/*	function countDownConfirm() {
			setInterval(function(){
				ct   = $('#count');
				time = parseInt(time - 1);
				console.log(time);
				if(time >= 0)
					ct.text(time);
				if(time == 0){
					$('.verify1').hide();
					$('.verify2').show();
				}
			}, 1000);
		}	*/
/******* kiem tra ma xac thuc************/
	function checkCode(code) {
		$.ajax({
			url     : "<?php echo CController::createUrl('fb/checkCode'); ?>",
			type    : 'POST',
			dataType: 'json',
			data    : {code:code},
			success: function (data) {
				console.log(data);
				if(data.status == 0){
					$('.CodeErr').text(data.error);
				}
				else if(data == 1) {
					calComplete();
				}
				else {
					$('#info').modal("show");
				}
			}, 
		})
	}
/******* chon buoc cuoi************/
	function calComplete() {
		runProcess('100%');

		$.ajax({
			url: "<?php echo CController::createUrl('fb/book_complete'); ?>",
			type: 'POST',
			dataType: 'html',
			success: function (data) {
				$('#book_choose').empty();
				$('#book_choose').html(data);
				getNoti(0);
			}, 
		})
	}
/******* thong bao ************/
	function getNoti(type) {
	    $.ajax({
			url     : '<?php echo CController::createUrl('fb/getNoti'); ?>',
			type    : "post",
			dataType: 'json',
			data: {
				type : type,
			},
			success : function (data) {
				console.log(data);
			}
	    })
	}

$(function () {
	var urlMain = document.referrer;

	br = '';
	sv = '';

	urlMain = urlMain.split("/");
	if(urlMain[4]){
		get     = urlMain[4].split("&");

		if(get[0]){
			if(get[0].search('br') > 0)
				br    = get[0].substring(get[0].search('br')+3);
		}
		if(get[1])
			sv    = get[1].substring(get[1].search('sv')+3);
	}
	$.ajax({
		url     : '<?php echo CController::createUrl('fb/controlUrl'); ?>',
		type    : "post",
		dataType: 'json',
		data: {
			br : br,
			sv: sv,
		},
		success : function (data) {
			if(data == 0)
				calBranch();
			else if(data == 1)
				calService();
			else if(data == 2)
				calProvider();
		}
    })
	
	$('.book_pc_tt').click(function (e) {
		clsNSpan = $(this).parents('span').context.className.split(' ');

		actCls = clsNSpan[2];

		if(clsNSpan[3] != 'cur') {
			return;
		}

		switch(actCls) {
			case 'fbBr': 		// chon chi nhanh
				calBranch();
				break;
			case 'fbSv': 		// chon dich vu
				calService();
				break;
			case 'fbPv': 		// chon nguoi thuc hien
				calProvider();
				break;
			case 'fbDt': 		// chon ngay gio
				calDate();
				break;
			default:
				console.log(actCls);
				break;
		}
	})
})
</script>