<?php

return array(
	'yiiext/metroui' => array(
		'sourcePath' => __DIR__ . '/assets',
		'css' => array(
			'css/modern.css',
		),
	),
	'yiiext/metroui/responsive' => array(
		'sourcePath' => __DIR__ . '/assets',
		'css' => array(
			'css/modern-responsive.css',
		),
		'depends' => array('yiiext/modern'),
	)
);
