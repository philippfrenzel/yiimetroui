<?php
/**
 * @link http://www.frenzel.net/
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

namespace yiimetroui;

use yii\web\AssetBundle;

class WidgetAsset extends AssetBundle
{
    public $sourcePath = '@yiimetroui/assets';
    public $css = array(
    	'css/modern.css'
    );
    public $js = array( 
    );
    public $depends = array(
    );
}
