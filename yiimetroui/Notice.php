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
use yii\helpers\base\ArrayHelper;
use yii\helpers\Html;

/**
 * Accordion renders an accordion bootstrap javascript component.
 *
 * For example:
 *
 * ```php
 * echo Notice::widget(array(
 *     'items' => 
 *         // equivalent to the above
 *         array(
 *             'content' => 'Anim pariatur cliche...',
 *			   'header' => 'Test',
 * 			   'icon' => '<img>',
 *			   'image' => '<img>',
 *             // open its content by default
 *             'contentOptions' => array('class'=>'in')
 *         )
 *     )
 * ));
 * ```
 *
 */
class Notice extends Widget
{
	/**
	 * @var array list of groups in the Notices widget. Each array element represents a single
	 * group
	 *
	 */
	public $items = array();


	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();		
	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		echo Html::beginTag('div', array('class'=>'notices')) . "\n";
		echo $this->renderItems() . "\n";
		echo Html::endTag('div') . "\n";
		$this->registerPlugin('notice');
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
			$items[] = Html::tag('div', $this->renderItem($this->items[$i], $i), $this->options);
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
		$group = array();
		if (isset($item['content'])) {
			//the close button
			$group[] = Html::tag('a', '', array('class'=>'close','href'=>'#')) . "\n";

			$id = $this->options['id'] . '-notice' . $index;
			$options = ArrayHelper::getValue($item, 'contentOptions', array());
			$options['id'] = $id;
			$this->addCssClass($options, 'notice-text');			
			$group[] = Html::tag('div', $item['content'], $options) . "\n";
		} else {
			throw new InvalidConfigException('The "content" option is required.');
		}
		if (isset($item['header'])) {
			$headerId = $this->options['id'] . '-notice-header' . $index;
			$group[] = Html::tag('div', $item['header'], array('class'=>'notice-header','id'=>$headerId)) . "\n";
		}
		if (isset($item['image'])) {
			$headerId = $this->options['id'] . '-notice-image' . $index;
			$group[] = Html::tag('div', $item['image'], array('class'=>'notice-image','id'=>$headerId)) . "\n";
		}
		if (isset($item['icon'])) {
			$headerId = $this->options['id'] . '-notice-icon' . $index;
			$group[] = Html::tag('div', $item['icon'], array('class'=>'notice-icon','id'=>$headerId)) . "\n";
		}

		return implode("\n", $group);
	}
}