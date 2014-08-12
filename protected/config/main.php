<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.


Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(



    // ajax upld


    'import'=>array(
        'application.modules.ajaxuploader.widgets.*',
        'application.modules.ajaxuploader.controllers.*',
        'application.modules.ajaxuploader.models.*',
    ),

    // Bootstrap

    'theme'=>'bootstrap', // requires you to copy the theme under your themes directory

	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Freelens.us',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
        'ajaxuploader'=>array(
            'userModel'=>'Biodata',  //change to the model that has the pix column
            'userPixColumn'=>'pix',  //column to save the filename
            'folder'=>'images', //the dest folder(should be in the same folder level as protected folder)
        ),

        'cabinet',
		'gii'=>array(
            'generatorPaths'=>array(
                'bootstrap.gii',
            ),
			'class'=>'system.gii.GiiModule',
			'password'=>'1',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

	),

	// application components
	'components'=>array(
        'user'=>array(
			// enable cookie-based authentication
            // RBAC auth
            'class' => 'WebUser',
			'allowAutoLogin'=>true,
            'loginUrl' => array('cabinet/auth/login'), // Change default login action
		),


        // External extension

        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),




        'email'=>array(
            'class'=>'application.extensions.email.Email',
            'delivery'=>'php', //Will use the php mailing function.
        ),

        // Auth manager for users
        'authManager' => array(
            'class' => 'PhpAuthManager', // In components
            'defaultRoles' => array('guest'),
        ),

		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),


		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=freelensus',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '123456',
			'charset' => 'utf8',
		),

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
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);