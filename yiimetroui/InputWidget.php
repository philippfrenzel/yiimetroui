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
use yii\base\Model;
use yii\base\InvalidConfigException;

/**
 * InputWidget is the base class for all yiimetroui input widgets.
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @since 2.0
 */
class InputWidget extends Widget
{
	/**
	 * @var Model the data model that this widget is associated with.
	 */
	public $model;
	/**
	 * @var string the model attribute that this widget is associated with.
	 */
	public $attribute;
	/**
	 * @var string the input name. This must be set if [[model]] and [[attribute]] are not set.
	 */
	public $name;
	/**
	 * @var string the input value.
	 */
	public $value;


	/**
	 * Initializes the widget.
	 * If you override this method, make sure you call the parent implementation first.
	 */
	public function init()
	{
		if (!$this->hasModel() && $this->name === null) {
			throw new InvalidConfigException("Either 'name' or 'model' and 'attribute' properties must be specified.");
		}
		parent::init();
	}

	/**
	 * @return boolean whether this widget is associated with a data model.
	 */
	protected function hasModel()
	{
		return $this->model instanceof Model && $this->attribute !== null;
	}
}
