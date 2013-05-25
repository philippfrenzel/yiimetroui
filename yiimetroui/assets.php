<?php

return array(
	'yiimetroui' => array(
		'sourcePath' => __DIR__ . '/assets',
		'css' => array(
			'css/modern.css',
		),
	),
	'yiimetroui/responsive' => array(
		'sourcePath' => __DIR__ . '/assets',
		'css' => array(
			'css/modern-responsive.css',
		),
		'depends' => array('yiimetroui'),
	),
	'yiimetroui/carousel' => array(
		'sourcePath' => __DIR__ . '/assets',
		'js' => array(
			'js/carousel.js',
		),
		'depends' => array('yiimetroui'),
	)
);
