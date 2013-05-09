<?php

/**
* MuiApi class file.
* @author Philipp Frenzel <philipp@frenzel.net>
* @copyright Copyright &copy; Philipp Frenzel 2013-
* @license http://www.opensource.org/licenses/bsd-license.php New BSD License
* @package metroui.components
* @version 1.0.0
*/

namespace vendor\yiiext\metroui\components;

use Yii;
use yii\base\Component;
use yii\helpers\Html;

/**
* MetroUI API component.
*/
class MuiApi extents Component{

	/**
	* @var bool whether we should copy the asset file or directory even if it is already published before.
	*/
	public $forceCopyAssets = false;

	private $_assetsUrl;

	/**
	* Registers the MetroUI CSS.
	* @param string $url the URL to the CSS file to register.
	*/
	public function registerCoreCss($url = null)
	{
		if ($url === null)
		{
			$fileName = YII_DEBUG ? 'modern.css' : 'modern.min.css';
			$url = $this->getAssetsUrl() . '/css/' . $fileName;
		}
		Yii::app()->clientScript->registerCssFile($url);
	}

}
