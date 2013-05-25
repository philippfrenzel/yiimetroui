<?php
 
 /**
 * This class is merely used to publish assets that are needed by all yiimetroui
 * widgets and thus have to be imported before any widget gets rendered.
 * @copyright Frenzel GmbH - www.frenzel.net
 * @link http://www.frenzel.net
 * @author Philipp Frenzel <philipp@frenzel.net>
 */

namespace yiimetroui;

use Yii;
use yii\base\View;
use yii\helpers\Json;
use yii\base\Widget as BaseWidget;

class Widget extends BaseWidget
{
	/**
	 * @var string the yiimetroui theme bundle.
	 */
	public static $theme = NULL;
	/**
	 * @var array the HTML attributes for the widget container tag.
	 */
	public $options = array();
	/**
	 * @var array the options for the underlying jQuery UI widget.
	 * Please refer to the corresponding jQuery UI widget Web page for possible options.
	 * For example, [this page](http://api.jqueryui.com/accordion/) shows
	 * how to use the "Accordion" widget and the supported options (e.g. "header").
	 */
	public $clientOptions = array();
	/**
	 * @var array the event handlers for the underlying jQuery UI widget.
	 * Please refer to the corresponding jQuery UI widget Web page for possible events.
	 * For example, [this page](http://api.jqueryui.com/accordion/) shows
	 * how to use the "Accordion" widget and the supported events (e.g. "create").
	 */
	public $clientEvents = array();


	/**
	 * Initializes the widget.
	 * If you override this method, make sure you call the parent implementation first.
	 */
	public function init()
	{
		parent::init();
		if (!isset($this->options['id'])) {
			$this->options['id'] = $this->getId();
		}
	}

	/**
	* Registers a specific Bootstrap plugin and the related events
	* @param string $name the name of the Bootstrap plugin
	*/
	protected function registerPlugin($name)
	{
		$id = $this->options['id'];
		$view = $this->getView();
		
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
