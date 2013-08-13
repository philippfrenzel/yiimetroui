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
 * Accordion renders an accordion bootstrap javascript component.
 *
 * For example:
 *
 * ```php
 * echo Tile::widget(array(
 *     'items' => 
 *         // equivalent to the above
 *         array(
 *             'content' => 'Anim pariatur cliche...',
 *			   'brand' => 'Test',
 *             // open its content by default
 *             'contentOptions' => array('class'=>'in')
 *         ),
 *         // another group item
 *         array(
 *             'content' => 'Anim pariatur cliche...',
 *             'contentOptions' => array(...),
 *             'options' => array(...),
 *         ),
 *     )
 * ));
 * ```
 *
 */
class Tile extends Widget
{
	/**
	 * @var array list of groups in the Accordion widget. Each array element represents a single
	 * group with the following structure:
	 *
	 * ```php
	 * // item key is the actual group header
	 * array(
	 *     // required, the content (HTML) of the group
	 *     'content' => 'Anim pariatur cliche...',
	 *     'brand'	=> 'Label',
	 *     // optional the HTML attributes of the content group
	 *     'contentOptions'=> array(),
	 *     // optional the HTML attributes of the group
	 *     'options'=> array(),
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
		$this->addCssClass($this->options, 'tile');
	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		echo Html::beginTag('div', $this->options) . "\n";
		echo $this->renderItems() . "\n";
		echo Html::endTag('div') . "\n";
		$this->registerPlugin('tile');
	}

	/**
	 * Renders collapsible items as specified on [[items]].
	 * @return string the rendering result
	 */
	public function renderItems()
	{
		$items = array();
		$index = 0;
		for ($i = 0, $count = count($this->items); $i < $count; $i++) {
			$items[] = $this->renderItem($this->items[$i], $i);
		}

		return implode("\n", $items);
	}

	/**
	 * Renders a single collapsible item group
	 * @param string $header a label of the item group [[items]]
	 * @param array $item a single item from [[items]]
	 * @param integer $index the item index as each item group content must have an id
	 * @return string the rendering result
	 * @throws InvalidConfigException
	 */
	public function renderItem($item, $index)
	{
		if (isset($item['content'])) {
			$id = $this->options['id'] . '-tile' . $index;
			$options = ArrayHelper::getValue($item, 'contentOptions', array());
			$options['id'] = $id;
			$this->addCssClass($options, 'tile-content');			
			$content = Html::tag('div', $item['content'], $options) . "\n";
		} else {
			throw new InvalidConfigException('The "content" option is required.');
		}
		if (isset($item['brand'])) {
			$brandid = $this->options['id'] . '-tile-brand' . $index;
			$brand = Html::tag('div', $item['brand'], array('class'=>'brand','id'=>$brandid)) . "\n";
		} 
		$group = array();
		$group[] = $content;
		$group[] = $brand;

		return implode("\n", $group);
	}
}