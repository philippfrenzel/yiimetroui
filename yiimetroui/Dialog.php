<?php
/**
 * This class is merely used to publish assets that are needed by all dhtmlx
 * widgets and thus have to be imported before any widget gets rendered.
 * @copyright Frenzel GmbH - www.frenzel.net
 * @link http://www.frenzel.net
 * @author Philipp Frenzel <philipp@frenzel.net>
 */

namespace yiimetroui;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Dialog renders a Dialog window that can be toggled by clicking on a button.
 *
 * The following example will show the content enclosed between the [[begin()]]
 * and [[end()]] calls within the Dialog window:
 *
 * ~~~php
 * Dialog::begin(array(
 *     'header' => '<h2>Hello world</h2>',
 *     'toggleButton' => array(
 *         'label' => 'click me',
 *     ),
 * ));
 *
 * echo 'Say hello...';
 *
 * Dialog::end();
 * ~~~
 *
 */
class Dialog extends Widget
{
	/**
	 * @var string the header content in the Dialog window.
	 */
	public $header;
	/**
	 * @var string the footer content in the Dialog window.
	 */
	public $footer;
	/**
	 * @var array the options for rendering the close button tag.
	 * The close button is displayed in the header of the Dialog window. Clicking
	 * on the button will hide the Dialog window. If this is null, no close button will be rendered.
	 *
	 * The following special options are supported:
	 *
	 * - tag: string, the tag name of the button. Defaults to 'button'.
	 * - label: string, the label of the button. Defaults to '&times;'.
	 *
	 * The rest of the options will be rendered as the HTML attributes of the button tag.
	 * Please refer to the [Dialog plugin help](http://twitter.github.com/bootstrap/javascript.html#Dialogs)
	 * for the supported HTML attributes.
	 */
	public $closeButton = array();


	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();

		$this->initOptions();

		//echo $this->renderToggleButton() . "\n";
		echo Html::beginTag('div', $this->options) . "\n";
		echo $this->renderHeader() . "\n";
		echo $this->renderBodyBegin() . "\n";
	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		echo "\n" . $this->renderBodyEnd();
		echo "\n" . $this->renderFooter();
		echo "\n" . Html::endTag('div');

		$this->registerPlugin('dialog');
	}

	/**
	 * Renders the header HTML markup of the Dialog
	 * @return string the rendering result
	 */
	protected function renderHeader()
	{
		$button = $this->renderCloseButton();
		if ($button !== null) {
			$this->header = $button . "\n" . $this->header;
		}
		if ($this->header !== null) {
			return Html::tag('div', "\n" . $this->header . "\n", array('class' => 'header'));
		} else {
			return null;
		}
	}

	/**
	 * Renders the opening tag of the Dialog body.
	 * @return string the rendering result
	 */
	protected function renderBodyBegin()
	{
		return Html::beginTag('div', array('class' => 'content'));
	}

	/**
	 * Renders the closing tag of the Dialog body.
	 * @return string the rendering result
	 */
	protected function renderBodyEnd()
	{
		return Html::endTag('div');
	}

	/**
	 * Renders the HTML markup for the footer of the Dialog
	 * @return string the rendering result
	 */
	protected function renderFooter()
	{
		if ($this->footer !== null) {
			return Html::tag('div', "\n" . $this->footer . "\n", array('class' => 'action'));
		} else {
			return null;
		}
	}

	/**
	 * Renders the close button.
	 * @return string the rendering result
	 */
	protected function renderCloseButton()
	{
		if ($this->closeButton !== null) {
			$tag = ArrayHelper::remove($this->closeButton, 'tag', 'button');
			$label = ArrayHelper::remove($this->closeButton, 'label', '&times;');
			if ($tag === 'button' && !isset($this->closeButton['type'])) {
				$this->closeButton['type'] = 'button';
			}
			return Html::tag($tag, $label, $this->closeButton);
		} else {
			return null;
		}
	}

	/**
	 * Initializes the widget options.
	 * This method sets the default values for various options.
	 */
	protected function initOptions()
	{
		$this->options = array_merge(array(
			'class' => 'dialog hide',
		), $this->options);
		$this->addCssClass($this->options, 'dialog');

		$this->clientOptions = array_merge(array(
			'show' => false,
		), $this->clientOptions);

		if ($this->closeButton !== null) {
			$this->closeButton = array_merge(array(
				'data-dismiss' => 'dialog',
				'aria-hidden' => 'true',
				'class' => 'close',
			), $this->closeButton);
		}
	}
}
