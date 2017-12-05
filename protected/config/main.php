<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
//define('DS',DIRECTORY_SEPARATOR);
return array(
    
	'basePath'=>dirname(__FILE__).DS.'..',
	'name'=>'BookOke - Management',
    
    'defaultController' => 'admin/login',
    
    'sourceLanguage'=>'00',
    'language'=>'en',
    
	// preloading 'log' component
	'preload'=>array('log','booster'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',		
		'application.modules.itemsBranch.models.*',
		'application.modules.itemsCustomers.models.*',
		'application.modules.itemsLocation.models.*',
		'application.modules.itemsSchedule.models.*',			
		'application.modules.itemsService.models.*',
		'application.modules.itemsUsers.models.*',
		'application.modules.itemsSetting.models.*',
		'application.modules.itemsSales.models.*',
		'application.modules.itemsProducts.models.*',
		'application.modules.itemsOpportunity.models.*',
		'application.modules.itemsCall.models.*',
		'application.modules.itemsReports.models.*',
		'application.modules.itemsAccounting.models.*',
		'application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',

		'ext.easyimage.EasyImage',
	),
	
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'BoO!@#$5',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','115.75.6.29','::1'),
            'generatorPaths'=>array(
                'booster.gii',
            ),
		),
		
		'itemsDashBoard',
		'itemsUsers',
		'itemsCustomers',
		'itemsSales',
		'itemsAccounting',
		'itemsSchedule',
		'itemsService',
		'itemsBranch',
		'itemsLocation',
		'itemsProducts',
		'itemsQuestionQuick',
		'itemsSetting',
		'itemsOpportunity',
		'itemsCall',
		'itemsReports',

	),

	// application components
	'components'=>array(
	
		'ePdf' => array(
	        'class'         => 'ext.yii-pdf.EYiiPdf',
	        'params'        => array(
	    		'HTML2PDF' => array(
		     		'librarySourcePath' => 'application.vendors.html2pdf.*',
		     		'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
		     		'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
			      		'orientation' => 'P', // landscape or portrait orientation
			      		'format'      => 'A4', // format A4, A5, ...
			      		'language'    => 'en', // language: fr, en, it ...
			      		'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
			      		'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
			      		'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
					)/**/
	    		)
	   		),
	  	),
		
		'simpleimage' => array(
            'class' => 'SimpleImage',
        ),

        'easyImage' => array(
		    'class' => 'application.extensions.easyimage.EasyImage',
		    //'driver' => 'GD',
		    //'quality' => 100,
		    //'cachePath' => '/assets/easyimage/',
		    //'cacheTime' => 2592000,
		    //'retinaSupport' => false,
		    //'isProgressiveJpeg' => false,
		 ),
		
		'user'=>array(
			// enable cookie-based authentication
            'loginUrl'=>'http://bookoke.com/login',
			'allowAutoLogin'=>true,
		),

        'booster'=> array(
            'class' => 'ext.booster.components.Booster',
        ),    
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			    'showScriptName'=>false,
				'rules'=>array(

					''				=>'admin/login',
					'index.php'		=>'admin/login',
					'admin/login'	=>'admin/login',

					'<controller:\w+>/<id:\d+>'=>'<controller>/view',
					'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
					'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
					'model/<id:\d+>-<name>.html'=>'model/view',
						
				),
		),

		// database settings are configured in database.php
		//'db'=>require(dirname(__FILE__).'/database.php'),
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=bookoke_demo',
            'emulatePrepare' => true,
            'username' => 'bookoke_demo',
            'password' => 'sQc6#06z',
            'charset' => 'utf8',
            //'tablePrefix' => 'tbl_',
        ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'admin/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),

		/* START SEND SWIFTMAILER */
        'swiftMailer' => array(
            'class' => 'ext.swiftMailer.SwiftMailer',
        ),
		

		'metadata'=>array('class'=>'Metadata'),
		
        'themeManager'=>array('basePath'=>dirname(__FILE__).DS.'..'.DS.'themes'),
        

	),
    'theme'=>'vsc',
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),

);
