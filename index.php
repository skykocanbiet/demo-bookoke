<?php
ini_set("default_socket_timeout", 80);

date_default_timezone_set("Asia/Ho_Chi_Minh");
// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
ini_set('display_errors',0); error_reporting(E_ALL);
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// ini_set('memory_limit', '-1');
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
defined('DS') or define('DS',DIRECTORY_SEPARATOR);
require_once($yii);

Yii::createWebApplication($config)->run();
