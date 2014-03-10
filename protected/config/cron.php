<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Move Right',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	// application components
	'components'=>array(
		/*'cache'=>array(
			'class'=>'system.caching.CApcCache',
		),*/

		'cache'=>array(
			'class'=>'system.caching.CDbCache',
			'connectionID'=>'db',
		),

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=mr',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'enableProfiling' => YII_DEBUG, //uncomment for debugging
			'enableParamLogging' => YII_DEBUG, //uncomment for debugging
			'schemaCachingDuration' => 600,
		),

		'email' => array(
			'class'=>'EmailHelper',
		),

		'format' => array(
			'class'=>'Formatter',
			'dateFormat'=>'M j, Y',
			'datetimeFormat'=>'M j, Y H:i',
			'timeFormat'=>'H:i',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				//uncomment for debugging
				/*array(
					'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
					'ipFilters'=>array('127.0.0.1'),
					'enabled'=>true,
				),*/
				// uncomment the following to show log messages on web pages
				/*
				 array(
					 'class'=>'CWebLogRoute',
				 ),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		'enableAnalytics'=>false,
		'enableMaps'=>false,
		'enableShare'=>false,

		// this is used in contact page
		'defaultEmail'=>'email@mcewanfraserlegal.co.uk',
		'viewingEmail'=>'viewings@mcewanfraserlegal.co.uk',
		'newBusinessEmail'=>'newbusiness@mcewanfraser.co.uk',


		'reCaptcha'=>array(
			'publicKey'=>'6LcwnN0SAAAAAFm1R8WLp_NoG564t3UUgA-klRsp',
			'privateKey'=>'6LcwnN0SAAAAAMDOitnbuO82iBzHNrK-gjqMbvAt',
		),
	),

);