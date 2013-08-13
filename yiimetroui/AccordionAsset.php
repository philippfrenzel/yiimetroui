<?php
/**
 * @link http://www.frenzel.net/
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

namespace yiimetroui;

use yii\web\AssetBundle;

class AccordionAsset extends AssetBundle
{
    public $sourcePath = '@yiimetroui/assets';
    public $css = array(
    );
    public $js = array( 
    	'js/accordion.js'
    );
    public $depends = array(
    	 '\yiimetroui\WidgetAsset',
    );
}
