<?php
/**
 * @link http://www.frenzel.net/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.frenzel.net/license/
 */

namespace yiiext\metroui;

use Yii;
use yii\base\View;
use yii\helpers\Json;


/**
 * \yii\metroui\Widget is the base class for all metroui widgets.
 *
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @since 2.0
 */
class Widget extends \yii\base\Widget
{
	/**
	 * @var boolean whether to use the responsive version of metroui.
	 */
	public static $responsive = true;
	/**
	 * @var array the HTML attributes for the widget container tag.
	 */
	public $options = array();
	/**
	 * @var array the options for the underlying metroui JS plugin.
	 * Please refer to the corresponding metroui plugin Web page for possible options.
	 * For example, [this page](http://twitter.github.io/metroui/javascript.html#modals) shows
	 * how to use the "Modal" plugin and the supported options (e.g. "remote").
	 */
	public $clientOptions = array();
	/**
	 * @var array the event handlers for the underlying metroui JS plugin.
	 * Please refer to the corresponding metroui plugin Web page for possible events.
	 * For example, [this page](http://twitter.github.io/metroui/javascript.html#modals) shows
	 * how to use the "Modal" plugin and the supported events (e.g. "shown").
	 */
	public $clientEvents = array();


	/**
	 * Initializes the widget.
	 * This method will register the metroui asset bundle. If you override this method,
	 * make sure you call the parent implementation first.
	 */
	public function init()
	{
		parent::init();
		if (!isset($this->options['id'])) {
			$this->options['id'] = $this->getId();
		}
	}

	/**
	 * Registers a specific metroui plugin and the related events
	 * @param string $name the name of the metroui plugin
	 */
	protected function registerPlugin($name)
	{
		$id = $this->options['id'];
		$view = $this->getView();
		$view->registerAssetBundle(static::$responsive ? 'yiiext/metroui/responsive' : 'yiiext/metroui');
		$view->registerAssetBundle("yiiext/metroui/$name");

		if ($this->clientOptions !== false) {
			$options = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
			$js = "jQuery('#$id').$name($options);";
			$view->registerJs($js);
		}

		if (!empty($this->clientEvents)) {
			$js = array();
			foreach ($this->clientEvents as $event => $handler) {
				$js[] = "jQuery('#$id').on('$event', $handler);";
			}
			$view->registerJs(implode("\n", $js));
		}
	}

	/**
	 * Adds a CSS class to the specified options.
	 * This method will ensure that the CSS class is unique and the "class" option is properly formatted.
	 * @param array $options the options to be modified.
	 * @param string $class the CSS class to be added
	 */
	protected function addCssClass(&$options, $class)
	{
		if (isset($options['class'])) {
			$classes = preg_split('/\s+/', $options['class'] . ' ' . $class, -1, PREG_SPLIT_NO_EMPTY);
			$options['class'] = implode(' ', array_unique($classes));
		} else {
			$options['class'] = $class;
		}
	}
}
