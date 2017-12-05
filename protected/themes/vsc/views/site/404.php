<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <?php

    $cs = Yii::app()->getClientScript();

    $cs->registerCssFile(Yii::app()->baseUrl.'/css/font-awesome/css/font-awesome.min.css');

    $cs->registerCssFile(Yii::app()->baseUrl.'/css/admin/main.css'); 

    ?>
  <?php 
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
  ?>

</head>


<style>
   @font-face{
      font-family: helveticalight;
      src:url("<?php echo Yii::app()->request->baseUrl; ?>/fonts/HelveticaNeue-Light.otf");
   }
  header{
    position: absolute;
      top: 15px;
      left: 10%;
      width: 10%;
  }
  footer{
    position: absolute;
    bottom: 10px;
    left: 0;
    width: 100%;
  }
  .bg-admin-login {
      background: url("images/bg-log-in.jpg") top center ;
      background-size: 100% 100%;
      background-repeat: no-repeat;
      position: relative;
  }
  

  #login-form{
    width: 300px;
      margin: 0px auto;
      padding-top: 2%;
  }

  #login-form-info{
    width: 300px;
      margin: 0px auto;
      padding-top: 1%;
      text-align: center;
      font-style: italic;
  }

  #login-title{
    width: 550px;
      margin: 0px auto;
      padding-top: 13%;
      text-align: center;
      font-weight: normal;
      color: #fff;
      font-size: 4em;
      font-family: helveticalight;
  }
  #login-form .form-control{
    border-radius:3px;
  }

  #login-form .checkbox label{
    color: rgba(255, 255, 255, 0.8);
  }

  .btn-login-admin{
      font-size: 17px;
      width: 100%;
      padding-top: 8px;
      padding-bottom: 8px;
      border-radius: 3px;
      border:none;
  }
  .help-block{
    color: #f9a409 !important;
  }

</style>

<body>  

  <div class="bg-admin-login">
    <header>
           <a style="display: inline-block;" href="http://bookoke.com">
               <img  class="img-responsive"  src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo-Bookoke-white.png" alt="<?php echo CHtml::encode(Yii::app()->name); ?>" />
           </a>
      </header>



       <footer>
            <p style="width:100%;padding:0px 0px 10px 0px;margin:0px auto;color:rgba(255, 255, 255, 0.8);text-align:center;">Copyright &copy; 2017 BookOke. All rights reserved. The online services are BookOke confidential, proprietary and for use by BookOke partners only.</p>
     </footer>  
  </div>

    <script type="text/javascript">

    $(window).load(function() {
        $(window).resize(function() {
            var body_h = $(this).height(); 
            $(".bg-admin-login").css("height",body_h );

        }).resize();
    });

    </script>

    <?php 
        $cs->registerScriptFile(Yii::app()->baseUrl.'/js/vsc/js/metisMenu.min.js',CClientScript::POS_END);    
        $cs->registerScriptFile(Yii::app()->baseUrl.'/js/vsc/js/main.js',CClientScript::POS_END);
    ?>

</body>

</html>

