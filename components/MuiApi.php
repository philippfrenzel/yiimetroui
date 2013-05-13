<?php

/**
* MuiApi class file.
* @author Philipp Frenzel <philipp@frenzel.net>
* @copyright Copyright &copy; Philipp Frenzel 2013
* @license http://www.opensource.org/licenses/bsd-license.php New BSD License
* @package metroui.components
* @version 1.0.0
*/

namespace vendor\yiiext\metroui\components;

use Yii;
use yii\base\Component;
use yii\web\AssetBundle;
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
	* @var array this contains the complete bundle for passing over to the assetmanager
	*/
	private $_bundle = array(
 	    'metroui' => array(
	        'basePath' => '@wwwroot',
	        'baseUrl' => '@www',
	        'depends' => array(
	            'yii',
	        ),
	    ),
	);

	/**
	* Registers the MetroUI CSS.
	* @param string $url the URL to the CSS file to register.
	*/
	public function registerCoreCss($url = null)
	{
		if ($url === null)
		{
			$fileName = YII_DEBUG ? 'modern.css' : 'modern.css';
			$url = $this->getAssetsUrl() . '/css/' . $fileName;
		}
		$this->_bundle['css'][] = $url;
	}

	/**
	* Registers the responsive MetroUI CSS.
	* @param string $url the URL to the CSS file to register.
	*/
	public function registerResponsiveCss($url = null)
	{
		if ($url === null)
		{
			$fileName = YII_DEBUG ? 'modern-responsive.css' : 'modern-responsive.css';
			$url = $this->getAssetsUrl() . '/css/' . $fileName;
		}

		/** @var HTML::tag $header contains the meta tag for displaying responsive */

		$header = HTML::tag('meta','',array(
			'width'=>'device-width',
			'initial-scale'=>'1.0', 
			'viewport'
			)
		);
		Yii::app()->head()->addTag($header);
		$this->_bundle['css'][] = $url;
	}

	/**
	* Registers all assets.
	*/
	public function register()
	{
		$this->registerAssetBundle($this->_bundle);		
	}

	/**
	* Registers the named asset bundle.
	* All dependent asset bundles will be registered.
	* @param string $name the name of the asset bundle.
	* @throws InvalidConfigException if the asset bundle does not exist or a circular dependency is detected
	*/
	public function registerAssetBundle($name)
	{
		if (!isset($this->assetBundles[$name])) {
			$am = $this->getAssetManager();
			$bundle = $am->getBundle($name);
			if ($bundle !== null) {
				$this->assetBundles[$name] = false;
				$bundle->registerAssets($this);
				$this->assetBundles[$name] = true;
			} else {
				throw new InvalidConfigException("Unknown asset bundle: $name");
			}
		} elseif ($this->assetBundles[$name] === false) {
			throw new InvalidConfigException("A circular dependency is detected for bundle '$name'.");
		}
	}

}
