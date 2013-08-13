<?php

return array(
	yiimetroui\WidgetAsset::className(),
	yiimetroui\AccordionAsset::className(),
	yiimetroui\TabsAsset::className(),
	yiimetroui\TileAsset::className(),
	yiimetroui\NoticeAsset::className(),
);

return array(
	'yiimetroui/notice' => array(
		'sourcePath' => __DIR__ . '/assets',
		'js' => array(
			'js/tile-drag.js',
		),
		'depends' => array('yiimetroui','yii'),
	)
);
