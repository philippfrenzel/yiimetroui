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

MetroUI already loaded?
- As I use assetparser extension to parse the less files into my distribution, i commented the assets.php to avoid static css loading. If you need the css-files to be loaded statically, pls. uncomment the entries!

Add the following line to your index.php in /www

```php
Yii::setAlias('@yiimetroui', __DIR__ . '/../vendor/yiiext/yiimetroui/yiimetroui/');
```

USAGE
=====

Carousel
========

Put the code below into your view file and enjoy it!

```php
use yiimetroui\carousel;

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