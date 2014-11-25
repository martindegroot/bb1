<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Budgetbeheer Website',
    'language' => 'nl',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		//
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>false,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		//
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
        'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
            'itemTable' => 'auth_item',
            'itemChildTable' => 'auth_item_child',
            'assignmentTable' => 'auth_assignment',
        ),
		// uncomment the following to enable URLs in path-format
		//
		'urlManager'=>array(
             'showScriptName'=>false,
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'klant/view/<id:\d+>'=>'klant/view',
                'klant/viewbyklantnr/<klantnr:\d+>'=>'klant/viewbyklantnr',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		//
        /*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
        */
		// uncomment the following to use a MySQL database
		//
//		'db'=>array(
//			'connectionString' => 'mysql:host=localhost;dbname=bb1',
//			'emulatePrepare' => true,
//            'enableParamLogging' => true,
//			'username' => 'root',
//			'password' => 'mdg98hjk',
//			'charset' => 'utf8',
//		),
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=martiend_bb1',
            'emulatePrepare' => true,
            'enableParamLogging' => true,
            'username' => 'martiend_admin',
            'password' => 'Zwa98hjk!',
            'charset' => 'utf8',
        ),
		//
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
                    'levels' => 'trace, warning, error',                
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
    

      
	'params'=>array(
		// this is used in contact page
        // Het is mijn eigen online e-mail adres:
		'adminEmail'=>'mdegroot02@online.nl',
	),
);