<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/moment-with-locales.js" type="text/javascript"></script>

</head>
<body>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1447530568610237',
      xfbml      : true,
      version    : 'v2.8'
    });
   /* FB.ui({
  method: 'pagetab',
  redirect_uri: 'https://localhost/nhakhoa2000/facebookapp'

}, function(response){
  // Debug response (optional)
  console.log(response);
});*/
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

	<?php echo $content; ?>
</body>
</html>