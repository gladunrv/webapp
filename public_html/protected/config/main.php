<?php

$params = require(__DIR__ . '/params.php');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	'preload'=>array('log'),
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Password',
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(
	          'ext.gtc',   // Gii Template Collection
	        ),
		),
		
	),

	'components'=>array(

		'tmdb'=>array(
            'class'=>'Tmdb'
        ),

		'user'=>array(
			'allowAutoLogin'=>true,
		),

		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/

		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			'errorAction'=>YII_DEBUG ? null : 'site/error',
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
		'curl' => array(
        	'class' => 'ext.curl.Curl',
        	'options' => array(/* additional curl options */),
    	),

	),
	'params' => $params,
);
