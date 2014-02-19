NOT SUPPORTED ANYMORE !!!
=========================

yiimetroui
==========

yii metroui extension

This extension will be build upon yii2, it's hardly in development status. If you wanna take a look and
enhace it, you are pretty welcome!

As I'm not an educated programmer, some of the code could be rubbish, but I try to learn from other
developers which are in my opinion well skilled! :)

If you have questions, feel free to contact me!

philipp at frenzel dot net

installation
============

Add the sources to your composer.json > repositories file:
```json
{
    "type": "package",
    "package": {
        "name": "yiiext/yiimetroui",
        "version": "0.1.10",
        "authors": [
            {
                "name": "Philipp Frenzel",
                "homepage": "http://frenzel.net"
            }
        ],
        "source": {
            "url": "https://github.com/philippfrenzel/yiimetroui.git",
            "type": "git",
            "reference": "master"
        },
        "autoload": {
            "psr-0": { "yiimetroui\\": "/" }
        }
    }
}
```

Package is although registered at packagist.org - so you can just add one line of code, to let it run!

```json
"require": {
        "yiisoft/yii2": "dev-master",
        "yiisoft/yii2-composer":"dev-master",
        "philippfrenzel/yiimetroui":"*"
},
```

IMPORTANT:

add class="metrouicss" to your body

```html
<body class="metrouicss">
```

MetroUI already loaded?
- As I use assetparser extension to parse the less files into my distribution, i commented the assets.php to avoid static css loading. If you need the css-files to be loaded statically, pls. uncomment the entries!

Add the following line to your index.php in /www

```php
Yii::setAlias('@yiimetroui', __DIR__ . '/../vendor/philippfrenzel/yiimetroui/yiimetroui/');
```

USAGE
=====

Accordion (Collapse)
====================

Put the code below into your view file and enjoy it!

```php
use yiimetroui\Accordion;

echo Accordion::widget(array(
	'Accordion Group Label'=>array(
			// required, the content (HTML) of the group
			'content'=>'Anim pariatur cliche...',
			// optional the HTML attributes of the content group
	       'contentOptions'=> array(),
	       // optional the HTML attributes of the group
	       'options'=> array(),
		),
	)
));
```

Carousel
========

Put the code below into your view file and enjoy it!

```php
use yiimetroui\Carousel;

echo Carousel::widget(array(
	'items'=>array(
		array(
			'content'=>'<img src="http://lorempixel.com/550/200/animals"/>',
			'id'=>'slide1',
		),
		array(
			'content'=>'<img src="http://lorempixel.com/550/200/sports"/>',
			'id'=>'slide2',
		)
	),
	'options'=>array(
		'style'=>'height:200px',
	)
));
```

Tabs
====

Put the code below into your view file and enjoy it!

attention, to make it more simple, always the first tab will be showed on "startup"

```php
use yiimetroui\Tabs;

echo Tabs::widget(array(
     'items' => array(
         array(
             'header' => 'One',
             'content' => 'Mauris mauris ante, blandit et, ultrices a, suscipit eget...',
         ),
         array(
             'header' => 'Two',
             'headerOptions' => array(...),
             'content' => 'Sed non urna. Phasellus eu ligula. Vestibulum sit amet purus...',
             'options' => array(...),
         ),
     ),
));
```

Tiles
=====

Put the code below into your view file and enjoy it!

```php
use yiimetroui\Tile;

echo Tile::widget(array(
    'items'=>array(
        array(
            'content'=>'<i class="icon-github"></i>',
            'brand'=>'<div class="name">Frenzel.NET</div>',                    
        ),
    ),
    'options'=>array('class'=>'icon bg-color-green'),
));
```
