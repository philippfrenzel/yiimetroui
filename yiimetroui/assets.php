<?php

return array(
	'yiimetroui' => array(
		'sourcePath' => __DIR__ . '/assets',
		'css' => array(
			'css/modern.css', //uncomment this, if you don't use the modern.css already in your allication
		),
	),
	'yiimetroui/responsive' => array(
		'sourcePath' => __DIR__ . '/assets',
		'css' => array(
			'css/modern-responsive.css', //uncomment this, if you don't use the modern.css already in your allication
		),
		'depends' => array('yiimetroui'),
	),
	'yiimetroui/carousel' => array(
		'sourcePath' => __DIR__ . '/assets',
		'js' => array(
			'js/carousel.js',
		),
		'depends' => array('yiimetroui','yii'), 
	),
	'yiimetroui/accordion' => array(
		'sourcePath' => __DIR__ . '/assets',
		'js' => array(
			'js/accordion.js',
		),
		'depends' => array('yiimetroui','yii'),
	),
	'yiimetroui/tabs' => array(
		'sourcePath' => __DIR__ . '/assets',
		'js' => array(
			'js/pagecontrol.js',
		),
		'depends' => array('yiimetroui','yii'),
	),
	'yiimetroui/tile' => array(
		'sourcePath' => __DIR__ . '/assets',
		'js' => array(
			'js/tile-drag.js',
		),
		'depends' => array('yiimetroui','yii'),
	)
);
