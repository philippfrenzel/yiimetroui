<?php
/**
 * This class is merely used to publish assets that are needed by all dhtmlx
 * widgets and thus have to be imported before any widget gets rendered.
 * @copyright Frenzel GmbH - www.frenzel.net
 * @link http://www.frenzel.net
 * @author Philipp Frenzel <philipp@frenzel.net>
 */

namespace yiimetroui;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Tabs renders a tabs jQuery UI widget.
 *
 * For example:
 *
 * ```php
 * echo Tabs::widget(array(
 *     'items' => array(
 *         array(
 *             'header' => 'One',
 *             'content' => 'Mauris mauris ante, blandit et, ultrices a, suscipit eget...',
 *         ),
 *         array(
 *             'header' => 'Two',
 *             'headerOptions' => array(...),
 *             'content' => 'Sed non urna. Phasellus eu ligula. Vestibulum sit amet purus...',
 *             'options' => array(...),
 *         ),
 *     ),
 * ));
 * ```
 *
 */
class Tabs extends Widget
{
	/**
	 * @var array list of tabs in the tabs widget. Each array element represents a single
	 * tab with the following structure:
	 *
	 * ```php
	 * array(
	 *     // required, the header (HTML) of the tab
	 *     'header' => 'Tab label',
	 *     // required, the content (HTML) of the tab
	 *     'content' => 'Mauris mauris ante, blandit et, ultrices a, suscipit eget...',
	 *     // optional the HTML attributes of the tab content container
	 *     'options'=> array(...),
	 *     // optional the HTML attributes of the tab header container
	 *     'headerOptions'=> array(...),
	 * )
	 * ```
	 */
	public $items = array();

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();
		$this->options=ArrayHelper::merge($this->options,array('data-role'=>'page-control'));		
		$this->addCssClass($this->options, 'page-control');
	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		echo Html::beginTag('div', $this->options) . "\n";
		echo $this->renderResponsive() . "\n";
		echo $this->renderHeaders() . "\n";
		echo $this->renderContents() . "\n";
		echo Html::endTag('div') . "\n";
		$this->registerPlugin('tabs');
	}

	/**
	 * Renders tabs responsive as specified on [[items]].
	 * @return string the rendering result.
	 * @throws InvalidConfigException.
	 */
	protected function renderResponsive()
	{
		echo Html::tag('span','', array(
				'class' => 'menu-pull',
				'id' => '#muimp' . $this->options['id'],				
			)) . "\n"
			. Html::tag('div','', array(
				'class' => 'menu-pull-bar',
				'id' => '#muimpbar' . $this->options['id'],				
			));
	}	

	/**
	 * Renders tabs headers as specified on [[items]].
	 * @return string the rendering result.
	 * @throws InvalidConfigException.
	 */
	protected function renderHeaders()
	{
		$headers = array();
		foreach ($this->items as $n => $item) {
			if (!isset($item['header'])) {
				throw new InvalidConfigException("The 'header' option is required.");
			}
			$options = ArrayHelper::getValue($item, 'options', array());
			$id = isset($options['id']) ? $options['id'] : $this->options['id'] . '-frame' . $n;
			$headerOptions = ArrayHelper::getValue($item, 'headerOptions', array());
			if($n==0)
				$headerOptions = ArrayHelper::merge($options,array('class'=>'frame active'));
			$headers[] = Html::tag('li', Html::a($item['header'], "#$id"), $headerOptions);
		}

		return Html::tag('ul', implode("\n", $headers));
	}

	/**
	 * Renders tabs contents as specified on [[items]].
	 * @return string the rendering result.
	 * @throws InvalidConfigException.
	 */
	protected function renderContents()
	{
		$contents = array();
		foreach ($this->items as $n => $item) {
			if (!isset($item['content'])) {
				throw new InvalidConfigException("The 'content' option is required.");
			}
			$options = ArrayHelper::getValue($item, 'options', array());
			if (!isset($options['id'])) {
				$options['id'] = $this->options['id'] . '-frame' . $n;
			}
			if($n==0)
				$options = ArrayHelper::merge($options,array('class'=>'frame active'));
			else
				$options = ArrayHelper::merge($options,array('class'=>'frame'));

			$contents[] = Html::tag('div', $item['content'], $options);
		}

		return Html::tag('div', implode("\n", $contents),array('class'=>'frames'));
	}
}
